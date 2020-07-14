<?php
/**
 * Wpadverts functions
 *
 * Functions that will make wpadverts compatible
 * with beehive theme
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Include adverts
 * compatability class
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/plugin-compatibilities/wpadverts/class-beehive-wpadverts.php';

/**
 * Advert actions
 *
 * @since 1.0.0
 */

// Override plugin templates.
add_action( 'adverts_template_load', 'beehive_wpadverts_template_override' );
// Prevent using default tax template.
add_action( 'init', 'beehive_wpadverts_prevent_tax_template', 20 );
// Add bp profile tab.
if ( function_exists( 'bp_is_active' ) && beehive()->options->get( 'key=adverts-bpprofile' ) ) {
	// Add buddypress menu for advers.
	add_action( 'bp_setup_nav', 'beehive_adverts_add_bp_nav', 200 );
	// Add buddypress submenu.
	add_action( 'bp_setup_nav', 'beehive_adverts_add_bp_subnav_manage', 200 );
}

/**
 * Advert filters
 *
 * @since 1.0.0
 */

// Change contact form layout.
add_filter( 'adverts_form_load', 'beehive_advert_contact_form_layout' );

/**
 * Functions starts
 */

if ( ! function_exists( 'beehive_related_adverts' ) ) :

	/**
	 * Render related adverts
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_related_adverts() {
		get_template_part( 'template-parts/wpadverts/related', 'adverts' );
	}
endif;

if ( ! function_exists( 'beehive_wpadverts_template_override' ) ) :
	/**
	 * Override templates
	 *
	 * @param string $tpl template string.
	 * @return string
	 * @since 1.0.0
	 */
	function beehive_wpadverts_template_override( $tpl ) {

		$dirs = array();

		// first check in child-theme directory.
		$dirs[] = BEEHIVE_DIR . '/wpadverts/';

		// next check in parent theme directory.
		$dirs[] = BEEHIVE_ROOT . '/wpadverts/';

		// if nothing else use default template.
		$dirs[] = ADVERTS_PATH . '/templates/';

		// use absolute path in case the full path to the file was passed.
		$dirs[] = dirname( $tpl ) . '/';

		$basename = basename( $tpl );

		foreach ( $dirs as $dir ) {
			if ( file_exists( $dir . $basename ) ) {
				return $dir . $basename;
			}
		}

	}
endif;

if ( ! function_exists( 'beehive_wpadverts_prevent_tax_template' ) ) :
	/**
	 * Prevent using default tax template
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_wpadverts_prevent_tax_template() {
		remove_filter( 'template_include', 'adverts_template_include' );
	}
endif;

if ( ! function_exists( 'beehive_advert_contact_form_layout' ) ) :
	/**
	 * Change contact form layout on single advert
	 *
	 * @param array $form form array.
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_advert_contact_form_layout( $form ) {

		// Return if form is not contact form.
		if ( 'contact' !== $form['name'] ) {
			return $form;
		}

		// Set contact form layout.
		$form['layout'] = 'stacked';

		// Return form.
		return $form;
	}
endif;

if ( ! function_exists( 'beehive_is_featured_advert' ) ) :
	/**
	 * Check if featured advert
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	function beehive_is_featured_advert() {
		$post = get_post( get_the_ID() );
		if ( 1 == $post->menu_order ) {
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'beehive_adverts_add_bp_nav' ) ) :
	/**
	 * Adds adverts menu to buddypress
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_adverts_add_bp_nav() {
		$adverts_count = ( count_user_posts( bp_loggedin_user_id(), 'advert' ) ) ? ' <span class="count">' . count_user_posts( bp_loggedin_user_id(), 'advert' ) . '</span>' : '';
		bp_core_new_nav_item(
			array(
				'name'                    => esc_html__( 'Adverts', 'beehive' ) . $adverts_count,
				'slug'                    => 'my-adverts',
				'position'                => 75,
				'default_subnav_slug'     => 'manage',
				'show_for_displayed_user' => false,
			)
		);
	}
endif;

if ( ! function_exists( 'beehive_adverts_add_bp_subnav_manage' ) ) :
	/**
	 * Adds adverts manage submenu to adverts menu
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_adverts_add_bp_subnav_manage() {
		bp_core_new_subnav_item(
			array(
				'name'            => esc_html__( 'Manage Ads', 'beehive' ),
				'slug'            => 'manage',
				'parent_url'      => trailingslashit( bp_loggedin_user_domain() . 'my-adverts' ),
				'parent_slug'     => 'my-adverts',
				'screen_function' => 'beehive_adverts_add_bp_manage_content',
				'position'        => 10,
				'user_has_access' => ( bp_is_my_profile() ) ? true : false,
			)
		);
	}
endif;

if ( ! function_exists( 'beehive_adverts_add_bp_manage_content' ) ) :
	/**
	 * Adds adverts contents to buddypress
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_adverts_add_bp_manage_content() {
		add_action( 'bp_template_content', 'beehive_adverts_render_bp_manage_content' );
		bp_core_load_template( 'buddypress/members/single/plugins' );
	}
endif;

if ( ! function_exists( 'beehive_adverts_render_bp_manage_content' ) ) :
	/**
	 * Render contents in buddypress
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_adverts_render_bp_manage_content() {
		echo do_shortcode( '[adverts_manage]' );
	}
endif;
