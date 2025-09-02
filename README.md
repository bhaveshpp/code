# CODE

### Most Recently used

log

```php

// add this code to the bootstrap file and use shortcut prir

function prir($data = '') { error_log(print_r($data, 1)."\n", 3,BP."/var/log/test.log");}

// core

error_log(print_r($queryString, 1)."\n", 3,BP."/var/log/test.log");

//new

$writer = new \Zend_Log_Writer_Stream(BP . '/var/log/test.log');
$logger = new \Zend_Log();
$logger->addWriter($writer);
$logger->info(__FILE__."::".__LINE__);

// old 

$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
$logger = new \Zend\Log\Logger();
$logger->addWriter($writer);
$logger->info('Simple Text Log'); // Simple Text Log
$logger->info('Array Log'.print_r($option, true)); // Array Log

```

short code for log

```php

# Place logs in var/log/debug.log 
$logger = \Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class);
$logger->info('Price');
$logger->log(100,print_r($items->getData(),true));

```

Log for php

```php

    function testlog($txt)
    {
        file_put_contents('20210724-description-update.log', utf8_encode($txt).PHP_EOL , FILE_APPEND | LOCK_EX);
        file_put_contents('20210724-description-update.log', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
    }
    testlog("Entity Id: ".$row['entity_id']);
    testlog("Value Id: ".$row['value_id']);
    testlog("Value: ".$row['value']);
    testlog("");
    testlog("********************************");

```

Log for Magento 1

```
Mage::log(__FILE__.'::'.__LINE__,null,'test.log',true);

```

Use Objectmanager

```php

$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$carrierHelper = $objectManager->get(\Magento\Shipping\Helper\Carrier::class);

```

php setting

```php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', -1);
error_reporting(E_ALL);

```
php trace as string

```php 

$e = new \Exception;
var_dump($e->getTraceAsString());

```
