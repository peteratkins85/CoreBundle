<?php

namespace Oni\CoreBundle\Doctrine\Spec\Common;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Oni\CoreBundle\Doctrine\Spec\Specification;

class FindAll implements Specification
{

    /**
     * @param QueryBuilder $qb
     * @param string $dqlAlias
     * @return string
     */
    public function match(QueryBuilder $qb, $dqlAlias)
    {
        return $qb->expr()->isNotNull($dqlAlias . '.id');
    }

    /**
     * @param \Doctrine\ORM\Query $query
     ***/
    public function modifyQuery(Query $query)
    {
    }

}