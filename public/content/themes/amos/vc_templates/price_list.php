<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $price
 * @var $currency
 * @var $period
 * @var $bg_color
 * @var $type
 * @var $button_link
 * @var $button_title
 * @var $price_icon
 * Shortcode class
 * @var  WPBakeryShortCode_Price_list
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $amos_redata;
if($type== 'highlighted')
  $bg_color=" ";

		$output = '<div class="wpb_content_element price_table '.esc_attr($type).'" style="border-color:'.esc_attr($bg_color).'">';  


      $output .='<div class="title" style="background-color:'.esc_attr($bg_color).';"><i class="'.esc_attr($price_icon).'"></i><h2>'.$title.'</h2></div>';

      $output .='<div class="price" style="background-color:'.esc_attr($bg_color).';">';
                  
        $output .= '<span class="p"><sup>'.$currency.'</sup>'.$price. '</span><span class="period">'.$period.'</span>';

      $output .= '</div>';

      $output .='<div class="list" style="background-color:'.esc_attr($bg_color).';"><ul>';

        $output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);

      $output .='</ul>';

      $output .= '</div>';

      if(!empty($button_title))

        $output .= '<div class="price_button" style="background-color:'.esc_attr($bg_color).';"><a class="btn-bt '.esc_attr($amos_redata['overall_button_style'][0]).' colored"href="'.esc_url($button_link).'">'.$button_title.'</a></div>';
      
    $output .= '</div>';

    echo amos_output($output);


?>