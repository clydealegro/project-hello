<?php

namespace FundMyTravel\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    private $user;

    protected function setUp()
    {
        $this->user  = new User();
    }

    public function testSetterGetterMethods()
    {
        $this->assertNull($this->user->getId());

        $emailAddress = 'dummy@user.com';
        $this->user->setEmailAddress($emailAddress);
        $this->assertEquals($emailAddress, $this->user->getEmailAddress());

        $password = 'password';
        $this->user->setPassword($password);
        $this->assertEquals($password, $this->user->getPassword());

        $dateRegistered = new \DateTime('+1 month');
        $this->user->setDateRegistered($dateRegistered);
        $this->assertSame($dateRegistered, $this->user->getDateRegistered());

        // test is verified
    }

    protected function tearDown()
    {
        $this->user = null;
    }
}