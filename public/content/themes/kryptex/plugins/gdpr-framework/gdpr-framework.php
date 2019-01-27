<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('kryptex_gdpr_theme_setup9')) {
	add_action( 'after_setup_theme', 'kryptex_gdpr_theme_setup9', 9 );
	function kryptex_gdpr_theme_setup9() {
		if (kryptex_exists_gdpr()) {
			add_filter( 'kryptex_filter_merge_styles',					'kryptex_gdpr_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'kryptex_filter_tgmpa_required_plugins',		'kryptex_gdpr_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'kryptex_gdpr_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('kryptex_filter_tgmpa_required_plugins',	'kryptex_gdpr_tgmpa_required_plugins');
	function kryptex_gdpr_tgmpa_required_plugins($list=array()) {
		if (kryptex_storage_isset('required_plugins', 'gdpr-framework')) {
			$list[] = array(
				'name' 		=> kryptex_storage_get_array('required_plugins', 'gdpr-framework'),
				'slug' 		=> 'gdpr-framework',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'kryptex_exists_gdpr' ) ) {
	function kryptex_exists_gdpr() {
		return function_exists('__gdpr_load_plugin') || defined('GDPR_VERSION');
	}
}


