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