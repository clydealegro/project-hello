<?php

namespace FundMyTravel\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Entity\Invitation;

class InvitationTest extends \PHPUnit_Framework_TestCase
{
    private $invitation;

    protected function setUp()
    {
        $this->invitation  = new Invitation();
    }

    public function testSetterGetterMethods()
    {
        $this->assertNull($this->invitation->getId());

        $instruction = 'instruction';
        $this->invitation->setInstruction($instruction);
        $this->assertEquals($instruction, $this->invitation->getInstruction());

        $today = new \DateTime('now');
        $this->assertEquals($today, $this->invitation->getDateSent());

        $dateSent = new \DateTime('+1 day');
        $this->invitation->setDateSent($dateSent);
        $this->assertSame($dateSent, $this->invitation->getDateSent());

        $card = $this->getMock('ProjectHello\CoreBundle\Entity\Card');
        $this->invitation->setCard($card);
        $this->assertSame($card, $this->invitation->getCard());

        $this->assertEmpty($this->invitation->getInvitees()->toArray());
    }

    public function testAddAndGetInvitees()
    {
        $invitee = $this->getMock('ProjectHello\CoreBundle\Entity\MessageAuthor');
        $this->invitation->addInvitee($invitee);

        $invitees = $this->invitation->getInvitees()->toArray();
        $this->assertSame($invitee, $invitees[0]);
    }

    protected function tearDown()
    {
        $this->invitation = null;
    }
}