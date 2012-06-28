<?php

namespace ProjectHello\CoreBundle\Tests\Services;

use ProjectHello\CoreBundle\Entity\User;
use ProjectHello\CoreBundle\Entity\Card;
//use ProjectHello\CoreBundle\Entity\Message;
use ProjectHello\CoreBundle\Services\CardService;
use ProjectHello\CoreBundle\Tests\BaseFunctionalTestCase;

class CardServiceTest extends BaseFunctionalTestCase
{
    //private $card;
    private $user;
    private $service;
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

        $cardA = new Card();
        $cardA->setSendingDate(new \DateTime('+6 month'));
        $cardA->setCreator($this->user);
        $this->entityManager->persist($cardA);

        $cardB = new Card();
        $cardB->setSendingDate(new \DateTime('+12 month'));
        $cardB->setCreator($this->user);
        $this->entityManager->persist($cardB);

        $this->entityManager->flush();
    }

    /*public function testRetrieveCardsCreatedByUser()
    {
        $cards = $this->service->retrieveCardsCreatedByUser($this->user);
        $this->assertEquals(2, count($cards));
    }*/

    public function testRetrieveCardsCreatedByUserSortedByDescendingSendingDate()
    {
        $cards = $this->service->retrieveCardsCreatedByUser($this->user, array(
            'sortBy' => 'card.sendingDate',
            'order'  => 'DESC'
        ));

        $this->assertGreaterThanOrEqual($cards[0]->getSendingDate(), $cards[1]->getSendingDate());
    }

    /*public function testRetrieveMessagesFoundInCardLimitedByAnOffsetAndLimitAndSortedByDescendingAuthorName()
    {
        $messages = $this->service->retrieveMessagesFoundInCard($this->card, array(
            'offset' => 1,
            'limit'  => 1,
            'sortBy' => 'message.authorName',
            'order'  => 'DESC'
        ));

        $this->assertEquals(1, count($messages));
        $this->assertEquals('dummy user A', $messages[0]->getAuthorName());
    }*/

    protected function tearDown()
    {
        $this->user = null;
        $this->service = null;

        parent::tearDown();
    }
}