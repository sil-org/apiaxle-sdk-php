<?php
namespace ApiaxleTests;

use Apiaxle\Api;

include __DIR__ . '/../vendor/autoload.php';

class ApiTest extends TestBase
{

    const objectClass = 'Apiaxle\Api';

    public function testList()
    {
        $client = $this->getClient(self::objectClass);
        $list = $client->list([]);

        $this->assertEquals(200, $list['statusCode']);
        $this->assertEquals(4, count($list['results']));
    }

    public function testGet()
    {
        $client = $this->getClient(self::objectClass);
        $api = $client->get(['id' => 'apiaxle']);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals('http', $api['results']['protocol']);
    }

    public function testCreate()
    {
        $client = $this->getClient(self::objectClass);
        $api = $client->create([
            //'id' => 'testapi',
            'id' => 'testapi',
            'endpoint' => 'myapiendpoint.com',
            'protocol' => 'https',
            'strictSSL' => true,
            'defaultPath' => '/api',
        ]);

        die(print_r($api,true));

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals('http', $api['results']['protocol']);
    }

    public function testCreateInvalidProtocol()
    {
        $client = $this->getClient(self::objectClass);

        // Invalid protocol
        $this->expectException('GuzzleHttp\Command\Exception\CommandException');
        $this->expectExceptionMessage('Validation errors: [protocol] must be one of "http" or "https"');
        $client->create([
            'id' => 'testinginvalidparameters',
            'protocol' => 'invalid'
        ]);
    }

    public function testCreateInvalidStrictSSL()
    {
        $client = $this->getClient(self::objectClass);

        // Invalid strictSSL
        $this->expectException('GuzzleHttp\Command\Exception\CommandException');
        $this->expectExceptionMessage('Validation errors: [strictSSL] must be of type boolean');
        $client->create([
            'id' => 'testinginvalidparameters',
            'strictSSL' => 'invalid'
        ]);
    }

    public function testUpdate()
    {
        $client = $this->getClient(self::objectClass);
        $api = $client->update([
            'id' => 'testapi',
            'protocol' => 'http'
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals('http', $api['results']['new']['protocol']);
    }

    public function testAddCapturePath()
    {
        $client = $this->getClient(self::objectClass);
        $api = $client->addCapturePath([
            'id' => 'testapi',
            'path' => 'example'
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals('example', $api['results']);
    }

    public function testDeleteCapturePath()
    {
        $client = $this->getClient(self::objectClass);
        $api = $client->deleteCapturePath([
            'id' => 'testapi',
            'path' => 'example'
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals('example', $api['results']);
    }

    public function testListCapturePaths()
    {
        $client = $this->getClient(self::objectClass);
        $api = $client->listCapturePaths([
            'id' => 'testapi',
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals(1, count($api['results']));
        $this->assertEquals('example', $api['results'][0]);
    }

    public function testLinkKey()
    {
        $client = $this->getClient(self::objectClass);
        $api = $client->linkKey([
            'id' => 'dummy',
            'key' => 'abc123'
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertFalse($api['results']['disabled']);
    }

    /**
     * @param $class
     * @param array $extraConfig
     * @return Api
     */
    public function getClient($class, $extraConfig = [])
    {
        return parent::getClient($class, $extraConfig);
    }

}