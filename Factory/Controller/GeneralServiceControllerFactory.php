<?php

namespace App\Oni\CoreBundle\Factory\Controller;

use App\Oni\CoreBundle\Controller\GeneralServiceController;
use App\Oni\CoreBundle\Factory\CoreAbstractFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *
 * @author Peter Atkins <peter.atkins85@gmail.com>
 *
 */
class GeneralServiceControllerFactory extends CoreAbstractFactory{

	function getService( ContainerInterface $serviceContainer ) {

		$countryService = $this->container->get('oni_country_service');
		$controller = new GeneralServiceController(
			$countryService
		);

		return $this->injectControllerDependencies($controller);

	}

}