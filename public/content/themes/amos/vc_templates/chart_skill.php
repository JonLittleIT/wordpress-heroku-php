<?php
    global $amos_redata;
    /**
 * Shortcode attributes
 * @var $atts
 * @var $percent
 * @var $text
 * @var $color
 * @var $skill_descr
 * Shortcode class
 * @var $this WPBakeryShortCode_chart_skill
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
	

    $output = '<div class="wpb_content_element chart_skill animate_onoffset">';
        
        if($color == 'base')
            $color = $amos_redata['primary_color'];
        
        $output .= '<div class="chart" data-percent="'.esc_attr($percent).'%"  data-color="'.esc_attr($color).'" data-color2="#f2f2f2">';
            $output .= '<span class="text" style="">'.esc_attr($percent).'%</span>';
        $output .= '</div>';
        
        $output .= '<h5>'.do_shortcode($text).'</h5>';
        $output .= '<div class="description">'.$skill_desc.'</div>';
        
    $output .= '</div>';
    echo amos_output($output);

?>