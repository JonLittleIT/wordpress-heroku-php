<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $image
 * @var $video
 * @var $alignment
 * @var $width
 * @var $animation
 * @var $link
 * @var $button_align
 * @var shadow
 * Shortcode class
 * @var  WPBakeryShortCode_Media
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts ); 
        
        if(isset($shadow) && $shadow == 'yes')
            $shadow_box = ' shadow_box';
        if(!$button_align || empty($button_align)){
            $button_align = 'center';
        }

		$output = '<div class="wpb_content_element media media_el '.esc_attr($shadow).' animate_onoffset">';
        $width_style="";
        if($alignment == 'center')
            $width_style = 'style="width:'.$width.'px;position:relative; left:50%; margin-left:-'.($width/2).'px;" ';
        if($type == 'image'){
            if(isset($image)){
            	if(!empty($image)) {
            
	                if(strpos($image, "http://") !== false){
	                    $image = $image;
	                } else {
	                    $bg_image_src = wp_get_attachment_image_src($image, 'full');
	                    $image = $bg_image_src[0];
	                }
	            }
                $output .= '<img src="'.esc_url($image).'"   class="type_image media_animation animation_'.esc_attr($animation).' alignment_'.esc_attr($alignment).'" '.$width_style.' />';
            }
        }

        if($type == 'video'){

            $output .= '<div class="video_embeded button_align '.$button_align.'" '.$width_style.' >';
            
            if(isset($video)){ 

                if (strpos($video, 'youtube') !== false) {
                    
                    preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $video, $matches);
                    $video_id=$matches[1];
                    if($featured_image_video !== ''){
                        $output .= '<img src="'.$featured_image_video.'" class="video_poster"></img>';
                    }
                    $output .= '<div data-type="youtube" data-video-id="'.$video_id.'">';
                    $output .= '</div>';

                }

                else if (strpos($video, 'vimeo') !== false) {
                    
                $urlParts = explode("/", parse_url($video, PHP_URL_PATH));
                $video_id = (int)$urlParts[count($urlParts)-1];

                  
                    $output .= '<div data-type="vimeo"  data-video-id="'.$video_id.'"></div>';
                }

                else if(amos_backend_is_file( $video, 'html5video')){

                    $output .= amos_html5_video_embed($video, $featured_image_video);

                }

                else if(strpos($video, 'webm') !== false || strpos($video, 'mp4') !== false){
                        global $wp_embed;
                        $embed = '';
                        $video = amos_html5_video_embed($video, $featured_image_video);
                        if ( is_object( $wp_embed ) ) {
                        $output .= $wp_embed->run_shortcode('[embed class="animation_'.$animation.' video alignment_'.$alignment.' '.$width_style.'"]'.trim($video).'[/embed]');
                        
                    
                           }
                        

                }

            }
            $output .= '</div>';
        }

     
        
        $output .= '</div>';
        echo amos_output($output); 
?>