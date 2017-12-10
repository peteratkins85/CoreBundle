<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 06/06/2016
 * Time: 23:46
 */

namespace Oni\CoreBundle\Service;


class ArrayPagination {

	public static function paginate($array , $pageSize, $page){

		$pages = array_chunk($array, $pageSize);
		return $page > sizeof($pages) ? [] : $pages[$page - 1];

	}

}