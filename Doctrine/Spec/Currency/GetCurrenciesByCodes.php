<?php

namespace Oni\CoreBundle\Doctrine\Spec\Currency;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Oni\CoreBundle\Doctrine\Spec\AsArray;
use Oni\CoreBundle\Doctrine\Spec\Specification;

class GetCurrenciesByCodes implements Specification {

	
	protected $spec;
	
	public function __construct(array $currencyCodes) {
		$this->spec = new AsArray(
			new CurrencyCodeIn($currencyCodes)
		);
	}

	public function match( QueryBuilder $qb, $dqlAlias )
	{
		return $this->spec->match($qb, $dqlAlias);
	}

	public function modifyQuery( Query $query )
	{
		$query->useResultCache(true, 2592000);
		return $this->spec->modifyQuery($query);
	}

	public function supports($className)
	{
		return ($className === 'Oni\CoreBundle\Entity\Currency');
	}
	
}