<?php
/**
 * Demo import
 * Enable setting up website with a single click
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
 * Beehive_Oneclick_Importer class.
 *
 * @since 1.0.0
 */
class Beehive_Oneclick_Importer {

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
		add_action( 'pt-ocdi/before_content_import', array( $this, 'before_setup' ) );
		add_action( 'pt-ocdi/before_widgets_import', array( $this, 'before_widget_import' ) );
		add_filter( 'pt-ocdi/import_files', array( $this, 'import_demos' ) );
		add_action( 'pt-ocdi/after_import', array( $this, 'setup_theme' ) );
		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
	}

	/**
	 * Import demo
	 *
	 * @access public
	 * @return array
	 * @since 1.0.0
	 */
	public function import_demos() {

		return array(
			array(
				'import_file_name'           => 'Demo 1',
				'import_file_url'            => 'https://themified.com/beehive/demos/demo-1/contents.xml',
				'import_widget_file_url'     => 'https://themified.com/beehive/demos/demo-1/widgets.wie',
				'import_customizer_file_url' => 'https://themified.com/beehive/demos/demo-1/customizer.dat',
				'import_redux'               => array(
					array(
						'file_url'    => 'https://themified.com/beehive/demos/demo-1/options.json',
						'option_name' => Beehive::get_option_name(),
					),
				),
				'import_preview_image_url'   => 'https://themified.com/beehive/demos/screens/demo-1.jpg',
				'preview_url'                => 'https://themified.com/beehive/preview/home-1',
			),
			array(
				'import_file_name'           => 'Demo 2',
				'import_file_url'            => 'https://themified.com/beehive/demos/demo-2/contents.xml',
				'import_widget_file_url'     => 'https://themified.com/beehive/demos/demo-2/widgets.wie',
				'import_customizer_file_url' => 'https://themified.com/beehive/demos/demo-2/customizer.dat',
				'import_redux'               => array(
					array(
						'file_url'    => 'https://themified.com/beehive/demos/demo-2/options.json',
						'option_name' => Beehive::get_option_name(),
					),
				),
				'import_preview_image_url'   => 'https://themified.com/beehive/demos/screens/demo-2.jpg',
				'preview_url'                => 'https://themified.com/beehive/preview/home-2',
			),
			array(
				'import_file_name'           => 'Demo 3',
				'import_file_url'            => 'https://themified.com/beehive/demos/demo-3/contents.xml',
				'import_widget_file_url'     => 'https://themified.com/beehive/demos/demo-3/widgets.wie',
				'import_customizer_file_url' => 'https://themified.com/beehive/demos/demo-3/customizer.dat',
				'import_redux'               => array(
					array(
						'file_url'    => 'https://themified.com/beehive/demos/demo-3/options.json',
						'option_name' => Beehive::get_option_name(),
					),
				),
				'import_preview_image_url'   => 'https://themified.com/beehive/demos/screens/demo-3.jpg',
				'preview_url'                => 'https://themified.com/beehive/preview/home-3',
			),
		);

	}

	/**
	 * Actions after demo import
	 *
	 * @access public
	 * @param array $selected_import demo to import.
	 * @return void
	 * @since 1.0.0
	 */
	public function setup_theme( $selected_import ) {

		// Set menus.
		$this->set_menus();

		// Set the frontpage and blog page.
		$this->show_on_front( $selected_import );

		// Update settings.
		$this->update_permalink_structure();
		$this->allow_registratation();

		// Configure plugins.
		$this->bp_setup();
		$this->rtm_setup();
		$this->wc_setup();
		$this->wpjm_setup();
		$this->setup_wpad();

	}

	/**
	 * Set menus
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function set_menus() {
		$header_menu   = get_term_by( 'name', 'Header Menu', 'nav_menu' );
		$account_menu  = get_term_by( 'name', 'Account Menu', 'nav_menu' );
		$dash_menu     = get_term_by( 'name', 'Dashboard Menu', 'nav_menu' );
		$sidebar_menu  = get_term_by( 'name', 'Sidebar Menu', 'nav_menu' );
		$shop_menu     = get_term_by( 'name', 'Shop Menu', 'nav_menu' );
		$adverts_menu  = get_term_by( 'name', 'Adverts Menu', 'nav_menu' );
		$jobs_menu     = get_term_by( 'name', 'Jobs Menu', 'nav_menu' );
		$forums_menu   = get_term_by( 'name', 'Forums Menu', 'nav_menu' );
		$footer_menu_1 = get_term_by( 'name', 'Footer Menu 1', 'nav_menu' );
		$footer_menu_2 = get_term_by( 'name', 'Footer Menu 2', 'nav_menu' );
		$footer_menu_3 = get_term_by( 'name', 'Footer Menu 3', 'nav_menu' );
		$footer_menu_4 = get_term_by( 'name', 'Footer Menu 4', 'nav_menu' );
		set_theme_mod(
			'nav_menu_locations',
			array(
				'default-navbar'  => $header_menu->term_id,
				'myaccount_menu'  => $account_menu->term_id,
				'panel-menu'      => $dash_menu->term_id,
				'aside-nav-menu'  => $sidebar_menu->term_id,
				'shop_menu'       => $shop_menu->term_id,
				'classified_menu' => $adverts_menu->term_id,
				'jobs_menu'       => $jobs_menu->term_id,
				'forums_menu'     => $forums_menu->term_id,
				'company-menu'    => $footer_menu_1->term_id,
				'community-menu'  => $footer_menu_2->term_id,
				'usefull-menu'    => $footer_menu_3->term_id,
				'legal-menu'      => $footer_menu_4->term_id,
			)
		);
	}

	/**
	 * Set up home and blog page
	 *
	 * @access public
	 * @param array $selected_import demo to import.
	 * @return void
	 * @since 1.0.0
	 */
	public function show_on_front( $selected_import = array() ) {
		if ( empty( $selected_import ) ) {
			return;
		}
		if ( 'Demo 1' === $selected_import['import_file_name'] ) {
			$front_page_id = get_page_by_title( 'Home 1' );
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
		}
		if ( 'Demo 2' === $selected_import['import_file_name'] ) {
			$front_page_id = get_page_by_title( 'Home 2' );
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
		}
		if ( 'Demo 3' === $selected_import['import_file_name'] ) {
			$front_page_id = get_page_by_title( 'Home 3' );
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
		}
		$blog_page_id = get_page_by_title( 'Blog' );
		update_option( 'page_for_posts', $blog_page_id->ID );
	}

	/**
	 * Before content import
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function before_setup() {

		if ( function_exists( 'bp_is_active' ) ) {
			$bp_pages = get_option( 'bp-pages' );
			if ( ! empty( $bp_pages ) ) {
				foreach ( $bp_pages as $page ) {
					wp_delete_post( $page, true );
				}
			}
		}

		if ( class_exists( 'WooCommerce' ) ) {
			$wc_pages   = array();
			$shop       = get_option( 'woocommerce_shop_page_id' );
			$cart       = get_option( 'woocommerce_cart_page_id' );
			$checkout   = get_option( 'woocommerce_checkout_page_id' );
			$account    = get_option( 'woocommerce_myaccount_page_id' );
			$terms      = get_option( 'woocommerce_terms_page_id' );
			$categories = get_page_by_title( 'Product Categories' );
			if ( $shop ) {
				array_push( $wc_pages, $shop );
			}
			if ( $cart ) {
				array_push( $wc_pages, $cart );
			}
			if ( $checkout ) {
				array_push( $wc_pages, $checkout );
			}
			if ( $account ) {
				array_push( $wc_pages, $account );
			}
			if ( $terms ) {
				array_push( $wc_pages, $terms );
			}
			if ( isset( $categories->ID ) && ! empty( $categories->ID ) ) {
				array_push( $wc_pages, $categories->ID );
			}
			if ( ! empty( $wc_pages ) ) {
				foreach ( $wc_pages as $page ) {
					wp_delete_post( $page, true );
				}
			}
		}

		if ( class_exists( 'WP_Job_Manager' ) ) {
			$jm_pages       = array();
			$jobs           = get_option( 'job_manager_jobs_page_id' );
			$submit         = get_option( 'job_manager_submit_job_form_page_id' );
			$dasboard       = get_option( 'job_manager_job_dashboard_page_id' );
			$job_categories = get_page_by_title( 'Job Categories' );
			if ( $jobs ) {
				array_push( $jm_pages, $jobs );
			}
			if ( $jobs ) {
				array_push( $jm_pages, $submit );
			}
			if ( $jobs ) {
				array_push( $jm_pages, $dasboard );
			}
			if ( isset( $job_categories->ID ) && ! empty( $job_categories->ID ) ) {
				array_push( $jm_pages, $job_categories->ID );
			}
			if ( ! empty( $jm_pages ) ) {
				foreach ( $jm_pages as $page ) {
					wp_delete_post( $page, true );
				}
			}
		}

		if ( defined( 'ADVERTS_FILE' ) ) {
			$ad_pages      = array();
			$adverts       = get_page_by_title( 'Adverts' );
			$ad_categories = get_page_by_title( 'Advert Categories' );
			$add_ad        = get_page_by_title( 'Add' );
			$manage_ads    = get_page_by_title( 'Manage' );
			if ( isset( $adverts->ID ) && ! empty( $adverts->ID ) ) {
				array_push( $ad_pages, $adverts->ID );
			}
			if ( isset( $ad_categories->ID ) && ! empty( $ad_categories->ID ) ) {
				array_push( $ad_pages, $ad_categories->ID );
			}
			if ( isset( $add_ad->ID ) && ! empty( $add_ad->ID ) ) {
				array_push( $ad_pages, $add_ad->ID );
			}
			if ( isset( $manage_ads->ID ) && ! empty( $manage_ads->ID ) ) {
				array_push( $ad_pages, $manage_ads->ID );
			}
			if ( ! empty( $ad_pages ) ) {
				foreach ( $ad_pages as $page ) {
					wp_delete_post( $page, true );
				}
			}
			$wpad_options                       = get_option( 'adverts_config' );
			$wpad_options['module']['featured'] = 1;
			update_option( 'adverts_config', $wpad_options );
		}

		if ( class_exists( 'bbPress' ) ) {
			$forum_pages = array();
			$forums      = get_page_by_title( 'Forums' );
			$topics      = get_page_by_title( 'Topics' );
			if ( isset( $forums->ID ) && ! empty( $forums->ID ) ) {
				array_push( $forum_pages, $forums->ID );
			}
			if ( isset( $topics->ID ) && ! empty( $topics->ID ) ) {
				array_push( $forum_pages, $topics->ID );
			}
			if ( ! empty( $forum_pages ) ) {
				foreach ( $forum_pages as $page ) {
					wp_delete_post( $page, true );
				}
			}
		}
	}

	/**
	 * Before widget import
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function before_widget_import() {
		$sidebars_widgets = get_option( 'sidebars_widgets' );
		$all_widgets      = array();
		array_walk_recursive(
			$sidebars_widgets,
			function ( $item, $key ) use ( &$all_widgets ) {
				if ( ! isset( $all_widgets[ $key ] ) ) {
					$all_widgets[ $key ] = $item;
				} else {
					$all_widgets[] = $item;
				}
			}
		);
		if ( isset( $all_widgets['array_version'] ) ) {
			$array_version = $all_widgets['array_version'];
			unset( $all_widgets['array_version'] );
		}
		$new_sidebars_widgets = array_fill_keys( array_keys( $sidebars_widgets ), array() );
		if ( isset( $array_version ) ) {
			$new_sidebars_widgets['array_version'] = $array_version;
		}

		// Update sidebars.
		update_option( 'sidebars_widgets', $new_sidebars_widgets );

	}

	/**
	 * Update permalink structure
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function update_permalink_structure() {
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		update_option( 'rewrite_rules', false );
		$wp_rewrite->flush_rules( true );
	}

	/**
	 * Update option to allow new registration
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function allow_registratation() {
		update_option( 'users_can_register', true );
	}

	/**
	 * Buddypress set up
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function bp_setup() {

		// Return if bp not active.
		if ( ! function_exists( 'bp_is_active' ) ) {
			return;
		}

		// BP pages.
		$activity = get_page_by_title( 'Activity' );
		$members  = get_page_by_title( 'Members' );
		$register = get_page_by_title( 'Register' );
		$activate = get_page_by_title( 'Activate' );
		$groups   = get_page_by_title( 'Groups' );
		$blogs    = get_page_by_title( 'Sites' );

		// IDs.
		$pages = array();
		if ( isset( $activity->ID ) && ! empty( $activity->ID ) ) {
			$pages['activity'] = $activity->ID;
		}
		if ( isset( $members->ID ) && ! empty( $members->ID ) ) {
			$pages['members'] = $members->ID;
		}
		if ( isset( $register->ID ) && ! empty( $register->ID ) ) {
			$pages['register'] = $register->ID;
		}
		if ( isset( $activate->ID ) && ! empty( $activate->ID ) ) {
			$pages['activate'] = $activate->ID;
		}
		if ( isset( $groups->ID ) && ! empty( $groups->ID ) ) {
			$pages['groups'] = $groups->ID;
		}
		if ( isset( $blogs->ID ) && ! empty( $blogs->ID ) ) {
			$pages['blogs'] = $blogs->ID;
		}

		// Update Pages.
		update_option( 'bp-pages', $pages );

		// Add xprofile fields.
		beehive_bp_add_xprofile_birth_date();
		beehive_bp_add_xprofile_sex();
		beehive_bp_add_xprofile_city();
		beehive_bp_add_xprofile_country_list();
	}

	/**
	 * Rtmedia setup
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function rtm_setup() {

		// Return if rtm not active.
		if ( ! class_exists( 'RTMedia' ) ) {
			return;
		}

		// Get options.
		$options = get_option( 'rtmedia-options' );
		if ( ! empty( $options ) ) {
			$options['general_enableComments']              = 1;
			$options['general_enableLikes']                 = 1;
			$options['general_enableGallerysearch']         = 1;
			$options['general_enableLightbox']              = 1;
			$options['general_perPageMedia']                = 30;
			$options['buddypress_enableOnProfile']          = 1;
			$options['buddypress_enableOnGroup']            = 1;
			$options['buddypress_enableOnActivity']         = 1;
			$options['buddypress_enableNotification']       = 1;
			$options['defaultSizes_photo_thumbnail_width']  = 250;
			$options['defaultSizes_photo_thumbnail_height'] = 250;
			$options['defaultSizes_photo_medium_width']     = 450;
			$options['defaultSizes_photo_medium_height']    = 320;
			$options['buddypress_enableOnComment']          = 0;
		}

		// Update options.
		update_option( 'rtmedia-options', $options );
	}

	/**
	 * Woocommerce setup
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function wc_setup() {

		// return if wc is not active.
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		// WC pages.
		$shop     = get_page_by_title( 'Shop' );
		$cart     = get_page_by_title( 'Cart' );
		$checkout = get_page_by_title( 'Checkout' );
		$account  = get_page_by_title( 'My account' );
		$terms    = get_page_by_title( 'Terms and Conditions' );

		// Set up pages.
		if ( isset( $shop->ID ) && ! empty( $shop->ID ) ) {
			update_option( 'woocommerce_shop_page_id', $shop->ID );
		}
		if ( isset( $cart->ID ) && ! empty( $cart->ID ) ) {
			update_option( 'woocommerce_cart_page_id', $cart->ID );
		}
		if ( isset( $checkout->ID ) && ! empty( $checkout->ID ) ) {
			update_option( 'woocommerce_checkout_page_id', $checkout->ID );
		}
		if ( isset( $account->ID ) && ! empty( $account->ID ) ) {
			update_option( 'woocommerce_myaccount_page_id', $account->ID );
		}
		if ( isset( $terms->ID ) && ! empty( $terms->ID ) ) {
			update_option( 'woocommerce_terms_page_id', $terms->ID );
		}

		// Update options.
		update_option( 'woocommerce_enable_guest_checkout', 'no' );
		update_option( 'woocommerce_enable_checkout_login_reminder', 'yes' );
		update_option( 'woocommerce_enable_signup_and_login_from_checkout', 'yes' );
		update_option( 'woocommerce_registration_generate_username', 'no' );
		update_option( 'woocommerce_registration_generate_password', 'no' );

		// Delete transients.
		if ( function_exists( 'wc_delete_product_transients' ) ) {
			wc_delete_product_transients();
		}
		if ( function_exists( 'wc_delete_shop_order_transients' ) ) {
			wc_delete_shop_order_transients();
		}
		if ( function_exists( 'wc_delete_expired_transients' ) ) {
			wc_delete_expired_transients();
		}

	}

	/**
	 * Job manager setup
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function wpjm_setup() {

		// Return if wpjm is not active.
		if ( ! class_exists( 'WP_Job_Manager' ) ) {
			return;
		}

		// wpjm pages.
		$jobs     = get_page_by_title( 'jobs' );
		$submit   = get_page_by_title( 'Post a job' );
		$dasboard = get_page_by_title( 'Job dashboard' );

		// Set up pages.
		if ( isset( $jobs->ID ) && ! empty( $jobs->ID ) ) {
			update_option( 'job_manager_jobs_page_id', $jobs->ID );
		}
		if ( isset( $submit->ID ) && ! empty( $submit->ID ) ) {
			update_option( 'job_manager_submit_job_form_page_id', $submit->ID );
		}
		if ( isset( $dasboard->ID ) && ! empty( $dasboard->ID ) ) {
			update_option( 'job_manager_job_dashboard_page_id', $dasboard->ID );
		}

		// Update options.
		update_option( 'job_manager_per_page', 30 );
		update_option( 'job_manager_generate_username_from_email', 0 );
		update_option( 'job_manager_use_standard_password_setup_email', 0 );

	}

	/**
	 * WP adverts set up
	 *
	 * @access public
	 * @return void
	 * @since 1.0.0
	 */
	public function setup_wpad() {

		// Return if wpadverts is not active.
		if ( ! defined( 'ADVERTS_FILE' ) ) {
			return;
		}

		// Options.
		$options = get_option( 'adverts_config' );
		if ( ! empty( $options ) ) {
			$options['empty_price']                      = 'N/A';
			$options['ads_list_default__display']        = 'list';
			$options['ads_list_default__posts_per_page'] = 30;
			$options['ads_list_default__switch_views']   = 'grid';
		}

		// Update options.
		update_option( 'adverts_config', $options );

	}
}

// Single instance of this class.
Beehive_Oneclick_Importer::instance();
