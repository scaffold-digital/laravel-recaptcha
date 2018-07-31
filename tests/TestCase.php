<?php

namespace Scaffold\Recaptcha\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * With the following test keys, you will always get No CAPTCHA and all verification requests will pass.
     */
    protected $testKey = '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
    protected $testSecret = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

    protected function getPackageProviders($app)
    {
        return [
            \Scaffold\Recaptcha\Providers\RecaptchaServiceProvider::class
        ];
    }

}
