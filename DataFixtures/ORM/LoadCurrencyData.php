<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 25/12/15
 * Time: 19:42
 */

namespace Oni\ProductManagerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Oni\ProductManagerBundle\Entity\Currency;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Oni\CoreBundle\Entity\Languages;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCurrencyData extends AbstractFixture implements OrderedFixtureInterface ,FixtureInterface, ContainerAwareInterface
{


    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    public function load(ObjectManager $manager)
    {
        $defaultCurrency = new Currency();
        $defaultCurrency->setCurrency('British Pound');
        $defaultCurrency->setCurrencyCode('GBP');
        $defaultCurrency->setIsDefault(1);

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $em->persist($defaultCurrency);
        $em->flush();

        $this->addReference('defaultCurrency', $defaultCurrency);
    }

    public function getOrder()
    {
        return 1;
    }
}
