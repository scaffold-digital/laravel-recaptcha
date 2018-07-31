<?php

namespace Scaffold\Recaptcha\Providers;

use Illuminate\Support\Facades\Validator;
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
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'recaptcha');

        $this->publishes([
            __DIR__ . '/../../config/recaptcha.php' => config_path('recaptcha.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../../lang' => resource_path('lang/vendor/recaptcha'),
        ], 'lang');

        $config = config('recaptcha.validator');

        Validator::extendImplicit(
            $config['name'],
            $config['class'] . '@validate',
            trans('recaptcha::validation.recaptcha')
        );
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

        $config = config('recaptcha');

        $this->app->singleton($config['class'], function () use ($config) {
            $instance = new $config['class']();

            $instance->setKey($config['key']);
            $instance->setSecret($config['secret']);

            return $instance;
        });

        $this->app->alias($config['class'], 'recaptcha');

        $aliasLoader = AliasLoader::getInstance();
        $aliasLoader->alias('Recaptcha', 'Scaffold\Recaptcha\Facades\Recaptcha');
    }
}
