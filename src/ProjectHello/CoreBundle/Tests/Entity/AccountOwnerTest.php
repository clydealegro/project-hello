<?php

namespace FundMyTravel\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Entity\AccountOwner;

class AccountOwnerTest extends \PHPUnit_Framework_TestCase
{
    private $owner;

    protected function setUp()
    {
        $this->owner = new AccountOwner();
    }

    public function testSetterGetterMethods()
    {
        $this->assertNull($this->owner->getId());

        $firstName = 'Dummy';
        $this->owner->setFirstName($firstName);
        $this->assertEquals($firstName, $this->owner->getFirstName());

        $lastName = 'User';
        $this->owner->setLastName($lastName);
        $this->assertEquals($lastName, $this->owner->getLastName());

        $emailAddress = 'dummy@user.com';
        $this->owner->setEmailAddress($emailAddress);
        $this->assertEquals($emailAddress, $this->owner->getEmailAddress());

        $password = 'password';
        $this->owner->setPassword($password);
        $this->assertEquals($password, $this->owner->getPassword());

        $today = new \DateTime('now');
        $this->assertEquals($today, $this->owner->getDateRegistered());

        $dateRegistered = new \DateTime('-2 day');
        $this->owner->setDateRegistered($dateRegistered);
        $this->assertSame($dateRegistered, $this->owner->getDateRegistered());
    }

    protected function tearDown()
    {
        $this->owner = null;
    }
}