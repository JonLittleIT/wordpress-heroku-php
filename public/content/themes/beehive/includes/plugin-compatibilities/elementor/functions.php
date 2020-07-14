<?php
/**
 * Elementor functions
 *
 * Functions that will make elementor compatible
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
 * Include elementor
 * compatability class
 *
 * @since 1.0.0
 */
require_once BEEHIVE_INC . '/plugin-compatibilities/elementor/class-beehive-elementor.php';
