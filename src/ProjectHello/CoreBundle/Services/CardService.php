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

    public function retrieveCardsCreatedByUser(User $user, $dqlParams = array())
    {
        if (is_array($dqlParams)) {
            return $this->repo
                ->createQueryBuilderWhenSearchingForCardsCreatedByUser($user->getId(), $dqlParams)
                ->getQuery()
                ->getResult();
        }

        throw new \InvalidArgumentException('DqlParams should be an array');
    }

    public function retrieveCardsReceivedByUser(User $user, $dqlParams = array())
    {
        if (is_array($dqlParams)) {
            return $this->repo
                ->createQueryBuilderWhenSearchingForCardsReceivedByUser($user->getId(), $dqlParams)
                ->getQuery()
                ->getResult();
        }

        throw new \InvalidArgumentException('DqlParams should be an array');
    }
}