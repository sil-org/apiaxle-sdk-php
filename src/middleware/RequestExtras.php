<?php

namespace Apiaxle\middleware;


use CalcApiSig\HmacSigner;

use GuzzleHttp\Psr7;
use Psr\Http\Message\RequestInterface;


class RequestExtras
{
    const DEFAULTSKEY = 'defaults';
    const AUTHKEY = 'auth';

    // Add Content-Type header to all POST and PUT requests
    public static function getAddContentTypeFn($contentType)
    {
        return static function (callable $handler) use ($contentType) {
            return static function (RequestInterface $request, array $options) use ($handler, $contentType) {
                $reqMeth = $request->getMethod();
                if ($reqMeth == 'POST' || $reqMeth == 'PUT') {
                    $request = $request->withHeader('Content-Type', $contentType);
                }
                return $handler($request, $options);
            };
        };
    }

    // Ensure there is at least an empty body on all POST and PUT requests
    public static function getEnsureBodyFn()
    {
        return static function (callable $handler) {
            return static function (RequestInterface $request, array $options) use ($handler) {
                $reqMeth = $request->getMethod();
                if ($reqMeth != 'POST' && $reqMeth != 'PUT') {
                    return $handler($request, $options);
                }

                $stream = $request->getBody();
                $contents = $stream->getContents();
                $stream->rewind(); // Just to make sure the body is available later on
                if (!$contents) {
                    $request = $request->withBody(Psr7\Utils::streamFor('{}'));
                }
                return $handler($request, $options);
            };
        };
    }

    // Remove Authorization header and add params for api_key and api_sig
    public static function getAddAuthParamsFn($config)
    {
        return static function (callable $handler) use ($config) {
            return static function (RequestInterface $request, array $options) use ($handler, $config) {
                $request = self::addAuthParams($request, $config);
                return $handler($request, $options);
            };
        };
    }

    
    private static function addAuthParams(RequestInterface $request, array $options)
    {
        list($key, $secret) = self::getAuthKeySecret($options);

        /*
         * Make sure key/secret do not stay in auth headers
         */
        $request = $request->withoutHeader('Authorization');
        $uri = $request->getUri();

        $qs = $uri->getQuery();
        parse_str(parse_url("?$qs", PHP_URL_QUERY), $params);


        /*
         * Add request params for key and secret if needed
         */
        $params['api_key'] = $key;
        unset($params['api_sig']);

        /*
         * Calculate signature if secret is present
         */
        if ($secret !== null) {
            $signature = HmacSigner::CalcApiSig($key, $secret);
            $params['api_sig'] = $signature;
        }

        $qs = http_build_query($params);
        $uri = $uri->withQuery($qs);
        return $request->withUri($uri);
    }


    private static function getAuthKeySecret(array $options) {
        // If there is a specific auth entry, use it
        if (isset( $options[self::AUTHKEY])) {
            $auth = $options[self::AUTHKEY];
            if (! self::countAtLeast($auth, 1)) {
                throw new \Exception('Middleware client options have an invalid \'auth\' array.', 1666607090);
            }

            // If there is no specific auth entry, use the default
        } else {
            if (!isset($options[self::DEFAULTSKEY][self::AUTHKEY]) ||
                ! self::countAtLeast($options[self::DEFAULTSKEY][self::AUTHKEY], 1)) {
                throw new \Exception('Middleware client options have an invalid \'defaults=>auth\' array.', 1666607095);
            }

            $auth = $options[self::DEFAULTSKEY][self::AUTHKEY];
        }

        $key = $auth[0];
        $secret = isset($auth[1]) ? $auth[1] : null;
        return [$key, $secret];
    }


    private static function countAtLeast(array $input, $minimum){
        if (! is_array($input)) {
            return false;
        }
        return count($input) >= $minimum;
    }
}