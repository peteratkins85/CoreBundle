<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 22/05/2016
 * Time: 22:12
 */

namespace Oni\CoreBundle\Doctrine\Spec;


interface Cacheable {


	const CACHEABLE = true;

	/**
	 *
	 * Returns Cache limit for Query Spec
	 *
	 * @return integer
	 */
	public function getCacheLimit();

}