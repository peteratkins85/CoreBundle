<?php
namespace Oni\CoreBundle\EventListeners;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Gedmo\Translatable\Translatable;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\HttpKernel\EventListener\LocaleListener;

class TranslationListener implements EventSubscriber
{
    /**@var ContainerInterface $container  **/
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {

//        $locale = $this->container->get('oni_get_locale') ;
//        $defaultLocale = $this->container->get('stof_doctrine_extensions.listener.translatable')->getDefaultLocale();
//
//        $entity = $args->getObject();
//
//        if ($entity instanceof Translatable && $locale != $defaultLocale) {
//            //Set locale to current locale from session
//            $entity->setTranslatableLocale($locale);
//            $this->container->get('stof_doctrine_extensions.listener.translatable')->setTranslatableLocale($locale);
//        }

    }

    public  function getSubscribedEvents()
    {
        return array(
            // must be registered before the default Locale listener
            'preUpdate'
        );
    }
}