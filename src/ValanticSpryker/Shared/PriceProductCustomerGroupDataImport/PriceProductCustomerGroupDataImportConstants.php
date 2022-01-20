<?php

declare(strict_types = 1);

namespace ValanticSpryker\Shared\PriceProductCustomerGroupDataImport;

interface PriceProductCustomerGroupDataImportConstants
{
    /**
     * @uses \ValanticSpryker\Zed\PriceProductCustomerGroup\Dependency\PriceProductCustomerGroupEvents::ENTITY_SPY_PRICE_PRODUCT_STORE_CREATE
     *
     * @var string
     */
    public const ENTITY_SPY_PRICE_PRODUCT_STORE_CREATE = 'Entity.spy_price_product_store.create';

    /**
     * @uses \ValanticSpryker\Zed\PriceProductCustomerGroup\Dependency\PriceProductCustomerGroupEvents::ENTITY_SPY_PRICE_PRODUCT_STORE_UPDATE
     *
     * @var string
     */
    public const ENTITY_SPY_PRICE_PRODUCT_STORE_UPDATE = 'Entity.spy_price_product_store.update';

    /**
     * @var string
     */
    public const ENTITY_SPY_PRICE_PRODUCT_CUSTOMER_GROUP_CREATE = 'Entity.spy_price_product_customer_group.create';

    /**
     * @var string
     */
    public const ENTITY_SPY_PRICE_PRODUCT_CUSTOMER_GROUP_UPDATE = 'Entity.spy_price_product_customer_group.update';
}
