## CMS BLOCK AND PAGE

Translate inline

```
<h1 class="hero-h1">{{trans "Welcome to this website" }}</h1>
```

Call Template in cms block

```
{{block class="Magento\Framework\View\Element\Template" template="Altravista_Carousel::product/carousel.phtml" cat="3"}}
```

Get Store Url

```
{{store url=""}}

{{store url="category-url"}}
```

Call CMS Block inside another CMS Block

```
{{widget type="cms/widget_block" template="cms/widget/static_block/default.phtml" block_id="1"}}

\{\{block type="cms/block" block_id="your_block_id"\}\}

```