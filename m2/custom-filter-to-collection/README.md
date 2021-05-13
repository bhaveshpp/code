## Add Custom filter on Customer, Order, Shipment, Invoice, Creditmemo and transaction

add line in di.xml

```
	<!-- Filter Collection by zip code or country -->
	<type name="Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory">
        <plugin 
		name="AddfilterafterCollection" 
		type="Bhaveshpp\AdminZone\Plugin\Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory" 
		sortOrder="1" 
		disabled="false"/>
    </type>

	<!-- Filter Collection by zip code or country for transaction -->
	<preference for="Magento\Sales\Model\ResourceModel\Transaction\Grid\Collection" type="Bhaveshpp\AdminZone\Preference\Magento\Sales\Model\ResourceModel\Transaction\Grid\Collection" />
```

```
namespace Bhaveshpp\AdminZone\Plugin\Magento\Framework\View\Element\UiComponent\DataProvider;
use Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory as Subject;
use Bhaveshpp\AdminZone\Helper\Data;

/**
 * Class AddDataToOrdersGrid
 */
class CollectionFactory
{
    
    /**
     * AdminZoneHelper
     *
     * @var \Bhaveshpp\AdminZone\Helper\Data
     */
    public $adminZoneHelper;

    /**
     * AddDataToOrdersGrid constructor.
     *
     * @param Data
     * @param array $data
     */
    public function __construct(
        Data $adminZoneHelper,
        array $data = []
    ) {
        $this->adminZoneHelper = $adminZoneHelper;
    }

    /**
     * @param \Magento\Framework\View\Element\UiComponent\DataProvider\CollectionFactory $subject
     * @param \Magento\Sales\Model\ResourceModel\Order\Grid\Collection $collection
     * @param $requestName
     * @return mixed
     */
    public function afterGetReport(Subject $subject, $collection, $requestName)
    {
        if ($this->adminZoneHelper->isZonesHasAdmin()) {
            if ($requestName == 'customer_listing_data_source') { 
                $condition = $this->adminZoneHelper->getCondition('billing_postcode','billing_country_id');
                $collection->addFieldToFilter($condition['cols'],$condition['vals']);
                return $collection;
            }
            if ($requestName == 'sales_order_grid_data_source') { 
                $collection->join(['order_address' => 'mgsi_sales_order_address'],
                'main_table.entity_id = order_address.parent_id and order_address.address_type = "billing"',['postcode','country_id']);
                
                $condition = $this->adminZoneHelper->getCondition('postcode','country_id');
                if ($condition) {
                    $collection->addFieldToFilter($condition['cols'],$condition['vals']);
                    return $collection;
                }
            }
            
            $salesReqArray = [
                'sales_order_invoice_grid_data_source',
                'sales_order_shipment_grid_data_source',
                'sales_order_creditmemo_grid_data_source'
            ];
            
            if (in_array($requestName, $salesReqArray)) { 
                $collection->join(['order_address' => 'mgsi_sales_order_address'],
                'main_table.order_id = order_address.parent_id and order_address.address_type = "billing"',['postcode','country_id']);
                
                $condition = $this->adminZoneHelper->getCondition('postcode','country_id');
                $collection->addFieldToFilter($condition['cols'],$condition['vals']);
                return $collection;
            }
        }
        return $collection;
    }
    
}
```


```
namespace Bhaveshpp\AdminZone\Preference\Magento\Sales\Model\ResourceModel\Transaction\Grid;

/**
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 */
class Collection extends \Magento\Sales\Model\ResourceModel\Transaction\Grid\Collection
{
    
    /**
     * adminZoneHelper
     *
     * @var Data
     */
    public $adminZoneHelper;

    /**
     * @param \Magento\Framework\Data\Collection\EntityFactory $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Framework\Model\ResourceModel\Db\VersionControl\Snapshot $entitySnapshot
     * @param \Magento\Framework\Registry $registryManager
     * @param \Bhaveshpp\AdminZone\Helper\Data $adminZoneHelper
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\Model\ResourceModel\Db\VersionControl\Snapshot $entitySnapshot,
        \Magento\Framework\Registry $registryManager,
        \Bhaveshpp\AdminZone\Helper\Data $adminZoneHelper
    ) {
        $this->adminZoneHelper = $adminZoneHelper;
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $entitySnapshot,
            $registryManager
        );
    }

    /**
     * Resource initialization
     *
     * @return $this
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        
        if ($this->adminZoneHelper->isZonesHasAdmin()) 
        {
            $this->join(['order_address' => 'mgsi_sales_order_address'],
            'main_table.order_id = order_address.parent_id and order_address.address_type = "billing"',['postcode','country_id']);
            
            $condition = $this->adminZoneHelper->getCondition('postcode','country_id');
            $this->addFieldToFilter($condition['cols'],$condition['vals']);
        }    

        return $this;
    }
}
```
