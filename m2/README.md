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

## root script

```php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', -1);
error_reporting(E_ALL);
function prir($data = '') { error_log(print_r($data, true)."\n", 3, __DIR__.'/var/log/test.log'); }
use Magento\Framework\App\Bootstrap;
require 'app/bootstrap.php';
try{
    $bootstrap = Bootstrap::create(BP, $_SERVER);
    $objectManager = $bootstrap->getObjectManager();

    $state = $objectManager->get(\Magento\Framework\App\State::class);
    $state->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND);
//    $classResource = $objectManager->create(\SeePossible\ReComputeBarcodeOrder\Model\ResourceModel\PriceDiff::class);
//    $classFactory = $objectManager->create(\SeePossible\ReComputeBarcodeOrder\Model\PriceDiffFactory::class);
//    $classObj = $classFactory->create();
//    $classObj->setOrderItemId(3);
//    $classObj->setCartRuleAction(json_encode(['key'=>'value']));
//    print_r(get_class($classResource->save($classObj)));

//    $class = $objectManager->get(\Magento\Sales\Model\OrderRepository::class);
//    $class = $objectManager->get(\Magento\Sales\Model\Order\ItemRepository::class);
//    $item = $class->get(1071);
//    $class = $objectManager->get(\SeePossible\ReComputeBarcodeOrder\Model\OrderService::class);
//    $class->updateOrderItem($item);
//    $class = $objectManager->get(\Magento\SalesRule\Api\RuleRepositoryInterface::class);
//
//    $rule = $class->getById(77);
//
//    foreach ($rule->getCondition()->getConditions() as $condition){
//        print_r(get_class_methods($condition));
//
//    }

//    $class = $objectManager->get(\SeePossible\MonthlyPlan\Cron\UpdateEmiStatus::class);
//    $class->execute();
//    $class = $objectManager->get(\SeePossible\MonthlyPlan\Cron\SendReminder::class);
//    $class->execute();
//    $class = $objectManager->get(\SeePossible\MonthlyPlan\Cron\UpdateSubscriptionStatus::class);
//    $class->execute();
//    $class = $objectManager->get(\SeePossible\MonthlyPlan\Model\SubscriptionRepository::class);
//    $order = $class->getById(1);
//    echo $class->getMaturityAmount($order);
//    echo $class->getPrincipalAmount($order);
//    $class = $objectManager->get(\SeePossible\ReComputeBarcodeOrder\Model\OrderService::class);
//    $class->saveOrderTimeSetting($order);
//    $class = $objectManager->get(\SeePossible\MonthlyPlan\Helper\Data::class);
//    echo $class->getBonusReduction(10000,2);
//    $class = $objectManager->get(\SeePossible\SalesDocumentSeries\Helper\SeriesResetCron::class);
//    $class->truncatSubsequenceTables('customer_gold_credit', 1);

//    $class = $objectManager->get(\Magenest\InstagramShop\Model\CronJob\Photo::class);
//    $class->getWebsiteScope();
//    $class = $objectManager->get(\Magenest\InstagramShop\Model\CronJob\Story::class);
//    $class->getInstagramStories();
//    $class = $objectManager->get(\Magenest\InstagramShop\Model\CronJob\Story::class);
//    $class->checkStoryExpiration();
//    $class = $objectManager->get(\Magenest\InstagramShop\Model\CronJob\SearchHashtag::class);
//    $class->getTopPhotos();

//    $class = $objectManager->get(\Magenest\InstagramShop\Model\Indexer\Photo::class);
//    $class->executeFull();
//    $class = $objectManager->get(\Magenest\InstagramShop\Model\Indexer\TopPhotos::class);
//    $class->executeFull();

//    $class = $objectManager->get(\Magenest\InstagramShop\Model\Indexer\TopPhotos::class);
//    $class->executeFull();
//echo "https://www.facebook.com/dialog/oauth?client_id=" . 936760997448669
//    . "&redirect_uri=" . "https://py.px.seepossible.link/"
//    . "&scope=" . implode(",", [
//        'manage_pages',
//        'instagram_basic',
//        'instagram_manage_insights',
//        'pages_read_engagement',
//        'pages_show_list'
//    ])
//    . "&state=" . "https://py.px.seepossible.link/static.php";

    $class = $objectManager->get(\Magento\Sales\Model\OrderRepository::class);
    $order = $class->get(1);
    $class = $objectManager->get(\Magento\Sales\Model\Order\Email\Sender\OrderSender::class);
    $class->send($order,true);
//echo 2/0;

//    $class = $objectManager->get(\SeePossible\CustomerDeleteRequest\Model\Request::class)->sent(870,'bhavesh+delete@seepossible.com','delete me');
//    $class = $objectManager->get(\SeePossible\MonthlyPlan\Model\RefundService::class)->refundCompleted($class);
//echo "ram:";
//
//    $class = $objectManager->get(\SeePossible\MonthlyPlan\Model\SubscriptionRepository::class);
//    echo $class->getMaturityAmount($class->getByCode('SVGBP-5EXAV'));
//    $class = $objectManager->get(\Magento\CatalogRule\Model\ResourceModel\Rule\CollectionFactory::class);
//    print_r($class->create()->getData());
//
//    $class = $objectManager->get(\SeePossible\JewelryPriceRules\Model\Attribute\Source\RulesOptions::class);
//    print_r($class->getAllOptions());
} catch (\Exception $e) {
    print_r(get_class_methods($e));
    print_r($e->getCode());
    print_r($e->getMessage());
    print_r($e->getTraceAsString());
}

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
