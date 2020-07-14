<?php
/**
 * Buddypress functions
 *
 * Functions that will make buddypress compatible
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
 * Include buddypress
 * compatability class
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/plugin-compatibilities/buddypress/class-beehive-buddypress.php';

/**
 * Actions
 *
 * @since 1.0.0
 */
add_action( 'bp_directory_members_actions', 'beehive_bp_member_loop_actions' );
add_action( 'bp_group_members_list_item_action', 'beehive_bp_member_loop_actions' );
add_action( 'bp_directory_groups_actions', 'beehive_bp_group_loop_actions' );
add_action( 'bp_member_header_actions', 'beehive_bp_logged_in_user_actions', 10, 1 );
add_action( 'bp_setup_nav', 'beehive_bp_change_profile_menu_positions', 999 );
add_action( 'template_redirect', 'beehive_bp_redirect_user_to_activity' );
add_action( 'bp_activity_entry_content', 'beehive_bp_mini_activity_entry_contents' );

/**
 * Filters
 *
 * @since 1.0.0
 */
add_filter( 'bp_before_members_cover_image_settings_parse_args', 'beehive_bp_xprofile_cover_image', 10, 1 );
add_filter( 'bp_before_groups_cover_image_settings_parse_args', 'beehive_bp_xprofile_cover_image', 10, 1 );

/**
 * Define avatar dimensions
 *
 * @since 1.0.0
 */
define( 'BP_AVATAR_FULL_WIDTH', 200 );
define( 'BP_AVATAR_FULL_HEIGHT', 200 );

if ( ! function_exists( 'beehive_bp_xprofile_cover_image' ) ) :
	/**
	 * Additional links for group loop
	 *
	 * @param array $settings settings array.
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_bp_xprofile_cover_image( $settings = array() ) {
		$settings['width']  = 1920;
		$settings['height'] = 280;

		// Return settings.
		return $settings;
	}
endif;

if ( ! function_exists( 'beehive_bp_member_loop_actions' ) ) :
	/**
	 * Additional links for members loop
	 *
	 * @since 1.0.0
	 * @returns void
	 */
	function beehive_bp_member_loop_actions() {
		if ( is_user_logged_in() ) {
			if ( bp_get_member_user_id() === bp_loggedin_user_id() ) {
				printf( '<li class="generic-button"><a href="%1$s">%2$s</a></li>', esc_url( bp_loggedin_user_domain() ), esc_html__( 'My Profile', 'beehive' ) );
			}
		} else {
			printf( '<li class="generic-button"><a href="%1$s">%2$s</a></li>', esc_url( bp_get_member_permalink() ), esc_html__( 'View Profile', 'beehive' ) );
		}
	}
endif;

if ( ! function_exists( 'beehive_bp_group_loop_actions' ) ) :
	/**
	 * Additional links for group loop
	 *
	 * @since 1.0.0
	 * @returns void
	 */
	function beehive_bp_group_loop_actions() {
		if ( is_user_logged_in() ) {
			$admin_count = count( BP_Groups_Member::get_group_administrator_ids( bp_get_group_id() ) );
			if ( ( groups_is_user_admin( bp_loggedin_user_id(), bp_get_group_id() ) ) && $admin_count < 2 && groups_is_user_member( bp_loggedin_user_id(), bp_get_group_id() ) ) {
				printf( '<li class="generic-button"><a href="%1$s">%2$s</a></li>', esc_url( trailingslashit( bp_get_group_permalink() . 'admin' ) ), esc_html__( 'Manage Group', 'beehive' ) );
			}
		} else {
			printf( '<li class="generic-button"><a href="%1$s">%2$s</a></li>', esc_url( bp_get_group_permalink() ), esc_html__( 'View Group', 'beehive' ) );
		}
	}
endif;

if ( ! function_exists( 'beehive_bp_logged_in_user_actions' ) ) :
	/**
	 * Logged in user profile actions
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function beehive_bp_logged_in_user_actions() {
		if ( bp_displayed_user_id() === bp_loggedin_user_id() ) {
			echo '<li class = "generic-button"><a class="edit-profile" href ="' . esc_url( bp_loggedin_user_domain() . 'profile/' ) . '">' . esc_html__( 'Edit profile', 'beehive' ) . '</a><li>';
			echo '<li class = "generic-button"><a class="profile-settings" href="' . esc_url( bp_loggedin_user_domain() . 'settings/' ) . '">' . esc_html__( 'Profile settings', 'beehive' ) . '</a></li>';
		}

	}

endif;

if ( ! function_exists( 'beehive_is_bp_profile_vartical_nav' ) ) {
	/**
	 * Check if profile nav is vertical
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	function beehive_is_bp_profile_vartical_nav() {

		$bp_nouveau        = bp_nouveau();
		$component         = bp_current_component();
		$customizer_option = ( bp_is_user() ) ? 'user_nav_display' : 'group_nav_display';
		$layout_prefs      = (int) bp_nouveau_get_temporary_setting( $customizer_option, bp_nouveau_get_appearance_settings( $customizer_option ) );

		if ( 1 === $layout_prefs ) {
			return true;
		} else {
			return false;
		}

		return false;
	}
}

if ( ! function_exists( 'beehive_bp_change_profile_menu_positions' ) ) :
	/**
	 * Change buddypress profile menu position
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_bp_change_profile_menu_positions() {

		// BP Nav.
		$nav       = buddypress()->members->nav;
		$nav_items = array(
			'notifications' => 290,
			'messages'      => 295,
			'settings'      => 300,
		);

		// loop through the items and change position.
		foreach ( $nav_items as $nav_item => $position ) {
			$nav->edit_nav( array( 'position' => $position ), $nav_item );
		}

	}
endif;

if ( ! function_exists( 'beehive_bp_redirect_user_to_activity' ) ) {
	/**
	 * Redirect logged in user
	 * to activity page
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_bp_redirect_user_to_activity() {

		// Return early.
		if ( ! beehive()->options->get( 'key=home-to-activity' ) ) {
			return;
		}
		if ( ! is_user_logged_in() || current_user_can( 'manage_options' ) || is_home() ) {
			return;
		}

		// Redirect user.
		if ( is_front_page() ) {
			$page_id     = bp_core_get_directory_page_id( 'activity' );
			$redirect_to = esc_url( get_the_permalink( $page_id ) );
			if ( $redirect_to ) {
				wp_safe_redirect( $redirect_to );
				exit;
			}
		}
	}
}

if ( ! function_exists( 'beehive_bp_mini_activity_entry_contents' ) ) {
	/**
	 * Renders mini activity contents
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_bp_mini_activity_entry_contents() {

		// Acitivity template global.
		global $activities_template;

		// Get Activity.
		$activity = $activities_template->activity;

		// Get templates.
		switch ( $activity->type ) {

			case 'new_member':
				include locate_template( 'template-parts/buddypress/user-activity-entries.php' );
				break;

			case 'friendship_created':
				include locate_template( 'template-parts/buddypress/user-activity-entries.php' );
				break;

			case 'updated_profile':
				include locate_template( 'template-parts/buddypress/user-activity-entries.php' );
				break;

			case 'new_avatar':
				include locate_template( 'template-parts/buddypress/user-activity-entries.php' );
				break;

			case 'created_group':
				include locate_template( 'template-parts/buddypress/group-activity-entries.php' );
				break;

			case 'joined_group':
				if ( bp_is_groups_component() ) {
					include locate_template( 'template-parts/buddypress/user-activity-entries.php' );
				} else {
					include locate_template( 'template-parts/buddypress/group-activity-entries.php' );
				}
				break;
		}

	}
}

/**
 * Include like functions
 *
 * @since 1.0.0
 */
if ( beehive()->options->get( 'key=activity-like' ) ) {
	require_once BEEHIVE_INC . '/plugin-compatibilities/buddypress/like-functions.php';
}

/**
 * Buddypress xprofile field functions
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/plugin-compatibilities/buddypress/xprofile-functions.php';
