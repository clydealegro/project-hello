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
        $this->message->setMessage($content);
        $this->assertEquals($content, $this->message->getMessage());

        $card = $this->getMock('ProjectHello\CoreBundle\Entity\Card');
        $this->message->setCard($card);
        $this->assertSame($card, $this->message->getCard());

        $author = $this->getMock('ProjectHello\CoreBundle\Entity\User');
        $this->message->setAuthor($author);
        $this->assertSame($author, $this->message->getAuthor());

        $authorName = 'Dummy Author';
        $this->message->setAuthorName($authorName);
        $this->assertEquals($authorName, $this->message->getAuthorName());
    }

    protected function tearDown()
    {
        $this->message = null;
    }
}