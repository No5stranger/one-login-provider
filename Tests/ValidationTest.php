<?php
namespace OneLogin\Tests;

use PHPUnit_Framework_TestCase;
use OneLogin\Model\Validation;

class ValidationTest extends PHPUnit_Framework_TestCase
{
    public function testPing()
    {
        //d('abc');
    }

    public function testGetSerialization()
    {
        //Validation::getSerialization(1);
        Validation::checkValidation(1);
    }
}
