<?php

/**

||-> Shortcode: Custom Service

*/
function modeltheme_shortcode_custom_service($params, $content) {

    extract( shortcode_atts( 
        array(
            'animation'                           => '',
            'custom_service_background'           => '',
            'custom_service_image'                => '',
            'custom_service_second_title'         => '',
            'custom_service_title_color'          => '',
            'custom_service_description_color'    => '',
            'custom_service_button_color'         => '',
            'custom_service_button_link'          => '',
            'custom_service_button_text'          => '',
            'custom_service_description'          => ''
        ), $params ) );

    $thumb      = wp_get_attachment_image_src($custom_service_image, "connection_portfolio01_390x275");
    $thumb_src  = $thumb[0];

    $html = '';

    $html .= '<style type="text/css" scoped>
                .mt--custom_services:hover {
                    background-color: '.esc_attr($custom_service_background).' !important;
                }
                .mt--custom_services .hover_container .hover_container_holder .custom_service_second_title {
                    color: '.esc_attr($custom_service_title_color).';
                }
                .mt--custom_services .hover_container .hover_container_holder .custom_service_description {
                    color: '.esc_attr($custom_service_description_color).'; 
                }
                .mt--custom_services .hover_container .more-link {
                    color: '.esc_attr($custom_service_button_color).';  
                }
                .mt--custom_services .hover_container {
                    background-color: rgba(35, 35, 49, 0.7);
                }
              </style>';

      $html .= '<div class="mt--custom_services row">';
        $html .= '<div class="wow '.esc_attr($animation).'">';

          // $html .= '<div class="service_overlay"></div>';

          $html .= '<img src="'.esc_attr($thumb_src).'" data-src="'.esc_attr($thumb_src).'" alt="">';


          // hover_container
          $html .= '<div class="hover_container">';
            $html .= '<div class="hover_container_holder">';
              $html .= '<h1 class="custom_service_second_title">'.esc_attr($custom_service_second_title).'</h1>';
              $html .= '<p class="custom_service_description">'.esc_attr($custom_service_description).'</p>';
              $html .= '<a class="more-link" href="'.esc_attr($custom_service_button_link).'">'.esc_attr($custom_service_button_text).'</a>';


            $html .= '</div>';
          $html .= '</div>';

          // hover color
          // $html .= '<div class="hovered_container" style="background-color:'.esc_attr($custom_service_background).'";>';
          //   $html .= '<div class="hovered_container_holder"></div>';
          // $html .= '</div>';

        $html .= '</div>';
			$html .= '</div>';

    return $html;
}
add_shortcode('shortcode_custom_service', 'modeltheme_shortcode_custom_service');



/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( array(
     "name" => esc_attr__("MT - Custom Service", 'modeltheme'),
     "base" => "shortcode_custom_service",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
          "group" => "Options",
          "type" => "attach_images",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Choose image", 'modeltheme' ),
          "param_name" => "custom_service_image",
          "value" => "",
          "description" => esc_attr__( "Choose image for custom service", 'modeltheme' )
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Choose custom service second title (Heading)", 'modeltheme'),
          "param_name" => "custom_service_second_title",
          "value" => esc_attr__("", 'modeltheme'),
          "description" => ""
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Choose custom service description", 'modeltheme'),
          "param_name" => "custom_service_description",
          "value" => esc_attr__("", 'modeltheme'),
          "description" => ""
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Enter the button link", 'modeltheme'),
          "param_name" => "custom_service_button_link",
          "value" => esc_attr__("", 'modeltheme'),
          "description" => ""
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Enter the button text", 'modeltheme'),
          "param_name" => "custom_service_button_text",
          "value" => esc_attr__("", 'modeltheme'),
          "description" => ""
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Custom service background", 'modeltheme' ),
          "param_name" => "custom_service_background",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose background", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Custom service title color", 'modeltheme' ),
          "param_name" => "custom_service_title_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose title color for this service", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Custom service description color", 'modeltheme' ),
          "param_name" => "custom_service_description_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose description color for this service", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Custom service button color", 'modeltheme' ),
          "param_name" => "custom_service_button_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose button color for this service", 'modeltheme' )
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