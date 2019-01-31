<?php        
global $amos_redata;

 /**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $icon_bool
 * @var $style
 * @var $icon
* @var $icon_svg
 * @var $image
 * @var $icon_color
 * @var $circle_color
 * @var $border_color
 * @var $box_border_color
 * @var $dynamic_content_type
 * @var $dynamic_post
 * @var $dynamic_page
 * @var $dynamic_content_link
 * Shortcode class
 * @var  WPBakeryShortCode_Services_Large
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


        $output = '<div class=" services_large '.esc_attr($style).' wpb_content_element" style="border:3px solid '.esc_attr($box_border_color).'">'; 

        $icon_class = (($icon_bool == 'yes')?'with_icon':'no_icon');
        
        $data = array();
        $query = array();

        $data['link'] = '';
        $data['description'] = '';

        if($dynamic_content_type == 'page'){
            $query = array( 'p' => $dynamic_page, 'posts_per_page'=>1, 'post_type'=> 'page' );
        }
        if($dynamic_content_type == 'post'){
            $query = array( 'p' => $dynamic_post, 'posts_per_page'=>1, 'post_type'=> 'post' );
        }
        if($dynamic_content_type == 'content'){
            $data['description'] = $content;
            $data['link'] = $dynamic_content_link;
        }else{
            $loop = new WP_Query($query);
            if($loop->have_posts()){
                while($loop->have_posts()){
                    $loop->the_post();
                    
                    $data['link'] = get_permalink();
                    $data['description'] = get_the_excerpt();
                    
                }
            }
            wp_reset_postdata();
        }

        
            
        if($icon_bool == 'icon' || $icon_bool == 'yes' && !empty($icon)):
            
            $extra_st = '';
            if($style == 'style_1')
                $extra_st = 'background:'.$circle_color.';';
            if($style == 'style_3')
                $extra_st = 'border:1px solid '.esc_attr($border_color).';';
            $output .= '<div class="icon_wrapper" style="'.$extra_st.'"><i class="'.esc_attr($icon).'" style="color:'.esc_attr($icon_color).';"></i></div>';
                

        endif;

            if($icon_bool == 'svg'){
            if(!empty($icon_svg)){
                $random = rand(0,500000);

                $output .= '<div id="icon-svg-'.$random.'" class="icon-svg"></div>';
                $output .= "<script>
                  new Vivus('icon-svg-".$random."', {duration: 50, file: '".$icon_svg."', onReady: function(mySVG){
                    mySVG.el.setAttribute('stroke', '".$icon_color."');
                  }});
                </script>";
                
            }
        }
        
        if($icon_bool == 'image' && !empty($image)):
            $output .= '<img src="'.esc_url(amos_image_by_id($image, '', 'url')).'"  />';
        endif;

        $output .= '<h4><a href="'.esc_url($data['link']).'">'.esc_html($title).'</a></h4>';
        $output .= '<p>'.do_shortcode($data['description']).'</p>';
        $output .= '</div>';
        echo amos_output($output);
?>