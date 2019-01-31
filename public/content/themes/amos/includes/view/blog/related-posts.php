<?php 
$amos_redata = amos_redata_variable(); 
$orig_post = $post;
global $post;
$tags = wp_get_post_tags($post->ID);
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
$args=array(
'tag__in' => $tag_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=>6, // Number of related posts that will be shown.
'ignore_sticky_posts'=>1
);
$posts_per_page=4;
        
        $queries = new WP_Query($args);
        if($queries->have_posts()){
            global $wp_query; 
            echo "<div class='row related'>";
            echo "<div class='container'>";
            echo "<div class='span12'>";
            echo "<h4>".__('You might also like...', 'amos')."</h4>";
                            echo  '<div class="related_posts owl-carousel owl-theme"  data-slidenr="'.(((int)$queries->found_posts > (int)$posts_per_page)?$posts_per_page:$queries->found_posts).'">';
        
            while ($queries->have_posts()) : $queries->the_post();
                        
                        $post_format = get_post_format(get_the_ID());
                        
                        $post_categories = wp_get_post_categories( get_the_ID() );
                        $cats = '';
                        foreach($post_categories as $c){
                            $cat = get_category( $c );
                        $cats .= ' <a href='.get_category_link($cat->cat_ID).'>'.$cat->name.'</a>,';
                        }


                        
                        $cats = substr(trim($cats), 0, -1);

                        $count = 0;

                        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => get_the_ID() ));

                        if(count($comment_entries) > 0){

                            foreach($comment_entries as $comment){

                                if($comment->comment_approved)

                                    $count++;

                            }

                        }

                        echo  '<div class="blog-article grid-style blog-item  ">'; 
                            //echo  '<div class="gridbox">';
                                echo  '<div class="media">';
                                if(function_exists('redux_post_meta'))
                                    $link = redux_post_meta('amos_redata',get_the_ID() ,'media_post_link');
                                else
                                    $link = '';

                                if($post_format == 'audio'){

                                    echo  do_shortcode('[soundcloud]'.$link.'[/soundcloud]');

                                }elseif(get_post_thumbnail_id()){

                                     echo  '<a href="'. esc_url(get_permalink()) .'"><div class="overlay"><div class="post_type_circle"><i class="lnr lnr-magnifier"></i></div></div></a>';
                       
                                    echo  '<img src="'.esc_url(amos_image_by_id(get_post_thumbnail_id(), "amos_port", "url")).'"  >';
                                    ?>
                                    <a href="<?php echo esc_url(get_permalink()) ?>"><div class="overlay"><div class="post_type_circle"><i class="lnr lnr-magnifier"></i></div></div></a>
                                                                    
                                <?php }elseif($post_format == 'gallery'){

                                        $slider = new amos_slideshow(get_the_ID(), 'flexslider');

                                        if($slider && $slider->slide_number > 0){
                                            
                                            $slider->img_size = 'amos_port3';
                                            $sliderHtml = $slider->render_slideshow();
                                            echo  $sliderHtml;

                                        }

                                }elseif($post_format == 'video'){

                                        $video = ""; 

                                        

                                        if(amos_backend_is_file( $link, 'html5video')){

                                            $video = amos_html5_video_embed($link);

                                        }
                                        else if(strpos($link,'<iframe') !== false)
                                        {
                                            $video = $link;
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

                                        echo  $video;

                                } ?>
                            
                               </div>
                               <div class="content">
                                  <!--quote format post type-->
                                <?php if($post_format == 'quote'){?>
                                     <div class="quote">
			                            <i class="moon-quotes-left"></i>   
                                <?php }?>

                                <?php 
                            
                                echo '<ul class="info">';
                                if($amos_redata['blog_info_author']): ?>
                                <li><span class="author"><?php _e('By', 'amos') ?> <a href=""><?php echo get_the_author() ?></a> </span> 
                                    
                                </li>
                                <?php endif;?>   

                                     
                                    </ul>
                                 <?php if($post_format != 'quote'){?>

                                	<?php echo '<h3><a href="'.get_permalink().'">'.esc_html(get_the_title()).'</a></h3>';
                          		
                          		 }
                                    echo '<div class="text">';
                                        echo amos_text_limit(get_the_excerpt(), 22);
                                    echo '</div>';

                                    
                                    echo '<a href="'. get_permalink() .'" class="readmore"><span>'.__("Read More", "amos") .'</span></a>';?>
                                    

                                    <div class="extra_info">
                                     <?php if($amos_redata['blog_info_comments']){                  
                                    echo '<div class="comment_count">'. $count .' <i class="lnr lnr-bubble"></i> </div>';?>
                                    <?php } ?>
                        
                                    <?php if($amos_redata['post_like'] && function_exists('getPostLikeLink')){
                                		echo '<div class="post-like">'.getPostLikeLink( get_the_ID() ) .'</div>';?>

                                	<?php } ?>
                                	</div>
                              
                                </div>

                              <?php if($post_format == 'quote'){?>
                            </div>
                            <?php }?>
                       </div>
            <?php endwhile;?>
                </div>
                </div>
                </div>
               </div>
         <?php
        }
       
}
   $post = $orig_post;
wp_reset_query();    
?>