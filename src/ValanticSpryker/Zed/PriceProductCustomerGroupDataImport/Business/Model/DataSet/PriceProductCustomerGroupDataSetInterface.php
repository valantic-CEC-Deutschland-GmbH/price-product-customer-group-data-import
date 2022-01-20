<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\PriceProductCustomerGroupDataImport\Business\Model\DataSet;

interface PriceProductCustomerGroupDataSetInterface
{
    /**
     * @var string
     */
    public const CUSTOMER_GROUP_NAME = 'customer_group_name';

    /**
     * @var string
     */
    public const ABSTRACT_SKU = 'abstract_sku';

    /**
     * @var string
     */
    public const CONCRETE_SKU = 'concrete_sku';

    /**
     * @var string
     */
    public const PRICE_TYPE = 'price_type';

    /**
     * @var string
     */
    public const STORE = 'store';

    /**
     * @var string
     */
    public const CURRENCY = 'currency';

    /**
     * @var string
     */
    public const PRICE_NET = 'price_net';

    /**
     * @var string
     */
    public const PRICE_GROSS = 'price_gross';

    /**
     * @var string
     */
    public const ID_CURRENCY = 'id_currency';

    /**
     * @var string
     */
    public const ID_PRICE_PRODUCT = 'id_price_product';

    /**
     * @var string
     */
    public const ID_PRICE_PRODUCT_STORE = 'id_price_product_store';

    /**
     * @var string
     */
    public const ID_CUSTOMER_GROUP = 'id_customer_group';

    /**
     * @var string
     */
    public const ID_PRODUCT_ABSTRACT = 'id_product_abstract';

    /**
     * @var string
     */
    public const ID_PRODUCT_CONCRETE = 'id_product';

    /**
     * @var string
     */
    public const ID_STORE = 'id_store';
}
