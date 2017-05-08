<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 30/11/2016
 * Time: 21:26
 */

namespace Oni\CoreBundle\Doctrine\Spec;


trait LocaleTrait
{

    /**
     * @var string
     */
    protected $locale;


    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    }

}