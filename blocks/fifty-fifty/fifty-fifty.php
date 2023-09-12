<?php
/**
 * Fifty-fifty Template.
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
    <img src="<?php echo get_template_directory_uri(); ?>/images/block-preview.jpg" width="" height="" alt="block preview image">
    <?php

else :

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load values and assign defaults.
$title            = get_field( 'title' ) ?: 'Fifty Fifty Block';
$description      = get_field( 'description');
$btnLink          = get_field( 'button' );
$image            = get_field('image');
$imagePosition    = get_field('image_position');

$className = ($imagePosition =='right') ? 'class="section-blocks section-blocks--reverse"' : 'class="section-blocks"';
?>

<!-- block section -->
<section <?php echo $className ?> >
    <?php if( $image ) {?>
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
    <?php } ?>
    <div>
        <h2><?php echo esc_html( $title ); ?></h2>
        <p><?php echo esc_html( $description ); ?></p>
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
<!-- block section end -->
<?php endif;