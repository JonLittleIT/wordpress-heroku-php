<?php
/**
 * For displaying icons in menu
 *
 * @package      WordPress
 * @subpackage   Beehive
 * @since        1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

global $wp_version;

// Add custom menu fields to menu.
add_filter( 'wp_setup_nav_menu_item', 'beehive_add_custom_nav_fields' );

if ( version_compare( preg_replace( '/[^0-9\.]/', '', $wp_version ), '5.4', '<' ) ) {
	// Edit menu walker.
	add_filter( 'wp_edit_nav_menu_walker', 'beehive_edit_walker', 99 );
}

// Adds Title.
add_filter( 'nav_menu_item_title', 'beehive_nav_menu_items', 10, 2 );

/**
 * Returns the icon
 *
 * @param       string $title title string.
 * @param       string $item  item string.
 * @access      public
 * @since       1.0.0
 * @return      str
 */
function beehive_nav_menu_items( $title, $item ) {
	if ( $item->icon_class ) {
		return '<i class="' . esc_attr( $item->icon_class ) . '"></i><span class="nav-link-text">' . $title . '</span>';
	}
	return $title;
}

/**
 * Add custom fields to $item nav object
 * in order to be used in custom Walker
 *
 * @param       string $menu_item menu item.
 * @since       1.0.0
 * @return      string
 */
function beehive_add_custom_nav_fields( $menu_item ) {
	$menu_item->icon_class = get_post_meta( $menu_item->ID, 'menu-item-icon-class', true );
	return $menu_item;
}

/**
 * Define new Walker edit
 *
 * @param       object $walker walker object.
 * @since       1.0.0
 * @return      string
 */
function beehive_edit_walker( $walker ) {
	if ( ! class_exists( 'Beehive_Menu_Item_Custom_Fields_Walker' ) ) {
		require_once dirname( __FILE__ ) . '/walker-nav-menu-edit.php';
	}
	return 'Beehive_Menu_Item_Custom_Fields_Walker';
}

// Load the menu icon class.
require_once 'class-beehive-menu-icon.php';
