<?php

namespace FundMyTravel\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Entity\Message;

class MessageTest extends \PHPUnit_Framework_TestCase
{
    private $message;

    protected function setUp()
    {
        $this->message  = new Message();
    }

    public function testSetterGetterMethods()
    {
        $this->assertNull($this->message->getId());

        $content = 'content';
        $this->message->setContent($content);
        $this->assertEquals($content, $this->message->getContent());

        $today = new \DateTime('now');
        $this->assertEquals($today, $this->message->getDateCreated());

        $dateCreated = new \DateTime('-1 day');
        $this->message->setDateCreated($dateCreated);
        $this->assertSame($dateCreated, $this->message->getDateCreated());

        $card = $this->getMock('ProjectHello\CoreBundle\Entity\Card');
        $this->message->setCard($card);
        $this->assertSame($card, $this->message->getCard());

        $author = $this->getMock('ProjectHello\CoreBundle\Entity\MessageAuthor');
        $this->message->setAuthor($author);
        $this->assertSame($author, $this->message->getAuthor());
    }

    protected function tearDown()
    {
        $this->message = null;
    }
}