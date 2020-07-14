<?php

class Ekommart_Merlin_Config {

	private $config = [];

	public function __construct() {
		$this->init();
		add_action( 'merlin_import_files', [ $this, 'import_files' ] );
		add_action( 'merlin_after_all_import', [ $this, 'after_import_setup' ], 10, 1 );
		add_filter( 'merlin_generate_child_functions_php', [ $this, 'render_child_functions_php' ] );
	}

	private function init() {
		$wizard = new Merlin(
			$config = array(
				'directory'          => 'inc/merlin',
				// Location / directory where Merlin WP is placed in your theme.
				'merlin_url'         => 'merlin',
				// The wp-admin page slug where Merlin WP loads.
				'parent_slug'        => 'themes.php',
				// The wp-admin parent page slug for the admin menu item.
				'capability'         => 'manage_options',
				// The capability required for this menu to be displayed to the user.
				'dev_mode'           => true,
				// Enable development mode for testing.
				'license_step'       => false,
				// EDD license activation step.
				'license_required'   => false,
				// Require the license activation step.
				'license_help_url'   => '',
				// URL for the 'license-tooltip'.
				'edd_remote_api_url' => '',
				// EDD_Theme_Updater_Admin remote_api_url.
				'edd_item_name'      => '',
				// EDD_Theme_Updater_Admin item_name.
				'edd_theme_slug'     => '',
				// EDD_Theme_Updater_Admin item_slug.
			),
			$strings = array(
				'admin-menu'          => esc_html__( 'Theme Setup', 'ekommart' ),

				/* translators: 1: Title Tag 2: Theme Name 3: Closing Title Tag */
				'title%s%s%s%s'       => esc_html__( '%1$s%2$s Themes &lsaquo; Theme Setup: %3$s%4$s', 'ekommart' ),
				'return-to-dashboard' => esc_html__( 'Return to the dashboard', 'ekommart' ),
				'ignore'              => esc_html__( 'Disable this wizard', 'ekommart' ),

				'btn-skip'                 => esc_html__( 'Skip', 'ekommart' ),
				'btn-next'                 => esc_html__( 'Next', 'ekommart' ),
				'btn-start'                => esc_html__( 'Start', 'ekommart' ),
				'btn-no'                   => esc_html__( 'Cancel', 'ekommart' ),
				'btn-plugins-install'      => esc_html__( 'Install', 'ekommart' ),
				'btn-child-install'        => esc_html__( 'Install', 'ekommart' ),
				'btn-content-install'      => esc_html__( 'Install', 'ekommart' ),
				'btn-import'               => esc_html__( 'Import', 'ekommart' ),
				'btn-license-activate'     => esc_html__( 'Activate', 'ekommart' ),
				'btn-license-skip'         => esc_html__( 'Later', 'ekommart' ),

				/* translators: Theme Name */
				'license-header%s'         => esc_html__( 'Activate %s', 'ekommart' ),
				/* translators: Theme Name */
				'license-header-success%s' => esc_html__( '%s is Activated', 'ekommart' ),
				/* translators: Theme Name */
				'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'ekommart' ),
				'license-label'            => esc_html__( 'License key', 'ekommart' ),
				'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'ekommart' ),
				'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'ekommart' ),
				'license-tooltip'          => esc_html__( 'Need help?', 'ekommart' ),

				/* translators: Theme Name */
				'welcome-header%s'         => esc_html__( 'Welcome to %s', 'ekommart' ),
				'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'ekommart' ),
				'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'ekommart' ),
				'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'ekommart' ),

				'child-header'         => esc_html__( 'Install Child Theme', 'ekommart' ),
				'child-header-success' => esc_html__( 'You\'re good to go!', 'ekommart' ),
				'child'                => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'ekommart' ),
				'child-success%s'      => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'ekommart' ),
				'child-action-link'    => esc_html__( 'Learn about child themes', 'ekommart' ),
				'child-json-success%s' => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'ekommart' ),
				'child-json-already%s' => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'ekommart' ),

				'plugins-header'         => esc_html__( 'Install Plugins', 'ekommart' ),
				'plugins-header-success' => esc_html__( 'You\'re up to speed!', 'ekommart' ),
				'plugins'                => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'ekommart' ),
				'plugins-success%s'      => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'ekommart' ),
				'plugins-action-link'    => esc_html__( 'Advanced', 'ekommart' ),

				'import-header'      => esc_html__( 'Import Content', 'ekommart' ),
				'import'             => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'ekommart' ),
				'import-action-link' => esc_html__( 'Advanced', 'ekommart' ),

				'ready-header'      => esc_html__( 'All done. Have fun!', 'ekommart' ),

				/* translators: Theme Author */
				'ready%s'           => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'ekommart' ),
				'ready-action-link' => esc_html__( 'Extras', 'ekommart' ),
				'ready-big-button'  => esc_html__( 'View your website', 'ekommart' ),
				'ready-link-1'      => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://wordpress.org/support/', esc_html__( 'Explore WordPress', 'ekommart' ) ),
				'ready-link-2'      => sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://themebeans.com/contact/', esc_html__( 'Get Theme Support', 'ekommart' ) ),
				'ready-link-3'      => sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'customize.php' ), esc_html__( 'Start Customizing', 'ekommart' ) ),
			)
		);

		add_action( 'widgets_init', [ $this, 'widgets_init' ] );
	}

	public function render_child_functions_php() {
		$output
			= "<?php
/**
 * Theme functions and definitions.
 */
		 
		 ";

		return $output;
	}

	public function widgets_init() {
		require_once get_parent_theme_file_path( '/inc/merlin/includes/recent-post.php' );
		register_widget( 'Ekommart_WP_Widget_Recent_Posts' );
		if ( ekommart_is_woocommerce_activated() ) {
			require_once get_parent_theme_file_path( '/inc/merlin/includes/class-wc-widget-layered-nav.php' );
			register_widget( 'Ekommart_Widget_Layered_Nav' );
		}
	}

	public function after_import_setup( $selected_import ) {
		$_imports = $this->import_files();
		$selected_import = $_imports[ $selected_import ];
		$check_oneclick  = get_option( 'ekommart_check_oneclick', [] );
		$this->set_demo_menus();
		wp_delete_post( 1, true );

		// setup Home page
		$home = get_page_by_path( $selected_import['home'] );
		if ( $home ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home->ID );
		}

		// Setup Options
		$options = $this->get_all_options();
		foreach ( $options as $key => $option ) {
			if ( count( $options ) > 0 ) {
				foreach ( $option as $k => $v ) {
					update_option( $k, $v );
				}
			}
		}

		if ( count( $check_oneclick ) <= 0 ) {
			$this->setup_mailchimp();
		}

		if ( ! isset( $check_oneclick[ $selected_import['home'] ] ) ) {
			$this->import_revslider( $selected_import['rev_sliders'] );
			$check_oneclick[ $selected_import['home'] ] = true;
			update_option( 'ekommart_check_oneclick', $check_oneclick );
		}

		$this->fixelementor();
	}

	private function fixelementor() {
		$datas = json_decode( file_get_contents( get_parent_theme_file_path( 'dummy-data/ejson.json' ) ), true );
		$query = new WP_Query( array(
			'post_type'      => [
				'page',
				'elementor_library',
			],
			'posts_per_page' => - 1
		) );
		while ( $query->have_posts() ): $query->the_post();
			global $post;
			$postid = get_the_ID();
			if ( get_post_meta( $post->ID, '_elementor_edit_mode', true ) === 'builder' ) {
				$data = json_decode( get_post_meta( $postid, '_elementor_data', true ) );
				if ( ! boolval( $data ) ) {
					if ( isset( $datas[ $post->post_name ] ) ) {
						update_post_meta( $postid, '_elementor_data', wp_slash( wp_json_encode( $datas[ $post->post_name ] ) ) );
					}
				}
			}
		endwhile;
		wp_reset_postdata();
	}

	private function import_revslider( $revsliders ) {
		if ( class_exists( 'RevSliderAdmin' ) ) {
			require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php';
			require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php';
			$my_filesystem = new WP_Filesystem_Direct( array() );

			$revslider = new RevSlider();
			foreach ( $revsliders as $slider ) {
				$pathSlider = trailingslashit( ( wp_upload_dir() )['path'] ) . basename( $slider );
				if ( $this->download_revslider( $my_filesystem, $slider, $pathSlider ) ) {
					$_FILES['import_file']['error']    = UPLOAD_ERR_OK;
					$_FILES['import_file']['tmp_name'] = $pathSlider;
					$revslider->importSliderFromPost( true, 'none' );
				}

			}
		}
	}

	/**
	 * @param $filesystem WP_Filesystem_Direct
	 *
	 * @return bool
	 */
	private function download_revslider( $filesystem, $slider, $pathSlider ) {
		return $filesystem->copy( $slider, $pathSlider, true );
	}

	private function setup_mailchimp() {
		$mailchimp = get_page_by_title( 'Opal MailChimp', OBJECT, 'mc4wp-form' );
		if ( $mailchimp ) {
			update_option( 'mc4wp_default_form_id', $mailchimp->ID );
		}
	}

	public function get_all_options(){
            $options = [];
            $options['elementor'] = array (
  'elementor_scheme_color' =>
  array (
    1 => '#6ec1e4',
    2 => '#54595f',
    3 => '#7a7a7a',
    4 => '#4054B2',
  ),
  'elementor_scheme_typography' =>
  array (
    1 =>
    array (
      'font_family' => '',
      'font_weight' => '',
    ),
    2 =>
    array (
      'font_family' => '',
      'font_weight' => '',
    ),
    3 =>
    array (
      'font_family' => '',
      'font_weight' => '',
    ),
    4 =>
    array (
      'font_family' => '',
      'font_weight' => '',
    ),
  ),
  'elementor_scheme_color-picker' =>
  array (
    1 => '#6ec1e4',
    2 => '#54595f',
    3 => '#7a7a7a',
    4 => '#61ce70',
    5 => '#4054b2',
    6 => '#23a455',
    7 => '#000',
    8 => '#fff',
  ),
  'elementor_allow_tracking' => 'no',
  '_elementor_general_settings' =>
  array (
    'default_generic_fonts' => 'Sans-serif',
    'global_image_lightbox' => 'yes',
    'container_width' => '1290',
    'stretched_section_container' => 'body',
  ),
  'elementor_cpt_support' =>
  array (
    0 => 'post',
    1 => 'page',
    2 => 'product',
    3 => 'ekommart_menu_item',
  ),
  'elementor_disable_color_schemes' => '',
  'elementor_disable_typography_schemes' => '',
  'elementor_default_generic_fonts' => 'Sans-serif',
  'elementor_container_width' => '1290',
  'elementor_space_between_widgets' => '0',
  'elementor_stretched_section_container' => 'body',
  'elementor_page_title_selector' => '',
  'elementor_viewport_lg' => '',
  'elementor_viewport_md' => '',
  'elementor_global_image_lightbox' => 'yes',
  'elementor_css_print_method' => 'external',
  'elementor_editor_break_lines' => '',
  'elementor_allow_svg' => '',
  'elementor_load_fa4_shim' => '',
  'elementor_pro_version' => '2.9.1',
  'elementor_pro_license_key' => 'Licence Hacked',
  '_elementor_pro_installed_time' => '1588663786',
  'elementor_fonts_manager_font_types' =>
  array (
  ),
  'elementor_fonts_manager_fonts' =>
  array (
  ),
  'elementor_custom_icon_sets_config' =>
  array (
  ),
  'elementor_pro_theme_builder_conditions' =>
  array (
  ),
  'elementor_pro_tracker_notice' => '1',
  'elementor_tracker_notice' => '1',
);
            $options['granular'] = array (
  'granular_general_settings' => '',
  'granular_editor_settings' =>
  array (
    'granular_editor_skin' => '',
    'granular_editor_hack_2' => 'no',
    'granular_editor_parallax_on' => 'yes',
    'granular_editor_particles_on' => 'no',
    'granular_editor_exit_on' => 'no',
    'granular_editor_exit_point' => 'editor',
    'granular_editor_exit_target' => '',
    'granular_editor_exit_name' => 'Exit To Dashboard',
    'granular_editor_live_view_name' => 'View Live Page',
  ),
  'granular_advanced_settings' => '',
);
            $options['bcn'] = array (
  'bmainsite_display' => true,
  'Hmainsite_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hmainsite_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'bhome_display' => true,
  'Hhome_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hhome_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'bblog_display' => true,
  'hseparator' => '&lt;',
  'blimit_title' => false,
  'amax_title_length' => 20,
  'bcurrent_item_linked' => false,
  'bpost_page_hierarchy_display' => true,
  'bpost_page_hierarchy_parent_first' => true,
  'Spost_page_hierarchy_type' => 'BCN_POST_PARENT',
  'Hpost_page_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_page_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'apost_page_root' => '308',
  'Hpaged_template' => '<span class=\"%type%\">Page %htitle%</span>',
  'bpaged_display' => false,
  'Hpost_post_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_post_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'apost_post_root' => '581',
  'bpost_post_hierarchy_display' => true,
  'bpost_post_hierarchy_parent_first' => false,
  'bpost_post_taxonomy_referer' => false,
  'Spost_post_hierarchy_type' => 'category',
  'bpost_attachment_archive_display' => true,
  'bpost_attachment_hierarchy_display' => true,
  'bpost_attachment_hierarchy_parent_first' => true,
  'bpost_attachment_taxonomy_referer' => false,
  'Spost_attachment_hierarchy_type' => 'BCN_POST_PARENT',
  'apost_attachment_root' => 0,
  'Hpost_attachment_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_attachment_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'H404_template' => '<span class=\"%type%\">%htitle%</span>',
  'S404_title' => '404',
  'Hsearch_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Search results for &#039;<a property=\"item\" typeof=\"WebPage\" title=\"Go to the first page of search results for %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current>%htitle%</a>&#039;</span><meta property=\"position\" content=\"%position%\"></span>',
  'Hsearch_template_no_anchor' => '<span class=\"%type%\">Search results for &#039;%htitle%&#039;</span>',
  'Htax_post_tag_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% tag archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_post_tag_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'Htax_post_format_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_post_format_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'Hauthor_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">Articles by: <a title=\"Go to the first page of posts by %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current>%htitle%</a></span><meta property=\"position\" content=\"%position%\"></span>',
  'Hauthor_template_no_anchor' => '<span class=\"%type%\">Articles by: %htitle%</span>',
  'Sauthor_name' => 'display_name',
  'aauthor_root' => 0,
  'Htax_category_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% category archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_category_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'Hdate_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hdate_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'bpost_elementor_library_taxonomy_referer' => false,
  'Hpost_elementor_library_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_elementor_library_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'apost_elementor_library_root' => 0,
  'bpost_elementor_library_hierarchy_display' => false,
  'bpost_elementor_library_archive_display' => true,
  'Spost_elementor_library_hierarchy_type' => 'BCN_DATE',
  'bpost_elementor_library_hierarchy_parent_first' => false,
  'bpost_product_taxonomy_referer' => false,
  'Hpost_product_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_product_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'apost_product_root' => 0,
  'bpost_product_hierarchy_display' => true,
  'bpost_product_archive_display' => true,
  'Spost_product_hierarchy_type' => 'product_cat',
  'bpost_product_hierarchy_parent_first' => false,
  'bpost_product_variation_taxonomy_referer' => false,
  'Hpost_product_variation_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_product_variation_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'apost_product_variation_root' => 0,
  'bpost_product_variation_hierarchy_display' => false,
  'bpost_product_variation_archive_display' => false,
  'Spost_product_variation_hierarchy_type' => 'product_shipping_class',
  'bpost_product_variation_hierarchy_parent_first' => false,
  'bpost_shop_order_taxonomy_referer' => false,
  'Hpost_shop_order_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_shop_order_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'apost_shop_order_root' => 0,
  'bpost_shop_order_hierarchy_display' => false,
  'bpost_shop_order_archive_display' => false,
  'Spost_shop_order_hierarchy_type' => 'BCN_DATE',
  'bpost_shop_order_hierarchy_parent_first' => false,
  'bpost_shop_order_refund_taxonomy_referer' => false,
  'Hpost_shop_order_refund_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_shop_order_refund_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'apost_shop_order_refund_root' => 0,
  'bpost_shop_order_refund_hierarchy_display' => false,
  'bpost_shop_order_refund_archive_display' => false,
  'Spost_shop_order_refund_hierarchy_type' => 'BCN_DATE',
  'bpost_shop_order_refund_hierarchy_parent_first' => false,
  'bpost_shop_coupon_taxonomy_referer' => false,
  'Hpost_shop_coupon_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_shop_coupon_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'apost_shop_coupon_root' => 0,
  'bpost_shop_coupon_hierarchy_display' => false,
  'bpost_shop_coupon_archive_display' => false,
  'Spost_shop_coupon_hierarchy_type' => 'BCN_DATE',
  'bpost_shop_coupon_hierarchy_parent_first' => false,
  'bpost_wpcf7_contact_form_taxonomy_referer' => false,
  'Hpost_wpcf7_contact_form_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_wpcf7_contact_form_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'apost_wpcf7_contact_form_root' => 0,
  'bpost_wpcf7_contact_form_hierarchy_display' => false,
  'bpost_wpcf7_contact_form_archive_display' => false,
  'Spost_wpcf7_contact_form_hierarchy_type' => 'BCN_DATE',
  'bpost_wpcf7_contact_form_hierarchy_parent_first' => false,
  'bpost_mc4wp-form_taxonomy_referer' => false,
  'Hpost_mc4wp-form_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to %title%.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Hpost_mc4wp-form_template_no_anchor' => '<span class=\"%type%\">%htitle%</span>',
  'apost_mc4wp-form_root' => 0,
  'bpost_mc4wp-form_hierarchy_display' => false,
  'bpost_mc4wp-form_archive_display' => false,
  'Spost_mc4wp-form_hierarchy_type' => 'BCN_DATE',
  'bpost_mc4wp-form_hierarchy_parent_first' => false,
  'Htax_elementor_library_type_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% Type archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_elementor_library_type_template_no_anchor' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_elementor_library_category_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% Category archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_elementor_library_category_template_no_anchor' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_product_type_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% Tag archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_product_type_template_no_anchor' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_product_visibility_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% Tag archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_product_visibility_template_no_anchor' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_product_cat_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% Category archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_product_cat_template_no_anchor' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_product_tag_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% Tag archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_product_tag_template_no_anchor' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_product_shipping_class_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% Shipping class archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_product_shipping_class_template_no_anchor' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_pa_color_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% Color archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_pa_color_template_no_anchor' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_pa_size_template' => '<span property=\"itemListElement\" typeof=\"ListItem\"><a property=\"item\" typeof=\"WebPage\" title=\"Go to the %title% Size archives.\" href=\"%link%\" class=\"%type%\" bcn-aria-current><span property=\"name\">%htitle%</span></a><meta property=\"position\" content=\"%position%\"></span>',
  'Htax_pa_size_template_no_anchor' => '<span property=\"itemListElement\" typeof=\"ListItem\"><span property=\"name\">%htitle%</span><meta property=\"position\" content=\"%position%\"></span>',
);
            return $options;
        }

	public function set_demo_menus() {
		$main_menu     = get_term_by( 'name', 'Ekommart Main Menu', 'nav_menu' );
		$vertical_menu = get_term_by( 'name', 'All Departments', 'nav_menu' );

		set_theme_mod(
			'nav_menu_locations',
			array(
				'primary'  => $main_menu->term_id,
				'handheld' => $main_menu->term_id,
				'vertical' => $vertical_menu->term_id
			)
		);
	}

	/**
	 * @return array
	 */
	public function import_files(){
            return array(
                array(
					'import_file_name'           => 'home 1',
					'home'                       => 'ekommart-home-1',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-1.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-1/slideshow1.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_1.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-1',
				),

                array(
					'import_file_name'           => 'home 10',
					'home'                       => 'ekommart-home-10',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-10.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-10/slideshow10-1.zip",
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-10/slideshow10.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_10.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-10',
				),

                array(
					'import_file_name'           => 'home 11',
					'home'                       => 'ekommart-home-11',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-11.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-11/slideshow11.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_11.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-11',
				),

                array(
					'import_file_name'           => 'home 12',
					'home'                       => 'ekommart-home-12',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-12.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-12/slideshow12.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_12.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-12',
				),

                array(
					'import_file_name'           => 'home 13',
					'home'                       => 'ekommart-home-13',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-13.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-13/slideshow13.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_13.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-13',
				),

                array(
					'import_file_name'           => 'home 14',
					'home'                       => 'ekommart-home-14',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-14.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_14.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-14',
				),

                array(
					'import_file_name'           => 'home 15',
					'home'                       => 'ekommart-home-15',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-15.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-15/slideshow15.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_15.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-15',
				),

                array(
					'import_file_name'           => 'home 16',
					'home'                       => 'ekommart-home-16',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-16.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-16/slideshow16.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_16.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-16',
				),

                array(
					'import_file_name'           => 'home 17',
					'home'                       => 'ekommart-home-17',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-17.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-17/slideshow17.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_17.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-17',
				),

                array(
					'import_file_name'           => 'home 18',
					'home'                       => 'ekommart-home-18',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-18.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_18.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-18',
				),

                array(
					'import_file_name'           => 'home 19',
					'home'                       => 'ekommart-home-19',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-19.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-19/slider-home19.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_19.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-19',
				),

                array(
					'import_file_name'           => 'home 2',
					'home'                       => 'ekommart-home-2',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-2.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-2/slideshow2.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_2.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-2',
				),

                array(
					'import_file_name'           => 'home 20',
					'home'                       => 'ekommart-home-20',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-20.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-20/slider-home20.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_20.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-20',
				),

                array(
					'import_file_name'           => 'home 21',
					'home'                       => 'ekommart-home-21',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-21.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_21.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-21',
				),

                array(
					'import_file_name'           => 'home 22',
					'home'                       => 'ekommart-home-22',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-22.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-22/slideshow-22.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_22.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-22',
				),

                array(
					'import_file_name'           => 'home 23',
					'home'                       => 'ekommart-home-23',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-23.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-23/slideshow23.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_23.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-23',
				),

                array(
					'import_file_name'           => 'home 3',
					'home'                       => 'ekommart-home-3',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-3.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-3/slideshow3.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_3.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-3',
				),

                array(
					'import_file_name'           => 'home 4',
					'home'                       => 'ekommart-home-4',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-4.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-4/slideshow4.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_4.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-4',
				),

                array(
					'import_file_name'           => 'home 5',
					'home'                       => 'ekommart-home-5',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-5.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-5/slideshow5.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_5.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-5',
				),

                array(
					'import_file_name'           => 'home 6',
					'home'                       => 'ekommart-home-6',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-6.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-6/slideshow6.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_6.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-6',
				),

                array(
					'import_file_name'           => 'home 7',
					'home'                       => 'ekommart-home-7',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-7.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-7/slideshow7.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_7.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-7',
				),

                array(
					'import_file_name'           => 'home 8',
					'home'                       => 'ekommart-home-8',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-8.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-8/slideshow8.zip",
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-8/slideshow81.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_8.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-8',
				),

                array(
					'import_file_name'           => 'home 9',
					'home'                       => 'ekommart-home-9',
					'local_import_file'          => get_theme_file_path('/dummy-data/content.xml'),
					'local_import_widget_file'   => get_theme_file_path('/dummy-data/widgets.json'),
					'local_import_redux'         => array(
						array(
							'file_path'   => get_theme_file_path('/dummy-data/redux/home-9.json'),
							'option_name' => 'ekommart_options',
						),
					),
					'rev_sliders'                => [
                        "http://source.wpopal.com/ekommart/dummy_data/revsliders/ekommart-home-9/slideshow9.zip",
                    ],
					'import_preview_image_url'   => get_theme_file_uri('/assets/images/oneclick/home_9.jpg'),
					'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'ekommart' ),
					'preview_url'                => 'https://demo2.wpopal.com/ekommart/ekommart-home-9',
				),
            );           
        }
}

return new Ekommart_Merlin_Config();
