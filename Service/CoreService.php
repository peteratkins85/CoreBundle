<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 22/12/2015
 * Time: 23:25
 */

namespace Oni\CoreBundle\Service;

use Oni\CoreBundle\Entity\Languages;
use Oni\CoreBundle\Entity\Repository\LanguagesRepository;
use Oni\CoreBundle\SessionKeys;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Intl\Intl;
use \Exception;


class CoreService
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;

    }

    /**
     * Get current locale from session or default locale from table
     *
     * @return mixed|Languages
     */
    public function getLocale(){

        $session = $this->container->get('session');
        //$defaultLocale = $this->container->get('')->getDefaultLocale();
        /* @var LanguagesRepository $languageRepository */
        $languageRepository = $this->container->get('oni_language_repository');

        if ($session->get(SessionKeys::LOCALE_KEY)) {
            //Get current locale from session
            $language = $session->get(SessionKeys::LOCALE_KEY);
        }else{

            /* @var Languages $language */
            $language = $languageRepository->getDefaultLanguage();

            if ($language){
                $language = $language->getLocale();
                $session->set(SessionKeys::LOCALE_KEY, $language);
            }else{
                throw new Exception('No default language set');
            }

        }

        return $language;

    }

    /**
     *
     * Get available languages from languages table
     *
     * @return array $returnArray
     *
     */
    public function getAvailableLanguages(){

        /** @var LanguagesRepository $languageRepository **/
        $languageRepository = $this->container->get('oni_language_repository');
        $languages = $languageRepository->getAvailableLanguages();
        $currentLocale = $this->container->get('oni_get_locale');

        /**@var Languages $language  **/
        foreach ($languages as $language){

            $selected = $language->getLocale() == $currentLocale ? 1 : 0;

            \Locale::setDefault($language->getLocale());
            $languageId = $language->getId();
            $localeName = strtoupper($language->getLocale()). '  (' . Intl::getLanguageBundle()->getLanguageName($language->getLocale()).')';
            $locale = $language->getLocale();

            $returnArray[$locale] = array(
                'localeName' => $localeName,
                'language' => Intl::getLanguageBundle()->getLanguageName($language->getLocale()),
                'isSelected' => $selected,
                'locale' => $locale
            );

        }

        return $returnArray;

    }


}