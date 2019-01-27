<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0.22
 */

if (!defined("KRYPTEX_THEME_FREE")) define("KRYPTEX_THEME_FREE", false);
if (!defined("KRYPTEX_THEME_FREE_WP")) define("KRYPTEX_THEME_FREE_WP", false);

// Theme storage
$KRYPTEX_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'kryptex'),

			// Recommended (supported) plugins fot both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'mailchimp-for-wp'				=> esc_html__('MailChimp for WP', 'kryptex'),
			'woocommerce'					=> esc_html__('WooCommerce', 'kryptex'),
            'gdpr-framework'          => esc_html__('GDPR Framework', 'kryptex'),
            'contact-form-7'          => esc_html__('Contact Form 7', 'kryptex'),
		),

		// List of plugins for PREMIUM version only
		//-----------------------------------------------------
		KRYPTEX_THEME_FREE
			? array(
					// Recommended (supported) plugins for the FREE (lite) version
					// ...
					) 
			: array(
					// Recommended (supported) plugins for the PRO (full) version
					// If plugin not need - comment (or remove) it
					'js_composer'				=> esc_html__('Visual Composer', 'kryptex'),
					'essential-grid'			=> esc_html__('Essential Grid', 'kryptex'),
					'revslider'					=> esc_html__('Revolution Slider', 'kryptex'),
					'trx_donations'				=> esc_html__('ThemeREX Donations', 'kryptex'),
					'cryptocurrency-prices'		=> esc_html__('Cryptocurrency All-in-One', 'kryptex'),
					'm-chart'		            => esc_html__('M Chart', 'kryptex'),
					'cryptocurrency-price-ticker-widget'							=> esc_html__('Cryptocurrency Price Ticker Widget', 'kryptex'),
					'gourl-bitcoin-payment-gateway-paid-downloads-membership'		=> esc_html__('GoUrl Main WordPress Gateway Plugin', 'kryptex'),
					'gourl-woocommerce-bitcoin-altcoin-payment-gateway-addon'		=> esc_html__('Gourl Woocommerce', 'kryptex'),
					'cryptocurrency-rocket-tools'		=> esc_html__('Cryptocurrency Rocket Tools', 'kryptex'),
					'live-crypto'		=> esc_html__('Live Crypto', 'kryptex')
				)
	),

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url' => 'http://kryptex.axiomthemes.com',
	'theme_doc_url'  => 'http://kryptex.axiomthemes.com/doc',

	'theme_video_url' => 'https://www.youtube.com/channel/UCBjqhuwKj3MfE3B6Hg2oA8Q',	// Axiom

	'theme_support_url'  => 'http://axiom.ticksy.com',
	'theme_download_url' => 'https://themeforest.net/item/kryptex-cryptocurrency-mining-wp-theme/20981569'
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('kryptex_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'kryptex_customizer_theme_setup1', 1 );
	function kryptex_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		kryptex_storage_set('settings', array(
			
			'duplicate_options'		=> 'child',		// none  - use separate options for template and child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes
			
			'custmize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame
		
			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// vc (default) - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
			'check_min_version'		=> true,		// Check if exists a .min version of .css and .js and return path to it
													// instead the path to the original file
													// (if debug_mode is off and modification time of the original file < time of the .min file)
			'autoselect_menu'		=> false,		// Show any menu if no menu selected in the location 'main_menu'
													// (for example, the theme is just activated)
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> false		// Allow upload not pre-packaged plugins via TGMPA
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		kryptex_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Work Sans',
				'family' => 'sans-serif',
				'styles' => '100,200,300,400,500,600,700,800,900'		// Parameter 'style' used only for the Google fonts
				),
			array(
				'name'	 => 'Roboto Slab',
				'family' => 'serif',
				'styles' => '100,300,400,700'		// Parameter 'style' used only for the Google fonts
			),
			// Font-face packed with theme
//			array(
//				'name'   => 'Montserrat',
//				'family' => 'sans-serif'
//				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		kryptex_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		kryptex_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'kryptex'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'kryptex'),
				'font-family'		=> '"Work Sans",sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.37em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.45em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'kryptex'),
				'font-family'		=> '"Roboto Slab",serif',
				'font-size' 		=> '3.429em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.1em',
				'margin-bottom'		=> '0.42em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'kryptex'),
				'font-family'		=> '"Roboto Slab",serif',
				'font-size' 		=> '2.571em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.22em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.88em',
				'margin-bottom'		=> '0.57em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'kryptex'),
				'font-family'		=> '"Roboto Slab",serif',
				'font-size' 		=> '2.143em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.22em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '2.53em',
				'margin-bottom'		=> '0.52em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'kryptex'),
				'font-family'		=> '"Roboto Slab",serif',
				'font-size' 		=> '1.714em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '3.15em',
				'margin-bottom'		=> '0.75em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'kryptex'),
				'font-family'		=> '"Roboto Slab",serif',
				'font-size' 		=> '1.286em',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.37em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '3.85em',
				'margin-bottom'		=> '0.6em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'kryptex'),
				'font-family'		=> '"Roboto Slab",serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.38em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '5.2em',
				'margin-bottom'		=> '0.78em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'kryptex'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'kryptex'),
				'font-family'		=> '"Work Sans",sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0.2px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'kryptex'),
				'font-family'		=> '"Work Sans",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.3em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'kryptex'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'kryptex'),
				'font-family'		=> '"Work Sans",sans-serif',
				'font-size' 		=> '1.143em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'kryptex'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'kryptex'),
				'font-family'		=> '"Work Sans",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'kryptex'),
				'description'		=> esc_html__('Font settings of the main menu items', 'kryptex'),
				'font-family'		=> '"Work Sans",sans-serif',
				'font-size' 		=> '16px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'kryptex'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'kryptex'),
				'font-family'		=> '"Work Sans",sans-serif',
				'font-size' 		=> '16px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		kryptex_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> __('Main', 'kryptex'),
							'description'	=> __('Colors of the main content area', 'kryptex')
							),
			'alter'	=> array(
							'title'			=> __('Alter', 'kryptex'),
							'description'	=> __('Colors of the alternative blocks (sidebars, etc.)', 'kryptex')
							),
			'extra'	=> array(
							'title'			=> __('Extra', 'kryptex'),
							'description'	=> __('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'kryptex')
							),
			'inverse' => array(
							'title'			=> __('Inverse', 'kryptex'),
							'description'	=> __('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'kryptex')
							),
			'input'	=> array(
							'title'			=> __('Input', 'kryptex'),
							'description'	=> __('Colors of the form fields (text field, textarea, select, etc.)', 'kryptex')
							),
			)
		);
		kryptex_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> __('Background color', 'kryptex'),
							'description'	=> __('Background color of this block in the normal state', 'kryptex')
							),
			'bg_hover'	=> array(
							'title'			=> __('Background hover', 'kryptex'),
							'description'	=> __('Background color of this block in the hovered state', 'kryptex')
							),
			'bd_color'	=> array(
							'title'			=> __('Border color', 'kryptex'),
							'description'	=> __('Border color of this block in the normal state', 'kryptex')
							),
			'bd_hover'	=>  array(
							'title'			=> __('Border hover', 'kryptex'),
							'description'	=> __('Border color of this block in the hovered state', 'kryptex')
							),
			'text'		=> array(
							'title'			=> __('Text', 'kryptex'),
							'description'	=> __('Color of the plain text inside this block', 'kryptex')
							),
			'text_dark'	=> array(
							'title'			=> __('Text dark', 'kryptex'),
							'description'	=> __('Color of the dark text (bold, header, etc.) inside this block', 'kryptex')
							),
			'text_light'=> array(
							'title'			=> __('Text light', 'kryptex'),
							'description'	=> __('Color of the light text (post meta, etc.) inside this block', 'kryptex')
							),
			'text_link'	=> array(
							'title'			=> __('Link', 'kryptex'),
							'description'	=> __('Color of the links inside this block', 'kryptex')
							),
			'text_hover'=> array(
							'title'			=> __('Link hover', 'kryptex'),
							'description'	=> __('Color of the hovered state of links inside this block', 'kryptex')
							),
			'text_link2'=> array(
							'title'			=> __('Link 2', 'kryptex'),
							'description'	=> __('Color of the accented texts (areas) inside this block', 'kryptex')
							),
			'text_hover2'=> array(
							'title'			=> __('Link 2 hover', 'kryptex'),
							'description'	=> __('Color of the hovered state of accented texts (areas) inside this block', 'kryptex')
							),
			'text_link3'=> array(
							'title'			=> __('Link 3', 'kryptex'),
							'description'	=> __('Color of the other accented texts (buttons) inside this block', 'kryptex')
							),
			'text_hover3'=> array(
							'title'			=> __('Link 3 hover', 'kryptex'),
							'description'	=> __('Color of the hovered state of other accented texts (buttons) inside this block', 'kryptex')
							)
			)
		);
		kryptex_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'kryptex'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',
					'bd_color'			=> '#d0d1d5', //ok
		
					// Text and links colors
					'text'				=> '#929398', //ok
					'text_light'		=> '#b7b7b7',
					'text_dark'			=> '#161b2d', //ok
					'text_link'			=> '#161b2d', //ok
					'text_hover'		=> '#f7941e', //ok
					'text_link2'		=> '#80d572',
					'text_hover2'		=> '#8be77c',
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#f5f5f5', //ok
					'alter_bg_hover'	=> '#e7e7e7',
					'alter_bd_color'	=> '#e7e8ea', //ok
					'alter_bd_hover'	=> '#dadada',
					'alter_text'		=> '#333333',
					'alter_light'		=> '#b7b7b7',
					'alter_dark'		=> '#161b2d', //ok
					'alter_link'		=> '#161b2d',
					'alter_hover'		=> '#f7941e', //ok
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#161b2e', //ok
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#353a57', //ok
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#babbbe', //ok
					'extra_light'		=> '#afafaf',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#72cfd5',
					'extra_hover'		=> '#f7941e', //ok
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',
		
					// Input fields (form's fields and textarea)
					'input_bd_color'	=> '#929398', //ok
					'input_bd_hover'	=> '#161b2d', //ok
					'input_text'		=> '#929398', //ok
					'input_light'		=> '#929398', //ok
					'input_dark'		=> '#161b2d', //ok
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#161b2d',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'kryptex'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#161b2d', //ok
					'bd_color'			=> '#2e3242', //ok
		
					// Text and links colors
					'text'				=> '#929398', //ok
					'text_light'		=> '#5f5f5f',
					'text_dark'			=> '#ffffff', //ok
					'text_link'			=> '#ffffff',
					'text_hover'		=> '#f7941e', //ok
					'text_link2'		=> '#80d572',
					'text_hover2'		=> '#8be77c',
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#121726', //ok
					'alter_bg_hover'	=> '#333333',
					'alter_bd_color'	=> '#464646',
					'alter_bd_hover'	=> '#4a4a4a',
					'alter_text'		=> '#a6a6a6',
					'alter_light'		=> '#5f5f5f',
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#ffaa5f',
					'alter_hover'		=> '#f7941e', //ok
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#161b2e', //ok
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#464646',
					'extra_bd_hover'	=> '#4a4a4a',
					'extra_text'		=> '#a6a6a6',
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#161b2d',
					'extra_hover'		=> '#f7941e',
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bd_color'	=> '#2e2d32',
					'input_bd_hover'	=> '#353535',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#5f5f5f',
					'input_dark'		=> '#ffffff',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#161b2d',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#1d1d1d'
				)
			)
		
		));
		
		// Simple schemes substitution
		kryptex_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('kryptex_customizer_add_theme_colors')) {
	function kryptex_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = kryptex_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = kryptex_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = kryptex_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = kryptex_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = kryptex_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = kryptex_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = kryptex_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = kryptex_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = kryptex_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = kryptex_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['text_dark_07']  = kryptex_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_dark_04']  = kryptex_hex2rgba( $colors['text_dark'], 0.4 );
			$colors['text_link_02']  = kryptex_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = kryptex_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = kryptex_hsb2hex(kryptex_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = kryptex_hsb2hex(kryptex_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_dark_04'] = '{{ data.text_dark_04 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('kryptex_customizer_add_theme_fonts')) {
	function kryptex_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			//$rez[$tag] = $font;
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !kryptex_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !kryptex_is_inherit($font['font-size'])
														? 'font-size:' . kryptex_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !kryptex_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !kryptex_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !kryptex_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !kryptex_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !kryptex_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !kryptex_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !kryptex_is_inherit($font['margin-top'])
														? 'margin-top:' . kryptex_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !kryptex_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . kryptex_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}




//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('kryptex_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'kryptex_customizer_theme_setup' );
	function kryptex_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('kryptex_filter_add_thumb_sizes', array(
			'kryptex-thumb-huge'		=> array(1170, 658, true),
			'kryptex-thumb-big' 		=> array( 770, 465, true), //760, 428
			'kryptex-thumb-med' 		=> array( 370, 208, true),
			'kryptex-thumb-tiny' 		=> array( 100, 100, true),
			'kryptex-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'kryptex-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = kryptex_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'kryptex_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('kryptex_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'kryptex_customizer_image_sizes' );
	function kryptex_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('kryptex_filter_add_thumb_sizes', array(
			'kryptex-thumb-huge'		=> esc_html__( 'Huge image', 'kryptex' ),
			'kryptex-thumb-big'			=> esc_html__( 'Large image', 'kryptex' ),
			'kryptex-thumb-med'			=> esc_html__( 'Medium image', 'kryptex' ),
			'kryptex-thumb-tiny'		=> esc_html__( 'Small square avatar', 'kryptex' ),
			'kryptex-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'kryptex' ),
			'kryptex-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'kryptex' ),
			)
		);
		$mult = kryptex_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'kryptex' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'kryptex_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'kryptex_customizer_trx_addons_add_thumb_sizes');
	function kryptex_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'kryptex_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'kryptex_customizer_trx_addons_get_thumb_size');
	function kryptex_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'kryptex-thumb-huge',
							'kryptex-thumb-huge-@retina',
							'kryptex-thumb-big',
							'kryptex-thumb-big-@retina',
							'kryptex-thumb-med',
							'kryptex-thumb-med-@retina',
							'kryptex-thumb-tiny',
							'kryptex-thumb-tiny-@retina',
							'kryptex-thumb-masonry-big',
							'kryptex-thumb-masonry-big-@retina',
							'kryptex-thumb-masonry',
							'kryptex-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'kryptex_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'kryptex_importer_set_options', 9 );
	function kryptex_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(kryptex_get_protocol() . '://demofiles.axiomthemes.com/kryptex/');
			// Required plugins
			$options['required_plugins'] = array_keys(kryptex_storage_get('required_plugins'));
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title'] = esc_html__('Kryptex Demo', 'kryptex');
			$options['files']['default']['domain_dev'] = '';		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(kryptex_get_protocol().'://kryptex.axiomthemes.com');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			// For example:
			// 		$options['files']['dark_demo'] = $options['files']['default'];
			// 		$options['files']['dark_demo']['title'] = esc_html__('Dark Demo', 'kryptex');
			// Banners
			$options['banners'] = array(
									array(
										'image' => kryptex_get_file_url('theme-specific/theme.about/images/frontpage.png'),
										'title' => esc_html__('Front page Builder', 'kryptex'),
										'content' => wp_kses_post(__('Create your Frontpage right in WordPress Customizer! To do this, you will not need either the Visual Composer or any other Builder. Just turn on/off sections, and fill them with content and decorate to your liking', 'kryptex')),
										'link_url' => esc_url('//www.youtube.com/watch?v=VT0AUbMl_KA'),
										'link_caption' => esc_html__('More about Frontpage Builder', 'kryptex'),
										'duration' => 20
										),
									array(
										'image' => kryptex_get_file_url('theme-specific/theme.about/images/layouts.png'),
										'title' => esc_html__('Custom layouts', 'kryptex'),
										'content' => wp_kses_post(__('Forget about problems with customization of header or footer! You can edit any layout without any changes in CSS or HTML, directly in Visual Builder. Moreover - you can easily create your own headers and footers and use them along with built-in', 'kryptex')),
										'link_url' => esc_url('//www.youtube.com/watch?v=pYhdFVLd7y4'),
										'link_caption' => esc_html__('More about Custom Layouts', 'kryptex'),
										'duration' => 20
										),
									array(
										'image' => kryptex_get_file_url('theme-specific/theme.about/images/documentation.png'),
										'title' => esc_html__('Read full documentation', 'kryptex'),
										'content' => wp_kses_post(__('Need more details? Please check our full online documentation for detailed information on how to use Kryptex', 'kryptex')),
										'link_url' => esc_url(kryptex_storage_get('theme_doc_url')),
										'link_caption' => esc_html__('Online documentation', 'kryptex'),
										'duration' => 15
										),
									array(
										'image' => kryptex_get_file_url('theme-specific/theme.about/images/video-tutorials.png'),
										'title' => esc_html__('Video tutorials', 'kryptex'),
										'content' => wp_kses_post(__('No time for reading documentation? Check out our video tutorials and learn how to customize Kryptex in detail.', 'kryptex')),
										'link_url' => esc_url(kryptex_storage_get('theme_video_url')),
										'link_caption' => esc_html__('Video tutorials', 'kryptex'),
										'duration' => 15
										),
									array(
										'image' => kryptex_get_file_url('theme-specific/theme.about/images/studio.png'),
										'title' => esc_html__('Mockingbird Website Custom studio', 'kryptex'),
										'content' => wp_kses_post(__('We can make a website based on this theme for a very fair price.
We can implement any extra functional: translate your website, WPML implementation and many other customization accoroding to your request.', 'kryptex')),
										'link_url' => esc_url('//mockingbird.ticksy.com/'),
										'link_caption' => esc_html__('Contact us', 'kryptex'),
										'duration' => 25
										)
									);
		}
		return $options;
	}
}




// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('kryptex_create_theme_options')) {

	function kryptex_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'kryptex');

		kryptex_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'kryptex'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'kryptex'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'kryptex'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'kryptex') ),
				"class" => "kryptex_column-1_2 kryptex_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'kryptex'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'kryptex') ),
				"class" => "kryptex_column-1_2",
				"priority" => 40,
				"refresh" => false,
				"std" => 0,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_max_height' => array(
				"title" => esc_html__('Logo max. height', 'kryptex'),
				"desc" => wp_kses_data( __("Max. height of the logo image (in pixels). Maximum size of logo depends on the actual size of the picture", 'kryptex') ),
				"std" => 80,
				"min" => 20,
				"max" => 160,
				"step" => 1,
				"refresh" => false,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "slider"
				),
			// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'kryptex') ),
				"class" => "kryptex_column-1_2",
				"priority" => 70,
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile_header' => array(
				"title" => esc_html__('Logo for the mobile header', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'kryptex') ),
				"class" => "kryptex_column-1_2 kryptex_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_header_retina' => array(
				"title" => esc_html__('Logo for the mobile header for Retina', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'kryptex') ),
				"class" => "kryptex_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'kryptex') ),
				"class" => "kryptex_column-1_2 kryptex_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'kryptex') ),
				"class" => "kryptex_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'kryptex') ),
				"class" => "kryptex_column-1_2 kryptex_new_row",
				"std" => '',
				//"type" => "image"
				"type" => "hidden"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'kryptex') ),
				"class" => "kryptex_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				//"type" => KRYPTEX_THEME_FREE ? "hidden" : "image"
				"type" => "hidden"
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'kryptex'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'kryptex'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'kryptex'),
				"desc" => wp_kses_data( __('Select width of the body content', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'kryptex')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => kryptex_get_list_body_styles(),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'kryptex') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'kryptex')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'kryptex'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'kryptex')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'kryptex'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'kryptex'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'kryptex')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'kryptex'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'kryptex')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'kryptex'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'kryptex') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),


			'general_widgets_info' => array(
				"title" => esc_html__('Additional widgets', 'kryptex'),
				"desc" => '',
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "info",
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'kryptex'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'kryptex')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'kryptex'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'kryptex')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'kryptex'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'kryptex')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'kryptex'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'kryptex')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
				),

			'general_effects_info' => array(
				"title" => esc_html__('Design & Effects', 'kryptex'),
				"desc" => '',
				"type" => "info",
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'kryptex'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'kryptex') ),
				"std" => 0,
//				"type" => "text"
				"type" => "hidden"
				),

			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'kryptex'),
				"desc" => '',
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'kryptex'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'kryptex') ),
				"std" => 0,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'kryptex'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'kryptex') ),
                "std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'kryptex') ),
                "type"  => "text"
            ),
		
		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'kryptex'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'kryptex'),
				"desc" => '',
				"type" => "info"
				),
			'header_type' => array(
				"title" => esc_html__('Header style', 'kryptex'),
				"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'kryptex')
				),
				"std" => 'default',
				"options" => kryptex_get_list_header_footer_types(),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "switch"
				),
			'header_style' => array(
				"title" => esc_html__('Select custom layout', 'kryptex'),
				"desc" => wp_kses_data( __('Select custom header from Layouts Builder', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'kryptex')
				),
				"dependency" => array(
					'header_type' => array('custom')
				),
				"std" => KRYPTEX_THEME_FREE ? 'header-custom-sow-header-default' : 'header-custom-header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'kryptex'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'kryptex')
				),
				"std" => 'default',
				"options" => array(),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "switch"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'kryptex'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'kryptex')
				),
				"std" => 0,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_zoom' => array(
				"title" => esc_html__('Header zoom', 'kryptex'),
				"desc" => wp_kses_data( __("Zoom the header title. 1 - original size", 'kryptex') ),
				"std" => 1,
				"min" => 0.3,
				"max" => 2,
				"step" => 0.1,
				"refresh" => false,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "slider"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'kryptex'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'kryptex')
				),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 1,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_widgets_info' => array(
				"title" => esc_html__('Header widgets', 'kryptex'),
				"desc" => wp_kses_data( __('Here you can place a widget slider, advertising banners, etc.', 'kryptex') ),
				"type" => "info"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'kryptex'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'kryptex'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'kryptex') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'kryptex'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'kryptex')
				),
				"dependency" => array(
					'header_type' => array('default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => kryptex_get_list_range(0,6),
				"type" => "select"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'kryptex'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'kryptex') ),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'kryptex'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'kryptex')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'kryptex'),
					//'left'	=> esc_html__('Left',	'kryptex'),
					//'right'	=> esc_html__('Right',	'kryptex')
				),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'kryptex'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'kryptex')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'kryptex'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'kryptex')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'kryptex'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'kryptex') ),
				"std" => 1,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_image_info' => array(
				"title" => esc_html__('Header image', 'kryptex'),
				"desc" => '',
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "info"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'kryptex'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'kryptex') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'kryptex')
				),
				"std" => 0,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_mobile_info' => array(
				"title" => esc_html__('Mobile header', 'kryptex'),
				"desc" => wp_kses_data( __("Configure the mobile version of the header", 'kryptex') ),
				"priority" => 500,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "info"
				),
			'header_mobile_enabled' => array(
				"title" => esc_html__('Enable the mobile header', 'kryptex'),
				"desc" => wp_kses_data( __("Use the mobile version of the header (if checked) or relayout the current header on mobile devices", 'kryptex') ),
				"std" => 0,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_additional_info' => array(
				"title" => esc_html__('Additional info', 'kryptex'),
				"desc" => wp_kses_data( __('Additional info to show at the top of the mobile header', 'kryptex') ),
				"std" => '',
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"refresh" => false,
				"teeny" => false,
				"rows" => 20,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "text_editor"
				),
			'header_mobile_hide_info' => array(
				"title" => esc_html__('Hide additional info', 'kryptex'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_logo' => array(
				"title" => esc_html__('Hide logo', 'kryptex'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_login' => array(
				"title" => esc_html__('Hide login/logout', 'kryptex'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_search' => array(
				"title" => esc_html__('Hide search', 'kryptex'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_cart' => array(
				"title" => esc_html__('Hide cart', 'kryptex'),
				"std" => 0,
				"dependency" => array(
					'header_mobile_enabled' => array(1)
				),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'kryptex'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_type' => array(
				"title" => esc_html__('Footer style', 'kryptex'),
				"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'kryptex')
				),
				"std" => 'default',
				"options" => kryptex_get_list_header_footer_types(),
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "switch"
				),
			'footer_style' => array(
				"title" => esc_html__('Select custom layout', 'kryptex'),
				"desc" => wp_kses_data( __('Select custom footer from Layouts Builder', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'kryptex')
				),
				"dependency" => array(
					'footer_type' => array('custom')
				),
				"std" => KRYPTEX_THEME_FREE ? 'footer-custom-sow-footer-default' : 'footer-custom-footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'kryptex'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'kryptex')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'kryptex'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'kryptex')
				),
				"dependency" => array(
					'footer_type' => array('default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => kryptex_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'kryptex'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'kryptex') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'kryptex')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'kryptex'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'kryptex') ),
				'refresh' => false,
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'kryptex') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1)
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'kryptex') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1),
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'kryptex'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'kryptex') ),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'kryptex'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'kryptex') ),
				"std" => esc_html__('AxiomThemes &copy; {Y}. All rights reserved.', 'kryptex'),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'kryptex'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'kryptex') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'kryptex'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'kryptex') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'kryptex'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'kryptex'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'kryptex')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'kryptex'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'kryptex') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'kryptex')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				"blog_content" => array( 
					"title" => esc_html__('Posts content', 'kryptex'),
					"desc" => wp_kses_data( __("Display either post excerpts or the full post content", 'kryptex') ),
					"std" => "excerpt",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"options" => array(
						'excerpt'	=> esc_html__('Excerpt',	'kryptex'),
						'fullpost'	=> esc_html__('Full post',	'kryptex')
					),
					"type" => "switch"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'kryptex'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'kryptex') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 60,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'kryptex'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'kryptex') ),
					"std" => 2,
					"options" => kryptex_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'kryptex'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'kryptex') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'kryptex')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'kryptex'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'kryptex') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'kryptex')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'kryptex'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'kryptex') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'kryptex')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'kryptex'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'kryptex') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'kryptex')
					),
					"std" => "links",
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'kryptex'),
						'links'	=> esc_html__("Older/Newest", 'kryptex'),
						'more'	=> esc_html__("Load more", 'kryptex'),
						'infinite' => esc_html__("Infinite scroll", 'kryptex')
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'kryptex'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'kryptex') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'kryptex')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'kryptex'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'kryptex'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'kryptex') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'kryptex'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'kryptex') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'kryptex'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'kryptex') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
	
				'blog_widgets_info' => array(
					"title" => esc_html__('Additional widgets', 'kryptex'),
					"desc" => '',
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "info",
					),
				'widgets_above_page_blog' => array(
					"title" => esc_html__('Widgets at the top of the page', 'kryptex'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'kryptex') ),
					"std" => 'hide',
					"options" => array(),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
					),
				'widgets_above_content_blog' => array(
					"title" => esc_html__('Widgets above the content', 'kryptex'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'kryptex') ),
					"std" => 'hide',
					"options" => array(),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_content_blog' => array(
					"title" => esc_html__('Widgets below the content', 'kryptex'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'kryptex') ),
					"std" => 'hide',
					"options" => array(),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_page_blog' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'kryptex'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'kryptex') ),
					"std" => 'hide',
					"options" => array(),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
					),

				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'kryptex'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'kryptex'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'kryptex') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'kryptex'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'kryptex') ),
					"std" => 5,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'kryptex'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'kryptex') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'kryptex'),
						'columns' => esc_html__('Mini-cards',	'kryptex')
					),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'kryptex'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'kryptex') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'kryptex')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => "none",
					"options" => array(),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'kryptex'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page.", 'kryptex') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'kryptex') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'kryptex')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=0|author=0|share=0|edit=0',
					"options" => array(
						'categories' => esc_html__('Categories', 'kryptex'),
						'date'		 => esc_html__('Post date', 'kryptex'),
						'author'	 => esc_html__('Post author', 'kryptex'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'kryptex'),
						'share'		 => esc_html__('Share links', 'kryptex'),
						'edit'		 => esc_html__('Edit link', 'kryptex')
					),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Views, Likes and Comments', 'kryptex'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'kryptex') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'kryptex')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=1|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'kryptex'),
						'likes' => esc_html__('Likes', 'kryptex'),
						'comments' => esc_html__('Comments', 'kryptex')
					),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'kryptex'),
					"desc" => wp_kses_data( __('Settings of the single post', 'kryptex') ),
					"type" => "section",
					),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'kryptex'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'kryptex') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'kryptex')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'kryptex'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'kryptex') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'kryptex'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'kryptex') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'kryptex'),
					"desc" => wp_kses_data( __("Meta parts for single posts.", 'kryptex') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'kryptex'),
						'date'		 => esc_html__('Post date', 'kryptex'),
						'author'	 => esc_html__('Post author', 'kryptex'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'kryptex'),
						'share'		 => esc_html__('Share links', 'kryptex'),
						'edit'		 => esc_html__('Edit link', 'kryptex')
					),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Views, Likes and Comments', 'kryptex'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'kryptex') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=1|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'kryptex'),
						'likes' => esc_html__('Likes', 'kryptex'),
						'comments' => esc_html__('Comments', 'kryptex')
					),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "checklist"
				),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'kryptex'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'kryptex') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'kryptex'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'kryptex') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'kryptex'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'kryptex'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'kryptex') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'kryptex')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'kryptex'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts showed.', 'kryptex') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => kryptex_get_list_range(1,9),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'kryptex'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'kryptex') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => kryptex_get_list_range(1,4),
					"type" => KRYPTEX_THEME_FREE ? "hidden" : "switch"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'kryptex'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'kryptex'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'kryptex') ),
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'kryptex'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'kryptex')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'kryptex'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'kryptex')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Sidemenu Color Scheme', 'kryptex'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'kryptex')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "switch"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'kryptex'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'kryptex')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'kryptex'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_currency,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'kryptex')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'kryptex'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'kryptex') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'kryptex'),
				"desc" => '',
				"std" => '$kryptex_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'kryptex'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'kryptex') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'kryptex')
				),
				"hidden" => true,
				"std" => '',
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'kryptex'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'kryptex') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'kryptex')
				),
				"hidden" => true,
				"std" => '',
				"type" => KRYPTEX_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			// Use huge priority to call render this elements after all options!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"priority" => 10000,
				"type" => "hidden",
				),

			'last_option' => array(		// Need to manually call action to include Tiny MCE scripts
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'kryptex'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'kryptex'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'kryptex') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'kryptex') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'kryptex'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'kryptex') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'kryptex') ),
				"class" => "kryptex_column-1_3 kryptex_new_row",
				"refresh" => false,
				"std" => '$kryptex_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=kryptex_get_theme_setting('max_load_fonts'); $i++) {
			if (kryptex_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					"title" => esc_html(sprintf(__('Font %s', 'kryptex'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'kryptex'),
				"desc" => '',
				"class" => "kryptex_column-1_3 kryptex_new_row",
				"refresh" => false,
				"std" => '$kryptex_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'kryptex'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'kryptex') )
							: '',
				"class" => "kryptex_column-1_3",
				"refresh" => false,
				"std" => '$kryptex_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'kryptex'),
					'serif' => esc_html__('serif', 'kryptex'),
					'sans-serif' => esc_html__('sans-serif', 'kryptex'),
					'monospace' => esc_html__('monospace', 'kryptex'),
					'cursive' => esc_html__('cursive', 'kryptex'),
					'fantasy' => esc_html__('fantasy', 'kryptex')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'kryptex'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'kryptex') )
								. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'kryptex') )
							: '',
				"class" => "kryptex_column-1_3",
				"refresh" => false,
				"std" => '$kryptex_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = kryptex_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html(sprintf(__('%s settings', 'kryptex'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								// Translators: Add tag's name to make description
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'kryptex'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'kryptex'),
						'100' => esc_html__('100 (Light)', 'kryptex'),
						'200' => esc_html__('200 (Light)', 'kryptex'),
						'300' => esc_html__('300 (Thin)',  'kryptex'),
						'400' => esc_html__('400 (Normal)', 'kryptex'),
						'500' => esc_html__('500 (Semibold)', 'kryptex'),
						'600' => esc_html__('600 (Semibold)', 'kryptex'),
						'700' => esc_html__('700 (Bold)', 'kryptex'),
						'800' => esc_html__('800 (Black)', 'kryptex'),
						'900' => esc_html__('900 (Black)', 'kryptex')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'kryptex'),
						'normal' => esc_html__('Normal', 'kryptex'),
						'italic' => esc_html__('Italic', 'kryptex')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'kryptex'),
						'none' => esc_html__('None', 'kryptex'),
						'underline' => esc_html__('Underline', 'kryptex'),
						'overline' => esc_html__('Overline', 'kryptex'),
						'line-through' => esc_html__('Line-through', 'kryptex')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'kryptex'),
						'none' => esc_html__('None', 'kryptex'),
						'uppercase' => esc_html__('Uppercase', 'kryptex'),
						'lowercase' => esc_html__('Lowercase', 'kryptex'),
						'capitalize' => esc_html__('Capitalize', 'kryptex')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "kryptex_column-1_5",
					"refresh" => false,
					"std" => '$kryptex_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		kryptex_storage_set_array_before('options', 'panel_colors', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			kryptex_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'kryptex'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'kryptex') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'kryptex')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		if (!function_exists('the_custom_logo') || (isset($_REQUEST['page']) && $_REQUEST['page']=='theme_options')) {
			kryptex_storage_set_array_before('options', 'logo_retina', function_exists('the_custom_logo') ? 'custom_logo' : 'logo', array(
				"title" => esc_html__('Logo', 'kryptex'),
				"desc" => wp_kses_data( __('Select or upload the site logo', 'kryptex') ),
				"class" => "kryptex_column-1_2 kryptex_new_row",
				"priority" => 60,
				"std" => '',
				"type" => "image"
				)
			);
		}
	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('kryptex_options_get_list_cpt_options')) {
	function kryptex_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'kryptex'),
						"desc" => '',
						"type" => "info",
						),
					"header_type_{$cpt}" => array(
						"title" => esc_html__('Header style', 'kryptex'),
						"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'kryptex') ),
						"std" => 'inherit',
						"options" => kryptex_get_list_header_footer_types(true),
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "switch"
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'kryptex'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select custom layout to display the site header on the %s pages', 'kryptex'), $title) ),
						"dependency" => array(
							"header_type_{$cpt}" => array('custom')
						),
						"std" => 'inherit',
						"options" => array(),
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'kryptex'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'kryptex'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "switch"
						),
					"header_image_override_{$cpt}" => array(
						"title" => esc_html__('Header image override', 'kryptex'),
						"desc" => wp_kses_data( __("Allow override the header image with the post's featured image", 'kryptex') ),
						"std" => 0,
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "checkbox"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'kryptex'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'kryptex'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'kryptex'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'kryptex'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'kryptex'), $title) ),
						"refresh" => false,
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'kryptex'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'kryptex'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'kryptex'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'kryptex') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'kryptex'),
						"desc" => '',
						"type" => "info",
						),
					"footer_type_{$cpt}" => array(
						"title" => esc_html__('Footer style', 'kryptex'),
						"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'kryptex') ),
						"std" => 'inherit',
						"options" => kryptex_get_list_header_footer_types(true),
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "switch"
						),
					"footer_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'kryptex'),
						"desc" => wp_kses_data( __('Select custom layout to display the site footer', 'kryptex') ),
						"std" => 'inherit',
						"dependency" => array(
							"footer_type_{$cpt}" => array('custom')
						),
						"options" => array(),
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'kryptex'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'kryptex') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'kryptex'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'kryptex') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default'),
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => kryptex_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwide', 'kryptex'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'kryptex') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"widgets_info_{$cpt}" => array(
						"title" => esc_html__('Additional panels', 'kryptex'),
						"desc" => '',
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "info",
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'kryptex'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'kryptex') ),
						"std" => 'hide',
						"options" => array(),
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'kryptex'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'kryptex') ),
						"std" => 'hide',
						"options" => array(),
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'kryptex'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'kryptex') ),
						"std" => 'hide',
						"options" => array(),
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'kryptex'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'kryptex') ),
						"std" => 'hide',
						"options" => array(),
						"type" => KRYPTEX_THEME_FREE ? "hidden" : "select"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('kryptex_options_get_list_choises')) {
	add_filter('kryptex_filter_options_get_list_choises', 'kryptex_options_get_list_choises', 10, 2);
	function kryptex_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = kryptex_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = kryptex_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = kryptex_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (substr($id, -7) == '_scheme')
				$list = kryptex_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = kryptex_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = kryptex_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = kryptex_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = kryptex_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = kryptex_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = kryptex_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = kryptex_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = kryptex_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = kryptex_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = kryptex_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = kryptex_array_merge(array(0 => esc_html__('- Select category -', 'kryptex')), kryptex_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = kryptex_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = kryptex_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = kryptex_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>