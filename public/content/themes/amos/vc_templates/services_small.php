<?php
global $amos_redata;
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $icon_bool
 * @var $icon
 * @var $icon_color=$amos_redata['primary_color']
 * @var $icon_color_wr='#222'
 * @var $style='style_1'
 * @var $dynamic_content_type
 * @var $dynamic_post
 * @var $dynamic_page
 * @var $dynamic_content_content
 * @var $dynamic_content_link
 * @var $align='left'
 * Shortcode class
 * @var $this WPBakeryShortCode_Services_Small
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

	$output = '<div class=" services_small wpb_content_element align_'.$align.'">';
        $icon_class = ((isset($icon_bool) && $icon_bool == 'yes')?'with_icon':'no_icon');
        $data = array();
        $data['link'] = '';
        $data['description'] = "";
        $query = array();
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

        $output .= '<dl class="dl-horizontal '.esc_attr($icon_class).'">';
        
        if($icon_bool == 'yes'){
            $output .= '    <dt>';
            if($style == 'style_2')
                $output .= '<div class="wrapper" style="background:'.esc_attr($color_icon_wr).';">';
            $output .= '        <i class="'.esc_attr($icon).'" style="color:'.esc_attr($icon_color).';"></i>';
            if($style == 'style_2')
                $output .= '</div>';
            $output .= '    </dt>';
        }
        
        $output .= '    <dd>';
        $output .= '        <h4><a href="'.esc_url($data['link']).'">'.esc_html($title).'</a></h4>';
            $output .= '    <div class="content">';
            $output .= '         <div>'.do_shortcode($data['description']).'</div>';
            $output .= '    </div>';
        $output .= '    </dd>'; 
        $output .= '</dl>';
        
        
        $output .= '</div>';
        echo amos_output( $output );

?>