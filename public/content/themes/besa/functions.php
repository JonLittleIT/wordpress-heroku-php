<?php
/**
 * besa functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are 
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Besa
 * @since Besa 1.0
 */


require get_theme_file_path('inc/function-global.php');

/*Start Class Main*/
require get_theme_file_path('inc/classes/class-main.php');

/*
 Include Required Plugins
*/
require get_theme_file_path('inc/function-plugins.php');


require_once( get_parent_theme_file_path( BESA_INC . '/classes/class-tgm-plugin-activation.php') );
require_once( get_parent_theme_file_path( BESA_INC . '/functions-helper.php') );
require_once( get_parent_theme_file_path( BESA_INC . '/functions-frontend.php') );
require_once( get_parent_theme_file_path( BESA_INC . '/functions-mobile.php') );

/**
 * Customizer
 *
 */
require_once( get_parent_theme_file_path( BESA_INC . '/customizer/custom-header.php') );
require_once( get_parent_theme_file_path( BESA_INC . '/customizer/customizer.php') ); 
require_once( get_parent_theme_file_path( BESA_INC . '/customizer/custom-styles.php') );
/**
 * Classess file
 *
 */

/**
 * Implement the Custom Styles feature.
 *
 */


require_once( get_parent_theme_file_path( BESA_CLASSES . '/megamenu.php') );
require_once( get_parent_theme_file_path( BESA_CLASSES . '/custommenu.php') );
require_once( get_parent_theme_file_path( BESA_CLASSES . '/mmenu.php') );

/**
 * Custom template tags for this theme.
 *
 */

require_once( get_parent_theme_file_path( BESA_INC . '/template-tags.php') );
require_once( get_parent_theme_file_path( BESA_INC . '/template-hooks.php') );



require_once( get_parent_theme_file_path( BESA_VENDORS . '/cmb2/page.php') );
require_once( get_parent_theme_file_path( BESA_VENDORS . '/cmb2/post.php') );

if ( class_exists( 'WooCommerce' ) ) {
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/wc-admin.php') );

	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/classes/class-wc.php') );
	
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/wc-template-functions.php') );
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/wc-template-hooks.php') );


	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/wc-recently-viewed.php') );
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/wc-ajax-auth.php') );

	/*compatible*/
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/compatible/wc_vendors.php') );
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/compatible/wc-dokan.php') );
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/compatible/wcfm_multivendor.php') );
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/compatible/wcmp_vendor.php') );
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/woocommerce/compatible/wc-germanized.php') );
}


if( defined('TBAY_ELEMENTOR_ACTIVED') ) {
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/custom_menu.php') );
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/list-categories.php') );
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/popular_posts.php') );

	if ( function_exists( 'mc4wp_show_form' ) ) {
		require_once( get_parent_theme_file_path( BESA_WIDGETS . '/popup_newsletter.php') );
	}
	
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/posts.php') );
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/recent_comment.php') );
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/recent_post.php') ); 
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/single_image.php') );
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/banner_image.php') );
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/socials.php') );
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/top_rate.php') );
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/video.php') );
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/woo-carousel.php') );
	require_once( get_parent_theme_file_path( BESA_WIDGETS . '/yith-brand-image.php') );

	/*Redux FrameWork*/
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/redux-framework/class-redux.php') );
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/redux-framework/redux-config.php') );
}

if( besa_is_elementor_activated() ) {
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/elementor/class-elementor.php') );
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/elementor/class-elementor-pro.php') );
	require_once( get_parent_theme_file_path( BESA_VENDORS . '/elementor/icons/icons.php') );
}