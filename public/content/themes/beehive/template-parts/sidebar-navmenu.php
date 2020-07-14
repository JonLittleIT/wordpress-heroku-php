<?php
/**
 * Sidebar nav menu template
 *
 * Displays after the social dashboard template sidebar widgets
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
		'theme_location'  => 'aside-nav-menu',
		'depth'           => 1,
		'container'       => 'nav',
		'container_class' => 'sidebar-nav-menu',
		'menu_class'      => 'aside-navbar',
		'fallback_cb'     => 'Beehive_Navwalker::fallback',
	)
);
