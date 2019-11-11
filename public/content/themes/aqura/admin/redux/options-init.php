<?php

/**

 * ReduxFramework Config File

 */



if ( ! class_exists( 'Redux' ) ) {

	return;

}





// This is your option name where all the Redux data is stored.

$opt_name = "aqura_data";



$theme = wp_get_theme(); // For use with some settings. Not necessary.



$args = array(

	// TYPICAL -> Change these values as you need/desire

	'opt_name'             => $opt_name,

	// This is where your data is stored in the database and also becomes your global variable name.

	'display_name'         => $theme->get( 'Name' ),

	// Name that appears at the top of your panel

	'display_version'      => $theme->get( 'Version' ),

	// Version that appears at the top of your panel

	'menu_type'            => 'menu',

	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)

	'allow_sub_menu'       => true,

	// Show the sections below the admin menu item or not

	'menu_title'           => esc_html__( 'AQURA', 'aqura' ),

	'page_title'           => esc_html__( 'AQURA', 'aqura' ),

	// You will need to generate a Google API key to use this feature.

	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth

	'google_api_key'       => 'AIzaSyAq3u-5eik-gXjlPQ3_T5MBvyveHcL6p5U',

	// Set it you want google fonts to update weekly. A google_api_key value is required.

	'google_update_weekly' => false,

	// Must be defined to add google fonts to the typography module

	'async_typography'     => true,

	// Use a asynchronous font on the front end or font string

	// 'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader

	'admin_bar'            => true,

	// Show the panel pages on the admin bar

	'admin_bar_icon'       => 'dashicons-admin-generic',

	// Choose an icon for the admin bar menu

	'admin_bar_priority'   => 50,

	// Choose an priority for the admin bar menu

	'global_variable'      => '',

	// Set a different name for your global variable other than the opt_name

	'dev_mode'             => false,

	// Show the time the page took to load, etc

	'update_notice'        => true,

	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo

	'customizer'           => true,

	// Enable basic customizer support

	//'open_expanded'     => true, // Allow you to start the panel in an expanded way initially.

	//'disable_save_warn' => true, // Disable the save warning when a user changes a field



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

	'page_slug'            => '',

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

	'footer_credit'     => ' ',                   // Disable the footer credit of Redux. Please leave if you can help it.



	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.

	'database'             => '',

	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

	'use_cdn'              => true,

	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.



);



Redux::setArgs( $opt_name, $args );



/*

 * ---> END ARGUMENTS

 */





/*

 *

 * ---> START SECTIONS

 *

 */



// Theme

Redux::setSection( $opt_name, array(

	'title'            => esc_html__( 'Theme', 'aqura' ),

	'id'               => 'aqura_theme',

	'desc'             => esc_html__( "Theme's options.", 'aqura' ),

	'customizer_width' => '400px',

	'icon'             => 'el el-folder-open'

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'Style', 'aqura' ),

	'id'         => 'aqura_theme__style',

	'subsection' => true,

	'fields'     => array(

		array(

			'id'		=> 'aqura_theme__style__bg_color',

			'type'	  	=> 'color',

			'title'	 	=> esc_html__( 'Background Color' , 'aqura' ),

			'default'   => '#fff'

		),

		array(

			'id'       => 'aqura_theme__style__bg_image',

			'type'     => 'media',

			'url'      => true,

			'title'    => esc_html__( 'Background Image', 'aqura' ),

			'compiler' => 'true',

		),

	)

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'AJAX', 'aqura' ),

	'id'         => 'aqura_theme__ajax',

	'subsection' => true,

	'fields'     => array(

		array(

			'id'		=> 'aqura_theme__ajax__on_off',

			'type'	  	=> 'switch',

			'title'	 	=> esc_html__( 'AJAX (Non stop player)' , 'aqura' ),

			'subtitle'	=> esc_html__( 'Enable or disable the ajax functionality.' , 'aqura' ),

			'on'		=> esc_html__( 'Enabled' , 'aqura' ),

			'off'		=> esc_html__( 'Disabled' , 'aqura' ),

			'default' 	=> true

		),

	)

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'API Keys', 'aqura' ),

	'id'         => 'aqura_theme__api',

	'subsection' => true,

	'fields'     => array(

		array(

			'id'		=> 'aqura_theme__api__google_maps',

			'type'	  	=> 'text',

			'title'	 	=> esc_html__( 'Google Maps API Key' , 'aqura' ),

		),

		array(

			'id'		=> 'aqura_theme__api__instagram',

			'type'	  	=> 'text',

			'title'	 	=> esc_html__( 'Instagram Token' , 'aqura' ),

		),

		array(

			'id'		=> 'aqura_theme__api__instagram_user',

			'type'	  	=> 'text',

			'title'	 	=> esc_html__( 'Instagram User ID' , 'aqura' ),

		),

	)

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'Music Player', 'aqura' ),

	'id'         => 'aqura_theme__music_player',

	'subsection' => true,

	'fields'     => array(

		array(

			'id'		=> 'aqura_theme__music_player__on_off',

			'type'	  	=> 'switch',

			'title'	 	=> esc_html__( 'Enable or Disable main music player' , 'aqura' ),

			'subtitle'	=> esc_html__( 'Be aware, if you disable main music player, the others small play triggers will not play the music.' , 'aqura' ),

			'on'		=> esc_html__( 'Enabled' , 'aqura' ),

			'off'		=> esc_html__( 'Disabled' , 'aqura' ),

			'default' 	=> true,

		),

		array(

			'id'       	=> 'aqura_theme__music_player__album',

			'type'     	=> 'select',

			'data' 	   	=> 'posts',

			'args' 	   	=> array('post_type' => array('albums'), 'posts_per_page' => -1),

			'title'    	=> esc_html__( 'Main Playlist Album', 'aqura' ),

			'required' 	=> array(

				'aqura_theme__music_player__on_off',

				'=',

				'true'

			),

		),

		array(

			'id'		=> 'aqura_theme__music_player__bg-color',

			'type'	  	=> 'color_rgba',

			'title'	 	=> esc_html__( 'Player Background Color' , 'aqura' ),

			'default'   => array(
		        'color'     => '#f2f2f2',
		        'alpha'     => 1
		    ),

			'required' 	=> array(

				'aqura_theme__music_player__on_off',

				'=',

				'true'

			),

		),

		array(

			'id'	  	=> 'aqura_theme__music_player__style',

			'type'		=> 'select',

			'title'		=> esc_html__('Select Player Style', 'aqura'),

			'options'  	=> array(

				'1' => esc_html__('01', 'aqura'),

				'2' => esc_html__('02', 'aqura')

			),

			'default'  	=> '1',

			'required' 	=> array(

				'aqura_theme__music_player__on_off',

				'=',

				'true'

			),

		),

	)

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'Mailchimp', 'aqura' ),

	'id'         => 'aqura_theme__mailchimp',

	'subsection' => true,

	'fields'    => array(

		array(

			'id'        => 'mailchimp-list-id',

			'type'      => 'text',

			'title'     => esc_html__('MailChimp List ID', 'aqura'),

		),

		array(

			'id'        => 'mailchimp-api',

			'type'      => 'text',

			'title'     => esc_html__('Mailchimp API Key', 'aqura'),

		),

		array(

			'id'        => 'mailchimp-email-verification',

			'type'      => 'switch',

			'title'     => esc_html__('Verification email', 'aqura'),

			'subtitle'  => esc_html__('Enable or disable the verification email.', 'aqura'),

			'default'   => true

		),

		array(

			'id'        => 'mailchimp-email-send-welcome',

			'type'      => 'switch',

			'title'     => esc_html__('Welcome email', 'aqura'),

			'subtitle'  => esc_html__('Enable or disable the welcome email.', 'aqura'),

			'default'   => true

		),

		array(

			'id'        => 'subscribe_thankyou_page',

			'type'      => 'select',

			'data'      => 'pages',

			'title'     => esc_html__('Thank You Page', 'aqura')

		)

	),

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'Typography', 'aqura' ),

	'id'         => 'aqura_theme__typography',

	'subsection' => true,

	'fields'    => array(

		array(

			'id'        	=> 'typography-menu',

			'type'      	=> 'typography',

			'title'     	=> esc_html__('Menu', 'aqura'),

			'subtitle'		=> esc_html__( 'These settings control the typography for the main menu.' , 'aqura' ),

			'font-size' 	=> false,

			'text-align' 	=> false,

			'line-height' 	=> false,

			'font-backup' 	=> false,

			'font-weight'	=> false,

			'font-style'	=> false,

			'color' 		=> false,

			'output'      	=> array('.burger-menu nav, .trigger-header-type-2 .language a, .trigger-header-type-2 .burger-menu nav ul li a, .trigger-header-type-2 .burger-menu .trigger-header-type-2-copyright a, .burger-menu nav ul li a, .inline-menu ul li a'),

		),

		array(

			'id'        	=> 'typography-body',

			'type'      	=> 'typography',

			'title'     	=> esc_html__('Body', 'aqura'),

			'subtitle'		=> esc_html__( 'These settings control the typography for all body text.' , 'aqura' ),

			'font-size' 	=> false,

			'text-align' 	=> false,

			'line-height' 	=> false,

			'font-backup' 	=> false,

			'font-weight'	=> false,

			'font-style'	=> false,

			'color' 		=> false,

			'output'      	=> array('body, body p, body a, body aside, .hero-title-1 p, a, abbr, acronym, address, applet, article, aside, audio, b, big, blockquote, body, canvas, caption, center, cite, code, dd, del, details, dfn, div, dl, dt, em, embed, fieldset, figcaption, figure, footer, form, h1, h2, h3, h4, h5, h6, header, hgroup, html, i, iframe, img, ins, kbd, label, legend, li, mark, menu, nav, object, ol, output, p, pre, q, ruby, s, samp, section, small, span, strike, strong, summary, table, tbody, td, tfoot, th, thead, time, tr, tt, u, ul, var, video, #clock .label-counter, #clock .text, .blog-type-1 article header .post-meta a, .blog-type-1 article header .post-meta p, .blog-type-1-masonry article header .post-meta a, .blog-type-1-masonry article header .post-meta p, .blog-type-1 article .article-content p, .blog-type-1-masonry article .article-content p, .blog-type-1 article footer a.read-more, .blog-type-1-masonry article footer a.read-more, .home-twitter .twitter-logo a.user, .home-twitter .tweet p, .footer-type-2 .footer-widget .agency li, .footer-type-2 .footer-widget .newsletter form .form-submit input[type=submit], .footer-type-2 .footer-widget .twitter li, .trak-item .name-artist h2, .trak-item .trak-duration, .jp-playlist .about-list .about-available, .jp-playlist .about-list .about-length, .jp-playlist .about-list .about-name, .hero-content-type-1 p, .view-more-type-1, .album-single-type-1 .playlist-single-type-1 .header-playlist .length, .album-single-type-1 .playlist-single-type-1 .header-playlist .name, .album-single-nav-type-1 a small, .album-single-nav-type-1 a span, .album-single-type-2 .single-type-2-description .about p, .album-single-type-2 .single-type-2-description .lyrics .panel-group .panel .panel-title a, .album-covers-4-footer .name, .album-covers-4-footer .name:hover, .blog-single-type-2 .article-header .article-category a, .blog-single-type-2 .article-header .post-meta-header .date time, .blog-single-type-2 .article-header .post-meta-header .author, .blog-single-type-2 .article-header .post-meta-header .comment, .blog-single-type-2 .article-header .post-meta-header .date, .blog-single-type-2 .blog-single-type-2-article article p, .blog-single-type-2 .blog-single-type-2-article .form-type-2 .trigger-form a, .blog-single-type-2 .blog-single-type-2-article .form-type-2 .comment-respond .form-submit input[type=submit], .blog-single-type-2 .blog-single-type-2-article .form-type-2 .comments-section .comments-list .comment article header .comment-meta time, .blog-single-type-2 .blog-single-type-2-article .form-type-2 .comments-section .comments-list .comment article header .comment-content p, .blog-single-type-2 .blog-single-type-2-article .form-type-2 .comments-section .comments-list .comment article header .comment-content .reply a, .blog-list-type-1-aside a, .article-nav-type-1 a, .blog-single-type-1 .post-meta p time, .blog-single-type-1 .post-meta a, .blog-single-type-1 .post-meta p, .blog-single-type-1 .article-post p, .blog-single-type-1 .article-post, .blog-single-type-1 section .author-content p, .form-type-1 form textarea, .form-type-1 form input, .form-type-1 form .form-submit input[type=submit], .woo-products .product .addTo span, .shop-type-1 .result .selectric-wrapper .selectric select, .woo-products .product .price, .shop-single-type-1 .product-info .product-content p, .shop-single-type-1 .product-info .product-content .price span, .shop-single-type-1 .product-info .product-content .cart .addToCart, .shop-single-type-1 .single-woo-tabs .tab-content p, .shop-single-type-1 .comment-respond .form-type-4 textarea, .shop-single-type-1 .comment-respond .form-type-4 input, .shop-single-type-1 .comment-respond .form-type-4 input[type=submit], .shop-single-type-1 .comment-respond .form-type-4 input[type=email], .shop-single-type-1 .comment-respond .form-type-4 input[type=text], .hero-content-type-2 time, .blog-type-1-masonry .blog-type-1-filter .categories a, .album-type-1-masonry .categories ul li a, .album-type-2-masonry .categories ul li a, .album-type-3-masonry .categories ul li a, .single-event-type-1 .single-event-type-1-about .directions li, .single-event-type-1 .single-event-type-1-about .directions li span, .single-event-type-1 .single-event-type-1-about .tickets a, .single-event-type-1 .single-event-type-1-about p, .single-event-type-1 .single-event-type-1-about .share li, .single-event-type-1 .single-event-type-1-about .share li a, .full-bgk-parallax-albums .content .content-info p, .full-bgk-parallax-albums .content .content-info .social-icons a.details-social'),

		),

		array(

			'id'        	=> 'typography-h1',

			'type'      	=> 'typography',

			'title'     	=> esc_html__('H1', 'aqura'),

			'subtitle'		=> esc_html__( 'These settings control the typography for all H1 Headers.' , 'aqura' ),

			'font-size' 	=> false,

			'text-align' 	=> false,

			'line-height' 	=> false,

			'font-backup' 	=> false,

			'font-weight'	=> false,

			'font-style'	=> false,

			'color' 		=> false,

			'output'      	=> array('body h1, body h1 *, .hero-content-type-1 h1, .hero-title-3 h1 span, .hero-title-3 h1, .blog-single-type-2 .article-header h1, .blog-single-type-1 .title h1, .shop-single-type-1 .product-info .product-content h1, .hero-content-type-2 h1, .single-event-type-1 .single-event-type-1-about h1, .section-title-2 .underline-2'),

		),

		array(

			'id'        	=> 'typography-h2',

			'type'      	=> 'typography',

			'title'     	=> esc_html__('H2', 'aqura'),

			'subtitle'		=> esc_html__( 'These settings control the typography for all H2 Headers.' , 'aqura' ),

			'font-size' 	=> false,

			'text-align' 	=> false,

			'line-height' 	=> false,

			'font-backup' 	=> false,

			'font-weight'	=> false,

			'font-style'	=> false,

			'color' 		=> false,

			'output'      	=> array('body h2, body h2 *, .related.products h2, .upsells.products h2, .full-bgk-parallax-albums .content h2'),

		),

		array(

			'id'        	=> 'typography-h3',

			'type'      	=> 'typography',

			'title'     	=> esc_html__('H3', 'aqura'),

			'subtitle'		=> esc_html__( 'These settings control the typography for all H3 Headers.' , 'aqura' ),

			'font-size' 	=> false,

			'text-align' 	=> false,

			'line-height' 	=> false,

			'font-backup' 	=> false,

			'font-weight'	=> false,

			'font-style'	=> false,

			'color' 		=> false,

			'output'      	=> array('body h3, body h3 *, .blog-single-type-2 .blog-single-type-2-article .form-type-2 .comment-respond h3, .blog-single-type-2 .blog-single-type-2-article article h3, .blog-single-type-1 section .author-content h3 a, .form-type-1 h3, .form-type-1 h3, .woo-products .product .name'),

		),

		array(

			'id'        	=> 'typography-h4',

			'type'      	=> 'typography',

			'title'     	=> esc_html__('H4', 'aqura'),

			'subtitle'		=> esc_html__( 'These settings control the typography for all H4 Headers.' , 'aqura' ),

			'font-size' 	=> false,

			'text-align' 	=> false,

			'line-height' 	=> false,

			'font-backup' 	=> false,

			'font-weight'	=> false,

			'font-style'	=> false,

			'color' 		=> false,

			'output'      	=> array('body h4, body h3 *, .footer-type-2 .footer-widget h4, .album-single-type-1 .sidebar-albums-type-1 .widget h4, .album-single-type-2 .single-type-2-description .title h4, .album-single-type-2 .sidebar-albums-type-2 .widget h4, .shop-single-type-1 .single-woo-tabs .nav li a, .shop-single-type-1 .single-woo-tabs .nav li.active a, .shop-single-type-1 .comment-respond h4, .single-event-type-1 .single-event-type-1-about h4'),

		),

		array(

			'id'        	=> 'typography-h5',

			'type'      	=> 'typography',

			'title'     	=> esc_html__('H5', 'aqura'),

			'subtitle'		=> esc_html__( 'These settings control the typography for all H5 Headers.' , 'aqura' ),

			'font-size' 	=> false,

			'text-align' 	=> false,

			'line-height' 	=> false,

			'font-backup' 	=> false,

			'font-weight'	=> false,

			'font-style'	=> false,

			'color' 		=> false,

			'output'      	=> array('body h5, body h5 *'),

		),

		array(

			'id'        	=> 'typography-h6',

			'type'      	=> 'typography',

			'title'     	=> esc_html__('H6', 'aqura'),

			'subtitle'		=> esc_html__( 'These settings control the typography for all H6 Headers.' , 'aqura' ),

			'font-size' 	=> false,

			'text-align' 	=> false,

			'line-height' 	=> false,

			'font-backup' 	=> false,

			'font-weight'	=> false,

			'font-style'	=> false,

			'color' 		=> false,

			'output'      	=> array('body h6, body h6 *, .footer-type-2 .footer-widget .newsletter h6, .blog-single-type-2 .blog-single-type-2-article .form-type-2 .comments-section .comments-list .comment article header .comment-meta h6'),

		),

	),

) );



// Header

Redux::setSection( $opt_name, array(

	'title'            => esc_html__( 'Header', 'aqura' ),

	'id'               => 'aqura_header',

	'desc'             => esc_html__( "Header's options.", 'aqura' ),

	'customizer_width' => '450px',

	'icon'             => 'el el-arrow-up'

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'Style', 'aqura' ),

	'id'         => 'aqura_header__style',

	'subsection' => true,

	'fields'     => array(

		array(

			'id'       => 'aqura_header__style__select',

			'type'     => 'select',

			'title'    => esc_html__( 'Header Style', 'aqura' ),

			'subtitle' => esc_html__( 'Select the header style for the theme.', 'aqura' ),

			//Must provide key => value pairs for select options

			'options'  => array(

				'1' => esc_html__( 'Style 01' , 'aqura' ),

				'2' => esc_html__( 'Style 02' , 'aqura' ),

				'3' => esc_html__( 'Style 03' , 'aqura' ),

			),

			'default'  => '1'

		),

		array(

			'id'       => 'aqura_header__style__menu_copyrights',

			'type'     => 'editor',

			'url'      => true,

			'title'    => esc_html__( 'Copyrights Text', 'aqura' ),

			'compiler' => 'true',

			'default'  => '	<a href="#">2017 Aqura WordPress Theme. All Rights Reserved</a>

							<a href="#">Made By Theme - Brothers</a>',

			'required' => array(

				'aqura_header__style__select',

				'=',

				'3'

			)

		),

	)

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'Logo & Favicon', 'aqura' ),

	'id'         => 'aqura_header__logo_favicon',

	'subsection' => true,

	'fields'     => array(

		array(

			'id'       => 'aqura_header__logo_favicon__light_logo',

			'type'     => 'media',

			'url'      => true,

			'title'    => esc_html__( 'Light Logo', 'aqura' ),

			'compiler' => 'true',

			'default'  => array(

				'url' => AQURA_IMAGES . '/header/light-logo.png'

			),

		),

		array(

			'id'       => 'aqura_header__logo_favicon__dark_logo',

			'type'     => 'media',

			'url'      => true,

			'title'    => esc_html__( 'Dark Logo', 'aqura' ),

			'compiler' => 'true',

			'default'  => array(

				'url' => AQURA_IMAGES . '/header/dark-logo.png'

			),

		),

		array(

			'id'       => 'aqura_header__logo_favicon__favicon',

			'type'     => 'media',

			'url'      => true,

			'title'    => esc_html__( 'Favicon', 'aqura' ),

			'desc'	   => esc_html__( 'An .ico file named "favicon" (80x80 px) that will show in the browsers tab and feed.' , 'aqura' ),

			'compiler' => 'true',

			'default'  => array(

				'url' => AQURA_IMAGES . '/favicon.ico'

			),

		),

	)

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'Social Icons', 'aqura' ),

	'id'         => 'aqura_header__social_icons',

	'subsection' => true,

	'fields'     => array(

		array(

			'id'		=> 'aqura_header__social_icons__on_off',

			'type'	  	=> 'switch',

			'title'	 	=> esc_html__( 'Social Icons' , 'aqura' ),

			'subtitle'	=> esc_html__( 'Hide or Show the social icons.' , 'aqura' ),

			'on'		=> esc_html__( 'Show' , 'aqura' ),

			'off'		=> esc_html__( 'Hide' , 'aqura' ),

			'default' 	=> true

		),

		array(

			'id'       => 'aqura_header__social_icons__icon',

			'type'     => 'multi_text',

			'title'    => esc_html__( 'Social Icons', 'aqura' ),

			'subtitle' => esc_html__( 'Shortcde base: [aqura_menu_social_icon icon="fa-facebook" href="#" /]' , 'aqura' ),

			'default'  => array(

				'[aqura_menu_social_icon icon="fa-facebook" href="#" /]',

				'[aqura_menu_social_icon icon="fa-apple" href="#" /]',

				'[aqura_menu_social_icon icon="fa-soundcloud" href="#" /]'

			),

			'required' => array(

				'aqura_header__social_icons__on_off',

				'=',

				true

			)

		),

	)

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'Header Image', 'aqura' ),

	'id'         => 'aqura_header__header_image',

	'subsection' => true,

	'fields'     => array(

		array(

			'id'		=> 'aqura_header__header_image__on_off',

			'type'	  	=> 'switch',

			'title'	 	=> esc_html__( 'Header Image' , 'aqura' ),

			'subtitle'	=> esc_html__( 'Hide or Show the Header Image.' , 'aqura' ),

			'on'		=> esc_html__( 'Show' , 'aqura' ),

			'off'		=> esc_html__( 'Hide' , 'aqura' ),

			'default' 	=> true

		),

		array(

			'id'       => 'aqura_header__header_image__image',

			'type'     => 'media',

			'url'      => true,

			'title'    => esc_html__( 'Header Image Background', 'aqura' ),

			'compiler' => 'true',

			'default'  => array(

				'url' => AQURA_IMAGES . '/content/header-image-default.jpg'

			),

			'required' => array(

				'aqura_header__header_image__on_off',

				'=',

				true

			)

		),

		array(

			'id'       => 'aqura_header__header_image__title',

			'type'     => 'text',

			'url'      => true,

			'title'    => esc_html__( 'Header Image Title', 'aqura' ),

			'compiler' => 'true',

			'default'  => esc_html__( 'Title' , 'aqura' ),

			'required' => array(

				'aqura_header__header_image__on_off',

				'=',

				true

			),

		),

		array(

			'id'       => 'aqura_header__header_image__text',

			'type'     => 'editor',

			'url'      => true,

			'title'    => esc_html__( 'Header Image Text', 'aqura' ),

			'compiler' => 'true',

			'required' => array(

				'aqura_header__header_image__on_off',

				'=',

				true

			),

			'default'  => esc_html__( 	'Your time is limited, don’t waste it living someone else’s life. Don’t be trapped by dogma, which is living the result of other people’s thinking. Don’t let the noise of other opinions drown your own inner voice.' , 'aqura' ),

		),

		array(

			'id'       => 'aqura_header__header_image__view_more_text',

			'type'     => 'text',

			'url'      => true,

			'title'    => esc_html__( 'Header Image View More Text', 'aqura' ),

			'compiler' => 'true',

			'default'  => esc_html__( 'View More' , 'aqura' ),

			'required' => array(

				'aqura_header__header_image__on_off',

				'=',

				true

			),

		),

	)

) );





// Footer

Redux::setSection( $opt_name, array(

	'title'            => esc_html__( 'Footer', 'aqura' ),

	'id'               => 'aqura_footer',

	'desc'             => esc_html__( "Footer's options.", 'aqura' ),

	'customizer_width' => '500px',

	'icon'             => 'el el-arrow-down'

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'Style', 'aqura' ),

	'id'         => 'aqura_footer__style',

	'subsection' => true,

	'fields'     => array(

		array(

			'id'       => 'aqura_footer__style__layout',

			'type'     => 'select',

			'title'    => esc_html__( 'Footer Layout', 'aqura' ),

			'subtitle' => esc_html__( 'Select the footer style.', 'aqura' ),

			'options'  => array(

				'1' => esc_html__( 'Style 01' , 'aqura' ),

				'2' => esc_html__( 'Style 02' , 'aqura' ),

			),

			'default'  => '1'

		),

		array(

			'id'		=> 'aqura_footer__style__bg_color',

			'type'	  	=> 'color',

			'title'	 	=> esc_html__( 'Footer Background Color' , 'aqura' ),

			'default'   => '#eeeeee',

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'1'

			),

		),

		array(

			'id'		=> 'aqura_footer__copyrights__on_off',

			'type'	  	=> 'switch',

			'title'	 	=> esc_html__( 'Copyrights Text' , 'aqura' ),

			'subtitle'	=> esc_html__( 'Hide or Show the copyrights text.' , 'aqura' ),

			'on'		=> esc_html__( 'Show' , 'aqura' ),

			'off'		=> esc_html__( 'Hide' , 'aqura' ),

			'default' 	=> true,

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'1',

			),

		),

		array(

			'id'       => 'aqura_footer__copyrights__text',

			'type'     => 'textarea',

			'title'    => esc_html__( 'Copyrights Text Content' , 'aqura' ),

			'default'  => esc_html__( 'AQURA' , 'aqura' ),

			'required' => array(

				'aqura_footer__copyrights__on_off',

				'=',

				true,

			),

		),

		array(

			'id'       => 'aqura_footer__copyrights__link',

			'type'     => 'text',

			'title'    => esc_html__( 'Copyrights Link' , 'aqura' ),

			'default'  => '#',

			'required' => array(

				'aqura_footer__copyrights__on_off',

				'=',

				true,

			),

		),

		array(

			'id'		=> 'aqura_footer__social_icons__on_off',

			'type'	  	=> 'switch',

			'title'	 	=> esc_html__( 'Social Icons' , 'aqura' ),

			'subtitle'	=> esc_html__( 'Hide or Show the social icons.' , 'aqura' ),

			'on'		=> esc_html__( 'Show' , 'aqura' ),

			'off'		=> esc_html__( 'Hide' , 'aqura' ),

			'default' 	=> true,

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'1',

			),

		),

		array(

			'id'       => 'aqura_footer__social_icons__icon',

			'type'     => 'multi_text',

			'title'    => esc_html__( 'Social Icons', 'aqura' ),

			'subtitle' => esc_html__( 'Shortcde base: [aqura_footer_social_icon icon="fa-facebook" href="#" /]' , 'aqura' ),

			'default'  => array(

				'[aqura_footer_social_icon icon="fa-twitter" href="#" /]',

				'[aqura_footer_social_icon icon="fa-facebook" href="#" /]',

				'[aqura_footer_social_icon icon="fa-apple" href="#" /]',

				'[aqura_footer_social_icon icon="fa-lastfm" href="#" /]',

				'[aqura_footer_social_icon icon="fa-soundcloud" href="#" /]',

				'[aqura_footer_social_icon icon="fa-youtube" href="#" /]',

				'[aqura_footer_social_icon icon="fa-vimeo" href="#" /]',

			),

			'required' => array(

				'aqura_footer__social_icons__on_off',

				'=',

				true,

			),

		),

		array(

			'id'		=> 'aqura_footer__go_to_top__on_off',

			'type'	  	=> 'switch',

			'title'	 	=> esc_html__( 'Go To Top' , 'aqura' ),

			'subtitle'	=> esc_html__( 'Hide or Show the "Go To Top" button.' , 'aqura' ),

			'on'		=> esc_html__( 'Show' , 'aqura' ),

			'off'		=> esc_html__( 'Hide' , 'aqura' ),

			'default' 	=> true,

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'1',

			),

		),

		array(

			'id'       => 'aqura_footer__go_to_top__text',

			'type'     => 'text',

			'title'    => esc_html__( 'Go To Top Button Text', 'aqura' ),

			'default'  => esc_html__( 'Go Top' , 'aqura' ),

			'required' => array(

				'aqura_footer__go_to_top__on_off',

				'=',

				true,

			),

		),

		array(

			'id'       => 'aqura_footer__background_image',

			'type'     => 'media',

			'url'      => true,

			'title'    => esc_html__( 'Footer Background Image', 'aqura' ),

			'compiler' => 'true',

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'2',

			),

		),

		array(

			'id'		=> 'aqura_footer__background_color',

			'type'	  	=> 'color',

			'title'	 	=> esc_html__( 'Footer Background Color' , 'aqura' ),

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'2',

			),

		),

		array(

			'id'       => 'aqura_footer__logo',

			'type'     => 'media',

			'url'      => true,

			'title'    => esc_html__( 'Footer Logo', 'aqura' ),

			'compiler' => 'true',

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'2',

			),

		),

		array(

			'id'       => 'aqura_footer__contact__management',

			'type'     => 'text',

			'title'    => esc_html__( 'Management Email', 'aqura' ),

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'2',

			),

		),

		array(

			'id'       => 'aqura_footer__contact__booking',

			'type'     => 'text',

			'title'    => esc_html__( 'Booking Email', 'aqura' ),

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'2',

			),

		),

		array(

			'id'       => 'aqura_footer__contact__phone',

			'type'     => 'text',

			'title'    => esc_html__( 'Contact Phone', 'aqura' ),

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'2',

			),

		),

		array(

			'id'       => 'aqura_footer__contact__icons',

			'type'     => 'multi_text',

			'title'    => esc_html__( 'Social Icons', 'aqura' ),

			'subtitle' => esc_html__( 'Shortcde base: [aqura_footer_social_icon icon="fa-facebook" href="#" /]' , 'aqura' ),

			'default'  => array(

				'[aqura_footer_social_icon icon="fa-twitter" href="#" /]',

				'[aqura_footer_social_icon icon="fa-facebook" href="#" /]',

				'[aqura_footer_social_icon icon="fa-apple" href="#" /]',

				'[aqura_footer_social_icon icon="fa-lastfm" href="#" /]',

				'[aqura_footer_social_icon icon="fa-soundcloud" href="#" /]',

				'[aqura_footer_social_icon icon="fa-youtube" href="#" /]',

				'[aqura_footer_social_icon icon="fa-vimeo" href="#" /]',

			),

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'2',

			),

		),

		array(

			'id'       => 'aqura_footer__twitter_user',

			'type'     => 'text',

			'title'    => esc_html__( 'Twitter User', 'aqura' ),

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'2',

			),

		),

		array(

			'id'       => 'aqura_footer__twitter_number_of_posts',

			'type'     => 'text',

			'title'    => esc_html__( 'Number Of Tweets Displayed', 'aqura' ),

			'required' => array(

				'aqura_footer__style__layout',

				'=',

				'2',

			),

		),

	)

) );





// Loader

Redux::setSection( $opt_name, array(

	'title'            => esc_html__( 'Loader', 'aqura' ),

	'id'               => 'aqura_loader',

	'desc'             => esc_html__( "Loader's options.", 'aqura' ),

	'customizer_width' => '550px',

	'icon'             => 'el el-refresh'

) );



Redux::setSection( $opt_name, array(

	'title'      => esc_html__( 'Style', 'aqura' ),

	'id'         => 'aqura_loader__style',

	'subsection' => true,

	'fields'     => array(

		array(

			'id'		=> 'aqura_loader__style__bg_color',

			'type'	  	=> 'color',

			'title'	 	=> esc_html__( 'Loader Background Color' , 'aqura' ),

			'default'   => '#fff'

		),

		array(

			'id'       => 'aqura_loader__style__loader',

			'type'     => 'media',

			'url'      => true,

			'title'    => esc_html__( 'Loader GIF', 'aqura' ),

			'desc'	   => esc_html__( 'An .gif file for loader animation.' , 'aqura' ),

			'compiler' => 'true',

			'default'  => array(

				'url' => AQURA_IMAGES . '/gif/loader.gif'

			),

		),

	)

) );





// Divide

Redux::setSection( $opt_name, array(

	'id'   =>'aqura_bottom_divide',

	'type' => 'divide'

) );

/*

 * <--- END SECTIONS

 */