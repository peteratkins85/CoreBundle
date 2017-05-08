<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 30/12/2015
 * Time: 23:22
 */

namespace Oni\CoreBundle\Twig;



class GetLanguages extends \Twig_Environment
{

    public function getGlobals(){

        return array(
            'text' => new Text(),
        );

    }

}