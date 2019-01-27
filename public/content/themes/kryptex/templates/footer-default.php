<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0.10
 */

$kryptex_footer_scheme =  kryptex_is_inherit(kryptex_get_theme_option('footer_scheme')) ? kryptex_get_theme_option('color_scheme') : kryptex_get_theme_option('footer_scheme');
?>
<footer class="footer_wrap footer_default scheme_<?php echo esc_attr($kryptex_footer_scheme); ?>">
	<?php

	// Footer widgets area
	get_template_part( 'templates/footer-widgets' );

	// Logo
	get_template_part( 'templates/footer-logo' );

	// Socials
	get_template_part( 'templates/footer-socials' );

	// Menu
	get_template_part( 'templates/footer-menu' );

	// Copyright area
	get_template_part( 'templates/footer-copyright' );
	
	?>
</footer><!-- /.footer_wrap -->
