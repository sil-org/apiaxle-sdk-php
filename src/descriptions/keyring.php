<?php
return [
    'operations' => [
        'List' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/keyrings',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'from' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'to' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'resolve' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'query'
                ]
            ]
        ],

        'Get' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/keyring/{id}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
            ]
        ],

        'Delete' => [
            'httpMethod' => 'DELETE',
            'uri' => '/{ApiVersion}/keyring/{id}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
            ]
        ],

        'Create' => [
            'httpMethod' => 'POST',
            'uri' => '/{ApiVersion}/keyring/{id}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'createdAt' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'json',
                ],
                'updatedAt' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'json',
                ],
            ],
        ],

        'Update' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/keyring/{id}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'createdAt' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'json',
                ],
                'updatedAt' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'json',
                ],
            ],
        ],

        'ListKeys' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/keyring/{id}/keys',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'from' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'to' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'resolve' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'query'
                ]
            ]
        ],

        'LinkKey' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/keyring/{id}/linkkey/{key}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'key' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
            ]
        ],

        'UnlinkKey' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/keyring/{id}/unlinkkey/{key}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
                'key' => [
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ],
            ]
        ],

        'GetStats' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/keyring/{id}/stats',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'from' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'to' => [
                    'required' => false,
                    'type' => 'integer',
                    'location' => 'query',
                ],
                'granularity' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['second', 'minute', 'hour', 'day']
                ],
                'format_timeseries' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'query',
                ],
                'format_timestamp' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['epoch_seconds', 'epoch_milliseconds', 'ISO'],
                ],
                'forkey' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
                'forapi' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
            ]
        ],




    ],
];