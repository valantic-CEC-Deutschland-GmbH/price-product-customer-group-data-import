<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\Step;

use Orm\Zed\PriceProduct\Persistence\Map\SpyPriceTypeTableMap;
use Orm\Zed\PriceProduct\Persistence\SpyPriceProductQuery;
use Orm\Zed\PriceProduct\Persistence\SpyPriceTypeQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\DataSet\PriceProductCustomerGroupDataSetInterface;

class IdPriceProductStep implements DataImportStepInterface
{
    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $priceTypeEntity = SpyPriceTypeQuery::create()
            ->filterByName($dataSet[PriceProductCustomerGroupDataSetInterface::PRICE_TYPE])
            ->findOneOrCreate();

        if ($priceTypeEntity->isNew() || $priceTypeEntity->isModified()) {
            $priceTypeEntity->setPriceModeConfiguration(SpyPriceTypeTableMap::COL_PRICE_MODE_CONFIGURATION_BOTH);
            $priceTypeEntity->save();
        }

        $priceProductQuery = SpyPriceProductQuery::create();
        $priceProductQuery->filterByFkPriceType($priceTypeEntity->getIdPriceType());

        if (!empty($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_CONCRETE])) {
            $priceProductQuery->filterByFkProduct($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_CONCRETE]);
        } else {
            $priceProductQuery->filterByFkProductAbstract($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_ABSTRACT]);
        }
        $productPriceEntity = $priceProductQuery->findOneOrCreate();
        $productPriceEntity->save();

        $dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRICE_PRODUCT] = $productPriceEntity->getIdPriceProduct();
    }
}
