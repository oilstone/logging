<?php

/**
 * @noinspection PhpMissingFieldTypeInspection
 */

namespace Oilstone\Logging\Processors;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

/**
 * Class RequestIdProcessor
 * @package Oilstone\Logging\Processors
 */
class RequestIdProcessor implements ProcessorInterface
{
    /**
     * @var string
     */
    protected static $requestId;

    /**
     * @param array $record
     * @return array
     */
    public function __invoke(LogRecord $record)
    {
        if (!isset(static::$requestId)) {
            static::$requestId = uniqid();
        }

        $record['extra']['request_id'] = static::$requestId;

        return $record;
    }
}
