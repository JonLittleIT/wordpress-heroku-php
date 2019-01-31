<?php
 /**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $percentage
 * @var $color
 * Shortcode class
 * @var  WPBakeryShortCode_Skill
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
global $amos_redata;



		if(!isset($skill['color']))

            $color = 'base';

        

        if($color == 'base'){

            $color = $amos_redata['primary_color'];
        }    

        $output .= '<h6 class="skill_title">'.esc_html($title).'</h6><span class="big_percentage">'.$percentage.'%</span>';

        $output .= '<div class="skill animate_onoffset" data-percentage="'.esc_attr($percentage).'">';

 		$output .= '<div class="prog" style="width:0%; background:'.esc_attr($color).';"><span class="circle"></span></div>';

    	$output .= '</div>'; 

    	echo amos_output($output);

?>