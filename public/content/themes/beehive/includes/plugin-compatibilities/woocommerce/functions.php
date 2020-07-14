<?php
/**
 * Woocommerce functions
 *
 * Functions that will make woocommerce compatible
 * with behive theme
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Include woocommerce
 * compatability class
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/plugin-compatibilities/woocommerce/class-beehive-woocommerce.php';

/**
 * Remove actions
 *
 * @since 1.0.0
 */
// Remove global wrapper (start).
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
// Remove global wrapper (end).
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
// Remove breadcumb.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
// Remove woocommerce sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
// Remove link wrapper (start).
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
// Remove link wrapper (end).
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
// Remove archieve product Image.
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
// Remove archive product title.
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
// Remove archive cart.
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/**
 * Actions
 *
 * @since 1.0.0
 */
// Beehive shop filter action.
add_action( 'woocommerce_before_main_content', 'beehive_wc_shop_filter' );
// Archive product open.
add_action( 'woocommerce_before_shop_loop_item', 'beehive_wc_template_loop_product_open', 10 );
// Archive product thummb.
add_action( 'woocommerce_before_shop_loop_item_title', 'beehive_wc_template_loop_product_thumbnail', 10 );
// Archive product title(open).
add_action( 'woocommerce_before_shop_loop_item_title', 'beehive_wc_template_loop_title_open', 15 );
// Archive product title.
add_action( 'woocommerce_shop_loop_item_title', 'beehive_wc_template_loop_product_title', 10 );
// Archive product title(close).
add_action( 'woocommerce_after_shop_loop_item_title', 'beehive_wc_template_loop_title_close', 15 );
// Archive product close.
add_action( 'woocommerce_after_shop_loop_item', 'beehive_wc_template_loop_product_close', 10 );
// Single breadcrumb.
add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 1 );
// Add mini cart icon to the notification nav.
add_action( 'beehive_notification_nav', 'beehive_wc_cart_icon' );

/**
 * Filters
 *
 * @since 1.0.0
 */
// Add body classes.
add_filter( 'body_class', 'beehive_wc_body_classes' );
// Archive products per row.
add_filter( 'loop_shop_columns', 'beehive_product_loop_columns' );
// Update mini cart with ajax.
add_filter( 'woocommerce_add_to_cart_fragments', 'beehive_wc_cart_icon_ajax' );

/**
 * Functions and definations starts
 */
if ( ! function_exists( 'beehive_wc_body_classes' ) ) {
	/**
	 * Conditionaly add body classes
	 *
	 * @param array $classes body classes array.
	 * @since 1.0.0
	 */
	function beehive_wc_body_classes( $classes ) {

		// Push classes.
		if ( TH_Helpers::has_shortcodes( array( 'product_categories' ) ) ) {
			array_push( $classes, 'beehive-product-categories' );
		}

		// Return classes.
		return $classes;
	}
}

if ( ! function_exists( 'beehive_wc_shop_filter' ) ) :
	/**
	 * Beehive product filter
	 *
	 * @since 1.0.0
	 */
	function beehive_wc_shop_filter() {
		if ( is_shop() ) {
			get_template_part( 'template-parts/woocommerce/shop-filters' );
		}
	}
endif;

/**
 * Beehive compatibility functions
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'beehive_product_loop_columns' ) ) :
	/**
	 * Output the number of columns per row
	 *
	 * @since 1.0.0
	 */
	function beehive_product_loop_columns() {
		if ( in_array( beehive()->layout->get(), array( 'full', 'social-collapsed' ), true ) ) {
			$columns = 5;
		} elseif ( in_array( beehive()->layout->get(), array( 'social-12' ), true ) ) {
			$columns = 4;
		} else {
			$columns = 3;
		}

		// Return columns.
		return apply_filters( 'beehive_products_columns', $columns );
	}
endif;

if ( ! function_exists( 'beehive_wc_template_loop_product_open' ) ) :
	/**
	 * Start of single product wrapper in the loop
	 *
	 * @since 1.0.0
	 */
	function beehive_wc_template_loop_product_open() {
		echo '<div class="item-product">';
	}
endif;

if ( ! function_exists( 'beehive_wc_template_loop_title_open' ) ) :
	/**
	 * Wrap the product title in the loop
	 *
	 * @since 1.0.0
	 */
	function beehive_wc_template_loop_title_open() {
		echo '<div class="product-info">';
	}
endif;

if ( ! function_exists( 'beehive_wc_template_loop_product_title' ) ) :
	/**
	 * The product title in the loop
	 *
	 * @since 1.0.0
	 */
	function beehive_wc_template_loop_product_title() {
		echo '<h2 class="woocommerce-loop-product__title"><a href="' . esc_url( get_the_permalink() ) . '">' . wp_kses_post( get_the_title() ) . '</a></h2>';
	}
endif;

if ( ! function_exists( 'beehive_wc_template_loop_title_close' ) ) :
	/**
	 * Product title wrapper end
	 *
	 * @since 1.0.0
	 */
	function beehive_wc_template_loop_title_close() {
		echo '</div>';
	}
endif;

if ( ! function_exists( 'beehive_wc_template_loop_product_close' ) ) :
	/**
	 * End of single product wrapper in the loop
	 *
	 * @since 1.0.0
	 */
	function beehive_wc_template_loop_product_close() {
		echo '</div>';
	}
endif;

if ( ! function_exists( 'beehive_wc_get_cart_icon' ) ) :
	/**
	 * Get WooCommerce Cart Menu Item
	 *
	 * @since 1.0.0
	 */
	function beehive_wc_get_cart_icon() {
		if ( WC()->cart->cart_contents_count ) {
			$count = sprintf( '<span class="count">%d</span>', WC()->cart->cart_contents_count );
		} else {
			$count = '';
		}
		return sprintf( '<li class="mini-cart nav-item"><a href="%1$s" class="cart-contents nav-link" title="%3$s"><i class="uil-cart"></i>%2$s</a></li>', esc_url( wc_get_cart_url() ), $count, esc_attr__( 'View Cart', 'beehive' ) );
	}
endif;

if ( ! function_exists( 'beehive_wc_cart_icon' ) ) :
	/**
	 * Display
	 *
	 * @since 1.0.0
	 */
	function beehive_wc_cart_icon() {
		echo beehive_wc_get_cart_icon(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'beehive_wc_cart_icon_ajax' ) ) :
	/**
	 * Add AJAX when cart menu icon contents update
	 *
	 * @since 1.0.0
	 */
	function beehive_wc_cart_icon_ajax() {
		if ( WC()->cart->cart_contents_count ) {
			$count = sprintf( '<span class="count">%d</span>', WC()->cart->cart_contents_count );
		} else {
			$count = '';
		}
		$cart_icon                    = sprintf( '<a class="cart-contents nav-link" href="%1$s" title="%3$s"><i class="uil-cart"></i>%2$s</a>', esc_url( wc_get_cart_url() ), $count, esc_attr__( 'View Cart', 'beehive' ) );
		$fragments['a.cart-contents'] = $cart_icon;

		// Return fragments.
		return $fragments;
	}
endif;

if ( ! function_exists( 'beehive_wc_template_loop_product_thumbnail' ) ) :
	/**
	 * Product product thumbnail
	 *
	 * @since 1.0.0
	 */
	function beehive_wc_template_loop_product_thumbnail() { ?>
		<div class="img-top">
			<div class="product-img">
				<?php echo woocommerce_get_product_thumbnail(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<div class="hover-only">
				<a href="<?php the_permalink(); ?>" class="hover-overlay"></a>
				<ul class="product-actions">
					<li><?php woocommerce_template_loop_add_to_cart(); ?></li>
					<li><a href="<?php the_permalink(); ?>" class="view_cart_button" aria-label="<?php esc_attr_e( 'View Product', 'beehive' ); ?>"><?php esc_attr_e( 'View Product', 'beehive' ); ?></a></li>
				</ul>
			</div>
		</div>
		<?php
	}
endif;
