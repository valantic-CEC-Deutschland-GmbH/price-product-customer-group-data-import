<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\Step;

use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Spryker\Zed\DataImport\Business\Exception\DataKeyNotFoundInDataSetException;
use Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\DataSet\PriceProductCustomerGroupDataSetInterface;

class ProductSkuToIdProductStep implements DataImportStepInterface
{
    /**
     * @var array
     */
    protected $idProductCache = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\DataKeyNotFoundInDataSetException
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        if (empty($dataSet[PriceProductCustomerGroupDataSetInterface::ABSTRACT_SKU]) && empty($dataSet[PriceProductCustomerGroupDataSetInterface::CONCRETE_SKU])) {
            throw new DataKeyNotFoundInDataSetException(sprintf(
                'One of "%s" or "%s" must be in the data set. Given: "%s"',
                PriceProductCustomerGroupDataSetInterface::ABSTRACT_SKU,
                PriceProductCustomerGroupDataSetInterface::CONCRETE_SKU,
                implode(', ', array_keys($dataSet->getArrayCopy())),
            ));
        }

        $productAbstractSku = $dataSet[PriceProductCustomerGroupDataSetInterface::ABSTRACT_SKU];
        if ($productAbstractSku) {
            $dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_ABSTRACT] = $this->resolveIdProductByAbstractSku($productAbstractSku);
        }

        $productConcreteSku = $dataSet[PriceProductCustomerGroupDataSetInterface::CONCRETE_SKU];
        if ($productConcreteSku) {
            $dataSet[PriceProductCustomerGroupDataSetInterface::ID_PRODUCT_CONCRETE] = $this->resolveIdProductByConcreteSku($productConcreteSku);
        }
    }

    /**
     * @param string $sku
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return int
     */
    protected function resolveIdProductByConcreteSku(string $sku): int
    {
        if (!isset($this->idProductCache[$sku])) {
            $productEntity = SpyProductQuery::create()
                ->findOneBySku($sku);

            if (!$productEntity) {
                throw new EntityNotFoundException(sprintf('Concrete product by sku "%s" not found.', $sku));
            }

            $this->idProductCache[$sku] = $productEntity->getIdProduct();
        }

        return $this->idProductCache[$sku];
    }

    /**
     * @param string $sku
     *
     * @throws \Spryker\Zed\DataImport\Business\Exception\EntityNotFoundException
     *
     * @return int
     */
    protected function resolveIdProductByAbstractSku(string $sku): int
    {
        if (!isset($this->idProductCache[$sku])) {
            $productAbstractEntity = SpyProductAbstractQuery::create()
                ->findOneBySku($sku);

            if (!$productAbstractEntity) {
                throw new EntityNotFoundException(sprintf('Abstract product by sku "%s" not found.', $sku));
            }

            $this->idProductCache[$sku] = $productAbstractEntity->getIdProductAbstract();
        }

        return $this->idProductCache[$sku];
    }
}
