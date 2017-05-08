<?php

namespace Oni\CoreBundle\Tests;

trait CoreTestCase {

    /***
     *
     * Get Hostname
     *
     * @return string
     *
     */
    public function getHost(){

        $container = static::createClient()->getContainer();

        if ($container->hasParameter('domain')){

            $hostname = $container->getParameter('domain');
            $hostname = 'http://'.$hostname;

            return $hostname;

        }

    }

}