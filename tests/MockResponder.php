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
        $failTemplate = 'Incorrect %s. Expected: %s, but got: %s';
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