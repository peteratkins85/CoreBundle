<?php

namespace Oni\CoreBundle\Factory\Controller;

use Oni\CoreBundle\Controller\GeneralServiceController;
use Oni\CoreBundle\Factory\CoreAbstractFactory;
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