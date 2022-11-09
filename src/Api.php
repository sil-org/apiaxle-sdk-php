<?php
namespace Apiaxle;

/**
 * @method array list(array $config = [])
 * @method array delete(array $config = [])
 * @method array get(array $config = [])
 * @method array create(array $config = [])
 * @method array update(array $config = [])
 * @method array addCapturePath(array $config = [])
 * @method array deleteCapturePath(array $config = [])
 * @method array listCapturePaths(array $config = [])
 * @method array getCapturePathStatsCounters(array $config = [])
 * @method array getAllCapturePathStatsCounters(array $config = [])
 * @method array getCapturePathStatsTimers(array $config = [])
 * @method array getAllCapturePathStatsTimers(array $config = [])
 * @method array getKeyCharts(array $config = [])
 * @method array listKeys(array $config = [])
 * @method array linkKey(array $config = [])
 * @method array unlinkKey(array $config = [])
 * @method array getStats(array $config = [])
 * @method array getStatsTimers(array $config = [])
 * @method array getCharts(array $config = [])
 */
class Api extends BaseClient
{
    /**
     * @param array $config
     * @param GuzzleHttp\Handler\MockHandler $mock [default=null]
     */
    public function __construct(array $config = [], $mock = null)
    {
        // Apply some defaults.
        $config += [
            'description_path' => __DIR__ . '/descriptions/api.php',
        ];

        // Create the client.
        parent::__construct(
            $config,
            $mock
        );

    }
}