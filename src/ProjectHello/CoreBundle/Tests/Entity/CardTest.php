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

        $dateCreated = new \DateTime('-1 month');
        $this->card->setDateCreated($dateCreated);
        $this->assertSame($dateCreated, $this->card->getDateCreated());

        $deadline = new \DateTime('+1 month');
        $this->card->setSendingDate($deadline);
        $this->assertSame($deadline, $this->card->getSendingDate());

        $creator = $this->getMock('ProjectHello\CoreBundle\Entity\User');
        $this->card->setCreator($creator);
        $this->assertSame($creator, $this->card->getCreator());
    }

    protected function tearDown()
    {
        $this->card = null;
    }
}