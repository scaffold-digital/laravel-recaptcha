<?php

namespace Scaffold\Recaptcha\Tests;

use Scaffold\Recaptcha\Recaptcha;

class RecaptchaTest extends TestCase {

    public function getWidgetData()
    {
        return [
            ['YLnhkMao9OMf4v4jIrwjWsdWFtaK2P6KhSZ3yXuD', '<div class="g-recaptcha" data-sitekey="YLnhkMao9OMf4v4jIrwjWsdWFtaK2P6KhSZ3yXuD"></div>'],
            ['Eo7miXTmpRD4yndj70bE3iwXmkaH43Cz9dkiS1zV', '<div class="g-recaptcha" data-sitekey="Eo7miXTmpRD4yndj70bE3iwXmkaH43Cz9dkiS1zV"></div>'],
            ['Z4gtb4VXimiDUEomlfKwXPxNr3paYomIVq0WzkQJ', '<div class="g-recaptcha" data-sitekey="Z4gtb4VXimiDUEomlfKwXPxNr3paYomIVq0WzkQJ"></div>'],
            ['jwKwcS2tQVb6svhL0302zbTzJo4J5LxbbjQL0VmO', '<div class="g-recaptcha" data-sitekey="jwKwcS2tQVb6svhL0302zbTzJo4J5LxbbjQL0VmO"></div>'],
            ['lBsRqQmRELiddHgnjPbfOb3OpSP7bFdW0Ka8qyR8', '<div class="g-recaptcha" data-sitekey="lBsRqQmRELiddHgnjPbfOb3OpSP7bFdW0Ka8qyR8"></div>'],
            ['fiQBsJDDx3SnRF86s2wuIoqDhidlQ7cPDF7cix5c', '<div class="g-recaptcha" data-sitekey="fiQBsJDDx3SnRF86s2wuIoqDhidlQ7cPDF7cix5c"></div>'],
            ['aFJFVafpjs7QjO1jLJieyTFZ07P04aYXVAcVgN5M', '<div class="g-recaptcha" data-sitekey="aFJFVafpjs7QjO1jLJieyTFZ07P04aYXVAcVgN5M"></div>'],
            ['fcNMzRDPWi3iw23viPnf3fUq42ySFEWngha6PHzv', '<div class="g-recaptcha" data-sitekey="fcNMzRDPWi3iw23viPnf3fUq42ySFEWngha6PHzv"></div>'],
            ['vzPXrTa1Fc7P1wLxyU9lKhceS8GIv5W6lfuzoTew', '<div class="g-recaptcha" data-sitekey="vzPXrTa1Fc7P1wLxyU9lKhceS8GIv5W6lfuzoTew"></div>'],
            ['R27yn9kY58KVCsBUruG9kgWJTH9gEGPTqi7vluta', '<div class="g-recaptcha" data-sitekey="R27yn9kY58KVCsBUruG9kgWJTH9gEGPTqi7vluta"></div>'],
        ];
    }

    public function testConstructor()
    {
        $key = str_random(40);
        $secret = str_random(40);

        $recaptcha = new Recaptcha();

        $this->assertEmpty($recaptcha->getKey());
        $this->assertEmpty($recaptcha->getSecret());

        $recaptcha = new Recaptcha($key);

        $this->assertEquals($recaptcha->getKey(), $key);
        $this->assertEmpty($recaptcha->getSecret());

        $recaptcha = new Recaptcha($key, $secret);

        $this->assertEquals($recaptcha->getKey(), $key);
        $this->assertEquals($recaptcha->getSecret(), $secret);
    }

    public function testGetScript()
    {
        $recaptcha = new Recaptcha();
        $this->assertEquals('<script src="https://www.google.com/recaptcha/api.js"></script>', $recaptcha->getScript());
    }

    /**
     * @dataProvider getWidgetData
     */
    public function testGetWidget($key, $result)
    {
        $recaptcha = new Recaptcha($key);
        $this->assertEquals($result, $recaptcha->getWidget());
    }

    public function testHelperFunction()
    {
        $this->assertInstanceOf(Recaptcha::class, recaptcha());
    }

    public function testKeyMethods()
    {
        $recaptcha = new Recaptcha();

        $key = str_random(40);
        $this->assertNotEquals($recaptcha->getKey(), $key);

        $recaptcha->setKey($key);
        $this->assertEquals($recaptcha->getKey(), $key);
    }

    public function testSecretMethods()
    {
        $recaptcha = new Recaptcha();

        $secret = str_random(40);
        $this->assertNotEquals($recaptcha->getSecret(), $secret);

        $recaptcha->setSecret($secret);
        $this->assertEquals($recaptcha->getSecret(), $secret);
    }

    public function testVerifyMethod()
    {
        $secret = str_random(40);

        $recaptcha = new Recaptcha();
        $this->assertFalse($recaptcha->verify($secret));

        $recaptcha->setKey($this->testKey);
        $recaptcha->setSecret($this->testSecret);
        $this->assertTrue($recaptcha->verify($secret));
    }

    public function testSingleton()
    {
        $recaptcha = recaptcha();
        $config = config('recaptcha');

        $this->assertEquals($config['key'], $recaptcha->getKey());
        $this->assertEquals($config['secret'], $recaptcha->getSecret());
    }

}
