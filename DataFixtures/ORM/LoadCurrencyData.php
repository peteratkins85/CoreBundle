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
use Oni\CoreBundle\Entity\Currency;
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
        $defaultCurrency->setCurrencyName('British Pound');
        $defaultCurrency->setCurrencyCode('GBP');
        $defaultCurrency->setCurrencySymbol('&pound;');
        $defaultCurrency->setEnabled(1);
        $defaultCurrency->setIsDefault(1);

        $usDollar = new Currency();
        $usDollar->setCurrencyName('US Dollar');
        $usDollar->setCurrencyCode('USD');
        $usDollar->setCurrencySymbol('&dollar;');
        $usDollar->setEnabled(1);
        $usDollar->setIsDefault(0);

        $em = $this->container->get('doctrine.orm.default_entity_manager');
        $em->persist($defaultCurrency);
        $em->persist($usDollar);
        $em->flush();

        $this->addReference('defaultCurrency', $defaultCurrency);
        $this->addReference('USD', $usDollar);
    }

    public function getOrder()
    {
        return 1;
    }
}
