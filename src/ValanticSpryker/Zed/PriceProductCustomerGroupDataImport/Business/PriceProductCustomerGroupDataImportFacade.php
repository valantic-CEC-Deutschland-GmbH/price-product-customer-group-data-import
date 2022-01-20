<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\PriceProductCustomerGroupDataImportBusinessFactory getFactory()
 */
class PriceProductCustomerGroupDataImportFacade extends AbstractFacade implements PriceProductCustomerGroupDataImportFacadeInterface
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
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFactory()
            ->createPriceProductCustomerGroupDataImport()
            ->import($dataImporterConfigurationTransfer);
    }
}
