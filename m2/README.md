## Useful file.

```
vendor/magento/framework/Data/Collection.php
vendor/magento/framework/App/FrontController.php
vendor/magento/framework/App/Router/ActionList.php
vendor/magento/framework/View/Layout/Builder.php
\Magento\Framework\App\Http\Context::getVaryString

# Admin login issue
vendor/magento/module-backend/Model/Auth.php
```


## Query builder.

```
$connection = $this->resource->getConnection();
            $catalogProductEntityTable = $this->resource->getTableName('catalog_product_entity');
            $catalogProductEntityIntTable = $this->resource->getTableName('catalog_product_entity_int');
            $select = $connection->select()->from(
                $catalogProductEntityTable,
                ['entity_id']
            )->join(
                $catalogProductEntityIntTable,
                $catalogProductEntityTable . '.entity_id = ' . $catalogProductEntityIntTable . '.entity_id',
                ['value', 'attribute_id']
            )->where($catalogProductEntityTable . '.entity_id IN (?)', $childrenIds[0]
            )->where($catalogProductEntityIntTable . '.attribute_id=' . $this->getAttributeId()
            )->where($catalogProductEntityIntTable . '.value=' . Status::STATUS_ENABLED)->distinct(true);
            return array_column($connection->fetchAll($select), 'entity_id');
```


# CMS BLOCK AND PAGE AND EMAIL TEMPLATE

Translate inline

{% raw %}
```
<h1 class="hero-h1">{{trans "Welcome to this website" }}</h1>

Call Template in cms block

{{block class="Magento\Framework\View\Element\Template" template="Altravista_Carousel::product/carousel.phtml" cat="3"}}

Get Store Url

{{store url=""}}

{{store url="category-url"}}

Call CMS Block inside another CMS Block

{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="1"}}

{{block type="cms/block" block_id="your_block_id"}}

```

### Email template variables

| Variable | Markup tag |
| ------ | ------ |
| Email Footer Template | {{template config_path="design/email/footer_template"}} |
| Email Header Template | {{template config_path="design/email/header_template"}} |
| Email Logo Image Alt | {{var logo_alt}} |
| Email Logo Image URL | {{var logo_url}} |
| Email Logo Image Height | {{var logo_height}} |
| Email Logo Image Width | {{var logo_width}} |
| Template CSS | {{var template_styles|raw}} |
| Add config | {{config path='trans_email/ident_support/email'}} |


### Store contact information variables

| Variable | Markup tag |
| ------ | ------ |
| Base Unsecure URL | {{config path="web/unsecure/base_url"}} |
| Base Secure URL | {{config path="web/secure/base_url"}} |
| General Contact Name | {{config path="trans_email/ident_general/name"}} |
| General Contact Email | {{config path="trans_email/ident_general/email"}} |
| Sales Representative Contact Name | {{config path="trans_email/ident_sales/name"}} |
| Sales Representative Contact Email | {{config path="trans_email/ident_sales/email"}} |
| Customer Support Name | {{config path="trans_email/ident_support/name"}} |
| Customer Support Email | {{config path="trans_email/ident_support/email"}} |
| Custom1 Contact Name | {{config path="trans_email/ident_custom1/name"}} |
| Custom1 Contact Email | {{config path="trans_email/ident_custom1/email"}} |
| Custom2 Contact Name | {{config path="trans_email/ident_custom2/name"}} |
| Custom2 Contact Email | {{config path="trans_email/ident_custom2/email"}} |
| Store Name | {{config path="general/store_information/name"}} |
| Store Phone Telephone | {{config path="general/store_information/phone"}} |
| Store Hours | {{config path="general/store_information/hours"}} |
| Country | {{config path="general/store_information/country_id"}} |
| Region/State | {{config path="general/store_information/region_id"}} |
| Zip/Postal Code | {{config path="general/store_information/postcode"}} |
| City | {{config path="general/store_information/city"}} |
| Street Address 1 | {{config path="general/store_information/street_line1"}} |
| Street Address 2 | {{config path="general/store_information/street_line2"}} |
| Store Contact Address | {{config path="general/store_information/address"}} |
| VAT Number | {{config path="general/store_information/merchant_vat_number"}} |

### New account template variables

| Variable | Markup tag |
| ------ | ------ |
| Customer Account URL | {{var this.getUrl($store, 'customer/account/')}} |
| Customer Email | {{var customer.email}} |
| Customer Name | {{var customer.name}} |

### New order template variables

| Variable | Markup tag |
| ------ | ------ |
| Billing Address | {{var formattedBillingAddress|raw}} |
| Email Order Note | {{var order.getEmailCustomerNote()}} |
| Order ID | {{var order.increment_id}} |
| Order Items Grid | {{layout handle="sales_email_order_items" order=$order area="frontend"}} |
| Payment Details | {{var payment_html|raw}} |
| Shipping Address | {{var formattedShippingAddress|raw}} |
| Shipping Description | {{var order.getShippingDescription()}} |


{% endraw %}
