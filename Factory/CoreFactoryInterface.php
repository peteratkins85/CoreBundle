<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 21/05/2016
 * Time: 17:38
 */

namespace Oni\CoreBundle\Factory;


use Symfony\Component\DependencyInjection\ContainerInterface;

interface CoreFactoryInterface {

	public function getService(ContainerInterface $serviceContainer);

}