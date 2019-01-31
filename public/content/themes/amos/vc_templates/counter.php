<?php
 /**
 * Shortcode attributes
 * @var $atts
 * @var $number
 * @var $text
 * @var $icon
 * Shortcode class
 * @var $this WPBakeryShortCode_Counter
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
         
         wp_enqueue_style( 'odometer-theme-minimal' );
         wp_enqueue_script('odometer.min');
         $output = '<div class="animated_counter">';
             $output .= '<i class="'.esc_attr($icon).'"></i>';
             $output .= '<div class="count_to animate_onoffset">';
                $output .= '<div class="odometer" data-number="'.esc_attr($number).'" data-duration="2000"></div>';
             $output .= '</div>';
             $output .= '<h3>'.esc_html($text).'</h3>';
         $output .= '</div>';
         echo amos_output($output);

?>