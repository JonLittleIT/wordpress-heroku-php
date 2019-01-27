<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0.10
 */


// Socials
if ( kryptex_is_on(kryptex_get_theme_option('socials_in_footer')) && ($kryptex_output = kryptex_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php kryptex_show_layout($kryptex_output); ?>
		</div>
	</div>
	<?php
}
?>