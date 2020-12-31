# CODE

### Most Recently used


log

```

$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
$logger = new \Zend\Log\Logger();
$logger->addWriter($writer);
$logger->info('Simple Text Log'); // Simple Text Log
$logger->info('Array Log'.print_r($option, true)); // Array Log

```

Use Objectmanager

```

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$carrierHelper = $objectManager->get(\Magento\Shipping\Helper\Carrier::class);

```

php setting

```

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', -1);
error_reporting(E_ALL);

```

Change template of block xml

```

<referenceBlock name="copyright">
    <action method="setTemplate">
        <argument name="template" xsi:type="string">Dfr_Backend::page/copyright.phtml</argument>
    </action>
</referenceBlock>

```

Get frontend attribute value

 ` $etat = $_product->getResource()->getAttribute('etat')->getFrontend()->getValue($_product); `



## Magento 2 Root Script

```

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', -1);
error_reporting(E_ALL);

use Magento\Framework\App\Bootstrap;

require 'app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);

$objectManager = $bootstrap->getObjectManager();

$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');
//$state->setAreaCode('adminhtml');

/** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $products */
$products = $objectManager->create('\Magento\Catalog\Model\ResourceModel\Product\Collection')
    ->addAttributeToSelect(['entity_id','sku'])
    ->addFieldToFilter('description', ['like' => '%{{skin url="images/seringue.gif"}}%']);
echo $products->getSelectSql(true);

```

## Magento 2 Create product custom option programetically

### Using event observer `catalog_product_save_after`
```
public function getOptions($product)
    {
        $values = [
            [
                'record_id'=>0,
                'title'=>'Option 1',
                'price'=>0,
                'price_type'=>"fixed",
                'sort_order'=>1,
                'sku' => "option_one", //code
                'is_delete'=>0
            ],
            [
                'record_id'=>1,
                'title'=>'Option 2',
                'price'=>$product->getCustomAttributeVal(),
                'price_type'=>"fixed",
                'sort_order'=>1,
                'sku' => "option_two", //code
                'is_delete'=>0
            ]
        ];

        $options = [
            [
                "sort_order"    => 1,
                "title"         => "Title", // Title of select box
                "price_type"    => "fixed", //type of price fixed / percent
                "price"         => "", // price
                "sku"           => "code", // code
                "type"          => "drop_down",
                "is_require"    => 1,
                "values"        => $values
            ]
        ];

        return $options;
    }
    
    protected function generateOptions($productId)
    {
        $product = $this->product->load($productId);
        $product->setHasOptions(1);
        $product->setCanSaveCustomOptions(true);
        foreach ($this->getOptions($product) as $arrayOption) {
            $option = $this->option
                ->setProductId($productId)
                ->setStoreId($product->getStoreId())
                ->addData($arrayOption);
            $option->save();
            $product->addOption($option);
        }
        $this->logger->log('info', 'Create Custom Options successfully');
    }
```

### Using Before plugin

```
class Save
{
    public function beforeExecute(\Magento\Catalog\Controller\Adminhtml\Product\Save $subject)
    {
        $req = $subject->getRequest()->getPostValue();

        if($req['product']['sku'] == "demo"){

            if (!empty($req['product']['price_if_he_pays_the_deposit'])) {

                $values = [
                    [
                        'record_id' => 1,
                        'title' => 'option 1 + ' . $req['product']['custom_attribute'] . "€",
                        'price' => 0,
                        'price_type' => "fixed",
                        'sort_order' => 1,
                        'sku' => "first",
                        'is_delete' => 0
                    ],
                    [
                        'record_id' => 2,
                        'title' => 'option 2',
                        'price' => 0,
                        'price_type' => "fixed",
                        'sort_order' => 1,
                        'sku' => "second",
                        'is_delete' => 0
                    ]
                ];

                $options = [

                    "sort_order" => 1,
                    "title" => "title",
                    'sku' => "code", // dropdown code
                    "price_type" => "fixed",
                    "price" => "",
                    "type" => "drop_down",
                    "is_require" => "1",
                    "values" => $values

                ];
                if (isset($req['product']['options'])) {
                    $updateOption = [];
                    foreach ($req['product']['options'] as $option) {
                        if ($option['sku'] != 'code') { // dropdown code
                            $updateOption[] = $option;
                        }
                    }
                    $req['product']['options'] = $updateOption;
                }
                $req['product']['affect_product_custom_options'] = 1;
                $req['product']['options'][] = $options;
            } else {
                if (isset($req['product']['options'])) {
                    $updateOption = [];
                    foreach ($req['product']['options'] as $option) {
                        if ($option['sku'] != 'code') { // dropdown code
                            $updateOption[] = $option;
                        }
                    }
                    $req['product']['options'] = $updateOption;
                }

            }
            $subject->getRequest()->setPostValue($req);
        }
    }
}

```

## Magento 2 Update mass Product description

```

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '5G');
error_reporting(E_ALL);

$url='localhost:3306';
$username='magento2_db';
$password='pass';
$db = "mage_v241";

$conn=mysqli_connect($url,$username,$password,$db);

if(!$conn){
    die('Could not Connect My Sql:' .mysql_error());
}

$mysqli = new mysqli($url,$username,$password,$db);

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

$result = mysqli_query($conn,"SELECT * FROM `catalog_product_entity_text` WHERE `value` LIKE '%{{skin url=\"images/seringue.gif\"}}%'");
echo "entity id";
while($row = mysqli_fetch_array($result)) {
    echo "<br>";
    echo $row['entity_id'];
    $description = str_replace('{{skin url="images/seringue.gif"}}','{{media url=&quot;wysiwyg/seringue.gif&quot;}}',$row['value']);
    $description = $mysqli -> real_escape_string($description);
    $sql = "UPDATE `catalog_product_entity_text` SET `value` = '".$description."' WHERE `value_id` = '".$row['value_id']."';";
    mysqli_query($conn,$sql);
}
?>
```
