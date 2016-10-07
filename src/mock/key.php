<?php
return [
    'GET /v1/keys?api_key=abc123' => [
        'status' => 200,
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
    "abc123"
  ]
}'
    ],

    'GET /v1/key/abc123?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "disabled": false,
    "createdAt": 1475853823003,
    "apis": []
  }
}'
    ],

    'POST /v1/key/def123?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
  "meta": {
    "version": 1,
    "status_code": 200
  },
  "results": {
    "disabled": false,
    "createdAt": 1475854103979
  }
}'
    ],

    'PUT /v1/key/def123?api_key=abc123' => [
        'status' => 200,
        'headers' => [],
        'body' => '{
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
}'
    ],

    'GET /v1/key/abc123/apis?api_key=abc123' => [
        'status' => 200,
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
    "dummy"
  ]
}'
    ],





];