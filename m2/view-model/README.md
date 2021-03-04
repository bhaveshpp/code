Use viewModel

```
<referenceContainer name="product.info.extrahint">
    <block class="Magento\Catalog\Block\Product\View\Attributes" name="expected.delivery.date" template="Magento_Catalog::product/view/expectedDate.phtml" before="-">
        <arguments>
            <argument name="date_view_model" xsi:type="object">Bhaveshpp\Design\ViewModel\DateViewModel</argument>
        </arguments>
    </block>
</referenceContainer>

<referenceBlock name="product.attributes">
    <arguments>
        <argument name="url_view_model" xsi:type="object">Bhaveshpp\Design\ViewModel\UrlViewModel</argument>
    </arguments>
</referenceBlock>

<referenceContainer name="product.info.price">
    <block name="carat.price" class="Magento\Catalog\Block\Product\View\Attributes" template="Magento_Catalog::product/price/caratPrice.phtml" after="-" >
        <arguments>
            <argument name="price_view_model" xsi:type="object">Bhaveshpp\Design\ViewModel\PriceViewModel</argument>
        </arguments>
    </block>
</referenceContainer>
```

```
namespace Bhaveshpp\Design\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class AuthorizationViewModel implements ArgumentInterface
{

    protected $_customerSession;

    public function __construct(
        \Magento\Customer\Model\SessionFactory $customerSession
    )
    {
        $this->_customerSession = $customerSession;
    }

    public function getAccountLabel()
    {
        $customerSession = $this->_customerSession->create();

        if ($customerSession->isLoggedIn()) {
            $customerSession->getCustomerId();  // get Customer Id
            $customerSession->getCustomerGroupId();
            $customerSession->getCustomer();
            $customerSession->getCustomerData();

            return $customerSession->getCustomer()->getFirstname();  // get  Full Name
        }
        return __("My Account");
        
    }

    public function getAccountUrl()
    {
        return "customer/account";
    }
}
```

```
class DateViewModel implements ArgumentInterface
{
    protected $_dateTimeFactory;

    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateTimeFactory
    )
    {
        $this->_dateTimeFactory = $dateTimeFactory;
    }

    public function getDateWithFormat($format = null,$date = null)
    {
        $dateModel = $this->_dateTimeFactory->create();
        return $dateModel->gmtDate($format,$date); // formate date using magento
    }

    public function getExpectedDispatchDate($afterDay = 0)
    {
        $time = time() + ($afterDay * 24 * 60 * 60); // Count date
        return $this->getDateWithFormat("l, F j", $time);//return formated date
    }
}
```

```
class PriceViewModel implements ArgumentInterface
{
    protected $_priceCurrency;

    public function __construct(
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
    )
    {
        $this->_priceCurrency = $priceCurrency;
    }

    public function getCurrencyWithFormat($price)
    {
        return $this->_priceCurrency->format($price,true,2);
    }
}
```

```
class UrlViewModel implements ArgumentInterface
{
    protected $_storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_storeManager = $storeManager;
    }

    public function getMediaUrl($path)
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $path;
    }

    public function getProductMediaUrl($path)
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) .'catalog/product'. $path;
    }
}

```

```
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ConfigViewModel implements ArgumentInterface
{
    /**
     * @var ScopeInterface
     */
    private $scope;

    public function __construct(
        ScopeConfigInterface $scope
    )
    {
        $this->scope = $scope;
    }

    public function getStoreContactNumber()
    {
        return $this->scope->getValue('general/store_information/phone',ScopeInterface::SCOPE_STORES);
    }
    
    public function getStoreContactEmail()
    {
        return $this->scope->getValue('trans_email/ident_general/email');
    }
}
```