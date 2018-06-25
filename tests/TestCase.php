<?php

namespace Scaffold\Recaptcha\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $config = $app['config'];

        // $config->set('recaptcha.key', '');
        // $config->set('recaptcha.secret', '');
    }

    protected function getPackageAliases($app)
    {
        return [
            'Recaptcha' => 'Scaffold\Recaptcha\Recaptcha'
        ];
    }

    protected function getPackageProviders($app)
    {
        return [
            \Scaffold\Recaptcha\RecaptchaServiceProvider::class
        ];
    }

}
