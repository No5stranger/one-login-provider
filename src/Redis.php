<?php
namespace OneLogin\Model;

use Predis\Client;

class Redis
{
    const PREFIX = 'one_login';
    const REDIS_HOST = '127.0.0.1';
    const REDIS_PORT = '6379';
    const REDIS_PASSWORD = '123123';

    private $host;
    private $port;
    private $password;

    private $redisClient;

    public function __construct($config = null)
    {
        if (isset($config['host']) && $config['port']) {
            $this->host = $config['host'];
            $this->port = $config['port'];
            $this->password = $config['password'];
        } else {
            $this->host = self::REDIS_HOST;
            $this->port = self::REDIS_PORT;
            $this->password = self::REDIS_PASSWORD;
        }

        $this->redisClient = new Client(
            array(
                'host' => $this->host,
                'port' => $this->port,
                'password' => $this->password
            )
        );
    }

    public function getData($key) {
        $key = self::PREFIX . $key;
        return $this->redisClient->get($key);
    }

    public function setData($key, $data) {
        $key = self::PREFIX . $key;
        return $this->redisClient->set($key, $data);
    }
}
