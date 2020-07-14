<?php
/**
 * Plugins compatiblity
 *
 * These files makes the plugins compatible with beehive theme
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
 * Include elementor
 * Compatability functions
 *
 * @since 1.0.0
 */
if ( defined( 'ELEMENTOR_PATH' ) ) {
	require_once BEEHIVE_INC . '/plugin-compatibilities/elementor/functions.php';
}

/**
 * Include job manager
 * Compatability functions
 *
 * @since 1.0.0
 */
if ( class_exists( 'WP_Job_Manager' ) ) {
	require_once BEEHIVE_INC . '/plugin-compatibilities/job-manager/functions.php';
}

/**
 * Include rtmedia
 * Compatability functions
 *
 * @since 1.0.0
 */
if ( function_exists( 'bp_is_active' ) && class_exists( 'RTMedia' ) ) {
	require_once BEEHIVE_INC . '/plugin-compatibilities/rtmedia/functions.php';
}

/**
 * Include bbPress
 * Compatability functions
 *
 * @since 1.0.0
 */
if ( class_exists( 'bbPress' ) ) {
	require_once BEEHIVE_INC . '/plugin-compatibilities/bbpress/functions.php';
}

/**
 * Include wp adverts
 * Compatability functions
 *
 * @since 1.0.0
 */
if ( defined( 'ADVERTS_FILE' ) ) {
	require_once BEEHIVE_INC . '/plugin-compatibilities/wpadverts/functions.php';
}

/**
 * Include woocommerce
 * Compatability functions
 *
 * @since 1.0.0
 */
if ( class_exists( 'WooCommerce' ) ) {
	require_once BEEHIVE_INC . '/plugin-compatibilities/woocommerce/functions.php';
}

/**
 * Include buddypress
 * Compatability functions
 *
 * @since 1.0.0
 */
if ( function_exists( 'bp_is_active' ) ) {
	require_once BEEHIVE_INC . '/plugin-compatibilities/buddypress/functions.php';
}
