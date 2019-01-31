<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $icon
 * Shortcode class
 * @var  WPBakeryShortCode_List
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

        $output = '<div class="wpb_content_element list" style="">';       

            $output .= '<ul data-icon="'.esc_attr($icon).'">';
                $output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);
            $output .= '</ul>';

        $output .= '</div>';

        echo amos_output($output);

?>