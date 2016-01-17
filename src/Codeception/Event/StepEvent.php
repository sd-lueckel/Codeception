<?php
namespace Codeception\Event;

use Codeception\Step;
use Codeception\Test\Interfaces\ScenarioDriven;
use Symfony\Component\EventDispatcher\Event;

class StepEvent extends Event
{
    /**
     * @var Step
     */
    protected $step;

    /**
     * @var ScenarioDriven
     */
    protected $test;

    public function __construct(ScenarioDriven $test, Step $step)
    {
        $this->test = $test;
        $this->step = $step;
    }

    public function getStep()
    {
        return $this->step;
    }

    /**
     * @return ScenarioDriven
     */
    public function getTest()
    {
        return $this->test;
    }
}
