<?php if ( ! defined('BESA_THEME_DIR')) exit('No direct script access allowed');
/**
 * Besa woocommerce Template Hooks
 *
 * Action/filter hooks used for Besa woocommerce functions/templates.
 *
 */


/**
 * Besa Header Mobile Content.
 *
 * @see besa_the_button_mobile_menu()
 * @see besa_the_icon_home_page_mobile()
 * @see besa_the_logo_mobile()
 * @see besa_the_icon_mini_cart_header_mobile()
 * @see besa_top_header_mobile()
 */
add_action( 'besa_header_mobile_content', 'besa_the_button_mobile_menu', 5 );
add_action( 'besa_header_mobile_content', 'besa_the_icon_home_page_mobile', 10 );
add_action( 'besa_header_mobile_content', 'besa_the_logo_mobile', 15 );
add_action( 'besa_header_mobile_content', 'besa_the_icon_mini_cart_header_mobile', 20 );
add_action( 'besa_header_mobile_content', 'besa_top_header_mobile', 25 );


/**
 * Besa Header Mobile before content
 *
 * @see besa_the_hook_header_mobile_all_page
 */
add_action( 'besa_before_header_mobile', 'besa_the_hook_header_mobile_all_page', 5 );
add_action( 'besa_before_header_mobile', 'besa_the_hook_header_mobile_menu_all_page', 10 );

/**
 * Besa Footer Mobile Content.
 *
 * @see besa_the_icon_home_footer_mobile()
 * @see besa_the_icon_wishlist_footer_mobile()
 * @see besa_the_icon_mini_cart_footer_mobile()
 * @see besa_the_icon_recent_footer_mobile()
 * @see besa_the_icon_account_footer_mobile()
 */
add_action( 'besa_footer_mobile_content', 'besa_the_icon_home_footer_mobile', 5 );
add_action( 'besa_footer_mobile_content', 'besa_the_icon_wishlist_footer_mobile', 10 );
add_action( 'besa_footer_mobile_content', 'besa_the_icon_mini_cart_footer_mobile', 15 );
add_action( 'besa_footer_mobile_content', 'besa_the_icon_recent_footer_mobile', 20 );
add_action( 'besa_footer_mobile_content', 'besa_the_icon_account_footer_mobile', 25 );
