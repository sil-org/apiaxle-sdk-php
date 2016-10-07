<?php
namespace ApiaxleTests;

use Apiaxle\Keyring;

include __DIR__ . '/../vendor/autoload.php';

class KeyringTest extends TestBase
{

    const objectClass = 'Apiaxle\Keyring';

    public function testCreate()
    {
        $client = $this->getClient(self::objectClass);
        $list = $client->create([
            'id' => 'sample'
        ]);

        $this->assertEquals(200, $list['statusCode']);
    }

    public function testGet()
    {
        $client = $this->getClient(self::objectClass);
        $list = $client->get([
            'id' => 'sample'
        ]);

        $this->assertEquals(200, $list['statusCode']);
    }

    public function testUpdate()
    {
        $client = $this->getClient(self::objectClass);
        $list = $client->update([
            'id' => 'sample'
        ]);

        $this->assertEquals(200, $list['statusCode']);
    }

    public function testList()
    {
        $client = $this->getClient(self::objectClass);
        $list = $client->list([]);

        $this->assertEquals(200, $list['statusCode']);
        $this->assertEquals(1, count($list['results']));
        $this->assertEquals('sample', $list['results'][0]);
    }

    public function testLinkKey()
    {
        $client = $this->getClient(self::objectClass);
        $list = $client->linkKey([
            'id' => 'sample',
            'key' => 'abc123',
        ]);

        $this->assertEquals(200, $list['statusCode']);
        $this->assertFalse($list['results']['disabled']);
    }

    public function testListKeys()
    {
        $client = $this->getClient(self::objectClass);
        $list = $client->listKeys([
            'id' => 'sample',
        ]);

        $this->assertEquals(200, $list['statusCode']);
        $this->assertEquals(1, count($list['results']));
        $this->assertEquals('abc123', $list['results'][0]);
    }

    public function testUnlinkKey()
    {
        $client = $this->getClient(self::objectClass);
        $list = $client->unlinkKey([
            'id' => 'sample',
            'key' => 'abc123',
        ]);

        $this->assertEquals(200, $list['statusCode']);
        $this->assertFalse($list['results']['disabled']);
    }



    /**
     * @param $class
     * @param array $extraConfig
     * @return Keyring
     */
    public function getClient($class, $extraConfig = [])
    {
        return parent::getClient($class, $extraConfig);
    }
}