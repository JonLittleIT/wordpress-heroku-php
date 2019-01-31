<?php

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );



$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'wpb_text_column wpb_content_element '.esc_attr($el_class), $this->settings['base']);
$css_class .= $this->getCSSAnimation($css_animation);
if(!empty($title))
	$output .= '<div class="header"><h3>'.esc_html($title).'</h3></div>';
$output .= "\n\t".'<div class="'.esc_attr($css_class).'">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content, true);
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> ' . $this->endBlockComment('.wpb_text_column');

echo amos_output( $output );