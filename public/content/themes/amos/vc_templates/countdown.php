<?php
 /**
 * Shortcode attributes
 * @var $atts
 * @var $year
 * @var $month
 * @var $day
 * Shortcode class
 * @var $this WPBakeryShortCode_Countdown
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

		$output = '<div class="wpb_content_element countdown">';

        

        $output .= '<div id="countdowndiv" data-year="'.$year.'" data-month="'.$month.'" data-day="'.$day.'"></div>';

 

         

        $output .= '</div>';

        echo amos_output($output); 

?>