<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0.06
 */

$kryptex_header_css = $kryptex_header_image = '';
$kryptex_header_video = kryptex_get_header_video();
if (true || empty($kryptex_header_video)) {
	$kryptex_header_image = get_header_image();
	if (kryptex_trx_addons_featured_image_override()) $kryptex_header_image = kryptex_get_current_mode_image($kryptex_header_image);
}

$kryptex_header_id = str_replace('header-custom-', '', kryptex_get_theme_option("header_style"));
if ((int) $kryptex_header_id == 0) {
	$kryptex_header_id = kryptex_get_post_id(array(
												'name' => $kryptex_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$kryptex_header_id = apply_filters('kryptex_filter_get_translated_layout', $kryptex_header_id);
}
$kryptex_header_meta = get_post_meta($kryptex_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($kryptex_header_id);
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($kryptex_header_id)));
				echo !empty($kryptex_header_image) || !empty($kryptex_header_video)
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($kryptex_header_video!='')
					echo ' with_bg_video';
				if ($kryptex_header_image!='')
					echo ' '.esc_attr(kryptex_add_inline_css_class('background-image: url('.esc_url($kryptex_header_image).');'));
				if (!empty($kryptex_header_meta['margin']) != '')
					echo ' '.esc_attr(kryptex_add_inline_css_class('margin-bottom: '.esc_attr(kryptex_prepare_css_value($kryptex_header_meta['margin'])).';'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (kryptex_is_on(kryptex_get_theme_option('header_fullheight')))
					echo ' header_fullheight kryptex-full-height';
				?> scheme_<?php echo esc_attr(kryptex_is_inherit(kryptex_get_theme_option('header_scheme'))
												? kryptex_get_theme_option('color_scheme')
												: kryptex_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($kryptex_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('kryptex_action_show_layout', $kryptex_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>