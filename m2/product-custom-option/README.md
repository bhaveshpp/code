## Magento 2 Create product custom option programetically

### Using event observer `catalog_product_save_after`
```
# \Magento\Catalog\Model\Product $product,

public function getOptions($product)
    {
        $values = [
            [
                'record_id'=>0,
                'title'=>'Option 1',
                'price'=>0,
                'price_type'=>"fixed",
                'sort_order'=>1,
                'sku' => "option_one", //code
                'is_delete'=>0
            ],
            [
                'record_id'=>1,
                'title'=>'Option 2',
                'price'=>$product->getCustomAttributeVal(),
                'price_type'=>"fixed",
                'sort_order'=>1,
                'sku' => "option_two", //code
                'is_delete'=>0
            ]
        ];

        $options = [
            [
                "sort_order"    => 1,
                "title"         => "Title", // Title of select box
                "price_type"    => "fixed", //type of price fixed / percent
                "price"         => "", // price
                "sku"           => "code", // code
                "type"          => "drop_down",
                "is_require"    => 1,
                "values"        => $values
            ]
        ];

        return $options;
    }
    
    protected function generateOptions($productId)
    {
        $product = $this->product->load($productId);
        $product->setHasOptions(1);
        $product->setCanSaveCustomOptions(true);
        foreach ($this->getOptions($product) as $arrayOption) {
            $option = $this->option
                ->setProductId($productId)
                ->setStoreId($product->getStoreId())
                ->addData($arrayOption);
            $option->save();
            $product->addOption($option);
        }
        $this->logger->log('info', 'Create Custom Options successfully');
    }
```

### Using Before plugin

```
class Save
{
    public function beforeExecute(\Magento\Catalog\Controller\Adminhtml\Product\Save $subject)
    {
        $req = $subject->getRequest()->getPostValue();

        if($req['product']['sku'] == "demo"){

            if (!empty($req['product']['price_if_he_pays_the_deposit'])) {

                $values = [
                    [
                        'record_id' => 1,
                        'title' => 'option 1 + ' . $req['product']['custom_attribute'] . "€",
                        'price' => 0,
                        'price_type' => "fixed",
                        'sort_order' => 1,
                        'sku' => "first",
                        'is_delete' => 0
                    ],
                    [
                        'record_id' => 2,
                        'title' => 'option 2',
                        'price' => 0,
                        'price_type' => "fixed",
                        'sort_order' => 1,
                        'sku' => "second",
                        'is_delete' => 0
                    ]
                ];

                $options = [

                    "sort_order" => 1,
                    "title" => "title",
                    'sku' => "code", // dropdown code
                    "price_type" => "fixed",
                    "price" => "",
                    "type" => "drop_down",
                    "is_require" => "1",
                    "values" => $values

                ];
                if (isset($req['product']['options'])) {
                    $updateOption = [];
                    foreach ($req['product']['options'] as $option) {
                        if ($option['sku'] != 'code') { // dropdown code
                            $updateOption[] = $option;
                        }
                    }
                    $req['product']['options'] = $updateOption;
                }
                $req['product']['affect_product_custom_options'] = 1;
                $req['product']['options'][] = $options;
            } else {
                if (isset($req['product']['options'])) {
                    $updateOption = [];
                    foreach ($req['product']['options'] as $option) {
                        if ($option['sku'] != 'code') { // dropdown code
                            $updateOption[] = $option;
                        }
                    }
                    $req['product']['options'] = $updateOption;
                }

            }
            $subject->getRequest()->setPostValue($req);
        }
    }
}

```
