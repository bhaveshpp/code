## Move attribute field under advance price section

`/app/code/Bhaveshpp/Custom/etc/adminhtml/di.xml`

```
<!-- Move Deposit price fields under advance price section -->
    <type name="Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AdvancedPricing">
        <plugin name="MoveFieldToAdvancePrice" type="Bhaveshpp\Custom\Plugin\Catalog\Ui\DataProvider\Product\Form\Modifier\AdvancedPricing" sortOrder="1" />
    </type>
```
`/app/code/Bhaveshpp/Custom/Plugin/Catalog/Ui/DataProvider/Product/Form/Modifier/AdvancedPricing.php`

```
namespace Bhaveshpp\Custom\Plugin\Catalog\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AdvancedPricing as Subject;

class AdvancedPricing 
{

    public function afterModifyMeta(Subject $subject, $result)
    {
        //set under advance price
        $result['advanced_pricing_modal']['children']['advanced-pricing']['children']['custom_attribut_code-1'] = $result['product-details']['children']['custom_attribut_code-1'];
        $result['advanced_pricing_modal']['children']['advanced-pricing']['children']['custom_attribut_code-2'] = $result['product-details']['children']['custom_attribut_code-2'];

        // unset default
        unset($result['product-details']['children']['custom_attribut_code-1']);
        unset($result['product-details']['children']['custom_attribut_code-2']);
        return $result;
    }
}

```