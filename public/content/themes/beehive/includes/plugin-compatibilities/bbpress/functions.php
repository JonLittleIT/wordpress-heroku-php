<?php
/**
 * BbPress functions
 *
 * Functions that will make bbPress compatible
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
 * Include bbPress
 * compatability class
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/plugin-compatibilities/bbpress/class-beehive-bbpress.php';

/**
 * Filters
 *
 * @since 1.0.0
 */
// Add scroll animation to the forum loop items.
add_filter( 'bbp_get_forum_class', 'beehive_bbp_forum_class' );
// Add scroll animation to the topic loop items.
add_filter( 'bbp_get_topic_class', 'beehive_bbp_topic_class' );
// Add scroll animation to the reply loop items.
add_filter( 'bbp_get_reply_class', 'beehive_bbp_reply_class' );

if ( ! function_exists( 'beehive_bbp_forum_class' ) ) :
	/**
	 * Add scroll animation to the forum loop items
	 *
	 * @param array $classes forum classes.
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_bbp_forum_class( $classes ) {
		array_push( $classes, 'animate-item', 'slideInUp' );
		return $classes;
	}
endif;

if ( ! function_exists( 'beehive_bbp_topic_class' ) ) :
	/**
	 * Add scroll animation to the topic loop items
	 *
	 * @param array $classes topic classes.
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_bbp_topic_class( $classes ) {
		array_push( $classes, 'animate-item', 'slideInUp' );
		return $classes;
	}
endif;

if ( ! function_exists( 'beehive_bbp_reply_class' ) ) :
	/**
	 * Add scroll animation to the reply loop items
	 *
	 * @param array $classes reply classes.
	 * @return array
	 * @since 1.0.0
	 */
	function beehive_bbp_reply_class( $classes ) {
		array_push( $classes, 'animate-item', 'slideInUp' );
		return $classes;
	}
endif;
