<?php
/**
 * Prohibit direct script loading.
 *
 * @package Convert_Plus.
 */

defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

if ( isset( $_GET['view'] ) && 'new-list' === $_GET['view'] ) {
	require_once( CP_BASE_DIR . '/admin/contacts/views/new-list.php' );
} elseif ( isset( $_GET['view'] ) && 'contacts' === $_GET['view'] ) {
	require_once( CP_BASE_DIR . '/admin/contacts/views/contacts.php' );
} elseif ( isset( $_GET['view'] ) && 'analytics' === $_GET['view'] ) {
	require_once( CP_BASE_DIR . '/admin/contacts/views/analytics.php' );
} elseif ( isset( $_GET['view'] ) && 'contact-details' === $_GET['view'] ) {
	require_once( CP_BASE_DIR . '/admin/contacts/views/contact-details.php' );
} else {
	require_once( CP_BASE_DIR . '/admin/contacts/views/dashboard.php' );
}
