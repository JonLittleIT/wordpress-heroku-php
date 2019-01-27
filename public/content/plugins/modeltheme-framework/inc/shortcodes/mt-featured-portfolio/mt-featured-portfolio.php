<?php 

require_once(__DIR__.'/../vc-shortcodes.inc.arrays.php');

/**
||-> Shortcode: Featured Product
*/
function mt_shortcode_featured_portfolio($params,  $content = NULL) {
    extract( shortcode_atts( 
        array(
            'el_class'              => ''
        ), $params ) );

    $html = '';
    $html .= '<div class="mt_featured_portfolio_shortcode row">';
        $html .= do_shortcode($content);
    $html .= '</div>';
    return $html;
}
add_shortcode('mt_featured_portfolio_shortcode', 'mt_shortcode_featured_portfolio');



/**
||-> Shortcode: Child Shortcode
*/
function mt_shortcode_featured_portfolio_items($params, $content = NULL) {
    extract( shortcode_atts( 
        array(
            'featured_portfolio_item_title'           => '',
            'featured_portfolio_item_categories'      => '',
            'featured_portfolio_item_client'          => '',
            'featured_portfolio_item_tags'            => '',
            'featured_portfolio_item_image'           => '',
            'label_color'                             => '',
            'details_color'                           => '',
            'style'                                   => ''
        ), $params ) );


    $html = '';

    $html .= '<div class="mt_featured_portfolio_shortcode_item '.$style.'">';
        $img = wp_get_attachment_image_src($featured_portfolio_item_image, 'full'); 
        if (isset($featured_portfolio_item_image)) {
            $html .= '<img class="featured_portfolio_item_image" src="'.$img[0].'" alt="" />';
        }
        $html .= '<div class="featured_portfolio_details_container row">';
          if($style == 'vc_col-md-6 vc_col-sm-6 vc_col-xs-12') {
            $html .= '<div class="featured_portfolio_details_container_column1 number_items_2 vc_col-md-6">';
          } elseif ($style == 'vc_col-md-4 vc_col-sm-6 vc_col-xs-12') {
            $html .= '<div class="featured_portfolio_details_container_column1 number_items_3 vc_col-md-12">';
          } elseif ($style == 'vc_col-md-3 vc_col-sm-6 vc_col-xs-12') {
            $html .= '<div class="featured_portfolio_details_container_column1 number_items_4 vc_col-md-12">';
          }
            if (!empty($featured_portfolio_item_title)) {
                $html .= '<p class="featured_portfolio_item_text featured_portfolio_item_title" style="color: '.$details_color.' !important;"><span class="mt_featured_portfolio_label" style="color: '.$label_color.' !important;">Title: </span>'.$featured_portfolio_item_title.'</p>';
            }
            if (!empty($featured_portfolio_item_categories)) {
                $html .= '<p class="featured_portfolio_item_text featured_portfolio_item_categories" style="color: '.$details_color.' !important;"><span class="mt_featured_portfolio_label" style="color: '.$label_color.' !important;">Categories: </span>'.$featured_portfolio_item_categories.'</p>';
            }
          $html .= '</div>';
          if($style == 'vc_col-md-6 vc_col-sm-6 vc_col-xs-12') {
            $html .= '<div class="featured_portfolio_details_container_column2 number_items_2 vc_col-md-6">';
          } elseif ($style == 'vc_col-md-4 vc_col-sm-6 vc_col-xs-12') {
            $html .= '<div class="featured_portfolio_details_container_column2 number_items_3 vc_col-md-12">';
          } elseif ($style == 'vc_col-md-3 vc_col-sm-6 vc_col-xs-12') {
            $html .= '<div class="featured_portfolio_details_container_column2 number_items_2 vc_col-md-12">';
          }
            if (!empty($featured_portfolio_item_client)) {
                $html .= '<p class="featured_portfolio_item_text featured_portfolio_item_client" style="color: '.$details_color.' !important;"><span class="mt_featured_portfolio_label" style="color: '.$label_color.' !important;">Client: </span>'.$featured_portfolio_item_client.'</p>';
            }
            if (!empty($featured_portfolio_item_client)) {
                $html .= '<p class="featured_portfolio_item_text featured_portfolio_item_tags" style="color: '.$details_color.' !important;"><span class="mt_featured_portfolio_label" style="color: '.$label_color.' !important;">Tags: </span>'.$featured_portfolio_item_tags.'</p>';
            }
          $html .= '</div>';
        $html .= '</div>';
    $html .= '</div>';

    return $html;
}
add_shortcode('mt_featured_portfolio_shortcode_item', 'mt_shortcode_featured_portfolio_items');



/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    //require_once('../vc-shortcodes.inc.arrays.php');

    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map( array(
        "name" => esc_attr__("MT - Unique portfolio", 'modeltheme'),
        "base" => "mt_featured_portfolio_shortcode",
        "as_parent" => array('only' => 'mt_featured_portfolio_shortcode_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => true,
        "icon" => "smartowl_shortcode",
        "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
        "is_container" => true,
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "modeltheme"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme")
            ),

        ),
        "js_view" => 'VcColumnView'
    ) );
    vc_map( array(
        "name" => esc_attr__("Unique portfolio item", 'modeltheme'),
        "base" => "mt_featured_portfolio_shortcode_item",
        "content_element" => true,
        "as_child" => array('only' => 'mt_restaurant_menu'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            array(
                "group" => "General Options",
                "type" => "dropdown",
                "heading" => esc_attr__("Style", 'modeltheme'),
                "param_name" => "style",
                "std" => '',
                "holder" => "div",
                "class" => "",
                "description" => "",
                "value" => array(
                    esc_attr__('2 columns', 'modeltheme')  => 'vc_col-md-6 vc_col-sm-6 vc_col-xs-12',
                    esc_attr__('3 columns', 'modeltheme') => 'vc_col-md-4 vc_col-sm-6 vc_col-xs-12',
                    esc_attr__('4 columns', 'modeltheme') => 'vc_col-md-3 vc_col-sm-6 vc_col-xs-12',
                )
            ),
            array(
                "group"        => "General Options",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "featured_portfolio_item_title",
                "heading"      => esc_attr__("Title", 'modeltheme'),
                "description"  => esc_attr__("Enter title for your unique portfolio item(Eg: Unique Portfolio)", 'modeltheme'),
            ),
            array(
                "group"        => "General Options",
                "type"         => "textarea",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "featured_portfolio_item_categories",
                "heading"      => esc_attr__("Categories", 'modeltheme'),
                "description"  => esc_attr__("Enter the categories for your unique portfolio item(Eg: Vector, Abstract)", 'modeltheme'),
            ),
            array(
                "group"        => "General Options",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "featured_portfolio_item_client",
                "heading"      => esc_attr__("Client", 'modeltheme'),
                "description"  => esc_attr__("Enter the client name for your unique portfolio item(Eg: Microsoft)", 'modeltheme'),
            ),
            array(
                "group"        => "General Options",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "featured_portfolio_item_tags",
                "heading"      => esc_attr__("Tags", 'modeltheme'),
                "description"  => esc_attr__("Enter the tags for your unique portfolio item(Eg: Abstract, Geometric)", 'modeltheme'),
            ),
            array(
                "group"         => "General Options",
                "type"          => "attach_image",
                "holder"        => "div",
                "class"         => "",
                "heading"       => esc_attr__( "Thumbnail", 'modeltheme' ),
                "param_name"    => "featured_portfolio_item_image",
                "description"   => ""
            ),
            array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Label color", 'modeltheme' ),
                "param_name" => "label_color",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose label color", 'modeltheme' )
            ),
            array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Details color", 'modeltheme' ),
                "param_name" => "details_color",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose details color", 'modeltheme' )
            ),
            array(
                "group" => "Extra Options",
                "type" => "textfield",
                "heading" => __("Extra class name", "modeltheme"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme")
            )
            
        )
    ) );


    //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Mt_Featured_Portfolio_Shortcode extends WPBakeryShortCodesContainer {
        }
    }
    if ( class_exists( 'WPBakeryShortCode' ) ) {
        class WPBakeryShortCode_Mt_Featured_Portfolio_Shortcode_Item extends WPBakeryShortCode {
        }
    }


}
?>