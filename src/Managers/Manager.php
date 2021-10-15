<?php

/**
 * @noinspection PhpMissingFieldTypeInspection
 */

namespace Oilstone\Logging\Managers;

use Monolog\Logger;
use Throwable;

/**
 * Class Manager
 * @package Oilstone\Logging\Managers
 */
class Manager
{
    /**
     * @var Logger
     */
    protected Logger $logger;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $handlers;

    /**
     * @var array
     */
    protected $processors;

    /**
     * Manager constructor.
     * @param array $config
     * @param array $handlers
     * @param array $processors
     */
    public function __construct(array $config = [], array $handlers = [], array $processors = [])
    {
        $this->config = $config;

        $this->handlers = $handlers;

        $this->processors = $processors;

        $this->logger = new Logger($config['logger_name'] ?? 'default');

        foreach ($handlers as $handler) {
            $this->addHandler($handler);
        }

        foreach ($processors as $processor) {
            $this->addProcessor($processor);
        }
    }

    /**
     * @param $class
     */
    public function addHandler($class): void
    {
        if (is_string($class)) {
            $class = new $class($this->config);
        }

        $this->logger->pushHandler($class);
    }

    /**
     * @param object|callable|string $class
     */
    public function addProcessor($class): void
    {
        if (is_string($class)) {
            $class = new $class();
        }

        $this->logger->pushProcessor($class);
    }

    /**
     * @return Logger
     */
    public function logger(): Logger
    {
        return $this->logger;
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function alert(string $message, array $context = []): void
    {
        $this->log('alert', $message, $context);
    }

    /**
     * @param $level
     * @param string $message
     * @param array $context
     */
    public function log($level, string $message, array $context = []): void
    {
        try {
            $this->logger->log($level, $message, $context);
        } catch (Throwable $e) {
            //
        }
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function critical(string $message, array $context = []): void
    {
        $this->log('critical', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function debug(string $message, array $context = []): void
    {
        $this->log('debug', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function emergency(string $message, array $context = []): void
    {
        $this->log('emergency', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function error(string $message, array $context = []): void
    {
        $this->log('error', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function info(string $message, array $context = []): void
    {
        $this->log('info', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function notice(string $message, array $context = []): void
    {
        $this->log('notice', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function warning(string $message, array $context = []): void
    {
        $this->log('warning', $message, $context);
    }
}
