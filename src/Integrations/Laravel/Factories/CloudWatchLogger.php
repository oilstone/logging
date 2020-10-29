<?php

namespace Oilstone\Logging\Integrations\Laravel\Factories;

use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Exception;
use Maxbanton\Cwh\Handler\CloudWatch;
use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;

/**
 * Class CloudWatchLogger
 * @package Oilstone\Logging\Integrations\Laravel\Factories
 */
class CloudWatchLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param array $config
     * @return Logger
     * @noinspection PhpUndefinedFunctionInspection
     * @throws Exception
     */
    public function __invoke(array $config)
    {
        $client = new CloudWatchLogsClient($config['sdk']);

        $name = $config['name'] ?? 'cloudwatch';
        $groupName = $config['group_name'] ?? (config('app.name') . '-' . config('app.env'));
        $streamName = $config['stream_name'] ?? config('app.hostname');
        $retentionDays = $config['retention'] ?? $config['max_files'] ?? 0;
        $batchSize = $config['batch_size'] ?? 10000;
        $tags = $config['tags'] ?? [];

        $handler = new CloudWatch($client, $groupName, $streamName, $retentionDays, $batchSize, $tags);
        $handler->setFormatter(new JsonFormatter());

        $logger = new Logger($name);
        $logger->pushHandler($handler);

        return $logger;
    }
}