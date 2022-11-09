<?php
namespace ApiaxleTests;

use GuzzleHttp\Psr7\Response;

use Apiaxle\Keyring;
use Psr\Http\Message\RequestInterface;


include __DIR__ . '/../vendor/autoload.php';

class KeyringTest extends TestBase
{

    const objectClass = 'Apiaxle\Keyring';

    public function testCreate()
    {
        $client = $this->getClient(self::objectClass);
        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "createdAt": 1475860320098
  }
}';

        $mockResp = new MockResponder('POST', '/v2/keyring/sample', '{}');
        $this::nextMockNew($client, $mockResp->getResponse($mockBody));

        $list = $client->create([
            'ApiVersion' => 'v2',
            'id' => 'sample'
        ]);

        $this->assertEquals(200, $list['statusCode']);
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
    "createdAt": 1475860320098
  }
}';

        $mockResp = new MockResponder('GET', '/v1/keyring/sample');
        $this::nextMockNew($client, $mockResp->getResponse($mockBody));

        $list = $client->get(['id' => 'sample']);

        $this->assertEquals(200, $list['statusCode']);
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
    "createdAt": 1475860320098
  }
}';

        $mockResp = new MockResponder('PUT', '/v1/keyring/sample', '{}');
        $this::nextMockNew($client, $mockResp->getResponse($mockBody));

        $list = $client->update(['id' => 'sample']);

        $this->assertEquals(200, $list['statusCode']);
    }

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
    "sample"
  ]
}';

        $mockResp = new MockResponder('GET', '/v1/keyrings');
        $this::nextMockNew($client, $mockResp->getResponse($mockBody));

        $list = $client->list([]);

        $this->assertEquals(200, $list['statusCode']);
        $this->assertEquals(1, count($list['results']));
        $this->assertEquals('sample', $list['results'][0]);
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
        $wantPath = '/v1/keyring/sample/linkkey/abc123';
        $mockResp = new MockResponder('PUT', $wantPath, '{}');
        $this::nextMockNew($client, $mockResp->getResponse($mockBody));

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
        $mockBody = '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": [
    "abc123"
  ]
}';

        $mockResp = new MockResponder('GET', '/v1/keyring/sample/keys');
        $this::nextMockNew($client, $mockResp->getResponse($mockBody));

        $list = $client->listKeys(['id' => 'sample']);

        $this->assertEquals(200, $list['statusCode']);
        $this->assertEquals(1, count($list['results']));
        $this->assertEquals('abc123', $list['results'][0]);
    }

    public function testUnlinkKey()
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
        $wantPath = '/v1/keyring/sample/unlinkkey/abc123';
        $mockResp = new MockResponder('PUT', $wantPath, '{}');
        $this::nextMockNew($client, $mockResp->getResponse($mockBody));

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