<?php
/**
 * Advert menu
 *
 * This template renders classified menu for beehive theme
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
		'theme_location'  => 'classified_menu',
		'depth'           => 1,
		'container'       => 'nav',
		'container_class' => 'nav-component',
		'menu_class'      => 'nav-component-list advert-navbar',
		'fallback_cb'     => 'Beehive_Navwalker::fallback',
	)
);
