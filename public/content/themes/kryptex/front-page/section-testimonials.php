<div class="front_page_section front_page_section_testimonials<?php
			$kryptex_scheme = kryptex_get_theme_option('front_page_testimonials_scheme');
			if (!kryptex_is_inherit($kryptex_scheme)) echo ' scheme_'.esc_attr($kryptex_scheme);
			echo ' front_page_section_paddings_'.esc_attr(kryptex_get_theme_option('front_page_testimonials_paddings'));
		?>"<?php
		$kryptex_css = '';
		$kryptex_bg_image = kryptex_get_theme_option('front_page_testimonials_bg_image');
		if (!empty($kryptex_bg_image))
			$kryptex_css .= 'background-image: url('.esc_url(kryptex_get_attachment_url($kryptex_bg_image)).');';
		if (!empty($kryptex_css))
			echo ' style="' . esc_attr($kryptex_css) . '"';
?>><?php
	// Add anchor
	$kryptex_anchor_icon = kryptex_get_theme_option('front_page_testimonials_anchor_icon');
	$kryptex_anchor_text = kryptex_get_theme_option('front_page_testimonials_anchor_text');
	if ((!empty($kryptex_anchor_icon) || !empty($kryptex_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_testimonials"'
										. (!empty($kryptex_anchor_icon) ? ' icon="'.esc_attr($kryptex_anchor_icon).'"' : '')
										. (!empty($kryptex_anchor_text) ? ' title="'.esc_attr($kryptex_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_testimonials_inner<?php
			if (kryptex_get_theme_option('front_page_testimonials_fullheight'))
				echo ' kryptex-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$kryptex_css = '';
			$kryptex_bg_mask = kryptex_get_theme_option('front_page_testimonials_bg_mask');
			$kryptex_bg_color = kryptex_get_theme_option('front_page_testimonials_bg_color');
			if (!empty($kryptex_bg_color) && $kryptex_bg_mask > 0)
				$kryptex_css .= 'background-color: '.esc_attr($kryptex_bg_mask==1
																	? $kryptex_bg_color
																	: kryptex_hex2rgba($kryptex_bg_color, $kryptex_bg_mask)
																).';';
			if (!empty($kryptex_css))
				echo ' style="' . esc_attr($kryptex_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_testimonials_content_wrap content_wrap">
			<?php
			// Caption
			$kryptex_caption = kryptex_get_theme_option('front_page_testimonials_caption');
			if (!empty($kryptex_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_testimonials_caption front_page_block_<?php echo !empty($kryptex_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($kryptex_caption); ?></h2><?php
			}
		
			// Description (text)
			$kryptex_description = kryptex_get_theme_option('front_page_testimonials_description');
			if (!empty($kryptex_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_testimonials_description front_page_block_<?php echo !empty($kryptex_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($kryptex_description)); ?></div><?php
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_testimonials_output"><?php 
				if (is_active_sidebar('front_page_testimonials_widgets')) {
					dynamic_sidebar( 'front_page_testimonials_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!kryptex_exists_trx_addons())
						kryptex_customizer_need_trx_addons_message();
					else
						kryptex_customizer_need_widgets_message('front_page_testimonials_caption', 'ThemeREX Addons - Testimonials');
				}
			?></div>
		</div>
	</div>
</div>