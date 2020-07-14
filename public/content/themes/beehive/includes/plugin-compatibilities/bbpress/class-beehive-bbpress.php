<?php
/**
 * Beehive bbPress Forums
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
 * Beehive_Forums class.
 *
 * @since 1.0.0
 */
class Beehive_Forums {

	/**
	 * Forums sidebars
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

		// Forums sidebar.
		$this->sidebars = array( 'Forums Sidebar' );
		// Forums init.
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

		// Add sidebars.
		$this->add_sidbars();
		// Set sidebars.
		add_action( 'wp_head', array( $this, 'set_sidebar' ), 5 );
		// Set forum layout.
		add_action( 'wp_head', array( $this, 'layout' ), 5 );
		// After theme setup.
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		// Insert jobs Menu.
		add_action( 'beehive_before_main_content', array( $this, 'get_forums_menu' ) );
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
	 * Set generic sidebar for job pages
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function set_sidebar() {
		if ( TH_Helpers::is_bbpress() ) {
			beehive()->sidebars->set( 'Forums Sidebar' );
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

		// Return early if not a forum page.
		if ( ! TH_Helpers::is_bbpress() ) {
			return;
		}

		// Set the layout style.
		if ( bbp_is_user_home() ) {
			beehive()->layout->set( 'social-12' );
		} else {
			beehive()->layout->set( 'social' );
		}
	}

	/**
	 * After theme set up opts
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function after_setup_theme() {

		// Register Forums Menu.
		register_nav_menus(
			array(
				'forums_menu' => esc_html__( 'Forums Menu', 'beehive' ),
			)
		);

	}

	/**
	 * Get the forums menu
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function get_forums_menu() {
		if ( bbp_is_forum_archive() || bbp_is_topic_archive() ) {
			get_template_part( 'template-parts/bbpress/forums-menu' );
		}
	}

	/**
	 * Add scripts
	 *
	 * @access public
	 * @param array  $scripts bbpress scripts.
	 * @param string $min     minified script.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_scripts( $scripts, $min ) {

		// BBP script.
		if ( TH_Helpers::is_bbpress() ) {
			$scripts['beehive-bbp'] = array(
				'src'       => BEEHIVE_URI . '/bbpress/js/beehive-bbp' . $min . '.js',
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
Beehive_Forums::instance();
