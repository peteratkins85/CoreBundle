<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 06/08/2017
 * Time: 19:04
 */

namespace Oni\CoreBundle\Entity\Repository;


use Doctrine\Common\Persistence\ObjectRepository;
use Oni\CoreBundle\Doctrine\Spec\Specification;

interface RepositorySpecificationInterface extends ObjectRepository
{
    public function match(Specification $specification);
}