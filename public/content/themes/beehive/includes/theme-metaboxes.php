<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'cmb2_tabs_' with your project's prefix.
 *
 * @category WordPress_Plugin
 * @package  Demo_CMB2_Tabs
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     https://github.com/stackadroit/cmb2-extensions
 */

/**
 * Initiate cmb2 metaboxes.
 *
 * @since 1.0.0
 */
add_action( 'cmb2_admin_init', 'cmb2_tabs_load_library', 5 );
add_action( 'cmb2_admin_init', 'beehive_metaboxes' );
add_action( 'cmb2_admin_init', 'beehive_post_only_metabox' );

/**
 * Load cmb2 tabs library
 *
 * @return void
 */
function cmb2_tabs_load_library() {
	require_once BEEHIVE_INC . '/metabox-tabs/metabox-tabs.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object.
 *
 * @return bool             True if metabox should show
 */
function cmb2_tabs_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}

/**
 * Theme metaboxes
 * Renders both on posts and pages
 *
 * @return void
 * @sice 1.0.0
 */
function beehive_metaboxes() {

	// Meta Prefix.
	$meta_prefix = beehive()->get_meta_prefix();

	// Metabox Field container.
	$custom_fields = new_cmb2_box(
		array(
			'id'           => $meta_prefix . 'metabox',
			'title'        => esc_html__( 'Meta Options', 'beehive' ),
			'object_types' => array( 'page', 'post' ),
			/** Post type */
			'tabs'         => array(
				'header'    => array(
					'label'      => esc_html__( 'Header', 'beehive' ),
					'show_on_cb' => 'cmb2_tabs_show_if_front_page',
				),
				'title-bar' => array(
					'label' => esc_html__( 'Title Bar', 'beehive' ),
					'icon'  => 'dashicons-admin-page',
				),
				'page'      => array(
					'label' => esc_html__( 'Page', 'beehive' ),
					'icon'  => 'dashicons-admin-page',
				),
				'sidebar'   => array(
					'label' => esc_html__( 'Sidebars', 'beehive' ),
					'icon'  => 'dashicons-laptop',
				),
				'footer'    => array(
					'label' => esc_html__( 'Footer', 'beehive' ),
					'icon'  => 'dashicons-pressthis',
				),
			),
		)
	);

	// Header display metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Show/Hide', 'beehive' ),
			'desc'          => esc_html__( 'Show or hide header on this page.', 'beehive' ),
			'id'            => $meta_prefix . 'show-header',
			'type'          => 'select',
			'default'       => '',
			'tab'           => 'header',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'options'       => array(
				'show' => esc_html__( 'Show', 'beehive' ),
				'hide' => esc_html__( 'Hide', 'beehive' ),
				''     => esc_html__( 'default', 'beehive' ),
			),
		)
	);

	// Upload logo metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Upload Logo', 'beehive' ),
			'desc'          => esc_html__( 'Upload logo if you want to override default logo on this page.', 'beehive' ),
			'id'            => $meta_prefix . 'logo',
			'type'          => 'file',
			'query_args'    => array(
				'type' => array( 'image/gif', 'image/jpeg', 'image/png' ),
			),
			'tab'           => 'header',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'show_on_cb'    => false,
		)
	);

	// Upload logo metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Mobile Logo', 'beehive' ),
			'desc'          => esc_html__( 'Use different logo in mobile devices on this page. Note: This option only works on default header.', 'beehive' ),
			'id'            => $meta_prefix . 'mobile-logo',
			'type'          => 'file',
			'query_args'    => array(
				'type' => array( 'image/gif', 'image/jpeg', 'image/png' ),
			),
			'tab'           => 'header',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'show_on_cb'    => false,
		)
	);

	// Fluid header metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Fluid Menu', 'beehive' ),
			'desc'          => esc_html__( 'Want to have fluid menu on this page?', 'beehive' ),
			'id'            => $meta_prefix . 'fluid-header',
			'type'          => 'select',
			'default'       => '',
			'tab'           => 'header',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'options'       => array(
				'1' => esc_html__( 'Yes', 'beehive' ),
				'0' => esc_html__( 'No', 'beehive' ),
				''  => esc_html__( 'Default', 'beehive' ),
			),
		)
	);

	// Fixed header metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Fixed at Top', 'beehive' ),
			'desc'          => esc_html__( 'Menu fixed at top', 'beehive' ),
			'id'            => $meta_prefix . 'fixed-nav',
			'type'          => 'select',
			'default'       => '',
			'tab'           => 'header',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'options'       => array(
				'1' => esc_html__( 'Yes', 'beehive' ),
				'0' => esc_html__( 'No', 'beehive' ),
				''  => esc_html__( 'Default', 'beehive' ),
			),
		)
	);

	// Overlay header metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Overlay Header', 'beehive' ),
			'desc'          => esc_html__( 'Check this for overlay header.', 'beehive' ),
			'id'            => $meta_prefix . 'overlay-header',
			'type'          => 'checkbox',
			'tab'           => 'header',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
		)
	);

	// Overlay header metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Menu Color White', 'beehive' ),
			'desc'          => esc_html__( 'Check this if you want to turn menu colors into white.', 'beehive' ),
			'id'            => $meta_prefix . 'navbar-color',
			'type'          => 'checkbox',
			'tab'           => 'header',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
		)
	);

	// Desktop humbergur menu metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Humbergur Menu', 'beehive' ),
			'desc'          => esc_html__( 'Enable humbergur menu on desktop. Note: This option only works on default header.', 'beehive' ),
			'id'            => $meta_prefix . 'desktop-slidenav',
			'type'          => 'checkbox',
			'tab'           => 'header',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
		)
	);

	// Title bar metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Remove Title Bar', 'beehive' ),
			'desc'          => esc_html__( 'Check to remove title section from this page.', 'beehive' ),
			'id'            => $meta_prefix . 'remove-title-bar',
			'type'          => 'checkbox',
			'tab'           => 'title-bar',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
		)
	);

	// Page title metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Page Title', 'beehive' ),
			'desc'          => esc_html__( 'Display page title?', 'beehive' ),
			'id'            => $meta_prefix . 'page-title',
			'type'          => 'select',
			'default'       => '',
			'tab'           => 'title-bar',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'options'       => array(
				'1' => esc_html__( 'Yes', 'beehive' ),
				'0' => esc_html__( 'No', 'beehive' ),
				''  => esc_html__( 'Default', 'beehive' ),
			),
		)
	);

	// Page title metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Breadcrumb', 'beehive' ),
			'desc'          => esc_html__( 'Display breadcrumb?', 'beehive' ),
			'id'            => $meta_prefix . 'breadcrumb',
			'type'          => 'select',
			'default'       => '',
			'tab'           => 'title-bar',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'options'       => array(
				'1' => esc_html__( 'Yes', 'beehive' ),
				'0' => esc_html__( 'No', 'beehive' ),
				''  => esc_html__( 'Default', 'beehive' ),
			),
		)
	);

	// Select sidebar metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Select Sidebar', 'beehive' ),
			'desc'          => esc_html__( 'The sidebar you select must have widgets assigned to it. Also please note: for templates that are full width ( Such as Full Width ), this option is irrelevant.', 'beehive' ),
			'id'            => $meta_prefix . 'page-sidebar',
			'type'          => 'select',
			'default'       => '',
			'tab'           => 'sidebar',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'options'       => array( '' => esc_html__( 'Select a sidebar', 'beehive' ) ) + beehive()->sidebars->get_sidebars(),
		)
	);

	// Sticky feature metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Sticky Sidebar', 'beehive' ),
			'desc'          => esc_html__( 'Enable or disable sticky sidebar.', 'beehive' ),
			'id'            => $meta_prefix . 'sticky-sidebar',
			'type'          => 'select',
			'default'       => '',
			'tab'           => 'sidebar',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'options'       => array(
				'1' => esc_html__( 'Enable', 'beehive' ),
				'0' => esc_html__( 'Disable', 'beehive' ),
				''  => esc_html__( 'Default', 'beehive' ),
			),
		)
	);

	// Sticky feature metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Featured Image', 'beehive' ),
			'desc'          => esc_html__( 'Display featured image?', 'beehive' ),
			'id'            => $meta_prefix . 'post-thumb',
			'type'          => 'select',
			'default'       => '',
			'tab'           => 'page',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'options'       => array(
				'1' => esc_html__( 'Yes', 'beehive' ),
				'0' => esc_html__( 'No', 'beehive' ),
				''  => esc_html__( 'Default', 'beehive' ),
			),
		)
	);

	// Login modal.
	if ( beehive()->options->get( 'key=user-nav' ) ) {
		$custom_fields->add_field(
			array(
				'name'          => esc_html__( 'Login Modal', 'beehive' ),
				'desc'          => esc_html__( 'Check to fire login modal.', 'beehive' ),
				'id'            => $meta_prefix . 'login-modal',
				'type'          => 'checkbox',
				'tab'           => 'page',
				'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			)
		);
	}

	// Remove preploader.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Remove Preloader', 'beehive' ),
			'desc'          => esc_html__( 'Check if you want to remove prealoader from this page.', 'beehive' ),
			'id'            => $meta_prefix . 'remove-preloader',
			'type'          => 'checkbox',
			'tab'           => 'page',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
		)
	);

	// Footer background metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Show/Hide', 'beehive' ),
			'desc'          => esc_html__( 'Show or hide footer on this page.', 'beehive' ),
			'id'            => $meta_prefix . 'show-footer',
			'type'          => 'select',
			'default'       => '',
			'tab'           => 'footer',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'options'       => array(
				'show' => esc_html__( 'Show', 'beehive' ),
				'hide' => esc_html__( 'Hide', 'beehive' ),
				''     => esc_html__( 'default', 'beehive' ),
			),
		)
	);

	// Copyright info metabox field.
	$custom_fields->add_field(
		array(
			'name'          => esc_html__( 'Copyright Info', 'beehive' ),
			'desc'          => esc_html__( 'Want to display copyright info on this page?', 'beehive' ),
			'id'            => $meta_prefix . 'colophon',
			'type'          => 'select',
			'default'       => '',
			'tab'           => 'footer',
			'render_row_cb' => array( 'CMB2_Tabs', 'tabs_render_row_cb' ),
			'options'       => array(
				'1' => esc_html__( 'Yes', 'beehive' ),
				'0' => esc_html__( 'No', 'beehive' ),
				''  => esc_html__( 'default', 'beehive' ),
			),
		)
	);

}

/**
 * Post only options
 * This metabox only appears in posts (not in page)
 *
 * @return void
 * since 1.0.0
 */
function beehive_post_only_metabox() {

	// Meta prefix.
	$meta_prefix = beehive()->get_meta_prefix();

	// Metabox Field container.
	$custom_fields = new_cmb2_box(
		array(
			'id'           => $meta_prefix . 'gallery_metabox',
			'title'        => esc_html__( 'Post Meta Options.', 'beehive' ),
			'object_types' => array( 'post' ),
		)
	);

	// Post gallery metabox field.
	$custom_fields->add_field(
		array(
			'name'       => esc_html__( 'Post Slider', 'beehive' ),
			'desc'       => esc_html__( 'Add slider images to the post.', 'beehive' ),
			'id'         => $meta_prefix . 'post-slider',
			'type'       => 'file_list',
			'query_args' => array( 'type' => array( 'image' ) ),
			'text'       => array(
				'add_upload_files_text' => esc_html__( 'Add Media', 'beehive' ),
			),
		)
	);
}
