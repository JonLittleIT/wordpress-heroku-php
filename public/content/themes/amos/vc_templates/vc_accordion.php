<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $style
 * Shortcode class
 * @var  WPBakeryShortCode_Vc_Accordion
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';


global $toggles_i;
$toggles_i++;
$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion wpb_content_element '.esc_attr($el_class).' not-column-inherit', $this->settings['base']);
$nr = rand();
$output .= '<div class="'.esc_attr($css_class).'">';
if(!empty($title))
    $output .= '<div class="header"><h3>'.esc_html($title).'</h3></div>';
$output .= "\n\t".'<div class="accordion '.esc_attr($style).'" id="accordion'.$toggles_i.'" data-active-tab="'.esc_attr($active_tab).'">'; //data-interval="'.$interval.'"
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_accordion');
$output .= '</div>';
echo amos_output( $output );