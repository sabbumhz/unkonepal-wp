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