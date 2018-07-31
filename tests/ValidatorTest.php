<?php

namespace Scaffold\Recaptcha\Tests;

use Scaffold\Recaptcha\Facades\Recaptcha;
use Illuminate\Support\Facades\Validator;

class ValidatorTest extends TestCase {

    public function testRecaptchaValidator()
    {
        $validator = Validator::make([], [
            'g-recaptcha-response' => 'recaptcha'
        ]);

        $this->assertFalse($validator->passes());

        $validator = Validator::make([
            'g-recaptcha-response' => str_random(40)
        ], [
            'g-recaptcha-response' => 'recaptcha'
        ]);

        $this->assertFalse($validator->passes());

        Recaptcha::setKey($this->testKey);
        Recaptcha::setSecret($this->testSecret);

        $this->assertTrue($validator->passes());
    }

}
