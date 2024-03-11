## Useful file.

```
vendor/magento/framework/Data/Collection.php
vendor/magento/framework/App/FrontController.php
vendor/magento/framework/App/Router/ActionList.php
vendor/magento/framework/View/Layout/Builder.php

# Admin login issue
vendor/magento/module-backend/Model/Auth.php
```


## Query builder.

```
$connection = $this->resource->getConnection();
            $catalogProductEntityTable = $this->resource->getTableName('catalog_product_entity');
            $catalogProductEntityIntTable = $this->resource->getTableName('catalog_product_entity_int');
            $select = $connection->select()->from(
                $catalogProductEntityTable,
                ['entity_id']
            )->join(
                $catalogProductEntityIntTable,
                $catalogProductEntityTable . '.entity_id = ' . $catalogProductEntityIntTable . '.entity_id',
                ['value', 'attribute_id']
            )->where($catalogProductEntityTable . '.entity_id IN (?)', $childrenIds[0]
            )->where($catalogProductEntityIntTable . '.attribute_id=' . $this->getAttributeId()
            )->where($catalogProductEntityIntTable . '.value=' . Status::STATUS_ENABLED)->distinct(true);
            return array_column($connection->fetchAll($select), 'entity_id');
```


# CMS BLOCK AND PAGE

Translate inline

{% raw %}
```
<h1 class="hero-h1">{{trans "Welcome to this website" }}</h1>

Call Template in cms block

{{block class="Magento\Framework\View\Element\Template" template="Altravista_Carousel::product/carousel.phtml" cat="3"}}

Get Store Url

{{store url=""}}

{{store url="category-url"}}

Call CMS Block inside another CMS Block

{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="1"}}

{{block type="cms/block" block_id="your_block_id"}}

```
{% endraw %}
