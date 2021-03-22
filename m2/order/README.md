Load order by incremnt id

```
namespace Bhaveshpp\Custom\ViewModel;

use Magento\Sales\Api\Data\OrderInterfaceFactory;

class OrderPendingMessage implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    protected $orderFactory;

    public function __construct(
        OrderInterfaceFactory $orderFactory
    ) {
        $this->orderFactory = $orderFactory;
    }

    public function hasPendingStatus($orderId)
    {
        $order = $this->getOrder($orderId);
        $status =  $order->getStatus();
        $payment = $order->getPayment();
        $method = $payment->getMethodInstance();
        $methodCode = $method->getCode();
        if (($status == "pending")&&(strpos($methodCode,"monetico"))) {
            return true;   
        }
        return false;   
    }

    public function getOrder($id)
    {
        return $this->orderFactory->Create()->loadByIncrementId($id);
    }
}

```

Update order state and status programetically

```
use Magento\Sales\Model\Order;

$orderId = 1;
$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$order = $objectManager->create('\Magento\Sales\Model\Order') ->load($orderId);
$orderState = Order::STATE_PROCESSING;
$order->setState($orderState)->setStatus(Order::STATE_PROCESSING);
$order->save();

```

## Add new column in salse order grid

`Bhaveshpp/Custom/view/adminhtml/ui_component/sales_order_grid.xml`

add file


```
<?xml version="1.0" encoding="UTF-8"?>
<listing xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Ui:etc/ui_configuration.xsd">
    <columns name="sales_order_columns">
        <column name="transaction" class="Bhaveshpp\Custom\UiComponent\Sales\Order\Listing\Column\Transaction">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="visible" xsi:type="boolean">true</item>
                    <item name="label" xsi:type="string" translate="true">Transaction</item>
                </item>
            </argument>
        </column>
    </columns>
</listing>

```
Add ui component

```
<?php

namespace Bhaveshpp\Custom\UiComponent\Sales\Order\Listing\Column;

use \Magento\Sales\Api\OrderRepositoryInterface;
use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Framework\Api\SearchCriteriaBuilder;

class Transaction extends Column
{
    protected $_orderRepository;
    protected $_searchCriteria;

    public function __construct(
        ContextInterface $context, 
        UiComponentFactory $uiComponentFactory, 
        OrderRepositoryInterface $orderRepository, 
        SearchCriteriaBuilder $criteria, 
        array $components = [], 
        array $data = []
    )
    {
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria  = $criteria;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $order  = $this->_orderRepository->get($item["entity_id"]);
                $total = $order->getGrandTotal();
                $item['transaction'] = $total;
            }
        }
        return $dataSource;
    }

}
```
