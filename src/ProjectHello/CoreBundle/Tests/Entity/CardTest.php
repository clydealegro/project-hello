<?php

namespace FundMyTravel\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Entity\Card;

class CardTest extends \PHPUnit_Framework_TestCase
{
    private $card;

    protected function setUp()
    {
        $this->card  = new Card();
    }

    public function testSetterGetterMethods()
    {
        $this->assertNull($this->card->getId());

        $today = new \DateTime('now');
        $this->assertEquals($today, $this->card->getDateCreated());

        $this->card->setType(1);
        $this->assertEquals(1, $this->card->getType());

        $dateCreated = new \DateTime('-1 month');
        $this->card->setDateCreated($dateCreated);
        $this->assertSame($dateCreated, $this->card->getDateCreated());

        $deadline = new \DateTime('+1 month');
        $this->card->setDeadline($deadline);
        $this->assertSame($deadline, $this->card->getDeadline());

        $proponent = $this->getMock('ProjectHello\CoreBundle\Entity\AccountOwner');
        $this->card->setProponent($proponent);
        $this->assertSame($proponent, $this->card->getProponent());

        $this->assertEmpty($this->card->getRecipients()->toArray());
    }

    public function testAddAndGetRecipients()
    {
        $recipient = $this->getMock('ProjectHello\CoreBundle\Entity\User');
        $this->card->addRecipient($recipient);

        $recipients = $this->card->getRecipients()->toArray();
        $this->assertSame($recipient, $recipients[0]);
    }

    protected function tearDown()
    {
        $this->card = null;
    }
}