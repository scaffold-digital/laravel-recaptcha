<?php

if (!function_exists('recaptcha')) {
	function recaptcha()
	{
		return app('recaptcha');
	}
}
