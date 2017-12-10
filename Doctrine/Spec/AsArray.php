<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 07/05/2016
 * Time: 10:12
 */

namespace Oni\CoreBundle\Doctrine\Spec;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class AsArray implements Specification
{
	private $parent;

	public function __construct(Specification $parent)
	{
		$this->parent = $parent;
	}

	public function modifyQuery(Query $query)
	{
		$query->setHydrationMode(Query::HYDRATE_ARRAY);
	}

	public function match(QueryBuilder $qb, $dqlAlias)
	{
		return $this->parent->match($qb, $dqlAlias);
	}
}