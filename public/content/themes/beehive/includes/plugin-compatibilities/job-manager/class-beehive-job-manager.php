<?php
/**
 * Beehive Job Manager
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
class Beehive_Job_Manager {

	/**
	 * Jobs sidebars
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

		// Jobs sidebar.
		$this->sidebars = array( 'Jobs Sidebar' );
		// Jobs init.
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
		// Set job layout.
		add_action( 'wp_head', array( $this, 'layout' ), 5 );
		// After theme setup.
		add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
		// Insert jobs Menu.
		add_action( 'beehive_before_main_content', array( $this, 'get_job_menu' ) );
		// Remove stylesheets.
		add_action( 'wp_enqueue_scripts', array( $this, 'remove_styles' ) );
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
	 * Set generic sidebar for job pages
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function set_sidebar() {
		if ( TH_Helpers::is_job_manager() ) {
			beehive()->sidebars->set( 'Jobs Sidebar' );
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

		// Return early if not a job page.
		if ( ! TH_Helpers::is_job_manager() ) {
			return;
		}

		// Set the layout style.
		if ( is_singular( 'job_listing' ) ) {
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

		// Add job manager theme support.
		add_theme_support( 'job-manager-templates' );

		// Register Jobs Menu.
		register_nav_menus(
			array(
				'jobs_menu' => esc_html__( 'Jobs Menu', 'beehive' ),
			)
		);

	}

	/**
	 * Get the job menu
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function get_job_menu() {
		if ( TH_Helpers::is_job_manager() && ! is_singular( array( 'job_listing' ) ) ) {
			get_template_part( 'template-parts/job_manager/jobs-menu' );
		}
	}

	/**
	 * Remove styles from plugin dir
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function remove_styles() {
		wp_deregister_style( 'wp-job-manager-frontend' );
	}

	/**
	 * Add Styles
	 *
	 * @access public
	 * @param array  $styles stylesheets.
	 * @param string $min    minified css.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_styles( $styles, $min ) {

		// job manager main stylesheet.
		$styles['beehive-job-manager'] = array(
			'src'     => BEEHIVE_URI . '/job_manager/assets/css/job-manager' . $min . '.css',
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
Beehive_Job_Manager::instance();
