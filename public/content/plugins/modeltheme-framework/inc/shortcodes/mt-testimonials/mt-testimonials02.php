<?php

/**

||-> Shortcode: Testimonials 02

*/

function modeltheme_shortcode_testimonials02($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                            =>'',
            'testimonial_image_background_color'   =>'',
            'testimonial_text_background_color'    =>'',
            'testimonial_text_color'               =>'',
            'testimonial_position_color'           =>'',
            'number'                               =>''
        ), $params ) );

    $html = '';
    $html .= '<div class="">';
        $html .= '<div class="testimonials02-container wow '.$animation.'">';
        $args_testimonials = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'testimonial',
                'post_status'      => 'publish' 
                ); 
        $testimonials = get_posts($args_testimonials);
            foreach ($testimonials as $testimonial) {
                #metaboxes
                $metabox_job_position = get_post_meta( $testimonial->ID, 'job-position', true );
                $metabox_company = get_post_meta( $testimonial->ID, 'company', true );
                // $metabox_testimonial_bg = get_post_meta( $testimonial->ID, 'smartowl_testimonial_bg_color', true );
                $testimonial_id = $testimonial->ID;
                $content_post   = get_post($testimonial_id);
                $content        = $content_post->post_content;
                $content        = apply_filters('the_content', $content);
                $content        = str_replace(']]>', ']]&gt;', $content);
                #thumbnail
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $testimonial->ID ),'eaglewp_testimonials02_250x530' );
                
                $html.='<div class="row">';
                  $html.='<div class="item vc_col-md-12 relative">';
                    $html.='<div class="testimonials_all_holder">';
                        $html .= '<div class="vc_col-md-3 testimonial02-img-holder"">';
                            $html .= '<div class="row">';
                                    if($thumbnail_src) { 
                                        $html .= '<img class="testimonial02-img" src="'. $thumbnail_src[0] . '" alt="'. $testimonial->post_title .'" />';
                                    }else{ 
                                        $html .= '<img class="testimonial02-img" src="http://placehold.it/250x300" alt="'. $testimonial->post_title .'" />'; 
                                    }
                            $html .= '</div>';
                        $html .= '</div>';


                        $html .= '<div class="vc_col-md-9 testimonial02-text-holder">';
                                $html .= '<div class="testimonial02-content">';
                                    $html .= '<div class="testimonial02_text">';
                                        $html .= '<div class="testimonial02_text_content">'.$content.'</div>';
                                        $html .= '<h4 class="testimonial02_title">'.$testimonial->post_title .'</h4>';
                                        $html .= '<h4 class="testimonial02_position">'.esc_attr($metabox_job_position).'</h4>';
                                    $html .= '</div>';
                                $html .= '</div>';
        		            $html .= '</div>';
                    $html .= '</div>';
                  $html .= '</div>';
    	          $html .= '</div>';

            }
        $html .= '</div>';
    $html .= '</div>
    <style type="text/css" scoped>
      .testimonials_all_holder {
          background-color: '.esc_attr($testimonial_text_background_color).';
      }
      .testimonials02-container .testimonial02-img-holder {
          background-color: '.esc_attr($testimonial_image_background_color).';
      }
      .testimonials02-container .testimonial02-text-holder {
          background-color: '.esc_attr($testimonial_text_background_color).';
      }
      .testimonials02-container .testimonial02-text-holder .testimonial02_text_content p {
          color: '.esc_attr($testimonial_text_color).';
      }
      .testimonials02-container .testimonial02-text-holder .testimonial02_title {
          color: '.esc_attr($testimonial_text_color).';
      }
      .testimonials02-container .testimonial02-text-holder .testimonial02_position{
          color: '.esc_attr($testimonial_position_color).';
      }
      .testimonials02-container.owl-theme .owl-controls .owl-buttons div {
          color: '.esc_attr($testimonial_position_color).';
      }
    </style>';
    return $html;
}
add_shortcode('testimonials02', 'modeltheme_shortcode_testimonials02');


/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

    vc_map( 
        array(
            "name" => esc_attr__("MT - Testimonials Slider", 'modeltheme'),
            "base" => "testimonials02",
            "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
            "icon" => "smartowl_shortcode",
            "params" => array(
                array(
                  "group" => "Options",
                   "type" => "textfield",
                   "holder" => "div",
                   "class" => "",
                   "heading" => esc_attr__("Number of testimonials to show", 'modeltheme'),
                   "param_name" => "number",
                   "value" => "",
                   "description" => ""
                ),
                array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Testimonials image background color", 'modeltheme' ),
                  "param_name" => "testimonial_image_background_color",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose color for image background", 'modeltheme' )
                ),
                array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Testimonials text background color", 'modeltheme' ),
                  "param_name" => "testimonial_text_background_color",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose color for text background", 'modeltheme' )
                ),
                array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Testimonials text color", 'modeltheme' ),
                  "param_name" => "testimonial_text_color",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose color for text", 'modeltheme' )
                ),
                array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Testimonials position color", 'modeltheme' ),
                  "param_name" => "testimonial_position_color",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose color for position", 'modeltheme' )
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
        )
    );
}



?>