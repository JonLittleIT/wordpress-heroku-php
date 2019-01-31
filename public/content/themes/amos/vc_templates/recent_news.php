<?php
global $amos_redata;
 /**
 * Shortcode attributes
 * @var $atts
 * @var $posts_per_page
 * @var $dynamic_from_where
 * @var $dynamic_cat
 * @var $style
 * Shortcode class
 * @var  WPBakeryShortCode_Recent_News
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

        $output = '<div class="recent_news '.$style.' wpb_content_element">';

        if($dynamic_from_where == 'all_cat'){
            $query_post = array('posts_per_page'=> $posts_per_page, 'post_type'=> 'post' );                          
        }else{
           $query_post = array('posts_per_page'=> $posts_per_page, 'post_type'=> 'post', 'cat' => $dynamic_cat ); 
        }
        
        $loop = new WP_Query($query_post);
                                    
        if($loop->have_posts()){
            while($loop->have_posts()){
                $loop->the_post();
                if($style == 'inline'){
                    if(has_post_thumbnail()){
                        $output .= '<div class="blog-item">';
                            $output .= '<h4>'.esc_html(get_the_title()).'</h4>';
                            $output .= '<img src="'.esc_url(amos_image_by_id(get_post_thumbnail_id(), 'amos_blog', 'url')).'"  >';
                            $output .= '<ul class="info">';
                                $output .= '<li>'.__('Posted by', 'amos').' '.esc_html(get_the_author()).'</li>'; 
                                $output .= '<li>'. __('On', 'amos').' '.esc_html(get_the_date()).'</li>';                                                   
                            $output .= '</ul>';
                        $output .= '<a href="'.esc_url(get_permalink()).'"></a></div>';
                    }
                }else if($style == 'events'){
                        $output .= '<dl class="blog-item dl-horizontal">';
                            $output .= '<a href="'.esc_url(get_permalink()).'"></a>';
                            $dt = get_the_time('j').' '.get_the_time('M');
                            if(!empty($amos_redata['future_date_events']) )
                                $dt = $amos_redata['future_date_events'];
                            $output .= '<dt><span class="date">'.$dt.'</span></dt>';
                            $output .= '<dd><h5>'.esc_html(get_the_title()).'</h5><span class="time">'.get_the_time('h:i a').'</span><a class="link" href="'.esc_url(get_permalink()).'"><i class="lnr lnr-chevron-right"></i></a></dd>';
                        $output .= '</dl>';
                }else if($style == 'vertical'){
                        $output .= '<div class="blog-item">';
                            $output .= '<div class="title"><h5><a href="'.esc_url(get_permalink()).'">'.esc_attr(get_the_title()).'</a></h5><span class="date">'.get_the_time('j M h:i a').'</span>';
                            $output .= '</div>';

                            $output .= '<div class="content">';
                            $output .= '<div >'.amos_text_limit(get_the_excerpt(), 30).'</div>';
                            $output .= '<a href="'. get_permalink() .'" class="btn-bt readmore ' .'"><span>'.__("Read More", "amos") .'</span></a>';

                        $output .= '</div>';
                        $output .= '</div>';
                }
                
            }
        } 

        $output .= '</div>';

        echo amos_output($output);
        
?>