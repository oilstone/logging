<?php

namespace Oilstone\Logging\Integrations\Laravel\Factories;

use Exception;
use Monolog\Logger;
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
        return (new Manager($config, [CloudWatch::class]))->logger();
    }
}