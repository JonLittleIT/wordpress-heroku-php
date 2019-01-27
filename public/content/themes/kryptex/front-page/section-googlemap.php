<div class="front_page_section front_page_section_googlemap<?php
			$kryptex_scheme = kryptex_get_theme_option('front_page_googlemap_scheme');
			if (!kryptex_is_inherit($kryptex_scheme)) echo ' scheme_'.esc_attr($kryptex_scheme);
			echo ' front_page_section_paddings_'.esc_attr(kryptex_get_theme_option('front_page_googlemap_paddings'));
		?>"<?php
		$kryptex_css = '';
		$kryptex_bg_image = kryptex_get_theme_option('front_page_googlemap_bg_image');
		if (!empty($kryptex_bg_image))
			$kryptex_css .= 'background-image: url('.esc_url(kryptex_get_attachment_url($kryptex_bg_image)).');';
		if (!empty($kryptex_css))
			echo ' style="' . esc_attr($kryptex_css) . '"';
?>><?php
	// Add anchor
	$kryptex_anchor_icon = kryptex_get_theme_option('front_page_googlemap_anchor_icon');
	$kryptex_anchor_text = kryptex_get_theme_option('front_page_googlemap_anchor_text');
	if ((!empty($kryptex_anchor_icon) || !empty($kryptex_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_googlemap"'
										. (!empty($kryptex_anchor_icon) ? ' icon="'.esc_attr($kryptex_anchor_icon).'"' : '')
										. (!empty($kryptex_anchor_text) ? ' title="'.esc_attr($kryptex_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_googlemap_inner<?php
			if (kryptex_get_theme_option('front_page_googlemap_fullheight'))
				echo ' kryptex-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$kryptex_css = '';
			$kryptex_bg_mask = kryptex_get_theme_option('front_page_googlemap_bg_mask');
			$kryptex_bg_color = kryptex_get_theme_option('front_page_googlemap_bg_color');
			if (!empty($kryptex_bg_color) && $kryptex_bg_mask > 0)
				$kryptex_css .= 'background-color: '.esc_attr($kryptex_bg_mask==1
																	? $kryptex_bg_color
																	: kryptex_hex2rgba($kryptex_bg_color, $kryptex_bg_mask)
																).';';
			if (!empty($kryptex_css))
				echo ' style="' . esc_attr($kryptex_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap<?php
			$kryptex_layout = kryptex_get_theme_option('front_page_googlemap_layout');
			if ($kryptex_layout != 'fullwidth')
				echo ' content_wrap';
		?>">
			<?php
			// Content wrap with title and description
			$kryptex_caption = kryptex_get_theme_option('front_page_googlemap_caption');
			$kryptex_description = kryptex_get_theme_option('front_page_googlemap_description');
			if (!empty($kryptex_caption) || !empty($kryptex_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($kryptex_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
					// Caption
					if (!empty($kryptex_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo !empty($kryptex_caption) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post($kryptex_caption);
						?></h2><?php
					}
				
					// Description (text)
					if (!empty($kryptex_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo !empty($kryptex_description) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post(wpautop($kryptex_description));
						?></div><?php
					}
				if ($kryptex_layout == 'fullwidth') {
					?></div><?php
				}
			}

			// Content (text)
			$kryptex_content = kryptex_get_theme_option('front_page_googlemap_content');
			if (!empty($kryptex_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($kryptex_layout == 'columns') {
					?><div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} else if ($kryptex_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
	
				?><div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo !empty($kryptex_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($kryptex_content);
				?></div><?php
	
				if ($kryptex_layout == 'columns') {
					?></div><div class="column-2_3"><?php
				} else if ($kryptex_layout == 'fullwidth') {
					?></div><?php
				}
			}
			
			// Widgets output
			?><div class="front_page_section_output front_page_section_googlemap_output"><?php 
				if (is_active_sidebar('front_page_googlemap_widgets')) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!kryptex_exists_trx_addons())
						kryptex_customizer_need_trx_addons_message();
					else
						kryptex_customizer_need_widgets_message('front_page_googlemap_caption', 'ThemeREX Addons - Google map');
				}
			?></div><?php

			if ($kryptex_layout == 'columns' && (!empty($kryptex_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>