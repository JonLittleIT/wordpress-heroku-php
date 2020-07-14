<?php
/**
 * Ekommart WooCommerce hooks
 *
 * @package ekommart
 */

/**
 * Layout
 *
 * @see  ekommart_before_content()
 * @see  ekommart_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  ekommart_shop_messages()
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_before_main_content', 'ekommart_before_content', 10 );
add_action( 'woocommerce_after_main_content', 'ekommart_after_content', 10 );


add_action( 'woocommerce_before_shop_loop', 'ekommart_sorting_wrapper', 19 );
add_action( 'woocommerce_before_shop_loop', 'ekommart_button_shop_canvas', 19 );
add_action( 'woocommerce_before_shop_loop', 'ekommart_button_grid_list_layout', 25 );
add_action( 'woocommerce_before_shop_loop', 'ekommart_sorting_wrapper_close', 31 );

// Legacy WooCommerce columns filter.
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
	add_filter( 'loop_shop_columns', 'ekommart_loop_columns' );
	add_action( 'woocommerce_before_shop_loop', 'ekommart_product_columns_wrapper', 40 );
	add_action( 'woocommerce_after_shop_loop', 'ekommart_product_columns_wrapper_close', 40 );
}

/**
 * Products
 *
 * @see ekommart_upsell_display()
 * @see ekommart_single_product_pagination()
 */

//add_action( 'woocommerce_before_add_to_cart_quantity', 'ekommart_single_product_quantity_label', 10 );
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 21 );
add_action('yith_quick_view_custom_style_scripts',function (){
    wp_enqueue_script('flexslider');
});

add_action( 'woocommerce_single_product_summary', 'ekommart_single_product_pagination', 1 );
add_action('woocommerce_single_product_summary','ekommart_stock_label',2);
add_action('woocommerce_single_product_summary','ekommart_woocommerce_deal_progress_single',25);

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'ekommart_upsell_display', 15 );

add_action( 'woocommerce_share', 'ekommart_social_share', 10 );

$product_single_style = ekommart_get_theme_option('wocommerce_single_style', 1);
switch ($product_single_style) {
	case 1:
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
		break;
	case 2:

		add_theme_support( 'wc-product-gallery-lightbox' );
		add_filter('woocommerce_single_product_image_thumbnail_html', 'ekommart_woocommerce_single_product_image_thumbnail_html', 10, 2);
		break;
}

/**
 * Cart fragment
 *
 * @see ekommart_cart_link_fragment()
 */
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'ekommart_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'ekommart_cart_link_fragment' );
}

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_start', 5 );
add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_end', 15 );

/*
 *
 * Layout Product
 *
 * */
function ekommart_include_hooks_product_blocks() {

	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );


	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_before_shop_loop_item', 'ekommart_woocommerce_product_loop_start', - 1 );
	add_action( 'woocommerce_after_shop_loop_item', 'ekommart_woocommerce_product_loop_end', 999 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 4 );

	/**
	 * Integrations
	 *
	 * @see ekommart_template_loop_product_thumbnail()
	 *
	 */
	add_action( 'woocommerce_before_shop_loop_item_title', 'ekommart_woocommerce_product_loop_image', 10 );

	add_action( 'woocommerce_shop_loop_item_title', 'ekommart_woocommerce_get_product_category', 5 );

	add_action( 'ekommart_woocommerce_product_loop_image', 'ekommart_woocommerce_get_product_label_stock', 4 );
	add_action( 'ekommart_woocommerce_product_loop_image', 'woocommerce_show_product_loop_sale_flash', 5 );

	add_action( 'ekommart_woocommerce_product_loop_image', 'ekommart_template_loop_product_thumbnail', 10 );


	add_action( 'ekommart_woocommerce_product_loop_image', 'woocommerce_template_loop_product_link_open', 99 );
	add_action( 'ekommart_woocommerce_product_loop_image', 'woocommerce_template_loop_product_link_close', 99 );

	/**
	 * Integrations
	 *
	 * @see ekommart_woocommerce_product_loop_action()
	 *
	 */
	add_action( 'ekommart_woocommerce_product_loop_image', 'ekommart_woocommerce_product_loop_action', 20 );

	// Wishlist
	add_action( 'ekommart_woocommerce_product_loop_action', 'ekommart_woocommerce_product_loop_wishlist_button', 5 );

	// Compare
	add_action( 'ekommart_woocommerce_product_loop_action', 'ekommart_woocommerce_product_loop_compare_button', 10 );

	// QuickView
	if ( ekommart_is_woocommerce_extension_activated( 'YITH_WCQV' ) ) {
		remove_action( 'woocommerce_after_shop_loop_item', array(
			YITH_WCQV_Frontend::get_instance(),
			'yith_add_quick_view_button'
		), 15 );
		add_action( 'ekommart_woocommerce_product_loop_action', array(
			YITH_WCQV_Frontend::get_instance(),
			'yith_add_quick_view_button'
		), 15 );
	}

	$product_style = ekommart_get_theme_option( 'wocommerce_block_style', 1 );

	switch ( $product_style ) {
		case 1:
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 4 );
			break;
		case 3:
			remove_action( 'woocommerce_shop_loop_item_title', 'ekommart_woocommerce_get_product_category', 5 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 6 );
			break;
		case 5:
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 4 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			add_action( 'ekommart_woocommerce_product_loop_image', 'woocommerce_template_loop_add_to_cart', 15 );
			break;
	}
}

ekommart_include_hooks_product_blocks();

