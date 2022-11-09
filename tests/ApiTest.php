<?php
namespace ApiaxleTests;

use Apiaxle\Api;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

include __DIR__ . '/../vendor/autoload.php';

class ApiTest extends TestBase
{

    const objectClass = 'Apiaxle\Api';

    public function testList()
    {
        $client = $this->getClient(self::objectClass);

        $mockBody = '{
  "meta": {
    "version": 2,
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

        $mockResp = new MockResponder('GET', '/v2/apis');
        $this::nextMock($client, $mockResp->getResponse($mockBody));

        $list = $client->list(['ApiVersion' => 'v2',]);

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

        $mockResp = new MockResponder('GET', '/v1/api/apiaxle');
        $this::nextMock($client, $mockResp->getResponse($mockBody));

        $api = $client->get([
            'id' => 'apiaxle',
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
    "protocol": "https",
    "apiFormat": "json",
    "endPointTimeout": 2,
    "disabled": false,
    "strictSSL": true,
    "sendThroughApiKey": false,
    "sendThroughApiSig": false,
    "endPoint": "myapiendpoint.com",
    "createdAt": 1389915291013,
    "tokenSkewProtectionCount": 3,
    "hasCapturePaths": false,
    "allowKeylessUse": false,
    "keylessQps": 2,
    "keylessQpd": 172800,
    "updatedAt": 1427892638934
  }
}';

        $wantBody = '{"protocol":"https","tokenSkewProtectionCount":3,"apiFormat":"json",' .
            '"endPointTimeout":2,"defaultPath":"\/api","disabled":false,"strictSSL":true,' .
            '"sendThroughApiKey":false,"sendThroughApiSig":false,"hasCapturePaths":false,' .
            '"allowKeylessUse":false,"keylessQps":2,"keylessQpd":172800}';
        $mockResp = new MockResponder('POST', '/v1/api/testapi', $wantBody);
        $this::nextMock($client, $mockResp->getResponse($mockBody));

        $api = $client->create([
            'id' => 'testapi',
            'endpoint' => 'myapiendpoint.com',
            'protocol' => 'https',
            'strictSSL' => true,
            'defaultPath' => '/api',
        ]);

        $this->assertEquals(200, $api['statusCode']);
        $this->assertEquals('https', $api['results']['protocol']);
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

        $wantBody = '{"protocol":"http","tokenSkewProtectionCount":3,"apiFormat":"json",' .
            '"endPointTimeout":2,"disabled":false,"strictSSL":true,' .
            '"sendThroughApiKey":false,"sendThroughApiSig":false,"hasCapturePaths":false,' .
            '"allowKeylessUse":false,"keylessQps":2,"keylessQpd":172800}';

        $mockResp = new MockResponder('PUT', '/v1/api/testapi', $wantBody);
        $this::nextMock($client, $mockResp->getResponse($mockBody));

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

        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": "example"
}';
        $wantPath = '/v1/api/testapi/addcapturepath/example';
        $mockResp = new MockResponder('PUT', $wantPath, '{}');
        $this::nextMock($client, $mockResp->getResponse($mockBody));

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

        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": "example"
}';

        $wantPath = '/v1/api/testapi/delcapturepath/example';
        $mockResp = new MockResponder('PUT', $wantPath, '{}');
        $this::nextMock($client, $mockResp->getResponse($mockBody));

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

        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": [
    "example"
  ]
}';

        $wantPath = '/v1/api/testapi/capturepaths';
        $mockResp = new MockResponder('GET', $wantPath);
        $this::nextMock($client, $mockResp->getResponse($mockBody));

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
        $wantPath = '/v1/api/dummy/linkkey/abc123';
        $mockResp = new MockResponder('PUT', $wantPath, '{}');
        $this::nextMock($client, $mockResp->getResponse($mockBody));

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