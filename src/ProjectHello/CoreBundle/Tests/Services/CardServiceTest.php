<?php

namespace ProjectHello\CoreBundle\Tests\Services;

use ProjectHello\CoreBundle\Entity\User;
use ProjectHello\CoreBundle\Entity\Card;
use ProjectHello\CoreBundle\Entity\CardRecipient;
use ProjectHello\CoreBundle\Services\CardService;
use ProjectHello\CoreBundle\Tests\BaseFunctionalTestCase;

class CardServiceTest extends BaseFunctionalTestCase
{
    private $user;
    private $cardA;
    private $service;
    private $recipient;
    private $entityManager;

    protected function setUp()
    {
        parent::setUp();

        $this->entityManager = $this->getEntityManager();

        $repo = $this->entityManager->getRepository('ProjectHelloCoreBundle:Card');
        $this->service = new CardService($repo);

        $this->user = new User();
        $this->user->setEmailAddress('creator@email.com');
        $this->user->setPassword('password');
        $this->user->setDateRegistered(new \DateTime('now'));
        $this->entityManager->persist($this->user);

        $this->cardA = new Card();
        $this->cardA->setSendingDate(new \DateTime('+6 month'));
        $this->cardA->setCreator($this->user);
        $this->entityManager->persist($this->cardA);

        $cardB = new Card();
        $cardB->setSendingDate(new \DateTime('+12 month'));
        $cardB->setCreator($this->user);
        $this->entityManager->persist($cardB);

        $this->recipient = new User();
        $this->recipient->setEmailAddress('recipient@email.com');
        $this->entityManager->persist($this->recipient);

        $cardRecipient = new CardRecipient();
        $cardRecipient->setRecipient($this->recipient);
        $cardRecipient->setRecipientName('Dummy Recipient');
        $cardRecipient->setCard($this->cardA);
        $this->entityManager->persist($cardRecipient);

        $cardRecipient = new CardRecipient();
        $cardRecipient->setRecipient($this->recipient);
        $cardRecipient->setRecipientName('Dummy Recipient');
        $cardRecipient->setCard($cardB);
        $this->entityManager->persist($cardRecipient);

        $this->entityManager->flush();
    }

    public function testRetrieveCardsCreatedByUser()
    {
        $cards = $this->service->retrieveCardsCreatedByUser($this->user);
        $this->assertEquals(2, count($cards));
    }

    public function testRetrieveCardsCreatedByUserSortedByDescendingSendingDate()
    {
        $cards = $this->service->retrieveCardsCreatedByUser($this->user, array(
            'sortBy' => 'card.sendingDate',
            'order'  => 'DESC'
        ));

        $this->assertGreaterThanOrEqual($cards[1]->getSendingDate(), $cards[0]->getSendingDate());
    }

    public function testRetrieveCardsCreatedByUserLimitedByAnOffsetAndSortedByDescendingSendingDate()
    {
        $cards = $this->service->retrieveCardsCreatedByUser($this->user, array(
            'sortBy' => 'card.sendingDate',
            'order'  => 'DESC',
            'offset' => 1
        ));

        $this->assertEquals(1, count($cards));
        $this->assertSame($this->cardA, $cards[0]);
    }

    public function testRetrieveCardsReceivedByUser()
    {
        $cards = $this->service->retrieveCardsReceivedByUser($this->recipient);
        $this->assertEquals(2, count($cards));
    }

    public function testRetrieveCardsReceivedByUserSortedByDescendingSendingDate()
    {
        $cards = $this->service->retrieveCardsReceivedByUser($this->recipient, array(
            'sortBy' => 'card.sendingDate',
            'order'  => 'DESC'
        ));

        $this->assertGreaterThanOrEqual($cards[1]->getSendingDate(), $cards[0]->getSendingDate());
    }

    public function testRetrieveCardsReceivedByUserSortedByDescendingSendingDateAndLimitedByAnOffset()
    {
        $cards = $this->service->retrieveCardsReceivedByUser($this->recipient, array(
            'sortBy' => 'card.sendingDate',
            'order'  => 'DESC',
            'offset' => 1
        ));

        $this->assertEquals(1, count($cards));
        $this->assertSame($this->cardA, $cards[0]);
    }

    protected function tearDown()
    {
        $this->user = null;
        $this->cardA = null;
        $this->service = null;
        $this->recipient = null;

        parent::tearDown();
    }
}