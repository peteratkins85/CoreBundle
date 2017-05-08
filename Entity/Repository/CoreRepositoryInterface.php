<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 17/04/2016
 * Time: 13:09
 */

namespace Oni\CoreBundle\Entity\Repository;


use Oni\CoreBundle\Entity\TranslatorAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

interface CoreRepositoryInterface extends ContainerAwareInterface, TranslatorAwareInterface {


}