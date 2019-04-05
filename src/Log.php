<?php

namespace Oilstone\Logging;

use Oilstone\GlobalClasses\MakeGlobal;
use Psr\Log\LoggerInterface;

/**
 * Class Log
 * @method static bool isEnabled()
 * @method static emergency($message, array $context = [])
 * @method static alert($message, array $context = [])
 * @method static critical($message, array $context = [])
 * @method static error($message, array $context = [])
 * @method static warning($message, array $context = [])
 * @method static notice($message, array $context = [])
 * @method static info($message, array $context = [])
 * @method static debug($message, array $context = [])
 * @package Oilstone\Logging
 */
class Log extends MakeGlobal
{
    /**
     * @var Log
     */
    protected static $instance;

    /**
     * @var bool
     */
    protected $enabled = false;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Log constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return Log
     */
    public static function instance(): Log
    {
        return static::$instance;
    }

    /**
     * @return Log
     */
    public function enable(): self
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * @return Log
     */
    public function disable(): self
    {
        $this->enabled = false;

        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ($this->enabled()) {
            return $this->logger()->{$name}(...$arguments);
        }

        return null;
    }

    /**
     * @return bool
     */
    public function enabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return LoggerInterface
     */
    public function logger(): LoggerInterface
    {
        return $this->logger;
    }
}