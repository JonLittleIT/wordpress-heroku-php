<?php
 /**
 * Shortcode attributes
 * @var $atts
 * @var $width
 * @var $height
 * @var $color
 * @var $position
 * Shortcode class
 * @var  WPBakeryShortCode_Shape_Divider
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

    $style = '';
    if($width != '')
        $style .= ' width:'.esc_attr($width).'; ';
    if($height != '')
        $style .= ' height:'.esc_attr($height).'; ';
    if($color != '')
        $style .= ' background:'.esc_attr($color).'; ';


        $output .= '<div class="amos-divider-shape no-color " style=" height:350px;" data-front="" data-style="waves_opacity_alt" data-position="bottom">
	        <svg class="shape-divider" fill="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 300" preserveAspectRatio="none" style="'.$style.'">  
	            <path d="M 1000 270 l 2 -253 c -155 -36 -310 135 -415 164 c -102.64 28.35 -149 -32 -235 -31 c -80 1 -142 53 -229 80 c -65.54 20.34 -101 15 -126 11.61 v 54.39 z"></path> 
	            <path d="M 1000 251 l 2 -222 c -157 -43 -312 144 -405 178 c -101.11 33.38 -159 -47 -242 -46 c -80 1 -153.09 54.07 -229 87 c -65.21 25.59 -104.07 16.72 -126 16.61 v 22.39 z"></path> 
	            <path d="M 1000 275 l 1 -208.29 c -217 -12.71 -306.47 129.15 -404 156.29 c -103 27 -174 -30 -257 -29 c -80 1 -130.09 37.07 -214 70 c -61.23 24 -108 15.61 -130 16.61 v 91.39 z"></path>
	         </svg>
            </div>';


    echo amos_output($output);
?>