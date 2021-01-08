## Comman used code

Define `module.xml`

```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
    <module name="Bhaveshpp_Custom" setup_version="1.0.0">
        <sequence>
            <module name="Magento_Sales"/>
            <module name="Magento_Catalog"/>
            <module name="Magento_Checkout"/>
        </sequence>
    </module>
</config>
```

Define Plugin and preference in `di.xml`

```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    
	<!-- Plugin of save product controller -->
    <type name="Magento\Catalog\Controller\Adminhtml\Product\Save">
        <plugin name="AddAdminNameToComment" type="Bhaveshpp\Custom\Plugin\Catalog\Controller\Adminhtml\Product\Save" sortOrder="1" />
    </type>
	
	<!-- Flags are not apply to all tnt shippig  -->
    <preference for="Amasty\Flags\Block\Adminhtml\Flag\Edit\Tab\Apply" type="Bhaveshpp\Custom\Block\Adminhtml\Flag\Edit\Tab\Apply"/>

</config>
```

Define Event Observer in `events.xml`

```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Event/etc/events.xsd">
	<!-- Run after product add to cart -->
    <event name="checkout_cart_product_add_after">
		<observer name="add_custom_product" instance="Bhaveshpp\Custom\Observer\AddCustomProduct" />
	</event> 
</config>
```
