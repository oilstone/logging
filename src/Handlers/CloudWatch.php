<?php

namespace Oilstone\Logging\Handlers;

use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Exception;
use Maxbanton\Cwh\Handler\CloudWatch as BaseHandler;
use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;

/**
 * Class CloudWatch
 * @package Oilstone\Logging\Handlers
 */
class CloudWatch extends BaseHandler
{
    /**
     * CloudWatch constructor.
     * @param array $config
     * @throws Exception
     * @example new CloudWatch(['group_name' => 'php-logtest', 'streamName' => 'ec2-instance-1', 'sdk' => ['region' => 'us-east-1', 'version' => 'latest', 'credentials' => ['key' => 'AWS_KEY', 'secret' => 'AWS_SECRET', 'token' => 'AWS session token (optional)']]]);
     */
    public function __construct(array $config = [])
    {
        parent::__construct(
            new CloudWatchLogsClient($config['sdk']),
            $config['group_name'],
            $config['stream_name'],
            $config['retention'] ?? $config['max_files'] ?? 0,
            $config['batch_size'] ?? 10000,
            $config['tags'] ?? [],
            Logger::toMonologLevel($config['level'] ?? 'warning')
        );

        $this->setFormatter(new JsonFormatter());
    }
}