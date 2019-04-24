<?php

/** @noinspection PhpUndefinedFunctionInspection */

namespace Oilstone\Logging\Integrations\Laravel;

use Illuminate\Support\Facades\Log as AppLog;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Oilstone\Logging\Log;

/**
 * Class ServiceProvider
 * @package Oilstone\Logging\Integrations\Laravel
 */
class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $log = new Log(AppLog::getFacadeRoot());

        $log->enable()->setAsGlobal();
    }
}