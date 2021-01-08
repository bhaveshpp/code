286 results - 171 files

`vendor\magento\framework\App\Http.php:`
```
  130          $eventParams = ['request' => $this->_request, 'response' => $this->_response];
  131:         $this->_eventManager->dispatch('controller_front_send_response_before', $eventParams);
  132          return $this->_response;
```
`vendor\magento\framework\App\View.php:`
```
  215  
  216:         $this->_eventManager->dispatch('controller_action_layout_render_before');
  217:         $this->_eventManager->dispatch(
  218              'controller_action_layout_render_before_' . $this->_request->getFullActionName()
```
`vendor\magento\framework\Controller\Noroute\Index.php:`
```
  22  
  23:         $this->_eventManager->dispatch('controller_action_noroute', ['action' => $this, 'status' => $status]);
  24  
```
`vendor\magento\framework\Locale\Currency.php:`
```
  92              $options = new \Magento\Framework\DataObject($options);
  93:             $this->_eventManager->dispatch(
  94                  'currency_display_options_forming',
```
`vendor\magento\framework\Model\AbstractModel.php:`
```
  566          $params = ['object' => $this, 'field' => $field, 'value' => $modelId];
  567:         $this->_eventManager->dispatch('model_load_before', $params);
  568          $params = array_merge($params, $this->_getEventData());
  569:         $this->_eventManager->dispatch($this->_eventPrefix . '_load_before', $params);
  570          return $this;

  579      {
  580:         $this->_eventManager->dispatch('model_load_after', ['object' => $this]);
  581:         $this->_eventManager->dispatch($this->_eventPrefix . '_load_after', $this->_getEventData());
  582          return $this;

  665      {
  666:         $this->_eventManager->dispatch('model_save_commit_after', ['object' => $this]);
  667:         $this->_eventManager->dispatch($this->_eventPrefix . '_save_commit_after', $this->_getEventData());
  668          return $this;

  700          }
  701:         $this->_eventManager->dispatch('model_save_before', ['object' => $this]);
  702:         $this->_eventManager->dispatch($this->_eventPrefix . '_save_before', $this->_getEventData());
  703          return $this;

  826          $this->cleanModelCache();
  827:         $this->_eventManager->dispatch('model_save_after', ['object' => $this]);
  828:         $this->_eventManager->dispatch('clean_cache_by_tags', ['object' => $this]);
  829:         $this->_eventManager->dispatch($this->_eventPrefix . '_save_after', $this->_getEventData());
  830          $this->updateStoredData();

  862  
  863:         $this->_eventManager->dispatch('model_delete_before', ['object' => $this]);
  864:         $this->_eventManager->dispatch($this->_eventPrefix . '_delete_before', $this->_getEventData());
  865          $this->cleanModelCache();

  875      {
  876:         $this->_eventManager->dispatch('model_delete_after', ['object' => $this]);
  877:         $this->_eventManager->dispatch('clean_cache_by_tags', ['object' => $this]);
  878:         $this->_eventManager->dispatch($this->_eventPrefix . '_delete_after', $this->_getEventData());
  879          $this->storedData = [];

  889      {
  890:         $this->_eventManager->dispatch('model_delete_commit_after', ['object' => $this]);
  891:         $this->_eventManager->dispatch($this->_eventPrefix . '_delete_commit_after', $this->_getEventData());
  892          return $this;

  934          $this->_clearReferences();
  935:         $this->_eventManager->dispatch($this->_eventPrefix . '_clear', $this->_getEventData());
  936          $this->_clearData();
```
`vendor\magento\framework\Model\ResourceModel\Db\Collection\AbstractCollection.php:`
```
  540          parent::_beforeLoad();
  541:         $this->_eventManager->dispatch('core_collection_abstract_load_before', ['collection' => $this]);
  542          if ($this->_eventPrefix && $this->_eventObject) {
  543:             $this->_eventManager->dispatch($this->_eventPrefix . '_load_before', [$this->_eventObject => $this]);
  544          }

  587          }
  588:         $this->_eventManager->dispatch('core_collection_abstract_load_after', ['collection' => $this]);
  589          if ($this->_eventPrefix && $this->_eventObject) {
  590:             $this->_eventManager->dispatch($this->_eventPrefix . '_load_after', [$this->_eventObject => $this]);
  591          }
```
`vendor\magento\framework\View\Layout.php:`
```
  502          $this->_renderingOutput->setData('output', $this->_renderElementCache[$name]);
  503:         $this->_eventManager->dispatch(
  504              'core_layout_render_element',
```
`vendor\magento\framework\View\Element\AbstractBlock.php:`
```
  666      {
  667:         $this->_eventManager->dispatch('view_block_abstract_to_html_before', ['block' => $this]);
  668          if ($this->_scopeConfig->getValue(

  683          );
  684:         $this->_eventManager->dispatch(
  685              'view_block_abstract_to_html_after',
```
`vendor\magento\framework\View\Element\Messages.php:`
```
  261          ];
  262:         $this->_eventManager->dispatch('view_message_block_render_grouped_html_after', $params);
  263          $html = $transport->getData('output');
```
`vendor\magento\module-backend\Block\Template.php:`
```
  139      {
  140:         $this->_eventManager->dispatch('adminhtml_block_html_before', ['block' => $this]);
  141          return parent::_toHtml();
```
`vendor\magento\module-backend\Block\System\Store\Edit\AbstractForm.php:`
```
  61  
  62:         $this->_eventManager->dispatch('adminhtml_store_edit_form_prepare_form', ['block' => $this]);
  63  
```
`vendor\magento\module-backend\Block\Widget\Grid.php:`
```
  400      {
  401:         $this->_eventManager->dispatch(
  402              'backend_block_widget_grid_prepare_grid_before',
```
`vendor\magento\module-backend\Controller\Adminhtml\Cache\CleanImages.php:`
```
  30              $this->_objectManager->create(\Magento\Catalog\Model\Product\Image::class)->clearCache();
  31:             $this->_eventManager->dispatch('clean_catalog_images_cache_after');
  32              $this->messageManager->addSuccessMessage(__('The image cache was cleaned.'));
```
`vendor\magento\module-backend\Controller\Adminhtml\Cache\CleanMedia.php:`
```
  30              $this->_objectManager->get(\Magento\Framework\View\Asset\MergeService::class)->cleanMergedJsCss();
  31:             $this->_eventManager->dispatch('clean_media_cache_after');
  32              $this->messageManager->addSuccessMessage(__('The JavaScript/CSS cache has been cleaned.'));
```
`vendor\magento\module-backend\Controller\Adminhtml\Cache\CleanStaticFiles.php:`
```
  28          $this->_objectManager->get(\Magento\Framework\App\State\CleanupFiles::class)->clearMaterializedViewFiles();
  29:         $this->_eventManager->dispatch('clean_static_files_cache_after');
  30          $this->messageManager->addSuccessMessage(__('The static files cache has been cleaned.'));
```
`vendor\magento\module-backend\Controller\Adminhtml\Cache\FlushAll.php:`
```
  26      {
  27:         $this->_eventManager->dispatch('adminhtml_cache_flush_all');
  28          /** @var $cacheFrontend \Magento\Framework\Cache\FrontendInterface */
```
`vendor\magento\module-backend\Controller\Adminhtml\Cache\FlushSystem.php:`
```
  30          }
  31:         $this->_eventManager->dispatch('adminhtml_cache_flush_system');
  32          $this->messageManager->addSuccessMessage(__("The Magento cache storage has been flushed."));
```
`vendor\magento\module-backend\Controller\Adminhtml\System\Design\Save.php:`
```
  58                  $design->save();
  59:                 $this->_eventManager->dispatch('theme_save_after');
  60                  $this->messageManager->addSuccessMessage(__('You saved the design change.'));
```
`vendor\magento\module-backend\Model\Auth.php:`
```
  166  
  167:                 $this->_eventManager->dispatch(
  168                      'backend_auth_user_login_success',

  181          } catch (PluginAuthenticationException $e) {
  182:             $this->_eventManager->dispatch(
  183                  'backend_auth_user_login_failed',

  187          } catch (\Magento\Framework\Exception\LocalizedException $e) {
  188:             $this->_eventManager->dispatch(
  189                  'backend_auth_user_login_failed',
```
`vendor\magento\module-bundle\Block\Catalog\Product\View\Type\Bundle.php:`
```
  204          //pass the return array encapsulated in an object for the other modules to be able to alter it eg: weee
  205:         $this->_eventManager->dispatch('catalog_product_option_price_configuration_after', ['configObj' => $configObj]);
  206          $config=$configObj->getConfig();
```
`vendor\magento\module-bundle\Model\Product\Price.php:`
```
  142                  $selections->addTierPriceData();
  143:                 $this->_eventManager->dispatch(
  144                      'prepare_catalog_product_collection_prices',

  197          $product->setFinalPrice($finalPrice);
  198:         $this->_eventManager->dispatch('catalog_product_get_final_price', ['product' => $product, 'qty' => $qty]);
  199          $finalPrice = $product->getData('final_price');

  471                  $product->setFinalPrice($this->getPrice($product));
  472:                 $this->_eventManager->dispatch(
  473                      'catalog_product_get_final_price',
```
`vendor\magento\module-catalog\Block\ShortcutButtons.php:`
```
  77      {
  78:         $this->_eventManager->dispatch(
  79              'shortcut_buttons_container',
```
`vendor\magento\module-catalog\Block\Adminhtml\Category\Tree.php:`
```
  438  
  439:         $this->_eventManager->dispatch('adminhtml_catalog_category_tree_is_moveable', ['options' => $options]);
  440  

  479          $options = new \Magento\Framework\DataObject(['is_allow' => true]);
  480:         $this->_eventManager->dispatch(
  481              'adminhtml_catalog_category_tree_can_add_root_category',

  495          $options = new \Magento\Framework\DataObject(['is_allow' => true]);
  496:         $this->_eventManager->dispatch(
  497              'adminhtml_catalog_category_tree_can_add_sub_category',
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Grid.php:`
```
  421  
  422:         $this->_eventManager->dispatch('adminhtml_catalog_product_grid_prepare_massaction', ['block' => $this]);
  423          return $this;
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Attribute\Grid.php:`
```
  106  
  107:         $this->_eventManager->dispatch('product_attribute_grid_build', ['grid' => $this]);
  108  
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Attribute\Edit\Tab\Advanced.php:`
```
  263  
  264:         $this->_eventManager->dispatch('product_attribute_form_build', ['form' => $form]);
  265          if (in_array($attributeObject->getAttributeCode(), $this->disableScopeChangeList)) {
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Attribute\Edit\Tab\Front.php:`
```
  114  
  115:         $this->_eventManager->dispatch('product_attribute_form_build_front_tab', ['form' => $form]);
  116  

  176  
  177:         $this->_eventManager->dispatch(
  178              'adminhtml_catalog_product_attribute_edit_frontend_prepare_form',
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Attribute\Edit\Tab\Main.php:`
```
  37  
  38:         $this->_eventManager->dispatch('product_attribute_form_build_main_tab', ['form' => $this->getForm()]);
  39  

  64          $response->setTypes([]);
  65:         $this->_eventManager->dispatch('adminhtml_product_attribute_types', ['response' => $response]);
  66          $_hiddenFields = [];
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Attribute\NewAttribute\Product\Attributes.php:`
```
  51  
  52:         $this->_eventManager->dispatch('adminhtml_catalog_product_edit_prepare_form', ['form' => $form]);
  53          $form->addValues($values);

  70          $response->setTypes([]);
  71:         $this->_eventManager->dispatch('adminhtml_catalog_product_edit_element_types', ['response' => $response]);
  72  
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Attribute\Set\Main.php:`
```
  374      {
  375:         $this->_eventManager->dispatch(
  376              'adminhtml_catalog_product_attribute_set_main_html_before',
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Attribute\Set\Toolbar\Main.php:`
```
  62      {
  63:         $this->_eventManager->dispatch(
  64              'adminhtml_catalog_product_attribute_set_toolbar_main_html_before',
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Edit\Action\Attribute\Tab\Attributes.php:`
```
  97          $this->setFormExcludedFieldList($this->excludeFields);
  98:         $this->_eventManager->dispatch(
  99              'adminhtml_catalog_product_form_prepare_excluded_field_list',
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Edit\Tab\Attributes.php:`
```
  123  
  124:             $this->_eventManager->dispatch(
  125                  'adminhtml_catalog_product_edit_prepare_form',

  150          $response->setTypes([]);
  151:         $this->_eventManager->dispatch('adminhtml_catalog_product_edit_element_types', ['response' => $response]);
  152  
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Edit\Tab\Attributes\Create.php:`
```
  92          $this->setCanShow(true);
  93:         $this->_eventManager->dispatch(
  94              'adminhtml_catalog_product_edit_tab_attributes_create_html_before',
```
`vendor\magento\module-catalog\Block\Adminhtml\Product\Helper\Form\Gallery\Content.php:`
```
  115  
  116:         $this->_eventManager->dispatch('catalog_product_gallery_prepare_layout', ['block' => $this]);
  117  
```
`vendor\magento\module-catalog\Block\Product\AbstractProduct.php:`
```
  386          $statusInfo = new \Magento\Framework\DataObject(['display_status' => true]);
  387:         $this->_eventManager->dispatch('catalog_block_product_status_display', ['status' => $statusInfo]);
  388          return (bool) $statusInfo->getDisplayStatus();
```
`vendor\magento\module-catalog\Block\Product\ListProduct.php:`
```
  488  
  489:         $this->_eventManager->dispatch(
  490              'catalog_block_product_list_collection',
```
`vendor\magento\module-catalog\Block\Product\View.php:`
```
  216          $responseObject = new \Magento\Framework\DataObject();
  217:         $this->_eventManager->dispatch('catalog_product_view_config', ['response_object' => $responseObject]);
  218          if (is_array($responseObject->getAdditionalOptions())) {
```
`vendor\magento\module-catalog\Block\Product\ProductList\Upsell.php:`
```
  117           */
  118:         $this->_eventManager->dispatch(
  119              'catalog_product_upsell',
```
`vendor\magento\module-catalog\Block\Product\View\Options.php:`
```
  237          //pass the return array encapsulated in an object for the other modules to be able to alter it eg: weee
  238:         $this->_eventManager->dispatch('catalog_product_option_price_configuration_after', ['configObj' => $configObj]);
  239  
```
`vendor\magento\module-catalog\Block\Rss\Category.php:`
```
  131  
  132:             $this->_eventManager->dispatch('rss_catalog_category_xml_callback', ['product' => $product]);
  133  
```
`vendor\magento\module-catalog\Block\Rss\Product\NewProducts.php:`
```
   99  
  100:             $this->_eventManager->dispatch('rss_catalog_new_xml_callback', [
  101                  'row' => $item->getData(),
```
`vendor\magento\module-catalog\Block\Rss\Product\Special.php:`
```
  134  
  135:             $this->_eventManager->dispatch('rss_catalog_special_xml_callback', [
  136                  'row' => $item->getData(),
```
`vendor\magento\module-catalog\Controller\Adminhtml\Category.php:`
```
  185          );
  186:         $this->_eventManager->dispatch(
  187              'category_prepare_ajax_response',
```
`vendor\magento\module-catalog\Controller\Adminhtml\Category\Delete.php:`
```
  45                  $parentId = $category->getParentId();
  46:                 $this->_eventManager->dispatch('catalog_controller_category_delete', ['category' => $category]);
  47                  $this->_auth->getAuthStorage()->setDeletedPath($category->getPath());
```
`vendor\magento\module-catalog\Controller\Adminhtml\Category\Save.php:`
```
  187              try {
  188:                 $this->_eventManager->dispatch(
  189                      'catalog_category_prepare_save',
```
`vendor\magento\module-catalog\Controller\Adminhtml\Product\Edit.php:`
```
  76  
  77:         $this->_eventManager->dispatch('catalog_product_edit_action', ['product' => $product]);
  78  
```
`vendor\magento\module-catalog\Controller\Adminhtml\Product\NewAction.php:`
```
  63          $product = $this->productBuilder->build($this->getRequest());
  64:         $this->_eventManager->dispatch('catalog_product_new_action', ['product' => $product]);
  65  
```
`vendor\magento\module-catalog\Controller\Adminhtml\Product\Save.php:`
```
  164                  }
  165:                 $this->_eventManager->dispatch(
  166                      'controller_action_catalog_product_save_entity_after',
```
`vendor\magento\module-catalog\Controller\Adminhtml\Product\Gallery\Upload.php:`
```
  100  
  101:             $this->_eventManager->dispatch(
  102                  'catalog_product_gallery_upload_image_after',
```
`vendor\magento\module-catalog\Controller\Category\View.php:`
```
  192          try {
  193:             $this->_eventManager->dispatch(
  194                  'catalog_controller_category_init_after',
```
`vendor\magento\module-catalog\Controller\Product\Compare\Add.php:`
```
  109  
  110:                 $this->_eventManager->dispatch('catalog_product_compare_add_product', ['product' => $product]);
  111              }
```
`vendor\magento\module-catalog\Controller\Product\Compare\Remove.php:`
```
  56                      );
  57:                     $this->_eventManager->dispatch(
  58                          'catalog_product_compare_remove_product',
```
`vendor\magento\module-catalog\Helper\Product.php:`
```
  419          // Init and load product
  420:         $this->_eventManager->dispatch(
  421              'catalog_controller_product_init_before',

  469          try {
  470:             $this->_eventManager->dispatch(
  471                  'catalog_controller_product_init_after',
```
`vendor\magento\module-catalog\Helper\Product\View.php:`
```
  290  
  291:         $this->_eventManager->dispatch('catalog_controller_product_view', ['product' => $product]);
  292  
```
`vendor\magento\module-catalog\Model\Category.php:`
```
  428          try {
  429:             $this->_eventManager->dispatch($this->_eventPrefix . '_move_before', $eventParams);
  430              $this->getResource()->changeParent($this, $parent, $afterCategoryId);
  431:             $this->_eventManager->dispatch($this->_eventPrefix . '_move_after', $eventParams);
  432              $this->_getResource()->commit();

  439          }
  440:         $this->_eventManager->dispatch('category_move', $eventParams);
  441          if ($this->flatState->isFlatEnabled()) {

  452          }
  453:         $this->_eventManager->dispatch('clean_cache_by_tags', ['object' => $this]);
  454          $this->_cacheManager->clean([self::CACHE_TAG]);
```
`vendor\magento\module-catalog\Model\Product.php:`
```
   563      {
   564:         $this->_eventManager->dispatch($this->_eventPrefix . '_validate_before', $this->_getEventData());
   565          $result = $this->_getResource()->validate($this);
   566:         $this->_eventManager->dispatch($this->_eventPrefix . '_validate_after', $this->_getEventData());
   567          return $result;

  1703          }
  1704:         $this->_eventManager->dispatch('catalog_product_is_salable_before', ['product' => $this]);
  1705  

  1708          $object = new \Magento\Framework\DataObject(['product' => $this, 'is_salable' => $salable]);
  1709:         $this->_eventManager->dispatch(
  1710              'catalog_product_is_salable_after',
```
`vendor\magento\module-catalog\Model\Product\Action.php:`
```
   89      {
   90:         $this->_eventManager->dispatch(
   91              'catalog_product_attribute_update_before',

  171  
  172:         $this->_eventManager->dispatch('catalog_product_to_website_change', ['products' => $productIds]);
  173      }
```
`vendor\magento\module-catalog\Model\Product\Attribute\Source\Inputtype.php:`
```
  57          $response->setTypes([]);
  58:         $this->_eventManager->dispatch('adminhtml_product_attribute_types', ['response' => $response]);
  59          $_hiddenFields = [];
```
`vendor\magento\module-catalog\Model\Product\Type\AbstractType.php:`
```
  610          $eventName = sprintf('catalog_product_type_prepare_%s_options', $processMode);
  611:         $this->_eventManager->dispatch(
  612              $eventName,
```
`vendor\magento\module-catalog\Model\Product\Type\Price.php:`
```
  179  
  180:         $this->_eventManager->dispatch('catalog_product_get_final_price', ['product' => $product, 'qty' => $qty]);
  181  
```
`vendor\magento\module-catalog\Model\ResourceModel\Category.php:`
```
   471              $productIds = array_unique(array_merge(array_keys($insert), array_keys($delete)));
   472:             $this->_eventManager->dispatch(
   473                  'catalog_category_change_products',

  1104          $this->getEntityManager()->delete($object);
  1105:         $this->_eventManager->dispatch(
  1106              'catalog_category_delete_after_done',
```
`vendor\magento\module-catalog\Model\ResourceModel\Category\Collection.php:`
```
  186      {
  187:         $this->_eventManager->dispatch($this->_eventPrefix . '_load_before', [$this->_eventObject => $this]);
  188          return parent::_beforeLoad();

  197      {
  198:         $this->_eventManager->dispatch($this->_eventPrefix . '_load_after', [$this->_eventObject => $this]);
  199  

  379          $this->addAttributeToFilter('is_active', 1);
  380:         $this->_eventManager->dispatch(
  381              $this->_eventPrefix . '_add_is_active_filter',
```
`vendor\magento\module-catalog\Model\ResourceModel\Category\Flat.php:`
```
  211          $this->_inactiveCategoryIds = [];
  212:         $this->_eventManager->dispatch('catalog_category_tree_init_inactive_category_ids', ['tree' => $this]);
  213          return $this;

  300          // Allow extensions to modify select (e.g. add custom category attributes to select)
  301:         $this->_eventManager->dispatch('catalog_category_flat_loadnodes_before', ['select' => $select]);
  302  
```
`vendor\magento\module-catalog\Model\ResourceModel\Category\Tree.php:`
```
  256          $this->_inactiveCategoryIds = [];
  257:         $this->_eventManager->dispatch('catalog_category_tree_init_inactive_category_ids', ['tree' => $this]);
  258          return $this;
```
`vendor\magento\module-catalog\Model\ResourceModel\Category\Flat\Collection.php:`
```
  144      {
  145:         $this->_eventManager->dispatch($this->_eventPrefix . '_load_before', [$this->_eventObject => $this]);
  146          return parent::_beforeLoad();

  155      {
  156:         $this->_eventManager->dispatch($this->_eventPrefix . '_load_after', [$this->_eventObject => $this]);
  157          return parent::_afterLoad();

  230          $this->addFieldToFilter('is_active', 1);
  231:         $this->_eventManager->dispatch(
  232              $this->_eventPrefix . '_add_is_active_filter',
```
`vendor\magento\module-catalog\Model\ResourceModel\Product\Collection.php:`
```
   456  
   457:         $this->_eventManager->dispatch('catalog_prepare_price_select', $eventArgs);
   458  

   723          if (count($this)) {
   724:             $this->_eventManager->dispatch('catalog_product_collection_load_after', ['collection' => $this]);
   725          }

  1351  
  1352:             $this->_eventManager->dispatch(
  1353                  'catalog_product_collection_before_add_count_to_categories',

  2069          $this->_productLimitationJoinStore();
  2070:         $this->_eventManager->dispatch(
  2071              'catalog_product_collection_apply_limitations_after',
```
`vendor\magento\module-catalog\Model\ResourceModel\Product\Compare\Item\Collection.php:`
```
  399          $this->_catalogProductCompareItem->clearItems($this->getVisitorId(), $this->getCustomerId());
  400:         $this->_eventManager->dispatch('catalog_product_compare_item_collection_clear');
  401  
```
`vendor\magento\module-catalog\Model\ResourceModel\Product\Indexer\Eav\AbstractEav.php:`
```
  207           */
  208:         $this->_eventManager->dispatch(
  209              'prepare_catalog_product_index_select',
```
`vendor\magento\module-catalog\Model\ResourceModel\Product\Indexer\Eav\Decimal.php:`
```
  113           */
  114:         $this->_eventManager->dispatch(
  115              'prepare_catalog_product_index_select',
```
`vendor\magento\module-catalog\Model\ResourceModel\Product\Indexer\Eav\Source.php:`
```
  254           */
  255:         $this->_eventManager->dispatch(
  256              'prepare_catalog_product_index_select',

  350           */
  351:         $this->_eventManager->dispatch(
  352              'prepare_catalog_product_index_select',
```
`vendor\magento\module-catalog\Model\ResourceModel\Product\Indexer\Price\DefaultPrice.php:`
```
  495           */
  496:         $this->_eventManager->dispatch(
  497              'prepare_catalog_product_index_select',
```
`vendor\magento\module-catalog-import-export\Model\Import\Product.php:`
```
  1081                      );
  1082:                     $this->_eventManager->dispatch(
  1083                          'catalog_product_import_bunch_delete_commit_before',

  1094                  }
  1095:                 $this->_eventManager->dispatch(
  1096                      'catalog_product_import_bunch_delete_after',

  1121          }
  1122:         $this->_eventManager->dispatch('catalog_product_import_finish_before', ['adapter' => $this]);
  1123          return true;

  1926  
  1927:             $this->_eventManager->dispatch(
  1928                  'catalog_product_import_bunch_save_after',
```
`vendor\magento\module-catalog-rule\Controller\Adminhtml\Promo\Catalog\Index.php:`
```
  18          $dirtyRules = $this->_objectManager->create(\Magento\CatalogRule\Model\Flag::class)->loadSelf();
  19:         $this->_eventManager->dispatch(
  20              'catalogrule_dirty_notice',
```
`vendor\magento\module-catalog-rule\Controller\Adminhtml\Promo\Catalog\Save.php:`
```
  70              try {
  71:                 $this->_eventManager->dispatch(
  72                      'adminhtml_controller_catalogrule_prepare_save',
```
`vendor\magento\module-catalog-rule\Model\Indexer\AbstractIndexer.php:`
```
  70          $this->indexBuilder->reindexFull();
  71:         $this->_eventManager->dispatch('clean_cache_by_tags', ['object' => $this]);
  72          $this->getCacheManager()->clean($this->getIdentities());
```
`vendor\magento\module-catalog-search\Model\ResourceModel\Fulltext.php:`
```
  71          $connection->update($this->getTable('search_query'), ['is_processed' => 0], ['is_processed != 0']);
  72:         $this->_eventManager->dispatch('catalogsearch_reset_search_result');
  73          return $this;

  91          );
  92:         $this->_eventManager->dispatch('catalogsearch_reset_search_result', ['store_id' => $storeId]);
  93          return $this;
```
`vendor\magento\module-checkout\Block\QuoteShortcutButtons.php:`
```
  44      {
  45:         $this->_eventManager->dispatch(
  46              'shortcut_buttons_container',
```
`vendor\magento\module-checkout\Controller\Cart\Add.php:`
```
  123               */
  124:             $this->_eventManager->dispatch(
  125                  'checkout_cart_add_product_complete',
```
`vendor\magento\module-checkout\Controller\Cart\UpdateItemOptions.php:`
```
  60  
  61:             $this->_eventManager->dispatch(
  62                  'checkout_cart_update_item_complete',
```
`vendor\magento\module-checkout\Controller\Onepage\SaveOrder.php:`
```
  132  
  133:         $this->_eventManager->dispatch(
  134              'checkout_controller_onepage_saveOrder',
```
`vendor\magento\module-checkout\Controller\Onepage\Success.php:`
```
  28          $resultPage = $this->resultPageFactory->create();
  29:         $this->_eventManager->dispatch(
  30              'checkout_onepage_controller_success_action',
```
`vendor\magento\module-checkout\Helper\Data.php:`
```
  276              $result->setIsAllowed($guestCheckout);
  277:             $this->_eventManager->dispatch(
  278                  'checkout_allow_guest',
```
`vendor\magento\module-checkout\Model\Cart.php:`
```
  374              try {
  375:                 $this->_eventManager->dispatch(
  376                      'checkout_cart_product_add_before',

  405  
  406:         $this->_eventManager->dispatch(
  407              'checkout_cart_product_add_after',

  506          $infoDataObject = new \Magento\Framework\DataObject($data);
  507:         $this->_eventManager->dispatch(
  508              'checkout_cart_update_items_before',

  547  
  548:         $this->_eventManager->dispatch(
  549              'checkout_cart_update_items_after',

  575      {
  576:         $this->_eventManager->dispatch('checkout_cart_save_before', ['cart' => $this]);
  577  

  585           */
  586:         $this->_eventManager->dispatch('checkout_cart_save_after', ['cart' => $this]);
  587          $this->reinitializeState();

  735  
  736:         $this->_eventManager->dispatch(
  737              'checkout_cart_product_update_after',
```
`vendor\magento\module-checkout\Model\Session.php:`
```
  236      {
  237:         $this->_eventManager->dispatch('custom_quote_process', ['checkout_session' => $this]);
  238  

  293                      $quote->setIsCheckoutCart(true);
  294:                     $this->_eventManager->dispatch('checkout_quote_init', ['quote' => $quote]);
  295                  }

  373  
  374:         $this->_eventManager->dispatch('load_customer_quote_before', ['checkout_session' => $this]);
  375  

  471      {
  472:         $this->_eventManager->dispatch('checkout_quote_destroy', ['quote' => $this->getQuote()]);
  473          $this->_quote = null;

  558                  $this->replaceQuote($quote)->unsLastRealOrderId();
  559:                 $this->_eventManager->dispatch('restore_quote', ['order' => $order, 'quote' => $quote]);
  560                  return true;
```
`vendor\magento\module-checkout\Model\Type\Onepage.php:`
```
  717          if ($order) {
  718:             $this->_eventManager->dispatch(
  719                  'checkout_type_onepage_save_order_after',

  745  
  746:         $this->_eventManager->dispatch(
  747              'checkout_submit_all_after',
```
`vendor\magento\module-cms\Controller\Router.php:`
```
  94          $condition = new \Magento\Framework\DataObject(['identifier' => $identifier, 'continue' => true]);
  95:         $this->_eventManager->dispatch(
  96              'cms_controller_router_match_before',
```
`vendor\magento\module-cms\Controller\Adminhtml\Page\Delete.php:`
```
  47                  // go to grid
  48:                 $this->_eventManager->dispatch('adminhtml_cmspage_on_delete', [
  49                      'title' => $title,

  54              } catch (\Exception $e) {
  55:                 $this->_eventManager->dispatch(
  56                      'adminhtml_cmspage_on_delete',
```
`vendor\magento\module-cms\Controller\Adminhtml\Page\Save.php:`
```
  108              try {
  109:                 $this->_eventManager->dispatch(
  110                      'cms_page_prepare_save',
```
`vendor\magento\module-cms\Helper\Page.php:`
```
  203  
  204:         $this->_eventManager->dispatch(
  205              'cms_page_render',
```
`vendor\magento\module-cms\Helper\Wysiwyg\Images.php:`
```
  185          $checkResult->isAllowed = false;
  186:         $this->_eventManager->dispatch(
  187              'cms_wysiwyg_images_static_urls_allowed',
```
`vendor\magento\module-config\Block\System\Config\Form\Fieldset\Modules\DisableOutput.php:`
```
  79          $dispatchResult = new \Magento\Framework\DataObject($modules);
  80:         $this->_eventManager->dispatch(
  81              'adminhtml_system_config_advanced_disableoutput_render_before',
```
`vendor\magento\module-config\Controller\Adminhtml\System\Config\Save.php:`
```
  226              $configModel->save();
  227:             $this->_eventManager->dispatch(
  228                  'admin_system_config_save',
```
`vendor\magento\module-config\Model\Config.php:`
```
  221              // website and store codes can be used in event implementation, so set them as well
  222:             $this->_eventManager->dispatch(
  223                  "admin_system_config_changed_section_{$this->getSection()}",
```
`vendor\magento\module-cookie\Controller\Index\NoCookies.php:`
```
  18          $redirect = new \Magento\Framework\DataObject();
  19:         $this->_eventManager->dispatch(
  20              'controller_action_nocookies',
```
`vendor\magento\module-currency-symbol\Model\System\Currencysymbol.php:`
```
  215  
  216:         $this->_eventManager->dispatch(
  217              'admin_system_config_changed_section_currency_before_reinit',

  227  
  228:         $this->_eventManager->dispatch(
  229              'admin_system_config_changed_section_currency',
```
`vendor\magento\module-customer\Block\Adminhtml\Edit\Tab\Carts.php:`
```
  82      {
  83:         $this->_eventManager->dispatch('adminhtml_block_html_before', ['block' => $this]);
  84          return $this->getChildHtml();
```
`vendor\magento\module-customer\Controller\Account\CreatePost.php:`
```
  381  
  382:             $this->_eventManager->dispatch(
  383                  'customer_register_success',
```
`vendor\magento\module-customer\Controller\Account\EditPost.php:`
```
  259      {
  260:         $this->_eventManager->dispatch(
  261              'customer_account_edited',
```
`vendor\magento\module-customer\Controller\Adminhtml\Index\Save.php:`
```
  345  
  346:                 $this->_eventManager->dispatch(
  347                      'adminhtml_customer_prepare_save',

  373                  // After save
  374:                 $this->_eventManager->dispatch(
  375                      'adminhtml_customer_save_after',
```
`vendor\magento\module-customer\Model\Customer.php:`
```
  430          }
  431:         $this->_eventManager->dispatch(
  432              'customer_customer_authenticated',
```
`vendor\magento\module-customer\Model\Session.php:`
```
  193              ->get(AccountConfirmation::class);
  194:         $this->_eventManager->dispatch('customer_session_init', ['customer_session' => $this]);
  195      }

  447          $this->setCustomer($customer);
  448:         $this->_eventManager->dispatch('customer_login', ['customer' => $customer]);
  449:         $this->_eventManager->dispatch('customer_data_object_login', ['customer' => $this->getCustomerDataObject()]);
  450          return $this;

  468  
  469:         $this->_eventManager->dispatch('customer_login', ['customer' => $customerModel]);
  470:         $this->_eventManager->dispatch('customer_data_object_login', ['customer' => $customer]);
  471          return $this;

  500          if ($this->isLoggedIn()) {
  501:             $this->_eventManager->dispatch('customer_logout', ['customer' => $this->getCustomer()]);
  502              $this->_logout();
```
`vendor\magento\module-customer\Model\Visitor.php:`
```
  191              $this->save();
  192:             $this->_eventManager->dispatch('visitor_init', ['visitor' => $this]);
  193              $this->session->setVisitorData($this->getData());

  219              $this->save();
  220:             $this->_eventManager->dispatch('visitor_activity_save', ['visitor' => $this]);
  221              $this->session->setVisitorData($this->getData());
```
`vendor\magento\module-customer\Model\Address\AbstractAddress.php:`
```
  503          }
  504:         $this->_eventManager->dispatch('customer_address_format', ['type' => $formatType, 'address' => $this]);
  505          return $formatType->getRenderer()->render($this);
```
`vendor\magento\module-eav\Block\Adminhtml\Attribute\Edit\Main\AbstractMain.php:`
```
  271      {
  272:         $this->_eventManager->dispatch(
  273              'adminhtml_block_eav_attribute_edit_form_init',
```
`vendor\magento\module-eav\Model\Entity\Collection\AbstractCollection.php:`
```
  918          \Magento\Framework\Profiler::start('before_load');
  919:         $this->_eventManager->dispatch('eav_collection_abstract_load_before', ['collection' => $this]);
  920          $this->_beforeLoad();
```
`vendor\magento\module-gift-message\Block\Message\Inline.php:`
```
  244              $entityItems = $this->getEntity()->getAllItems();
  245:             $this->_eventManager->dispatch('gift_options_prepare_items', ['items' => $entityItems]);
  246  

  338          if (!$entity->hasIsGiftOptionsAvailable()) {
  339:             $this->_eventManager->dispatch('gift_options_prepare', ['entity' => $entity]);
  340          }
```
`vendor\magento\module-inventory-admin-ui\Controller\Adminhtml\Source\Save.php:`
```
  127  
  128:         $this->_eventManager->dispatch(
  129              'controller_action_inventory_populate_source_with_data',

  137  
  138:         $this->_eventManager->dispatch(
  139              'controller_action_inventory_source_save_after',
```
`vendor\magento\module-multishipping\Controller\Checkout\ShippingPost.php:`
```
  19          try {
  20:             $this->_eventManager->dispatch(
  21                  'checkout_controller_multishipping_shipping_post',
```
`vendor\magento\module-multishipping\Controller\Checkout\Success.php:`
```
  58          $ids = $this->multishipping->getOrderIds();
  59:         $this->_eventManager->dispatch('multishipping_checkout_controller_success_action', ['order_ids' => $ids]);
  60          $this->_view->renderLayout();
```
`vendor\magento\module-multishipping\Model\Checkout\Type\Multishipping.php:`
```
  492              $this->save();
  493:             $this->_eventManager->dispatch('checkout_type_multishipping_set_shipping_items', ['quote' => $quote]);
  494          }

  818                  $orders[] = $order;
  819:                 $this->_eventManager->dispatch(
  820                      'checkout_type_multishipping_create_orders_single',

  866              $this->_session->setAddressErrors($addressErrors);
  867:             $this->_eventManager->dispatch(
  868                  'checkout_submit_all_after',

  873          } catch (\Exception $e) {
  874:             $this->_eventManager->dispatch('checkout_multishipping_refund_all', ['orders' => $orders]);
  875              throw $e;
```
`vendor\magento\module-payment\Block\Form\Cc.php:`
```
  153      {
  154:         $this->_eventManager->dispatch('payment_form_block_to_html_before', ['block' => $this]);
  155          return parent::_toHtml();
```
`vendor\magento\module-payment\Model\Cart.php:`
```
  306  
  307:         $this->_eventManager->dispatch('payment_cart_collect_items_and_amounts', ['cart' => $this]);
  308  
```
`vendor\magento\module-payment\Model\Method\AbstractMethod.php:`
```
  810      {
  811:         $this->_eventManager->dispatch(
  812              'payment_method_assign_data_' . $this->getCode(),

  819  
  820:         $this->_eventManager->dispatch(
  821              'payment_method_assign_data',

  848          // for future use in observers
  849:         $this->_eventManager->dispatch(
  850              'payment_method_is_active',
```
`vendor\magento\module-paypal\Controller\Express\OnAuthorization.php:`
```
  147  
  148:                 $this->_eventManager->dispatch(
  149                      'paypal_express_place_order_success',
```
`vendor\magento\module-paypal\Controller\Express\AbstractExpress\PlaceOrder.php:`
```
  114  
  115:             $this->_eventManager->dispatch(
  116                  'paypal_express_place_order_success',
```
`vendor\magento\module-paypal\Controller\Ipn\Index.php:`
```
  89              $incrementId = $this->getRequest()->getPostValue()['invoice'];
  90:             $this->_eventManager->dispatch(
  91                  'paypal_checkout_success',
```
`vendor\magento\module-paypal\Model\Payflowpro.php:`
```
  909      {
  910:         $this->_eventManager->dispatch(
  911              'payment_method_assign_data_' . $this->getCode(),

  918  
  919:         $this->_eventManager->dispatch(
  920              'payment_method_assign_data',
```
`vendor\magento\module-persistent\Controller\Index\UnsetCookie.php:`
```
  35      {
  36:         $this->_eventManager->dispatch('persistent_session_expired');
  37          $this->customerSession->setCustomerId(null)->setCustomerGroupId(null);
```
`vendor\magento\module-persistent\Observer\CheckExpirePersistentQuoteObserver.php:`
```
  130          if ($this->isPersistentQuoteOutdated()) {
  131:             $this->_eventManager->dispatch('persistent_session_expired');
  132              $this->quoteManager->expire();

  145          ) {
  146:             $this->_eventManager->dispatch('persistent_session_expired');
  147              $this->quoteManager->expire();
```
`vendor\magento\module-quote\Model\Quote.php:`
```
  1559  
  1560:             $this->_eventManager->dispatch('sales_quote_remove_item', ['quote_item' => $item]);
  1561          }

  1594              $this->getItemsCollection()->addItem($item);
  1595:             $this->_eventManager->dispatch('sales_quote_add_item', ['quote_item' => $item]);
  1596          }

  1697  
  1698:         $this->_eventManager->dispatch('sales_quote_product_add_after', ['items' => $items]);
  1699          return $parentItem;

  2386      {
  2387:         $this->_eventManager->dispatch(
  2388              $this->_eventPrefix . '_merge_before',

  2427  
  2428:         $this->_eventManager->dispatch(
  2429              $this->_eventPrefix . '_merge_after',
```
`vendor\magento\module-quote\Model\Quote\Item.php:`
```
  354  
  355:         $this->_eventManager->dispatch('sales_quote_item_qty_set_after', ['item' => $this]);
  356  

  441  
  442:         $this->_eventManager->dispatch(
  443              'sales_quote_item_set_product',
```
`vendor\magento\module-quote\Model\Quote\Payment.php:`
```
  173          $data = new \Magento\Framework\DataObject($data);
  174:         $this->_eventManager->dispatch(
  175              $this->_eventPrefix . '_import_data_before',
```
`vendor\magento\module-quote\Model\ResourceModel\Quote\Address\Collection.php:`
```
  63  
  64:         $this->_eventManager->dispatch($this->_eventPrefix . '_load_after', [$this->_eventObject => $this]);
  65  
```
`vendor\magento\module-quote\Model\ResourceModel\Quote\Item\Collection.php:`
```
  247  
  248:         $this->_eventManager->dispatch(
  249              'prepare_catalog_product_collection_prices',

  251          );
  252:         $this->_eventManager->dispatch(
  253              'sales_quote_item_collection_products_after_load',
```
`vendor\magento\module-reports\Block\Adminhtml\Grid.php:`
```
  186  
  187:             $this->_eventManager->dispatch(
  188                  'adminhtml_widget_grid_filter_collection',
```
`vendor\magento\module-reports\Model\ResourceModel\Order\Collection.php:`
```
  190  
  191:             $this->_eventManager->dispatch(
  192                  'sales_prepare_amount_expression',
```
`vendor\magento\module-review\Controller\Product.php:`
```
  178      {
  179:         $this->_eventManager->dispatch('review_controller_product_init_before', ['controller_action' => $this]);
  180          $categoryId = (int)$this->getRequest()->getParam('category', false);

  193          try {
  194:             $this->_eventManager->dispatch('review_controller_product_init', ['product' => $product]);
  195:             $this->_eventManager->dispatch(
  196                  'review_controller_product_init_after',
```
`vendor\magento\module-review\Model\ResourceModel\Rating\Collection.php:`
```
  283          }
  284:         $this->_eventManager->dispatch('rating_rating_collection_load_before', ['collection' => $this]);
  285          parent::load($printQuery, $logQuery);
```
`vendor\magento\module-review\Model\ResourceModel\Review\Collection.php:`
```
  289          }
  290:         $this->_eventManager->dispatch('review_review_collection_load_before', ['collection' => $this]);
  291          parent::load($printQuery, $logQuery);
```
`vendor\magento\module-sales\Block\Adminhtml\Reorder\Renderer\Action.php:`
```
  60          }
  61:         $this->_eventManager->dispatch(
  62              'adminhtml_customer_orders_add_action_renderer',
```
`vendor\magento\module-sales\Controller\Adminhtml\Order\AddressSave.php:`
```
  123                  $this->orderAddressRepository->save($address);
  124:                 $this->_eventManager->dispatch(
  125                      'admin_sales_order_address_update',
```
`vendor\magento\module-sales\Controller\Adminhtml\Order\Create.php:`
```
  161  
  162:         $this->_eventManager->dispatch('adminhtml_sales_order_create_process_data_before', $eventData);
  163  

  220  
  221:         $this->_eventManager->dispatch('adminhtml_sales_order_create_process_item_before', $eventData);
  222  

  269  
  270:         $this->_eventManager->dispatch('adminhtml_sales_order_create_process_item_after', $eventData);
  271  

  280  
  281:         $this->_eventManager->dispatch('adminhtml_sales_order_create_process_data', $eventData);
  282  
```
`vendor\magento\module-sales\Model\Order.php:`
```
  1188      {
  1189:         $this->_eventManager->dispatch('sales_order_place_before', ['order' => $this]);
  1190          $this->_placePayment();
  1191:         $this->_eventManager->dispatch('sales_order_place_after', ['order' => $this]);
  1192          return $this;

  1242  
  1243:             $this->_eventManager->dispatch('order_cancel_after', ['order' => $this]);
  1244          }
```
`vendor\magento\module-sales\Model\AdminOrder\Create.php:`
```
   569  
   570:         $this->_eventManager->dispatch('sales_convert_order_to_quote', ['order' => $order, 'quote' => $quote]);
   571  

   682  
   683:             $this->_eventManager->dispatch(
   684                  'sales_convert_order_item_to_quote_item',

  1966  
  1967:         $this->_eventManager->dispatch('checkout_submit_all_after', ['order' => $order, 'quote' => $quote]);
  1968  
```
`vendor\magento\module-sales\Model\Config\Backend\Email\AsyncSending.php:`
```
  29  
  30:             $this->_eventManager->dispatch(
  31                  $this->_eventPrefix . '_sales_email_general_async_sending_' . $state,
```
`vendor\magento\module-sales\Model\Config\Backend\Grid\AsyncIndexing.php:`
```
  29  
  30:             $this->_eventManager->dispatch(
  31                  $this->_eventPrefix . '_dev_grid_async_indexing_' . $state,
```
`vendor\magento\module-sales\Model\Order\Invoice.php:`
```
  378          $order->setBaseTotalPaid($baseTotalPaid);
  379:         $this->_eventManager->dispatch('sales_order_invoice_pay', [$this->_eventObject => $this]);
  380          return $this;

  452              ->setStatus($order->getConfig()->getStateDefaultStatus(\Magento\Sales\Model\Order::STATE_PROCESSING));
  453:         $this->_eventManager->dispatch('sales_order_invoice_cancel', [$this->_eventObject => $this]);
  454          return $this;

  666  
  667:         $this->_eventManager->dispatch(
  668              'sales_order_invoice_register',
```
`vendor\magento\module-sales\Model\Order\Item.php:`
```
  409          if ($this->getStatusId() !== self::STATUS_CANCELED) {
  410:             $this->_eventManager->dispatch('sales_order_item_cancel', ['item' => $this]);
  411              $this->setQtyCanceled($this->getQtyToCancel());
```
`vendor\magento\module-sales\Model\Order\Payment.php:`
```
  353      {
  354:         $this->_eventManager->dispatch('sales_order_payment_place_start', ['payment' => $this]);
  355          $order = $this->getOrder();

  401  
  402:         $this->_eventManager->dispatch('sales_order_payment_place_end', ['payment' => $this]);
  403  

  534          $this->setBaseShippingCaptured($totals['base_shipping_amount']);
  535:         $this->_eventManager->dispatch('sales_order_payment_pay', ['payment' => $this, 'invoice' => $invoice]);
  536  

  555          );
  556:         $this->_eventManager->dispatch(
  557              'sales_order_payment_cancel_invoice',

  609          $this->_void(true);
  610:         $this->_eventManager->dispatch('sales_order_payment_void', ['payment' => $this, 'invoice' => $document]);
  611  

  756              )->setIsCustomerNotified($creditmemo->getOrder()->getCustomerNoteNotify());
  757:         $this->_eventManager->dispatch(
  758              'sales_order_payment_refund',

  867          );
  868:         $this->_eventManager->dispatch(
  869              'sales_order_payment_cancel_creditmemo',

  897  
  898:         $this->_eventManager->dispatch('sales_order_payment_cancel', ['payment' => $this]);
  899  
```
`vendor\magento\module-sales\Model\Order\Status.php:`
```
  118          $this->getResource()->unassignState($this->getStatus(), $state);
  119:         $this->_eventManager->dispatch(
  120              'sales_order_status_unassign',
```
`vendor\magento\module-sales\Model\Order\Payment\Transaction.php:`
```
  899      {
  900:         $this->_eventManager->dispatch($this->_eventPrefix . '_html_txn_id', $this->_getEventData());
  901          return $this->_data['html_txn_id'] ?? $this->getTxnId();
```
`vendor\magento\module-sales\Model\ResourceModel\Order\Address\Collection.php:`
```
  53  
  54:         $this->_eventManager->dispatch($this->_eventPrefix . '_load_after', [$this->_eventObject => $this]);
  55  
```
`vendor\magento\module-sales\Model\ResourceModel\Order\Collection\AbstractCollection.php:`
```
  38          if ($this->_eventPrefix && $this->_eventObject) {
  39:             $this->_eventManager->dispatch(
  40                  $this->_eventPrefix . '_set_sales_order',
```
`vendor\magento\module-sales\Model\ResourceModel\Sale\Collection.php:`
```
  165  
  166:         $this->_eventManager->dispatch('sales_sale_collection_query_before', ['collection' => $this]);
  167          return $this;
```
`vendor\magento\module-sales-rule\Block\Adminhtml\Promo\Quote\Edit\Tab\Actions.php:`
```
  203  
  204:         $this->_eventManager->dispatch('adminhtml_block_salesrule_actions_prepareform', ['form' => $form]);
  205  
```
`vendor\magento\module-sales-rule\Block\Adminhtml\Promo\Quote\Edit\Tab\Coupons\Form.php:`
```
  169  
  170:         $this->_eventManager->dispatch(
  171              'adminhtml_promo_quote_edit_tab_coupons_form_prepare_form',
```
`vendor\magento\module-sales-rule\Block\Adminhtml\Promo\Widget\Chooser.php:`
```
  57  
  58:         $this->_eventManager->dispatch(
  59              'adminhtml_block_promo_widget_chooser_prepare_collection',
```
`vendor\magento\module-sales-rule\Controller\Adminhtml\Promo\Quote\Save.php:`
```
  68                  $model = $this->_objectManager->create(\Magento\SalesRule\Model\Rule::class);
  69:                 $this->_eventManager->dispatch(
  70                      'adminhtml_controller_salesrule_prepare_save',
```
`vendor\magento\module-sales-rule\Model\Rule.php:`
```
  461              );
  462:             $this->_eventManager->dispatch('salesrule_rule_get_coupon_types', ['transport' => $transport]);
  463              $this->_couponTypes = $transport->getCouponTypes();
```
`vendor\magento\module-sales-rule\Model\RulesApplier.php:`
```
  329  
  330:         $this->_eventManager->dispatch(
  331              'salesrule_validator_process',
```
`vendor\magento\module-sales-rule\Model\Rule\Condition\Combine.php:`
```
  80          $additional = new \Magento\Framework\DataObject();
  81:         $this->_eventManager->dispatch('salesrule_rule_condition_combine', ['additional' => $additional]);
  82          $additionalConditions = $additional->getConditions();
```
`vendor\magento\module-search\Controller\Adminhtml\Term\Report.php:`
```
  27      {
  28:         $this->_eventManager->dispatch('on_view_report', ['report' => 'search']);
  29          /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
```
`vendor\magento\module-send-friend\Controller\Product\Send.php:`
```
  71  
  72:         $this->_eventManager->dispatch('sendfriend_product', ['product' => $product]);
  73          $data = $this->catalogSession->getSendfriendFormData();
```
`vendor\magento\module-swatches\Controller\Adminhtml\Iframe\Show.php:`
```
  93  
  94:             $this->_eventManager->dispatch(
  95                  'swatch_gallery_upload_image_after',
```
`vendor\magento\module-tax\Controller\Adminhtml\Tax\IgnoreTaxNotification.php:`
```
  54          $this->_cacheTypeList->cleanType('config');
  55:         $this->_eventManager->dispatch('adminhtml_cache_refresh_type', ['type' => 'config']);
  56  
```
`vendor\magento\module-tax\Model\Calculation.php:`
```
  366              $this->unsEventModuleId();
  367:             $this->_eventManager->dispatch('tax_rate_data_fetch', ['request' => $request, 'sender' => $this]);
  368              if (!$this->hasRateValue()) {
```
`vendor\magento\module-tax\Model\Calculation\Rate.php:`
```
  192          $this->saveTitles();
  193:         $this->_eventManager->dispatch('tax_settings_change_after');
  194          return parent::afterSave();

  220      {
  221:         $this->_eventManager->dispatch('tax_settings_change_after');
  222          return parent::afterDelete();

  289          $this->_getResource()->deleteAllRates();
  290:         $this->_eventManager->dispatch('tax_settings_change_after');
  291          return $this;
```
`vendor\magento\module-tax\Model\Calculation\Rule.php:`
```
  107          $this->saveCalculationData();
  108:         $this->_eventManager->dispatch('tax_settings_change_after');
  109          return $this;

  119      {
  120:         $this->_eventManager->dispatch('tax_settings_change_after');
  121          return parent::afterDelete();
```
`vendor\magento\module-theme\Block\Html\Topmenu.php:`
```
   86      {
   87:         $this->_eventManager->dispatch(
   88              'page_block_html_topmenu_gethtml_before',

  104  
  105:         $this->_eventManager->dispatch(
  106              'page_block_html_topmenu_gethtml_after',
```
`vendor\magento\module-theme\Model\Config.php:`
```
   99  
  100:         $this->_eventManager->dispatch(
  101              'assign_theme_to_stores_after',
```
`vendor\magento\module-user\Block\Role.php:`
```
  72      {
  73:         $this->_eventManager->dispatch('permissions_role_html_before', ['block' => $this]);
  74          return parent::_toHtml();
```
`vendor\magento\module-user\Controller\Adminhtml\User\Role\SaveRole.php:`
```
  100                  ->setUserType(UserContextInterface::USER_TYPE_ADMIN);
  101:             $this->_eventManager->dispatch(
  102                  'admin_permissions_role_prepare_save',
```
`vendor\magento\module-user\Model\User.php:`
```
  577          try {
  578:             $this->_eventManager->dispatch(
  579                  'admin_user_authenticate_before',

  587  
  588:             $this->_eventManager->dispatch(
  589                  'admin_user_authenticate_after',

  935          }
  936:         $this->_eventManager->dispatch(
  937              'admin_user_authenticate_after',
```
`vendor\magento\module-wishlist\Block\Customer\Wishlist\Item\Options.php:`
```
  62          parent::_construct();
  63:         $this->_eventManager->dispatch('product_option_renderer_init', ['block' => $this]);
  64      }
```
`vendor\magento\module-wishlist\Controller\Index\Add.php:`
```
  122              }
  123:             $this->_eventManager->dispatch(
  124                  'wishlist_add_product',
```
`vendor\magento\module-wishlist\Controller\Index\Send.php:`
```
  285  
  286:             $this->_eventManager->dispatch('wishlist_share', ['wishlist' => $wishlist]);
  287              $this->messageManager->addSuccessMessage(__('Your wish list has been shared.'));
```
`vendor\magento\module-wishlist\Controller\Index\UpdateItemOptions.php:`
```
  110              $this->_objectManager->get(\Magento\Wishlist\Helper\Data::class)->calculate();
  111:             $this->_eventManager->dispatch(
  112                  'wishlist_update_item',
```
`vendor\magento\module-wishlist\Helper\Data.php:`
```
  616          $this->_customerSession->setWishlistItemCount($count);
  617:         $this->_eventManager->dispatch('wishlist_items_renewed');
  618          return $this;
```
`vendor\magento\module-wishlist\Model\Wishlist.php:`
```
  413              $this->getItemCollection()->addItem($item);
  414:             $this->_eventManager->dispatch('wishlist_add_item', ['item' => $item]);
  415          }

  522  
  523:         $this->_eventManager->dispatch('wishlist_product_add_after', ['items' => $items]);
  524  
```
`vendor\magento\module-wishlist\Model\ResourceModel\Item\Collection.php:`
```
  322  
  323:         $this->_eventManager->dispatch(
  324              'wishlist_item_collection_products_after_load',
```
