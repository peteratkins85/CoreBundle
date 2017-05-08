<?php

namespace Oni\CoreBundle\Common;

/**
 * Class DataTable
 * @package Oni\CoreBundle\Common
 * @author peter.atkins85@gmail.com
 */
abstract class DataTable implements DataTableInterface
{

    /**
     * @var string
     */
    protected $search;

    /**
     * @var
     */
    protected $orderBy;

    /**
     * @var string
     */
    protected $order;

    /**
     * @var int
     */
    protected $length;

    /**
     * @var int
     */
    protected $start;

    /**
     * @var int
     */
    protected $draw;

    /**
     * @var array
     */
    protected $results = [
        'data'            => [],
        'recordsTotal'    => 0,
        'recordsFiltered' => 0,
        'draw'            => 1
    ];

    /**
     * @var int
     */
    protected $recordsTotal = 0;

    /**
     * @var int
     */
    protected $recordsFiltered = 0;

    /**
     * @var array
     */
    protected $request;

    /**
     * @var array
     */
    protected $columns;

    /**
     * @var array
     */
    protected $fields;


    /**
     * DataTable constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->init($request);
        $this->setResults($this->queryData());
    }

    /**
     * Init from query request
     *
     * @param $request
     */
    public function init($request)
    {
        if (!empty($request['search']['value'])) {
           $this->setSearch(trim($request['search']['value']));
        }

        if (isset($request['draw'])) {
            $this->setDraw((int) $request['draw']);
        }

        if (isset($request['columns'])) {
            $this->setColumns($request['columns']);
        }

        $this->setRequest($request)
            ->setOrderBy(isset($request['order'][0]['column']) ? (int)$request['order'][0]['column'] : 0)
            ->setOrder(isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'desc')
            ->setStart(isset($request['start']) ? (int)$request['start'] : 0)
            ->setLength(isset($request['length']) ? (int)$request['length'] : 10);
    }

    /**
     * @param array $columns
     */
    public function setColumns(array $columns){

        $i = 0;

        while(isset($columns[$i])){

            $this->addColumn($columns[$i]);

            if (isset($columns[$i]['data']) && !empty($columns[$i]['data'])){
                $this->addField($columns[$i]['data']);
            }

            $i++;

        }

    }

    /**
     * @param array $column
     * @return $this
     */
    public function addColumn(array $column){
        $this->columns[] = $column;

        return $this;
    }

    public function addField(string $field){
        $this->fields[] = $field;

        return $this;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Query data source
     */
    abstract public function queryData();

    /**
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param array $results
     */
    public function setResults($results)
    {
        $this->results =  [
            'data'            => $results,
            'recordsTotal'    => $this->getRecordsTotal(),
            'recordsFiltered' => $this->getRecordsFiltered(),
            'draw'            => $this->getDraw()
        ];

        return $this;
    }

    /**
     * @return int
     */
    public function getRecordsTotal()
    {
        return $this->recordsTotal;
    }

    /**
     * @param int $recordsTotal
     * @return DataTable
     */
    public function setRecordsTotal($recordsTotal)
    {
        $this->recordsTotal = (int)$recordsTotal;

        return $this;
    }

    /**
     * @return int
     */
    public function getRecordsFiltered()
    {
        return $this->recordsFiltered;
    }

    /**
     * @param int $recordsFiltered
     * @return DataTable
     */
    public function setRecordsFiltered($recordsFiltered)
    {
        $this->recordsFiltered = (int)$recordsFiltered;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param mixed $orderBy
     * @return DataTable
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $order
     * @return DataTable
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param array $request
     * @return DataTable
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @param string $search
     * @return DataTable
     */
    public function setSearch($search)
    {
        $this->search = $search;
        return $this;
    }

    /**
     * @param int $length
     * @return DataTable
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @param int $start
     * @return DataTable
     */
    public function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @param int $draw
     * @return DataTable
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;
        return $this;
    }




}