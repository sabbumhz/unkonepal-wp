<?php
/**
 * Latest Products List Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$title            = get_field('block_title');
$btnLink          = get_field( 'button' );
$products         = get_field('product_list');

?>

<!-- product listing section -->
<section>
    <h2><?php echo esc_html( $title ); ?></h2>

    <?php
        if( $products ): ?>
        <ul class="product-list">
            <?php foreach( $products as $product ): 
                $permalink = get_permalink( $product->ID );
                $product_title = get_the_title( $product->ID );
                $product_img = get_the_post_thumbnail( $product->ID );
                ?>
                <li>
                    <a href="<?php echo esc_url( $permalink ); ?>">
                        <figure>
                        <?php echo( $product_img ); ?>
                        </figure>
                        <h4><?php echo esc_html( $product_title ); ?></h4>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div>
        <?php
            if( $btnLink ): 
            $link_url = $btnLink['url'];
            $link_title = $btnLink['title'];
            $link_target = $btnLink['target'] ? $link['target'] : '_self';
            ?>
            <a class="btn btn--primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                <?php echo esc_html( $link_title ); ?>
            </a>
        <?php endif; ?>
    </div>
</section>
<!-- product listing section end -->