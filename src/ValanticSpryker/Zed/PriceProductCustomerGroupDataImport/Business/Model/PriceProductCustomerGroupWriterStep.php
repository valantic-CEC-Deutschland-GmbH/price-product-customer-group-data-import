<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model;

use Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroup;
use Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroupQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use ValanticSpryker\Shared\PriceProductCustomerGroupDataImport\PriceProductCustomerGroupDataImportConstants;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\DataSet\PriceProductCustomerGroupDataSetInterface;

class PriceProductCustomerGroupWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $priceProductCustomerGroupEntity = $this->findExistingPriceProductStoreEntity($dataSet);

        $idPriceProductStore = $dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRICE_PRODUCT_STORE];
        if (
            $priceProductCustomerGroupEntity
            && $priceProductCustomerGroupEntity->getFkPriceProductStore() === $idPriceProductStore
        ) {
            return;
        }

        if (!$priceProductCustomerGroupEntity) {
            $priceProductCustomerGroupEntity = (new VsyPriceProductCustomerGroup())
                ->setFkCustomerGroup($dataSet[PriceProductCustomerGroupDataSetInterface::ID_CUSTOMER_GROUP]);

            if (!empty($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_ABSTRACT])) {
                $priceProductCustomerGroupEntity->setFkProductAbstract($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_ABSTRACT]);
            } else {
                $priceProductCustomerGroupEntity->setFkProduct($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_CONCRETE]);
            }
        }

        $priceProductCustomerGroupEntity->setFkPriceProductStore($idPriceProductStore);

        $eventName = $priceProductCustomerGroupEntity->isNew()
            ? PriceProductCustomerGroupDataImportConstants::ENTITY_SPY_PRICE_PRODUCT_CUSTOMER_GROUP_CREATE
            : PriceProductCustomerGroupDataImportConstants::ENTITY_SPY_PRICE_PRODUCT_CUSTOMER_GROUP_UPDATE;

        $priceProductCustomerGroupEntity->save();

        $this->addPublishEvents(
            $eventName,
            (int)$priceProductCustomerGroupEntity->getPrimaryKey(),
        );
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Orm\Zed\PriceProductCustomerGroup\Persistence\VsyPriceProductCustomerGroup|null
     */
    protected function findExistingPriceProductStoreEntity(DataSetInterface $dataSet): ?VsyPriceProductCustomerGroup
    {
        $query = VsyPriceProductCustomerGroupQuery::create()
            ->usePriceProductStoreQuery()
            ->filterByFkStore($dataSet[PriceProductCustomerGroupDataSetInterface::ID_STORE])
            ->filterByFkCurrency($dataSet[PriceProductCustomerGroupDataSetInterface::ID_CURRENCY])
            ->filterByFkPriceProduct($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRICE_PRODUCT])
            ->endUse()
            ->filterByFkCustomerGroup($dataSet[PriceProductCustomerGroupDataSetInterface::ID_CUSTOMER_GROUP]);

        if (!empty($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_ABSTRACT])) {
            $query->filterByFkProductAbstract($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_ABSTRACT]);
        } else {
            $query->filterByFkProduct($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_CONCRETE]);
        }

        return $query->findOne();
    }
}
