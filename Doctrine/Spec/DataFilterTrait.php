<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 26/11/2016
 * Time: 19:40
 */

namespace Oni\CoreBundle\Doctrine\Spec;


use Oni\CoreBundle\Common\LocaleAwareInterface;
use Oni\CoreBundle\Exceptions\InvalidArgumentException;
use Oni\CoreBundle\Exceptions\RuntimeException;

/**
 * Class DataFilterTrait
 * @package Oni\CoreBundle\Doctrine\Spec
 * @author peter.atkins85@gmail.com
 */
trait DataFilterTrait
{
    /**
     * @var string
     */
    protected $order = 'DESC';

    /**
     * @var string
     */
    protected $orderBy = 0;

    /**
     * @var string
     */
    protected $search;

    /**
     * @var bool
     */
    protected $getRecordCount = false;

    /**
     * @var bool
     */
    protected $includeFilterOnGetRecordCount = false;

    /**
     * @var int
     */
    protected $limit = 10;

    /**
     * @var int
     */
    protected $offset = 0;

    /**
     * @param array $params
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    protected function setFilters(array $params)
    {
        if ($this instanceof LocaleAwareInterface) {
            if (isset($params['locale'])) {
                $this->locale = $params['locale'];
            } elseif (empty($this->locale)) {
                throw new InvalidArgumentException('Parameter "locale" must be set');
            }
        }

        if (empty($this->fields) || !is_array($this->fields)) {
            throw new RuntimeException('Filters cannot be applied array property "fields" is either not set or invalid');
        }


        $this->getRecordCount = isset($params['getRecordCount']) ? $params['getRecordCount'] : false;
        $this->includeFilterOnGetRecordCount = isset($params['includeFilterOnGetRecordCount']) && $params['includeFilterOnGetRecordCount'] ? $params['includeFilterOnGetRecordCount'] : true;
        $this->order = isset($params['order']) ? $params['order'] : 0;
        $this->search = isset($params['search']) ? $params['search'] : '';
        $this->limit = isset($params['limit']) ? $params['limit'] : 10;
        $this->offset = isset($params['offset']) ? $params['offset'] : 0;
        $orderBy = isset($params['orderBy']) ? $params['orderBy'] : 0;

        if (isset($this->fields[$orderBy])) {
            $this->orderBy = $this->fields[$orderBy];
        } else {
            $this->orderBy = array_values($this->fields)[0];
        }
    }

    /**
     * @param $fields
     */
    protected function setFields($fields)
    {
        if ($this->validateFields($fields)) {
            $this->fields = $fields;
        }

        return $this;
    }

    protected function validateFields(array $fields)
    {

        if (!is_array($fields) || empty($fields)) {
            return false;
        }


        foreach ($fields as $field) {
            if (!is_string($field)){
                return false;
            }
        }

        return true;
    }


}