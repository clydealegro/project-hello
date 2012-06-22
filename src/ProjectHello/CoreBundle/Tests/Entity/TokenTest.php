<?php

namespace FundMyTravel\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Entity\Token;

class TokenTest extends \PHPUnit_Framework_TestCase
{
    private $token;

    protected function setUp()
    {
        $this->token  = new Token();
    }

    public function testSetterGetterMethods()
    {
        $this->assertNull($this->token->getId());

        $tokenStr = 'tokenStr';
        $this->token->setTokenStr($tokenStr);
        $this->assertEquals($tokenStr, $this->token->getTokenStr());
    }

    protected function tearDown()
    {
        $this->token = null;
    }
}