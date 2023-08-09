<?php

# ------------------------------------------
# ADD SCRIPTS
# ------------------------------------------
function theming_scripts()
{
    // CSS
    wp_enqueue_style('stylesheet', get_stylesheet_uri());
    //	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/custom.css' );
    //	fonts
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400;0,600;0,800;1,400;1,600&display=swap', false);
    // JS
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/script.js', array(), '', true);
}
add_action('wp_enqueue_scripts', 'theming_scripts');

# remove smilies/emoticon horridness
function cb_remove_smileys($bool)
{
    return false;
}
add_filter('option_use_smilies', 'cb_remove_smileys', 99, 1);

# ------------------------------------------
# REGISTER SITE MENUS
# ------------------------------------------
if (function_exists('add_theme_support')) {
    register_nav_menus(
        array(
            'sitenav' => __('Site nav'),
            'footnav1' => __('Footer nav 1'),
            'footnav2' => __('Footer nav 2'),
            'alcnav' => __('Account nav')
        )
    );
}

include 'inc/customizer.php';

# ------------------------------------------
# REGISTER SIDEBARS
# ------------------------------------------
function create_sidebar($name, $id, $description, $class)
{
    register_sidebar(array(
        'name' => __($name),
        'id' => $id,
        'description' => __($description),
        'before_widget' => '<div id="%1$s" class="'. $class .' %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget--title">',
        'after_title' => '</h3>'
    ));
}

create_sidebar('Sidebar', 'sidebar', 'Main site sidebar', 'site-widget');


# ------------------------------------------
# Adding Advance Custom Fields
# ------------------------------------------
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/fifty-fifty' );
    register_block_type( __DIR__ . '/blocks/banner' );
    register_block_type( __DIR__ . '/blocks/latest-product-list' );
    register_block_type( __DIR__ . '/blocks/category-list' );
}

/**
 * Load WooCommerce compatibility file.
 */

require get_template_directory() . '/inc/woocommerce/woocommerce.php';
// require get_template_directory() . '/inc/woocommerce/woocommerce-functions.php';
