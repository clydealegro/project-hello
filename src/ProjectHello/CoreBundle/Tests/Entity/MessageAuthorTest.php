<?php

namespace FundMyTravel\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Entity\MessageAuthor;

class MessageAuthorTest extends \PHPUnit_Framework_TestCase
{
    private $author;

    protected function setUp()
    {
        $this->author = new MessageAuthor();
    }

    public function testSetterGetterMethods()
    {
        $this->assertNull($this->author->getId());

        $firstName = 'Dummy';
        $this->author->setFirstName($firstName);
        $this->assertEquals($firstName, $this->author->getFirstName());

        $lastName = 'User';
        $this->author->setLastName($lastName);
        $this->assertEquals($lastName, $this->author->getLastName());

        $emailAddress = 'dummy@user.com';
        $this->author->setEmailAddress($emailAddress);
        $this->assertEquals($emailAddress, $this->author->getEmailAddress());

        $this->assertFalse($this->author->isVerified());

        $this->author->setIsVerified(true);
        $this->assertTrue($this->author->isVerified());
    }

    protected function tearDown()
    {
        $this->author = null;
    }
}