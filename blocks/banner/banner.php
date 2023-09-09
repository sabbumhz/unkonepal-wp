<?php
/**
 * Banner Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

if ( is_admin() ):
    ?>
    <img src="<?php echo get_template_directory_uri(); ?>/images/banner-preview.jpg" width="" height="" alt="">
    <?php
else :
    // Support custom "anchor" values.
    $anchor = '';
    if ( ! empty( $block['anchor'] ) ) {
        $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
    }

    // Load values and assign defaults.
    $image            = get_field('banner_image');
    ?>
    <!-- block section -->
    <?php if( $image ) {?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
    <?php }?>
    <!-- block section end -->
    <?php
endif;