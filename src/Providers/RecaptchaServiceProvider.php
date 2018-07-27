<?php

namespace Scaffold\Recaptcha\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class RecaptchaServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/recaptcha.php' => config_path('recaptcha.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/recaptcha.php', 'recaptcha'
        );

        $class = config('recaptcha.class');

        $this->app->singleton($class, function () use ($class) {
            return new $class();
        });

        $this->app->alias($class, 'recaptcha');

        $aliasLoader = AliasLoader::getInstance();
        $aliasLoader->alias('Recaptcha', 'Scaffold\Recaptcha\Facades\Recaptcha');
    }
}
