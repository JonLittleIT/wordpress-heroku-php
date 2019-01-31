<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $dynamic_src
 * @var $hight 
 * @var $desc
 * Shortcode class
 * @var  WPBakeryShortCode_Google_Map
 */
$output = '';
$greyscale_class='';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

		$output = '<div class="wpb_content_element">';  
        $extra_class='';
        $position = 'relative';

        if($greyscale == 'yes')

                $greyscale_class = 'greyscale';

        $output .= '<div class="row-fluid row-google-map '.$greyscale_class.'" style="position:'.$position.'; height:'.esc_attr($height).'px;"><iframe class="googlemap '.$extra_class.'" style="height:'.$height.'px; pointer-events:none;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.esc_url($dynamic_src).'&amp;output=embed"></iframe><div class="desc">'.$desc.'</div>';
        
        $output .= '</div>';
        
        $output .= '</div>';
        echo  $output;

?>