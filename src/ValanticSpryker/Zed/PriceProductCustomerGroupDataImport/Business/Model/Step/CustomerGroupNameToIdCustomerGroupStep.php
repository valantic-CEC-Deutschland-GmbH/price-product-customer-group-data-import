<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\Step;

use Orm\Zed\CustomerGroup\Persistence\Map\SpyCustomerGroupTableMap;
use Orm\Zed\CustomerGroup\Persistence\SpyCustomerGroupQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\DataSet\PriceProductCustomerGroupDataSetInterface;

class CustomerGroupNameToIdCustomerGroupStep implements DataImportStepInterface
{
    /**
     * @var array
     */
    protected $idCustomerGroupCache = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $customerGroupName = $dataSet[PriceProductCustomerGroupDataSetInterface::CUSTOMER_GROUP_NAME];
        if (!isset($this->idCustomerGroupCache[$customerGroupName])) {
            $customerGroupEntity = SpyCustomerGroupQuery::create()
                ->filterByName($customerGroupName)
                ->findOneOrCreate();

            if ($customerGroupEntity->isNew()) {
                $customerGroupEntity->save();
            }

            $this->idCustomerGroupCache[$customerGroupName] = $customerGroupEntity->getIdCustomerGroup();
        }

        $dataSet[PriceProductCustomerGroupDataSetInterface::ID_CUSTOMER_GROUP] = $this->idCustomerGroupCache[$customerGroupName];
    }
}
