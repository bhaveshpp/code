
## Add mass action on product grid

/app/code/Bhaveshpp/MassActions/view/adminhtml/ui_component/product_listing.xml

```
<?xml version="1.0" encoding="UTF-8"?>
<listing xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Ui:etc/ui_configuration.xsd">
    <listingToolbar name="listing_top">
        <massaction name="listing_massaction">
            <action name="export_hs_code">
                <settings>
                    <type>enabled</type>
                    <label translate="true">Export HS Code</label>
                    <url path="bcpackage_preparation/product/massExportHsCode"/>
                </settings>
            </action>
        </massaction>
    </listingToolbar>
</listing>
```

/app/code/Bhaveshpp/MassActions/Controller/Adminhtml/Product/MassExportHsCode.php

```
<?php

namespace Bhaveshpp\MassActions\Controller\Adminhtml\Product;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Filesystem\DirectoryList;

class MassExportHsCode extends Action
{

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $prodCollFactory;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory ;

    /**
     * @param Context                                         $context
     * @param Filter                                          $filter
     * @param CollectionFactory                               $prodCollFactory
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $prodCollFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory
    )
    {
        $this->filter = $filter;
        $this->prodCollFactory = $prodCollFactory;
        $this->productRepository = $productRepository;
        $this->_fileFactory = $fileFactory;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException | \Exception
     */
    public function execute()
    {
        $postValue = $this->getRequest()->getParams();
        $collection = $this->filter->getCollection($this->prodCollFactory->create());

        $content = "Sku,Taric\n";
        $content = str_replace(',', ';', $content);
        try {
            foreach ($collection->getAllIds() as $productId)
            {
                $productDataObject = $this->productRepository->getById($productId);
                $content .= "\"{$productDataObject->getSku()}\",\"{$productDataObject->getTaric()}\"\n";
                $content = str_replace(',', ';', $content);
            }
            $this->_prepareDownloadResponse('export.csv', $content, 'text/csv');
        } catch (Exception $e) {
            $this->messageManager->addError($e->getMessage());
            $this->_redirect('*/*/index');
        }
    }

    public function _prepareDownloadResponse($filename, $content, $type)
    {
        return $this->_fileFactory->create($filename, $content, DirectoryList::VAR_DIR);
    }

   
}
```