<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( !function_exists( 'kryptex_trx_donations_get_css' ) ) {
	add_filter( 'kryptex_filter_get_css', 'kryptex_trx_donations_get_css', 10, 4 );
	function kryptex_trx_donations_get_css($css, $colors, $fonts, $scheme='') {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
.sc_donations_info .sc_donations_supporters_item_amount_value,
.sc_donations_info .sc_donations_supporters_item_name {
	{$fonts['h5_font-family']}
}
CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS
.sc_donations_info .sc_donations_data_number {
	color: {$colors['text_dark']};
}
.sc_donations_info .sc_donations_supporters_item_amount_inner,
.sc_donations_info .sc_donations_supporters_item_info_inner {
	background-color: {$colors['alter_bg_color']};
}
.sc_donations_info .sc_donations_supporters_item:hover .sc_donations_supporters_item_amount_inner,
.sc_donations_info .sc_donations_supporters_item:hover .sc_donations_supporters_item_info_inner {
	background-color: {$colors['alter_bg_hover']};
}
.sc_donations_info .sc_donations_supporters_item_amount_value {
	color: {$colors['alter_link']};
}
.sc_donations_info .sc_donations_supporters_item_name {
	color: {$colors['alter_dark']};
}
.sc_donations_info .sc_donations_supporters_item_amount_date,
.sc_donations_info .sc_donations_supporters_item_message {
	color: {$colors['alter_text']};
}




.sc_donations_info .sc_donations_scale_raised {
	background-color: {$colors['text_hover']};
}
.sc_donations_excerpt b {
	color: {$colors['text_dark']};
}

CSS;
		}
		
		return $css;
	}
}
?>