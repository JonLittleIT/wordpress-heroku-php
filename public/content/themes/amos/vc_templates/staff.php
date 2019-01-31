<?php   
/**
 * Shortcode attributes
 * @var $atts
 * @var $staff
 * @var $style
 * Shortcode class
 * @var  WPBakeryShortCode_Staff
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
global $amos_redata;

        $output = '';
        if(isset($staff)){
        $output .= '<div class="wpb_content_element">';
       
        $query_post = array( 'p' => $staff, 'posts_per_page'=>1, 'post_type'=> 'staff' );
        $additional_loop = new WP_Query($query_post);
        if($additional_loop->have_posts())
        {
            
            while ($additional_loop->have_posts())
            { 
                $additional_loop->the_post();
                
                
                $content = get_the_content();
                 
                 
                $featured = amos_image_by_id(get_post_thumbnail_id(), 'amos_staff', 'url');
                $position = $amos_redata['staff_position'];
                $output .= '<div class="single_staff '.esc_attr($style).'">';
                            $output .= '<div class="he-wrap tpl2">';
                                $output .= '<div class="featured_img">';
                                
                                    $output .= '<img src="'.esc_url($featured).'" >';
                                    if($style == 'style_1'):
                                        $output .= '<div class="overlay he-view">';
                                            $output .= '<div class="bg a0" data-animate="fadeIn">';
                                                $output .= '<div class="center-bar">';

                                                    if($amos_redata['facebook_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['facebook_link']).'" title="'.esc_attr('Facebook').'"><i class="moon-facebook"></i></a>';
                                                    if($amos_redata['twitter_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['twitter_link']).'" title="'.esc_attr('Twitter').'"><i class="moon-twitter"></i></a>';
                                                    if($amos_redata['google_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['google_link']).'"  title="'.esc_attr('Google Plus').'"><i class="moon-google_plus"></i></a>';
                                                    if($amos_redata['pinterest_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['pinterest_link']).'" title="'.esc_attr('Pinterest').'"><i class="moon-pinterest"></i></a>';
                                                    if($amos_redata['linkedin_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['linkedin_link']).'" title="'.esc_attr('Linkedin').'"><i class="moon-linkedin"></i></a>';
                                                    if($amos_redata['instagram_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['instagram_link']).'" title="'.esc_attr('Instagram').'"><i class="moon-instagram"></i></a>';
                                                    if($amos_redata['mail_link']!= '')
                                                        $output .= '<a href="'.esc_url($amos_redata['mail_link']).'" title="'.esc_attr('Mail').'"><i class="moon-mail"></i></a>';
                                                    
                                                $output .= '</div>';
                                            $output .= '</div>';
                                        $output .= '</div>';
                                    endif;
                                $output .= '</div>';
                            
				
                            $output .= '<div class="content">';
                                $output .= '<h5><a href="'.get_permalink().'">'.esc_html(get_the_title()).'</a></h5>';
                                $output .= '<span class="position">'.esc_attr($position).'</span>';
                            	$output .= '<p>'.amos_text_limit(get_the_excerpt(), 25).'</p>';

                                if($style == 'style_2'){
                                    $output .= "<div class='staff_links'>";

                                                    if($amos_redata['facebook_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['facebook_link']).'" title="'.esc_attr('Facebook').'"><i class="moon-facebook"></i></a>';
                                                    if($amos_redata['twitter_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['twitter_link']).'" title="'.esc_attr('Twitter').'"><i class="moon-twitter"></i></a>';
                                                    if($amos_redata['google_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['google_link']).'"  title="'.esc_attr('Google Plus').'"><i class="moon-google_plus"></i></a>';
                                                    if($amos_redata['pinterest_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['pinterest_link']).'" title="'.esc_attr('Pinterest').'"><i class="moon-pinterest"></i></a>';
                                                    if($amos_redata['linkedin_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['linkedin_link']).'" title="'.esc_attr('Linkedin').'"><i class="moon-linkedin"></i></a>';
                                                    if($amos_redata['instagram_link'] != '')
                                                        $output .= '<a href="'.esc_url($amos_redata['instagram_link']).'" title="'.esc_attr('Instagram').'"><i class="moon-instagram"></i></a>';
                                                    if($amos_redata['mail_link']!= '')
                                                        $output .= '<a href="'.esc_url($amos_redata['mail_link']).'" title="'.esc_attr('Mail').'"><i class="moon-mail"></i></a>';

                                                    $output .= "</div>";
                                }
                            $output .= '</div>';

                            $output .= "</div>";

                 $output .= '</div>';
                
            }
            
        }
        
        $output .= '</div>';
        wp_reset_postdata();
        }
    
        echo amos_output($output);
?>