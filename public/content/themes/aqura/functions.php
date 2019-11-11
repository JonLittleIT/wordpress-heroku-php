<?php

/**

 * Aqura functions and definitions

 *

 * @link https://developer.wordpress.org/themes/basics/theme-functions/

 *

 * @package Aqura

 */



// File Security Check

if ( ! defined( 'ABSPATH' ) ) { exit; }



if ( !defined( 'AQURA_THEMEROOT' ) ) {

	define('AQURA_THEMEROOT', get_template_directory_uri());

}



if ( !defined( 'AQURA_THEMEDIR' ) ) {

	define('AQURA_THEMEDIR', get_template_directory());

}



if ( !defined( 'AQURA_IMAGES' ) ) {

	define('AQURA_IMAGES', AQURA_THEMEROOT . '/assets/img');

}



if ( ! function_exists( 'aqura_setup' ) ) :

	/**

	 * Sets up theme defaults and registers support for various WordPress features.

	 *

	 * Note that this function is hooked into the after_setup_theme hook, which

	 * runs before the init hook. The init hook is too late for some features, such

	 * as indicating support for post thumbnails.

	 */

	function aqura_setup() {

		/*

		 * Make theme available for translation.

		 * Translations can be filed in the /languages/ directory.

		 * If you're building a theme based on Aqura, use a find and replace

		 * to change 'aqura' to the name of your theme in all the template files.

		 */

		load_theme_textdomain( 'aqura', get_template_directory() . '/languages' );



		// Add default posts and comments RSS feed links to head.

		add_theme_support( 'automatic-feed-links' );



		/*

		 * Let WordPress manage the document title.

		 * By adding theme support, we declare that this theme does not use a

		 * hard-coded <title> tag in the document head, and expect WordPress to

		 * provide it for us.

		 */

		add_theme_support( 'title-tag' );



		/*

		 * Enable support for Post Thumbnails on posts and pages.

		 *

		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/

		 */

		add_theme_support( 'post-thumbnails' );



		// This theme uses wp_nav_menu() in one location.

		register_nav_menus( array(

			'primary' 				=> esc_html__( 'Primary', 'aqura' ),

			'top-primary-style-3' 	=> esc_html__( 'Top Primary Opened Menu', 'aqura' ),

			'inline-primary-1' 		=> esc_html__( 'Inline Style Primary 1', 'aqura' ),

			'inline-primary-2' 		=> esc_html__( 'Inline Style Primary 2', 'aqura' ),

		) );



		/*

		 * Switch default core markup for search form, comment form, and comments

		 * to output valid HTML5.

		 */

		add_theme_support( 'html5', array(

			'search-form',

			'comment-form',

			'comment-list',

			'gallery',

			'caption',

		) );



		// Add theme support for selective refresh for widgets.

		add_theme_support( 'customize-selective-refresh-widgets' );



		// Removing default customizer settings.

		add_action( "customize_register", "aqura_remove_customizer_settings" );

		function aqura_remove_customizer_settings( $wp_customize ) {



			$wp_customize->remove_control("header_image");

			$wp_customize->remove_control("site_icon");

			$wp_customize->remove_section("colors");

			$wp_customize->remove_section("background_image");



		}



		// Define $content_width.

		if ( ! isset( $content_width ) ) $content_width = 900;



	}

endif;

add_action( 'after_setup_theme', 'aqura_setup' );



/**

 * Register widget area.

 *

 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar

 */

function aqura_widgets_init() {

	register_sidebar( array(

		'name'          => esc_html__( 'Blog Sidebar', 'aqura' ),

		'id'            => 'sidebar-1',

		'description'   => esc_html__( 'Add widgets here.', 'aqura' ),

		'before_widget' => '<section id="%1$s" class="widget %2$s">',

		'after_widget'  => '</section>',

		'before_title'  => '<h2 class="widget-title">',

		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Shop Sidebar', 'aqura' ),

		'id'            => 'shop-sidebar',

	) );

}

add_action( 'widgets_init', 'aqura_widgets_init' );



/**

 * Enqueue scripts and styles.

 */

function aqura_scripts() {



	global $aqura_data;



	$aqura_data = $aqura_data ? $aqura_data : array();



	$aqura_api__google_maps 	= array_key_exists('aqura_theme__api__google_maps', $aqura_data) ? $aqura_data['aqura_theme__api__google_maps'] : '';

	$aqura_api__instagram 		= array_key_exists('aqura_theme__api__instagram', $aqura_data) ? $aqura_data['aqura_theme__api__instagram'] : '';

	$aqura_api__instagram_user 	= array_key_exists('aqura_theme__api__instagram_user', $aqura_data) ? $aqura_data['aqura_theme__api__instagram_user'] : '';

	$aqura_theme__music_player 	= array_key_exists('aqura_theme__music_player__on_off', $aqura_data) ? $aqura_data['aqura_theme__music_player__on_off'] : '';



	wp_enqueue_style( 'aqura-glitch-hover', get_template_directory_uri() . '/assets/css/glitchhover.css' );

	wp_enqueue_style( 'aqura-glitch', get_template_directory_uri() . '/assets/css/glitch.css' );

	wp_enqueue_style( 'aqura-master', get_template_directory_uri() . '/assets/css/master.css' );

	wp_enqueue_style( 'aqura-temporary-master', get_template_directory_uri() . '/css/master.css' );

	wp_enqueue_style( 'aqura-temporary-woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );

	wp_enqueue_style( 'aqura-style', get_stylesheet_uri() );





	wp_enqueue_script('aqura-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0', true);

	wp_enqueue_script('aqura-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array('jquery'), '1.0', true);

	if ( $aqura_theme__music_player ) {

		wp_enqueue_script('aqura-plugin-jplayer', get_template_directory_uri() . '/assets/jplayer/jplayer/jquery.jplayer.js', array('jquery'), '1.0', true);

		wp_enqueue_script('aqura-jplayer', get_template_directory_uri() . '/assets/js/jPlayer.js', array('jquery'), '1.0', true);

	}

	wp_enqueue_script('aqura-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);

	if ( $aqura_api__google_maps != '' ) {

		wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=' . $aqura_api__google_maps . '', array(), '1.0', true);

	}

	wp_localize_script( 'aqura-main', 'aqura_static_resources', array(

		'scripts' 							=> aqura_controller::get_instance()->get_queued_scripts(),

		'styles'  							=> aqura_controller::get_instance()->get_queued_styles(),

		'aqura_theme__api__google_maps'  	=> $aqura_api__google_maps,

		'aqura_theme__api__instagram'  		=> $aqura_api__instagram,

		'aqura_theme__api__instagram_user'  => $aqura_api__instagram_user,

	) );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}



	if ( class_exists( 'WooCommerce' ) ) {

		wp_dequeue_script( 'prettyPhoto' );

		wp_dequeue_script( 'prettyPhoto-init' );



		// localize the woo url slugs to get them out of DJAX

		$aqura_non_ajax_links = array();



		$permalinks        = get_option( 'woocommerce_permalinks' );

		$product_permalink = empty( $permalinks['product_base'] ) ? _x( 'product', 'slug', 'aqura' ) : $permalinks['product_base'];

		$aqura_non_ajax_links[] = '/'.untrailingslashit( $product_permalink ).'/';



		$checkout_page_url  = get_permalink( wc_get_page_id( 'checkout' ) );

		if ( ! empty( $checkout_page_url ) ) {

			$aqura_non_ajax_links[] = $checkout_page_url;

		}



		$cart_page_url = get_permalink( wc_get_page_id( 'cart' ) );

		if ( ! empty( $cart_page_url ) ) {

			$aqura_non_ajax_links[] = $cart_page_url;

		}



		$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

		if ( ! empty( $shop_page_url ) ) {

			$aqura_non_ajax_links[] = $shop_page_url;

		}



		$aqura_woo_slugs = array( 'aqura_woo_product_slug' => '/'.untrailingslashit( $product_permalink ).'/' );

		wp_localize_script( 'woocommerce', 'aqura_non_ajax_links', $aqura_non_ajax_links );

	}

	

}

add_action( 'wp_enqueue_scripts', 'aqura_scripts' , 999999 );



/**

 * Custom template tags for this theme.

 */

require get_template_directory() . '/inc/template-tags.php';



/**

 * Functions which enhance the theme by hooking into WordPress.

 */

require get_template_directory() . '/inc/template-functions.php';


if ( is_admin() ) {

	/**
	 * Including TGM.
	 */
	require get_template_directory() . '/admin/tgm/tgm-init.php';

	// Demo content files
	require_once( get_template_directory() . '/admin/demo-content/demo-content.php' );

}

/**

 * Including Redux Framework.

 */

if ( class_exists( 'ReduxFramework' ) ) {

	require get_template_directory() . '/admin/redux/options-init.php';

}



/**

 * Setup VisualComposer plugin for the theme

 */

function aqura_setup_visual_composer() {



	// Disable VC frontend editor

	if(function_exists('vc_disable_frontend')) {

		vc_disable_frontend();

	}



	if ( function_exists('vc_set_as_theme') ) {

		vc_set_as_theme(true);

	}

	add_filter('use_block_editor_for_post', '__return_false', 10);

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );
  
	// Enqueue editor styles.
	add_editor_style( 'assets/css/master.css' );

}

add_action('admin_head', 'editor_style_fix');

function editor_style_fix() {
  echo '<style>
	.editor-styles-wrapper button {
		overflow: hidden;
	}
	.wp-block {
		max-width: 750px;
	}
  </style>';
}



add_action( 'after_setup_theme', 'aqura_setup_visual_composer' );



if ( class_exists('RW_Meta_Box') ) {



	/**

	 * Define meta-box constants & require meta-box plugins.

	 *

	 * Meta-box plugin and its extentions are used for the custom content boxes from the posts, pages and other places

	 * in the admin dashboard.

	 */



	require_once( get_template_directory() . '/admin/meta-box/aqura-meta-box.php' );



}



/**

 * Load WooCommerce compatibility file.

 */

if ( class_exists( 'WooCommerce' ) ) {

	require get_template_directory() . '/inc/woocommerce.php';

}


if ( class_exists('AQURA_plugins_core') ) {
	do_action( 'plugins_loaded', AQURA_plugins_core::get_instance());
}