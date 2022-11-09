<?php
namespace ApiaxleTests;

include __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

use PHPUnit\Framework\TestCase;

class TestBase extends TestCase
{
    public $config = [];
    public $proxy = null;
    public $verifySsl = false;

    /**
     * Set up default config
     */
    public function setUp(): void
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
        $mock =  new MockHandler(null);
        return new $class($config, $mock);
    }

    public function nextMock($client, $statusCode, $body) {
        $client->mock->reset();
        $client->mock->append(new Response($statusCode, [], $body));
    }

    public function nextMockNew($client, $response) {
        $client->mock->reset();
        $client->mock->append($response);
    }

}