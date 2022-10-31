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

        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200,
    "pagination": {
      "next": {
        "href": "http://127.0.0.1:8000/v1/apis?from=11&to=21&resolve=false",
        "from": 11,
        "to": 21
      },
      "prev": {}
    }
  },
  "results": [
    "apiaxle",
    "dummy",
    "test",
    "sample"
  ]
}';
        $this::nextMock($client, 200, $mockBody);

        $list = $client->list([
            'ApiVersion' => '1',]);

        $this->assertEquals(200, $list['statusCode']);
        $this->assertEquals(4, count($list['results']));
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
    "protocol": "http",
    "apiFormat": "json",
    "endPointTimeout": 2,
    "disabled": false,
    "strictSSL": true,
    "sendThroughApiKey": false,
    "sendThroughApiSig": false,
    "endPoint": "localhost:8000",
    "createdAt": 1389915291013,
    "tokenSkewProtectionCount": 3,
    "hasCapturePaths": false,
    "allowKeylessUse": false,
    "keylessQps": 2,
    "keylessQpd": 172800,
    "updatedAt": 1427892638934
  }
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->get([
            'id' => 'apiaxle',
            'ApiVersion' => '1',
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals('http', $api['results']['protocol']);
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
    "protocol": "http",
    "apiFormat": "json",
    "endPointTimeout": 2,
    "disabled": false,
    "strictSSL": true,
    "sendThroughApiKey": false,
    "sendThroughApiSig": false,
    "endPoint": "localhost:8000",
    "createdAt": 1389915291013,
    "tokenSkewProtectionCount": 3,
    "hasCapturePaths": false,
    "allowKeylessUse": false,
    "keylessQps": 2,
    "keylessQpd": 172800,
    "updatedAt": 1427892638934
  }
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->create([
            //'id' => 'testapi',
            'id' => 'testapi',
            'ApiVersion' => '1',
            'endpoint' => 'myapiendpoint.com',
            'protocol' => 'https',
            'strictSSL' => true,
            'defaultPath' => '/api',
        ]);

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
            'ApiVersion' => '1',
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
            'ApiVersion' => '1',
            'strictSSL' => [], // apparently, it accepts strings and integers as booleans now
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
      "protocol": "http",
      "tokenSkewProtectionCount": 3,
      "apiFormat": "json",
      "endPointTimeout": 10,
      "disabled": false,
      "strictSSL": true,
      "sendThroughApiKey": false,
      "sendThroughApiSig": false,
      "hasCapturePaths": false,
      "allowKeylessUse": false,
      "keylessQps": 2,
      "keylessQpd": 172800,
      "endPoint": "local",
      "defaultPath": "/dummy-api",
      "createdAt": 1467812949223
    },
    "old": {
      "protocol": "https",
      "tokenSkewProtectionCount": 3,
      "apiFormat": "json",
      "endPointTimeout": 10,
      "disabled": false,
      "strictSSL": true,
      "sendThroughApiKey": false,
      "sendThroughApiSig": false,
      "hasCapturePaths": false,
      "allowKeylessUse": false,
      "keylessQps": 2,
      "keylessQpd": 172800,
      "endPoint": "local",
      "defaultPath": "/dummy-api",
      "createdAt": 1467812949223
    }
  }
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->update([
            'id' => 'testapi',
            'ApiVersion' => '1',
            'protocol' => 'http'
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals('http', $api['results']['new']['protocol']);
    }

    public function testAddCapturePath()
    {
        $client = $this->getClient(self::objectClass);

        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": "example"
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->addCapturePath([
            'id' => 'testapi',
            'ApiVersion' => '1',
            'path' => 'example'
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals('example', $api['results']);
    }

    public function testDeleteCapturePath()
    {
        $client = $this->getClient(self::objectClass);

        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": "example"
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->deleteCapturePath([
            'id' => 'testapi',
            'ApiVersion' => '1',
            'path' => 'example'
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals('example', $api['results']);
    }

    public function testListCapturePaths()
    {
        $client = $this->getClient(self::objectClass);

        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": [
    "example"
  ]
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->listCapturePaths([
            'id' => 'testapi',
            'ApiVersion' => '1',
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals(1, count($api['results']));
        $this->assertEquals('example', $api['results'][0]);
    }

    public function testLinkKey()
    {
        $client = $this->getClient(self::objectClass);

        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "disabled": false,
    "createdAt": 1475853823003
  }
}';
        $this::nextMock($client, 200, $mockBody);

        $api = $client->linkKey([
            'id' => 'dummy',
            'ApiVersion' => '1',
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