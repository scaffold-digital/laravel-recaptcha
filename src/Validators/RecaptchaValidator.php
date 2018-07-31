<?php

namespace Scaffold\Recaptcha\Validators;

use Scaffold\Recaptcha\Facades\Recaptcha;

class RecaptchaValidator
{
    public function validate($attribute, $value, $parameters)
    {
        if (empty($value)) return false;

        return Recaptcha::verify($value);
    }
}
