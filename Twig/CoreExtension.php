<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 21/12/2016
 * Time: 00:35
 */

namespace Oni\CoreBundle\Twig;

use \Twig_Extension;

class CoreExtension extends Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            'url_decode' => new \Twig_Filter_Method($this, 'urlDecode')
        ];
    }

    /**
     * URL Decode a string
     *
     * @param string $url
     *
     * @return string The decoded URL
     */
    public function urlDecode($url)
    {
        return urldecode($url);
    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'oni_core_extension';
    }

}