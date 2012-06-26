<?php

namespace FundMyTravel\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Entity\CardRecipient;

class CardRecipientTest extends \PHPUnit_Framework_TestCase
{
    private $recipient;

    protected function setUp()
    {
        $this->recipient  = new CardRecipient();
    }

    public function testSetterGetterMethods()
    {
        $this->assertNull($this->recipient->getId());

        $card = $this->getMock('ProjectHello\CoreBundle\Entity\Card');
        $this->recipient->setCard($card);
        $this->assertSame($card, $this->recipient->getCard());

        $user = $this->getMock('ProjectHello\CoreBundle\Entity\User');
        $this->recipient->setRecipient($user);
        $this->assertSame($user, $this->recipient->getRecipient());

        $recipientName = 'Dummy Recipient';
        $this->recipient->setRecipientName($recipientName);
        $this->assertEquals($recipientName, $this->recipient->getRecipientName());
    }

    protected function tearDown()
    {
        $this->recipient = null;
    }
}