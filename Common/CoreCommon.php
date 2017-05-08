<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 04/12/2016
 * Time: 07:38
 */

namespace Oni\CoreBundle\Common;


class CoreCommon
{

    public static function formatDateTimeResultsInArrayRecursive(&$resultData, string $dateFormat = 'Y-m-d H:i:s')
    {
        foreach ($resultData as $key => &$data){
            if (is_array($data)){
                self::formatDateTimeResultsInArrayRecursive($data, $dateFormat);
            }elseif ($data instanceof \DateTime) {
                $data = $data->format($dateFormat);
            }
        }

        return $resultData;
    }

}