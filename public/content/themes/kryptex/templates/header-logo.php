<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0
 */

$kryptex_args = get_query_var('kryptex_logo_args');

// Site logo
$kryptex_logo_type   = isset($kryptex_args['type']) ? $kryptex_args['type'] : '';
$kryptex_logo_image  = kryptex_get_logo_image($kryptex_logo_type);
$kryptex_logo_text   = kryptex_is_on(kryptex_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$kryptex_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($kryptex_logo_image) || !empty($kryptex_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($kryptex_logo_image)) {
			if (empty($kryptex_logo_type) && function_exists('the_custom_logo') && (int) $kryptex_logo_image > 0) {
				the_custom_logo();
			} else {
				$kryptex_attr = kryptex_getimagesize($kryptex_logo_image);
                $alt = basename($kryptex_logo_image);
                $alt = substr($alt,0,strlen($alt) - 4);
				echo '<img src="'.esc_url($kryptex_logo_image).'" alt="'.esc_html($alt).'"'.(!empty($kryptex_attr[3]) ? ' '.wp_kses_data($kryptex_attr[3]) : '').'>';
			}
		} else {
			kryptex_show_layout(kryptex_prepare_macros($kryptex_logo_text), '<span class="logo_text">', '</span>');
			kryptex_show_layout(kryptex_prepare_macros($kryptex_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>