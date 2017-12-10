<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 02/06/2016
 * Time: 23:40
 */

namespace Oni\CoreBundle\Doctrine\Spec\City;


use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Oni\CoreBundle\Doctrine\Spec\AsArray;
use Oni\CoreBundle\Doctrine\Spec\Specification;

class GetCitiesByCountry implements Specification{

	protected $spec;

	public function __construct($countryId)
	{
		$this->spec = new AsArray(
			new CountryIdEquals($countryId)
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
		return ($className === 'Oni\CoreBundle\Entity\City');
	}

}