<?php
return [
    /**
     * Recaptcha Site Key (Required)
     */
    'key' => 'MISSING KEY',

    /**
     * Recaptcha Secret Key (Required)
     */
    'secret' => 'MISSING SECRET',

    /**
     * The main Recaptcha class to use. If you'd like to extend this class,
     * enter the path for your derrived class here.
     */
    'class' => '\Scaffold\Recaptcha\Recaptcha',

    /**
     * The validator to use. If you'd like to extend this class,
     * enter the path for your derrived class instead.
     */
    'validator' => [
        'class' => '\Scaffold\Recaptcha\Validators\RecaptchaValidator',
        'name' => 'recaptcha',
    ]
];
