<?php
/**
 * =================================================
 * Hook ekommart_page
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_single_post_top
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_single_post
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_single_post_bottom
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_loop_post
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_footer
 * =================================================
 */
add_action('ekommart_footer', 'ekommart_handheld_footer_bar', 25);

/**
 * =================================================
 * Hook ekommart_after_footer
 * =================================================
 */
add_action('ekommart_after_footer', 'ekommart_sticky_single_add_to_cart', 999);

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'ekommart_render_woocommerce_shop_canvas', 1);

/**
 * =================================================
 * Hook ekommart_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_content_top
 * =================================================
 */
add_action('ekommart_content_top', 'ekommart_shop_messages', 10);

/**
 * =================================================
 * Hook ekommart_post_header_before
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_sidebar
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_loop_after
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_page_after
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_woocommerce_before_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_woocommerce_before_shop_loop_item_title
 * =================================================
 */
add_action('ekommart_woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('ekommart_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('ekommart_woocommerce_before_shop_loop_item_title', 'ekommart_woocommerce_product_loop_action', 20);

/**
 * =================================================
 * Hook ekommart_woocommerce_shop_loop_item_title
 * =================================================
 */
add_action('ekommart_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

/**
 * =================================================
 * Hook ekommart_woocommerce_after_shop_loop_item_title
 * =================================================
 */
add_action('ekommart_woocommerce_after_shop_loop_item_title', 'ekommart_woocommerce_get_product_category', 10);
add_action('ekommart_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 15);
add_action('ekommart_woocommerce_after_shop_loop_item_title', 'ekommart_woocommerce_get_product_description', 20);
add_action('ekommart_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 25);

/**
 * =================================================
 * Hook ekommart_woocommerce_after_shop_loop_item
 * =================================================
 */
