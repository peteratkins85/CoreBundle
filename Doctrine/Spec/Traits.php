<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 26/11/2016
 * Time: 01:07
 */

namespace Oni\CoreBundle\Doctrine\Spec;


trait Traits
{

    public function addFieldAlias($alias)
    {
        if (!isset($this->fields))
            throw new \RuntimeException('Error: Variable fields not set');

        if (isset($this->orderBy)){

            if (strstr($this->orderBy, ' as ')){
                $this->orderBy = explode(' as ',$this->orderBy)[0];
            }

            $this->orderBy = str_replace('{alias}', $alias, $this->orderBy);
        }

        foreach($this->fields as &$field){
            $field = str_replace('{alias}', $alias, $field);
        }
    }

}