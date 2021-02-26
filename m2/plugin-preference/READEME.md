## XML Defination

```
    <!-- Plugin for crontab issue  -->
    <type name="Magento\Cron\Model\Config\Converter\Db">
        <plugin name="AddAdminNameToComment" type="Bhaveshpp\Custom\Plugin\Cron\Model\Config\Converter\Db" sortOrder="1" />
    </type>

    <!-- Plugin for crontab issue  -->
    <preference for="Magento\Sales\Block\Adminhtml\Order\View" 
    type="Bhaveshpp\Custom\Block\Catalog\Product\View" />


```

## After Plugin 

### Change output of function 

```
<?php
namespace Bhaveshpp\Custom\Plugin;
class SearchData {
    public function afterGetLink(\Magento\AdvancedSearch\Block\SearchData $subject, $result)
    {
        return substr_replace($result,"search",22,13);
    }
}
```

