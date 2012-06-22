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

        $firstName = 'Dummy';
        $this->user->setFirstName($firstName);
        $this->assertEquals($firstName, $this->user->getFirstName());

        $lastName = 'User';
        $this->user->setLastName($lastName);
        $this->assertEquals($lastName, $this->user->getLastName());

        $emailAddress = 'dummy@user.com';
        $this->user->setEmailAddress($emailAddress);
        $this->assertEquals($emailAddress, $this->user->getEmailAddress());
    }

    protected function tearDown()
    {
        $this->user = null;
    }
}