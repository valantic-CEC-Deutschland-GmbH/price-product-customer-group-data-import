<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\PriceProductStore;

use Orm\Zed\PriceProduct\Persistence\SpyPriceProductStoreQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\DataSet\PriceProductCustomerGroupDataSetInterface;

class IdPriceProductStoreStep implements DataImportStepInterface
{
    /**
     * @var array<string>
     */
    protected $idPriceProductStoreCache = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRICE_PRODUCT_STORE] = $this->getIdPriceProductStoreEntity($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return string
     */
    protected function getIdPriceProductStoreEntity(DataSetInterface $dataSet): string
    {
        $cacheIndex = $this->buildCacheIndex($dataSet);
        if (isset($this->idPriceProductStoreCache[$cacheIndex])) {
            return $this->idPriceProductStoreCache[$cacheIndex];
        }

        $priceProductStoreEntity = SpyPriceProductStoreQuery::create()
            ->filterByFkStore($dataSet[PriceProductCustomerGroupDataSetInterface::ID_STORE])
            ->filterByFkCurrency($dataSet[PriceProductCustomerGroupDataSetInterface::ID_CURRENCY])
            ->filterByFkPriceProduct($dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRICE_PRODUCT])
            ->filterByNetPrice((int)$dataSet[PriceProductCustomerGroupDataSetInterface::PRICE_NET])
            ->filterByGrossPrice((int)$dataSet[PriceProductCustomerGroupDataSetInterface::PRICE_GROSS])
            ->findOneOrCreate();

        $priceProductStoreEntity->save();

        $this->idPriceProductStoreCache[$cacheIndex] = $priceProductStoreEntity->getIdPriceProductStore();

        return $this->idPriceProductStoreCache[$cacheIndex];
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return string
     */
    protected function buildCacheIndex(DataSetInterface $dataSet): string
    {
        return implode('-', [
            $dataSet[PriceProductCustomerGroupDataSetInterface::ID_STORE],
            $dataSet[PriceProductCustomerGroupDataSetInterface::ID_CURRENCY],
            $dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRICE_PRODUCT],
            $dataSet[PriceProductCustomerGroupDataSetInterface::PRICE_NET],
            $dataSet[PriceProductCustomerGroupDataSetInterface::PRICE_GROSS],
        ]);
    }
}
