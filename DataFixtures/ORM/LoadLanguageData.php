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
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Oni\CoreBundle\Entity\Languages;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadLanguageData extends AbstractFixture implements OrderedFixtureInterface ,FixtureInterface, ContainerAwareInterface
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
        $locale = $this->container->getParameter('stof_doctrine_extensions.default_locale');
        $language = new Languages();
        $language->setLanguage('English');
        $language->setIsDefault(1);
        $language->setLocale($locale ? $locale : 'en');

        $french= new Languages();
        $french->setLanguage('French');
        $french->setIsDefault(0);
        $french->setLocale('fr');

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $em->persist($language);
        $em->persist($french);
        $em->flush();

        $this->addReference('language', $language);

    }

    public function getOrder()
    {
        return 1;
    }
}
