<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Communication\Plugin;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\PriceProductCustomerGroupDataImportConfig;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\PriceProductCustomerGroupDataImportFacadeInterface getFacade()
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\PriceProductCustomerGroupDataImportConfig getConfig()
 */
class PriceProductCustomerGroupDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null
    ): DataImporterReportTransfer {
        return $this->getFacade()
            ->import($dataImporterConfigurationTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string
     */
    public function getImportType(): string
    {
        return PriceProductCustomerGroupDataImportConfig::IMPORT_TYPE_PRICE_PRODUCT_CUSTOMER_GROUP;
    }
}
