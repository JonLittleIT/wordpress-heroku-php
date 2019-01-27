<?php 

/**

||-> Shortcode: Progress Bar

*/
function modeltheme_progress_bar_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'bar_label'       => '',
            'bar_label_color'       => '',
            'bar_bg'       => '',
            'bar_value'       => ''
        ), $params ) );
    $content = '';
    $content .= '<div class="barWrapper mt_progress_bar">';
        $content .= '<div class="progressText" style="color: '.$bar_label_color.';">';
            $content .= '<span class="pull-left">'.$bar_label.'</span>';
            $content .= '<span class="pull-right">'.$bar_value.'%</span>';
        $content .= '</div>';
        $content .= '<div class="clearfix"></div>';
        $content .= '<div class="progress">';
            $content .= '<div class="progress-bar" role="progressbar" aria-valuenow="'.$bar_value.'" aria-valuemin="0" aria-valuemax="100" style="background-color: '.$bar_bg.';">';
                $content .= '<span  class="popOver" data-toggle="tooltip" data-placement="top" title="'.$bar_value.'%"> </span>';
            $content .= '</div>';
        $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="clearfix"></div>';
    return $content;
}
add_shortcode('progress_bar', 'modeltheme_progress_bar_shortcode');



/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( 
        array(
        "name" => esc_attr__("MT - Progress bar", 'modeltheme'),
        "base" => "progress_bar",
        "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
        "icon" => "smartowl_shortcode",
        "params" => array(
            array(
                "group" => "Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__("Value (1-100)", 'modeltheme'),
                "param_name" => "bar_value",
                "value" => "",
                "description" => ""
            ),
            array(
                "group" => "Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__("Label", 'modeltheme'),
                "param_name" => "bar_label",
                "value" => "",
                "description" => ""
            ),
            array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Bar Background color", 'modeltheme' ),
                "param_name" => "bar_bg",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose Bar Background color(Default: #7023FF)", 'modeltheme' )
            ),
            array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Label Text color", 'modeltheme' ),
                "param_name" => "bar_label_color",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose Label color(Default: #252525)", 'modeltheme' )
            ),
        )
    ));
}