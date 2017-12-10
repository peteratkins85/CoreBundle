<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 01/12/2016
 * Time: 07:24
 */

namespace App\Oni\CoreBundle\Common;


use Doctrine\Common\Persistence\ObjectRepository;
use App\Oni\CoreBundle\Common\CoreCommon;
use App\Oni\CoreBundle\Common\DataTable;
use App\Oni\CoreBundle\Common\DataTableQueryManager;
use App\Oni\CoreBundle\Entity\Repository\RepositorySpecificationInterface;
use Oni\ProductManagerBundle\Doctrine\Spec\ProductCategory\ProductCategorySearch;
use App\Oni\CoreBundle\Doctrine\Spec\LocaleTrait;
use Exception;

class DoctrineSpecificationQueryManager extends DataTableQueryManager
{

    use LocaleTrait;

    /**
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $specificationClass;

    /**
     * @var DataTable
     */
    protected $dataTable;

    public function __construct(RepositorySpecificationInterface $repository, string $specificationClass, string $locale)
    {
        if (empty($locale)) {
            throw new Exception('Locale must be set on the request query');
        }

        if (!class_exists($specificationClass)){
            throw new Exception('Invalid class '. $specificationClass . ' does not exist!');
        }

        $this->specificationClass = $specificationClass;
        $this->setLocale($locale);
        $this->repository = $repository;
    }

    /**
     * @param DataTable $dataTable
     * @return mixed
     */
    public function queryData(DataTable $dataTable)
    {
        $this->dataTable = $dataTable;
        $this->queryTotalRecords();

        if ($this->dataTable->getSearch()){
            $this->queryTotalRecords(true);
        }

        $params = [
            'locale' => $this->locale,
            'order'  => $this->dataTable->getOrder(),
            'orderBy'=> $this->dataTable->getOrderBy(),
            'offset' => $this->dataTable->getStart(),
            'search' => $this->dataTable->getSearch(),
            'fields' => $this->dataTable->getFields(),
        ];

        $specification = new $this->specificationClass($params);
        $results = $this->repository->match($specification);
        $results = CoreCommon::formatDateTimeResultsInArrayRecursive($results, 'jS M H:i:s');
        return $results;

    }

    public function queryTotalRecords($includeFilter = false)
    {
        $params = [
            'getRecordCount' => true,
            'locale' => $this->locale
        ];

        if ($includeFilter){
            $params['includeFilterOnGetRecordCount'] = true;
        }

        $countSpec = new $this->specificationClass($params);

        $totalCount = $this->repository->match($countSpec);
        $totalCount = isset($totalCount[0]['total']) ? $totalCount[0]['total'] : 0;

        if ($includeFilter){
            $this->setFilteredResultTotal($totalCount);
        }else {
            $this->setResultTotal($totalCount);
        }

        if (!$includeFilter && !$this->dataTable->getSearch()){
            $this->setFilteredResultTotal($totalCount);
        }

    }


}