<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Ekommart' ) ) :

	/**
	 * The main Ekommart class
	 */
	class Ekommart {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'setup' ) );
			add_action( 'wp_head', [ $this, 'preload' ], 1 );
			add_action( 'widgets_init', array( $this, 'widgets_init' ) );
			add_filter( 'ekommart_theme_sidebar', array( $this, 'set_sidebar' ), 20 );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts_addon' ), 5 );
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 10 );
			add_action( 'wp_enqueue_scripts', array( $this, 'child_scripts' ), 30 ); // After WooCommerce.
			add_action( 'enqueue_block_assets', array( $this, 'block_assets' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_assets' ) );
			add_filter( 'body_class', array( $this, 'body_classes' ) );
			add_filter( 'wp_page_menu_args', array( $this, 'page_menu_args' ) );
			add_filter( 'navigation_markup_template', array( $this, 'navigation_markup_template' ) );
			add_action( 'enqueue_embed_scripts', array( $this, 'print_embed_styles' ) );
			add_filter( 'block_editor_settings', array( $this, 'custom_editor_settings' ), 10, 2 );
			add_action( 'tgmpa_register', [ $this, 'register_required_plugins' ] );
		}

		public function preload() {
			get_template_part( 'template-parts/preload' );
		}

		public function register_required_plugins() {
			/**
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$plugins = array(
				array(
					'name'     => 'Elementor',
					'slug'     => 'elementor',
					'required' => true,
				),
				array(
					'name'     => 'Redux Framework',
					'slug'     => 'redux-framework',
					'required' => true,
				),
				array(
					'name'     => 'Granular Controls Elementor',
					'slug'     => 'granular-controls-for-elementor',
					'required' => true,
				),
				array(
					'name'     => 'Woocommerce',
					'slug'     => 'woocommerce',
					'required' => true,
				),
				array(
					'name'     => 'SVG Support',
					'slug'     => 'svg-support',
					'required' => true,
				),
				array(
					'name'     => 'Contact Form 7',
					'slug'     => 'contact-form-7',
					'required' => false,
				),
				array(
					'name'     => 'MailChimp',
					'slug'     => 'mailchimp-for-wp',
					'required' => false,
				),
				array(
					'name'     => 'Slider Revolution',
					'slug'     => 'revslider',
					'required' => true,
					'source'   => esc_url( 'http://source.wpopal.com/plugins/new/revslider.zip' ),
				),
				array(
					'name'     => 'Yith Compare',
					'slug'     => 'yith-woocommerce-compare',
					'required' => false,
				),
				array(
					'name'     => 'Yith Quick View',
					'slug'     => 'yith-woocommerce-quick-view',
					'required' => false,
				),
				array(
					'name'     => 'Yith Wishlist',
					'slug'     => 'yith-woocommerce-wishlist',
					'required' => false,
				),
				array(
					'name'     => 'Woo Variation Swatches',
					'slug'     => 'woo-variation-swatches',
					'required' => false,
				),
			);

			/*
			 * Array of configuration settings. Amend each line as needed.
			 *
			 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
			 * strings available, please help us make TGMPA even better by giving us access to these translations or by
			 * sending in a pull-request with .po file(s) with the translations.
			 *
			 * Only uncomment the strings in the config array if you want to customize the strings.
			 */
			$config = array(
				'id'           => 'ekommart',
				// Unique ID for hashing notices for multiple instances of TGMPA.
				'default_path' => '',
				// Default absolute path to bundled plugins.
				'menu'         => 'tgmpa-install-plugins',
				// Menu slug.
				'has_notices'  => true,
				// Show admin notices or not.
				'dismissable'  => true,
				// If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',
				// If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => false,
				// Automatically activate plugins after installation or not.
				'message'      => '',
			);

			tgmpa( $plugins, $config );
		}

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		public function setup() {

			// Loads wp-content/themes/child-theme-name/languages/ekommart.mo.
			load_theme_textdomain( 'ekommart', get_stylesheet_directory() . '/languages' );

			// Loads wp-content/themes/ekommart/languages/ekommart.mo.
			load_theme_textdomain( 'ekommart', get_template_directory() . '/languages' );

			/**
			 * Add default posts and comments RSS feed links to head.
			 */
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
			 */
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 1000, 565, true );

			add_image_size( 'ekommart-recent-post', 75, 65, true );
			add_image_size( 'ekommart-post-grid', 500, 560, true );
			add_image_size( 'ekommart-post-grid-2', 500, 330, true );
			add_image_size( 'ekommart-post-grid-square', 400, 400, true );


			/**
			 * Register menu locations.
			 */
			register_nav_menus(
				apply_filters(
					'ekommart_register_nav_menus', array(
						'primary'  => esc_html__( 'Primary Menu', 'ekommart' ),
						'handheld' => esc_html__( 'Handheld Menu', 'ekommart' ),
						'vertical' => esc_html__( 'Vertical Menu', 'ekommart' ),
					)
				)
			);

			/*
			 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			 * to output valid HTML5.
			 */
			add_theme_support(
				'html5', apply_filters(
					'ekommart_html5_args', array(
						'search-form',
						'comment-form',
						'comment-list',
						'gallery',
						'caption',
						'widgets',
					)
				)
			);

			/**
			 * Declare support for title theme feature.
			 */
			add_theme_support( 'title-tag' );

			/**
			 * Declare support for selective refreshing of widgets.
			 */
			add_theme_support( 'customize-selective-refresh-widgets' );

			/**
			 * Add support for Block Styles.
			 */
			add_theme_support( 'wp-block-styles' );

			/**
			 * Add support for full and wide align images.
			 */
			add_theme_support( 'align-wide' );

			/**
			 * Add support for editor styles.
			 */
			add_theme_support( 'editor-styles' );

			/**
			 * Add support for editor font sizes.
			 */
			add_theme_support( 'editor-font-sizes', array(
				array(
					'name' => esc_html__( 'Small', 'ekommart' ),
					'size' => 14,
					'slug' => 'small',
				),
				array(
					'name' => esc_html__( 'Normal', 'ekommart' ),
					'size' => 16,
					'slug' => 'normal',
				),
				array(
					'name' => esc_html__( 'Medium', 'ekommart' ),
					'size' => 23,
					'slug' => 'medium',
				),
				array(
					'name' => esc_html__( 'Large', 'ekommart' ),
					'size' => 26,
					'slug' => 'large',
				),
				array(
					'name' => esc_html__( 'Huge', 'ekommart' ),
					'size' => 37,
					'slug' => 'huge',
				),
			) );

			/**
			 * Enqueue editor styles.
			 */
			add_editor_style( array( 'assets/css/base/gutenberg-editor.css', $this->google_fonts() ) );

			/**
			 * Add support for responsive embedded content.
			 */
			add_theme_support( 'responsive-embeds' );
		}

		/**
		 * Register widget area.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
		 */
		public function widgets_init() {
			$sidebar_args['sidebar']        = array(
				'name'        => esc_html__( 'Sidebar Archive', 'ekommart' ),
				'id'          => 'sidebar-blog',
				'description' => '',
			);
			$sidebar_args['sidebar-single'] = array(
				'name'        => esc_html__( 'Sidebar Single Post', 'ekommart' ),
				'id'          => 'sidebar-single',
				'description' => '',
			);

			$rows    = intval( apply_filters( 'ekommart_footer_widget_rows', 1 ) );
			$regions = intval( apply_filters( 'ekommart_footer_widget_columns', 5 ) );

			for ( $row = 1; $row <= $rows; $row ++ ) {
				for ( $region = 1; $region <= $regions; $region ++ ) {
					$footer_n = $region + $regions * ( $row - 1 ); // Defines footer sidebar ID.
					$footer   = sprintf( 'footer_%d', $footer_n );

					if ( 1 === $rows ) {
						/* translators: 1: column number */
						$footer_region_name = sprintf( esc_html__( 'Footer Column %1$d', 'ekommart' ), $region );

						/* translators: 1: column number */
						$footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of the footer.', 'ekommart' ), $region );
					} else {
						/* translators: 1: row number, 2: column number */
						$footer_region_name = sprintf( esc_html__( 'Footer Row %1$d - Column %2$d', 'ekommart' ), $row, $region );

						/* translators: 1: column number, 2: row number */
						$footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of footer row %2$d.', 'ekommart' ), $region, $row );
					}

					$sidebar_args[ $footer ] = array(
						'name'        => $footer_region_name,
						'id'          => sprintf( 'footer-%d', $footer_n ),
						'description' => $footer_region_description,
					);
				}
			}

			$sidebar_args = apply_filters( 'ekommart_sidebar_args', $sidebar_args );

			foreach ( $sidebar_args as $sidebar => $args ) {
				$widget_tags = array(
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<span class="gamma widget-title">',
					'after_title'   => '</span>',
				);

				/**
				 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
				 *
				 * 'ekommart_header_widget_tags'
				 * 'ekommart_sidebar_widget_tags'
				 *
				 * 'ekommart_footer_1_widget_tags'
				 * 'ekommart_footer_2_widget_tags'
				 * 'ekommart_footer_3_widget_tags'
				 * 'ekommart_footer_4_widget_tags'
				 */
				$filter_hook = sprintf( 'ekommart_%s_widget_tags', $sidebar );
				$widget_tags = apply_filters( $filter_hook, $widget_tags );

				if ( is_array( $widget_tags ) ) {
					register_sidebar( $args + $widget_tags );
				}
			}
		}

		public function register_scripts_addon() {
			global $ekommart_version;
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			wp_register_style( 'tooltipster', get_template_directory_uri() . '/assets/css/libs/tooltipster.bundle.min.css', '', $ekommart_version );
			wp_register_script( 'tooltipster', get_template_directory_uri() . '/assets/js/tooltipster.bundle.js', array(), $ekommart_version, true );
			wp_register_script( 'slick', get_template_directory_uri() . '/assets/js/vendor/slick' . $suffix . '.js', array(), $ekommart_version, true );
		}

		/**
		 * Enqueue scripts and styles.
		 *
		 * @since  1.0.0
		 */
		public function scripts() {
			global $ekommart_version;

			/**
			 * Styles
			 */
			wp_enqueue_style( 'ekommart-style', get_template_directory_uri() . '/style.css', '', $ekommart_version );
			wp_style_add_data( 'ekommart-style', 'rtl', 'replace' );

			// Dark Version
			if ( ekommart_get_theme_option( 'site_mode', 'light' ) === 'dark' ) {
				wp_enqueue_style( 'ekommart-dark-style', get_template_directory_uri() . '/assets/css/base/dark.css', '', $ekommart_version );
			}

			// Google Fonts Default
			wp_enqueue_style( 'ekommart-fonts', $this->google_fonts(), array(), null );

			/**
			 * Scripts
			 */
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_enqueue_script( 'ekomart-theme', get_template_directory_uri() . '/assets/js/frontend/main.js', array(
				'jquery',
				'wp-util'
			), $ekommart_version, true );
			wp_localize_script( 'ekomart-theme', 'ekommartAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

			wp_enqueue_script( 'ekommart-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $suffix . '.js', array(), '20130115', true );


			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			wp_register_script( 'ekommart-countdown', get_template_directory_uri() . '/assets/js/frontend/countdown.js', array( 'jquery' ), $ekommart_version, true );
			wp_register_script( 'ekommart-sticky-header', get_template_directory_uri() . '/assets/js/frontend/sticky-header.js', array( 'jquery' ), $ekommart_version, true );
			wp_register_script( 'ekommart-nav-mobile', get_template_directory_uri() . '/assets/js/frontend/nav-mobile.js', array( 'jquery' ), $ekommart_version, true );
			wp_register_script( 'ekommart-deal-topbar', get_template_directory_uri() . '/assets/js/frontend/deal-topbar.js', array(
				'jquery',
				'ekommart-countdown'
			), $ekommart_version, true );
			wp_register_script( 'ekommart-search-popup', get_template_directory_uri() . '/assets/js/frontend/search-popup.js', array( 'jquery' ), $ekommart_version, true );
		}


		/**
		 * Register Google fonts.
		 *
		 * @return string Google fonts URL for the theme.
		 * value : 'londrina-solid' => 'Londrina+Solid:300,400,900',
		 * @since 2.4.0
		 */
		public function google_fonts() {
			$google_fonts = apply_filters( 'ekommart_google_font_families', [] );

			if ( count( $google_fonts ) <= 0 ) {
				return false;
			}

			$query_args = array(
				'family'  => implode( '|', $google_fonts ),
				'subset'  => rawurlencode( 'latin,latin-ext' ),
				'display' => 'swap',
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

			return $fonts_url;
		}

		/**
		 * Enqueue block assets.
		 *
		 * @since 2.5.0
		 */
		public function block_assets() {
			global $ekommart_version;

			// Styles.
			wp_enqueue_style( 'ekommart-gutenberg-blocks', get_template_directory_uri() . '/assets/css/base/gutenberg-blocks.css', '', $ekommart_version );
			wp_style_add_data( 'ekommart-gutenberg-blocks', 'rtl', 'replace' );
		}

		/**
		 * Enqueue supplemental block editor assets.
		 *
		 * @since 2.4.0
		 */
		public function block_editor_assets() {
			global $ekommart_version;

			// JS.
			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
			wp_enqueue_script( 'ekommart-editor', get_template_directory_uri() . '/assets/js/editor' . $suffix . '.js', array(
				'wp-data',
				'wp-dom-ready',
				'wp-edit-post'
			), $ekommart_version, true );
		}

		/**
		 * Enqueue child theme stylesheet.
		 * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
		 * primary css and the separate WooCommerce css.
		 *
		 * @since  1.5.3
		 */
		public function child_scripts() {
			if ( is_child_theme() ) {
				$child_theme = wp_get_theme( get_stylesheet() );
				wp_enqueue_style( 'ekommart-child-style', get_stylesheet_uri(), array(), $child_theme->get( 'Version' ) );
			}
		}

		/**
		 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
		 *
		 * @param array $args Configuration arguments.
		 *
		 * @return array
		 */
		public function page_menu_args( $args ) {
			$args['show_home'] = true;

			return $args;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		public function body_classes( $classes ) {
			global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
			if ( $is_lynx ) {
				$classes[] = 'lynx';
			} elseif ( $is_gecko ) {
				$classes[] = 'gecko';
			} elseif ( $is_opera ) {
				$classes[] = 'opera';
			} elseif ( $is_NS4 ) {
				$classes[] = 'ns4';
			} elseif ( $is_safari ) {
				$classes[] = 'safari';
			} elseif ( $is_chrome ) {
				$classes[] = 'chrome';
			} elseif ( $is_IE ) {
				$classes[] = 'ie';
				if ( preg_match( '/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) ) {
					$classes[] = 'ie' . $browser_version[1];
				}
			}

			if ( $is_iphone ) {
				$classes[] = 'iphone';
			}

			// Adds a class to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			if ( ekommart_get_theme_option( 'header-type', 1 ) == 'side' ) {
				$classes[] = 'ekommart-header-side';
			}

			/**
			 * Adds a class when WooCommerce is not active.
			 *
			 * @todo Refactor child themes to remove dependency on this class.
			 */
			$classes[] = 'no-wc-breadcrumb';

			if ( is_singular( 'post' ) ) {
				if ( ! is_active_sidebar( 'sidebar-single' ) ) {
					$classes[] = 'ekommart-full-width-content';
				}
			} else {
				if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
					$classes[] = 'ekommart-full-width-content';
				}
			}

			// Add class when using homepage template + featured image.
			if ( has_post_thumbnail() ) {
				$classes[] = 'has-post-thumbnail';
			}

			if ( $layout = ekommart_get_theme_option( 'site_layout', 'wide' ) ) {
				$classes[] = 'ekommart-layout-' . $layout;
			}

			if ($blog_style = ekommart_get_theme_option('blog-type')) {
				$classes[] = $blog_style;
			}


			return $classes;
		}

		public function set_sidebar( $name ) {
			if ( is_singular( 'post' ) ) {
				if ( is_active_sidebar( 'sidebar-single' ) ) {
					$name = 'sidebar-single';
				}
			} else {
				if ( is_active_sidebar( 'sidebar-blog' ) ) {
					$name = 'sidebar-blog';
				}
			}

			return $name;
		}

		/**
		 * Adds a custom parameter to the editor settings that is used
		 * to track whether the main sidebar has widgets.
		 *
		 * @param array $settings Default editor settings.
		 * @param WP_Post $post Post being edited.
		 *
		 * @return array Filtered block editor settings.
		 * @since 2.4.3
		 *
		 */
		public function custom_editor_settings( $settings, $post ) {
			$settings['mainSidebarActive'] = false;

			if ( is_active_sidebar( 'sidebar-blog' ) ) {
				$settings['mainSidebarActive'] = true;
			}

			return $settings;
		}

		/**
		 * Custom navigation markup template hooked into `navigation_markup_template` filter hook.
		 */
		public function navigation_markup_template() {
			$template = '<nav id="post-navigation" class="navigation %1$s" role="navigation" aria-label="' . esc_html__( 'Post Navigation', 'ekommart' ) . '">';
			$template .= '<h2 class="screen-reader-text">%2$s</h2>';
			$template .= '<div class="nav-links">%3$s</div>';
			$template .= '</nav>';

			return apply_filters( 'ekommart_navigation_markup_template', $template );
		}

		/**
		 * Add styles for embeds
		 */
		public function print_embed_styles() {
			wp_enqueue_style( 'source-sans-pro', $this->google_fonts() );
			$accent_color     = get_theme_mod( 'ekommart_accent_color' );
			$background_color = ekommart_get_content_background_color();
			?>
			<style type="text/css">
				.wp-embed {
					padding: 2.618em !important;
					border: 0 !important;
					border-radius: 3px !important;
					font-family: "Londrina Solid", "Open Sans", sans-serif !important;
					background-color: <?php echo esc_html( ekommart_adjust_color_brightness( $background_color, -7 ) ); ?> !important;
				}

				.wp-embed .wp-embed-featured-image {
					margin-bottom: 2.618em;
				}

				.wp-embed .wp-embed-featured-image img,
				.wp-embed .wp-embed-featured-image.square {
					min-width: 100%;
					margin-bottom: .618em;
				}

				a.wc-embed-button {
					padding: .857em 1.387em !important;
					font-weight: 600;
					background-color: <?php echo esc_attr( $accent_color ); ?>;
					color: #fff !important;
					border: 0 !important;
					line-height: 1;
					border-radius: 0 !important;
					box-shadow: inset 0 -1px 0 rgba(#000, .3);
				}

				a.wc-embed-button + a.wc-embed-button {
					background-color: #60646c;
				}
			</style>
			<?php
		}

	}
endif;

return new Ekommart();
