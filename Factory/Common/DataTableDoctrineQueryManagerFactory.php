<?php

namespace App\Oni\CoreBundle\Factory\Common;

use App\Oni\CoreBundle\Common\DataTable;
use App\Oni\CoreBundle\Common\DoctrineSpecificationQueryManager;
use App\Oni\CoreBundle\Entity\Repository\RepositorySpecificationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Acl\Exception\Exception;

class DataTableDoctrineQueryManagerFactory
{
    function getService(ContainerInterface $serviceContainer, string $entity, string $specificationClass)
    {
        $em = $serviceContainer->get('doctrine.orm.default_entity_manager');

        /** @var RepositorySpecificationInterface $repository */
        $repository = $em->getRepository($entity);
        $request = $serviceContainer->get('request_stack');
        $query = $request->getCurrentRequest()->query->all();
        $locale = $request->getCurrentRequest()->getLocale();

        if (!$repository instanceof RepositorySpecificationInterface) {
            Throw new Exception('Error: repository of entity' . $entity . ' is not and instance of ' . RepositorySpecificationInterface::class);
        }

        $dataTableQueryManager = new DoctrineSpecificationQueryManager($repository, $specificationClass, $locale);

        return new DataTable($query, $dataTableQueryManager);
    }
}