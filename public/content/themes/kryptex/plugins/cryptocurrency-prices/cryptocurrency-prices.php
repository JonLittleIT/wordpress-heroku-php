<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('kryptex_cryptocurrency_theme_setup9')) {
	add_action( 'after_setup_theme', 'kryptex_cryptocurrency_theme_setup9', 9 );
	function kryptex_cryptocurrency_theme_setup9() {
		if (kryptex_exists_cryptocurrency()) {
add_action( 'wp_enqueue_scripts', 								'kryptex_cryptocurrency_frontend_scripts', 12 );
			add_filter( 'kryptex_filter_merge_styles',					'kryptex_cryptocurrency_merge_styles');
			add_filter( 'kryptex_filter_merge_scripts',				'kryptex_cryptocurrency_merge_scripts');
		}
		if (is_admin()) {
			add_filter( 'kryptex_filter_tgmpa_required_plugins',		'kryptex_cryptocurrency_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'kryptex_cryptocurrency_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('kryptex_filter_tgmpa_required_plugins',	'kryptex_cryptocurrency_tgmpa_required_plugins');
	function kryptex_cryptocurrency_tgmpa_required_plugins($list=array()) {
		if (kryptex_storage_isset('required_plugins', 'cryptocurrency-prices')) {
			$path = kryptex_get_file_dir('plugins/cryptocurrency-prices/cryptocurrency-prices.zip');
			if (!empty($path) || kryptex_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> kryptex_storage_get_array('required_plugins', 'cryptocurrency-prices'),
					'slug' 		=> 'cryptocurrency-prices',
					'source'	=> !empty($path) ? $path : 'upload://cryptocurrency-prices.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'kryptex_exists_cryptocurrency' ) ) {
	function kryptex_exists_cryptocurrency() {
		return function_exists('cp_shortcode_widget_init');
	}
}


// Redirect filter 'prepare_css' to the plugin
if (!function_exists('kryptex_cryptocurrency_prepare_css')) {
	//Handler of the add_filter( 'kryptex_filter_prepare_css',	'kryptex_cryptocurrency_prepare_css', 10, 2);
	function kryptex_cryptocurrency_prepare_css($css='', $remove_spaces=true) {
		return apply_filters( 'cryptocurrency_filter_prepare_css', $css, $remove_spaces );
	}
}

// Redirect filter 'prepare_js' to the plugin
if (!function_exists('kryptex_cryptocurrency_prepare_js')) {
	//Handler of the add_filter( 'kryptex_filter_prepare_js',	'kryptex_cryptocurrency_prepare_js', 10, 2);
	function kryptex_cryptocurrency_prepare_js($js='', $remove_spaces=true) {
		return apply_filters( 'cryptocurrency_filter_prepare_js', $js, $remove_spaces );
	}
}

// Enqueue cryptocurrency custom styles
if ( !function_exists( 'kryptex_cryptocurrency_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'kryptex_cryptocurrency_frontend_scripts', 12 );
	function kryptex_cryptocurrency_frontend_scripts() {
		if (kryptex_is_on(kryptex_get_theme_option('debug_mode')) && kryptex_get_file_dir('plugins/cryptocurrency-prices/cryptocurrency-prices.css')!='')
			wp_enqueue_style( 'kryptex-cryptocurrency-prices',  kryptex_get_file_url('plugins/cryptocurrency-prices/cryptocurrency-prices.css'), array(), null );
		if (kryptex_is_on(kryptex_get_theme_option('debug_mode')) && kryptex_get_file_dir('plugins/cryptocurrency-prices/cryptocurrency-prices.js')!='')
			wp_enqueue_script( 'kryptex-cryptocurrency-prices', kryptex_get_file_url('plugins/cryptocurrency-prices/cryptocurrency-prices.js'), array('jquery'), null, true );
	}
}

// Merge custom styles
if ( !function_exists( 'kryptex_cryptocurrency_merge_styles' ) ) {
	//Handler of the add_filter('kryptex_filter_merge_styles', 'kryptex_cryptocurrency_merge_styles');
	function kryptex_cryptocurrency_merge_styles($list) {
		$list[] = 'plugins/cryptocurrency-prices/cryptocurrency-prices.css';
		return $list;
	}
}

// Merge custom scripts
if ( !function_exists( 'kryptex_cryptocurrency_merge_scripts' ) ) {
	//Handler of the add_filter('kryptex_filter_merge_scripts', 'kryptex_cryptocurrency_merge_scripts');
	function kryptex_cryptocurrency_merge_scripts($list) {
		$list[] = 'plugins/cryptocurrency-prices/cryptocurrency-prices.js';
		return $list;
	}
}

?>