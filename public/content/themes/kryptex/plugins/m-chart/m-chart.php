<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('kryptex_chart_theme_setup9')) {
	add_action( 'after_setup_theme', 'kryptex_chart_theme_setup9', 9 );
	function kryptex_chart_theme_setup9() {
		if (kryptex_exists_chart()) {

		}
		if (is_admin()) {
			add_filter( 'kryptex_filter_tgmpa_required_plugins',		'kryptex_chart_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'kryptex_chart_tgmpa_required_plugins' ) ) {
	function kryptex_chart_tgmpa_required_plugins($list=array()) {
		if (kryptex_storage_isset('required_plugins', 'm-chart')) {
			$path = kryptex_get_file_dir('plugins/m-chart/m-chart.zip');
			if (!empty($path) || kryptex_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' => kryptex_storage_get_array('required_plugins', 'm-chart'),
					'slug' => 'm-chart',
					'source' => !empty($path) ? $path : 'upload://m-chart.zip',
					'required' => false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'kryptex_exists_chart' ) ) {
	function kryptex_exists_chart() {
		return function_exists('m_chart');
	}
}


?>