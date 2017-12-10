<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 02/06/2016
 * Time: 23:33
 */

namespace Oni\CoreBundle\Doctrine\Spec\City;


use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Oni\CoreBundle\Doctrine\Spec\Specification;

class CountryIdEquals implements Specification{


	private $countryId;

	public function __construct($countryId)
	{
		$this->countryId = $countryId;
	}

	public function match( QueryBuilder $qb, $dqlAlias ) {

		$qb->setParameter('countryId', $this->countryId);
		return $qb->expr()->eq($dqlAlias . '.countryId', ':countryId');

	}

	public function modifyQuery( Query $query ) { /* empty ***/ }

}