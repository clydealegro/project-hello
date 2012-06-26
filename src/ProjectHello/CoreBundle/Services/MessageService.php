<?php

namespace ProjectHello\CoreBundle\Services;

use ProjectHello\CoreBundle\Entity\Card;
use ProjectHello\CoreBundle\Entity\MessageRepository;

class MessageService
{
	private $repo;

	public function __construct(MessageRepository $repo)
	{
		$this->repo = $repo;
	}

    public function retrieveMessagesFoundInCard(Card $card)
    {
    	return $this->repo->createQueryBuilderWhenSearchingForMessagesOfCard($card->getId())->getQuery()->getResult();
    }
}