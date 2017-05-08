<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 30/11/2016
 * Time: 22:01
 */

namespace Oni\CoreBundle\Common;


interface LocaleAwareInterface
{

    public function setLocale(string $locale);

}