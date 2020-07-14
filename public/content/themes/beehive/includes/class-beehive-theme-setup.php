<?php
/**
 * Set basic components
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
 * Beehive_Theme_Setup class.
 *
 * @since 1.0.0
 */
class Beehive_Theme_Setup {

	/**
	 * Class constructor
	 *
	 * @access  public
	 */
	public function __construct() {

		// Add theme supports.
		add_action( 'after_setup_theme', array( $this, 'add_theme_supports' ) );
		// After theme switch.
		add_action( 'after_switch_theme', array( $this, 'after_switch_theme' ) );

	}

	/**
	 * Add theme_supports.
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function add_theme_supports() {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on beehive, use a find and replace
		 * to change 'beehive' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'beehive', BEEHIVE_ROOT . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		// By adding theme support, we declare that this theme does not use a
		// hard-coded <title> tag in the document head, and expect WordPress to
		// provide it for us.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		// @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/.
		add_theme_support( 'post-thumbnails' );

		// Switch default core markup for search form, comment form, and comments
		// to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		// @link https://codex.wordpress.org/Theme_Logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Enable support for Post Formats.
		// See http://codex.wordpress.org/Post_Formats.
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'audio',
				'quote',
				'link',
				'gallery',
			)
		);

		// Add support for editor.
		// @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#editor-styles.
		add_theme_support( 'editor-styles' );
		add_editor_style( beehive_get_font_url() );
		add_editor_style( 'assets/css/editor-styles.css' );

		// Add support for align wide block.
		// @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment.
		if ( beehive()->options->get( 'key=blog-layout&default=default' ) === 'default' ) {
			add_theme_support( 'align-wide' );
		}

		// Add support for editor color pallete.
		// @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes.
		add_theme_support(
			'editor-color-palette',
			array(

				// Editor palette colors.
				array(
					'name'  => esc_html__( 'Primary Color', 'beehive' ),
					'slug'  => 'primary-color',
					'color' => beehive()->options->get( 'key=primary&default=#5561e2' ),
				),
				array(
					'name'  => esc_html__( 'Secondary Color', 'beehive' ),
					'slug'  => 'secondary-color',
					'color' => beehive()->options->get( 'key=secondary&default=#ff7544' ),
				),
				array(
					'name'  => esc_html__( 'Pale pink', 'beehive' ),
					'slug'  => 'pale-pink',
					'color' => '#f78da7',
				),
				array(
					'name'  => esc_html__( 'Vivid red', 'beehive' ),
					'slug'  => 'vivid-red',
					'color' => '#cf2e2e',
				),
				array(
					'name'  => esc_html__( 'Luminous vivid orange', 'beehive' ),
					'slug'  => 'luminous-vivid-orange',
					'color' => '#ff6900',
				),
				array(
					'name'  => esc_html__( 'Luminous vivid amber', 'beehive' ),
					'slug'  => 'luminous-vivid-amber',
					'color' => '#fcb900',
				),
				array(
					'name'  => esc_html__( 'Light green cyan', 'beehive' ),
					'slug'  => 'light-green-cyan',
					'color' => '#7bdcb5',
				),
				array(
					'name'  => esc_html__( 'Vivid green cyan', 'beehive' ),
					'slug'  => 'vivid-green-cyan',
					'color' => '#00d084',
				),
				array(
					'name'  => esc_html__( 'Pale cyan blue', 'beehive' ),
					'slug'  => 'pale-cyan-blue',
					'color' => '#8ed1fc',
				),
				array(
					'name'  => esc_html__( 'Vivid cyan blue', 'beehive' ),
					'slug'  => 'vivid-cyan-blue',
					'color' => '#0693e3',
				),
				array(
					'name'  => esc_html__( 'Very light gray', 'beehive' ),
					'slug'  => 'very-light-gray',
					'color' => '#eeeeee',
				),
				array(
					'name'  => esc_html__( 'Cyan bluish gray', 'beehive' ),
					'slug'  => 'cyan-bluish-gray',
					'color' => '#abb8c3',
				),
				array(
					'name'  => esc_html__( 'Very dark gray', 'beehive' ),
					'slug'  => 'very-dark-gray',
					'color' => '#313131',
				),
				array(
					'name'  => esc_html__( 'White color', 'beehive' ),
					'slug'  => 'white-color',
					'color' => '#ffffff',
				),
			)
		);

		// Add support for editor font sizes.
		// @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-font-sizes.
		add_theme_support(
			'editor-font-sizes',
			array(

				// Font sizes.
				array(
					'name' => esc_html__( 'Small', 'beehive' ),
					'size' => 13,
					'slug' => 'small',
				),
				array(
					'name' => esc_html__( 'Normal', 'beehive' ),
					'size' => 14,
					'slug' => 'normal',
				),
				array(
					'name' => esc_html__( 'Medium', 'beehive' ),
					'size' => 16,
					'slug' => 'medium',
				),
				array(
					'name' => esc_html__( 'Large', 'beehive' ),
					'size' => 24,
					'slug' => 'large',
				),
				array(
					'name' => esc_html__( 'Huge', 'beehive' ),
					'size' => 32,
					'slug' => 'huge',
				),

			)
		);

		// Register menus
		// @link https://developer.wordpress.org/themes/functionality/navigation-menus/.
		$this->register_menus();

	}

	/**
	 * After theme switch
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function after_switch_theme() {
		// Disable default elementor typography.
		update_option( 'elementor_disable_typography_schemes', 'yes' );
		// Disable default elementor colors.
		update_option( 'elementor_disable_color_schemes', 'yes' );
		// Rtmedia.
		update_option( 'rtmedia_premium_addon_notice', 'hide' );
		update_option( 'rtmedia_inspirebook_release_notice', 'hide' );
		update_option( 'rtmedia-update-template-notice-v3_9_4', 'hide' );
		update_site_option( 'install_transcoder_admin_notice', '0' );
	}

	/**
	 * Register Menus
	 *
	 * @access  public
	 * @return void
	 * @since 1.0.0
	 */
	public function register_menus() {

		// Register main header menu.
		register_nav_menus(
			array(
				'default-navbar' => esc_html__( 'Default Navbar', 'beehive' ),
			)
		);

		// Register social template panel menu.
		register_nav_menus(
			array(
				'panel-menu' => esc_html__( 'Social Panel Menu', 'beehive' ),
			)
		);

		// Register social template sidebar menu.
		register_nav_menus(
			array(
				'aside-nav-menu' => esc_html__( 'Sidebar Bottom Menu', 'beehive' ),
			)
		);

		// Register footer menus.
		register_nav_menus(
			array(
				'company-menu' => esc_html__( 'Footer Menu (Company)', 'beehive' ),
			)
		);
		register_nav_menus(
			array(
				'community-menu' => esc_html__( 'Footer Menu (Community)', 'beehive' ),
			)
		);
		register_nav_menus(
			array(
				'usefull-menu' => esc_html__( 'Footer Menu (Usefull Links)', 'beehive' ),
			)
		);
		register_nav_menus(
			array(
				'legal-menu' => esc_html__( 'Footer Menu (Legal)', 'beehive' ),
			)
		);
	}

}
