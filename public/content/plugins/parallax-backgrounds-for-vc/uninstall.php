<?php
/**
 * Uninstallation routine.
 *
 * @version 1.1
 * @package Parallax Backgrounds for VC
 */

// If uninstall is not called from WordPress, exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// NOTE: This should correspond to the pointer_name in the main plugin file.
$pointerName = 'gambitprlx';

// Deletes the dismissed admin pointer for this plugin.
$dismissedAdminPointers = get_user_meta( get_current_user_id(), 'dismissed_wp_pointers' );
$dismissedAdminPointers = preg_replace( '/' . $pointerName . '(,)?)/', null, $dismissedAdminPointers['0'] );
$dismissedAdminPointers = preg_replace( '/(,)$/', null, $dismissedAdminPointers );
update_user_meta( get_current_user_id(), 'dismissed_wp_pointers', $dismissedAdminPointers );
