<?php

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $style
 * @var $text_above
 * @var $inner_style='amos'
 * @var $second_title
 * @var $padding_desc
 * @var $inner_style_title
 * Shortcode class
 * @var $this WPBakeryShortCode_Block_Title
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if($style == 'section_title')
    $inner_style = $inner_style_title;

$output = '<div class="wpb_content_element block_title '.esc_attr($style).' inner-'.esc_attr($inner_style).' ">';


if($inner_style_title=='square' && $inner_style !='inline_border_circle'){
    $output .= '<span class="divider"><span class="line"></span></span>';
     }


if(!empty($text_above))
$output .= '<div class="text_above">'.esc_attr($text_above).'</div>';
    if(!empty($title))
        $output .= '<h1>'.$title.'</h1>';


    if($style == 'column_title' && $inner_style=='inline_border_circle'){
         $output .= '<span class="divider"><span class="circle"><span class="line"></span></span></span>';
     }

     
    if($style == 'column_title' && !empty($second_title))
        $output .= '<h4>'.esc_html($second_title).'</h4>';

    

    
    if($style == 'section_title'){
        if(!empty($content)  && $content != '<br>')
            $output .= '<p style="padding:0 '.esc_attr($padding_desc).';">'.do_shortcode($content).'</p>';
    }

$output .= '</div>';

echo  $output;

?>