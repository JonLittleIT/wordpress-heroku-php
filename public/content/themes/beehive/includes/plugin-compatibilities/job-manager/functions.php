<?php
/**
 * Job manager functions
 *
 * Functions that will make WPJM compatible
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
 * Include job manager
 * compatability class
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/plugin-compatibilities/job-manager/class-beehive-job-manager.php';

/**
 * Job filters
 *
 * @since 1.0.0
 */
add_filter( 'submit_job_form_fields', 'beehive_wpjm_add_salary_frontend' );
add_filter( 'job_manager_job_listing_data_fields', 'beehive_wpjm_add_salary_admin' );

/**
 * Functions and definations
 */

if ( ! function_exists( 'beehive_related_jobs' ) ) :
	/**
	 * Renders related job
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_related_jobs() {
		get_template_part( 'template-parts/job_manager/related', 'jobs' );
	}
endif;

if ( ! function_exists( 'beehive_wpjm_add_salary_frontend' ) ) :
	/**
	 * Add salary field in the front-end
	 *
	 * @access public
	 * @param array $fields form fields.
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_wpjm_add_salary_frontend( $fields ) {

		$fields['job']['job_salary'] = array(
			'label'       => esc_html__( 'Salary ($)', 'job_manager' ),
			'type'        => 'text',
			'required'    => false,
			'placeholder' => esc_attr__( 'e.g. 20000', 'beehive' ),
			'priority'    => 7,
		);
		return $fields;
	}
endif;

if ( ! function_exists( 'beehive_wpjm_add_salary_admin' ) ) :
	/**
	 * Add salary field in wp admin
	 *
	 * @access public
	 * @param array $fields form fields.
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_wpjm_add_salary_admin( $fields ) {
		$fields['_job_salary'] = array(
			'label'       => esc_html__( 'Salary ($)', 'beehive' ),
			'type'        => 'text',
			'placeholder' => esc_html__( 'e.g. 20000', 'beehive' ),
			'description' => '',
		);
		return $fields;
	}
endif;

if ( ! function_exists( 'beehive_wpjm_add_bp_nav' ) ) :
	/**
	 * Adds job manager menu to buddypress
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_wpjm_add_bp_nav() {
		bp_core_new_nav_item(
			array(
				'name'                    => esc_html__( 'Jobs', 'beehive' ),
				'slug'                    => 'my-jobs',
				'position'                => 280,
				'default_subnav_slug'     => 'manage',
				'show_for_displayed_user' => false,
			)
		);
	}
endif;

if ( ! function_exists( 'beehive_wpjm_add_bp_subnav_manage' ) ) :
	/**
	 * Adds job manager manage submenu to jobs menu
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_wpjm_add_bp_subnav_manage() {
		bp_core_new_subnav_item(
			array(
				'name'            => esc_html__( 'Manage Jobs', 'beehive' ),
				'slug'            => 'manage',
				'parent_url'      => trailingslashit( bp_loggedin_user_domain() . 'my-jobs' ),
				'parent_slug'     => 'my-jobs',
				'screen_function' => 'beehive_wpjm_add_bp_manage_content',
				'position'        => 10,
				'user_has_access' => ( bp_is_my_profile() ) ? true : false,
			)
		);
	}
endif;

if ( ! function_exists( 'beehive_wpjm_add_bp_manage_content' ) ) :
	/**
	 * Adds jobs contents to buddypress
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_wpjm_add_bp_manage_content() {
		add_action( 'bp_template_content', 'beehive_wpjm_render_bp_manage_content' );
		bp_core_load_template( 'buddypress/members/single/plugins' );
	}
endif;

if ( ! function_exists( 'beehive_wpjm_render_bp_manage_content' ) ) :
	/**
	 * Render contents in buddypress
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_wpjm_render_bp_manage_content() {
		echo do_shortcode( '[job_dashboard]' );
	}
endif;
