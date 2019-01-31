<?php
global $amos_redata;

/**
 * Shortcode attributes
 * @var $atts
 * @var $type='in_container'
 * @var $bg_image
 * @var $bg_position
 * @var $bg_repeat
 * @var $parallax_bg
 * @var $bg_color
 * @var $bg_color_2
 * @var $equal_height
 * @var $overlay
 * @var $overlay_color
 * @var $row_shape
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_webm
 * @var $video_mp4
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_image_src
 * @var $top_padding
 * @var $bottom_padding
 * @var $text_color
 * @var $custom_text_color
 * @var $transparency
 * @var $borders
 * @var $arrow_bottom
 * @var $arrow_top
 * @var $class
 * @var $full_height
 * Shortcode class
 * @var  WPBakeryShortCode_Vc_Row
 */

$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax  = $video_bg = $videp_bg_url = $parallax_speed_bg = $parallax_image_src = $bg_color_2 ='';

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

	

	

	wp_enqueue_style( 'js_composer_front' );

	wp_enqueue_script( 'wpb_composer_front_js' );

	$wrapper_attributes = array();

    $style = null;

	$etxra_class = null;

	$bg_im = '';


	if(!empty($bg_image)) {

			

		if(strpos($bg_image, "http://") !== false){

				
			if(!$parallax_bg){
				$style .= 'background-image: url('. esc_url($bg_image) . '); ';

				$style .= 'background-position: '. $bg_position .'; ';
			}
			

			$bg_im = $bg_image;

		} else {

			$bg_image_src = wp_get_attachment_image_src($bg_image, 'full');

			
			if(!$parallax_bg){
				$style .= 'background-image: url('. esc_url($bg_image_src[0]). '); ';

				$style .= 'background-position: '. $bg_position .'; ';


			}
			

			$bg_im = $bg_image_src[0];

		}

		

		//for pattern bgs

		if(strtolower($bg_repeat) == 'repeat'){

			$style .= 'background-repeat: '. strtolower($bg_repeat) .'; ';



			$etxra_class = 'no-cover';

		} else {

			$style .= 'background-repeat: '. strtolower($bg_repeat) .'; ';

			$style .= 'background-size: cover; ';
			
			$etxra_class = null;

		}

	}

	if ( ! empty( $full_height ) ) {
	$etxra_class .= ' vc_row-o-full-height';
	}
		if ( ! empty( $equal_height ) ) {
		$etxra_class .= ' vc_row-o-equal-height vc_row-flex';
	}

	if (!empty($gap)) {
		$etxra_class = 'vc_column-gap-'.$atts['gap'];
	}

	if(!empty($row_shape)){
		
		$etxra_class .= ' '.$row_shape;
	}

	if(!empty($bg_color)) {

		if($bg_color == 'base'){
			$bg_color = $amos_redata['primary_color'];
		}

		$style .= 'background-color: '. $bg_color.'; ';

	}


	if(!empty($bg_color_2) && !empty($bg_color)) {

		if($bg_color == 'base'){
			$bg_color = $amos_redata['primary_color'];
		}

		$style .= 'background-color: '. $bg_color.'; ';
		$style .= 'background: -moz-linear-gradient(45deg, '.$bg_color.' 0%, '.$bg_color_2.' 100%);';
		$style .= 'background: -webkit-linear-gradient(45deg, '.$bg_color.' 0%, '.$bg_color_2.' 100%);';
		$style .= 'background: linear-gradient(45deg, '.$bg_color.' 0%, '.$bg_color_2.' 100%);';
   
	}

	

	if(strtolower($parallax_bg) == 'true'){

		$parallax_class = 'parallax_section';

	} else {

		$parallax_class = '';

	}

	
	if($top_padding != '')
		$style .= 'padding-top: '. $top_padding .'px ; ';
	if($bottom_padding != '')
		$style .= 'padding-bottom: '. $bottom_padding .'px ; ';

	

	if($text_color == 'custom' && !empty($custom_text_color)) {

		$style .= 'color: '. $custom_text_color .'; ';

	}

	

	//main class

	if($type == 'in_container') {

		

		$main_class = "standard_section ";

		

	} else if($type == 'full_width_background'){

		

		$main_class = "section-style ";

		

	} else if($type == 'full_width_content'){

		

		$main_class = "full-width-content section-style ";

	}

	

	if($video_bg)

		$etxra_class .= ' video_section '; 

	 

	$video_markup = '';

	$overlay_markup = ''; 

	$parallax_markup = '';

	/* video and parallax*/

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ));
$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}



	if($video_bg && $video_bg_url =='') {



	   $video_markup = '<div class="video-wrap"><video id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0"> ';


       $video_markup .= '<source src="'.esc_url($video_bg).'" type="video/webm"> 

                        <source src="'.esc_url($video_bg).'" type="video/mp4"> 

                                                      

                        Video not supported ';
      
       

       $video_markup .= '</video></div>';

	

	} 



	if($overlay){
		if(strpos($overlay_color, "#") !== false)
			$overlay_color = 'rgba('.implode(',', amos_hexToRgb($overlay_color)).',0.8 )';
		$overlay_markup = '<div class="bg-overlay" style="background:'.$overlay_color.';"></div>';

	}
	$animate_onoffset = '';
	$animate_onoffset_c = '';
	if($parallax_bg){

		$style .= ' background-image: url('.esc_url($bg_im).'); background-position: 50% 0px; ';
		$animate_onoffset_c = 'animate_onoffset';
	}else
		$animate_onoffset = 'animate_onoffset';

	

	$transparency_markup = '';
	$transparency_class = '';
	if($transparency){
		$transparency_markup = '<span class="inner_shadow"></span><div class="transparency_bg"></div>';
		$transparency_class = 'transparency_section';
	}

	$arrow_markup_bottom = '';

	if($arrow_bottom){
		$arrow_markup_bottom .= '<span class="arrow_bottom" style="border-color: '.$bg_color.' transparent transparent transparent;"></span>';
	}

	$arrow_markup_top = '';
	if($arrow_top){
		$arrow_markup_top .= '<span class="arrow_top" style="border-color: transparent transparent '.$bg_color.' transparent;"></span>';
	}

	if($borders)
		$etxra_class .= ' borders ';

	if($amos_redata['fullscreen_sections_active'])
		$etxra_class .= ' section ';


	if($type != 'full_width_content')

		$cl_class = 'container';

	else

		$cl_class = 'col span_12';

	//if columns equal height then the container is above the row
	if ( ! empty( $equal_height ) ) {
    echo '<div class="'.esc_attr($cl_class).' '.esc_attr($animate_onoffset_c).' '.strtolower($text_color).'">';
	}


    echo'<div id="'.uniqid("fws_").'" class="wpb_row vc_row vc_row-fluid '.esc_attr($transparency_class).' '.esc_attr($animate_onoffset).' row-dynamic-el '. esc_attr($main_class) . esc_attr($parallax_class) . ' ' . esc_attr($class) . ' ' . esc_attr($etxra_class).' " ' . implode( ' ', $wrapper_attributes ) . ' style="'.$style.'">';
    echo '<div '.( (!empty($class))?'id="'.$class.'"':'').' style="position: absolute;top: 0;"></div>';
	
    if($amos_redata['fullscreen_sections_active'])
    	echo '<div class="fullscreen_inner">';
	echo amos_output($transparency_markup);

	echo amos_output($arrow_markup_top);
 


	echo amos_output($video_markup);

	echo amos_output($overlay_markup);

	if (  empty( $equal_height ) ) {//if columns equal height then the container is above the row

    echo '<div class="'.esc_attr($cl_class).' '.esc_attr($animate_onoffset_c).' '.strtolower($text_color).'">';

	

    	if($cl_class == 'container')
    		echo '<div class="section_clear">';
    }
    	

    	echo wpb_js_remove_wpautop($content);

if (  empty( $equal_height ) ) {
    	if($cl_class == 'container')
    		echo '</div>';
    	

    echo '</div>';
}

    if($amos_redata['fullscreen_sections_active'])
    	echo '</div>';

    echo amos_output($arrow_markup_bottom);

 echo '</div>';

 if ( ! empty( $equal_height ) ) {
if($cl_class == 'container')
    		echo '</div>';
 }

?>