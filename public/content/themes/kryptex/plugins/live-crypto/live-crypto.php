<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('kryptex_live_crypto_theme_setup9')) {
	add_action( 'after_setup_theme', 'kryptex_live_crypto_theme_setup9', 9 );
	function kryptex_live_crypto_theme_setup9() {
		if (kryptex_exists_cryptocurrency_price_ticker_widget()) {

		}
		if (is_admin()) {
			add_filter( 'kryptex_filter_tgmpa_required_plugins',		'kryptex_live_crypto_tgmpa_required_plugins' );
		}
	}
}
// Filter to add in the required plugins list
if ( !function_exists( 'kryptex_live_crypto_tgmpa_required_plugins' ) ) {
	function kryptex_live_crypto_tgmpa_required_plugins($list=array()) {
		if (kryptex_storage_isset('required_plugins', 'live-crypto')) {
			$path = kryptex_get_file_dir('plugins/live-crypto/live-crypto.zip');
			if (!empty($path) || kryptex_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' => kryptex_storage_get_array('required_plugins', 'live-crypto'),
					'slug' => 'live-crypto',
					'source'	=> !empty($path) ? $path : 'upload://live-crypto.zip',
					'required' => false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'kryptex_exists_cryptocurrency_price_ticker_widget' ) ) {
	function kryptex_exists_cryptocurrency_price_ticker_widget() {
		return defined('LEGAL_POPUPFILE');
	}
}

?>