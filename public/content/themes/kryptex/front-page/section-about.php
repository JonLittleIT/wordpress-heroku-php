<div class="front_page_section front_page_section_about<?php
			$kryptex_scheme = kryptex_get_theme_option('front_page_about_scheme');
			if (!kryptex_is_inherit($kryptex_scheme)) echo ' scheme_'.esc_attr($kryptex_scheme);
			echo ' front_page_section_paddings_'.esc_attr(kryptex_get_theme_option('front_page_about_paddings'));
		?>"<?php
		$kryptex_css = '';
		$kryptex_bg_image = kryptex_get_theme_option('front_page_about_bg_image');
		if (!empty($kryptex_bg_image))
			$kryptex_css .= 'background-image: url('.esc_url(kryptex_get_attachment_url($kryptex_bg_image)).');';
		if (!empty($kryptex_css))
			echo ' style="' . esc_attr($kryptex_css) . '"';
?>><?php
	// Add anchor
	$kryptex_anchor_icon = kryptex_get_theme_option('front_page_about_anchor_icon');
	$kryptex_anchor_text = kryptex_get_theme_option('front_page_about_anchor_text');
	if ((!empty($kryptex_anchor_icon) || !empty($kryptex_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_about"'
										. (!empty($kryptex_anchor_icon) ? ' icon="'.esc_attr($kryptex_anchor_icon).'"' : '')
										. (!empty($kryptex_anchor_text) ? ' title="'.esc_attr($kryptex_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_about_inner<?php
			if (kryptex_get_theme_option('front_page_about_fullheight'))
				echo ' kryptex-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$kryptex_css = '';
			$kryptex_bg_mask = kryptex_get_theme_option('front_page_about_bg_mask');
			$kryptex_bg_color = kryptex_get_theme_option('front_page_about_bg_color');
			if (!empty($kryptex_bg_color) && $kryptex_bg_mask > 0)
				$kryptex_css .= 'background-color: '.esc_attr($kryptex_bg_mask==1
																	? $kryptex_bg_color
																	: kryptex_hex2rgba($kryptex_bg_color, $kryptex_bg_mask)
																).';';
			if (!empty($kryptex_css))
				echo ' style="' . esc_attr($kryptex_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$kryptex_caption = kryptex_get_theme_option('front_page_about_caption');
			if (!empty($kryptex_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo !empty($kryptex_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($kryptex_caption); ?></h2><?php
			}
		
			// Description (text)
			$kryptex_description = kryptex_get_theme_option('front_page_about_description');
			if (!empty($kryptex_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo !empty($kryptex_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($kryptex_description)); ?></div><?php
			}
			
			// Content
			$kryptex_content = kryptex_get_theme_option('front_page_about_content');
			if (!empty($kryptex_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo !empty($kryptex_content) ? 'filled' : 'empty'; ?>"><?php
					$kryptex_page_content_mask = '%%CONTENT%%';
					if (strpos($kryptex_content, $kryptex_page_content_mask) !== false) {
						$kryptex_content = preg_replace(
									'/(\<p\>\s*)?'.$kryptex_page_content_mask.'(\s*\<\/p\>)/i',
									sprintf('<div class="front_page_section_about_source">%s</div>',
												apply_filters('the_content', get_the_content())),
									$kryptex_content
									);
					}
					kryptex_show_layout($kryptex_content);
				?></div><?php
			}
			?>
		</div>
	</div>
</div>