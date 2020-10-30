<?php

/**
 * @noinspection PhpUndefinedClassInspection
 * @noinspection PhpUndefinedNamespaceInspection
 * @noinspection PhpUndefinedMethodInspection
 */

namespace Oilstone\Logging\Integrations\Laravel\Formatters;

use Illuminate\Log\Logger;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;
use Oilstone\Logging\Processors\RequestIdProcessor;

/**
 * Class ApiRequest
 * @package Oilstone\Logging\Integrations\Laravel\Formatters
 */
class ApiRequest
{
    /**
     * Customize the given logger instance.
     *
     * @param Logger $logger
     * @return void
     */
    public function __invoke(Logger $logger)
    {
        $logger->pushProcessor(new RequestIdProcessor);
        $logger->pushProcessor(new UidProcessor);
        $logger->pushProcessor(new ProcessIdProcessor);
        $logger->pushProcessor(new WebProcessor);
    }
}