<?php

namespace ProjectHello\CoreBundle\Services;

use ProjectHello\CoreBundle\Entity\User;
use ProjectHello\CoreBundle\Entity\CardCreator;
use ProjectHello\CoreBundle\Entity\MessageAuthor;

class CardService
{
	public function retrieveCardsCreatedByCreator(CardCreator $creator)
	{

	}

	public function retrieveCardsReceivedByRecipient(User $recipient)
	{

	}

	public function retrieveCardsWithMessagesWrittenByAuthor(MessageAuthor $author)
	{

	}

	public function retrieveCardsOfType($type)
	{
		
	}
}