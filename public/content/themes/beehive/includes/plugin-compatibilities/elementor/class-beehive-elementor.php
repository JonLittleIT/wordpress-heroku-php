<?php
/**
 * Elements
 * Beehive elements for elementor
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
class Beehive_Elementor {

	/**
	 * Instance
	 * Beehive_Elementor The single instance of the class.
	 *
	 * @access private
	 * @static
	 * @var null
	 * @return object
	 * @since 1.0.0
	 */
	private static $_instance = null;

	/**
	 * Instance
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @access public
	 * @static
	 * @return Beehive_Elementor An instance of the class.
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

		// Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}

		// Initialize elements.
		$this->init();
	}

	/**
	 * Initialize the elements
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function init() {

		// Add elementor widget categories.
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_category' ) );
		// Register widgets.
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
		// Add stylesheets.
		add_filter( 'beehive_stylesheets', array( $this, 'add_styles' ) );
		// Add scripts.
		add_filter( 'beehive_scripts', array( $this, 'add_scripts' ), 10, 2 );

	}

	/**
	 * Add elementor widget category
	 *
	 * @access public
	 * @param object $elements_manager elementor manager object.
	 * @since 1.0.0
	 */
	public function add_elementor_widget_category( $elements_manager ) {
		$elements_manager->add_category(
			'beehive-elements',
			array(
				'title' => esc_html__( 'Beehive', 'beehive' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}


	/**
	 * Get widgets
	 *
	 * @access public
	 * @return array
	 * @since 1.0.0
	 */
	public function get_widgets() {

		// Elements.
		$widgets = array();

		// Button.
		$widgets['button'] = array(
			'name'      => 'beehive-button',
			'file-name' => 'button',
			'class'     => 'Beehive_Button_Element',
		);

		// Inline menu.
		$widgets['menu'] = array(
			'name'      => 'beehive-inline-menu',
			'file-name' => 'inline-menu',
			'class'     => 'Beehive_Menu_Element',
		);

		// Social icons.
		$widgets['social-icons'] = array(
			'name'      => 'beehive-social-icons',
			'file-name' => 'social-icons',
			'class'     => 'Beehive_Social_Icons_Element',
		);

		// Contact info.
		$widgets['contact-info'] = array(
			'name'      => 'beehive-contactinfo',
			'file-name' => 'contact-info',
			'class'     => 'Beehive_Contact_Info_Element',
		);

		// Login form.
		$widgets['login-form'] = array(
			'name'      => 'beehive-login',
			'file-name' => 'login',
			'class'     => 'Beehive_Login_Form_Element',
		);

		// Icon box.
		$widgets['iconbox'] = array(
			'name'      => 'beehive-iconbox',
			'file-name' => 'icon-box',
			'class'     => 'Beehive_Iconbox_Element',
		);

		// Image slider.
		$widgets['image-slider'] = array(
			'name'      => 'beehive-image-slider',
			'file-name' => 'image-slider',
			'class'     => 'Beehive_Image_Slider_Element',
		);

		// Content tabs.
		$widgets['tabs'] = array(
			'name'      => 'beehive-tabs',
			'file-name' => 'tabs',
			'class'     => 'Beehive_Tabs_Element',
		);

		// Team member.
		$widgets['team-member'] = array(
			'name'      => 'beehive-team-member',
			'file-name' => 'team-member',
			'class'     => 'Beehive_Team_Member',
		);

		// Team member.
		$widgets['site-stats'] = array(
			'name'      => 'beehive-stats',
			'file-name' => 'site-stats',
			'class'     => 'Beehive_Stats',
		);

		// Return widgets.
		return $widgets;
	}


	/**
	 * Register widgets
	 * Elementor widgets for beehive theme
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function register_widgets() {
		if ( class_exists( 'Elementor\Plugin' ) ) {
			$elementor = Elementor\Plugin::instance();
			if ( isset( $elementor->widgets_manager ) ) {
				if ( method_exists( $elementor->widgets_manager, 'register_widget_type' ) ) {
					$widgets = $this->get_widgets();
					if ( is_array( $widgets ) && ! empty( $widgets ) ) {
						foreach ( $widgets as $widget ) {
							if ( isset( $widget['file-name'] ) ) {
								$widget_file = dirname( __FILE__ ) . '/widgets/' . $widget['file-name'] . '.php';
								if ( file_exists( $widget_file ) && is_readable( $widget_file ) ) {
									require_once $widget_file;
									if ( class_exists( $widget['class'] ) ) {
										$elementor->widgets_manager->register_widget_type( new $widget['class']() );
									}
								}
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Add Styles
	 *
	 * @access public
	 * @param array $styles stylesheets.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_styles( $styles ) {

		// Swiper slider css.
		if ( self::is_built_with_elementor( get_the_ID() ) ) {
			$styles['swiper']['enqueue'] = true;
		}

		// Return stylesheets.
		return $styles;
	}

	/**
	 * Add scripts
	 *
	 * @access public
	 * @param array  $scripts js scripts.
	 * @param string $min     minified version of the script.
	 * @return array
	 * @since 1.0.0
	 */
	public function add_scripts( $scripts, $min ) {

		// Swiper slider.
		if ( self::is_built_with_elementor( get_the_ID() ) ) {

			// Beehive elements script.
			$scripts['beehive-elements'] = array(
				'src'       => BEEHIVE_URI . '/assets/js/beehive-elements' . $min . '.js',
				'deps'      => array( 'jquery', 'swiper' ),
				'in_footer' => true,
				'enqueue'   => true,
			);
		}

		// Return scripts.
		return $scripts;

	}

	/**
	 * Check for elementor pages
	 *
	 * @static
	 * @access public
	 * @param int $post_id post ID.
	 * @return bool
	 * @since 1.0.0
	 */
	public static function is_built_with_elementor( $post_id ) {

		// Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			return false;
		}

		// Return early.
		if ( empty( $post_id ) && ! is_int( $post_id ) ) {
			return false;
		}

		// Return true if build with elementor.
		if ( Elementor\Plugin::instance()->db->is_built_with_elementor( $post_id ) ) {
			return true;
		}

		// False.
		return false;
	}
}

// Initialize the class.
Beehive_Elementor::instance();
