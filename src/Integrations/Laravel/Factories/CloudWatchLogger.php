<?php

namespace Oilstone\Logging\Integrations\Laravel\Factories;

use Exception;
use Monolog\Logger;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;
use Oilstone\Logging\Handlers\CloudWatch;
use Oilstone\Logging\Managers\Manager;

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
     * @throws Exception
     */
    public function __invoke(array $config)
    {
        return (new Manager($config, [
            CloudWatch::class
        ], [
            UidProcessor::class,
            ProcessIdProcessor::class,
            WebProcessor::class,
        ]))->logger();
    }
}