<?php
namespace OneLogin\Tests;

use PHPUnit_Framework_TestCase;
use OneLogin\Model\Redis;

class RedisTest extends PHPUnit_Framework_TestCase
{
    public function testSetData()
    {
        $client = new Redis();
        d($client->setData('cjp', 'haha'));
        return $client;
    }

    /**
     * @depends testSetData
     */
    public function testGetData($client)
    {
        d($client->getData('cjp'));
    }
}
