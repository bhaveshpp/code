

## Save Custom customer attribute

```

use Magento\Customer\Api\CustomerRepositoryInterface;

class CustomerRegisterSuccess implements ObserverInterface
{
    /** 
     * @var CustomerRepositoryInterface 
     */
    protected $customerRepository;


    /**
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    public function saveCustomAttribute()
    {

        $customer = $this->customerRepository->getById($customer->getId());

        $customer->setCustomAttribute('raison_sociale', $raison_sociale);
        $customer->setCustomAttribute('specialite', $specialite);
        $customer->setCustomAttribute('fonction', $fonction);

        $this->customerRepository->save($customer);
    }
}

```