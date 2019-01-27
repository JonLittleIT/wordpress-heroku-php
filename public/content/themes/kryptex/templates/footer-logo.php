<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0.10
 */

// Logo
if (kryptex_is_on(kryptex_get_theme_option('logo_in_footer'))) {
	$kryptex_logo_image = '';
	if (kryptex_is_on(kryptex_get_theme_option('logo_retina_enabled')) && kryptex_get_retina_multiplier(2) > 1)
		$kryptex_logo_image = kryptex_get_theme_option( 'logo_footer_retina' );
	if (empty($kryptex_logo_image))
		$kryptex_logo_image = kryptex_get_theme_option( 'logo_footer' );
	$kryptex_logo_text   = get_bloginfo( 'name' );
	if (!empty($kryptex_logo_image) || !empty($kryptex_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($kryptex_logo_image)) {
					$kryptex_attr = kryptex_getimagesize($kryptex_logo_image);
                    $alt = basename($kryptex_logo_image);
                    $alt = substr($alt,0,strlen($alt) - 4);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($kryptex_logo_image).'" class="logo_footer_image" alt="'.esc_html($alt).'"'.(!empty($kryptex_attr[3]) ? ' ' . wp_kses_data($kryptex_attr[3]) : '').'></a>' ;
				} else if (!empty($kryptex_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($kryptex_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>