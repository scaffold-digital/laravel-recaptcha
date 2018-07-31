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

    protected function post($url, $data = [])
    {
        $content = http_build_query($data);

        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'Content-Length: ' . strlen($content)
        ];

        $options = [
            'http' => [
                'header' => implode("\r\n", $headers),
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        return json_decode($response);
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
