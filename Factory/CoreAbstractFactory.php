<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 24/12/2015
 * Time: 15:37
 */

namespace Oni\CoreBundle\Factory;

use Oni\CoreBundle\Entity\TranslatorAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


abstract class CoreAbstractFactory implements CoreFactoryInterface
{

    abstract function getService(ContainerInterface $serviceContainer);


    protected function injectCommonDependencies($class, ContainerInterface $container)
    {

        $bundles = $container->getParameter('kernel.bundles');

        if ($class instanceof TranslatorAwareInterface) {
            $class->setTranslator($container->get('translator'));
        }

        if ($class instanceof ContainerAwareInterface) {
            $class->setContainer($container);
        }

        return $class;

    }


}