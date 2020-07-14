<?php

// Remove default breadcrumb
add_filter( 'woocommerce_breadcrumb_defaults', 'besa_tbay_woocommerce_breadcrumb_defaults' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'besa_woo_template_main_before', 'woocommerce_breadcrumb', 20 ); 


remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

/**
 * Product Rating
 *
 * @see besa_woocommerce_loop_item_rating()
 */

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action( 'besa_woocommerce_loop_item_rating', 'woocommerce_template_loop_rating', 10 );

//Change postition label sale
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

// Remove Default Sidebars
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 ); 



/**
 * Product Add to cart.
 *
 * @see woocommerce_template_single_add_to_cart()
 * @see woocommerce_simple_add_to_cart()
 * @see woocommerce_grouped_add_to_cart()
 * @see woocommerce_variable_add_to_cart()
 * @see woocommerce_external_add_to_cart()
 * @see woocommerce_single_variation()
 * @see woocommerce_single_variation_add_to_cart_button()
 */
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
add_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
add_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
add_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
add_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );
add_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );



remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * Top left main content single product.
 *
 * @see woocommerce_template_single_title()
 * @see woocommerce_template_single_rating()
 * @see woocommerce_show_product_sale_flash()
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_left_main_single_product', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_before_left_main_single_product', 'woocommerce_template_single_rating', 10 );
add_action( 'besa_woocommerce_template_single_price_wrapper', 'woocommerce_template_single_price', 5 );


/**
 * Product Vertical
 *
 * @see woocommerce_after_shop_loop_item_vertical_title()
 */

add_action( 'woocommerce_after_shop_loop_item_vertical_title', 'woocommerce_template_loop_price', 10 );


/**
 * Product List
 *
 */

add_action( 'besa_woo_list_caption_left', 'woocommerce_template_loop_rating', 5 );
add_action( 'besa_woo_list_caption_right', 'woocommerce_template_loop_price', 5 );
add_action( 'besa_woo_list_caption_right', 'besa_tbay_total_stock', 10 );


