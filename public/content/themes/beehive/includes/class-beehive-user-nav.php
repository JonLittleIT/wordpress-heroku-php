<?php
/**
 * Beehive bp notification navbar class
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
 * Beehive_Notification_Navbar class.
 *
 * @since 1.0.0
 */
class Beehive_Notification_Navbar {

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
	 * Class Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Initialization.
		$this->init();

	}

	/**
	 * Class init
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function init() {

		// Return if user nav is not set.
		if ( ! beehive()->options->get( 'key=user-nav' ) ) {
			return;
		}

		// After theme setup.
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		// Insert social navbar.
		add_action( 'beehive_after_social_navbar', array( $this, 'get_navbar_template' ) );
		// Insert notification navbar to navbar-main.
		add_action( 'beehive_after_default_navbar', array( $this, 'get_navbar_template' ) );
		// Insert login modal to body.
		add_action( 'beehive_after_page_ends', array( $this, 'get_login_modal_template' ), 20 );
		// Add header classes.
		add_filter( 'beehive_header_classes', array( $this, 'header_classes' ) );

	}

	/**
	 * After theme set up opts
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function after_setup_theme() {
		register_nav_menus(
			array(
				'myaccount_menu' => esc_html__( 'My Account', 'beehive' ),
			)
		);
	}

	/**
	 * Get navbar template
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function get_navbar_template() {
		get_template_part( 'template-parts/notification', 'nav' );
	}

	/**
	 * Get the login modal
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function get_login_modal_template() {
		if ( ! is_user_logged_in() ) {
			get_template_part( 'template-parts/login', 'modal' );
		}
	}

	/**
	 * Add classes to header
	 *
	 * @param array $classes classes list.
	 * @access  public
	 * @return array
	 * @since 1.0.0
	 */
	public function header_classes( $classes ) {
		$classes[] = 'user-nav-active';
		return $classes;
	}

}

// Single instance of this class.
Beehive_Notification_Navbar::instance();
