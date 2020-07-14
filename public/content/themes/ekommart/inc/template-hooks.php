<?php
/**
 * =================================================
 * Hook ekommart_page
 * =================================================
 */
add_action('ekommart_page', 'ekommart_page_header', 10);
add_action('ekommart_page', 'ekommart_page_content', 20);

/**
 * =================================================
 * Hook ekommart_single_post_top
 * =================================================
 */
add_action('ekommart_single_post_top', 'ekommart_post_thumbnail', 10);

/**
 * =================================================
 * Hook ekommart_single_post
 * =================================================
 */
add_action('ekommart_single_post', 'ekommart_post_header', 10);
add_action('ekommart_single_post', 'ekommart_post_content', 30);

/**
 * =================================================
 * Hook ekommart_single_post_bottom
 * =================================================
 */
add_action('ekommart_single_post_bottom', 'ekommart_post_taxonomy', 5);
add_action('ekommart_single_post_bottom', 'ekommart_post_nav', 10);
add_action('ekommart_single_post_bottom', 'ekommart_display_comments', 20);

/**
 * =================================================
 * Hook ekommart_loop_post
 * =================================================
 */
add_action('ekommart_loop_post', 'ekommart_post_thumbnail', 10);
add_action('ekommart_loop_post', 'ekommart_post_header', 15);
add_action('ekommart_loop_post', 'ekommart_post_content', 30);

/**
 * =================================================
 * Hook ekommart_footer
 * =================================================
 */
add_action('ekommart_footer', 'ekommart_footer_default', 20);

/**
 * =================================================
 * Hook ekommart_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'ekommart_template_account_dropdown', 1);
add_action('wp_footer', 'ekommart_mobile_nav', 1);

/**
 * =================================================
 * Hook ekommart_before_header
 * =================================================
 */
add_action('ekommart_before_header', 'ekommart_deal_topbar', 5);
add_action('ekommart_before_header', 'ekommart_header_sticky', 10);

/**
 * =================================================
 * Hook ekommart_before_content
 * =================================================
 */
add_action('ekommart_before_content', 'ekommart_breadcrumb', 10);

/**
 * =================================================
 * Hook ekommart_content_top
 * =================================================
 */

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
add_action('ekommart_sidebar', 'ekommart_get_sidebar', 10);

/**
 * =================================================
 * Hook ekommart_loop_after
 * =================================================
 */
add_action('ekommart_loop_after', 'ekommart_paging_nav', 10);

/**
 * =================================================
 * Hook ekommart_page_after
 * =================================================
 */
add_action('ekommart_page_after', 'ekommart_display_comments', 10);

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

/**
 * =================================================
 * Hook ekommart_woocommerce_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_woocommerce_after_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook ekommart_woocommerce_after_shop_loop_item
 * =================================================
 */
