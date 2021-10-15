<?php

/**
 * @noinspection PhpUnused
 */

namespace Oilstone\Logging;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Oilstone\Logging\Managers\Manager;
use Throwable;

/**
 * Class Log
 * @method static void alert(string $message, array $context = []) Action must be taken immediately.
 * @method static void critical(string $message, array $context = []) Critical conditions.
 * @method static void debug(string $message, array $context = []) Detailed debug information.
 * @method static void emergency(string $message, array $context = []) System is unusable.
 * @method static void error(string $message, array $context = []) Runtime errors that do not require immediate action but should typically be logged and monitored.
 * @method static void info(string $message, array $context = []) Interesting events.
 * @method static void log($level, string $message, array $context = []) Logs with an arbitrary level.
 * @method static void notice(string $message, array $context = []) Normal but significant events.
 * @method static void warning(string $message, array $context = []) Exceptional occurrences that are not errors.
 * @package Oilstone\Logging
 */
class Log
{
    /**
     * @var string
     */
    protected static string $defaultInstanceBinding = 'log';

    /**
     * @param $name
     * @param $arguments
     * @return mixed|null
     */
    public static function __callStatic($name, $arguments)
    {
        try {
            if ($logManager = static::instance()) {
                return $logManager->{$name}(...$arguments);
            }
        } catch (Throwable $e) {
            //
        }

        return null;
    }

    /**
     * @param string|null $binding
     * @return Manager|object|null
     */
    public static function instance(?string $binding = null)
    {
        if (is_null($binding)) {
            $binding = static::$defaultInstanceBinding;
        }

        try {
            return Container::getInstance()->make($binding);
        } catch (BindingResolutionException $e) {
            return null;
        }
    }

    /**
     * @param string $defaultInstanceBinding
     */
    public static function setDefaultInstanceBinding(string $defaultInstanceBinding): void
    {
        self::$defaultInstanceBinding = $defaultInstanceBinding;
    }
}
