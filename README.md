# Price Product Customer Group Data Import

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.3-8892BF.svg)](https://php.net/)

This module has demo data and importer for price products for customer groups.

### Install package
```
composer req valantic-spryker/price-product-customer-group-data-import
```

### Register plugins
`src/Pyz/Zed/DataImport/DataImportDependencyProvider.php`

```
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Communication\Plugin\PriceProductCustomerGroupDataImportPlugin;

...

protected function getDataImporterPlugins(): array
{
    return [
        ...
        new PriceProductCustomerGroupDataImportPlugin(),
    ];
}
```

`src/Pyz/Zed/Console/ConsoleDependencyProvider.php`

```
use ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\PriceProductCustomerGroupDataImportConfig;

...

protected function getConsoleCommands(Container $container): array
{
    $commands = [
        ...
        new DataImportConsole(DataImportConsole::DEFAULT_NAME . ':' . PriceProductCustomerGroupDataImportConfig::IMPORT_TYPE_PRICE_PRODUCT_CUSTOMER_GROUP),
    ];
}
```
