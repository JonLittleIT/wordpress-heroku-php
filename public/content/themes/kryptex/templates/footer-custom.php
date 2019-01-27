<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0.10
 */

$kryptex_footer_scheme =  kryptex_is_inherit(kryptex_get_theme_option('footer_scheme')) ? kryptex_get_theme_option('color_scheme') : kryptex_get_theme_option('footer_scheme');
$kryptex_footer_id = str_replace('footer-custom-', '', kryptex_get_theme_option("footer_style"));
if ((int) $kryptex_footer_id == 0) {
	$kryptex_footer_id = kryptex_get_post_id(array(
												'name' => $kryptex_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$kryptex_footer_id = apply_filters('kryptex_filter_get_translated_layout', $kryptex_footer_id);
}
$kryptex_footer_meta = get_post_meta($kryptex_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($kryptex_footer_id);
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($kryptex_footer_id)));
						if (!empty($kryptex_footer_meta['margin']) != '')
							echo ' '.esc_attr(kryptex_add_inline_css_class('margin-top: '.kryptex_prepare_css_value($kryptex_footer_meta['margin']).';'));
						?> scheme_<?php echo esc_attr($kryptex_footer_scheme);
						?>">
	<?php
    // Custom footer's layout
    do_action('kryptex_action_show_layout', $kryptex_footer_id);
	?>
</footer><!-- /.footer_wrap -->
