<?php   
/**
 * Shortcode attributes
 * @var $atts
 * @var $pagination
 * @var $slide_per_view
 * @var $test_cat
 * Shortcode class
 * @var  WPBakeryShortCode_Staff_Carousel
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
global $amos_redata;
        $output = '';

        if((int) $test_cat == 0)
            $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'staff' );                          
        else{
            $query_post = array('posts_per_page'=> 9999, 
                                'post_type'=> 'staff',
                                'tax_query' => array(   array(  'taxonomy'  => 'staff_entries', 
                                                                                    'field'     => 'id', 
                                                                                    'terms'     => (int) $test_cat,  
                                                                                    'operator'  => 'IN')) );
        }
        $additional_loop = new WP_Query($query_post);

        $output .= '<div class="wpb_content_element ">';
               if($pagination == 'yes')
                $carousel='true';
                else $carousel='false';
                   $output .= '<div class="staff_carousel owl-carousel"  data-carousel="'.$carousel.'" data-slidenr="'.esc_attr($slide_per_view).'">'; 

                if($additional_loop->have_posts())
                {
                     
                    while ($additional_loop->have_posts())
                    { 
                        $additional_loop->the_post();
                        
                        
                        $content = get_the_content();
                         
                         
                        $featured = esc_url(amos_image_by_id(get_post_thumbnail_id(), 'amos_staff' , 'url'));
                        $position = $amos_redata['staff_position'];

                        $ext_style = '';

                        $output .= '<div class="item" style=" '.$ext_style.'" >';
                            $output .= '<div class="single_staff modern ">';
                                        $output .= '<div class="he-wrap tpl2">';
                                            $output .= '<div class="featured_img">';
                                               
                                                $output .= '<img src="'.esc_url($featured).'">';
                                                $output .= '<div class="overlay he-view">';
                                                    $output .= '<div class="bg a0" data-animate="fadeIn">';
                                                       $output .= '<div class="modern_staff_social">';    
                                                                if($amos_redata['facebook_link'] != '')
                                                                    $output .= '<a href="'.esc_url($amos_redata['facebook_link']).'" data-animate="zoomIn" title="'.esc_attr('Facebook').'"><i class="moon-facebook"></i></a>';
                                                                if($amos_redata['twitter_link'] != '')
                                                                    $output .= '<a href="'.esc_url($amos_redata['twitter_link']).'" data-animate="zoomIn" title="'.esc_attr('Twitter').'"><i class="moon-twitter"></i></a>';
                                                                if($amos_redata['google_link'] != '')
                                                                    $output .= '<a href="'.esc_url($amos_redata['google_link']).'" data-animate="zoomIn" title="'.esc_attr('Google Plus').'"><i class="moon-google_plus"></i></a>';
                                                                if($amos_redata['pinterest_link'] != '')
                                                                    $output .= '<a href="'.esc_url($amos_redata['pinterest_link']).'" data-animate="zoomIn" title="'.esc_attr('Pinterest').'"><i class="moon-pinterest"></i></a>';
                                                                if($amos_redata['linkedin_link'] != '')
                                                                    $output .= '<a href="'.esc_url($amos_redata['linkedin_link']).'" data-animate="zoomIn" title="'.esc_attr('Linkedin').'"><i class="moon-linkedin"></i></a>';
                                                                if($amos_redata['instagram_link'] != '')
                                                                    $output .= '<a href="'.esc_url($amos_redata['instagram_link']).'" data-animate="zoomIn" title="'.esc_attr('Instagram').'"><i class="moon-instagram"></i></a>';
                                                                if($amos_redata['mail_link']!= '')
                                                                    $output .= '<a href="'.esc_url($amos_redata['mail_link']).'" data-animate="zoomIn" title="'.esc_attr('Mail').'"><i class="moon-mail"></i></a>';
                                                           $output .= '</div>';
                                                        $output .= '<div class="center-bar">';

                                                            $output .= '<h5 data-animate="fadeIn">'.esc_html(get_the_title()).'</h5>';
                                                            $output .= '<span class="position" data-animate="fadeIn">'.$position.'</span>';
                                                           
                                                        $output .= '</div>';
                                                    $output .= '</div>';
                                                $output .= '</div>';
                                            $output .= '</div>';
                                        
            				
                                        

                                        $output .= "</div>";

                             $output .= '</div>';
                        $output .= '</div>';
                        
                    }
                    
                }

                $output .= '</div>';
        
        $output .= '</div>';
        wp_reset_postdata();
    
        echo amos_output( $output );
?>