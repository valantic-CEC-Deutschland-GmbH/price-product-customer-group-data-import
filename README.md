# Price Product Customer Group Data Import

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://php.net/)

This module has demo data and importer for price products for customer groups.

## Integration

### Add composer registry
```
composer config repositories.gitlab.nxs360.com/461 '{"type": "composer", "url": "https://gitlab.nxs360.com/api/v4/group/461/-/packages/composer/packages.json"}'
```

### Add Gitlab domain
```
composer config gitlab-domains gitlab.nxs360.com
```

### Authentication
Go to Gitlab and create a personal access token. Then create an **auth.json** file:
```
composer config gitlab-token.gitlab.nxs360.com <personal_access_token>
```

Make sure to add **auth.json** to your **.gitignore**.

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
