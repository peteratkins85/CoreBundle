<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 07/05/2016
 * Time: 09:37
 */

namespace Oni\CoreBundle\Doctrine\Spec;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

interface Specification {

	/**
	 * @param \Doctrine\ORM\QueryBuilder $qb
	 * @param string $dqlAlias
	 *
	 * @return \Doctrine\ORM\Query\Expr
	 ***/
	public function match(QueryBuilder $qb, $dqlAlias);

	/**
	 * @param \Doctrine\ORM\Query $query
	 ***/
	public function modifyQuery(Query $query);

}