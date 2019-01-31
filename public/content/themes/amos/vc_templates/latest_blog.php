<?php 
    /**
 * Shortcode attributes
 * @var $atts
 * @var $dynamic_from_where
 * @var $carousel
 * @var $post_selected
 * @var $dynamic_cat
 * @var $style
 * @var $posts_per_page
 * Shortcode class
 * @var  WPBakeryShortCode_Latest_blog
 */
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
global $amos_redata;
        $output = '<div class="latest_blog wpb_content_element '.esc_attr($style).'">';

        $all_posts=10;
        if($style == 'amos')
            $text_limit = 23;
        else
            $text_limit = 20;



       if($dynamic_from_where == 'all_cat'){
            $query_post = array('posts_per_page'=> $all_posts, 'post_type'=> 'post' ,  'cache_results'  => false);    

        }elseif($dynamic_from_where == 'one_post'){
           $query_post = array('p'=> $post_selected);   

        }else{
           $query_post = array('posts_per_page'=> $all_posts, 'post_type'=> 'post', 'cat' => $dynamic_cat, 'cache_results'  => false ); 
        }
        
        $queries = new WP_Query($query_post);

        if($queries->have_posts()){
            global $wp_query; 
          
            if($carousel == 'yes'){
                $output .= '<div class="blog_slider owl-carousel owl-theme"  data-slidenr="'.(((int)$queries->found_posts > (int)$posts_per_page)?$posts_per_page:$queries->found_posts).'">'; 
                    
            }else{
                $output .= '<div class="row no_carousel">';
            }
            while ($queries->have_posts()) : $queries->the_post();
                        
                        $post_format = get_post_format(get_the_ID());
                        
                        $post_categories = wp_get_post_categories( get_the_ID() );
                        $cats = '';
                        foreach($post_categories as $c){
                            $cat = get_category( $c );
                            $cats .= ' '.$cat->name.',';
                        }


                        /* Count comments*/
                        $cats = substr(trim($cats), 0, -1);

                        $count = 0;

                        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => get_the_ID() ));

                        if(count($comment_entries) > 0){

                            foreach($comment_entries as $comment){

                                if($comment->comment_approved)

                                    $count++;

                            }

                        }

                        $output .= '<div class="'.( ($carousel == 'yes')?'':'' ).' blog-article grid-style blog-item  '.(($dynamic_from_where == 'one_post')?'single':'').' format-'.$post_format.'">'; 
                            //$output .= '<div class="gridbox">';
                                $output .= '<div class="media">';
                                if(function_exists('redux_post_meta'))
                                    $link = redux_post_meta('amos_redata',get_the_ID() ,'media_post_link');
                                else
                                    $link = '';

                                if($post_format == 'audio'){

                                    $output .= '<audio controls>
                                      <source src="'.$link.'" type="audio/mp3">
                                      <source src="'.$link.'" type="audio/ogg">
                                    </audio>';

                                                            
                                }elseif($post_format == 'gallery'){

                                        $slider = new amos_slideshow(get_the_ID(), 'flexslider');

                                        if($slider && $slider->slide_number > 0){
                                            
                                            $slider->img_size = 'amos_port3';
                                            $sliderHtml = $slider->render_slideshow();
                                            $output .= $sliderHtml;

                                        }

                                }elseif($post_format == 'video'){

                                        $video = ""; 

                                        $link = $amos_redata['media_post_link'];

                                        if(amos_backend_is_file( $link, 'html5video')){

                                            $video = amos_html5_video_embed($link);

                                        }
                                        else if(strpos($link,'<iframe') !== false)
                                        {
                                            $video = $link;
                                        }

                                        else if (strpos($link, 'youtube') !== false) {
                                
                                                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $link, $matches);
                                                $video_id=$matches[1];
                                                $video= '<div data-type="youtube" data-video-id="'.$video_id.'"></div>';
                                            }

                                            else if (strpos($link, 'vimeo') !== false) {
                                                
                                            $urlParts = explode("/", parse_url($link, PHP_URL_PATH));
                                            $video_id = (int)$urlParts[count($urlParts)-1];

                                              
                                                $video= '<div data-type="vimeo" data-video-id="'.$video_id.'"></div>';
                                            }
                                        else
                                        {
                                            global $wp_embed;
                                            $video = $wp_embed->run_shortcode("[embed]".trim($link)."[/embed]");
                                        }

                                        if(strpos($video, '<a') === 0)
                                        {
                                            $video = '<iframe src="'.esc_url($link).'"></iframe>';
                                        } 
                                        $output .= $video;


                                }elseif(get_post_thumbnail_id()){

                                     $output .= '<a href="'. esc_url(get_permalink()) .'"><div class="overlay"><div class="post_type_circle"><i class="lnr lnr-magnifier"></i></div></div></a>';
                       
                                    $output .= '<img src="'.esc_url(amos_image_by_id(get_post_thumbnail_id(), 'amos_port', 'url')).'"  >';
                                        

                                }
                            
                                $output .= '</div>';
                                $output .= '<div class="content">';

                                if($post_format != 'quote'){
                                $output .= '<div class="date">'.__('On', 'amos').' '.get_the_date().'</div>'; 
                                
                                $output .= '<h3><a href="'.get_permalink().'">'.esc_html(get_the_title()).'</a></h3>';
                                }
                                if($post_format != 'quote'){
                                $output .= '<ul class="info">';
                                    $output .= '<li>'.__('Posted by', 'amos').' <span>'.get_the_author().'</span></li>'; 
                                      
                                $output .= '</ul>';

                                    $output .= '<div class="text">';
                                        $output .= amos_text_limit(get_the_excerpt(), 22);
                                    $output .= '</div>';
                                }

                                    if($post_format == 'quote')
                                    {
                                        $output .= '<div class="text">';
                                        $output .= '<a href="'.get_permalink().'">'.amos_text_limit(get_the_excerpt(), 22).'</a>';
                                    
                                       $output .= '</div>'; 
                                      $output .= '<span class="title">- '.esc_html(get_the_title()).'</span>';  
                                      
                                  }

                                    /*Read more button, comments and likes*/
                                    if($post_format != 'quote')
                                    $output .= '<a href="'. get_permalink() .'" class="btn-bt readmore ' .'"><span>'.__("Read More", "amos") .'</span></a>';?>

                                    <?php if($style!='simple'){?>
                                     <?php if($amos_redata['blog_info_comments']){                  
                                    
                                    $output .= '<div class="latest_post_comments"><i class="icon-comment-o"></i>'. $count .' </div>';?>
                                    <?php } ?>
                        
                                    <?php if($amos_redata['post_like'] && function_exists('getPostLikeLink')){
                                $output .= '<div class="post-like">'.getPostLikeLink( get_the_ID() ) .'</div>';?>
                                <?php } ?>

                                <?php }//is style not 'simple'?>
                                
                               <?php  //$output .= '</div>';
                            $output .= '</div>';
                        $output .= '</div>';
            endwhile;
           
            if($carousel == 'yes'){
                $output .= '</div>';
             }else{
                $output .= '</div>';
            }
         wp_reset_postdata();
        }
       
        $output .= '</div>';

         

        echo amos_output($output);
?>