<?php
/**
 * RT media functions
 *
 * Functions that will make rtmedia compatible
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
require_once BEEHIVE_INC . '/plugin-compatibilities/rtmedia/class-beehive-rtmedia.php';

/**
 * Actions
 *
 * @since 1.0.0
 */
// Profile photos.
add_action( 'after_displayed_profile_info', 'beehive_rtm_member_photos' );

/**
 * Filters
 *
 * @since 1.0.0
 */
// Add body classes.
add_filter( 'body_class', 'beehive_rtm_body_classes' );
// Add column class.
add_filter( 'rtmedia_gallery_class_filter', 'beehive_rtm_add_media_list_class' );
// Add custom data to rtmedia backbone object.
add_filter( 'rtmedia_media_array_backbone', 'beehive_rtm_backbone_template_filter_custom_data', 10, 1 );
// Increase bp excerpt length.
add_filter( 'bp_activity_excerpt_length', 'beehive_rtm_activity_excerpt_length' );

if ( ! function_exists( 'beehive_rtm_body_classes' ) ) {
	/**
	 * Conditionaly add body classes
	 *
	 * @param array $classes body classes.
	 * @since 1.0.0
	 */
	function beehive_rtm_body_classes( $classes ) {

		// Push classes.
		if ( TH_Helpers::is_media() ) {
			array_push( $classes, 'beehive-media' );
		}

		// Return classes.
		return $classes;
	}
}

if ( ! function_exists( 'beehive_rtm_member_photos' ) ) {
	/**
	 * RT media profile photos
	 *
	 * @since 1.0.0
	 */
	function beehive_rtm_member_photos() {

		// Return early.
		if ( ! class_exists( 'RTMedia' ) && ! class_exists( 'BuddyPress' ) ) {
			return;
		}

		global $wpdb;
		$blog_id        = ( is_multisite() ) ? get_current_blog_id() : 1;
		$displayed_user = bp_displayed_user_id();
		$table_name     = $wpdb->base_prefix . 'rt_rtm_media';

		// Query.
		$sql  = "SELECT * FROM {$table_name} WHERE media_type = 'photo' AND media_author = %d AND blog_id = %d AND context = 'profile'";
		$sql .= ' AND (privacy is NULL OR privacy<=0';
		if ( get_current_user_id() ) {
			$sql .= ' OR privacy=20';
			if ( is_super_admin() || $displayed_user == get_current_user_id() ) { // @codingStandardsIgnoreLine
				$sql .= ' OR privacy >= 40';
			} elseif ( bp_is_active( 'friends' ) && 'is_friend' === bp_is_friend( $displayed_user ) ) {
				$sql .= ' OR privacy=40';
			}
		}
		$sql .= ') ORDER BY media_id DESC LIMIT 9';

		// Get Results.
		$results = $wpdb->get_results( $wpdb->prepare( $sql, $displayed_user, $blog_id ) ); // @codingStandardsIgnoreLine

		// Include template.
		if ( is_array( $results ) && count( $results ) > 0 ) {
			include locate_template( 'template-parts/buddypress/member-photos.php' );
		}
	}
}

if ( ! function_exists( 'beehive_rtm_add_media_list_class' ) ) {
	/**
	 * Add media list classes
	 *
	 * @param string $classes media list classes.
	 * @return string
	 * @since 1.0.0
	 */
	function beehive_rtm_add_media_list_class( $classes ) {
		global $rtmedia_query;
		if ( isset( $rtmedia_query->media_query ) && isset( $rtmedia_query->media_query['media_type'] ) && is_string( $rtmedia_query->media_query['media_type'] ) ) {
			$classes .= ' rtmedia-media-list-' . $rtmedia_query->media_query['media_type'];
		}
		if ( in_array( beehive()->layout->get(), array( 'social' ), true ) ) {
			$classes .= ' columns-3';
		} else {
			$classes .= ' columns-4';
		}
		return $classes;
	}
}


if ( ! function_exists( 'beehive_rtm_item_meta' ) ) :
	/**
	 * RT media item meta
	 *
	 * @return void
	 * @since 1.0.0
	 */
	function beehive_rtm_item_meta() {

		// Globals.
		global $rtmedia_backbone, $rtmedia_media;

		// html.
		$html  = '';
		$html .= '<div class="rtmedia-item-meta">';
		$html .= '<div class="author-avatar">';
		$html .= '%s';
		$html .= '</div>';
		$html .= '<div class="author-info">';
		$html .= '<div class="author-name">';
		$html .= '<h4 class="author ellipsis">%s</h4>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		// data.
		if ( $rtmedia_backbone['backbone'] ) {
			$avatar = '<%= author_avatar %>';
			$author = '<%= author %>';
		} else {
			$avatar = rtmedia_author_profile_pic( false, false );
			$author = esc_html( rtmedia_get_author_name( $rtmedia_media->media_author ) );
		}

		// Print html.
		printf( $html, $avatar, $author ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'beehive_rtm_backbone_template_filter_custom_data' ) ) :
	/**
	 * Add custom data to rt media backbone object
	 *
	 * @param array $media_array media array.
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_rtm_backbone_template_filter_custom_data( $media_array ) {

		// Set author name and avataar.
		$media_array->author        = get_the_author_meta( 'display_name', $media_array->media_author );
		$media_array->author_avatar = get_avatar( $media_array->media_author );

		// Return media array.
		return $media_array;
	}
endif;

if ( ! function_exists( 'beehive_rtm_activity_excerpt_length' ) ) :
	/**
	 * Return activity excerpt length
	 *
	 * @param int $chars number of characters.
	 * @return int
	 * @since 1.0.0
	 */
	function beehive_rtm_activity_excerpt_length( $chars ) {

		// Set character limit for activity_update.
		if ( in_array( bp_get_activity_type(), array( 'activity_update', 'rtmedia_update' ), true ) ) {

			// Chars limit.
			$chars = (int) beehive()->options->get(
				array(
					'key'     => 'activity-length',
					'default' => 3000,
				)
			);

			// Allocate some chars to rtmedia.
			if ( class_exists( 'RTMedia' ) ) {
				$chars = $chars + 50000;
			}
		}

		// Return chars.
		return $chars;
	}
endif;
