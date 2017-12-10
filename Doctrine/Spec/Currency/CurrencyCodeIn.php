<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 03/06/2016
 * Time: 15:33
 */

namespace Oni\CoreBundle\Doctrine\Spec\Currency;


use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Oni\CoreBundle\Doctrine\Spec\Specification;

class CurrencyCodeIn implements Specification{

	protected $currencyCodes;

	public function __construct(array $currencyCodes)
	{
		$this->currencyCodes = $currencyCodes;
	}

	public function match( QueryBuilder $qb, $dqlAlias ) {

		$qb->setParameter(1, $this->currencyCodes);
		return $qb->expr()->in($dqlAlias . '.currencyCode', '?1');

	}

	public function modifyQuery( Query $query ) { /* empty ***/ }

}