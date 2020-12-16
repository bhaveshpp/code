### Code

```
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', -1);
error_reporting(E_ALL);

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$carrierHelper = $objectManager->get(\Magento\Shipping\Helper\Carrier::class);

/* Get frontend attribute value */
$etat = $_product->getResource()->getAttribute('etat')->getFrontend()->getValue($_product);

<referenceBlock name="copyright">
    <action method="setTemplate">
        <argument name="template" xsi:type="string">Dfr_Backend::page/copyright.phtml</argument>
    </action>
</referenceBlock>


$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
$logger = new \Zend\Log\Logger();
$logger->addWriter($writer);
$logger->info('Simple Text Log'); // Simple Text Log
$logger->info('Array Log'.print_r($option, true)); // Array Log

```

## Magento 2 Create product custom option programetically

```
public function getOptions($product)
    {$values = [
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

## Magento 1 create user using SQL

```
LOCK TABLES `admin_role` WRITE , `admin_user` WRITE;
 
SET @SALT = "rp";
SET @PASS = CONCAT(MD5( CONCAT(@SALT, "Developer@test") ), CONCAT(":", @SALT));
SELECT @EXTRA := MAX(extra) FROM admin_user WHERE extra IS NOT NULL;
 
INSERT INTO `admin_user` (firstname, lastname, email, username, password, created, lognum, reload_acl_flag, is_active, extra, rp_token_created_at) 
VALUES ('Developer', 'Iturbo', 'developer@test.com', 'developer_', @PASS,NOW(), 0, 0, 1, @EXTRA,NOW());
 
INSERT INTO `admin_role` (parent_id, tree_level, sort_order, role_type, user_id, role_name) 
VALUES (1, 2, 0, 'U', (SELECT user_id FROM admin_user WHERE username = 'developer_'), 'Developer');
 
UNLOCK TABLES;

```



```markdown
Syntax highlighted code block

# Header 1
## Header 2
### Header 3

- Bulleted
- List

1. Numbered
2. List

**Bold** and _Italic_ and `Code` text

[Link](url) and ![Image](src)
```

