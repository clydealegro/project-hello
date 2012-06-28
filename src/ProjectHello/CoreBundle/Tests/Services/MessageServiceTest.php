<?php

namespace ProjectHello\CoreBundle\Tests\Services;

use ProjectHello\CoreBundle\Entity\User;
use ProjectHello\CoreBundle\Entity\Card;
use ProjectHello\CoreBundle\Entity\Message;
use ProjectHello\CoreBundle\Services\MessageService;
use ProjectHello\CoreBundle\Tests\BaseFunctionalTestCase;

class MessageServiceTest extends BaseFunctionalTestCase
{
    private $card;
    private $service;
    private $entityManager;

    protected function setUp()
    {
        parent::setUp();

        $this->entityManager = $this->getEntityManager();

        $repo = $this->entityManager->getRepository('ProjectHelloCoreBundle:Message');
        $this->service = new MessageService($repo);

        $creator = new User();
        $creator->setEmailAddress('creator@email.com');
        $creator->setPassword('password');
        $creator->setDateRegistered(new \DateTime('now'));
        $this->entityManager->persist($creator);

        $this->card = new Card();
        $this->card->setSendingDate(new \DateTime('+6 month'));
        $this->card->setCreator($creator);
        $this->entityManager->persist($this->card);

        $authorA = new User();
        $authorA->setEmailAddress('authorA@email.com');
        $this->entityManager->persist($authorA);

        $messageA = new Message();
        $messageA->setMessage('This is my message.');
        $messageA->setAuthorName('dummy user A');
        $messageA->setCard($this->card);
        $messageA->setAuthor($authorA);
        $this->entityManager->persist($messageA);

        $authorB = new User();
        $authorB->setEmailAddress('authorB@email.com');
        $this->entityManager->persist($authorB);

        $messageB = new Message();
        $messageB->setMessage('This is my message.');
        $messageB->setAuthorName('dummy user B');
        $messageB->setCard($this->card);
        $messageB->setAuthor($authorB);
        $this->entityManager->persist($messageB);

        $this->entityManager->flush();
    }

    public function testRetrieveMessagesFoundInCard()
    {
        $messages = $this->service->retrieveMessagesFoundInCard($this->card);
        $this->assertEquals(2, count($messages));
    }

    public function testRetrieveMessagesFoundInCardSortedByDescendingAuthorName()
    {
        $messages = $this->service->retrieveMessagesFoundInCard($this->card, array(
            'sortBy' => 'message.authorName',
            'order'  => 'DESC'
        ));

        $this->assertGreaterThanOrEqual(0, strcmp($messages[0]->getAuthorName(), $messages[1]->getAuthorName()));
    }

    public function testRetrieveMessagesFoundInCardLimitedByAnOffsetAndLimitAndSortedByDescendingAuthorName()
    {
        $messages = $this->service->retrieveMessagesFoundInCard($this->card, array(
            'offset' => 1,
            'limit'  => 1,
            'sortBy' => 'message.authorName',
            'order'  => 'DESC'
        ));

        $this->assertEquals(1, count($messages));
        $this->assertEquals('dummy user A', $messages[0]->getAuthorName());
    }

    protected function tearDown()
    {
        $this->card = null;
        $this->service = null;

        parent::tearDown();
    }
}