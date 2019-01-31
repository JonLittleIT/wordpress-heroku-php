<?php
/**
 * Prohibit direct script loading.
 *
 * @package Convert_Plus.
 */

defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

if ( isset( $_GET['view'] ) && 'smile-mailer-integrations' === $_GET['view'] ) {
	require_once( 'integrations.php' );
} elseif ( isset( $_GET['view'] ) && 'modules' === $_GET['view'] ) {
	require_once( CP_BASE_DIR . '/admin/modules.php' );
} elseif ( isset( $_GET['view'] ) && 'settings' === $_GET['view'] ) {
	require_once( CP_BASE_DIR . '/admin/settings.php' );
} elseif ( isset( $_GET['view'] ) && 'cp_import' === $_GET['view'] ) {
	require_once( CP_BASE_DIR . '/admin/cp-import.php' );
} elseif ( isset( $_GET['view'] ) && 'registration' === $_GET['view'] ) {
	require_once( CP_BASE_DIR . '/admin/registration.php' );
} elseif ( isset( $_GET['view'] ) && 'debug' === $_GET['view'] ) {
	require_once( CP_BASE_DIR . '/admin/debug.php' );
} elseif ( isset( $_GET['view'] ) && 'knowledge_base' === $_GET['view'] ) {
	require_once( CP_BASE_DIR . '/admin/knowledge-base.php' );
} else {
	require_once( CP_BASE_DIR . '/admin/get-started.php' );
}
