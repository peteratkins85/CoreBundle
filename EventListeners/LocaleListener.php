<?php
namespace Oni\CoreBundle\EventListeners;

use Oni\CoreBundle\SessionKeys;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\LanguageValidator;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Validation;

class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;

    public function __construct($defaultLocale = 'en', ContainerInterface $container)
    {
        $this->defaultLocale = $defaultLocale;
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {

        //Set Locale from session otherwise use default
        $this->setLocale($event);

        //Add twig global variables
        $this->addTwigGlobals();

    }

    public function setLocale($event){

        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        // try to see if the locale has been set as a _locale routing parameter
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set(SessionKeys::LOCALE_KEY, $locale);
        } elseif ($request->get('locale') && ctype_alpha($request->get('locale')))  {
            $locale = $request->get('locale');
            $isValidLocale = $this->container->get('oni_language_repository')->isValidLocale($locale);

            if ($isValidLocale){
                $request->setLocale($locale);
                $request->getSession()->set(SessionKeys::LOCALE_KEY, $locale);
            }
        }else{
            // if no explicit locale has been set on this request, use one from the session
            $type = gettype($this->container->get('oni_get_locale'));
            $locale = $this->container->get('oni_get_locale');
            $locale = (string)$locale;
            $request->setLocale($locale);
        }

        //$this->container->get('stof_doctrine_extensions.listener.translatable')->setTranslationFallback(false);

    }

    public function addTwigGlobals(){

        //Add avaialble language to twig template as a global variable
        $this->container->get('twig')->addGlobal('oni_available_languages', $this->container->get('oni_get_available_languages'));

    }

    public static function getSubscribedEvents()
    {
        return array(
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}