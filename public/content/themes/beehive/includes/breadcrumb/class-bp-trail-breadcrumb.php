<?php
/**
 * Buddypress Breadcrumb Trail
 *
 * Buddypress Breadcrumb Trail is the extension of Beehive_Breadcrumb_Trail class
 * Shows a breadcrumb trail for any type of Buddypress page.
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
 * Beehive_Buddypress_Breadcrumb_Trail class.
 *
 * @extends Beehive_Breadcrumb_Trail
 */
class Beehive_Buddypress_Breadcrumb_Trail extends Beehive_Breadcrumb_Trail {

	/**
	 * Runs through the various Buddypress conditional tags to check the current page being viewed.  Once
	 * a condition is met, a specific method is launched to add items to the `$items` array.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function add_items() {

		// global bp object.
		global $bp;

		// Add the network and site home links.
		$this->add_network_home_link();
		$this->add_site_home_link();

		// Items.
		if ( ! empty( $bp->displayed_user->fullname ) ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( bp_get_members_directory_permalink() ), esc_html( wp_strip_all_tags( get_the_title( $bp->pages->members->id ) ) ) );
			$trail_end     = esc_html( bp_get_displayed_user_fullname() );
		} elseif ( $bp->is_single_item ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $bp->pages->{$bp->current_component}->id ) ), esc_html( wp_strip_all_tags( get_the_title( $bp->pages->{$bp->current_component}->id ) ) ) );
			$trail_end     = esc_html( $bp->bp_options_title );
		} elseif ( $bp->is_directory ) {
			$trail_end     = esc_html( wp_strip_all_tags( get_the_title( $bp->pages->{$bp->current_component}->id ) ) );
		} elseif ( bp_is_group_create() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( get_permalink( $bp->pages->groups->id ) ), esc_html( wp_strip_all_tags( get_the_title( $bp->pages->groups->id ) ) ) );
			$trail_end     = esc_html__( 'Create a Group', 'buddypress' );
		} elseif ( bp_is_create_blog() ) {
			$this->items[] = sprintf( '<a href="%s">%s</a>', esc_url( home_url( '/' ) . $bp->current_component ), esc_html( $bp->current_component ) );
			$trail_end     = esc_html__( 'Create a Blog', 'buddypress' );
		} elseif ( bp_is_register_page() ) {
			$trail_end     = esc_html__( 'Create an Account', 'buddypress' );
		} elseif ( bp_is_activation_page() ) {
			$trail_end     = esc_html__( 'Activate your Account', 'buddypress' );
		}

		// Add trail end.
		if ( isset( $trail_end ) && ! empty( $trail_end ) ) {
			$this->items[] = $trail_end;
		}

		// Allow developers to overwrite the items for the breadcrumb trail.
		$this->items = apply_filters( 'bp_breadcrumb_trail_items', $this->items, $this->args );
	}
}
