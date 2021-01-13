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
