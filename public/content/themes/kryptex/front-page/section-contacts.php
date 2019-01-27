<div class="front_page_section front_page_section_contacts<?php
			$kryptex_scheme = kryptex_get_theme_option('front_page_contacts_scheme');
			if (!kryptex_is_inherit($kryptex_scheme)) echo ' scheme_'.esc_attr($kryptex_scheme);
			echo ' front_page_section_paddings_'.esc_attr(kryptex_get_theme_option('front_page_contacts_paddings'));
		?>"<?php
		$kryptex_css = '';
		$kryptex_bg_image = kryptex_get_theme_option('front_page_contacts_bg_image');
		if (!empty($kryptex_bg_image))
			$kryptex_css .= 'background-image: url('.esc_url(kryptex_get_attachment_url($kryptex_bg_image)).');';
		if (!empty($kryptex_css))
			echo ' style="' . esc_attr($kryptex_css) . '"';
?>><?php
	// Add anchor
	$kryptex_anchor_icon = kryptex_get_theme_option('front_page_contacts_anchor_icon');
	$kryptex_anchor_text = kryptex_get_theme_option('front_page_contacts_anchor_text');
	if ((!empty($kryptex_anchor_icon) || !empty($kryptex_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_contacts"'
										. (!empty($kryptex_anchor_icon) ? ' icon="'.esc_attr($kryptex_anchor_icon).'"' : '')
										. (!empty($kryptex_anchor_text) ? ' title="'.esc_attr($kryptex_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_contacts_inner<?php
			if (kryptex_get_theme_option('front_page_contacts_fullheight'))
				echo ' kryptex-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$kryptex_css = '';
			$kryptex_bg_mask = kryptex_get_theme_option('front_page_contacts_bg_mask');
			$kryptex_bg_color = kryptex_get_theme_option('front_page_contacts_bg_color');
			if (!empty($kryptex_bg_color) && $kryptex_bg_mask > 0)
				$kryptex_css .= 'background-color: '.esc_attr($kryptex_bg_mask==1
																	? $kryptex_bg_color
																	: kryptex_hex2rgba($kryptex_bg_color, $kryptex_bg_mask)
																).';';
			if (!empty($kryptex_css))
				echo ' style="' . esc_attr($kryptex_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$kryptex_caption = kryptex_get_theme_option('front_page_contacts_caption');
			$kryptex_description = kryptex_get_theme_option('front_page_contacts_description');
			if (!empty($kryptex_caption) || !empty($kryptex_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($kryptex_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo !empty($kryptex_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($kryptex_caption);
					?></h2><?php
				}
			
				// Description
				if (!empty($kryptex_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo !empty($kryptex_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($kryptex_description));
					?></div><?php
				}
			}

			// Content (text)
			$kryptex_content = kryptex_get_theme_option('front_page_contacts_content');
			$kryptex_layout = kryptex_get_theme_option('front_page_contacts_layout');
			if ($kryptex_layout == 'columns' && (!empty($kryptex_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ((!empty($kryptex_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo !empty($kryptex_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($kryptex_content);
				?></div><?php
			}

			if ($kryptex_layout == 'columns' && (!empty($kryptex_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div><div class="column-2_3"><?php
			}
		
			// Shortcode output
			$kryptex_sc = kryptex_get_theme_option('front_page_contacts_shortcode');
			if (!empty($kryptex_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo !empty($kryptex_sc) ? 'filled' : 'empty'; ?>"><?php
					kryptex_show_layout(do_shortcode($kryptex_sc));
				?></div><?php
			}

			if ($kryptex_layout == 'columns' && (!empty($kryptex_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>