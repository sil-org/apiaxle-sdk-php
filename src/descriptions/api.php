<?php

$defaultApiVersion = 'v1';

/*
 * Define Api model parameters for reuse
 */
$apiParameters = [
    'id' => [
        'type' => 'string',
        'location' => 'uri',
        'required' => true,
    ],
    'createdAt' => [
        'type' => 'integer',
        'format' => 'date-time',
        'location' => 'json',
        'required' => false,
    ],
    'updatedAt' => [
        'type' => 'integer',
        'format' => 'date-time',
        'location' => 'json',
        'required' => false,
    ],
    'endPoint' => [
        'type' => 'string',
        'location' => 'json',
        'required' => false,
        'description' => 'required when creating an api, not required when updating'
    ],
    'protocol' => [
        'type' => 'string',
        'location' => 'json',
        'enum' => ['http', 'https'],
        'default' => 'http',
        'required' => false,
    ],
    'tokenSkewProtectionCount' => [
        'type' => 'integer',
        'location' => 'json',
        'default' => 3,
        'required' => false,
    ],
    'apiFormat' => [
        'type' => 'string',
        'location' => 'json',
        'enum' => ['json', 'xml'],
        'default' => 'json',
        'required' => false,
    ],
    'endPointTimeout' => [
        'type' => 'integer',
        'location' => 'json',
        'default' => 2,
        'required' => false,
    ],
    'extractKeyRegex' => [
        'type' => 'string',
        'location' => 'json',
        'required' => false,
    ],
    'defaultPath' => [
        'type' => 'string',
        'location' => 'json',
        'required' => false,
    ],
    'disabled' => [
        'type' => 'boolean',
        'location' => 'json',
        'default' => false,
        'required' => false,
    ],
    'strictSSL' => [
        'type' => 'boolean',
        'location' => 'json',
        'default' => true,
        'required' => false,
    ],
    'sendThroughApiKey' => [
        'type' => 'boolean',
        'location' => 'json',
        'default' => false,
        'required' => false,
    ],
    'sendThroughApiSig' => [
        'type' => 'boolean',
        'location' => 'json',
        'default' => false,
        'required' => false,
    ],
    'hasCapturePaths' => [
        'type' => 'boolean',
        'location' => 'json',
        'default' => false,
        'required' => false,
    ],
    'allowKeylessUse' => [
        'type' => 'boolean',
        'location' => 'json',
        'default' => false,
        'required' => false,
    ],
    'keylessQps' => [
        'type' => 'integer',
        'location' => 'json',
        'default' => 2,
        'required' => false,
    ],
    'keylessQpd' => [
        'type' => 'integer',
        'location' => 'json',
        'default' => 172800,
        'required' => false,
    ],
    'additionalHeaders' => [
        'type' => 'string',
        'location' => 'json',
        'required' => false,
    ],
];

return [
    'operations' => [
        'List' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/apis',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
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
            'uri' => '/{ApiVersion}/api/{id}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
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
            'uri' => '/{ApiVersion}/api/{id}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
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
            'uri' => '/{ApiVersion}/api/{id}',
            'responseModel' => 'Generic',
            'parameters' => array_merge(
                [
                    'ApiVersion' => [
                        'required' => false,
                        'type'     => 'string',
                        'location' => 'uri',
                        'default' => $defaultApiVersion,
                    ]
                ],
                $apiParameters
            ),
        ],

        'Update' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/api/{id}',
            'responseModel' => 'Generic',
            'parameters' => array_merge(
                [
                    'ApiVersion' => [
                        'required' => false,
                        'type'     => 'string',
                        'location' => 'uri',
                        'default' => $defaultApiVersion,
                    ]
                ],
                $apiParameters
            ),
        ],

        'AddCapturePath' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/api/{id}/addcapturepath/{path}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'path' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],

            ]
        ],

        'DeleteCapturePath' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/api/{id}/delcapturepath/{path}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'path' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],

            ]
        ],

        'ListCapturePaths' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/api/{id}/capturepaths',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
            ]
        ],

        'GetCapturePathStatsCounters' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/api/{id}/capturepath/{path}/stats/counters',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'path' => [
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
                'forkeyring' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],

        'GetAllCapturePathStatsCounters' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/api/{id}/capturepaths/stats/counters',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'path' => [
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
                'forkeyring' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],

        'GetCapturePathStatsTimers' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/api/{id}/capturepath/{path}/stats/timers',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'path' => [
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
            ],
        ],

        'GetAllCapturePathStatsTimers' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/api/{id}/capturepaths/stats/timers',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'path' => [
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
            ],
        ],

        'GetKeyCharts' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/api/{id}/keycharts',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'path' => [
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
            ]
        ],

        'ListKeys' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/api/{id}/keys',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
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
                'resolve' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'query',
                ],
            ]
        ],

        'LinkKey' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/api/{id}/linkkey/{key}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'key' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
            ]
        ],

        'UnlinkKey' => [
            'httpMethod' => 'PUT',
            'uri' => '/{ApiVersion}/api/{id}/unlinkkey/{key}',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
                'id' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
                'key' => [
                    'required' => true,
                    'type'     => 'string',
                    'location' => 'uri',
                ],
            ]
        ],

        'GetStats' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/api/{id}/stats',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
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
                'forkeyring' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                ],
            ],
        ],

        'GetStatsTimers' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/api/{id}/stats/timers',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
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
                'format_timestamp' => [
                    'required' => false,
                    'type' => 'string',
                    'location' => 'query',
                    'enum' => ['epoch_seconds', 'epoch_milliseconds', 'ISO'],
                ],
                'debug' => [
                    'required' => false,
                    'type' => 'boolean',
                    'location' => 'query',
                ],
            ],
        ],

        'GetCharts' => [
            'httpMethod' => 'GET',
            'uri' => '/{ApiVersion}/apis/charts',
            'responseModel' => 'Generic',
            'parameters' => [
                'ApiVersion' => [
                    'required' => false,
                    'type'     => 'string',
                    'location' => 'uri',
                    'default' => $defaultApiVersion,
                ],
            ],
        ],

    ],
];
