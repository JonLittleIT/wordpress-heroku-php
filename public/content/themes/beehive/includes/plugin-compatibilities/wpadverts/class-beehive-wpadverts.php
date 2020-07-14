<?php
/**
 * Beehive WpAdverts
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
 * Beehive_Adverts class.
 *
 * @since 1.0.0
 */
class Beehive_Adverts {

	/**
	 * Adverts sidebars
	 *
	 * @access public
	 * @var array
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

		// Advert sidebar.
		$this->sidebars = array( 'Classified Sidebar' );
		// Advert init.
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

		// Add adverts sidebars.
		$this->add_sidbars();
		// Set adverts sidebars.
		add_action( 'wp_head', array( $this, 'set_sidebar' ), 5 );
		// Set adverts layout.
		add_action( 'wp_head', array( $this, 'layout' ), 5 );
		// After theme setup.
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		// Insert classified menu.
		add_action( 'beehive_before_main_content', array( $this, 'get_classified_menu' ) );
		// Remove stylesheets.
		add_action( 'wp_enqueue_scripts', array( $this, 'remove_styles' ) );
		// Add stylesheets.
		add_filter( 'beehive_stylesheets', array( $this, 'add_styles' ), 10, 2 );
		// Add scripts.
		add_filter( 'beehive_scripts', array( $this, 'add_scripts' ), 10, 2 );

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
	 * Set generic sidebar for classified pages
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function set_sidebar() {
		if ( TH_Helpers::is_advert() ) {
			beehive()->sidebars->set( 'Classified Sidebar' );
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

		// Return early if not an advert page.
		if ( ! TH_Helpers::is_advert() ) {
			return;
		}

		// Set the layout style.
		if ( is_singular( 'advert' ) ) {
			beehive()->layout->set( 'social-12' );
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

		// Register shop menu.
		register_nav_menus(
			array(
				'classified_menu' => esc_html__( 'Classified Menu', 'beehive' ),
			)
		);
	}

	/**
	 * Get the classified menu
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function get_classified_menu() {
		if ( TH_Helpers::has_shortcodes( array( 'adverts_list', 'adverts_categories', 'adverts_add' ) ) || is_tax( 'advert_category' ) ) {
			get_template_part( 'template-parts/wpadverts/classified-menu' );
		}
	}

	/**
	 * Remove stylesheets
	 * from plugin dir
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function remove_styles() {
		wp_deregister_style( 'adverts-frontend' );
	}

	/**
	 * Add stylesheets
	 * from theme dir
	 *
	 * @access public
	 * @param array $styles advert stylesheets.
	 * @param int   $min    minified version of the stylesheet.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_styles( $styles, $min ) {

		// Advert stylesheet.
		$styles['beehive-adverts'] = array(
			'src'     => BEEHIVE_URI . '/wpadverts/assets/css/adverts-frontend' . $min . '.css',
			'deps'    => array(),
			'version' => beehive()->version(),
			'media'   => 'all',
			'enqueue' => true,
		);

		// Return stylesheets.
		return $styles;
	}

	/**
	 * Add scripts
	 *
	 * @access public
	 * @param array  $scripts adverts scripts.
	 * @param string $min     minified script.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_scripts( $scripts, $min ) {

		// Advert script.
		if ( TH_Helpers::has_shortcodes( array( 'adverts_list' ) ) ) {
			$scripts['beehive-adverts'] = array(
				'src'       => BEEHIVE_URI . '/wpadverts/assets/js/beehive-adverts' . $min . '.js',
				'deps'      => array(),
				'in_footer' => true,
				'enqueue'   => true,
			);
		}

		// Return scripts.
		return $scripts;

	}
}

// Single instance of this class.
Beehive_Adverts::instance();
