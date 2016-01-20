<?php
namespace Codeception\Subscriber;

use Codeception\Event\TestEvent;
use Codeception\Test\Descriptor;
use Codeception\Test\Interfaces\Dependent;
use Codeception\TestInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Codeception\Events;

class Dependencies implements EventSubscriberInterface
{
    use Shared\StaticEvents;

    static $events = [
        Events::TEST_START => 'testStart',
        Events::TEST_SUCCESS => 'testSuccess'
    ];

    protected $startedTests = [];
    protected $successfulTests = [];

    public function testStart(TestEvent $event)
    {
        $test = $event->getTest();
        if (!$test instanceof Dependent) {
            return;
        }

        $testSignatures = $test->getDependencies();
        foreach ($testSignatures as $signature) {
            if (!in_array($signature, $this->successfulTests)) {
                $test->getMetadata()->setSkip(sprintf("This test depends on %s to pass", Descriptor::getTestSignature($test), $signature));
                return;
            }
        }
    }

    public function testSuccess(TestEvent $event)
    {
        $test = $event->getTest();
        if (!$test instanceof TestInterface) {
            return;
        }
        $this->successfulTests[] = Descriptor::getTestSignature($test);
    }

}