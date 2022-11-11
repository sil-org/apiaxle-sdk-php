<?php

namespace ApiaxleTests;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;

class MockResponder
{

    public $wantMethod;
    public $wantPath;
    public $wantBody;
    public $wantParams;

    public function __construct($wantMethod, $wantPath, $wantBody='', $wantParams='api_key=abc123') {
        $this->wantMethod = $wantMethod;
        $this->wantPath = $wantPath;
        $this->wantBody = $wantBody;
        $this->wantParams = $wantParams;
    }

    private static function checkRequest($request, $wantMethod, $wantPath, $wantBody, $wantParams) {
        $failTemplate = 'Incorrect %s. ' . PHP_EOL . '  Expected: %s' . PHP_EOL . '   but got: %s';
        $method = $request->getMethod();
        if ($method != $wantMethod) {
            throw new \Exception(sprintf($failTemplate, 'http method', $wantMethod, $method));
        }

        $uri = $request->getUri();
        $path = $uri->getPath();
        if ($path != $wantPath) {
            throw new \Exception(sprintf($failTemplate, 'uri path', $wantPath, $path));
        }

        $qsParams = $uri->getQuery();
        if ($qsParams != $wantParams) {
            throw new \Exception(sprintf($failTemplate, 'query string params', $wantParams, $qsParams));
        }

        $body = $request->getBody();
        if ($body != $wantBody) {
            throw new \Exception(sprintf($failTemplate, 'body', $wantBody, $body));
        }

        if ($method != 'POST' && $method != 'PUT') {
            return;
        }

        $headers = $request->getHeaders();
        if (!isset($headers['Content-Type'])) {
            throw new \Exception(sprintf('Content-Type header is missing on a %s request', $method));
        }

        $cType = $headers['Content-Type']; // nested array
        $want = 'application/json';
        if (count($cType) < 1) {
            throw new \Exception(sprintf($failTemplate, 'Content-Type header', $want, $cType));
        }

        if ($cType[0] != $want) {
            throw new \Exception(sprintf($failTemplate, 'Content-Type header', $want, $cType[0]));
        }
    }

    public function getResponse($mockBody)
    {
        $mockResponse = new Response(200, [], $mockBody);

        $method = $this->wantMethod;
        $path = $this->wantPath;
        $body = $this->wantBody;
        $params = $this->wantParams;

        return static function (RequestInterface $request, array $options) use (
            $mockResponse, $method, $path, $body, $params) {
            self::checkRequest($request, $method, $path, $body, $params);
            return $mockResponse;
        };
    }
}