## Root form

```
<?php 
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

/**
* @var \Magento\Framework\Data\Form\FormKey $this->_storeManager
*/
$formKey = $objectManager->get('Magento\Framework\Data\Form\FormKey');

/**
* @var \Magento\Store\Model\StoreManagerInterface $this->_storeManager
*/
$storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');

?>
<!DOCTYPE html>
<html>
<body>
<form action="<?= $storeManager->getStore()->getBaseUrl() . "newsletter/subscriber/new";?>">
  <label for="formkey">form key:</label><br>
  <input type="text" id="formkey" name="form_key" value="<?= $formKey->getFormKey()?>"><br><br>
  <label for="email">email:</label><br>
  <input type="text" id="email" name="email" value="admin@gmail.com"><br><br>
  <input type="submit" value="Submit">
</form>
</body>
</html>

```