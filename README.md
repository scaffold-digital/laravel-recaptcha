# Laravel Recaptcha

This module is an easy to use implementation of the Google reCAPTCHA widget.

## Getting Started

To use this package, simply install with Composer. Once installed, you'll need to specify your site key and secret key (from https://www.google.com/recaptcha/admin) and then follow a couple of simple steps to add the recaptcha widget to your view and verify the response.

### Installing via Composer
To install the module, simply run the following command in your project directory...
```
composer require scaffold-digital/laravel-recaptcha
```
### Setting up your keys
Once you retrieved your site key and secret key (from https://www.google.com/recaptcha/admin), you'll need to specify them in a config file.

#### Basic configuration
For the most basic configuration, create the file "`config/recaptcha.php`" and paste the following contents, changing the keys accordingly...
```php
<?php
return [
    'key' => 'YOUR SITE KEY',
    'secret' => 'YOUR SECRET KEY',
];
```
#### Advanced configuration
If you'd like to extend the Recaptcha feature further, you can do so easily by publishing the full configuration and modifying it accordingly. Running the following command will allow you to publish the full configuration to your config directory.
```
php artisan vendor:publish
```

### Displaying the reCAPTCHA widget
In order to display the reCAPTCHA widget in your view, you'll need to include an additional piece of Javascript and a DOM element. Both of these are available through the Recaptcha class.

#### The Javascript
Simply add `{!! Recaptcha::getScript(); !!}` just before the closing `<head>` tag:
```Blade
<head>
...
{!! Recaptcha::getScript(); !!}
</head>
```
#### The Widget
Just add `{!! Recaptcha::getWidget(); !!}` wherever you'd like to display the widget in your form. For example:
```Blade
<body>
...
<form method="POST">
<div class="form-group">{!! Recaptcha::getWidget(); !!}</div>
</form>
...
</body>
```

### Validating the reCAPTCHA response
You have two straightforward options to validate the reCAPTCHA response. This can be done manually at any point or automatically as part of Laravel's built-in form validation.

#### Automatic Form Validation
This package automatically creates a new validation type for 'recaptcha' that you can use to validate the form response. When the form is submitted, reCAPTCHA uses the field 'g-recaptcha-response' to provide the response. For example:
```php
$validator = Validator::make($request->all(), [
    'g-recaptcha-response' => 'recaptcha'
]);
```

#### Manual Validation
If for whatever reason you'd like to validate the reCAPTCHA response manually, you can do so simply by calling the `verify` method. For example:
```php
$valid = Recaptcha::verify($request->input('g-recaptcha-response'));
```
