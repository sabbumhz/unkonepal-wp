<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package UnkoNepal
 */

 /**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 *
 * @return void
 */

function unkonepal_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'unkonepal_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function unkonepal_woocommerce_scripts() {
	wp_enqueue_style( 'unkonepal-woocommerce-style', get_template_directory_uri() . 'style.css' );
	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'unkonepal-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'unkonepal_woocommerce_scripts' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'woocommerce_wrapper_before' ) ) {

	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function woocommerce_wrapper_before() {
?>
			<section class="product-page-content">
<?php
	}

}
add_action( 'woocommerce_before_main_content', 'woocommerce_wrapper_before' );

if ( ! function_exists( 'woocommerce_wrapper_after' ) ) {

	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function woocommerce_wrapper_after() {
			?>
		</section><!-- #section -->
		<?php
	}

}
add_action( 'woocommerce_after_main_content', 'woocommerce_wrapper_after' );


// wrap image with div

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
* WooCommerce Loop Product Thumbs
**/
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo "<div class='product-img'>";
        echo woocommerce_get_product_thumbnail();
        echo "</div>";
    }
}

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Removed breadcrumb 
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Remove WooCommerce sidebar
 *
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function shopay_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'shopay_woocommerce_products_per_page' );


// add product description in product summary
function product_description() {
    the_content();
}

add_action( 'woocommerce_single_product_summary', 'product_description', 12 );

/**
 * add maker block in product page
 *
 */
add_action( 'woocommerce_product_tabs', 'shoptimizer_maker_name_field', 9 );
  
function shoptimizer_maker_name_field() { ?>

<?php if(get_field('maker_image') || the_field('maker_description')) { 
	 $image = get_field('maker_image');
	 ?>
	<div class="maker-block">
		<h2>Our Maker</h2>
		<div class="maker">
		<?php if( $image ) {?>
			<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
		<?php } ?>
			<div>
				<h3><?php the_field('maker_name'); ?></h3>
				<p><?php the_field('maker_description'); ?></p>
				<a href="<?php the_field('maker_profile'); ?>" class="btn btn--primary">
				<?php the_field('maker_name'); ?>'s Profile
				</a>
			</div>
		</div>
	</div>
<?php }
}


/**
 * Add Product Review inplace of wocommerce tabs
 *
 */

add_action( 'woocommerce_product_tabs', 'product_review', 10 );

function product_review()
{
  comments_template();
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs )
{
    unset( $tabs['reviews'] );

    return $tabs;
}

/**
 * Remove SKU from Product page
 *
 */
add_filter( 'wc_product_sku_enabled', '__return_false' );


/**
 * add customisation button in product page
 *
 */

add_action( 'woocommerce_after_add_to_cart_button', 'cutomisation_btn', 9 );
  
function cutomisation_btn() { ?>
<a class="btn btn--secondary product-customise-btn" href="google.com">Customise</a>
<?php
}

/* Show contact form instead of "Out Of Stock" message */

add_action('woocommerce_single_product_summary', 'customisation_btn_outofstock', 32);
function customisation_btn_outofstock() {
    global $product;
    if(!$product->is_in_stock( )) {
        echo  '<a class="btn btn--secondary product-customise-btn" href="google.com">Customise</a>';
    }
}

// add_filter( 'woocommerce_available_variation', 'variation_out_of_stock_show_form', 10, 3 );
// function variation_out_of_stock_show_form( $data, $product, $variation ) {
//     if( ! $data['is_in_stock'] )
//     {
// 		echo  '<a class="btn btn--secondary product-customise-btn" href="google.com">Customise</a>';
//     }
//     return $data;
// }

/**
 * add title
 *
 */
add_action( 'woocommerce_single_product_summary', 'product_detail_title', 39 );
  
function product_detail_title() { ?>
	<?php { ?>
		<h3 class="description-title"> Description </h3>
	<?php } ?>
<?php
}

/**
 * add product detail like material used and creator in product page
 *
 */
add_action( 'woocommerce_single_product_summary', 'product_detail', 99 );
  
function product_detail() {?>
<ul class="description-list">
	<?php if(get_field('material')) { ?><li><span> Materials: </span><?php if(get_field('material')) the_field('material'); ?> </li> <?php } ?>
	<?php if(get_field('maker_name')) { ?><li><span>Creator: </span><?php if(get_field('maker_name')) the_field('maker_name'); ?> </li> <?php } ?>
</ul>
<?php }

/**
 * change out of stock text
 *
 */

function out_of_stock_message( $text ){
$text = 'Out of Stock';
return $text;
}
add_filter( 'woocommerce_out_of_stock_message', 'out_of_stock_message', 999);

/**
 * Collection page remove wrapper
 *
 */

 // Hook after `WC_Shortcodes::init()` is executed.
add_action( 'init', function(){
    // Remove the shortcode.
    remove_shortcode( 'product_categories' );

    // Add it back, but using our callback.
    add_shortcode( 'product_categories', 'my_product_categories_shortcode' );
}, 11 );

 function my_product_categories_shortcode( $atts ) {
    $out = WC_Shortcodes::product_categories( $atts );

    // Modify the wrapper's opening tag.
    if ( ! empty( $atts['class'] ) ) {
        $columns = isset( $atts['columns'] ) ?
            absint( $atts['columns'] ) : 4;

        $out = str_replace(
            '<div class="woocommerce test columns-' . $columns . '">',
            '<div class="woocommerce test columns-' . $columns . ' ' . esc_attr( $atts['class'] ) . '">',
            $out
        );
    }

    return $out;
}

/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
	global $product;
	  
	  $args['posts_per_page'] = 3;
	  return $args;
  }
  add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
	function jk_related_products_args( $args ) {
	  $args['posts_per_page'] = 3; // 3 related products
	  $args['columns'] = 1; // arranged in 1 columns
	  return $args;
  }


  
/**
 * Product Filter
 */ 

  add_action('woocommerce_before_shop_loop','shop_main_heading');
function shop_main_heading(){
	echo do_shortcode('[searchandfilter id="filter"]');
	$content = '';
	$content.='<div class="filter-text"> Filter <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path d="M15.2936 5.32634C14.7367 5.32789 14.194 5.50002 13.7399 5.81913C13.2857 6.13824 12.9422 6.58871 12.7566 7.10878H0.899621C0.661027 7.10878 0.432205 7.20267 0.263493 7.36981C0.0947812 7.53695 0 7.76363 0 8C0 8.23636 0.0947812 8.46305 0.263493 8.63018C0.432205 8.79732 0.661027 8.89122 0.899621 8.89122H12.7566C12.9217 9.35365 13.2119 9.7622 13.5957 10.0721C13.9794 10.3821 14.4418 10.5815 14.9322 10.6485C15.4227 10.7156 15.9223 10.6477 16.3764 10.4523C16.8306 10.2568 17.2217 9.94143 17.5069 9.54055C17.7922 9.13967 17.9607 8.66878 17.9939 8.1794C18.0271 7.69002 17.9238 7.20102 17.6953 6.7659C17.4668 6.33079 17.1218 5.96634 16.6982 5.71244C16.2746 5.45854 15.7887 5.32496 15.2936 5.32634Z" fill="#937261"/>
	<path d="M0.899621 3.54391H1.96117C2.15028 4.06006 2.49521 4.50601 2.94911 4.82116C3.403 5.13632 3.94383 5.30538 4.49811 5.30538C5.05238 5.30538 5.59321 5.13632 6.0471 4.82116C6.501 4.50601 6.84593 4.06006 7.03504 3.54391H17.0928C17.3314 3.54391 17.5602 3.45001 17.7289 3.28288C17.8976 3.11574 17.9924 2.88906 17.9924 2.65269C17.9924 2.41632 17.8976 2.18964 17.7289 2.0225C17.5602 1.85537 17.3314 1.76147 17.0928 1.76147H7.03504C6.84593 1.24532 6.501 0.799366 6.0471 0.484215C5.59321 0.169064 5.05238 0 4.49811 0C3.94383 0 3.403 0.169064 2.94911 0.484215C2.49521 0.799366 2.15028 1.24532 1.96117 1.76147H0.899621C0.661027 1.76147 0.432204 1.85537 0.263493 2.0225C0.0947812 2.18964 0 2.41632 0 2.65269C0 2.88906 0.0947812 3.11574 0.263493 3.28288C0.432204 3.45001 0.661027 3.54391 0.899621 3.54391Z" fill="#937261"/>
	<path d="M17.0928 12.4561H10.6335C10.4444 11.9399 10.0995 11.494 9.64559 11.1788C9.1917 10.8637 8.65086 10.6946 8.09659 10.6946C7.54232 10.6946 7.00148 10.8637 6.54759 11.1788C6.0937 11.494 5.74876 11.9399 5.55966 12.4561H0.899621C0.661027 12.4561 0.432204 12.55 0.263493 12.7171C0.0947812 12.8843 0 13.1109 0 13.3473C0 13.5837 0.0947812 13.8104 0.263493 13.9775C0.432204 14.1446 0.661027 14.2385 0.899621 14.2385H5.55966C5.74876 14.7547 6.0937 15.2006 6.54759 15.5158C7.00148 15.8309 7.54232 16 8.09659 16C8.65086 16 9.1917 15.8309 9.64559 15.5158C10.0995 15.2006 10.4444 14.7547 10.6335 14.2385H17.0928C17.3314 14.2385 17.5602 14.1446 17.7289 13.9775C17.8976 13.8104 17.9924 13.5837 17.9924 13.3473C17.9924 13.1109 17.8976 12.8843 17.7289 12.7171C17.5602 12.55 17.3314 12.4561 17.0928 12.4561Z" fill="#937261"/>
	</svg>
	</div>'; 
	echo $content;
}