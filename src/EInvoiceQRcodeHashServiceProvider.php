<?php

namespace Elliot9\EInvoiceQRcodeHash;
use Illuminate\Support\ServiceProvider;

class EInvoiceQRcodeHashServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php', 'EIN');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php' => config_path('EIN.php'),
            ], 'config');
        }

        $HASH_KEY = $this->app->config['EIN.HASH_KEY'];
        if (! $HASH_KEY) {
            return;
        }

        $this->app->singleton('QRcodeHash', function($app) use ($HASH_KEY){
            return new QRcodeHash($HASH_KEY);
        });
    }
}
