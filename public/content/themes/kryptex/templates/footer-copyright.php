<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage KRYPTEX
 * @since KRYPTEX 1.0.10
 */

// Copyright area
$kryptex_footer_scheme =  kryptex_is_inherit(kryptex_get_theme_option('footer_scheme')) ? kryptex_get_theme_option('color_scheme') : kryptex_get_theme_option('footer_scheme');
$kryptex_copyright_scheme = kryptex_is_inherit(kryptex_get_theme_option('copyright_scheme')) ? $kryptex_footer_scheme : kryptex_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($kryptex_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$kryptex_copyright = kryptex_prepare_macros(kryptex_get_theme_option('copyright'));
				if (!empty($kryptex_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $kryptex_copyright, $kryptex_matches)) {
						$kryptex_copyright = str_replace($kryptex_matches[1], date_i18n(str_replace(array('{', '}'), '', $kryptex_matches[1])), $kryptex_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($kryptex_copyright));
				}
			?></div>
		</div>
	</div>
</div>
