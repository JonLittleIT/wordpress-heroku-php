<?php
/**
 * Enqueues scripts and styles.
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
 * Beehive_Scripts class.
 *
 * @since 1.0.0
 */
class Beehive_Scripts {

	/**
	 * Dynamic css folder name
	 *
	 * @access private
	 * @var string
	 */
	private static $style_folder;

	/**
	 * Dynamic scss file path full
	 *
	 * @access private
	 * @var string
	 */
	private static $dynamic_sass_file;

	/**
	 * Hook in methods
	 * Frontend scripts
	 *
	 * @static
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public static function init() {

		// Set style folder.
		self::$style_folder = 'beehive-styles';
		// Set dynamic sass file.
		self::$dynamic_sass_file = BEEHIVE_ROOT . '/assets/scss/dynamic-styles/dynamic-styles.scss';

		// Script actions.
		add_action( 'redux/options/' . Beehive::get_option_name() . '/compiler', array( __class__, 'unlink_dynamic_css' ) );
		add_action( 'redux/options/' . Beehive::get_option_name() . '/compiler', array( __class__, 'editor_style' ) );
		add_action( 'wp_enqueue_scripts', array( __class__, 'load_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( __class__, 'load_dynamic_css' ), 999 );

	}

	/**
	 * Load scripts and styles
	 *
	 * @static
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public static function load_scripts() {

		// Register and enqueue stylesheet in bulk.
		self::register_styles();

		// Enqueue main stylesheet.
		wp_enqueue_style( 'beehive' );

		// Register and enqueue scripts in bulk.
		self::register_scripts();

		// Enqueue sticky kit.
		if ( beehive()->options->get( 'key=sticky-sidebar&default=1' ) ) {
			wp_enqueue_script( 'sticky-kit' );
		}

		// Enqueue masonry script.
		wp_enqueue_script( 'masonry' );

		// Pass script data.
		if ( wp_script_is( 'beehive-bp-like' ) ) {
			wp_localize_script( 'beehive-bp-like', 'beehive_data', self::get_script_data() );
		}
		if ( wp_script_is( 'beehive-rtm' ) ) {
			wp_localize_script( 'beehive-rtm', 'beehive_data', self::get_script_data() );
		}
		if ( wp_script_is( 'beehive-bp' ) ) {
			wp_localize_script( 'beehive-bp', 'beehive_data', self::get_script_data() );
		}
		if ( wp_script_is( 'beehive-bbp' ) ) {
			wp_localize_script( 'beehive-bbp', 'beehive_data', self::get_script_data() );
		}
		if ( wp_script_is( 'beehive-login' ) ) {
			wp_localize_script( 'beehive-login', 'beehive_data', self::get_script_data() );
		}
		wp_localize_script( 'beehive', 'beehive_data', self::get_script_data() );

		// Enqueue main script.
		wp_enqueue_script( 'beehive' );

	}

	/**
	 * Get them stylesheets
	 *
	 * @static
	 * @access public
	 * @return array
	 * @since 1.0.0
	 */
	public static function get_styles() {

		// Variables.
		$styles = array();
		$min    = '.min';

		// Load expanded version of css.
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true ) {
			$min = '';
		}

		// Fonts.
		$styles['beehive-fonts'] = array(
			'src'     => beehive_get_font_url(),
			'deps'    => array(),
			'media'   => 'all',
			'enqueue' => true,
		);

		// Bootstrap.
		$styles['bootstrap'] = array(
			'src'     => BEEHIVE_URI . '/assets/css/bootstrap' . $min . '.css',
			'deps'    => array(),
			'media'   => 'all',
			'enqueue' => true,
		);

		// Ionicons.
		$styles['ionicons'] = array(
			'src'     => BEEHIVE_URI . '/assets/css/ionicons' . $min . '.css',
			'deps'    => array(),
			'media'   => 'all',
			'enqueue' => true,
		);

		// Unicons Icons.
		$styles['unicons'] = array(
			'src'     => BEEHIVE_URI . '/assets/css/unicons' . $min . '.css',
			'deps'    => array(),
			'media'   => 'all',
			'enqueue' => true,
		);

		// Custom Scrollber.
		$styles['mscrollbar'] = array(
			'src'     => BEEHIVE_URI . '/assets/css/mscrollbar' . $min . '.css',
			'deps'    => array(),
			'media'   => 'all',
			'enqueue' => true,
		);

		// Swiper slider.
		$styles['swiper'] = array(
			'src'     => BEEHIVE_URI . '/assets/css/swiper' . $min . '.css',
			'deps'    => ( defined( 'ELEMENTOR_PATH' ) ) ? array( 'elementor-frontend', 'elementor-animations', 'elementor-icons' ) : array(),
			'media'   => 'all',
			'enqueue' => false,
		);

		// Animate css.
		$styles['animate'] = array(
			'src'     => BEEHIVE_URI . '/assets/css/animate' . $min . '.css',
			'deps'    => array(),
			'media'   => 'all',
			'enqueue' => true,
		);

		// Hiraku css.
		$styles['hiraku'] = array(
			'src'     => BEEHIVE_URI . '/assets/css/hiraku' . $min . '.css',
			'deps'    => array(),
			'media'   => 'all',
			'enqueue' => true,
		);

		// Main theme stylesheet.
		$styles['beehive'] = array(
			'src'     => BEEHIVE_URI . '/assets/css/beehive' . $min . '.css',
			'deps'    => ( defined( 'ELEMENTOR_PATH' ) ) ? array( 'elementor-frontend', 'elementor-animations', 'elementor-icons' ) : array(),
			'media'   => 'all',
			'enqueue' => false,
		);

		// Stylesheets.
		$styles = apply_filters( 'beehive_stylesheets', $styles, $min );

		// Return stylesheets.
		return $styles;

	}

	/**
	 * Register and Enqueue
	 * Frontend stylesheets
	 *
	 * @static
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public static function register_styles() {

		// Get the stylesheets.
		$styles = self::get_styles();

		// Return early if styles var is not an array.
		if ( ! is_array( $styles ) ) {
			return;
		}

		// Loop through the stylesheets and register and enqueue them.
		foreach ( $styles as $handle => $prop ) {

			if ( ! empty( $handle ) && ( isset( $prop['src'] ) && is_string( $prop['src'] ) ) ) {
				$src   = $prop['src'];
				$deps  = ( isset( $prop['deps'] ) && $prop['deps'] ) ? $prop['deps'] : array();
				$ver   = ( isset( $prop['version'] ) && $prop['version'] ) ? $prop['version'] : beehive()->version();
				$media = ( isset( $prop['media'] ) && $prop['media'] ) ? $prop['media'] : 'all';

				// Register the stylesheet.
				wp_register_style( $handle, $src, $deps, $ver, $media );

				// Enqueue the stylesheet.
				if ( isset( $prop['enqueue'] ) && true === $prop['enqueue'] ) {
					wp_enqueue_style( $handle );
				}
			}
		}
	}

	/**
	 * Unlink dynamic css
	 *
	 * @static
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public static function unlink_dynamic_css() {
		$upload_dir       = wp_upload_dir();
		$file_name        = basename( self::$dynamic_sass_file, '.scss' );
		$dynamic_css_file = trailingslashit( $upload_dir['basedir'] ) . self::$style_folder . '/' . $file_name . '.css';
		if ( file_exists( $dynamic_css_file ) ) {
			unlink( $dynamic_css_file );
		}
	}

	/**
	 * Compile dynamic css
	 *
	 * @static
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public static function load_dynamic_css() {

		// Upload dir.
		$upload_dir   = wp_upload_dir();
		$style_folder = self::$style_folder;

		// Check ssl.
		if ( is_ssl() ) {
			if ( strpos( $upload_dir['baseurl'], 'https://' ) === false ) {
				$upload_dir['baseurl'] = str_ireplace( 'http', 'https', $upload_dir['baseurl'] );
			}
		}

		// Sass args.
		$scss_path = self::$dynamic_sass_file;
		$css_dir   = trailingslashit( $upload_dir['basedir'] ) . $style_folder;
		$scss_vars = self::get_sass_data();

		// Initiate compiler.
		$scss = new Beehive_Compile_Sass( $scss_path, $css_dir, $scss_vars );

		// Create dir.
		if ( ! is_dir( $css_dir ) ) {
			wp_mkdir_p( $css_dir );
		}

		// write the css file.
		if ( $scss->is_css_dir_writable() ) {

			// write the file if not exist.
			if ( ! file_exists( $scss->get_css_file_path() ) ) {
				$scss->compile_file();
			}

			// CSS url.
			$css_url = trailingslashit( $upload_dir['baseurl'] ) . $style_folder . '/' . $scss->get_file_name() . '.css';

			// Register and enqueue dynamic styles.
			wp_register_style( 'beehive-dynamic', $css_url, array(), beehive()->version(), 'all' );
			wp_enqueue_style( 'beehive-dynamic' );
		} else {

			// set inline style.
			if ( ! empty( $scss->get_compiled_css() ) ) {
				wp_add_inline_style( get_template(), $scss->get_compiled_css() );
			}
		}

	}

	/**
	 * Compile editor styles
	 *
	 * @static
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public static function editor_style() {

		// Editor scss file.
		$editor_scss = BEEHIVE_ROOT . '/assets/scss/editor-styles/editor-styles.scss';
		$css_dir     = '';
		$scss_vars   = self::get_sass_data();

		// Initiate compiler.
		$scss = new Beehive_Compile_Sass( $editor_scss, $css_dir, $scss_vars );

		// write the css file.
		if ( $scss->is_css_dir_writable() ) {
			$scss->compile_file();
		}

	}

	/**
	 * Get theme scripts
	 *
	 * @static
	 * @access public
	 * @return array
	 * @since 1.0.0
	 */
	public static function get_scripts() {

		// Variables.
		$scripts = array();
		$min     = '.min';

		// Load expanded version of js.
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true ) {
			$min = '';
		}

		// Popper js.
		$scripts['popper'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/popper' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => true,
		);

		// Bootstrap js.
		$scripts['bootstrap'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/bootstrap' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => true,
		);

		// Scrollbar js.
		$scripts['mscrollbar'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/mscrollbar' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => true,
		);

		// Swiper js.
		$scripts['swiper'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/swiper' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => false,
		);

		// Wow js.
		$scripts['wow'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/wow' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => true,
		);

		// Hikaru js.
		$scripts['hiraku'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/hiraku' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => true,
		);

		// Sticky kit js.
		$scripts['sticky-kit'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/sticky-kit' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => false,
		);

		// Select2 js.
		$scripts['select-2'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/select2' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => false,
		);

		// Truncate text js.
		$scripts['shorten'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/jquery.shorten' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => true,
		);

		// Fit vides js.
		$scripts['fitvids'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/jquery.fitvids' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => true,
		);

		// Flexmenu js.
		$scripts['flexmenu'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/flexmenu' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => true,
		);

		// Main script.
		$scripts['beehive'] = array(
			'src'       => BEEHIVE_URI . '/assets/js/beehive' . $min . '.js',
			'deps'      => array( 'jquery' ),
			'in_footer' => true,
			'enqueue'   => false,
		);

		// Scripts.
		$scripts = apply_filters( 'beehive_scripts', $scripts, $min );

		// Return scripts.
		return $scripts;

	}

	/**
	 * Register and enqueue
	 * Frontend scripts
	 *
	 * @static
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public static function register_scripts() {

		// Get scripts.
		$scripts = self::get_scripts();

		// Return early if styles var is not an array.
		if ( ! is_array( $scripts ) ) {
			return;
		}

		// Loop through the scripts, and register and enqueue them.
		foreach ( $scripts as $handle => $prop ) {
			if ( ! empty( $handle ) && ( isset( $prop['src'] ) && ! empty( $prop['src'] ) ) ) {
				$src       = $prop['src'];
				$deps      = ( isset( $prop['deps'] ) && $prop['deps'] ) ? $prop['deps'] : array();
				$version   = ( isset( $prop['version'] ) && $prop['version'] ) ? $prop['version'] : beehive()->version();
				$in_footer = ( isset( $pro['in_footer'] ) && $pro['in_footer'] ) ? $pro['in_footer'] : true;

				// Register the scripts.
				wp_register_script( $handle, $src, $deps, $version, $in_footer );

				// Enqueue the scripts.
				if ( isset( $prop['enqueue'] ) && true === $prop['enqueue'] ) {
					wp_enqueue_script( $handle );
				}
			}
		}

	}

	/**
	 * Get script data
	 *
	 * @static
	 * @access public
	 * @return array
	 * @since 1.0.0
	 */
	public static function get_script_data() {

		// Script data.
		$obj_data = array(
			'ajaxurl'              => admin_url( 'admin-ajax.php' ),
			'beehive_search_nonce' => wp_create_nonce( 'beehive_search_nonce' ),
			'avatar'               => get_avatar( get_current_user_id(), 24 ),
			'mobile_logo_url'      => beehive()->options->get( 'key=mobile-logo&meta=1&options=0' ),
			'light_modal'          => beehive()->options->get( 'key=login-modal&meta=1&options=0' ),
			'stick_offset'         => ( beehive()->options->get( 'key=fixed-nav&meta=1&default=1' ) ) ? 90 : 30,
			'more_text'            => esc_html__( 'More', 'beehive' ),
			'read_more'            => esc_html__( 'Read more', 'beehive' ),
			'read_close'           => esc_html__( 'Close', 'beehive' ),
			'like_msg'             => esc_html__( 'Like this', 'beehive' ),
			'unlike_msg'           => esc_html__( 'Unlike this', 'beehive' ),
			'attachment_text'      => esc_html__( 'Attach media', 'beehive' ),
			'activity_max'         => beehive()->options->get(
				array(
					'key'     => 'activity-length',
					'default' => 3000,
				)
			),
			'redirecturl'          => esc_url( home_url( '/' ) ),
			'bp_is_active'         => function_exists( 'bp_is_active' ),
			'icon_logo_url'        => beehive_get_icon_logo_url(),
		);

		// Return data.
		return apply_filters( 'beehive_localize_script_data', $obj_data );

	}

	/**
	 * Get sass variables
	 * for scss compiler.
	 *
	 * @static
	 * @access public
	 * @return array
	 * @since 1.0.0
	 */
	public static function get_sass_data() {

		// Variables array.
		$variables = array();

		// Set variables.
		$variables['primary']             = beehive()->options->get( 'key=primary&default=#5561e2' );
		$variables['secondary']           = beehive()->options->get( 'key=secondary&default=#ff7544' );
		$variables['panel-bg']            = beehive()->options->get( 'key=dash-bg-color&default=#383a45' );
		$variables['info-color']          = beehive()->options->get( 'key=info-color&default=#5561e2' );
		$variables['success-color']       = beehive()->options->get( 'key=success-color&default=#2ed573' );
		$variables['warn-color']          = beehive()->options->get( 'key=warn-color&default=orange' );
		$variables['error-color']         = beehive()->options->get( 'key=error-color&default=red' );
		$variables['body-font-family']    = beehive()->options->get( 'key=body-font&nested=font-family&default=Nunito Sans' );
		$variables['body-font-size']      = beehive()->options->get( 'key=body-font&nested=font-size&default=14px' );
		$variables['body-font-weight']    = beehive()->options->get( 'key=body-font&nested=font-weight&default=400' );
		$variables['body-line-height']    = beehive()->options->get( 'key=body-font&nested=line-height&default=26px' );
		$variables['heading-font-family'] = beehive()->options->get( 'key=heading-font&nested=font-family&default=Quicksand' );
		$variables['heading-font-weight'] = beehive()->options->get( 'key=heading-font&nested=font-weight&default=700' );
		if ( 'default' === beehive()->options->get( 'key=blog-layout&default=default' ) ) {
			$variables['editor-width']      = '768px';
			$variables['editor-width-wide'] = '928px';
			$variables['editor-title-size'] = '2.286em';
		} else {
			$variables['editor-width']      = '610px';
			$variables['editor-width-wide'] = '650px';
			$variables['editor-title-size'] = '1.922em';
		}

		// Return variables.
		return $variables;
	}

}

/** Script class init */
Beehive_Scripts::init();
