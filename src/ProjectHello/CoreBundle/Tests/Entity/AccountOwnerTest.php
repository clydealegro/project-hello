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

        $name = 'Dummy User';
        $this->owner->setName($name);
        $this->assertEquals($name, $this->owner->getName());

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