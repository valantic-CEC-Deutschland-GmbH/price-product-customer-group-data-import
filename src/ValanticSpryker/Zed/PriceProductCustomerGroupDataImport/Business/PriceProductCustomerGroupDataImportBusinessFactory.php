<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business;

use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\PriceProductCustomerGroupWriterStep;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\Step\CurrencyToIdCurrencyStep;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\Step\IdPriceProductStep;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\Step\CustomerGroupNameToIdCustomerGroupStep;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\Step\ProductSkuToIdProductStep;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\Step\StoreToIdStoreStep;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\PriceProductStore\IdPriceProductStoreStep;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\PriceProductCustomerGroupDataImportConfig getConfig()
 */
class PriceProductCustomerGroupDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterAfterImportAwareInterface|\Spryker\Zed\DataImport\Business\Model\DataImporterBeforeImportAwareInterface|\Spryker\Zed\DataImport\Business\Model\DataImporterInterface|\Spryker\Zed\DataImport\Business\Model\DataSet\DataSetStepBrokerAwareInterface
     */
    public function createPriceProductCustomerGroupDataImport()
    {
        $dataImporter = $this->getCsvDataImporterFromConfig(
            $this->getConfig()->getPriceProductCustomerGroupDataImporterConfiguration(),
        );

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep($this->createCustomerGroupToIdCustomerGroupStep())
            ->addStep($this->createProductSkuToIdProductStep())
            ->addStep($this->createStoreToIdStoreStep())
            ->addStep($this->createCurrencyToIdCurrencyStep())
            ->addStep($this->createIdPriceProductStep())
            ->addStep($this->createIdPriceProductStoreStep())
            ->addStep($this->createPriceProductCustomerGroupWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createCustomerGroupToIdCustomerGroupStep(): DataImportStepInterface
    {
        return new CustomerGroupNameToIdCustomerGroupStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createProductSkuToIdProductStep(): DataImportStepInterface
    {
        return new ProductSkuToIdProductStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createStoreToIdStoreStep(): DataImportStepInterface
    {
        return new StoreToIdStoreStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createCurrencyToIdCurrencyStep(): DataImportStepInterface
    {
        return new CurrencyToIdCurrencyStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createIdPriceProductStep(): DataImportStepInterface
    {
        return new IdPriceProductStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createIdPriceProductStoreStep(): DataImportStepInterface
    {
        return new IdPriceProductStoreStep();
    }

    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface
     */
    public function createPriceProductCustomerGroupWriterStep(): DataImportStepInterface
    {
        return new PriceProductCustomerGroupWriterStep();
    }
}
