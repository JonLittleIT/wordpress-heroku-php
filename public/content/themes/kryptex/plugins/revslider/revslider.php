<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('kryptex_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'kryptex_revslider_theme_setup9', 9 );
	function kryptex_revslider_theme_setup9() {
		if (kryptex_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'kryptex_revslider_frontend_scripts', 1100 );
			add_filter( 'kryptex_filter_merge_styles',			'kryptex_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'kryptex_filter_tgmpa_required_plugins','kryptex_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'kryptex_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('kryptex_filter_tgmpa_required_plugins',	'kryptex_revslider_tgmpa_required_plugins');
	function kryptex_revslider_tgmpa_required_plugins($list=array()) {
		if (kryptex_storage_isset('required_plugins', 'revslider')) {
			$path = kryptex_get_file_dir('plugins/revslider/revslider.zip');
			if (!empty($path) || kryptex_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> kryptex_storage_get_array('required_plugins', 'revslider'),
					'slug' 		=> 'revslider',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'kryptex_exists_revslider' ) ) {
	function kryptex_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'kryptex_revslider_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'kryptex_revslider_frontend_scripts', 1100 );
	function kryptex_revslider_frontend_scripts() {
		if (kryptex_is_on(kryptex_get_theme_option('debug_mode')) && kryptex_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'kryptex-revslider',  kryptex_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'kryptex_revslider_merge_styles' ) ) {
	//Handler of the add_filter('kryptex_filter_merge_styles', 'kryptex_revslider_merge_styles');
	function kryptex_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>