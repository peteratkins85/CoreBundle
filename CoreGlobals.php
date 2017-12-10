<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Oni\CoreBundle;

use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Contains global variables and methods for CMS
 */
final class CoreGlobals
{

    /**
     * UserManagerBundle Name
     */
    const USER_BUNDLE = 'UserManagerBundle';

    /**
     * UserManagerBundle User Entity Namespace
     */
    const USERS_ENTITY = 'UserManagerBundle:User';

    /**
     * ProductManagerBundle NameSpace
     */
    const PRODUCT_BUNDLE = 'ProductManagerBundle';

    /**
     * ProductManagerBundle Product Entity NameSpace
     */
    const PRODUCT_ENTITY = 'ProductManagerBundle:Product';

    /**
     * ProductManagerBundle Product Categories Entity NameSpace
     */
    const PRODUCT_CATEGORIES_ENTITY = 'ProductManagerBundle:ProductCategory';


    /**
     *
     */
    const LANGUAGE_ENTITY = 'CoreBundle:Languages';
}
