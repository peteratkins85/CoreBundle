<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 07/05/2016
 * Time: 10:24
 */

namespace Oni\CoreBundle\Doctrine\Spec;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class OrX implements Specification
{
    private $children;

    public function __construct()
    {
        $this->children = func_get_args();
    }

    public function match(QueryBuilder $qb, $dqlAlias)
    {
        return call_user_func_array(
            [$qb->expr(), 'orX'],
            array_map(function ($specification) use ($qb, $dqlAlias) {
                return $specification->match($qb, $dqlAlias);
            }, $this->children
            )
        );
    }

    public function modifyQuery(Query $query)
    {
        foreach ($this->children as $child) {
            $child->modifyQuery($query);
        }
    }
}