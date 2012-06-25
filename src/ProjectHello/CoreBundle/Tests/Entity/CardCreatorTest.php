<?php

namespace FundMyTravel\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Entity\CardCreator;

class CardCreatorTest extends \PHPUnit_Framework_TestCase
{
    private $creator;

    protected function setUp()
    {
        $this->creator = new CardCreator();
    }

    public function testSetterGetterMethods()
    {
        $this->assertNull($this->creator->getId());

        $name = 'Dummy User';
        $this->creator->setName($name);
        $this->assertEquals($name, $this->creator->getName());

        $emailAddress = 'dummy@user.com';
        $this->creator->setEmailAddress($emailAddress);
        $this->assertEquals($emailAddress, $this->creator->getEmailAddress());

        $password = 'password';
        $this->creator->setPassword($password);
        $this->assertEquals($password, $this->creator->getPassword());

        $today = new \DateTime('now');
        $this->assertEquals($today, $this->creator->getDateRegistered());

        $dateRegistered = new \DateTime('-2 day');
        $this->creator->setDateRegistered($dateRegistered);
        $this->assertSame($dateRegistered, $this->creator->getDateRegistered());
    }

    protected function tearDown()
    {
        $this->creator = null;
    }
}