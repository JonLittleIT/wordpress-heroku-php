<?php

/**

||-> Shortcode: Title and Subtitle

*/
function modeltheme_heading_title_subtitle_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'title'               => '',
            'subtitle'            => '',
            'title_color'         => '',
            'subtitle_color'      => '',
            'border_color'        => ''
        ), $params ) ); 
    $content = '<div class="title-subtile-holder">';
    $content .= '<h1 class="section-title '.$title_color.'">'.$title.'</h1>';
    $content .= '<div class="section-border '.$border_color.'"></div>';
    $content .= '<div class="section-subtitle '.$subtitle_color.'">'.$subtitle.'</div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('heading_title_subtitle', 'modeltheme_heading_title_subtitle_shortcode');








/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( 
        array(
            "name" => esc_attr__("MT - Heading with Title and Subtitle", 'modeltheme'),
            "base" => "heading_title_subtitle",
            "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
            "icon" => "smartowl_shortcode",
            "params" => array(
                array(
                    "group" => "Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Section title", 'modeltheme' ),
                    "param_name" => "title",
                    "value" => "",
                    "description" => ""
                ),
                array(
                    "group" => "Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Section subtitle", 'modeltheme'),
                    "param_name" => "subtitle",
                    "value" => "",
                    "description" => ""
                ),
                array(
                    "group" => "Styling",
                    "type" => "dropdown",
                    "holder" => "div",
                    "std" => '',
                    "class" => "",
                    "heading" => esc_attr__("Title Color", 'modeltheme'),
                    "param_name" => "title_color",
                    "description" => "",
                    "value" => array(
                        esc_attr__('Light color title for dark section', 'modeltheme')     => 'light_title',
                        esc_attr__('Dark color title for light section', 'modeltheme')     => 'dark_title'
                    )
                ),
                array(
                    "group" => "Styling",
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__("Border Section Color", 'modeltheme'),
                    "param_name" => "border_color",
                    "std" => '',
                    "description" => "",
                    "value" => array(
                        esc_attr__('Light border for dark section', 'modeltheme')     => 'light_border',
                        esc_attr__('Dark border for light section', 'modeltheme')     => 'dark_border'
                    )
                ),
                array(
                    "group" => "Styling",
                    "type" => "dropdown",
                    "holder" => "div",
                    "std" => '',
                    "class" => "",
                    "heading" => esc_attr__("Subtitle Color", 'modeltheme'),
                    "param_name" => "subtitle_color",
                    "description" => "",
                    "value" => array(
                        esc_attr__('Light color subtitle for dark section', 'modeltheme')     => 'light_subtitle',
                        esc_attr__('Dark color subtitle for light section', 'modeltheme')     => 'dark_subtitle'
                    )
                )
                
            )
        )
    );
}