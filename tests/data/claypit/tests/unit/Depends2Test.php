<?php
class Depends2Test extends \Codeception\Test\TestCase {

    /**
     * @group depends
     * @depends DependsTest:testTwo
     */
    public function testThree()
    {
        $this->assertTrue(true);
    }




}