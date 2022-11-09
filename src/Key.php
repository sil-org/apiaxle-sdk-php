<?php
namespace Apiaxle;

/**
 * @method array list(array $config = [])
 * @method array listAllKeysStats(array $config = [])
 * @method array listAllKeysCharts(array $config = [])
 * @method array delete(array $config = [])
 * @method array get(array $config = [])
 * @method array create(array $config = [])
 * @method array update(array $config = [])
 * @method array getApiCharts(array $config = [])
 * @method array listApis(array $config = [])
 * @method array getStats(array $config = [])
 */
class Key extends BaseClient
{
    /**
     * @param array $config
     * @param GuzzleHttp\Handler\MockHandler $mock [default=null]
     */
    public function __construct(array $config = [], $mock = null)
    {
        // Apply some defaults.
        $config += [
            'description_path' => __DIR__ . '/descriptions/key.php',
        ];

        // Create the client.
        parent::__construct(
            $config,
            $mock
        );

    }
}