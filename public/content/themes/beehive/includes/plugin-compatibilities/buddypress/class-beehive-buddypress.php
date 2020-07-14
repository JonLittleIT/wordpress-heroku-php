<?php
/**
 * Beehive buddypress
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
 * Beehive_Job_Manager class.
 *
 * @since 1.0.0
 */
class Beehive_Buddypress {

	/**
	 * Buddypress sidebars
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

		// Buddypress sidebars.
		$this->sidebars = array( 'Buddypress Sidebar', 'Member Profile Sidebar', 'Group Profile Sidebar' );
		// Buddypress init.
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

		// Add bp sidebars.
		$this->add_sidbars();
		// Set sidebar.
		add_action( 'wp_head', array( $this, 'set_sidebar' ), 5 );
		// Set buddypress layout.
		add_action( 'wp_head', array( $this, 'layout' ), 5 );
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
	 * Set sidebars for bp pages
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function set_sidebar() {
		if ( TH_Helpers::is_buddypress() ) {
			beehive()->sidebars->set( 'Buddypress Sidebar' );
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

		// Return early if not a buddypress page.
		if ( ! TH_Helpers::is_buddypress() ) {
			return;
		}

		// Set the layout style.
		if ( ( bp_is_user() && ! bp_is_single_activity() ) || ( bp_is_group() && ! bp_is_group_create() ) || bp_is_register_page() || bp_is_activation_page() ) {
			beehive()->layout->set( 'social-collapsed' );
		} else {
			beehive()->layout->set( 'social' );
		}
	}

	/**
	 * Add scripts
	 *
	 * @access public
	 * @param array  $scripts scripts.
	 * @param string $min     minified version of the scripts.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_scripts( $scripts, $min ) {

		// Select 2 lib.
		if ( bp_is_register_page() || bp_is_user_profile_edit() ) {
			$scripts['select-2']['enqueue'] = true;
		}

		// Activity like.
		if ( beehive()->options->get( 'key=activity-like' ) && bp_is_active( 'activity' ) && ( bp_is_activity_directory() || bp_is_user_activity() || bp_is_group_activity() ) ) {
			$scripts['beehive-bp-like'] = array(
				'src'       => BEEHIVE_URI . '/buddypress/js/beehive-bp-like' . $min . '.js',
				'deps'      => array( 'jquery' ),
				'in_footer' => true,
				'enqueue'   => true,
			);
		}

		// BP script.
		$scripts['beehive-bp'] = array(
			'src'       => BEEHIVE_URI . '/buddypress/js/beehive-bp' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => true,
		);

		// Return scripts.
		return $scripts;

	}

}

// Single instance of this class.
Beehive_Buddypress::instance();

