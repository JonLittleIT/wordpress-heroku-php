<?php

/**

||-> Shortcode: Thumbnails Custom Content

*/
function modeltheme_thumbnails_custom_content_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'image'         => '',
            'heading'       => '',
            'description'   => '',
            'active'        => '',
            'button_url'    => '',
            'button_text'   => '',
            'animation'     => ''
        ), $params ) ); 
    $thumb      = wp_get_attachment_image_src($image, "large");
    $thumb_src  = $thumb[0]; 
    $content = '';
    $content .= '<div class="thumbnail animateIn" data-animate="'.$animation.'">';
        $content .= '<img data-holder-rendered="true" src="'.$thumb_src.'" data-src="'.$thumb_src.'" alt="'.$heading.'">';
        $content .= '<div class="caption">';
            if (!empty($heading)) {
                $content .= '<h3>'.$heading.'</h3>';  
            }
            if (!empty($description)) {
                $content .= '<p>'.$description.'</p>';
            }
            if (!empty($button_text)) {
                $content .= '<p><a href="'.$button_url.'" class="btn btn-primary" role="button">'.$button_text.'</a></p>';
            }
        $content .= '</div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('thumbnails_custom_content', 'modeltheme_thumbnails_custom_content_shortcode');





/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( 
        array(
        "name" => esc_attr__("MT - Thumbnails custom content", 'modeltheme'),
        "base" => "thumbnails_custom_content",
        "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
        "icon" => "smartowl_shortcode",
        "params" => array(
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Image source url", 'modeltheme' ),
                "param_name" => "image",
                "value" => "#",
                "description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Heading", 'modeltheme' ),
                "param_name" => "heading",
                "value" => esc_attr__( "Thumbnail label", 'modeltheme' ),
                "description" => ""
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Description", 'modeltheme' ),
                "param_name" => "description",
                "value" => esc_attr__( "Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.", 'modeltheme' ),
                "description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Button URL", 'modeltheme' ),
                "param_name" => "button_url",
                "value" => "#",
                "description" => ""
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Button text", 'modeltheme' ),
                "param_name" => "button_text",
                "value" => esc_attr__( "Button", 'modeltheme' ),
                "description" => ""
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "description" => "",
                "value" => $animations_list
            )
        )
    ));
}