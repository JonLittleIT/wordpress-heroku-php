<?php
/**
 * Job Menu
 *
 * This template renders job menu for beehive theme
 * Job manager plugin must be installed
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php
wp_nav_menu(
	array(
		'theme_location'  => 'jobs_menu',
		'depth'           => 1,
		'container'       => 'nav',
		'container_class' => 'nav-component',
		'menu_class'      => 'nav-component-list job-navbar',
		'fallback_cb'     => 'Beehive_Navwalker::fallback',
	)
);
