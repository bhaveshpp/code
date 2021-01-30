# Add Magento Recapcha on custom form

### Add Form Id in etc/config.xml

```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Store:etc/config.xsd">
   <default>
       <captcha translate="label">
            <frontend>
                <areas>
                    <unsubscribe_form> <!-- Change form Id here -->
                        <label>Unsubscribe form</label>
                    </unsubscribe_form>
                </areas>
            </frontend>
        </captcha>
        <customer>
            <captcha>
                <shown_to_logged_in_user>
                    <unsubscribe_form>1</unsubscribe_form> <!-- Change form Id here -->
                </shown_to_logged_in_user>
                <always_for>
                    <unsubscribe_form>1</unsubscribe_form> <!-- Change form Id here -->
                </always_for>
            </captcha>
        </customer>
   </default>
</config>
```

### Add Routes \Unsubscribe\etc\frontend\routes.xml

```
<?xml version="1.0" ?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:App/etc/routes.xsd">
    <router id="standard">
        <route frontName="unsubscribe" id="unsubscribe">
            <module name="Bhaveshpp_Unsubscribe"/>
        </route>
    </router>
</config>
```

### Add capcha field in form layout xml

```
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" layout="1column" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <referenceContainer name="content">
        <block class="Bhaveshpp\Unsubscribe\Block\Unsubscribe" name="unsubscribe-form" template="Bhaveshpp_Unsubscribe::unsubscribe-form.phtml" >
        	<container name="form.additional.info.unsubcribe" label="Form Additional Info">
        		<block class="Magento\Captcha\Block\Captcha" name="captcha.unsubcribe" after="-" cacheable="false">
	                <action method="setFormId">
	                    <argument name="formId" xsi:type="string">unsubscribe_form</argument>
	                </action>
	                <action method="setImgWidth">
	                    <argument name="width" xsi:type="string">230</argument>
	                </action>
	                <action method="setImgHeight">
	                    <argument name="width" xsi:type="string">50</argument>
	                </action>
	            </block>
        	</container>
        </block>
    </referenceContainer>
    <referenceBlock name="head.components">
        <block class="Magento\Framework\View\Element\Js\Components" name="captcha_page_head_components" template="Magento_Captcha::js/components.phtml"/>
    </referenceBlock>
</page>
```

### Create Block

```
<?php

namespace Bhaveshpp\Unsubscribe\Block;

class Unsubscribe extends \Magento\Framework\View\Element\Template
{
	public function getFormActionUrl()
    {
        return $this->getUrl('unsubscribe/index/index', ['_secure' => true]);
    }

    public function getHomeUrl()
    {
        return $this->getUrl('/');
    }

    public function getSedImageUrl()
    {
        return $this->getUrl('pub/media/interface/')."sad.jpg";
    }
}
```

### Create template

```
<div class="block newsletter-unsubcribe">
    <form id="form-newsletter-unsubcribe" data-hasrequired="* Required Fields" method="post" action="<?= $block->escapeUrl($block->getFormActionUrl()) ?>" class="form" data-mage-init='{"validation": {}}' >
        <fieldset class="fieldset info">
            <legend class="legend"><span> <?php echo __("Unsubscribe Form"); ?></span></legend><br>
            <div class="field required">
                <label for="message" class="label"><span><?php echo __("Your email:"); ?></span></label>
                <div class="control">
                    <input type="text" data-validate="{required:true, 'validate-email':true}" class="input-text" title="Message" value="" id="email" name="email">
                </div>
            </div>
            <!-- Captcha -->
            <?php echo $block->getChildHtml('form.additional.info.unsubcribe'); ?>
        </fieldset>
        <div class="actions-toolbar">
            <div class="primary">
                <button title="Submit" class="action save primary" type="submit"><span><?php echo __("Unsubscribe"); ?></span></button>
            </div>
        </div>
    </form>
</div>
```

### Create Controller

```
<?php

namespace Bhaveshpp\Unsubscribe\Controller\Index;

use Magento\Framework\App\ObjectManager;

/**
 * Controller to excute unsubcription request
 */
class Index extends \Magento\Newsletter\Controller\Subscriber
{

    protected $_pageFactory;
    protected $_scopeConfig;
    protected $inlineTranslation;
    protected $_transportBuilder;
    protected $_resultJson;
    protected $_captchaStringResolver;
    protected $_captchaHelper;
    protected $dataPersistor;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory, 
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Url $customerUrl,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Captcha\Helper\Data $captchaHelper,
        \Magento\Captcha\Observer\CaptchaStringResolver $captchaStringResolver
    )
    {
        $this->_captchaHelper = $captchaHelper;
        $this->_captchaStringResolver = $captchaStringResolver;
        $this->_scopeConfig = $scopeConfig;
        $this->_pageFactory = $pageFactory;
        $this->inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        parent::__construct($context,$subscriberFactory,$customerSession,$storeManager,$customerUrl);
    }

    public function execute()
    {
        
        $result = __('You unsubscribed.');

        if ($this->getRequest()->isPost() && $this->getRequest()->getPost('email')) {
            $formId = 'unsubscribe_form';
            $captcha = $this->_captchaHelper->getCaptcha($formId);
            if ($captcha->isRequired()) {
                if (!$captcha->isCorrect($this->_captchaStringResolver->resolve($this->getRequest(), $formId))) {        
                    $this->messageManager->addError(__('Incorrect CAPTCHA.'));
                    $this->getDataPersistor()->set($formId, $this->getRequest()->getPostValue());
                    $this->_actionFlag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
                    $this->getResponse()->setRedirect($this->_redirect->getRedirectUrl());
                }
            }
            
            $email = (string)$this->getRequest()->getPost('email');

            try {
                
                $this->validateEmailFormat($email);
                $this->validateEmailAvailable($email);

                $subcriber = $this->_subscriberFactory->create()->loadByEmail($email);
                $subcriber->unsubscribe();
                $this->messageManager->addSuccess($result);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addException($e, __('There was a problem with the unsubscription. %1',$e->getMessage()));
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong with the unsubscription. %1',$e->getMessage()));
            }
            $this->getResponse()->setRedirect($this->_redirect->getRedirectUrl());

        } else {
            return $this->_pageFactory->create();
        } 
    }

    public function validateEmailFormat($email)
    {
        if (!\Zend_Validate::is($email, \Magento\Framework\Validator\EmailAddress::class)) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Please enter a valid email address.'));
        }
    }

    public function validateEmailAvailable($email)
    {
        $subcriber = $this->_subscriberFactory->create()->loadByEmail($email);
        
        if ( !$subcriber->getId() ) {
            throw new \Magento\Framework\Exception\LocalizedException( __('Subcriber not found.')
            );
        } elseif (!$subcriber->isSubscribed()) {
            throw new \Magento\Framework\Exception\LocalizedException( __('Subcriber is not active.')
            );
        }
    }

    private function getDataPersistor()
    {
        if ($this->dataPersistor === null) {
            $this->dataPersistor = ObjectManager::getInstance()
                ->get(\Magento\Framework\App\Request\DataPersistor::class);
        }

        return $this->dataPersistor;
    }
}

```