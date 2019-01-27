<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */


$kryptex_header_css = $kryptex_header_image = '';
$kryptex_header_video = kryptex_get_header_video();
if (true || empty($kryptex_header_video)) {
	$kryptex_header_image = get_header_image();
	if (kryptex_trx_addons_featured_image_override()) $kryptex_header_image = kryptex_get_current_mode_image($kryptex_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($kryptex_header_image) || !empty($kryptex_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($kryptex_header_video!='') echo ' with_bg_video';
					if ($kryptex_header_image!='') echo ' '.esc_attr(kryptex_add_inline_css_class('background-image: url('.esc_url($kryptex_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (kryptex_is_on(kryptex_get_theme_option('header_fullheight'))) echo ' header_fullheight kryptex-full-height';
					?> scheme_<?php echo esc_attr(kryptex_is_inherit(kryptex_get_theme_option('header_scheme'))
													? kryptex_get_theme_option('color_scheme')
													: kryptex_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($kryptex_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (kryptex_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	//get_template_part( 'templates/header-single' );

?></header>