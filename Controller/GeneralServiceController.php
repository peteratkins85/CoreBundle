<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 26/05/2016
 * Time: 23:51
 */

namespace Oni\CoreBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use Oni\CoreBundle\CoreBundle;
use Oni\CoreBundle\Entity\City;
use Oni\CoreBundle\Service\CountryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class GeneralServiceController extends CoreController{

	/**
	 * @var \Oni\CoreBundle\Service\CountryService
	 */
	protected $countryService;


	public function __construct(CountryService $countryService) {

		$this->countryService = $countryService;

	}

	public function requestAction(Request $request){

		$jsonResponse = new JsonResponse();
	
		if ($request->isMethod('POST')) {

			if ($request->get('citySearch')) {

				$searchTerm = $request->get('searchTerm');
				
				$results = $this->countryService->getCitiesBy($searchTerm);
				
				return $jsonResponse->setData(
					$results
				);

			} elseif ($request->get('getCities')) {

				if ($countryId = $request->get('countryId')) {

					$results = $this->countryService->getCitiesByCountryId($countryId);

					return $jsonResponse->setData(
						$results
					);

				}
				
			}

		}else{

			return $jsonResponse->setData(
				array(
					'error' => 'Invalid Request'
				)
			);

		}

	}

}

