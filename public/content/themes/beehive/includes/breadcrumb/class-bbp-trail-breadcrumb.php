<?php
/**
 * Buddypress Breadcrumb Trail
 *
 * Bbpress Breadcrumb Trail is the extension of Beehive_Breadcrumb_Trail class
 * Shows a breadcrumb trail for any type of bbPress page.
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
 * Beehive_BpPress_Breadcrumb_Trail class.
 *
 * @extends Beehive_Breadcrumb_Trail
 */
class Beehive_BpPress_Breadcrumb_Trail extends Beehive_Breadcrumb_Trail {

	/**
	 * Runs through the various bbPress conditional tags to check the current page being viewed.  Once
	 * a condition is met, a specific method is launched to add items to the `$items` array.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function add_items() {

		// Add the network and site home links.
		$this->add_network_home_link();
		$this->add_site_home_link();

		// Get the forum object.
		$post_type_object = get_post_type_object( bbp_get_forum_post_type() );

		// If it isn't the forum root/archive page and a forum archive exists, then add it.
		if ( ! empty( $post_type_object->has_archive ) && ! bbp_is_forum_archive() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_post_type_archive_link( bbp_get_forum_post_type() ) ), esc_html( wp_strip_all_tags( bbp_get_forum_archive_title() ) ) );
		}

		// If it's forum archive page.
		if ( bbp_is_forum_archive() ) {
			if ( true === $this->args['show_title'] ) {
				$this->items[] = esc_html( wp_strip_all_tags( bbp_get_forum_archive_title() ) );
			}
		} elseif ( bbp_is_topic_archive() ) { // Elseif it's topic archive page.
			if ( true === $this->args['show_title'] ) {
				$this->items[] = esc_html( wp_strip_all_tags( bbp_get_topic_archive_title() ) );
			}
		} elseif ( bbp_is_topic_tag() ) { // Elseif it's topic tag archive page.
			if ( true === $this->args['show_title'] ) {
				$this->items[] = esc_html( wp_strip_all_tags( bbp_get_topic_tag_name() ) );
			}
		} elseif ( bbp_is_topic_tag_edit() ) { // Elseif it's topic tag edit page.
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( bbp_get_topic_tag_link() ), esc_html( wp_strip_all_tags( bbp_get_topic_tag_name() ) ) );
			if ( true === $this->args['show_title'] ) {
				$this->items[] = esc_html__( 'Edit', 'beehive' );
			}
		} elseif ( bbp_is_single_view() ) { // Elseif it's view page.
			if ( true === $this->args['show_title'] ) {
				$this->items[] = esc_html( wp_strip_all_tags( bbp_get_view_title() ) );
			}
		} elseif ( bbp_is_single_topic() ) { // If it's a single topic page.

			// Get the parent items for the topic.
			$this->add_post_parents( bbp_get_topic_forum_id( get_queried_object_id() ) );

			// If it's a split, merge, or edit topic page, show the link back to the topic.
			if ( bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit() ) {
				$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( bbp_get_topic_permalink( get_queried_object_id() ) ), esc_html( wp_strip_all_tags( bbp_get_topic_title( get_queried_object_id() ) ) ) );
			} elseif ( true === $this->args['show_title'] ) { // display topic title.
				$this->items[] = esc_html( wp_strip_all_tags( bbp_get_topic_title( get_queried_object_id() ) ) );
			}

			// If it's split page.
			if ( bbp_is_topic_split() && true === $this->args['show_title'] ) {
				$this->items[] = esc_html__( 'Split', 'beehive' );
			} elseif ( bbp_is_topic_merge() && true === $this->args['show_title'] ) { // Elseif it's a topic merge page.
				$this->items[] = esc_html__( 'Merge', 'beehive' );
			} elseif ( bbp_is_topic_edit() && true === $this->args['show_title'] ) { // Elseif it's a topic edit page.
				$this->items[] = esc_html__( 'Edit', 'beehive' );
			}
		} elseif ( bbp_is_single_reply() ) { // If it's a single reply page.

			// Get the parent items for the reply.
			$this->add_post_parents( bbp_get_reply_topic_id( get_queried_object_id() ) );

			// If it's a reply edit page, show the link back to the reply.
			if ( bbp_is_reply_edit() ) {
				$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( bbp_get_reply_url( get_queried_object_id() ) ), esc_html( wp_strip_all_tags( bbp_get_reply_title( get_queried_object_id() ) ) ) );
				if ( true === $this->args['show_title'] ) {
					$this->items[] = esc_html__( 'Edit', 'beehive' );
				}
			} elseif ( true === $this->args['show_title'] ) { // display the reply title.
				$this->items[] = esc_html( wp_strip_all_tags( bbp_get_reply_title( get_queried_object_id() ) ) );
			}
		} elseif ( bbp_is_single_forum() ) { // If it's a single forum.

			// If the current forum has a parent, get it.
			if ( 0 !== bbp_get_forum_parent_id( get_queried_object_id() ) ) {
				$this->add_post_parents( bbp_get_forum_parent_id( get_queried_object_id() ) );
			}

			// Add the forum title to the end of the trail.
			if ( true === $this->args['show_title'] ) {
				$this->items[] = esc_html( wp_strip_all_tags( bbp_get_forum_title( get_queried_object_id() ) ) );
			}
		} elseif ( bbp_is_single_user() || bbp_is_single_user_edit() ) { // If it's a user page or edit user page.
			if ( bbp_is_single_user_edit() ) {
				$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( bbp_get_user_profile_url() ), esc_html( bbp_get_displayed_user_field( 'display_name' ) ) );
				if ( true === $this->args['show_title'] ) {
					$this->items[] = esc_html__( 'Edit', 'beehive' );
				}
			} elseif ( true === $this->args['show_title'] ) {
				$this->items[] = esc_html( bbp_get_displayed_user_field( 'display_name' ) );
			}
		}

		// Allow developers to overwrite the items for the breadcrumb trail.
		$this->items = apply_filters( 'bbp_breadcrumb_trail_items', $this->items, $this->args );
	}
}
