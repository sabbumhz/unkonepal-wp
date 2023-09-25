<?php
if( is_array($args) && $args['product'] ):
    $productData = $args['product'];
    $key = $args['key'];
    $totalProduct = $args['totalProduct'];

if( $productData->ID ):
    $product = wc_get_product($productData->ID);
    $productUrl = get_permalink($productData);
?>
<style>
    .hidden{
        display:none;
    }
</style>
    <li class="product type-product post-15 status-publish first instock  shipping-taxable purchasable product-type-simple <?php echo ($key>2) ? 'hidden' : '';?>">
        <a href="<?php echo $productUrl ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
            <div class="product-img">
                <?php echo get_the_post_thumbnail($productData->ID,'full',[
                    'class'=>'attachment-woocommerce_thumbnail size-woocommerce_thumbnail',
                    'width'=>'600',
                    'height'=>'750'
                ]);?>
            </div>
            <h2 class="woocommerce-loop-product__title"><?php echo $product->get_name();?></h2>
            <?php if ( $price_html = $product->get_price_html() ) : ?>
                <span class="price"><?php echo $price_html; ?></span>
            <?php endif; ?>
        </a>
        <?php
            echo apply_filters(
                'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
                sprintf(
                    '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
                    esc_url( $product->add_to_cart_url() ),
                    1,
                    'button',
                    '',
                    esc_html( $product->add_to_cart_text() )
                ),
                $product,
                $args
            );
        ?>
    </li>
<?php endif;
endif;
