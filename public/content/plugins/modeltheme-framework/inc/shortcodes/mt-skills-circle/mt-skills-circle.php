<?php

/**

||-> Shortcode: Skills

*/
function modeltheme_skills_circle($params, $content) {
    extract( shortcode_atts( 
        array(
            'skill_circle_size'   => '', 
            'skill_circle_color'  => '',
            'skill_value'         => '',
            'skill_name'          => '',
            'skill_theme'          => '',
            'animation'           => ''
        ), $params ) );

    $skill = '';

    $datatext = '';
    if (isset($skill_name)) {
      $datatext = 'data-text="'.$skill_name.'"';
    }

    $skill .= '<div data-percent="'.$skill_value.'" '.$datatext.' class="'.$skill_circle_color.' '.$skill_circle_size.' '.$skill_theme.' mt_circle"></div>';
            
    return $skill;
}
add_shortcode('mt_skills_circle', 'modeltheme_skills_circle');








/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';


  #SHORTCODE: Skill counter shortcode
  vc_map( array(
     "name" => esc_attr__("MT - Skills Circle", 'modeltheme'),
     "base" => "mt_skills_circle",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
          "group" => "Options",
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Circle Size", 'modeltheme'),
          "param_name" => "skill_circle_size",
          "std" => '',
          "description" => "",
          "value" => array(
              esc_attr__('Medium', 'modeltheme')     => 'medium',
              esc_attr__('Big', 'modeltheme')     => 'big',
              esc_attr__('Small', 'modeltheme')    => 'small'
          )
        ),
        array(
          "group" => "Styling",
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Theme", 'modeltheme'),
          "param_name" => "skill_theme",
          "std" => '',
          "description" => "",
          "value" => array(
              esc_attr__('Light', 'modeltheme')     => 'light',
              esc_attr__('Dark', 'modeltheme')     => 'dark'
          )
        ),
        array(
          "group" => "Styling",
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Circle Color", 'modeltheme'),
          "param_name" => "skill_circle_color",
          "std" => '',
          "description" => "",
          "value" => array(
              esc_attr__('Blue', 'modeltheme')     => 'blue',
              esc_attr__('Red', 'modeltheme')     => 'red',
              esc_attr__('Green', 'modeltheme')    => 'green',
              esc_attr__('Orange', 'modeltheme')    => 'orange',
              esc_attr__('Pink', 'modeltheme')    => 'pink',
              esc_attr__('Purple', 'modeltheme')    => 'purple',
              esc_attr__('Yellow', 'modeltheme')    => 'yellow'
          )
        ),
        array(
          "group" => "Options",
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("What's inside the circle", 'modeltheme'),
          "param_name" => "skill_circle_type",
          "std" => '',
          "description" => "",
          "value" => array(
              esc_attr__('Skill Value', 'modeltheme')     => 'value',
              esc_attr__('Skill Name', 'modeltheme')     => 'name'
          )
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Skill Name", 'modeltheme'),
          "param_name" => "skill_name",
          "value" => "",
          "description" => "Type a text value",
          'dependency' => array(
            'element' => 'skill_circle_type',
            'value' => 'name',
          ),  
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Skill Value", 'modeltheme'),
          "param_name" => "skill_value",
          "value" => "",
          "description" => "Type a value from 0 to 100"
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