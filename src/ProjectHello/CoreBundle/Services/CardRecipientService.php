<?php

namespace ProjectHello\CoreBundle\Services;

use ProjectHello\CoreBundle\Entity\Card;
use ProjectHello\CoreBundle\Entity\CardRecipientRepository;

class CardRecipientService
{
    private $repo;

    public function __construct(CardRecipientRepository $repo)
    {
        $this->repo = $repo;
    }

    public function retrieveCardRecipientsByCard(Card $card, $dqlParams = array())
    {
        if (is_array($dqlParams)) {
            return $this->repo
                ->createQueryBuilderWhenSearchingForCardRecipientsByCard($user->getId(), $dqlParams)
                ->getQuery()
                ->getResult();
        }

        throw new \InvalidArgumentException('DqlParams should be an array');
    }
}