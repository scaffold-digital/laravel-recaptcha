<?php
namespace Scaffold\Recaptcha;

class Recaptcha {

    private $key = '';
    private $secret = '';

    protected $url = 'https://www.google.com/recaptcha/api/siteverify';

    public function __construct($key = '', $secret = '')
    {
        $this->setKey($key);
        $this->setSecret($secret);
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getScript()
    {
        return '<script src="https://www.google.com/recaptcha/api.js"></script>';
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function getWidget()
    {
        return sprintf('<div class="g-recaptcha" data-sitekey="%s"></div>', $this->key);
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    public function verify($response, $remoteIp = null)
    {
        $data = [
            'secret' => $this->secret,
            'response' => $response
        ];

        if ($remoteIp) $data['remoteip'] = $remoteIp;

        try {
            $response = $this->post($this->url, $data);
            return $response->success;
        } catch (\Exception $e) {
            return false;
        }
    }
}
