<?php
global $amos_redata;
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $btn_type
 * @var $second_btn_type
 * @var $link
 * @var $icon
 * @var $align
 * @var $button_bool
 * @var $button_2_title
 * @var $button_2_link
 * Shortcode class
 * @var $this WPBakeryShortCode_Button
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$extra_class = '';

if($button_bool == 'yes'){
	$extra_class .= 'buttons_two al_'.$align;
	$align = '';
}
if($icon != '')
    $has_icon="has_icon";
else $has_icon= "";

$output = '<div class="wpb_content_element button '.$extra_class.'">';
    if($btn_type=='bordered_btn')
        $output .= '<a class="btn-bt bordered_effect align-'.esc_attr($align).' '.$has_icon.' " href="'.esc_url($link).'"><span>'.esc_attr($title).'</span><span class="border first"></span><span class="border second"></span></a>';

    else if($btn_type=='read_more_btn')
    	$output .= '<a class="btn-bt readmore align-'.esc_attr($align).' " href="'.esc_url($link).'"><span>'.esc_attr($title).'</span></a>';

    else if($btn_type=='default'){
    $output .= '<a class="btn-bt align-'.esc_attr($align).' '.esc_attr($amos_redata['overall_button_style'][0]).'  '.$has_icon.' " href="'.esc_url($link).'"><span>'.esc_attr($title).'</span><span class="overlay"></span>';

		if($icon != '')
		$output .= '<i class="'.esc_attr($icon).'"></i>';

		$output .= '</a>';
    }

    if($button_bool =='yes'){

        if($second_btn_type=='bordered_btn')
            $output .= '<a class="btn-bt bordered_effect align-'.esc_attr($align).'  '.$has_icon.' " href="'.esc_url($button_2_link).'"><span>'.esc_attr($button_2_title).'</span></a>';

        else if($second_btn_type=='read_more_btn')
            $output .= '<a class="btn-bt readmore align-'.esc_attr($align).' " href="'.esc_url($button_2_link).'"><span>'.esc_attr($button_2_title).'</span></a>';

        else if($second_btn_type == 'default'){


        	$output .='<a class="btn-bt '.esc_attr($amos_redata['overall_button_style'][0]).' '.$has_icon.' " href="'.esc_url($button_2_link).'"><span>'.esc_attr($button_2_title).'</span><span class="overlay"></span>';

        	if($icon != '')
    		$output .= '<i class="'.esc_attr($icon).'"></i>';

    		$output .= '</a>';

        }


    }

$output .= '</div>';

echo  $output;

?>