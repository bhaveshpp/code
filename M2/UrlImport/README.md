## Script

```
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', -1);
error_reporting(E_ALL);

if (PHP_SAPI !== 'cli') {
    echo 'Must be run as a CLI application';
    exit(1);
}

use Magento\Framework\App\Bootstrap;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\UrlRewrite\Model\UrlFinderInterface;
use Magento\UrlRewrite\Service\V1\Data\UrlRewrite;

require __DIR__ . '/../public_html/app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);

$objectManager = $bootstrap->getObjectManager();

$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

if (1 < count($argv)){
    $file = $argv[1];
    echo("\n");
    $row = 0;
    $success = 0;
    $alreadyExist = 0;
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            $row++;
            try {
                $urlData = getUrlData($data); 
                $urlRewrite = $objectManager->create(\Magento\UrlRewrite\Model\UrlRewrite::class);
                $urlRewrite->load(0);
                $model = $urlRewrite;
                
                $objectManager->get(\Magento\UrlRewrite\Helper\UrlRewrite::class)->validateRequestPath($urlData['request_path']);
                $model->setEntityType($urlData['entity_type'])
                    ->setRequestPath($urlData['request_path'])
                    ->setTargetPath($urlData['target_path'])
                    ->setRedirectType($urlData['redirect_type'])
                    ->setStoreId($urlData['store_id'])
                    ->setDescription($urlData['description']);
                $model->save();   
                echo("\n Url Imported");
                $success++;
            } catch (\Magento\Framework\Exception\AlreadyExistsException $e) {
                echo("\n Url Already Exist");
                $alreadyExist++;
            } catch (\Exception $e) {
                echo $e;
            }         
        }
        fclose($handle);
        echo("\n");
        echo "\n Total Already Exist: ".$alreadyExist;
        echo "\n Total Imported: ".$success;
        echo("\n");
        echo "\n Total Rows: ".$row;
        echo("\n");
    }


}

/**
 * 
 * \Magento\UrlRewrite\Controller\Adminhtml\Url\Rewrite
 * 
 * const ENTITY_TYPE_CUSTOM = 'custom';
 * const ENTITY_TYPE_PRODUCT = 'product';
 * const ENTITY_TYPE_CATEGORY = 'category';
 * const ENTITY_TYPE_CMS_PAGE = 'cms-page';
 * 
 */

function getUrlData($data)
{
    return [
        'entity_type' => $data[0],                                 # entity_type product / category /cms /custom
        'request_path' => $data[1],                                # request_path old URK
        'target_path' => $data[2],                                 # target_path new URK
        'redirect_type' => $data[3],                               # redirect_type 301/302
        'store_id' => $data[4],                                    # store_id 0
        'description' => ($data[5])?$data[5]: "Imported Urls"      # description 0
    ];
}
```

## CSV DATA

```
 "custom","demo-product.html","demo.html",301,"2","Demo product url change to demo"
 "custom","test-product.html","demo.html",301,"2","test product url change to test"
```

## RUN

import from same directory

` # php importUrl testUrls.csv`

Import frome other directory

` # php importUrl ../public_html/var/tmp/testUrls.csv`

