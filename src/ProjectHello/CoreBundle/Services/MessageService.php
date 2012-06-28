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

    public function retrieveMessagesFoundInCard(Card $card, $dqlParams = array())
    {
        if (is_array($dqlParams)) {
            return $this->repo
                ->createQueryBuilderWhenSearchingForMessagesOfCard($card->getId(), $dqlParams)
                ->getQuery()
                ->getResult();
        }

        throw new \InvalidArgumentException('DqlParams should be an array');
    }
}