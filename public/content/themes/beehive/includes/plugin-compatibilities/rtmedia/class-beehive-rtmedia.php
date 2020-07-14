<?php
/**
 * Beehive RT Media
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
	exit( 'Direct script access denied.' ); }

/**
 * Beehive_Rtmedia class.
 *
 * @since 1.0.0
 */
class Beehive_Rtmedia {

	/**
	 * Rtmedia sidebars
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

		// Rt media sidebar.
		$this->sidebars = array( 'Media Sidebar' );

		// Rtmedia init.
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

		// Add sidbars.
		$this->add_sidbars();
		// Set sidebars.
		add_action( 'wp_head', array( $this, 'set_sidebar' ), 5 );
		// Set layout.
		add_action( 'wp_head', array( $this, 'layout' ), 5 );
		// Remove stylesheets.
		add_action( 'wp_enqueue_scripts', array( $this, 'remove_styles' ), 1000 );
		add_filter( 'rtmedia_custom_image_style', '__return_false' );
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
	 * Set generic sidebar for media pages
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function set_sidebar() {
		if ( TH_Helpers::is_media() ) {
			beehive()->sidebars->set( 'Media Sidebar' );
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

		// Return early if not a media page.
		if ( ! TH_Helpers::is_media() ) {
			return;
		}
		beehive()->layout->set( 'social' );
	}

	/**
	 * Remove styles from plugin dir
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function remove_styles() {
		wp_deregister_style( 'rtmedia-main' );
		wp_deregister_style( 'bp-nouveau-stylesheet-theme' );
		wp_deregister_style( 'bp-nouveau-stylesheet-buddypress' );
	}

	/**
	 * Add Styles
	 *
	 * @access public
	 * @param array  $styles stylesheets array.
	 * @param string $min    minified css.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_styles( $styles, $min ) {

		// Swiper slider css.
		if ( bp_is_activity_directory() || bp_is_user_activity() || bp_is_group_activity() ) {
			$styles['swiper']['enqueue'] = true;
		}

		// rtmedia main stylesheet.
		$styles['beehive-media'] = array(
			'src'     => BEEHIVE_URI . '/rtmedia/assets/css/rtmedia' . $min . '.css',
			'deps'    => array(),
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
	 * @param array  $scripts scripts array.
	 * @param string $min     minified script.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_scripts( $scripts, $min ) {

		// beehive rtm scripts.
		if ( ( bp_is_activity_directory() || bp_is_user_activity() || bp_is_group_activity() ) || TH_Helpers::has_shortcodes( array( 'rtmedia_gallery' ) ) ) {

			// Add rtm activity js.
			$scripts['beehive-rtm'] = array(
				'src'       => BEEHIVE_URI . '/rtmedia/assets/js/beehive-rtmedia' . $min . '.js',
				'deps'      => array( 'jquery', 'swiper' ),
				'in_footer' => true,
				'enqueue'   => true,
			);
		}

		// Return scripts.
		return $scripts;
	}
}

// Single instance of this class.
Beehive_Rtmedia::instance();
