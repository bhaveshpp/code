Qty Plus-Minus button on product view page

```
<script>
    requirejs(['jquery'], function( $ ) {
        $(document).ready(function() {
            $('#cart-qty-minus').click(function () {
                var $input = $(this).parent().find('#qty');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('#cart-qty-plus').click(function () {
                var $input = $(this).parent().find('#qty');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        });
    });
</script>
```

Photorama Add video (phtml)

```
<script type="text/javascript">
require(['jquery'],  function($) {
    $(document).on('gallery:loaded', function () {
        var $fotorama = jQuery('div.gallery-placeholder > div.fotorama');
        var fotorama = $fotorama.data('fotorama');
        $fotorama.on('fotorama:load', function fotorama_onLoad(e, fotorama, extra) {
            if (extra.frame.type === 'iframe') {
                extra.frame.$stageFrame.html('<iframe align="middle" type="text/html" width="100%" height="100%" src="' + extra.frame.src + '" frameborder="0" scrolling="no" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>');
            }
        });
        <?php
        $_product = $block->getProduct();
        $videos = array($_product->getData('youtube1'),$_product->getData('youtube2'),$_product->getData('youtube3'));
        foreach ($videos as $video) {
            if (!empty($video)) {        
                ?>
                fotorama.push({ thumb: '<?= "https://img.youtube.com/vi/". $video ."/1.jpg"?>', 'src': '<?= "https://youtube.com/embed/".$video?>', type: 'iframe',caption: 'video' });
                <?php
            }
        }?>
    });
});
</script>
```