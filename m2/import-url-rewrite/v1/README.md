## Import url rewrite using file upload 

```
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', -1);
error_reporting(E_ALL);

use Magento\Framework\App\Bootstrap;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\UrlRewrite\Model\UrlFinderInterface;
use Magento\UrlRewrite\Service\V1\Data\UrlRewrite;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);

$objectManager = $bootstrap->getObjectManager();

define("PATH", "uploads/");
  if(!empty($_FILES['csv']))
  {
    $uploaderFactory = $objectManager->create(\Magento\MediaStorage\Model\File\UploaderFactory::class);
    $fileSystem = $objectManager->create(\Magento\Framework\Filesystem::class);
    $uploader = $uploaderFactory->create(['fileId' => 'csv']);
    $mediaDirectory = $fileSystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::ROOT);
    $uploader->setAllowRenameFiles(true);
    $result = $uploader->save($mediaDirectory->getAbsolutePath('script/uploads'));
	}
  if ($_POST) {
    if (!empty($_POST['delete'])) {
      $csv = PATH.$_POST['csv'];
      unlink($csv);
      header("Refresh:0; url=import.php");
      exit;
    }
    if (!empty($_POST['import'])) {
      $csv = PATH.$_POST['csv'];
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Upload your files</title>
</head>
<body>
	<img src="format.jpg">
  <form enctype="multipart/form-data" method="POST">
    <p>Upload csv file</p>
    <input type="file" name="csv"></input>
    <input type="submit" value="Upload"></input>
  </form>
  
<?php
  $dir = "uploads";
  $files = scandir($dir);
  if(count($files) > 2):
?>
  <form action="import.php" method="POST">
    <p>import csv file</p>
    <table border='1'>
        <tr>
            <th> # </th>
            <th> File name </th>
        </tr>
        <?php for ($i=2; $i < count($files); $i++) : ?>
        <tr>
            <td>
                <input type="radio" name="csv" value="<?= $files[$i]?>"></input>
            </td>
            <td>
                <strong class="file-nmae"><?= $files[$i]?></strong>
            </td>
        </tr>
        <?php endfor;?>
    </table>
    <input type="submit" name="import" value="Import"></input>
    <input type="submit" name="delete" value="Delete"></input>
  </form>
<?php endif;?>
</body>
</html>


<?php
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');
if (isset($csv)){
    $file = $csv;
    echo("<br/>");
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
                echo("<br/> Url Imported");
                $success++;
            } catch (\Magento\Framework\Exception\AlreadyExistsException $e) {
                echo("<br/> Url Already Exist");
                $alreadyExist++;
            } catch (\Exception $e) {
                echo $e;
            }         
        }
        fclose($handle);
        echo("<br/>");
        echo "<br/> Total Already Exist: ".$alreadyExist;
        echo "<br/> Total Imported: ".$success;
        echo("<br/>");
        echo "<br/> Total Rows: ".$row;
        echo("<br/>");
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