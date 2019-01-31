<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * Shortcode class
 * @var  WPBakeryShortCode_Price_List_Item
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

        $output = '<li>';

        		$output .= '<i class=""></i>';
        		$output .= esc_html($title);
        	
        	
        $output .= '</li>';

        echo amos_output($output);

?>