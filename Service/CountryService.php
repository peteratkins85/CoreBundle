<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 10/05/2016
 * Time: 23:18
 */

namespace App\Oni\CoreBundle\Service;


use App\Oni\CoreBundle\Doctrine\Spec\City\CitySearch;
use App\Oni\CoreBundle\Doctrine\Spec\City\GetCitiesByCountry;
use App\Oni\CoreBundle\Doctrine\Spec\Currency\GetCurrenciesByCodes;
use App\Oni\CoreBundle\Entity\Repository\CityRepository;
use App\Oni\CoreBundle\Entity\Repository\CountryRepository;
use App\Oni\CoreBundle\Entity\Repository\CurrencyRepository;
use App\Oni\CoreBundle\Entity\Repository\NationalityRepository;

class CountryService {
	
	/**
	 * @var \Doctrine\Common\Persistence\ObjectRepository
	 */
	protected $countryRepository;

	/**
	 * @var \Doctrine\Common\Persistence\ObjectRepository
	 */
	protected $cityRepository;

	/**
	 * @var \App\Oni\CoreBundle\Entity\Repository\NationalityRepository
	 */
	protected $nationalityRepository;

	/**
	 * @var \App\Oni\CoreBundle\Entity\Repository\CurrencyRepository
	 */
	protected $currencyRepository;

	public function __construct(
		CountryRepository $countryRepository,
		CityRepository $cityRepository,
		NationalityRepository $nationalityRepository,
		CurrencyRepository $currencyRepository
	)
	{
		$this->countryRepository = $countryRepository;
		$this->cityRepository = $cityRepository;
		$this->nationalityRepository = $nationalityRepository;
		$this->currencyRepository = $currencyRepository;
	;
	}

	public function findCountryBy($criteria){

		

	}

	public function findCountryByIso($iso){



	}

	public function findCountryByIso3($iso3){



	}

	public function findCountryByName($name){



	}

	public function getNationalities(){

		return $this->nationalityRepository->findAll();

	}
	
	public function getCurrenciesByCurrencyCodes($currencyCodes){

		$spec = new GetCurrenciesByCodes($currencyCodes);
		$results = $this->currencyRepository->match($spec);

		return $results;

	}

	public function getCountries(){

		return $this->countryRepository->findAll();

	}

	public function getCitiesByCountryId($countryId){

		$spec = new GetCitiesByCountry($countryId);
		$results = $this->cityRepository->match($spec);

		return $results;

	}

	public function getCitiesBy($searchTerm){

		$citySearch = new CitySearch($searchTerm);
		return $this->cityRepository->match($citySearch);

	}

}