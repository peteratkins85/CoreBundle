<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 21/12/2016
 * Time: 00:35
 */

namespace App\Oni\CoreBundle\Twig;

use \Twig_Extension;


class UrlDecodeExtension extends Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            'url_decode' => new \Twig_SimpleFilter('url_decode', 'urlDecode')
        );
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
        return 'oni_url_decoder';
    }

}