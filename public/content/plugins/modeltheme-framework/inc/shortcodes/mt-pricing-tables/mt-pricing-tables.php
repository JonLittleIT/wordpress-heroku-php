<?php


/**

||-> Shortcode: Pricing Tables

*/
function modeltheme_pricing_table_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'package_style'                               => '',
            'package_differential_color_style1'           => '',
            'package_differential_color_style3'           => '',
            'package_background_style3'                   => '',
            'package_background_hover_style3'             => '',
            'package_differential_hover_color_style1'     => '',
            'package_button_color_style3'                 => '',
            'package_button_hover_color_style3'           => '',
            'package_currency'                            => '',
            'package_price'                               => '',
            'package_name'                                => '',
            'package_recommended'                         => '',
            'package_period'                              => '',
            'package_subtitle'                            => '',
            'package_feature1'                            => '',
            'package_feature2'                            => '',
            'package_feature3'                            => '',
            'package_feature4'                            => '',
            'package_feature5'                            => '',
            'animation'                                   => '',
            'button_url'                                  => '',
            'button_text'                                 => ''
        ), $params ) );


    $package_type = 'pricing--tenzin';

    if($package_style == 'pricing--tenzin') {
        $package_type = 'pricing--tenzin';
    } elseif($package_style == 'pricing--norbu') {
        $package_type = 'pricing--norbu';
    } elseif($package_style == 'pricing--pema') {
        $package_type = 'pricing--pema';
    } 


    $pricing_table = '';
    $pricing_table .= '<div class="row">';
      $pricing_table .= '<div class="pricing-section wow '.esc_attr($animation).'">';
          
          $pricing_table .= '<div class="pricing '.esc_attr($package_type).'">';
            $pricing_table .= '<div class="pricing__item '.esc_attr($package_recommended).'">';
              $pricing_table .= '<h3 class="pricing__title">'.esc_attr($package_name).'</h3>';
              if ($package_style == 'pricing--pema') {
                $pricing_table .= '<p class="pricing__sentence">'.esc_attr($package_subtitle).'</p>';
              }
              if ($package_style == 'pricing--norbu') {
                $pricing_table .= '<div class="pricing__price"><span class="pricing__currency">'.esc_attr($package_currency).'</span>'.esc_attr($package_price).'<span class="pricing__period">'.esc_attr($package_period).'</span></div>';
              } elseif ($package_style == 'pricing--tenzin') {
                  $pricing_table .= '<div class="pricing__price"><span class="pricing__currency">'.esc_attr($package_currency).'</span>'.esc_attr($package_price).'</div>';
              } elseif ($package_style == 'pricing--pema') {
                  $pricing_table .= '<div class="pricing__price">';
                      $pricing_table .= '<span class="pricing__currency">'.esc_attr($package_currency).'</span>'.esc_attr($package_price).'';
                      $pricing_table .= '<span class="pricing__period">'.esc_attr($package_period).'</span>';
                  $pricing_table .= '</div>';
              }
              if ($package_style == 'pricing--norbu' OR $package_style == 'pricing--tenzin' ) {
                $pricing_table .= '<p class="pricing__sentence">'.esc_attr($package_subtitle).'</p>';
              }
              
              $pricing_table .= '<ul class="pricing__feature-list">';
                  if($package_style=='pricing--tenzin') {
                    if (!empty($package_feature1)){
                      $pricing_table .= '<li class="pricing__feature">'.esc_attr($package_feature1).'</li>';
                    }
                    if (!empty($package_feature2)){
                      $pricing_table .= '<li class="pricing__feature">'.esc_attr($package_feature2).'</li>';
                    }
                    if (!empty($package_feature3)){
                      $pricing_table .= '<li class="pricing__feature">'.esc_attr($package_feature3).'</li>';
                    }
                    if (!empty($package_feature4)){
                      $pricing_table .= '<li class="pricing__feature">'.esc_attr($package_feature4).'</li>';
                    }
                    if (!empty($package_feature5)){
                      $pricing_table .= '<li class="pricing__feature">'.esc_attr($package_feature5).'</li>';
                    }
                  } elseif($package_style=='pricing--norbu') {
                      if (!empty($package_feature1)){
                        $pricing_table .= '<li class="pricing__feature"><i class="icon-arrow-right icons"></i>'.esc_attr($package_feature1).'</li>';
                      }
                      if (!empty($package_feature2)){
                        $pricing_table .= '<li class="pricing__feature"><i class="icon-arrow-right icons"></i>'.esc_attr($package_feature2).'</li>';
                      }
                      if (!empty($package_feature3)){
                        $pricing_table .= '<li class="pricing__feature"><i class="icon-arrow-right icons"></i>'.esc_attr($package_feature3).'</li>';
                      }
                      if (!empty($package_feature4)){
                        $pricing_table .= '<li class="pricing__feature"><i class="icon-arrow-right icons"></i>'.esc_attr($package_feature4).'</li>';
                      }
                      if (!empty($package_feature5)){
                        $pricing_table .= '<li class="pricing__feature"><i class="icon-arrow-right icons"></i>'.esc_attr($package_feature5).'</li>';
                      }
                    } 
                  elseif($package_style=='pricing--pema') {

                    if (!empty($package_feature1)){
                      $pricing_table .= '<li class="pricing__feature"><i class="icon-bubble icons"></i>'.esc_attr($package_feature1).'</li>';
                    }
                    if (!empty($package_feature2)){
                      $pricing_table .= '<li class="pricing__feature"><i class="icon-support icons"></i>'.esc_attr($package_feature2).'</li>';
                    }
                    if (!empty($package_feature3)){
                      $pricing_table .= '<li class="pricing__feature"><i class="icon-pie-chart icons"></i>'.esc_attr($package_feature3).'</li>';
                    }
                    if (!empty($package_feature4)){
                      $pricing_table .= '<li class="pricing__feature"><i class="icon-bulb icons"></i>'.esc_attr($package_feature4).'</li>';
                    }
                    if (!empty($package_feature5)){
                      $pricing_table .= '<li class="pricing__feature"><i class="icon-user-following icons"></i>'.esc_attr($package_feature5).'</li>';
                    }
                  }
                  
              $pricing_table .= '</ul>';
              $pricing_table .= '<a class="pricing__action" href="'.esc_attr($button_url).'">'.esc_attr($button_text).'</a>';
            $pricing_table .= '</div>';
          $pricing_table .= '</div>';
      $pricing_table .= '</div>
    </div>
    <style type="text/css" media="screen">
          .pricing--tenzin .pricing__action {
              background: '.esc_attr($package_differential_color_style1).';
          }

          .pricing--tenzin .pricing__action:hover,
          .pricing--tenzin .pricing__action:focus {
              background-color: '.esc_attr($package_differential_hover_color_style1).';
          }
          .pricing--tenzin .pricing__item:hover {
              border-color: '.esc_attr($package_differential_hover_color_style1).';
          }
          .pricing--pema .pricing__sentence {
              color: '.esc_attr($package_differential_color_style3).';
          }
          .pricing--pema .pricing__price {
              color: '.esc_attr($package_differential_color_style3).';
          }
          .pricing--pema .pricing__action {
              background-color: '.esc_attr($package_button_color_style3).';
          }
          .pricing--pema .pricing__action:hover,
          .pricing--pema .pricing__action:focus {
              background-color: '.esc_attr($package_button_hover_color_style3).';
          }
          .pricing--pema .pricing__item {
              background: '.esc_attr($package_background_style3).' none repeat scroll 0 0;
              transition: all 300ms ease-in-out 0ms;
              -ms-transformtransition: all 300ms ease-in-out 0ms;
              -webkit-transformtransition: all 300ms ease-in-out 0ms;
          }
          .pricing--pema .pricing__item:hover {
              background: '.esc_attr($package_background_hover_style3).' none repeat scroll 0 0;
              transition: all 300ms ease-in-out 0ms;
              -ms-transformtransition: all 300ms ease-in-out 0ms;
              -webkit-transformtransition: all 300ms ease-in-out 0ms;
          }
      </style>';
    return $pricing_table;
}
add_shortcode('pricing-table', 'modeltheme_pricing_table_shortcode');








/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';


  vc_map( array(
     "name" => esc_attr__("MT - Pricing table", 'modeltheme'),
     "base" => "pricing-table",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
           "group" => "Options",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package style"),
           "param_name" => "package_style",
           "std" => '',
           "description" => esc_attr__(""),
           "value" => array(
            'Style 1'     => 'pricing--tenzin',
            'Style 2'     => 'pricing--norbu',
            'Style 3'     => 'pricing--pema'
           )
        ),
        array(
           "group" => "Options",
           "dependency" => array(
           'element' => 'package_style',
           'value' => array( 'pricing--norbu','pricing--pema' ),
           ),
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package period", 'modeltheme'),
           "param_name" => "package_period",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
           "group" => "Options",
           "dependency" => array(
           'element' => 'package_style',
           'value' => array( 'pricing--pema' ),
           ),
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package Recommended"),
           "param_name" => "package_recommended",
           "std" => '',
           "description" => esc_attr__(""),
           "value" => array(
            'Basic'           => 'pricing__item--nofeatured',
            'Recommended'     => 'pricing__item--featured'
           )
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package name", 'modeltheme'),
           "param_name" => "package_name",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package subtitle", 'modeltheme'),
           "param_name" => "package_subtitle",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package price", 'modeltheme'),
           "param_name" => "package_price",
           "value" => "",
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package currency", 'modeltheme'),
           "param_name" => "package_currency",
           "value" => "",
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package's 1st feature", 'modeltheme'),
           "param_name" => "package_feature1",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package's 2nd feature", 'modeltheme'),
           "param_name" => "package_feature2",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package's 3rd feature", 'modeltheme'),
           "param_name" => "package_feature3",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package's 4th feature", 'modeltheme'),
           "param_name" => "package_feature4",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package's 5th feature", 'modeltheme'),
           "param_name" => "package_feature5",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package button url", 'modeltheme'),
           "param_name" => "button_url",
           "value" => "",
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Package button text", 'modeltheme'),
           "param_name" => "button_text",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
          "group" => "Styling",
          "dependency" => array(
          'element' => 'package_style',
          'value' => array( 'pricing--tenzin' ),
          ),
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Differential package color", 'modeltheme' ),
          "param_name" => "package_differential_color_style1",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose differential package color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "dependency" => array(
          'element' => 'package_style',
          'value' => array( 'pricing--pema' ),
          ),
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Price package color", 'modeltheme' ),
          "param_name" => "package_differential_color_style3",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose the price color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "dependency" => array(
          'element' => 'package_style',
          'value' => array( 'pricing--pema' ),
          ),
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Package background color", 'modeltheme' ),
          "param_name" => "package_background_style3",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose package background color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "dependency" => array(
          'element' => 'package_style',
          'value' => array( 'pricing--pema' ),
          ),
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Package hover background color", 'modeltheme' ),
          "param_name" => "package_background_hover_style3",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose package hover background color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "dependency" => array(
          'element' => 'package_style',
          'value' => array( 'pricing--tenzin' ),
          ),
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Differential package color", 'modeltheme' ),
          "param_name" => "package_differential_hover_color_style1",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose differential package hover color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "dependency" => array(
          'element' => 'package_style',
          'value' => array( 'pricing--pema' ),
          ),
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Package button color", 'modeltheme' ),
          "param_name" => "package_button_color_style3",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose package button color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "dependency" => array(
          'element' => 'package_style',
          'value' => array( 'pricing--pema' ),
          ),
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Package button hover color", 'modeltheme' ),
          "param_name" => "package_button_hover_color_style3",
          "value" => "", //Default color
          "description" => esc_attr__( "Choose package button hover color", 'modeltheme' )
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