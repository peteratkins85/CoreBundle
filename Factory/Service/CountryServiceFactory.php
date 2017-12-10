<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 14/05/2016
 * Time: 02:07
 */

namespace App\Oni\CoreBundle\Factory\Service;


use App\Oni\CoreBundle\Entity\City;
use App\Oni\CoreBundle\Entity\Country;
use App\Oni\CoreBundle\Entity\Currency;
use App\Oni\CoreBundle\Entity\Nationality;
use App\Oni\CoreBundle\Service\CountryService;
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