<?php

namespace Oni\CoreBundle\Controller;

use Oni\CoreBundle\Entity\Repository\LanguagesRepository;
use Oni\CoreBundle\Entity\TranslatorAwareInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Oni\ProductManagerBundle\Entity\Products;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Form\FormInterface;


class CoreController extends Controller implements TranslatorAwareInterface
{

    /**
     * @var
     */
    protected $container;

    /**
     * @var
     */
    protected $translator;

    /**
     * @var string
     */
    protected $travelPortTheme = 'default';


    /**
     * Get current language
     *
     * @return integer
     */
    public function getLanguage()
    {
        return $this->get('oni_get_locale');
    }

    public function getEventDispatcher()
    {
        return $this->get('oni_event_dispatcher');
    }

    /**
     * Set travel connect theme
     *
     * @param string $theme
     */
    public function setTravelPortTheme($theme)
    {
        $this->travelPortTheme = $theme;
    }

    /**
     * Add form errors to flashbag
     *
     * @param FormInterface $form
     */
    public function flashErrors($form)
    {
        foreach ($form->getErrors() as $error) {
            $this->addFlash(
                'error',
                $error->getMessage()
            );
        }

        foreach ($form->all() as $child) {
            $this->flashErrors($child);
        }

        return;
    }

    /***
     * @return LanguagesRepository
     */
    public function getLanguageRepository()
    {
        return $this->get('oni_language_repository');
    }

    /**
     * Set Translator
     *
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     * @return mixed
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }


}
