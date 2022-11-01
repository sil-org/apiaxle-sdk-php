<?php
namespace ApiaxleTests;

use Apiaxle\Key;

include __DIR__ . '/../vendor/autoload.php';

class KeyTest extends TestBase
{

    const objectClass = 'Apiaxle\Key';

    public function testList()
    {
        $client = $this->getClient(self::objectClass);
        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200,
    "pagination": {
      "next": {},
      "prev": {}
    }
  },
  "results": [
    "abc123"
  ]
}';
        $this::nextMock($client, 200, $mockBody);

        $list = $client->list(['ApiVersion' => 'v2',]);

        $this->assertEquals(200, $list['statusCode']);
        $this->assertEquals(1, count($list['results']));
    }

    public function testGet()
    {
        $client = $this->getClient(self::objectClass);
        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "disabled": false,
    "createdAt": 1475853823003,
    "apis": []
  }
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->get([
            'id' => 'abc123',
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertFalse($api['results']['disabled']);
    }

    public function testCreate()
    {
        $client = $this->getClient(self::objectClass);
        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "disabled": false,
    "createdAt": 1475854103979
  }
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->create([
            'id' => 'def123',
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertFalse($api['results']['disabled']);
    }

    public function testCreateInvalidQpm()
    {
        $client = $this->getClient(self::objectClass);

        // Invalid qpm
        $this->expectException('GuzzleHttp\Command\Exception\CommandException');
        $this->expectExceptionMessage('Validation errors: [qpm] must be of type integer');
        $client->create([
            'id' => 'testinginvalidparameters',
            'qpm' => 'invalid'
        ]);
    }

    public function testUpdate()
    {
        $client = $this->getClient(self::objectClass);

        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "new": {
      "disabled": false,
      "createdAt": 1475854103979,
      "qpm": -1
    },
    "old": {
      "disabled": false,
      "createdAt": 1475854103979
    }
  }
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->update([
            'id' => 'def123',
            'qpm' => -1
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals(-1, $api['results']['new']['qpm']);
    }

    public function testListApis()
    {
        $client = $this->getClient(self::objectClass);
        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200,
    "pagination": {
      "next": {},
      "prev": {}
    }
  },
  "results": [
    "dummy"
  ]
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->listApis([
            'id' => 'abc123',
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals(1, count($api['results']));
        $this->assertEquals('dummy', $api['results'][0]);
    }




    /**
     * @param $class
     * @param array $extraConfig
     * @return Key
     */
    public function getClient($class, $extraConfig = [])
    {
        return parent::getClient($class, $extraConfig);
    }
}