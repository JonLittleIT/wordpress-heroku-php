<?php
/**

||-> Shortcode: Social Media

*/
function modeltheme_social_icons_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'icons_color_normal'      => '',
            'icons_color_hover'      => '',
            'icons_bg_normal'      => '',
            'icons_bg_hover'      => '',
            'icons_border_normal'      => '',
            'icons_border_hover'      => '',
            'icons_padding'      => '',
            'icons_margin'      => '',
            'icons_align'      => '',
            'facebook'      => '',
            'twitter'       => '',
            'pinterest'     => '',
            'skype'         => '',
            'instagram'     => '',
            'youtube'       => '',
            'dribbble'      => '',
            'googleplus'    => '',
            'linkedin'      => '',
            'deviantart'    => '',
            'digg'          => '',
            'flickr'        => '',
            'stumbleupon'   => '',
            'tumblr'        => '',
            'vimeo'         => '',
            'animation'     => ''
        ), $params ) ); 
    

        if ($icons_border_normal) {
            $icons_border_normal = "border: 1px solid " . $icons_border_normal . ";";
        }else{
            $icons_border_normal = "";
        }

        if ($icons_border_hover) {
            $icons_border_hover = "border: 1px solid " . $icons_border_hover . ";";
        }else{
            $icons_border_hover = "";
        }


        $content = '';
        $content .= '<style>
                        .widget_social_icons li a{
                            padding:'.$icons_padding.'; 
                            margin:'.$icons_margin.'; 
                            color:'.$icons_color_normal.'; 
                            background:'.$icons_bg_normal.'; 
                            '.$icons_border_normal.'
                        }
                        .widget_social_icons li a:hover{
                            padding:'.$icons_padding.'; 
                            margin:'.$icons_margin.'; 
                            color:'.$icons_color_hover.'; 
                            background:'.$icons_bg_hover.'; 
                            '.$icons_border_hover.'
                        }
                    </style>';
        $content .= '<div class="sidebar-social-networks vc_social-networks widget_social_icons vc_row" data-animate="'.$animation.'">';
            $content .= '<ul class="vc_col-md-12" style="text-align: '.$icons_align.';">';
            if ( isset($facebook) && $facebook != '' ) {
                $content .= '<li><a href="'.esc_attr( $facebook ).'"><i class="fa fa-facebook"></i></a></li>';
            }
            if ( isset($twitter) && $twitter != '' ) {
                $content .= '<li><a href="'.esc_attr( $twitter ).'"><i class="fa fa-twitter"></i></a></li>';
            }
            if ( isset($pinterest) && $pinterest != '' ) {
                $content .= '<li><a href="'.esc_attr( $pinterest ).'"><i class="fa fa-pinterest"></i></a></li>';
            }
            if ( isset($youtube) && $youtube != '' ) {
                $content .= '<li><a href="'.esc_attr( $youtube ).'"><i class="fa fa-youtube"></i></a></li>';
            }
            if ( isset($instagram) && $instagram != '' ) {
                $content .= '<li><a href="'.esc_attr( $instagram ).'"><i class="fa fa-instagram"></i></a></li>';
            }
            if ( isset($linkedin) && $linkedin != '' ) {
                $content .= '<li><a href="'.esc_attr( $linkedin ).'"><i class="fa fa-linkedin"></i></a></li>';
            }
            if ( isset($skype) && $skype != '' ) {
                $content .= '<li><a href="skype:'.esc_attr( $skype ).'?call"><i class="fa fa-skype"></i></a></li>';
            }
            if ( isset($googleplus) && $googleplus != '' ) {
                $content .= '<li><a href="'.esc_attr( $googleplus ).'"><i class="fa fa-google-plus"></i></a></li>';
            }
            if ( isset($dribbble) && $dribbble != '' ) {
                $content .= '<li><a href="'.esc_attr( $dribbble ).'"><i class="fa fa-dribbble"></i></a></li>';
            }
            if ( isset($deviantart) && $deviantart != '' ) {
                $content .= '<li><a href="'.esc_attr( $deviantart ).'"><i class="fa fa-deviantart"></i></a></li>';
            }
            if ( isset($digg) && $digg != '' ) {
                $content .= '<li><a href="'.esc_attr( $digg ).'"><i class="fa fa-digg"></i></a></li>';
            }
            if ( isset($flickr) && $flickr != '' ) {
                $content .= '<li><a href="'.esc_attr( $flickr ).'"><i class="fa fa-flickr"></i></a></li>';
            }
            if ( isset($stumbleupon) && $stumbleupon != '' ) {
                $content .= '<li><a href="'.esc_attr( $stumbleupon ).'"><i class="fa fa-stumbleupon"></i></a></li>';
            }
            if ( isset($tumblr) && $tumblr != '' ) {
                $content .= '<li><a href="'.esc_attr( $tumblr ).'"><i class="fa fa-tumblr"></i></a></li>';
            }
            if ( isset($vimeo) && $vimeo != '' ) {
                $content .= '<li><a href="'.esc_attr( $vimeo ).'"><i class="fa fa-vimeo-square"></i></a></li>';
            }
            $content .= '</ul>';
        $content .= '</div>';
        return $content;
}
add_shortcode('social_icons', 'modeltheme_social_icons_shortcode');





/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';


  #SHORTCODE: Social icons
  vc_map( array(
     "name" => esc_attr__("MT - Social Icons", 'modeltheme'),
     "base" => "social_icons",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
         array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Icons Color:", 'modeltheme' ),
            "param_name" => "icons_color_normal",
            "value" => "",
            "group" => "Icons Style"
         ),
         array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Icons Color - Hover:", 'modeltheme' ),
            "param_name" => "icons_color_hover",
            "value" => "",
            "group" => "Icons Style"
         ),
         array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Icons Background:", 'modeltheme' ),
            "param_name" => "icons_bg_normal",
            "value" => "",
            "group" => "Icons Style"
         ),
         array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Icons Background - Hover:", 'modeltheme' ),
            "param_name" => "icons_bg_hover",
            "value" => "",
            "group" => "Icons Style"
         ),
         array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Icons Border:", 'modeltheme' ),
            "param_name" => "icons_border_normal",
            "value" => "",
            "group" => "Icons Style"
         ),
         array(
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Icons Border - Hover:", 'modeltheme' ),
            "param_name" => "icons_border_hover",
            "value" => "",
            "group" => "Icons Style"
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Icons Padding:", 'modeltheme' ),
            "param_name" => "icons_padding",
            "value" => "",
            "group" => "Icons Style"
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Icons Margin:", 'modeltheme' ),
            "param_name" => "icons_margin",
            "value" => "",
            "group" => "Icons Style"
         ),
        array(
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Icons Alignment:", 'modeltheme'),
           "param_name" => "icons_align",
           "std" => '',
           "value" => array(
            esc_attr__('Left', 'modeltheme')    => 'left',
            esc_attr__('Center', 'modeltheme')  => 'center',
            esc_attr__('Right', 'modeltheme')   => 'right'
           ),
            "group" => "Icons Style"
        ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Facebook URL", 'modeltheme' ),
            "param_name" => "facebook",
            "value" => "",
            "description" => esc_attr__( "Enter your facebook link.", 'modeltheme' ),
            "group" => "Icons Links"
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Twitter URL", 'modeltheme' ),
            "param_name" => "twitter",
            "value" => "",
            "description" => esc_attr__( "Enter your twitter link.", 'modeltheme' ),
            "group" => "Icons Links"
         ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Pinterest URL", 'modeltheme' ),
            "param_name" => "pinterest",
            "value" => "",
            "description" => esc_attr__( "Enter your pinterest link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Google Plus URL", 'modeltheme' ),
            "param_name" => "googleplus",
            "value" => "",
            "description" => esc_attr__( "Enter your Google+ link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Skype Username", 'modeltheme' ),
            "param_name" => "skype",
            "value" => "",
            "description" => esc_attr__( "Enter your Skype Username.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Instagram URL", 'modeltheme' ),
            "param_name" => "instagram",
            "value" => "",
            "description" => esc_attr__( "Enter your instagram link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "YouTube URL", 'modeltheme' ),
            "param_name" => "youtube",
            "value" => "",
            "description" => esc_attr__( "Enter your YouTube link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "LinkedIn URL", 'modeltheme' ),
            "param_name" => "linkedin",
            "value" => "",
            "description" => esc_attr__( "Enter your linkedin link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Dribbble URL", 'modeltheme' ),
            "param_name" => "dribbble",
            "value" => "",
            "description" => esc_attr__( "Enter your dribbble link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Deviantart URL", 'modeltheme' ),
            "param_name" => "deviantart",
            "value" => "",
            "description" => esc_attr__( "Enter your deviantart link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Digg URL", 'modeltheme' ),
            "param_name" => "digg",
            "value" => "",
            "description" => esc_attr__( "Enter your digg link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Flickr URL", 'modeltheme' ),
            "param_name" => "flickr",
            "value" => "",
            "description" => esc_attr__( "Enter your flickr link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Stumbleupon URL", 'modeltheme' ),
            "param_name" => "stumbleupon",
            "value" => "",
            "description" => esc_attr__( "Enter your stumbleupon link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Tumblr URL", 'modeltheme' ),
            "param_name" => "tumblr",
            "value" => "",
            "description" => esc_attr__( "Enter your tumblr link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Vimeo URL", 'modeltheme' ),
            "param_name" => "vimeo",
            "value" => "",
            "description" => esc_attr__( "Enter your vimeo link.", 'modeltheme' ),
            "group" => "Icons Links"
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_attr__("Animation", 'modeltheme'),
            "param_name" => "animation",
            "std" => '',
            "holder" => "div",
            "class" => "",
            "description" => "",
            "value" => $animations_list,
            "group" => "Icons Animation"
        )
     )
  ));
}

?>