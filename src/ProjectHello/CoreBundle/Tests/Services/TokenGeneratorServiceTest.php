<?php

namespace ProjectHello\CoreBundle\Tests\Services;

use ProjectHello\CoreBundle\Services\TokenGeneratorService;

class TokenGeneratorServiceTest extends \PHPUnit_Framework_TestCase
{
    private $generator;

    protected function setUp()
    {
        $this->generator = new TokenGeneratorService();
    }

    public function testGetEncryptedAndDecryptedToken()
    {
        $parameters = array(
            'emailAddress'  => 'email@dummy.com',
            'password'      => 'mypassword'
        );

        $encryptedToken = $this->generator->getEncryptedToken($parameters);
        $decryptedString = $this->generator->getDecryptedToken($encryptedToken);

        $this->assertEquals('emailAddress=email@dummy.com&password=mypassword', $decryptedString);
    }

    protected function tearDown()
    {
        $this->generator = null;
    }
}