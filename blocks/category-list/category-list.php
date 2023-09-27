<?php
/**
 * Category List Template.
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
    <img src="<?php echo get_template_directory_uri(); ?>/images/category-preview.jpg" width="" height="" alt="category-preview-image">
    <?php

else :
    // Support custom "anchor" values.
    $anchor = '';
    if ( ! empty( $block['anchor'] ) ) {
        $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
    }

    // Load values and assign defaults.
    $category_list        = get_field('category_list');

    ?>
    <!-- collection section start -->
    <section>
        <?php
        if( have_rows('category_list') ):
        ?>
        <ul class="collection-list">
            <?php
            while( have_rows('category_list') ) : the_row();
            ?>
            <li>
            <?php
                $category_feature_image= get_sub_field('category_feature_image');
                $category_link         = get_sub_field('category_link');
                if( $category_feature_image ) {
                ?><img src="<?php echo esc_url($category_feature_image ['url']); ?>" alt="<?php echo esc_attr($category_feature_image ['alt']); ?>"/>
                <?php
                }
                if( $category_link  ):
                    $link_url = $category_link ['url'];
                    $link_title = $category_link ['title'];
                    $link_target = $category_link ['target'] ? $link['target'] : '_self';
                ?>
                <a class="btn btn--underline" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                    <?php echo esc_html( $link_title ); ?>
                </a>
                <?php
                endif;
                ?>
            </li>
            <?php
            endwhile;
            ?>
        </ul>
        <?php
            endif;
        ?>
    </section>
    <!-- collection  section end -->
    <?php endif;