<?php
/**
 * Class that manages beehive admin pages
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
 * Class for Beehive_Admin
 *
 * @since 1.0.0
 */
class Beehive_Admin {

	/**
	 * Version
	 * beehive theme version
	 *
	 * @access private
	 * @static
	 * @var object
	 * @since 1.0.0
	 */
	private $theme_version;

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

		// Set version.
		$this->theme_version = beehive()->version();
		// Initialization.
		$this->init();

	}

	/**
	 * Init method
	 *
	 * @access private
	 * @since 1.0.0
	 */
	private function init() {

		// Redirect admin after theme switch.
		add_action( 'after_switch_theme', array( $this, 'redirect_admin' ) );
		// Enqueue scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		// Add admin menu.
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

	}

	/**
	 * Redirect Admin
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
	public function redirect_admin() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			header( 'Location:' . admin_url() . 'admin.php?page=beehive' );
		}
	}

	/**
	 * Adds admin Menu Pages.
	 *
	 * @access  public
	 * @return void
	 */
	public function admin_menu() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			// Menu page.
			add_menu_page( 'Beehive', esc_html__( 'Beehive', 'beehive' ), 'edit_theme_options', 'beehive', array( $this, 'include_welcome' ), 'dashicons-beehive-logo', 2 );
			// Submenu pages.
			add_submenu_page( 'beehive', esc_html__( 'Server Information', 'beehive' ), esc_html__( 'System Status', 'beehive' ), 'manage_options', 'beehive-server', array( $this, 'include_system' ) );
			add_submenu_page( 'beehive', esc_html__( 'Support', 'beehive' ), esc_html__( 'Support', 'beehive' ), 'manage_options', 'beehive-support', array( $this, 'include_support' ) );
			add_submenu_page( 'beehive', esc_html__( 'Credits', 'beehive' ), esc_html__( 'Credits', 'beehive' ), 'manage_options', 'beehive-credits', array( $this, 'include_credits' ) );
		}
	}

	/**
	 * Admin Header screen with welcome text and tabs
	 *
	 * @since 1.0.0
	 *
	 * @access  public
	 * @param string $page The current screen.
	 * @return void
	 */
	public function admin_header( $page = 'welcome' ) {  ?>
		<h2 class="screen-reader-text"><?php esc_html_e( 'Howdy Admin', 'beehive' ); ?></h2>
		<div class="beehive-greetings">
			<div class="greetings-container">
				<div class="greetings-texts">
					<h1><?php esc_html_e( 'Welcome to Beehive!!', 'beehive' ); ?></h1>
					<p class="about-text"><?php esc_html_e( 'Thank you so much for purchasing Beehive, one of the most beautiful and avanced social network WordPress themes. We have assembled some links for you to get started. Install all the plugins and then import the demo contents. You should be ready to go!! Cheers', 'beehive' ); ?></p>
				</div>
				<div class="beehive-logo">
					<img src="<?php echo esc_url( BEEHIVE_URI . '/assets/admin/images/theme-logo.png' ); ?>" alt="<?php esc_attr_e( 'Beehive', 'beehive' ); ?>" />
					<div class="theme-version">
						<span><?php esc_html_e( 'Version: ', 'beehive' ); ?><?php echo esc_html( $this->theme_version ); ?></span>
					</div>
				</div>
			</div>
		</div>
		<!-- Screen Menu -->
		<h2 class="nav-tab-wrapper beehive-admin-tabs">
			<a href="<?php echo esc_url_raw( ( '' === $page ) ? '#' : admin_url( 'admin.php?page=beehive' ) ); ?>" class="<?php echo ( 'welcome' === $page ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_html_e( 'Welcome', 'beehive' ); ?></a>
			<a href="<?php echo esc_url_raw( ( 'server' === $page ) ? '#' : admin_url( 'admin.php?page=beehive-server' ) ); ?>" class="<?php echo ( 'server' === $page ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_html_e( 'System Status', 'beehive' ); ?></a>
			<a href="<?php echo esc_url_raw( ( 'support' === $page ) ? '#' : admin_url( 'admin.php?page=beehive-support' ) ); ?>" class="<?php echo ( 'support' === $page ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_html_e( 'Support', 'beehive' ); ?></a>
			<a href="<?php echo esc_url_raw( ( 'credits' === $page ) ? '#' : admin_url( 'admin.php?page=beehive-credits' ) ); ?>" class="<?php echo ( 'credits' === $page ) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_html_e( 'Credits', 'beehive' ); ?></a>
		</h2>
		<?php
	}

	/**
	 * Enqueues scripts & styles.
	 *
	 * @access  public
	 * @return void
	 */
	public function admin_scripts() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			wp_enqueue_style( 'beehive-admin', BEEHIVE_URI . '/assets/admin/css/beehive-admin.css', array(), beehive()->version() );
		}
	}

	/**
	 * Include file | Welcome Screen
	 *
	 * @access  public
	 * @return void
	 */
	public function include_welcome() {
		require_once BEEHIVE_INC . '/admin/welcome.php';
	}

	/**
	 * Include file | Server Screen
	 *
	 * @access  public
	 * @return void
	 */
	public function include_system() {
		require_once BEEHIVE_INC . '/admin/system.php';
	}

	/**
	 * Include file | Support Screen
	 *
	 * @access  public
	 * @return void
	 */
	public function include_support() {
		require_once BEEHIVE_INC . '/admin/support.php';
	}

	/**
	 * Include file | Credits Screen
	 *
	 * @access  public
	 * @return void
	 */
	public function include_credits() {
		require_once BEEHIVE_INC . '/admin/credits.php';
	}

}

// Single instance of this class.
Beehive_Admin::instance();
