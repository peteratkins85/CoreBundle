<?php

namespace App\Oni\CoreBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use App\Oni\CoreBundle\CoreGlobals;

/**
 * LanguagesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LanguagesRepository extends EntityRepository
{

    public function getDefaultLanguage($returnType = 'object'){

        $language = $this->findOneBy(
            array('isDefault' => 1)
        );

        if ($language){

            return $language;

        }

    }

    public function getLanguages(){

        $categories = $this->findAll();
        $return = array();

        //Because product category names are stored in the oni_product_category_definitions table
        //We need to call the setProductCategoryName() method which will retrieve the name
        //and set the productCategoryName variable with in the entity
        // var_dump($categories); exit;
        foreach ($categories as $category){


            $return[] = $category;

        }

        return $categories;

    }

    /**
     *
     * Get active languages/locales
     *
     * @return array
     */
    public function getAvailableLanguages(){

        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('l')
            ->from(CoreGlobals::LANGUAGE_ENTITY, 'l');
            //->where('pc.lvl != 0');

        $results = $qb->getQuery()
            ->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT);

        return $results;

    }

    /**
     *
     * Check is locale is active an valid
     *
     * @return bool
     *
     */
    public function isValidLocale($locale){

        $language = $this->findBy(array('locale'=> $locale));

        if ($language){

            return true;

        }

        return false;

    }


}
