<?php
        global $amos_redata;
/**
 * Shortcode attributes
 * @var $atts
 * @var $test_cat
 * Shortcode class
 * @var  WPBakeryShortCode_Testimoniual_Cycle
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

		$output = ''; 

        $output = '<div class="wpb_content_element testimonial_cycle_element">';

        $output .= '<section class="testimonial_cycle">';      

        if((int) $test_cat == 0)
            $query_post = array('posts_per_page'=> 9999, 'post_type'=> 'testimonial' );                          
        else{
            $query_post = array('posts_per_page'=> 9999, 
                                'post_type'=> 'testimonial',
                                'tax_query' => array(   array(  'taxonomy'  => 'testimonial_entries', 
                                                                                    'field'     => 'id', 
                                                                                    'terms'     => (int) $test_cat,  
                                                                                    'operator'  => 'IN')) );
        }                         

        $loop = new WP_Query($query_post);

        if($loop->have_posts()){

            while($loop->have_posts()){

                $loop->the_post();  

                            $output .= '<div class="item">';

                                $output .= '<p>'.get_the_content().'</p>';

                                $output .= '<div class="param">';
                                $output .= '<img src="'.esc_url(amos_image_by_id(get_post_thumbnail_id(), 'amos_staff' , 'url')).'">';
                                $output .= '<div class="name"><h6>'.esc_html(get_the_title()).', </h6><span class="position"> '.esc_attr($amos_redata['staff_position']).'</span></div>';

                                $output .= '</div>';

                            $output .= '</div>';
            }

        }

        wp_reset_postdata();

        $output .= '</section>';

        $output .= '</div>';

        echo amos_output( $output );

?>