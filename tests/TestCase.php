<?php

namespace Scaffold\Recaptcha\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Scaffold\Recaptcha\Providers\RecaptchaServiceProvider::class
        ];
    }

}
