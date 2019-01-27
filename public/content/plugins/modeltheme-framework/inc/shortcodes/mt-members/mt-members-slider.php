<?php

require_once(__DIR__.'/../vc-shortcodes.inc.arrays.php');


/**

||-> Shortcode: Members Slider

*/

function mt_shortcode_members01($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation' => '',
            'number' => '',
            'navigation' => 'false',
            'order' => 'desc',
            'pagination' => 'false',
            'autoPlay' => 'false',
            'button_text' => '',
            'button_link' => '',
            'button_background' => '',
            'paginationSpeed' => '700',
            'slideSpeed' => '700',
            'number_desktop' => '4',
            'number_tablets' => '2',
            'number_mobile' => '1'
        ), $params ) );


    $html = '';



    // CLASSES
    $class_slider = 'mt_slider_members_'.uniqid();



    $html .= '<script>
                jQuery(document).ready( function() {
                    jQuery(".'.$class_slider.'").owlCarousel({
                        navigation      : '.$navigation.', // Show next and prev buttons
                        pagination      : '.$pagination.',
                        autoPlay        : '.$autoPlay.',
                        slideSpeed      : '.$paginationSpeed.',
                        paginationSpeed : '.$slideSpeed.',
                        autoWidth: true,
                        itemsCustom : [
                            [0,     '.$number_mobile.'],
                            [450,   '.$number_mobile.'],
                            [600,   '.$number_desktop.'],
                            [700,   '.$number_tablets.'],
                            [1000,  '.$number_tablets.'],
                            [1200,  '.$number_desktop.'],
                            [1400,  '.$number_desktop.'],
                            [1600,  '.$number_desktop.']
                        ]
                    });
                    
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item:nth-child(2)").addClass("hover_class");
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item").hover(
                  function () {
                    jQuery(".'.$class_slider.' .owl-wrapper .owl-item").removeClass("hover_class");
                    jQuery(this).addClass("hover_class");
                  }
                );


                });
              </script>';


        $html .= '<div class="mt_members1 '.$class_slider.' row wow '.$animation.'">';
        $args_members = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => $order,
                'post_type'        => 'member',
                'post_status'      => 'publish' 
                ); 
        $members = get_posts($args_members);
            foreach ($members as $member) {
                #metaboxes
                $metabox_member_position = get_post_meta( $member->ID, 'smartowl_member_position', true );
                $metabox_member_email = get_post_meta( $member->ID, 'smartowl_member_email', true );
                $metabox_member_phone = get_post_meta( $member->ID, 'smartowl_member_phone', true );

                $metabox_facebook_profile = get_post_meta( $member->ID, 'smartowl_facebook_profile', true );
                $metabox_twitter_profile  = get_post_meta( $member->ID, 'smartowl_twitter_profile', true );
                $metabox_linkedin_profile = get_post_meta( $member->ID, 'smartowl_linkedin_profile', true );
                $metabox_vimeo_url = get_post_meta( $member->ID, 'smartowl_vimeo_url', true );

                $member_title = get_the_title( $member->ID );

                $testimonial_id = $member->ID;
                $content_post   = get_post($member);
                $content        = $content_post->post_content;
                $content        = apply_filters('the_content', $content);
                $content        = str_replace(']]>', ']]&gt;', $content);
                #thumbnail
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $member->ID ),'full' );

                if($metabox_facebook_profile) {
                    $profil_fb = '<a target="_blank" href="'. $metabox_facebook_profile .'" class="member01_profile-facebook"> <i class="fa fa-facebook" aria-hidden="true"></i></a> ';
                }

                if($metabox_twitter_profile) {
                    $profil_tw = '<a target="_blank" href="https://twitter.com/'. $metabox_twitter_profile .'" class="member01_profile-twitter"> <i class="fa fa-twitter" aria-hidden="true"></i></a> ';
                }

                if($metabox_linkedin_profile) {
                    $profil_in = '<a target="_blank" href="'. $metabox_linkedin_profile .'" class="member01_profile-linkedin"> <i class="fa fa-linkedin" aria-hidden="true"></i> </a> ';
                }

                if($metabox_vimeo_url) {
                    $profil_vi = '<a target="_blank" href="'. $metabox_vimeo_url .'" class="member01_vimeo_url"> <i class="fa fa-vimeo" aria-hidden="true"></i> </a> ';
                }
                
                $html.='
                    <div class="col-md-12 relative">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="members_img_holder">
                                    <div class="memeber01-img-holder">';
                                        if($thumbnail_src) { 
                                            $html .= '<div class="grid grid-members">
                                                        <figure class="effect-duke">
                                                            <img src="'. $thumbnail_src[0] . '" alt="'. $member->post_title .'" />
                                                        </figure>
                                                      </div>';
                                        }else{ 
                                            $html .= '<img src="http://placehold.it/450x1000" alt="'. $member->post_title .'" />'; 
                                        }
                                    $html.='</div>
                                    <div class="member01-content">
                                        <div class="member01-content-inside">
                                            <h3 class="member01_name">'.$member_title.'</h3>
                                            <div class="member01_social">' . $profil_fb . $profil_tw . $profil_in . $profil_vi . '</div>
                                            <div class="content-div-content">'. modeltheme_excerpt_limit($content,20) . '</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';

            }
    $html .= '</div>';
    return $html;
}
add_shortcode('mt_members_slider', 'mt_shortcode_members01');





/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
    
    vc_map( array(
        "name" => esc_attr__("MT - Members Slider", 'modeltheme'),
        "base" => "mt_members_slider",
        "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
        "icon" => "smartowl_shortcode",
        "params" => array(
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Number of members", 'modeltheme' ),
                "param_name" => "number",
                "value" => "",
                "description" => esc_attr__( "Enter number of members to show.", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "param_name" => "order",
                "std"          => '',
                "heading" => esc_attr__( "Order options", 'modeltheme' ),
                "description" => esc_attr__( "Order ascending or descending by date", 'modeltheme' ),
                "value"        => array(
                    esc_attr__('Ascending', 'modeltheme') => 'asc',
                    esc_attr__('Descending', 'modeltheme') => 'desc',
                )
                
            ),
            array(
                "group" => "Slider Options",
                "type"         => "dropdown",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "navigation",
                "std"          => '',
                "heading"      => esc_attr__("Navigation", 'modeltheme'),
                "description"  => "",
                "value"        => array(
                    esc_attr__('Disabled', 'modeltheme') => 'false',
                    esc_attr__('Enabled', 'modeltheme')    => 'true',
                )
            ),
            array(
                "group" => "Slider Options",
                "type"         => "dropdown",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "pagination",
                "std"          => '',
                "heading"      => esc_attr__("Pagination", 'modeltheme'),
                "description"  => "",
                "value"        => array(
                    esc_attr__('Disabled', 'modeltheme') => 'false',
                    esc_attr__('Enabled', 'modeltheme')    => 'true',
                )
            ),
            array(
                "group" => "Slider Options",
                "type"         => "dropdown",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "autoPlay",
                "std"          => '',
                "heading"      => esc_attr__("Auto Play", 'modeltheme'),
                "description"  => "",
                "value"        => array(
                    esc_attr__('Disabled', 'modeltheme') => 'false',
                    esc_attr__('Enabled', 'modeltheme')    => 'true',
                )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Pagination Speed", 'modeltheme' ),
                "param_name" => "paginationSpeed",
                "value" => "",
                "description" => esc_attr__( "Pagination Speed(Default: 700)", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Button Text", 'modeltheme' ),
                "param_name" => "button_text",
                "value" => "",
                "description" => esc_attr__( "Enter button text", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Button Link", 'modeltheme' ),
                "param_name" => "button_link",
                "value" => "",
                "description" => esc_attr__( "Enter button link", 'modeltheme' )
            ),
            array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "class" => "",
                  "heading" => esc_attr__( "Button Background Color", 'modeltheme' ),
                  "param_name" => "button_background",
                  "value" => "", //Default color
                  "description" => esc_attr__( "Choose button color", 'modeltheme' )
                ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Slide Speed", 'modeltheme' ),
                "param_name" => "slideSpeed",
                "value" => "",
                "description" => esc_attr__( "Slide Speed(Default: 700)", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Items for Desktops", 'modeltheme' ),
                "param_name" => "number_desktop",
                "value" => "",
                "description" => esc_attr__( "Default - 4", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Items for Tablets", 'modeltheme' ),
                "param_name" => "number_tablets",
                "value" => "",
                "description" => esc_attr__( "Default - 2", 'modeltheme' )
            ),
            array(
                "group" => "Slider Options",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Items for Mobile", 'modeltheme' ),
                "param_name" => "number_mobile",
                "value" => "",
                "description" => esc_attr__( "Default - 1", 'modeltheme' )
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
            ),
        )
    ));
}

?>