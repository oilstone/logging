<?php

/**
 * @noinspection PhpUnused
 */

namespace Oilstone\Logging\Handlers;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

/**
 * Class DailyFile
 * @package Oilstone\Logging\Handlers
 */
class DailyFile extends RotatingFileHandler
{
    /**
     * File constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        parent::__construct(
            rtrim($config['file_path'] ?? '', '/') . '/' . ($config['file_name'] ?? 'default.log'),
            $config['max_files'] ?? 0,
            Logger::toMonologLevel($config['level'] ?? 'warning')
        );
    }
}