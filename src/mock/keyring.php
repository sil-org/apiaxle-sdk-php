<?php
return [
    'GET /v1/keyrings?api_key=abc123' => [
        'status' => '200',
        'headers' => [],
        'body' => '{
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
}',
    ],

    'POST /v1/keyring/sample?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "createdAt": 1475860320098
  }
}',
    ],

    'GET /v1/keyring/sample?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "createdAt": 1475860320098
  }
}',
    ],

    'PUT /v1/keyring/sample?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "createdAt": 1475860320098
  }
}',
    ],

    'PUT /v1/keyring/sample/linkkey/abc123?api_key=abc123' => [
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
}',
    ],

    'GET /v1/keyring/sample/keys?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": [
    "abc123"
  ]
}',
    ],

    'PUT /v1/keyring/sample/unlinkkey/abc123?api_key=abc123' => [
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
}',
    ],




];