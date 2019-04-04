<?php

namespace Oilstone\Logging;

use Illuminate\Support\Str;
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
class Log
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
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        if (static::instance()) {
            $name = Str::after(Str::snake($name), 'is_');

            return static::instance()->{$name}(...$arguments);
        }

        return null;
    }

    /**
     * @return object
     */
    public static function instance()
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
     * Make the current object a global instance
     */
    public function setAsGlobal()
    {
        static::$instance = $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ($this->enabled()) {
            return $this->logger->{$name}(...$arguments);
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
}