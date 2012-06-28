<?php

namespace ProjectHello\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Tests\BaseUnitTestCase;

class CardRepositoryTest extends BaseUnitTestCase
{
    public function testCreateQueryBuilderWhenSearchingForCardsCreatedByUser()
    {
        $dql = 'SELECT card FROM ProjectHello\CoreBundle\Entity\Card card WHERE card.creator = :creator';

        $builder = $this->getEntityManager()
            ->getRepository('ProjectHelloCoreBundle:Card')
            ->createQueryBuilderWhenSearchingForCardsCreatedByUser(1);

        $this->assertEquals($dql, $builder->getDql());

        $parameters = $builder->getQuery()->getParameters();
        $this->assertEquals(1, $parameters['creator']);
    }

    public function testCreateQueryBuilderWhenSearchingForCardsCreatedByUserLimitedByAnOffsetAndLimit()
    {
        $dql = 'SELECT card FROM ProjectHello\CoreBundle\Entity\Card card WHERE card.creator = :creator';

        $builder = $this->getEntityManager()
            ->getRepository('ProjectHelloCoreBundle:Card')
            ->createQueryBuilderWhenSearchingForCardsCreatedByUser(1, array(
                'offset' => 0,
                'limit'  => 1
            ));

        $this->assertEquals($dql, $builder->getDql());

        $parameters = $builder->getQuery()->getParameters();
        $this->assertEquals(1, $parameters['creator']);
    }

    public function testCreateQueryBuilderWhenSearchingForCardsCreatedByUserSortedByAscendingDateCreated()
    {
        $dql = 'SELECT card '.
               'FROM ProjectHello\CoreBundle\Entity\Card card '.
               'WHERE card.creator = :creator '.
               'ORDER BY card.dateCreated ASC';

        $builder = $this->getEntityManager()
            ->getRepository('ProjectHelloCoreBundle:Card')
            ->createQueryBuilderWhenSearchingForCardsCreatedByUser(1, array(
               'sortBy' => 'card.dateCreated',
               'order'  => 'ASC'
            ));

        $this->assertEquals($dql, $builder->getDql());
    }

    public function testCreateQueryBuilderWhenSearchingForCardsReceivedByUser()
    {
        $dql = 'SELECT card '.
               'FROM '.
               'ProjectHello\CoreBundle\Entity\CardRecipient cardRecipient, '.
               'ProjectHello\CoreBundle\Entity\Card card '.
               'WHERE cardRecipient.recipient = :recipient AND cardRecipient.card = card';

        $builder = $this->getEntityManager()
           ->getRepository('ProjectHelloCoreBundle:Card')
           ->createQueryBuilderWhenSearchingForCardsReceivedByUser(1);

        $this->assertEquals($dql, $builder->getDql());

        $parameters = $builder->getQuery()->getParameters();
        $this->assertEquals(1, $parameters['recipient']);
    }

    public function testCreateQueryBuilderWhenSearchingForCardsReceivedByUserLimitedByANOffsetAndLimit()
    {
        $dql = 'SELECT card '.
               'FROM '.
               'ProjectHello\CoreBundle\Entity\CardRecipient cardRecipient, '.
               'ProjectHello\CoreBundle\Entity\Card card '.
               'WHERE cardRecipient.recipient = :recipient AND cardRecipient.card = card';

        $builder = $this->getEntityManager()
           ->getRepository('ProjectHelloCoreBundle:Card')
           ->createQueryBuilderWhenSearchingForCardsReceivedByUser(1, array(
                'offset' => 0,
                'limit'  => 1
           ));

        $this->assertEquals($dql, $builder->getDql());

        $parameters = $builder->getQuery()->getParameters();
        $this->assertEquals(1, $parameters['recipient']);
    }

    public function testCreateQueryBuilderWhenSearchingForCardsReceivedByUserSortedByDescendingSendingDate()
    {
        $dql = 'SELECT card '.
               'FROM '.
               'ProjectHello\CoreBundle\Entity\CardRecipient cardRecipient, '.
               'ProjectHello\CoreBundle\Entity\Card card '.
               'WHERE cardRecipient.recipient = :recipient AND cardRecipient.card = card '.
               'ORDER BY card.sendingDate DESC';

        $builder = $this->getEntityManager()
           ->getRepository('ProjectHelloCoreBundle:Card')
           ->createQueryBuilderWhenSearchingForCardsReceivedByUser(1, array(
                'sortBy' => 'card.sendingDate',
                'order'  => 'DESC'
           ));

        $this->assertEquals($dql, $builder->getDql());

        $parameters = $builder->getQuery()->getParameters();
        $this->assertEquals(1, $parameters['recipient']);
    }
}