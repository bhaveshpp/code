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

short code for log

```
# Place logs in var/log/debug.log 
$logger = \Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class);
$logger->info('Price');
$logger->log(100,print_r($items->getData(),true));
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

### [Root scripts](https://bhaveshpp.github.io/code/M2/root-scripts/)

### [Product Custom Options](https://bhaveshpp.github.io/code/M2/product-custom-option/)
