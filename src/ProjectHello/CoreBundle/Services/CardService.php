<?php

namespace ProjectHello\CoreBundle\Services;

use ProjectHello\CoreBundle\Entity\User;
use ProjectHello\CoreBundle\Entity\CardRepository;

class CardService
{
	private $repo;

	public function __construct(CardRepository $repo)
	{
		$this->repo = $repo;
	}

	public function retrieveCardsCreatedByUser(User $user)
	{
		return $this->repo->createQueryBuilderWhenSearchingForCardsCreatedByUser($user->getId())->getQuery()->getResult();
	}

	public function retrieveCardsReceivedByUser(User $user)
	{
		return $this->repo->createQueryBuilderWhenSearchingForCardsReceivedByUser($user->getId())->getQuery()->getResult();
	}
}