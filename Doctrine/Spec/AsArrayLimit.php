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
use Oni\CoreBundle\Doctrine\Spec\Specification;

class AsArrayLimit implements Specification
{
    /**
     * @var \Oni\CoreBundle\Doctrine\Spec\Specification
     */
	private $parent;

    /**
     * @var int
     */
	private $maxResults = 10;

    /**
     * @var int
     */
    private $offSet = 0;

    /**
     * AsArrayLimit constructor.
     * @param \Oni\CoreBundle\Doctrine\Spec\Specification $parent
     * @param int $maxResults
     */
	public function __construct(Specification $parent, int $maxResults = 0, int $offSet = 0)
	{
		$this->parent = $parent;
        $this->offSet = $offSet;

        if ($maxResults) {
            $this->maxResults = $maxResults;
        }
	}

    /**
     * @param Query $query
     */
	public function modifyQuery(Query $query)
	{
		$query->setHydrationMode(Query::HYDRATE_ARRAY)
			->setMaxResults($this->maxResults)
            ->setFirstResult($this->offSet);
	}

    /**
     * @param QueryBuilder $qb
     * @param string $dqlAlias
     * @return Query\Expr
     */
	public function match(QueryBuilder $qb, $dqlAlias)
	{
		return $this->parent->match($qb, $dqlAlias);
	}
}