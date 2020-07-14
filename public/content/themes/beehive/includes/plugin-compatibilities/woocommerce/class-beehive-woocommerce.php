<?php
/**
 * Beehive Woocommerce
 *
 * @author     thunder-team
 * @copyright  (c) Copyright by Thunder Team
 * @link       https://themeforest.net/user/thunder-team/
 * @package    WordPress
 * @subpackage beehive
 * @since      1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Beehive_Woocommerce class.
 *
 * @since 1.0.0
 */
class Beehive_Woocommerce {

	/**
	 * Shop sidebars
	 *
	 * @access public
	 * @var void
	 * @since 1.0.0
	 */
	public $sidebars = array();

	/**
	 * Instance
	 * The single instance of this class
	 *
	 * @access private
	 * @static
	 * @var object
	 * @since 1.0.0
	 */
	private static $_instance = null;

	/**
	 * Instance
	 * Ensures only one instance of the class is loaded or can be loaded
	 *
	 * @access public
	 * @static
	 * @return an instance of this class
	 * @since 1.0.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * The class constructor
	 *
	 * @access public
	 */
	public function __construct() {

		// Shop sidebars.
		$this->sidebars = array( 'Shop Sidebar', 'Shop Filters' );
		// Shop init.
		$this->init();

	}

	/**
	 * Init method
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function init() {

		// Add shop sidebars.
		$this->add_sidbars();
		// Set sidebar.
		add_action( 'wp_head', array( $this, 'set_sidebar' ), 5 );
		// Set shop layout.
		add_action( 'wp_head', array( $this, 'layout' ), 5 );
		// After theme setup.
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		// Insert shop Menu.
		add_action( 'beehive_before_main_content', array( $this, 'get_shop_menu' ) );
		// Remove stylesheets.
		add_filter( 'woocommerce_enqueue_styles', array( $this, 'remove_styles' ) );
		// Add stylesheets.
		add_filter( 'beehive_stylesheets', array( $this, 'add_styles' ), 10, 2 );

	}

	/**
	 * Add Sidebars
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function add_sidbars() {
		beehive()->sidebars->add( $this->sidebars );
	}

	/**
	 * Set generic sidebar for shop archive page
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function set_sidebar() {
		if ( TH_Helpers::is_woocommerce() ) {
			beehive()->sidebars->set( 'Shop Sidebar' );
		}
	}

	/**
	 * Set layout style
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function layout() {

		// Return early if not a shop page.
		if ( ! TH_Helpers::is_woocommerce() ) {
			return;
		}

		// Set the layout style.
		if ( is_singular( 'product' ) ) {
			beehive()->layout->set( 'social-12' );
		} elseif ( is_account_page() ) {
			beehive()->layout->set( 'social-collapsed' );
		} else {
			beehive()->layout->set( 'social' );
		}
	}

	/**
	 * After theme setup
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function after_setup_theme() {

		// Add woocommerce theme support.
		add_theme_support( 'woocommerce' );

		// Add woocommerce gallery theme support.
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Register shop menu.
		register_nav_menus(
			array(
				'shop_menu' => esc_html__( 'Shop Menu', 'beehive' ),
			)
		);

	}

	/**
	 * Get the shop menu
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function get_shop_menu() {
		if ( is_shop() || is_product_category() || TH_Helpers::has_shortcodes( array( 'product_categories', 'woocommerce_order_tracking' ) ) ) {
			get_template_part( 'template-parts/woocommerce/shop-menu' );
		}
	}

	/**
	 * Remove styles from plugin dir
	 *
	 * @access public
	 * @param array $enqueue_styles woocommerce stylesheets.
	 * @return array
	 * @since 1.0.0
	 */
	public function remove_styles( $enqueue_styles ) {

		// Remove the general.
		unset( $enqueue_styles['woocommerce-general'] );
		// Remove the layout.
		unset( $enqueue_styles['woocommerce-layout'] );
		// Remove the smallscreen optimisation.
		unset( $enqueue_styles['woocommerce-smallscreen'] );

		// Return stylesheets.
		return $enqueue_styles;
	}

	/**
	 * Add Styles
	 *
	 * @access public
	 * @param array  $styles beehive woocommerce stylesheets.
	 * @param string $min    minified version of css.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_styles( $styles, $min ) {

		// Woocommerce main stylesheet.
		$styles['beehive-woocommerce'] = array(
			'src'     => BEEHIVE_URI . '/woocommerce/assets/css/woocommerce' . $min . '.css',
			'deps'    => array(),
			'version' => beehive()->version(),
			'media'   => 'all',
			'enqueue' => true,
		);

		// Woocommerce layout stylesheet.
		$styles['beehive-woocommerce-layout'] = array(
			'src'     => BEEHIVE_URI . '/woocommerce/assets/css/woocommerce-layout' . $min . '.css',
			'deps'    => array(),
			'version' => beehive()->version(),
			'media'   => 'all',
			'enqueue' => true,
		);

		// Return stylesheets.
		return $styles;
	}

}

// Single instance of this class.
Beehive_Woocommerce::instance();
