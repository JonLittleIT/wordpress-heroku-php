<?php

/**

||-> Shortcode: Video

*/
      
function modeltheme_shortcode_mt_segment_background($params, $content) {

    extract( shortcode_atts( 
        array(
            // 'animation'                 => '',
            // 'source_vimeo'              => '',
            // 'source_youtube'            => '',
            // 'video_source'              => '',
            // 'vimeo_link_id'             => '',
            'heading'                      => '',
            'heading_color'                => '',
            'segment_bg'                   => ''
        ), $params ) );


    #THUMBNAIL
    $thumb      = wp_get_attachment_image_src($segment_bg, "full");
    $thumb_src  = $thumb[0];


    #BUILD HTML
    $html = '';
    $html .= '<div class="demo-2">';
        $html .= '<div class="segmenter" style="background-image: url('.esc_attr($thumb_src).')"></div>';
        $html .= '<h2 class="trigger-headline trigger-headline--hidden">';
            // Heading
            $length = strlen($heading);
            $singleLetter = array();
            for ($i=0; $i<$length; $i++) {
                $singleLetter[$i] = $heading[$i];
                $html .= '<span style="color: '.$heading_color.'">'.$singleLetter[$i].'</span>';
            }
        $html .= '</h2>';
    $html .= '</div>';
    

    $html .= '<script>
                // (function() {
                //   var headline = document.querySelector(\'.trigger-headline\'),
                //     segmenter = new Segmenter(document.querySelector(\'.segmenter\'), {
                //       pieces: 4,
                //       animation: {
                //         duration: 1500,
                //         easing: \'easeInOutExpo\',
                //         delay: 100,
                //         translateZ: 100
                //       },
                //       parallax: true,
                //       positions: [
                //         {top: 0, left: 0, width: 45, height: 45},
                //         {top: 55, left: 0, width: 45, height: 45},
                //         {top: 0, left: 55, width: 45, height: 45},
                //         {top: 55, left: 55, width: 45, height: 45}
                //       ],
                //       onReady: function() {
                //         segmenter.animate();
                //         headline.classList.remove(\'trigger-headline--hidden\');
                //       }
                //     });
                // })();
              </script>';

    // $html .= '<img class="buton_image_class" src="'.esc_attr($thumb_src).'" data-src="'.esc_attr($thumb_src).'" alt="">';

    return $html;
}

add_shortcode('mt_segment_background', 'modeltheme_shortcode_mt_segment_background');


/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( array(
     "name" => esc_attr__("MT - Segment Background", 'modeltheme'),
     "base" => "mt_segment_background",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
          "group" => "Options",
          "type" => "attach_images",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Choose Background Image", 'modeltheme' ),
          "param_name" => "segment_bg",
          "value" => "",
          "description" => esc_attr__( "Choose image as Segment Background", 'modeltheme' )
        ),
        // array(
        //    "group" => "Options",
        //    "type" => "dropdown",
        //    "holder" => "div",
        //    "class" => "",
        //    "heading" => esc_attr__("Video source"),
        //    "param_name" => "video_source",
        //    "std" => '',
        //    "description" => esc_attr__(""),
        //    "value" => array(
        //     'Youtube'   => 'source_youtube',
        //     'Vimeo'     => 'source_vimeo',
        //     )
        // ),
        // array(
        //    "group" => "Options",
        //    "dependency" => array(
        //    'element' => 'video_source',
        //    'value' => array( 'source_vimeo' ),
        //    ),
        //    "type" => "textfield",
        //    "holder" => "div",
        //    "class" => "",
        //    "heading" => esc_attr__("Vimeo id link", 'modeltheme'),
        //    "param_name" => "vimeo_link_id",
        //    "value" => esc_attr__("", 'modeltheme'),
        //    "description" => ""
        // ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Heading", 'modeltheme'),
           "param_name" => "heading",
           "description" => esc_attr__("Recommended 1x Word", 'modeltheme'),
        ),
        array(
          "group" => "Options",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Heading color", 'modeltheme' ),
          "param_name" => "heading_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose Heading color", 'modeltheme' )
        ),
        // array(
        //   "group" => "Animation",
        //   "type" => "dropdown",
        //   "heading" => esc_attr__("Animation", 'modeltheme'),
        //   "param_name" => "animation",
        //   "std" => '',
        //   "holder" => "div",
        //   "class" => "",
        //   "description" => "",
        //   "value" => $animations_list
        // )
        )));
}

?>