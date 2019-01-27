<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('kryptex_mailchimp_get_css')) {
	add_filter('kryptex_filter_get_css', 'kryptex_mailchimp_get_css', 10, 4);
	function kryptex_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = kryptex_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS


.mail_chimp_wrap h4 + p {
	color: {$colors['text_dark']} !important;
}
.mc4wp-form .mc4wp-form-fields input[type="email"] {
	border-color: {$colors['text_dark']};
	color: {$colors['text_dark']} !important;
	opacity: 1;
}
.mc4wp-form .mail_chimp:before {
	color: {$colors['text_dark']} !important;
}
.mc4wp-form .mail_chimp:hover:before {
	color: {$colors['bg_color']} !important;
}
.mc4wp-form .mc4wp-form-fields input[type="email"]::-webkit-input-placeholder { color: {$colors['text_dark']} !important; opacity: 1; }
.mc4wp-form .mc4wp-form-fields input[type="email"]::-moz-placeholder { color: {$colors['text_dark']} !important; opacity: 1; }
.mc4wp-form .mc4wp-form-fields input[type="email"]:-ms-input-placeholder { color: {$colors['text_dark']} !important; opacity: 1; }
.mc4wp-form .mc4wp-form-fields input[type="email"]::placeholder { color: {$colors['text_dark']} !important; opacity: 1; }
.mc4wp-form .mc4wp-alert {
	color: {$colors['text_dark']};
}
CSS;
		}

		return $css;
	}
}
?>