<?php
return [
    'GET /v1/apis?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
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
}',
    ],

    'GET /v1/api/apiaxle?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
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
}',
    ],

    'POST /v1/api/testapi?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
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
}',
    ],

    'PUT /v1/api/testapi?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
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
}',
    ],

    'PUT /v1/api/testapi/addcapturepath/example?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": "example"
}',
    ],

    'PUT /v1/api/testapi/delcapturepath/example?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": "example"
}',
    ],

    'GET /v1/api/testapi/capturepaths?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": [
    "example"
  ]
}',
    ],

    'PUT /v1/api/dummy/linkkey/abc123?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "disabled": false,
    "createdAt": 1475853823003
  }
}'
    ],


];