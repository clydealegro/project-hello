<?php

namespace ProjectHello\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * AllEntityRepository
 *
 * This class consists of a function whose output is a generic query builder
 *  which implements the sorting and filtering of result sets
 *
 * @author Nherrisa Mae U. Celeste <nherrisa.celeste@goabroad.com>
 * @since  June 27, 2012
*/
abstract class AllEntityRepository extends EntityRepository
{
    /**
     * Creates a generic query builder for sorting and filtering result sets
     *
     * @param array $dqlParams Contains values for offset, limit, sorting column and order
     *
     * @return Doctrine\ORM\QueryBuilder
     */
    public function createGenericQueryBuilder($dqlParams = array())
    {
        $sortBy = (isset($dqlParams['sortBy'])) ? $dqlParams['sortBy'] : '';
        $order = (isset($dqlParams['order'])) ? $dqlParams['order'] : '';
        $offset = (isset($dqlParams['offset'])) ? $dqlParams['offset'] : 0;
        $limit = (isset($dqlParams['limit'])) ? $dqlParams['limit'] : 0;

        if ($offset < 0) {
            $offset = 0;
        }

        if (!$limit && $offset) {
            $limit = 10;
        }

        if ($sortBy && (!$order || ('ASC' !== $order && 'DESC' !== $order))) {
            $order = 'ASC';
        }

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        if ($sortBy && $order) {
            $queryBuilder->add('orderBy', $sortBy.' '.$order);
        }

        if ($limit) {
            $queryBuilder->setFirstResult($offset)->setMaxResults($limit);
        }

        return $queryBuilder;
    }
}