<?php

/**

||-> Shortcode: Video

*/

function modeltheme_shortcode_video($params, $content) {

    extract( shortcode_atts( 
        array(
            'animation'                 => '',
            'source_vimeo'              => '',
            'source_youtube'            => '',
            'video_source'              => '',
            'vimeo_link_id'             => '',
            'youtube_link_id'           => '',
            'button_image'              => ''
        ), $params ) );

    $thumb      = wp_get_attachment_image_src($button_image, "full");
    $thumb_src  = $thumb[0];

    $html = '';

    // custom javascript
    $html .= '<script>
                jQuery(document).ready(function() {
                  jQuery(".popup-vimeo-video").magnificPopup({
                  	type:"iframe",
	              	disableOn: 700,
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false
				});


                  jQuery(".popup-vimeo-youtube").magnificPopup({
                  	type:"iframe",
             		disableOn: 700,
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false});
                });
                
              </script>';

    

      $html .= '<div class="mt_video text-center row">';
        $html .= '<div class="wow '.esc_attr($animation).'">';
        if ($video_source == 'source_vimeo') {
          $html .= '<a class="popup-vimeo-video" href="https://vimeo.com/'.$vimeo_link_id.'"><img class="buton_image_class" src="'.esc_attr($thumb_src).'" data-src="'.esc_attr($thumb_src).'" alt=""></a>';
          } elseif ($video_source == 'source_youtube') {
            $html .= '<a class="popup-vimeo-youtube" href="https://www.youtube.com/watch?v='.$youtube_link_id.'"><img class="buton_image_class" src="'.esc_attr($thumb_src).'" data-src="'.esc_attr($thumb_src).'" alt=""></a>';
          }
        $html .= '</div>';
      $html .= '</div>';

    return $html;
}

add_shortcode('shortcode_video', 'modeltheme_shortcode_video');


/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( array(
     "name" => esc_attr__("MT - Video", 'modeltheme'),
     "base" => "shortcode_video",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
          "group" => "Options",
          "type" => "attach_images",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Choose image", 'modeltheme' ),
          "param_name" => "button_image",
          "value" => "",
          "description" => esc_attr__( "Choose image for play button", 'modeltheme' )
        ),
        array(
           "group" => "Options",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Video source"),
           "param_name" => "video_source",
           "std" => '',
           "description" => esc_attr__(""),
           "value" => array(
            'Youtube'   => 'source_youtube',
            'Vimeo'     => 'source_vimeo',
            )
        ),
        array(
           "group" => "Options",
           "dependency" => array(
           'element' => 'video_source',
           'value' => array( 'source_vimeo' ),
           ),
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Vimeo id link", 'modeltheme'),
           "param_name" => "vimeo_link_id",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
           "group" => "Options",
           "dependency" => array(
           'element' => 'video_source',
           'value' => array( 'source_youtube' ),
           ),
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Youtube id link", 'modeltheme'),
           "param_name" => "youtube_link_id",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
        )));
}

?>