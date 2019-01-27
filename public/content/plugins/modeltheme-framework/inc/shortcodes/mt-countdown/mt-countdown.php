<?php


/**

||-> Shortcode: Countdown

*/
function modeltheme_countdown_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'date'                       => '',
            'digits_font_size'           => '',
            'digits_line_height'           => '',
            'texts_font_size'            => '',
            'texts_line_height'            => '',
            'digit_color'                => '',
            'text_color'                 => '',
            'dots_color'                 => '',
            'dots_font_size'                 => '',
            'dots_line_height'                 => ''
        ), $params ) );


    // DIGITS STYLE
    $digit_style = '';
    if (isset($digit_color)) {
      $digit_style .= 'color:'.$digit_color.';';
    }
    if (isset($digits_font_size)) {
      $digit_style .= 'font-size: '.$digits_font_size.' !important;';
    }
    if (isset($digits_line_height)) {
      $digit_style .= 'line-height: '.$digits_line_height.' !important;';
    }



    // LABELS STYLE
    $text_style = '';
    if (isset($text_color)) {
      $text_style .= 'color:'.$text_color.';';
    }
    if (isset($texts_font_size)) {
      $text_style .= 'font-size: '.$texts_font_size.' !important;';
    }
    if (isset($digits_line_height)) {
      $text_style .= 'line-height: '.$digits_line_height.' !important;';
    }

    // DOTS STYLE
    $dots_style = '';
    if (isset($dots_color)) {
      $dots_style = 'color:'.$dots_color.';';
    }
    if (isset($dots_font_size)) {
      $dots_style .= 'font-size: '.$dots_font_size.' !important;';
    }
    if (isset($dots_line_height)) {
      $dots_style .= 'line-height: '.$dots_line_height.' !important;';
    }


    $uniqueID = 'countdown_'.uniqid();

    $content = '';
    $content .= '<div class="text-center row"><div id="'.$uniqueID.'" class="modeltheme-countdown"></div></div>';
    $content .= '<script type="text/javascript">
                  jQuery( document ).ready(function() {

                    //get each width
                    var width_days'.$uniqueID.' = jQuery(\'.rev_slider #'.$uniqueID.' .days-digit\').width();
                    var width_hours'.$uniqueID.' = jQuery(\'.rev_slider #'.$uniqueID.' .hours-digit\').width();
                    var width_minutes'.$uniqueID.' = jQuery(\'.rev_slider #'.$uniqueID.' .minutes-digit\').width();
                    var width_seconds'.$uniqueID.' = jQuery(\'.rev_slider #'.$uniqueID.' .seconds-digit\').width();
                    var width_dots'.$uniqueID.' = jQuery(\'.rev_slider #'.$uniqueID.' .c_dot\').width();
                    var width_dots_x3'.$uniqueID.' = width_dots'.$uniqueID.'*7;
                    //total width
                    var width_sum'.$uniqueID.' = width_days'.$uniqueID.'+width_hours'.$uniqueID.'+width_minutes'.$uniqueID.'+width_seconds'.$uniqueID.'+width_dots_x3'.$uniqueID.';
                    //test
                    //console.log(width_sum'.$uniqueID.');
                    //apply width
                    jQuery(".rev_slider #'.$uniqueID.'").width(width_sum'.$uniqueID.');


                    jQuery("#'.$uniqueID.'").countdown("'.$date.'", function(event) {
                      jQuery(this).html(
                        event.strftime("<div class=\'days\'>"
                                          +"<div class=\'days-digit\' style=\''.$digit_style.'\'>%D</div>"
                                          +"<div class=\'clearfix\'></div>"
                                          +"<div class=\'days-name\' style=\''.$text_style.'\'>days</div>"
                                        +"</div>"
                                        +"<span class=\'c_dot\' style=\''.$dots_style.'\'>&middot;</span>"
                                        +"<div class=\'hours\'>"
                                          +"<div class=\'hours-digit\'  style=\''.$digit_style.'\'>%H</div>"
                                          +"<div class=\'clearfix\'></div>"
                                          +"<div class=\'hours-name\' style=\''.$text_style.'\'>hours</div>"
                                        +"</div>"
                                        +"<span class=\'c_dot\' style=\''.$dots_style.'\'>&middot;</span>"
                                        +"<div class=\'minutes\'>"
                                          +"<div class=\'minutes-digit\' style=\''.$digit_style.'\'>%M</div>"
                                          +"<div class=\'clearfix\'></div>"
                                          +"<div class=\'minutes-name\' style=\''.$text_style.'\'>minutes</div>"
                                        +"</div>"
                                        +"<span class=\'c_dot\' style=\''.$dots_style.'\'>&middot;</span>"
                                        +"<div class=\'seconds\'>"
                                          +"<div class=\'seconds-digit\' style=\''.$digit_style.'\'>%S</div>"
                                          +"<div class=\'clearfix\'></div>"
                                          +"<div class=\'seconds-name\' style=\''.$text_style.'\'>seconds</div>"
                                        +"</div>")
                      );
                    });
                  });
                </script>';

    return $content;
}
add_shortcode('mt-countdown', 'modeltheme_countdown_shortcode');








/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';


  vc_map( array(
     "name" => esc_attr__("MT - Countdown", 'modeltheme'),
     "base" => "mt-countdown",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Date", 'modeltheme'),
           "param_name" => "date",
           "value" => "2015/12/12",
           "description" => "Eg: 2015/12/12"
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Digits Font Size", 'modeltheme' ),
          "param_name" => "digits_font_size",
          "value" => esc_attr__( "70px", 'modeltheme' ),
          "description" => "Default: 70px"
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Digits Line Height", 'modeltheme' ),
          "param_name" => "digits_line_height",
          "value" => esc_attr__( "70px", 'modeltheme' ),
          "description" => "Default: 70px (same as font-size)"
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Labels Font Size", 'modeltheme' ),
          "param_name" => "texts_font_size",
          "value" => esc_attr__( "20px", 'modeltheme' ),
          "description" => "Default: 20px"
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Labels Line Height", 'modeltheme' ),
          "param_name" => "texts_line_height",
          "value" => esc_attr__( "20px", 'modeltheme' ),
          "description" => "Default: 20px (same as font-size)"
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Dots Font Size", 'modeltheme' ),
          "param_name" => "dots_font_size",
          "value" => esc_attr__( "20px", 'modeltheme' ),
          "description" => "Default: 20px"
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Dots Line Height", 'modeltheme' ),
          "param_name" => "dots_line_height",
          "value" => esc_attr__( "10px", 'modeltheme' ),
          "description" => "Default: 10px (same as font-size)"
        ),
        array(
           "group" => "Styling",
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Color of the digits", 'modeltheme'),
           "param_name" => "digit_color",
           "value" => "#495153",
           "description" => ""
        ),
        array(
           "group" => "Styling",
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Color of the text", 'modeltheme'),
           "param_name" => "textcolor",
           "value" => "#848685",
           "description" => ""
        ),
        array(
           "group" => "Styling",
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Color of the dots", 'modeltheme'),
           "param_name" => "dots_color",
           "value" => "#48A8A7",
           "description" => ""
        )

     )
  ));  
}