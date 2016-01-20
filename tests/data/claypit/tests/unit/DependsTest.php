<?php
class DependsTest extends \Codeception\Test\TestCase {

    /**
     * @group depends
     * @depends testOne
     */
    public function testTwo()
    {
        $this->assertTrue(true);
    }

    /**
     * @group depends
     */
    public function testOne()
    {
        $this->assertTrue(false);
    }



}