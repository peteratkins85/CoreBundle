<?php

namespace Oni\CoreBundle\Common;


interface DataTableQueryManagerInterface
{
    public function queryData(DataTable $dataTable);

    public function getResultTotal();

    public function getFilteredResultTotal();
}