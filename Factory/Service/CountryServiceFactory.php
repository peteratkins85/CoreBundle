<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 14/05/2016
 * Time: 02:07
 */

namespace Oni\CoreBundle\Factory\Service;


use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Entity\Country;
use Oni\CoreBundle\Entity\Currency;
use Oni\CoreBundle\Entity\Nationality;
use Oni\CoreBundle\Service\CountryService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CountryServiceFactory  {

	public function getService(ContainerInterface $serviceContainer){

		$objectManager  = $serviceContainer->get('doctrine.orm.entity_manager');
		$countryRepository = $objectManager->getRepository(Country::class);
		$cityRepository = $objectManager->getRepository(City::class);
		$nationalityRepository = $objectManager->getRepository(Nationality::class);
		$cacheManager = $serviceContainer->get('snc_redis.default');
		$currencyRepository = $objectManager->getRepository(Currency::class);

		return new CountryService(
			$countryRepository,
			$cityRepository,
			$nationalityRepository,
			$currencyRepository
		);

	}

}