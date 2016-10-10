# apiaxle-sdk-php
This library provides coverage for the [ApiAxle](https://apiaxle.com) API. It was built using 
[Guzzle](https://github.com/guzzle/guzzle) and 
[Guzzle Services](https://github.com/guzzle/guzzle-services) for simplicity of development and 
maintenance.

[![Coverage Status](https://coveralls.io/repos/github/silinternational/apiaxle-sdk-php/badge.svg?branch=master)](https://coveralls.io/github/silinternational/apiaxle-sdk-php?branch=master)
[![Build Status](https://travis-ci.org/silinternational/apiaxle-sdk-php.svg?branch=master)](https://travis-ci.org/silinternational/apiaxle-sdk-php)

## Installation
Install using composer:

    composer require silinternational/apiaxle-sdk-php:^1.0.0
    
## Usage
Each resource has its own class:

 - Api: `Apiaxle\Api`
 - Key: `Apiaxle\Key`
 - Keyring: `Apiaxle\Keyring`
 
For each resource you instanciate the object by passing in a configuration array with at least 
the following parameters:

 - `endpoint`: The Endpoint URL for your ApiAxle installation
 - `key`: The API Key required for authenticating with the ApiAxle API
 - `secret`: The Shared Secret required for calculating an API signature
 
Example:

```php

use Apiaxle\Api;

$client = new Api([
    'endpoint' => 'https://apiaxle.api.mydomain.com',
    'key' => 'abc123',
    'secret' => 'abcdefghijklmnopqrstuvwxyz1234567890',
]);
```

Creating an API:

```php
use Apiaxle\Api;

$client = new Api([
    'endpoint' => 'https://apiaxle.api.mydomain.com',
    'key' => 'abc123',
    'secret' => 'abcdefghijklmnopqrstuvwxyz1234567890',
]);

$api = $client->create([
    'id' => 'myapi',
    'endpoint' => 'myapiendpoint.com',
    'protocol' => 'https',
    'strictSSL' => true,
    'defaultPath' => '/api',
]);

print_r($api);
```

Output:

```
Array
(
    [statusCode] => 200
    [meta] => Array
        (
            [version] => 1
            [status_code] => 200
        )

    [results] => Array
        (
            [protocol] => https
            [apiFormat] => json
            [endPointTimeout] => 2
            [disabled] => false
            [strictSSL] => true
            [sendThroughApiKey] => false
            [sendThroughApiSig] => false
            [endPoint] => myapiendpoint.com
            [createdAt] => 1389915291013
            [tokenSkewProtectionCount] => 3
            [hasCapturePaths] => false
            [allowKeylessUse] => false
            [keylessQps] => 2
            [keylessQpd] => 172800
            [updatedAt] => 1427892638934
        )

)

```

## License
MIT License

Copyright (c) 2016 SIL International

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.