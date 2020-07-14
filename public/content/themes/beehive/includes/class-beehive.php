<?php
/**
 * Class Beehive
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
 * The main beehive class.
 *
 * @since 1.0.0
 */
class Beehive {

	/**
	 * Theme version.
	 *
	 * @access public
	 * @var string
	 */
	public $version;

	/**
	 * Beehive Init
	 *
	 * @access public
	 * @var object
	 */
	public $init;

	/**
	 * Beehive navbar
	 *
	 * @access public
	 * @var object
	 */
	public $navigation;

	/**
	 * Beehive Title Bar
	 *
	 * @access public
	 * @var object
	 */
	public $titlebar;

	/**
	 * Beehive sidebars
	 *
	 * @access public
	 * @var object
	 */
	public $sidebars;

	/**
	 * Beehive Layout
	 *
	 * @access public
	 * @var object
	 */
	public $layout;

	/**
	 * Beehive Options
	 *
	 * @access public
	 * @var object
	 */
	public $options;

	/**
	 * Beehive Option name
	 *
	 * @static
	 * @access public
	 * @var string
	 */
	public static $option_name;

	/**
	 * Meta Prefix
	 *
	 * @access public
	 * @var string
	 */
	public $meta_prefix;

	/**
	 * Beehive footer
	 *
	 * @access public
	 * @var object
	 */
	public $footer;

	/**
	 * The only instance of this class
	 *
	 * @static
	 * @access private
	 * @var null|object
	 */
	private static $instance = null;

	/**
	 * Access the single instance of the class.
	 *
	 * @return Beehive
	 * @since 1.0.0
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * The class constructor
	 *
	 * @access private
	 */
	private function __construct() {

		// Set theme version.
		$this->version = BEEHIVE_VERSION;
		// Set option name.
		self::$option_name = 'beehive_opts';
		// Set meta prifix.
		$this->meta_prefix = 'beehive-metabox-';

		// Load classes.
		$this->load_classes();

		// Instantiate classes.
		$this->init    = new Beehive_Theme_Setup();
		$this->options = new Beehive_Settings();

		// Instantiate layout component classes.
		$this->navigation = new Beehive_Navbar();
		$this->titlebar   = new Beehive_Title_Bar();
		$this->sidebars   = new Beehive_Sidebars();
		$this->footer     = new Beehive_Footer();

		// Instantiate layout.
		$this->layout = new Beehive_Layout();

	}

	/**
	 * Get Beehive version
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function version() {
		return $this->version;
	}

	/**
	 * Load necessary classes
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	private function load_classes() {

		/**
		 * The class responsible for theme setup functionality of the
		 * beehive theme.
		 */
		require_once BEEHIVE_INC . '/class-beehive-theme-setup.php';

		/**
		 * The class responsible for theme settings functionality of the
		 * beehive theme.
		 */
		require_once BEEHIVE_INC . '/class-beehive-settings.php';

		/**
		 * The class responsible for header navigation functionality of the
		 * beehive theme.
		 */
		require_once BEEHIVE_INC . '/class-beehive-navbar.php';

		/**
		 * The class responsible for title bar functionality of the
		 * beehive theme.
		 */
		require_once BEEHIVE_INC . '/class-beehive-title-bar.php';

		/**
		 * The class responsible for sidebar functionality of the
		 * beehive theme.
		 */
		require_once BEEHIVE_INC . '/class-beehive-sidebars.php';

		/**
		 * The class responsible for footer functionality of the
		 * beehive theme.
		 */
		require_once BEEHIVE_INC . '/class-beehive-footer.php';

		/**
		 * The class responsible for layout functionality of the
		 * beehive theme.
		 */
		require_once BEEHIVE_INC . '/class-beehive-layout.php';

	}

	/**
	 * Get theme option name
	 *
	 * @access public
	 * @static
	 * @return string
	 * @since 1.0.0
	 */
	public static function get_option_name() {
		return self::$option_name;
	}

	/**
	 * Get meta prefix
	 *
	 * @access public
	 * @return string
	 * @since 1.0.0
	 */
	public function get_meta_prefix() {
		return $this->meta_prefix;
	}
}
