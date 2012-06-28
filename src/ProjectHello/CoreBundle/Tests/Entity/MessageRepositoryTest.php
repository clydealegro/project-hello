<?php

namespace ProjectHello\CoreBundle\Tests\Entity;

use ProjectHello\CoreBundle\Tests\BaseUnitTestCase;

class MessageRepositoryTest extends BaseUnitTestCase
{
    public function testCreateQueryBuilderWhenSearchingForMessagesOfCard()
    {
        $dql = 'SELECT message FROM ProjectHello\CoreBundle\Entity\Message message WHERE message.card = :card';

        $builder = $this->getEntityManager()
            ->getRepository('ProjectHelloCoreBundle:Message')
            ->createQueryBuilderWhenSearchingForMessagesOfCard(1);

        $this->assertEquals($dql, $builder->getDql());

        $parameters = $builder->getQuery()->getParameters();
        $this->assertEquals(1, $parameters['card']);
    }

    public function testCreateQueryBuilderWhenSearchingForMessagesOfCardLimitedByAnOffsetAndLimit()
    {
        $dql = 'SELECT message FROM ProjectHello\CoreBundle\Entity\Message message WHERE message.card = :card';

        $builder = $this->getEntityManager()
            ->getRepository('ProjectHelloCoreBundle:Message')
            ->createQueryBuilderWhenSearchingForMessagesOfCard(1, array(
                'offset'    => 0,
                'limit'     => 1
            ));

        $this->assertEquals($dql, $builder->getDql());

        $parameters = $builder->getQuery()->getParameters();
        $this->assertEquals(1, $parameters['card']);
    }

    public function testCreateQueryBuilderWhenSearchingForMessagesOfCardSortedByAscendingAuthorName()
    {
        $dql = 'SELECT message '.
               'FROM ProjectHello\CoreBundle\Entity\Message message '.
               'WHERE message.card = :card '.
               'ORDER BY message.authorName ASC';

        $builder = $this->getEntityManager()
            ->getRepository('ProjectHelloCoreBundle:Message')
            ->createQueryBuilderWhenSearchingForMessagesOfCard(1, array(
                'sortBy' => 'message.authorName',
                'order'  => 'ASC'
            ));

        $this->assertEquals($dql, $builder->getDql());

        $parameters = $builder->getQuery()->getParameters();
        $this->assertEquals(1, $parameters['card']);
    }
}