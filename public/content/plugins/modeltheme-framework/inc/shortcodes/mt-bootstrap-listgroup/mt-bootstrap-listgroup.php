<?php
/**

||-> Shortcode: Bootstrap List Group

*/
function modeltheme_list_group_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'heading'       => '',
            'description'   => '',
            'active'        => '',
            'animation'     => ''
        ), $params ) ); 
    $content = '';
    $content .= '<a href="#" class="list-group-item '.$active.' animateIn" data-animate="'.$animation.'">';
        $content .= '<h4 class="list-group-item-heading">'.$heading.'</h4>';
        $content .= '<p class="list-group-item-text">'.$description.'</p>';
    $content .= '</a>';
    return $content;
}
add_shortcode('list_group', 'modeltheme_list_group_shortcode');





/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( 
        array(
        "name" => esc_attr__("MT - List group", 'modeltheme'),
        "base" => "list_group",
        "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
        "icon" => "smartowl_shortcode",
        "params" => array(
            array(
                'group' => 'Options',
                'type' => 'dropdown',
                'heading' => __( 'Icon library', 'modeltheme' ),
                'value' => array(
                    __( 'Font Awesome', 'modeltheme' ) => 'fontawesome',
                    __( 'Open Iconic', 'modeltheme' ) => 'openiconic',
                    __( 'Typicons', 'modeltheme' ) => 'typicons',
                    __( 'Entypo', 'modeltheme' ) => 'entypo',
                    __( 'Linecons', 'modeltheme' ) => 'linecons'
                ),
                'param_name' => 'icon_type',
                'description' => __( 'Select icon library.', 'modeltheme' ),
            ),
            array(
                'group' => 'Options',
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'modeltheme' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-info-circle',
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'fontawesome',
                ),
                'description' => __( 'Select icon from library.', 'modeltheme' ),
            ),
            array(
                'group' => 'Options',
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'modeltheme' ),
                'param_name' => 'icon_openiconic',
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'type' => 'openiconic',
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'openiconic',
                ),
                'description' => __( 'Select icon from library.', 'modeltheme' ),
            ),
            array(
                'group' => 'Options',
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'modeltheme' ),
                'param_name' => 'icon_typicons',
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'typicons',
                ),
                'description' => __( 'Select icon from library.', 'modeltheme' ),
            ),
            array(
                'group' => 'Options',
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'modeltheme' ),
                'param_name' => 'icon_entypo',
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'entypo',
                ),
            ),
            array(
                'group' => 'Options',
                'type' => 'iconpicker',
                'heading' => __( 'Icon', 'modeltheme' ),
                'param_name' => 'icon_linecons',
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display
                ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'linecons',
                ),
                'description' => __( 'Select icon from library.', 'modeltheme' ),
            ),
            array(
                "group" => "Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "List group item heading", 'modeltheme' ),
                "param_name" => "heading",
                "value" => esc_attr__( "List group item heading", 'modeltheme' ),
                "description" => ""
            ),
            array(
                "group" => "Options",
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "List group item description", 'modeltheme' ),
                "param_name" => "description",
                "value" => esc_attr__( "Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.", 'modeltheme' ),
                "description" => ""
            ),
            array(
                "group" => "Options",
                "type" => "dropdown",
                "heading" => esc_attr__("Status", 'modeltheme'),
                "param_name" => "active",
                "value" => array(
                    esc_attr__('Active', 'modeltheme')   => 'active',
                    esc_attr__('Normal', 'modeltheme')   => 'normal',
                ),
                "std" => '',
                "holder" => "div",
                "class" => "",
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
        )
    ));
}