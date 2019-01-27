<?php
/* GoUrl Membership support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('kryptex_gourl_mb_theme_setup9')) {
	add_action( 'after_setup_theme', 'kryptex_gourl_mb_theme_setup9', 9 );
	function kryptex_gourl_mb_theme_setup9() {
		if (kryptex_exists_gourl_mb()) {

		}
		if (is_admin()) {
			add_filter( 'kryptex_filter_tgmpa_required_plugins',		'kryptex_gourl_mb_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'kryptex_gourl_mb_tgmpa_required_plugins' ) ) {
	function kryptex_gourl_mb_tgmpa_required_plugins($list=array()) {
		if (kryptex_storage_isset('required_plugins', 'gourl-bitcoin-payment-gateway-paid-downloads-membership')) {
			$list[] = array(
				'name' 		=> kryptex_storage_get_array('required_plugins', 'gourl-bitcoin-payment-gateway-paid-downloads-membership'),
				'slug' 		=> 'gourl-bitcoin-payment-gateway-paid-downloads-membership',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'kryptex_exists_gourl_mb' ) ) {
	function kryptex_exists_gourl_mb() {
		return defined('GOURL');
	}
}

?>