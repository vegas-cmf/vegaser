<?php

class VegaserTest extends PHPUnit_Framework_TestCase
{

    public function testVegasDefault()
    {
        system('php '.TESTS_ROOT_DIR.'/../build.php');
    }
}
