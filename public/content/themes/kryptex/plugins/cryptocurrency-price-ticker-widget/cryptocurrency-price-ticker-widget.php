<?php
/* GoUrl WooCommerce support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('kryptex_cryptocurrency_price_ticker_widget_theme_setup9')) {
	add_action( 'after_setup_theme', 'kryptex_cryptocurrency_price_ticker_widget_theme_setup9', 9 );
	function kryptex_cryptocurrency_price_ticker_widget_theme_setup9() {
		if (kryptex_exists_cryptocurrency_price_ticker_widget()) {

		}
		if (is_admin()) {
			add_filter( 'kryptex_filter_tgmpa_required_plugins',		'kryptex_cryptocurrency_price_ticker_widget_tgmpa_required_plugins' );
		}
	}
}
// Filter to add in the required plugins list
if ( !function_exists( 'kryptex_cryptocurrency_price_ticker_widget_tgmpa_required_plugins' ) ) {
	function kryptex_cryptocurrency_price_ticker_widget_tgmpa_required_plugins($list=array()) {
		if (kryptex_storage_isset('required_plugins', 'cryptocurrency-price-ticker-widget')) {
			$list[] = array(
				'name' 		=> kryptex_storage_get_array('required_plugins', 'cryptocurrency-price-ticker-widget'),
				'slug' 		=> 'cryptocurrency-price-ticker-widget',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'kryptex_exists_cryptocurrency_price_ticker_widget' ) ) {
	function kryptex_exists_cryptocurrency_price_ticker_widget() {
		return defined('Crypto_Currency_Price_Widget_VERSION');
	}
}

?>