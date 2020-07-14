<?php
/**
 * Sidebar template
 *
 * Displays sidebar on the page
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); }

/** Return if sidebar not in use */

if ( ! is_active_sidebar( $id ) ) {
	return;
}

echo '<div class="' . esc_attr( apply_filters( 'beehive_sidebar_width', 'col-lg-4' ) ) . ' col-aside">';
	echo '<aside id="' . esc_attr( $id ) . '" class="widget-area sidebar-widget-area ' . esc_attr( trim( $classes ) ) . '">';
		/**
		 * Fires before the sidebar
		 *
		 * @since 1.0.0
		 */
		do_action( 'beehive_before_sidebar' );
		dynamic_sidebar( $id );
		/**
		 * Fires after the sidebar
		 *
		 * @since 1.0.0
		 */
		do_action( 'beehive_after_sidebar' );
	echo '</aside>';
echo '</div>';
