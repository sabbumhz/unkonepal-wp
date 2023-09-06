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

/**
 * Custom post type
 */

 function create_knitter_post_type() {
    register_post_type( 'knitters',
    array(
    'labels' => array(
    'name' => __( 'Knitters' ),
    'singular_name' => __( 'Knitter' )
    ),
    
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-admin-post',
    'supports' => array( 'title', 'editor', 'thumbnail' )
    )
    );
    }
    add_action( 'init', 'create_knitter_post_type' );


/**
* Add a custom link to the end of a specific menu that uses the wp_nav_menu() function
*/
add_filter('wp_nav_menu_items', 'add_search_item', 10, 2);
function add_search_item($items, $args){
    if( $args->theme_location == 'sitenav' ){
        $items .= '<li class="search-item"><a href="#"> <svg width="19" height="21" viewBox="0 0 19 21" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M14.398 14.483L19 19.514L17.814 20.528L13.224 15.511C11.802 16.5395 10.091 17.0919 8.336 17.089C3.732 17.089 0 13.369 0 8.77899C0 4.18898 3.732 0.471985 8.336 0.471985C12.939 0.471985 16.671 4.19199 16.671 8.77899C16.6739 10.9017 15.86 12.9441 14.398 14.483ZM8.336 15.53C12.076 15.53 15.108 12.508 15.108 8.77998C15.108 5.05098 12.077 2.02998 8.336 2.02998C4.595 2.02998 1.563 5.05098 1.563 8.77998C1.563 12.508 4.595 15.53 8.336 15.53Z" fill="#937261"/>
        </svg>
         Search</a></li>';
    }
    return $items;
}

