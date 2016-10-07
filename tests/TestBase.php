<?php
namespace ApiaxleTests;

include __DIR__ . '/../vendor/autoload.php';

use Apiaxle\Api;
use Apiaxle\Key;
use PHPUnit\Framework\TestCase;

class TestBase extends TestCase
{
    public $config = [];
    public $mockMode = true;
    public $proxy = null;
    public $verifySsl = false;

    /**
     * Set up default config
     */
    public function setUp()
    {
        $this->config = [
            'max_retries' => 0,
            'http_client_options' => [
                'defaults' => [
                    'proxy' => $this->proxy,
                    'verify' => $this->verifySsl,
                ]
            ],
            'baseUrl' => 'http://localhost',
            'key' => 'abc123',
        ];

    }

    public function getClient($class, $extraConfig = [])
    {
        $config = array_merge_recursive($this->config, $extraConfig);
        return new $class($config, $this->mockMode);
    }
}