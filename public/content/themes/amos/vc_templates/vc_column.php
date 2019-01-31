<?php

global $amos_redata;
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $centered_cont
 * @var $centered_cont_vertical
 * @var $animation
 * @var $column_padding
 * @var $background_color
 * @var $background_color_opacity
 * @var $background_image
 * @var $font_color
 * @var $offset
 * @var $css
 * Shortcode class
 * @var  WPBakeryShortCode_Vc_Column
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );





$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = vc_column_offset_class_merge($offset, $width);



$extra_style = '';
$el_class .= ' wpb_column column_container';

if($centered_cont == 'true') 
	$el_class .= ' centered_col';

if($centered_cont_vertical == 'true')
	$el_class .= ' centered_vertical';

if(!empty($background_image) && !empty($background_color) )
	$el_class .= ' with_overlay';

$overlay_style = '';
if(!empty($background_color)) {
	if($background_color_opacity != '1'){ 
		if(strpos($background_color, '#') == 0){ 
			$rgba_color = vc_hex2rgb($background_color); 

			$overlay_style .= ' background-color: rgba('.$rgba_color[0].','.$rgba_color[1].','.$rgba_color[2].','.$background_color_opacity.'); ';
		}else
			$overlay_style .= ' background-color: '.$background_color.';';
			
	} else {
		$overlay_style .= ' background-color: '.$background_color.'; ';	
	} 
}
$extra_style .= $overlay_style;
if(!empty($background_image)) { 
	$bg_image_src = wp_get_attachment_image_src($background_image, 'full');
	$extra_style .= ' background-image: url(\''.esc_url($bg_image_src[0]).'\'); ';
}
if(!empty($font_color)) 
	$extra_style .= ' color: '.$font_color.';';

if(!empty($background_image))
	$el_class .= ' using_bg';

if($column_padding != 'no-pad' && !empty($column_padding)){
	$el_class .= ' with_padding';
	$extra_style .= 'padding:'.$column_padding;
}


/*
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class.vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base']);

$output .= "\n\t\t".'<div class=" vc_column_container">';

$output .= "\n\t".'<div class="'.$css_class.' '.vc_shortcode_custom_css_class( $css, ' ' ).'" style="'.$extra_style.'" data-animation="'.esc_attr($animation).'" data-delay="'.esc_attr($delay).'">';
if(!empty($background_image) && !empty($background_color) )
	$output .= "\n\r".'<div class="overlay" style="'.$overlay_style.'"></div>';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";
$output .= '</div>';*/


$css_classes = array(
	$this->getExtraClass( $el_class ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_col-has-fill';
}

$wrapper_attributes = array();
$inner_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$inner_class = '';
if(!empty($animation) && $animation != 'none') {
	 $inner_class .= ' with_animation animated';
	 $delay = intval($delay);
}

$inner_attributes[] =  ' style="'.$extra_style.'"';
$inner_attributes[] = 'data-animation="'.esc_attr($animation).'"';
$inner_attributes[] = 'data-delay="'.esc_attr($delay).'"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ) . ' '.(!empty($inner_class) ? $inner_class : '').'" ' . implode( ' ', $inner_attributes ) . '>';

if(!empty($background_image) && !empty($background_color) )
	$output .= "\n\r".'<div class="overlay" style="'.$overlay_style.'"></div>';


$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo amos_output( $output ); 