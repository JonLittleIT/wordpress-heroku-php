<?php

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('kryptex_cryptocurrency_rocket_tools_widget_theme_setup9')) {
	add_action( 'after_setup_theme', 'kryptex_cryptocurrency_rocket_tools_widget_theme_setup9', 9 );
	function kryptex_cryptocurrency_rocket_tools_widget_theme_setup9() {
		if (kryptex_exists_cryptocurrency_price_ticker_widget()) {

		}
		if (is_admin()) {
			add_filter( 'kryptex_filter_tgmpa_required_plugins',		'kryptex_cryptocurrency_rocket_tools_widget_tgmpa_required_plugins' );
		}
	}
}
// Filter to add in the required plugins list
if ( !function_exists( 'kryptex_cryptocurrency_rocket_tools_widget_tgmpa_required_plugins' ) ) {
	function kryptex_cryptocurrency_rocket_tools_widget_tgmpa_required_plugins($list=array()) {
		if (kryptex_storage_isset('required_plugins', 'cryptocurrency-rocket-tools')) {
            $path = kryptex_get_file_dir('plugins/cryptocurrency-rocket-tools/cryptocurrency-rocket-tools.zip');
            if (!empty($path) || kryptex_get_theme_setting('tgmpa_upload')) {
                $list[] = array(
                    'name' => kryptex_storage_get_array('required_plugins', 'cryptocurrency-rocket-tools'),
                    'slug' => 'cryptocurrency-rocket-tools',
                    'source'	=> !empty($path) ? $path : 'upload://cryptocurrency-rocket-tools.zip',
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
		return defined('CRTOOLS_URL');
	}
}


add_action( 'wp_print_footer_scripts', 'kryptex_bootstrap_del', 0 );
function kryptex_bootstrap_del(){
	wp_dequeue_style('datatables-css-bootstrap-3');
	//wp_dequeue_style('datatables-css-bootstrap-3-datatables');
}
?>