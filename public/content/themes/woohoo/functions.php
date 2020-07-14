<?php

update_option( 'woohoo_ep_license_status', 'valid' );
update_option( 'woohoo_ep_license_key', 'license' );

/**! Do not allow directly accessing this file.
 * ------------------------------------------------ */
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

/*
 * Works with PHP 5.3 or Later
 */
if ( version_compare( phpversion(), '5.3', '<' ) ) {
	require get_template_directory() . '/framework/functions/php-disable.php';
	return;
}

$theme_data = get_file_data( get_template_directory() . '/style.css', [ 'Version' ], 'harmuny' );

define( 'WOOHOO_THEME_NAME', 'Woohoo'   );
define( 'WOOHOO_THEME_FOLDER', 'woohoo' );
define( 'WOOHOO_THEME_VER', '2.4.5' );
define( 'WOOHOO_TEMPLATE_PATH',         get_template_directory() );
define( 'WOOHOO_TEMPLATE_URL',          get_template_directory_uri() );
define( 'WOOHOO_WOOCOMMERCE_IS_ACTIVE', class_exists( 'WooCommerce' ) );
define( 'WOOHOO_BWPMINIFY_IS_ACTIVE',   class_exists( 'BWP_MINIFY'  ) );

require_once ( get_template_directory() . '/framework/admin/framework-options.php'          );
require_once ( get_template_directory() . '/framework/functions/functions-theme.php'        );
require_once ( get_template_directory() . '/framework/admin/framework-default-texts.php'    );
require_once ( get_template_directory() . '/framework/functions/functions-user-rate.php'    );
require_once ( get_template_directory() . '/foxpush/foxpush.php'                            );
require_once ( get_template_directory() . '/framework/class/css-footer.php'                 );
require_once ( get_template_directory() . '/framework/admin/updater/elitepack-config.php'   );

add_action( 'after_setup_theme', 'woohoo_after_setup_theme' );
function woohoo_after_setup_theme() {

	load_theme_textdomain( 'woohoo', get_template_directory().'/languages' );

	// Gutenberg
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );


	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );


	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'woocommerce' );

	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	add_theme_support( 'post-formats', array( 'video', 'audio', 'gallery' ) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'woohoo-small', 104, 74, array( 'center', 'top')      );
	add_image_size( 'woohoo-large', 850, 491, array( 'center', 'top')     );
	add_image_size( 'woohoo-full', 1240, 540, array( 'center', 'top')     );
	add_image_size( 'woohoo-widget', 320, 220, array( 'center', 'top' )   );
	add_image_size( 'bdaia-carousel', 309, 330, array( 'center', 'top' ) );
	add_image_size( 'bdaia-gallery-grid', 850, 9999999 );
	add_image_size( 'bdaia-gr1', 742, 490, array( 'center', 'top' )     );
	add_image_size( 'bdaia-gr2', 496, 244, array( 'center', 'top' )     );
	add_image_size( 'bdaia-gr3', 618, 260, array( 'center', 'top' )     );
	add_image_size( 'bdaia-gr4', 413.328, 244, array( 'center', 'top' ) );
	add_image_size( 'bdaia-small', 104, 74, array( 'center', 'top')      );
	add_image_size( 'bdaia-large', 850, 491, array( 'center', 'top')     );
	add_image_size( 'bdaia-full', 1240, 540, array( 'center', 'top')     );
	add_image_size( 'bdaia-widget', 320, 220, array( 'center', 'top' )   );
	add_image_size( 'bdaia-block11', 384, 220, array( 'center', 'top' )  );

	register_nav_menus(
		array(
			'primary'       => woohoo__tr( 'Navigation Menu'  ),
			'topmenu'       => woohoo__tr( 'Top Menu'         ),
			'footer_menu'   => woohoo__tr( 'Footer Menu'      )
		)
	);
}


/*-----------------------------------------------------------------------------------*/
// Gutenberg
/*-----------------------------------------------------------------------------------*/
function woohoo_is_edit_gutenberg() {
	if ( version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' ) ) {
		$current_screen = get_current_screen();

		if ( $current_screen->is_block_editor() ) {
			return true;
		}
	}
	return false;
}