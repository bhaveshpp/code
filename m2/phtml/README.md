

Call Static block in phtml file

```
<?php
echo $this->getLayout()
    ->createBlock('Magento\Cms\Block\Block')
    ->setBlockId('your_block_identifier')
    ->toHtml();
```