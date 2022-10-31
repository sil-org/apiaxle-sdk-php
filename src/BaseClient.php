<?php
namespace Apiaxle;

use Apiaxle\middleware\AuthRequest;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

use Psr\Http\Message\RequestInterface;

/**
 * BaseClient class to implement common features
 */
class BaseClient extends GuzzleClient
{
    public $mock;

    /**
     * @param array $config
     * @param boolean $mockMode [default=false]
     * @throws \Exception
     */
    public function __construct(array $config = [], $mock = null)
    {
        /*
         * Check that baseUrl, key, and secret
         */
        if ( ! isset($config['baseUrl']) || ! isset($config['key'])) {
            throw new \Exception('Configuration missing baseUrl or key', 1466965269);
        }

        // Set mock middleware
        $this->mock = $mock;

        // Apply some defaults.
        $config = array_merge_recursive($config, [
            'max_retries' => 3,
            'http_client_options' => [
                'defaults' => [
                    'auth' => [
                        $config['key'],
                        isset($config['secret']) ? $config['secret'] : null
                    ],
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => '{}',
                ],
            ],
        ]);

        // If an override base url is not provided, determine proper baseurl from env
        if ( ! isset($config['description_override']['baseUrl'])) {
            $config = array_merge_recursive($config , [
                'description_override' => [
                    'baseUrl' => $config['baseUrl'],
                ],
            ]);
        }

        // Set default models path if not provided
        if ( ! isset($config['models_path'])) {
            $config['models_path'] = __DIR__ . '/descriptions/models.php';
        }

        // Create the client.
        parent::__construct(
            $this->getHttpClientFromConfig($config),
            $this->getDescriptionFromConfig($config),
            null,
            null,
            null,
            $config
        );

        // Ensure that ApiVersion is set.
        $this->setConfig(
            'defaults/ApiVersion',
            'v1'
        );

    }

    private function getHttpClientFromConfig(array $config)
    {
        // If a client was provided, return it.
        if (isset($config['http_client'])) {
            return $config['http_client'];
        }

        // Create a Guzzle HttpClient.
        $clientOptions = isset($config['http_client_options'])
            ? $config['http_client_options']
            : [];

        /*
         * Attach subscriber for adding auth headers just before request
         */
        $addAuthHeaderFn = function(RequestInterface $request, $options=[]) use ($clientOptions) {
            return AuthRequest::addAuthParams($request, $clientOptions);
        };

        /*
         * If we have a mock handler (for testing), begin with it
         */
        if (!empty($this->mock)) {
            $stack = HandlerStack::create($this->mock);
        } else {
            $stack = HandlerStack::create();
        }

        $stack->push(Middleware::mapRequest($addAuthHeaderFn));

        $clientOptions['handler'] = $stack;
        return new HttpClient($clientOptions);
    }

    private function getDescriptionFromConfig(array $config)
    {
        // If a description was provided, return it.
        if (isset($config['description'])) {
            return $config['description'];
        }

        // Load service description data.
        $data = is_readable($config['description_path'])
            ? include $config['description_path']
            : [];

        if ( ! is_array($data)) {
            throw new \Exception('Service description file must return an array', 1470529124);
        }

        // Merge in models
        $models = is_readable($config['models_path'])
            ? include $config['models_path']
            : [];

        $data = array_merge($data, $models);
        // Override description from local config if set
        if(isset($config['description_override'])){
            $data = array_merge($data, $config['description_override']);
        }

        return new Description($data);
    }

}