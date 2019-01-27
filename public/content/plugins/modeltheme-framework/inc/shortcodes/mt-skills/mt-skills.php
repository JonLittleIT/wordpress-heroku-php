<?php

/**

||-> Shortcode: Skills

*/
function modeltheme_skills_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'icon_or_image'            => '', 
            'animation'                => '', 
            'icon'                     => '', 
            'title'                    => '',
            'skillvalue'               => '',
            'border_color'             => '',
            'text_color_value'         => '',
            'number_color_value'       => '',
            'image_skill'              => ''
        ), $params ) );

    $image_skill      = wp_get_attachment_image_src($image_skill, "linify_skill_counter_65x65");
    $image_skillsrc  = $image_skill[0];

    $skill = '';
    $skill .= '<div class="stats-block statistics wow '.esc_attr($animation).'" style="border: 2px solid '.esc_attr($border_color).'">';
        $skill .= '<div class="stats-head">';
            $skill .= '<p class="stat-number skill" style="border-bottom: 2px solid '.esc_attr($border_color).'">';
              if($icon_or_image == 'choosed_icon'){
                $skill .= '<i class="'.esc_attr($icon).'"></i>';
              } elseif($icon_or_image == 'choosed_image') {
                $skill .= '<img src="'.esc_attr($image_skillsrc).'" data-src="'.esc_attr($image_skillsrc).'" alt="">';
              }
            $skill .= '</p>';
        $skill .= '</div>';
        $skill .= '<div class="stats-content percentage" data-perc="'.esc_attr($skillvalue).'">';
          $skill .= '<span class="skill-count" style="color: '.esc_attr($text_color_value).'">'.esc_attr($skillvalue).'</span>';
          $skill .= '<p style="color: '.esc_attr($number_color_value).'">'.esc_attr($title).'</p>';
        $skill .= '</div>';
    $skill .= '</div>';
    return $skill;
}
add_shortcode('mt_skill', 'modeltheme_skills_shortcode');








/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';


  #SHORTCODE: Skill counter shortcode
  vc_map( array(
     "name" => esc_attr__("MT - Skill counter", 'modeltheme'),
     "base" => "mt_skill",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
           "group" => "Options",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Skill media"),
           "param_name" => "icon_or_image",
           "std" => '',
           "description" => esc_attr__("Choose what you want to use: empty/image/icon"),
           "value" => array(
            'Nothing'     => 'choosed_nothing',
            'Use an image'     => 'choosed_image',
            'Use an icon'      => 'choosed_icon'
            )
        ),
        array(
          "group" => "Options",
          "dependency" => array(
           'element' => 'icon_or_image',
           'value' => array( 'choosed_icon' ),
           ),
          "type" => "dropdown",
          "heading" => esc_attr__("Icon class", 'modeltheme'),
          "param_name" => "icon",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $fa_list
        ),
        array(
          "group" => "Options",
          "dependency" => array(
           'element' => 'icon_or_image',
           'value' => array( 'choosed_image' ),
           ),
          "type" => "attach_images",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Choose image", 'modeltheme' ),
          "param_name" => "image_skill",
          "value" => "",
          "description" => esc_attr__( "Choose image for skill", 'modeltheme' )
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Title", 'modeltheme'),
           "param_name" => "title",
           "value" => "",
           "description" => ""
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Border Color", 'modeltheme' ),
          "param_name" => "border_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose border color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Text color", 'modeltheme' ),
          "param_name" => "text_color_value",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose text color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Skill value color", 'modeltheme' ),
          "param_name" => "number_color_value",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose skill value color", 'modeltheme' )
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Skill value", 'modeltheme'),
           "param_name" => "skillvalue",
           "value" => "",
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