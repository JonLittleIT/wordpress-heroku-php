<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Ekommart_Options' ) ) :
	/**
	 * The Ekommart Options class
	 */
	class Ekommart_Options {


		public $opt_name = "ekommart_options";

		public function __construct() {
			if ( ekommart_is_redux_activated() ) {
				$this->setup_redux();
				Redux::init( $this->opt_name );
			}

			if ( ekommart_is_cmb2_activated() ) {
				$this->setup_metabox();
			}

			add_action( 'wp_enqueue_scripts', [ $this, 'add_inline_css' ], 9999 );
		}

		private function setup_metabox() {
			add_action( 'cmb2_admin_init', [ $this, 'metabox_page' ] );
		}

		public function metabox_page() {
			$cmb2 = new_cmb2_box( array(
				'id'           => 'ekommart_page_settings',
				'title'        => esc_html__( 'Page Settings', 'ekommart' ),
				'object_types' => array( 'page', ), // Post type
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true, // Show field names on the left
				// 'cmb_styles' => false, // false to disable the CMB stylesheet
				// 'closed'     => true, // Keep the metabox closed by default
			) );

			//Breadcrumb
			$cmb2->add_field( array(
				'name'    => esc_html__( 'Breadcrumb Background Color', 'ekommart' ),
				'id'      => 'ekommart_breadcrumb_bg_color',
				'type'    => 'colorpicker',
				'default' => '',
			) );

			$cmb2->add_field( array(
				'name'         => esc_html__( 'Breadcrumb Background', 'ekommart' ),
				'desc'         => 'Upload an image or enter an URL.',
				'id'           => 'ekommart_breadcrumb_bg_image',
				'type'         => 'file',
				'options'      => array(
					'url' => false, // Hide the text input for the url
				),
				'text'         => array(
					'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
				),
				'preview_size' => 'large', // Image size to use when previewing in the admin.
			) );
		}

		public function add_inline_css() {
		    $handle = 'ekommart-style';
			if ( ekommart_is_woocommerce_activated() ) {
			    $handle = 'ekommart-woocommerce';
			}

            if ( ekommart_get_theme_option( 'site_mode', 'light' ) === 'dark' ) {
                $handle .= '-dark';
            }

            wp_add_inline_style( $handle . '-style', $this->render_css() );
		}

		private function render_css() {
			$cssCode    = '';
			$allPrimary = ekommart_get_theme_option( 'color-primary', false );
			if ( $allPrimary ) {
				$primary       = $allPrimary['regular'];
				$primary_hover = $allPrimary['hover'];
			}

			$body    = ekommart_get_theme_option( 'color-body', false );
			$heading = ekommart_get_theme_option( 'color-heading', false );
			$border  = ekommart_get_theme_option( 'color-border', false );
			$light   = ekommart_get_theme_option( 'color-light', false );
			$dark    = ekommart_get_theme_option( 'color-dark', false );

			// Auto render
			$cssCode = require get_theme_file_path( '/inc/options/colors.php' );

			if ( ekommart_is_woocommerce_activated() ) {
				$cssCode = require get_theme_file_path( '/inc/options/colors-woo.php' );
			}

			if ( ekommart_is_elementor_activated() ) {
				$cssCode = require get_theme_file_path( '/inc/options/colors-elementor.php' );
			}

			if ( ekommart_is_cmb2_activated() && is_page() ) {
				$cssCode = require get_theme_file_path( '/inc/options/css/page.php' );
			}
			if ( ekommart_get_theme_option( 'site_layout', 'wide' ) == 'boxed' ) {
				$cssCode = require get_theme_file_path( '/inc/options/css/layout.php' );
			}


			return $cssCode;
		}

		private function setup_redux() {
			$theme = wp_get_theme(); // For use with some settings. Not necessary.
			$args  = array(
				// TYPICAL -> Change these values as you need/desire
				'opt_name'             => $this->opt_name,
				// This is where your data is stored in the database and also becomes your global variable name.
				'display_name'         => $theme->get( 'Name' ),
				// Name that appears at the top of your panel
				'display_version'      => $theme->get( 'Version' ),
				// Version that appears at the top of your panel
				'menu_type'            => 'menu',
				//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'       => true,
				// Show the sections below the admin menu item or not
				'menu_title'           => esc_html__( 'Ekommart Options', 'ekommart' ),
				'page_title'           => esc_html__( 'Ekommart Options', 'ekommart' ),
				// You will need to generate a Google API key to use this feature.
				// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
				'google_api_key'       => apply_filters( 'ekommart_google_api_key', '' ),
				// Set it you want google fonts to update weekly. A google_api_key value is required.
				'google_update_weekly' => false,
				// Must be defined to add google fonts to the typography module
				'async_typography'     => false,
				// Use a asynchronous font on the front end or font string
				//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
				'admin_bar'            => true,
				// Show the panel pages on the admin bar
				'admin_bar_icon'       => 'dashicons-portfolio',
				// Choose an icon for the admin bar menu
				'admin_bar_priority'   => 50,
				// Choose an priority for the admin bar menu
				'global_variable'      => '',
				// Set a different name for your global variable other than the opt_name
				'dev_mode'             => false,
				// Show the time the page took to load, etc
				'update_notice'        => true,
				// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
				'customizer'           => false,
				// Enable basic customizer support
				//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
				//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

				// OPTIONAL -> Give you extra features
				'page_priority'        => null,
				// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'          => 'themes.php',
				// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'     => 'manage_options',
				// Permissions needed to access the options panel.
				'menu_icon'            => '',
				// Specify a custom URL to an icon
				'last_tab'             => '',
				// Force your panel to always open to a specific tab (by id)
				'page_icon'            => 'icon-themes',
				// Icon displayed in the admin panel next to your menu_title
				'page_slug'            => 'ekommart-options',
				// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
				'save_defaults'        => true,
				// On load save the defaults to DB before user clicks save or not
				'default_show'         => false,
				// If true, shows the default value next to each field that is not the default value.
				'default_mark'         => '',
				// What to print by the field's title if the value shown is default. Suggested: *
				'show_import_export'   => true,
				// Shows the Import/Export panel when not used as a field.

				// CAREFUL -> These options are for advanced use only
				'transient_time'       => 60 * MINUTE_IN_SECONDS,
				'output'               => true,
				// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'           => true,
				// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'             => '',
				// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
				'use_cdn'              => true,
				// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

				// HINTS
				'hints'                => array(
					'icon'          => 'el el-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'   => 'red',
						'shadow'  => true,
						'rounded' => false,
						'style'   => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'    => array(
						'show' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'mouseover',
						),
						'hide' => array(
							'effect'   => 'slide',
							'duration' => '500',
							'event'    => 'click mouseleave',
						),
					),
				)
			);
			Redux::setArgs( $this->opt_name, apply_filters( 'ekommart_redux_args_options', $args ) );


			// Section Basic
			add_filter( 'redux/options/' . $this->opt_name . '/sections', [ $this, 'section_site_indentity' ] );
			add_filter( 'redux/options/' . $this->opt_name . '/sections', [ $this, 'section_site_header' ] );
			add_filter( 'redux/options/' . $this->opt_name . '/sections', [ $this, 'section_breadcrumb' ] );
			add_filter( 'redux/options/' . $this->opt_name . '/sections', [ $this, 'section_blog' ] );
			add_filter( 'redux/options/' . $this->opt_name . '/sections', [ $this, 'section_social' ] );
			add_filter( 'redux/options/' . $this->opt_name . '/sections', [ $this, 'section_site_footer' ] );

			if ( ekommart_is_woocommerce_activated() ) {
				add_filter( 'redux/options/' . $this->opt_name . '/sections', [ $this, 'get_wocommerce_section' ] );
			}

		}

		public function section_site_indentity( $sections ) {
			$sections[] = array(
				'title'  => esc_html__( 'Home', 'ekommart' ),
				'id'     => 'home',
				'icon'   => 'el el-home',
				'fields' => array(
					array(
						'id'      => 'site_mode',
						'type'    => 'button_set',
						'title'   => esc_html__( 'Theme Style', 'ekommart' ),
						'options' => array(
							'light' => esc_html__( 'Light', 'ekommart' ),
							'dark'  => esc_html__( 'Dark', 'ekommart' ),
						),
						'default' => 'light'
					),
					array(
						'id'      => 'site_layout',
						'type'    => 'button_set',
						'title'   => esc_html__( 'Layout', 'ekommart' ),
						'options' => array(
							'wide'  => esc_html__( 'Wide', 'ekommart' ),
							'boxed' => esc_html__( 'Boxed', 'ekommart' ),
						),
						'default' => 'wide'
					),
					array(
						'id'            => 'boxed-container',
						'type'          => 'slider',
						'title'         => esc_html__( 'Boxed Container Width', 'ekommart' ),
						"default"       => 1400,
						"min"           => 1024,
						"step"          => 1,
						"max"           => 1920,
						'display_value' => 'text',
						'required'      => array( 'site_layout', 'equals', 'boxed' ),
					),
					array(
						'id'            => 'boxed-offset',
						'type'          => 'slider',
						'title'         => esc_html__( 'Boxed Offset', 'ekommart' ),
						"default"       => 30,
						"min"           => 0,
						"step"          => 1,
						"max"           => 200,
						'display_value' => 'text',
						'required'      => array( 'site_layout', 'equals', 'boxed' ),
					),
					array(
						'id'       => 'logo_light',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'Logo Light', 'ekommart' ),
						'required' => array( 'site_mode', 'equals', 'light' ),
					),
					array(
						'id'       => 'logo_dark',
						'type'     => 'media',
						'url'      => true,
						'title'    => esc_html__( 'Logo Dark', 'ekommart' ),
						'required' => array( 'site_mode', 'equals', 'dark' ),
					),
					array(
						'id'       => 'logo_size',
						'type'     => 'dimensions',
						'units'    => array('px'),
						'title'    => esc_html__('Logo Size', 'ekommart'),
						'output'   => array('.site-header .site-branding img')
					),
					array(
						'id'     => 'body-background',
						'type'   => 'background',
						'output' => [ 'body' ],
						'title'  => esc_html__( 'Body Background', 'ekommart' ),
					),
				)
			);

			$sections[] = array(
				'title'      => esc_html__( 'Colors', 'ekommart' ),
				'id'         => 'colors',
				'icon'       => 'el el-font',
				'subsection' => true,
				'fields'     => array(
					array(
						'id'     => 'color-primary',
						'type'   => 'link_color',
						'title'  => esc_html__( 'Primary Color', 'ekommart' ),
						'active' => false, // Disable Active Color
					),
					array(
						'id'       => 'color-body',
						'type'     => 'color',
						'title'    => esc_html__( 'Body Color', 'ekommart' ),
						'validate' => 'color',
					),
					array(
						'id'       => 'color-heading',
						'type'     => 'color',
						'title'    => esc_html__( 'Heading Color', 'ekommart' ),
						'validate' => 'color',
					),
					array(
						'id'       => 'color-border',
						'type'     => 'color',
						'title'    => esc_html__( 'Border Color', 'ekommart' ),
						'validate' => 'color',
					),
					array(
						'id'       => 'color-light',
						'type'     => 'color',
						'title'    => esc_html__( 'Light Color', 'ekommart' ),
						'validate' => 'color',
					),
					array(
						'id'       => 'color-dark',
						'type'     => 'color',
						'title'    => esc_html__( 'Dark Color', 'ekommart' ),
						'validate' => 'color',
					),
				)
			);

			$sections[] = array(
				'title'      => esc_html__( 'Typography', 'ekommart' ),
				'id'         => 'typography',
				'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'ekommart' ) . '<a href="//docs.reduxframework.com/core/fields/typography/" target="_blank">docs.reduxframework.com/core/fields/typography/</a>',
				'icon'       => 'el el-font',
				'subsection' => true,
				'fields'     => array(
					array(
						'id'             => 'typography-body',
						'type'           => 'typography',
						'title'          => esc_html__( 'Body', 'ekommart' ),
						'google'         => true,
						'word-spacing'   => true,
						'text-align'     => false,
						'letter-spacing' => true,
						'color'          => false,
						'output'         => [ 'body, button, input, textarea' ]
					),
				)
			);

			return $sections;
		}

        private function get_header_option() {
            $folderes = glob(get_template_directory() . '/template-parts/header/*');

            $folderes_child = glob(get_stylesheet_directory() . '/template-parts/header/*');

            $folderes = array_merge($folderes, $folderes_child);

            $output = array();

            foreach ($folderes as $folder) {
                $key          = str_replace("header-", '', str_replace('.php', '', wp_basename($folder)));
                $value        = str_replace('-', ' ', str_replace('.php', '', wp_basename($folder)));
                $output[$key] = $value;
            }

            return $output;
        }

		public function section_site_header( $sections ) {
			$sections[] = array(
				'title'  => esc_html__( 'Header', 'ekommart' ),
				'id'     => 'header',
				'icon'   => 'el el-credit-card',
				'fields' => array(
					array(
						'id'      => 'header-type',
						'title'   => esc_html__( 'Header Style', 'ekommart' ),
						'type'    => 'select',
                        'options' => $this->get_header_option(),
						'default' => '1',
					),
					array(
						'id'      => 'show-header-search',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show Header Search', 'ekommart' ),
						'default' => true,
						'on'      => esc_html__( 'Yes', 'ekommart' ),
						'off'     => esc_html__( 'No', 'ekommart' ),
					),
					array(
						'id'      => 'show-header-cart',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show Header Cart', 'ekommart' ),
						'default' => true,
						'on'      => esc_html__( 'Yes', 'ekommart' ),
						'off'     => esc_html__( 'No', 'ekommart' ),
					),
					array(
						'id'       => 'header-cart-dropdown',
						'title'    => esc_html__( 'Cart Content', 'ekommart' ),
						'type'     => 'select',
						'options'  => array(
							'side'     => esc_html__( 'Cart Canvas', 'ekommart' ),
							'dropdown' => esc_html__( 'Cart Dropdown', 'ekommart' ),
						),
						'default'  => 'side',
						'required' => array( 'show-header-cart', 'equals', true ),
					),
					array(
						'id'      => 'show-header-account',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show Header Account', 'ekommart' ),
						'default' => true,
						'on'      => esc_html__( 'Yes', 'ekommart' ),
						'off'     => esc_html__( 'No', 'ekommart' ),
					),
					array(
						'id'      => 'show-header-wishlist',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show Header Wishlist', 'ekommart' ),
						'default' => true,
						'on'      => esc_html__( 'Yes', 'ekommart' ),
						'off'     => esc_html__( 'No', 'ekommart' ),
					),
					array(
						'id'      => 'welcome-message',
						'type'    => 'textarea',
						'title'   => esc_html__( 'Welcome Message', 'ekommart' ),
						'default' => 'Welcome to our online store!'
					),
					array(
						'id'    => 'contact-info',
						'type'  => 'textarea',
						'title' => esc_html__( 'Contact Info', 'ekommart' ),
					),
				),
			);
			$sections[] = array(
				'title'      => esc_html__( 'Header Sticky', 'ekommart' ),
				'id'         => 'header-sticky',
				'subsection' => true,
				'fields'     => array(

					array(
						'id'      => 'show-header-sticky',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show Header Sticky', 'ekommart' ),
						'default' => true,
						'on'      => esc_html__( 'Yes', 'ekommart' ),
						'off'     => esc_html__( 'No', 'ekommart' ),
					),
					array(
						'id'       => 'header-sticky-animation',
						'type'     => 'switch',
						'title'    => esc_html__( 'Sticky Animation', 'ekommart' ),
						'desc'     => esc_html__( 'Hide header sticky when scroll down', 'ekommart' ),
						'default'  => true,
						'on'       => esc_html__( 'Yes', 'ekommart' ),
						'off'      => esc_html__( 'No', 'ekommart' ),
						'required' => array( 'show-header-sticky', 'equals', true ),
					),
					array(
						'id'       => 'color-header-sticky',
						'type'     => 'color',
						'validate' => 'color',
						'title'    => esc_html__( 'Color Item', 'ekommart' ),
						'required' => array( 'show-header-sticky', 'equals', true ),
						'output'   => [
							'color' => '.menu-mobile-nav-button, .header-sticky .main-navigation ul > li.menu-item > a, .header-sticky .site-header-account > a i, .header-sticky .site-header-wishlist .header-wishlist i, .header-sticky .site-header-cart .cart-contents::before, .header-sticky .site-header-search > a i',
						]
					),
					array(
						'id'       => 'background-header-sticky',
						'type'     => 'background',
						'title'    => esc_html__( 'Background Header Sticky', 'ekommart' ),
						'required' => array( 'show-header-sticky', 'equals', true ),
						'output'   => [ '.header-sticky' ]
					),
				)

			);

			$sections[] = array(
				'title'      => esc_html__( 'Deal Top Bar', 'ekommart' ),
				'id'         => 'header-deal-topbar',
				'subsection' => true,
				'fields'     => array(
					array(
						'id'      => 'show-deal-topbar',
						'type'    => 'switch',
						'title'   => esc_html__( 'Show Deal Top Bar', 'ekommart' ),
						'default' => 0,
						'on'      => esc_html__( 'Yes', 'ekommart' ),
						'off'     => esc_html__( 'No', 'ekommart' ),
					),
					array(
						'id'       => 'deal-topbar-header',
						'type'     => 'textarea',
						'title'    => esc_html__( 'Deal Title', 'ekommart' ),
						'default'  => 'Black Friday. <strong>Save up to 50%!</strong>',
						'required' => array( 'show-deal-topbar', 'equals', true )
					),

					array(
						'id'       => 'deal-topbar-countdown-text',
						'type'     => 'text',
						'title'    => esc_html__( 'Count Down Title', 'ekommart' ),
						'default'  => 'Deal Ends:',
						'required' => array( 'show-deal-topbar', 'equals', true )
					),

					array(
						'id'       => 'deal-topbar-time',
						'type'     => 'text',
						'title'    => esc_html__( 'Count Down Date', 'ekommart' ),
						'subtitle' => esc_html__( 'Date/time format "MONTH/DAY/YEAR HOUR:MINUTE:SECOND"', 'ekommart' ),
						'split'    => false,
						'required' => array( 'show-deal-topbar', 'equals', true ),
					),

					array(
						'id'       => 'deal-topbar-time-text',
						'type'     => 'text',
						'title'    => esc_html__( 'Button Title', 'ekommart' ),
						'default'  => 'Learn More',
						'required' => array( 'show-deal-topbar', 'equals', true )
					),

					array(
						'id'       => 'deal-topbar-button-link',
						'type'     => 'text',
						'title'    => esc_html__( 'Button Link', 'ekommart' ),
						'default'  => '#',
						'required' => array( 'show-deal-topbar', 'equals', true ),
						'validate' => 'url'
					),
				)
			);


			return $sections;
		}

		public function get_wocommerce_section( $sections ) {

			$sections[] = array(
				'title'  => esc_html__( 'Wocommerce', 'ekommart' ),
				'id'     => 'wocommerce',
				'icon'   => 'el el-cog',
				'fields' => array(
					array(
						'id'      => 'wocommerce_block_style',
						'title'   => esc_html__( 'Product Block Style', 'ekommart' ),
						'type'    => 'select',
						'options' => array(
							'1' => esc_html__( 'Style 1', 'ekommart' ),
							'2' => esc_html__( 'Style 2', 'ekommart' ),
							'3' => esc_html__( 'Style 3', 'ekommart' ),
							'4' => esc_html__( 'Style 4', 'ekommart' ),
							'5' => esc_html__( 'Style 5', 'ekommart' ),
                            '6' => esc_html__( 'Style 6', 'ekommart' ),
						),
						'default' => '1'
					),
					array(
						'id'      => 'woocommerce_product_hover',
						'type'    => 'select',
						'title'   => esc_html__( 'Animation Image Hover', 'ekommart' ),
						// Must provide key => value pairs for select options
						'options' => array(
							'none'          => esc_html__( 'None', 'ekommart' ),
							'bottom-to-top' => esc_html__( 'Bottom to Top', 'ekommart' ),
							'top-to-bottom' => esc_html__( 'Top to Bottom', 'ekommart' ),
							'right-to-left' => esc_html__( 'Right to Left', 'ekommart' ),
							'left-to-right' => esc_html__( 'Left to Right', 'ekommart' ),
							'swap'          => esc_html__( 'Swap', 'ekommart' ),
							'fade'          => esc_html__( 'Fade', 'ekommart' ),
							'zoom-in'       => esc_html__( 'Zoom In', 'ekommart' ),
							'zoom-out'      => esc_html__( 'Zoom Out', 'ekommart' ),
						),
						'default' => 'none',
					)
				)
			);

            $sections[] = array(
                'title'      => esc_html__('Product Image', 'ekommart'),
                'id'         => 'wocommerce-product-image',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'      => 'woocommerce_product_single_width',
                        'type'    => 'dimensions',
                        'units'   => 'px',
                        'title'   => esc_html__('Single Product Width', 'ekommart'),
                        'height'  => false,
                        'default' => ['width' => 800],
                    ),
                    array(
                        'id'      => 'woocommerce_product_thumbnail_width',
                        'type'    => 'dimensions',
                        'units'   => 'px',
                        'title'   => esc_html__('Archive Product Width', 'ekommart'),
                        'height'  => false,
                        'default' => ['width' => 450],
                    ),
                )
            );

			$sections[] = array(
				'title'      => esc_html__( 'Archive Product', 'ekommart' ),
				'id'         => 'wocommerce-archive-product',
				'subsection' => true,
				'fields'     => array(
					array(
						'id'      => 'woocommerce_archive_layout',
						'type'    => 'select',
						'title'   => esc_html__( 'Layout Style', 'ekommart' ),
						// Must provide key => value pairs for select options
						'options' => array(
							'default'      => esc_html__( 'Default', 'ekommart' ),
							'hide-sidebar' => esc_html__( 'Hide Sidebar', 'ekommart' ),
						),
						'default' => 'default',
					),
					array(
						'id'      => 'woocommerce_archive_sidebar',
						'type'    => 'select',
						'title'   => esc_html__( 'Sidebar Position', 'ekommart' ),
						// Must provide key => value pairs for select options
						'options' => array(
							'left'  => esc_html__( 'Left', 'ekommart' ),
							'right' => esc_html__( 'Right', 'ekommart' ),
						),
						'default' => 'left',
					),
				)
			);

			$sections[] = array(
				'title'      => esc_html__( 'Single Product', 'ekommart' ),
				'id'         => 'wocommerce-single-product',
				'subsection' => true,
				'fields'     => array(
					array(
						'id'      => 'wocommerce_single_style',
						'title'   => esc_html__( 'Product Single Style', 'ekommart' ),
						'type'    => 'select',
						'options' => array(
							'1' => esc_html__( 'Style 1', 'ekommart' ),
							'2' => esc_html__( 'Style 2', 'ekommart' ),
						),
						'default' => '1'
					),
					array(
						'id'       => 'single-product-gallery-layout',
						'type'     => 'select',
						'title'    => esc_html__( 'Product gallery layout', 'ekommart' ),
						'options'  => array(
							'horizontal' => esc_html__( 'Horizontal', 'ekommart' ),
							'vertical'   => esc_html__( 'Vertical', 'ekommart' ),
						),
						'default'  => 'horizontal',
						'required' => array( 'wocommerce_single_style', 'equals', '1' ),
					),
				),
			);

            $sections[] = array(
                'title'      => esc_html__( 'Products Deal', 'ekommart' ),
                'id'         => 'wocommerce_deal_of_day',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'      => 'wocommerce_product_deal_ids',
                        'title'   => esc_html__( 'Select products', 'ekommart' ),
                        'type'    => 'select',
                        'data' => 'posts',
                        'args'  => array(
                            'post_type'      => 'product',
                            'posts_per_page' => -1,
                            'orderby'        => 'title',
                            'order'          => 'ASC',
                        ),
                        'multi' => true,
                    ),
                    array(
                        'id'      => 'wocommerce_product_deal_discount_rate',
                        'title'   => esc_html__( 'Discount Rate', 'ekommart' ),
                        'type'    => 'text',
                        'validate' => 'numeric'
                    ),
                    array(
                        'id'      => 'wocommerce_product_deal_discount_sold',
                        'title'   => esc_html__( 'Discount Sold', 'ekommart' ),
                        'type'    => 'text',
                        'validate' => 'numeric'
                    ),
                    array(
                        'id'       => 'wocommerce_product_deal_time',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Sale price dates to', 'ekommart' ),
                        'subtitle' => esc_html__( 'Date format "MONTH/DAY/YEAR"', 'ekommart' ),
                        'split'    => false,
                    ),
                ),
            );

			return $sections;
		}


		public function section_breadcrumb( $sections ) {
			$sections[] = array(
				'title'  => esc_html__( 'Breadcrumb', 'ekommart' ),
				'id'     => 'breadcrumb',
				'icon'   => 'el el-flag',
				'fields' => array(
					array(
						'id'       => 'breadcrumb-default-color',
						'type'     => 'color',
						'title'    => esc_html__( 'Color', 'ekommart' ),
						'validate' => 'color',
						'output'   => [ '.ekommart-breadcrumb, .ekommart-breadcrumb .breadcrumb-heading, .ekommart-breadcrumb a' ],
					),
					array(
						'id'     => 'breadcrumb-default-bg',
						'type'   => 'background',
						'title'  => esc_html__( 'Breadcrumb Background', 'ekommart' ),
						'output' => [ '.ekommart-breadcrumb' ]
					),
				)
			);

			return $sections;
		}

		public function section_blog($sections){
			$sections[] = array(
				'title'  => esc_html__( 'Blog', 'ekommart' ),
				'id'     => 'blog',
				'icon'   => 'el el-blogger',
				'fields' => array(
					array(
						'id'      => 'blog-type',
						'title'   => esc_html__( 'Blog Style', 'ekommart' ),
						'type'    => 'select',
						'options' => array(
							'blog-style-1'	=> esc_html__('Blog Style 1','ekommart'),
							'blog-style-2'	=> esc_html__('Blog Style 2','ekommart'),
							'blog-style-3'	=> esc_html__('Blog Style 3','ekommart'),
							'blog-style-4'	=> esc_html__('Blog Style 4','ekommart'),
							'blog-style-5'	=> esc_html__('Blog Style 5','ekommart'),
						),
						'default' => 'blog-style-3',
					),
				)
			);

			return $sections;
		}

		public function section_social( $sections ) {
			$sections[] = array(
				'title'  => esc_html__( 'Social', 'ekommart' ),
				'id'     => 'social',
				'icon'   => 'el el-globe',
				'fields' => array(
					array(
						'id'       => 'social_text',
						'type'     => 'multi_text',
						'validate' => 'url',
						'title'    => esc_html__( 'Social link', 'ekommart' ),
						'subtitle' => esc_html__( 'Add your social link', 'ekommart' ),
                    ),
					array(
						'id'      => 'social-share',
						'type'    => 'switch',
						'title'   => esc_html__( 'Social Share', 'ekommart' ),
						'default' => true,
						'on'      => esc_html__( 'Yes', 'ekommart' ),
						'off'     => esc_html__( 'No', 'ekommart' ),
					),
					array(
						'id'       => 'social-share-facebook',
						'type'     => 'switch',
						'title'    => esc_html__( 'Share Facebook', 'ekommart' ),
						'default'  => true,
						'on'       => esc_html__( 'Yes', 'ekommart' ),
						'off'      => esc_html__( 'No', 'ekommart' ),
						'required' => array( 'social-share', 'equals', true ),
					),
					array(
						'id'       => 'social-share-twitter',
						'type'     => 'switch',
						'title'    => esc_html__( 'Share Twitter', 'ekommart' ),
						'default'  => true,
						'on'       => esc_html__( 'Yes', 'ekommart' ),
						'off'      => esc_html__( 'No', 'ekommart' ),
						'required' => array( 'social-share', 'equals', true ),
					),
					array(
						'id'       => 'social-share-linkedin',
						'type'     => 'switch',
						'title'    => esc_html__( 'Share Linkedin', 'ekommart' ),
						'default'  => true,
						'on'       => esc_html__( 'Yes', 'ekommart' ),
						'off'      => esc_html__( 'No', 'ekommart' ),
						'required' => array( 'social-share', 'equals', true ),
					),
					array(
						'id'       => 'social-share-google-plus',
						'type'     => 'switch',
						'title'    => esc_html__( 'Share Google Plus', 'ekommart' ),
						'default'  => true,
						'on'       => esc_html__( 'Yes', 'ekommart' ),
						'off'      => esc_html__( 'No', 'ekommart' ),
						'required' => array( 'social-share', 'equals', true ),
					),
					array(
						'id'       => 'social-share-pinterest',
						'type'     => 'switch',
						'title'    => esc_html__( 'Share Pinterest', 'ekommart' ),
						'default'  => true,
						'on'       => esc_html__( 'Yes', 'ekommart' ),
						'off'      => esc_html__( 'No', 'ekommart' ),
						'required' => array( 'social-share', 'equals', true ),
					),
					array(
						'id'       => 'social-share-email',
						'type'     => 'switch',
						'title'    => esc_html__( 'Share Email', 'ekommart' ),
						'default'  => true,
						'on'       => esc_html__( 'Yes', 'ekommart' ),
						'off'      => esc_html__( 'No', 'ekommart' ),
						'required' => array( 'social-share', 'equals', true ),
					),
				)
			);

			return $sections;
		}

		public function section_site_footer( $sections ) {
			global $post;
			$option = array();
			$args   = array(
				'post_type'      => 'elementor_library',
				'posts_per_page' => - 1,
				'orderby'        => 'title',
				's'              => 'FooterBuilder ',
				'order'          => 'ASC',
			);

			$query1 = new WP_Query( $args );
			while ( $query1->have_posts() ) {
				$query1->the_post();
				$option[ $post->post_name ] = $post->post_title;
			}

			$sections[] = array(
				'title'  => esc_html__( 'Footer', 'ekommart' ),
				'id'     => 'footer',
				'icon'   => 'el el-website',
				'fields' => array(
					array(
						'id'      => 'enable-footer-builder',
						'type'    => 'switch',
						'title'   => esc_html__( 'Enable Footer Builder', 'ekommart' ),
						'default' => false,
						'on'      => esc_html__( 'Yes', 'ekommart' ),
						'off'     => esc_html__( 'No', 'ekommart' ),
					),
					array(
						'id'       => 'footer-builder-slug',
						'title'    => esc_html__( 'Footer Builder', 'ekommart' ),
						'type'     => 'select',
						'options'  => $option,
						'required' => array( 'enable-footer-builder', 'equals', true ),
						'default'  => ''
					)
				),
			);

			return $sections;
		}
	}

endif;

return new Ekommart_Options();
