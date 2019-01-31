<?php

global $amos_redata, $for_element;

do_action('amos_excecute_query_var_action','loop-index');

if (have_posts()) :

    ?>
<!-- BLog Filter -->
        <div class="row-fluid filter-row">
                    <nav id="blog-filter" class="controls <?php echo esc_attr($amos_redata['filter_align']);?>" >
                        <ul class="">
                            <li class="control filter all " data-filter="all"><a href="#" onclick="return false;" class="filter control " data-filter="all"><?php esc_html_e('View All', 'amos') ?></a></li>
                            
                            <?php 
                            $categories = get_categories( array(
                                'orderby' => 'name',
                                'parent'  => 0
                            ) );
                            foreach($categories as $cat):
                                

                                    if(isset($cat)):
                                 ?>
                                
                                              <li class="other filter"  data-filter=".category-<?php echo esc_attr($cat->slug) ?>"><a href="#" onclick="return false;" class="control filter" data-filter=".category-<?php echo esc_attr($cat->slug) ?>"><?php echo esc_html($cat->name) ?></a></li>

                                     <?php endif; ?>         
                    
                            <?php endforeach; ?>
                        </ul>
                    </nav>

                    </div>
    <div class="row-fluid">
    
     <div id="blogmasonry" class="<?php if(isset($amos_redata['blog_grid_col'])) echo 'cols'.$amos_redata['blog_grid_col']; else echo 'cols3';  ?>">
        <div class="row filterable">
            <div class="grid-size"></div>

    <?php

    while (have_posts()) : the_post();



        $post_id    = get_the_ID();

        $title      = get_the_title();

        $content    = get_the_content();

        $content    = str_replace(']]>', ']]&gt;', apply_filters('the_content', $content ));

                

        $post_format = get_post_format($post_id);

        if(strlen($post_format) == 0)

            $post_format = 'standart';

        $count = 0;

        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));

        if(count($comment_entries) > 0){

            foreach($comment_entries as $comment){

                if($comment->comment_approved)

                    $count++;

            }

        }


        $tags = get_the_tags();
        $tag_out = ''; $num=count($tags); $i=0; if($tags) foreach($tags as $tag): if(++$i === $num){$tag_out .= $tag->name;} else {$tag_out .= $tag->name.', ';}  endforeach;
        
        $no_shadow = '';
        if(!$amos_redata['timeline_box_shadow'])
            $no_shadow = 'no_shadow';

        ?>

        

        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('row-fluid blog-article grid-style '.$no_shadow.' normal mix'); ?> data-id="<?php echo get_the_ID() ?>">                    
            
            <div class="gridbox">
            
         <?php if($post_format == 'standart'){
                $icon_class="pencil";
            }elseif($post_format == 'audio'){
                $icon_class="music";
            }elseif($post_format == 'soundcloud'){
                $icon_class="music";
            }elseif($post_format == 'video'){
                $icon_class="play";
            }elseif($post_format == 'quote'){
                $icon_class="quote-left";
            }elseif($post_format == 'gallery'){
                $icon_class="image";
            }elseif($post_format == 'image'){
                $icon_class="images";
            }

            $thumb='amos_col'.$amos_redata['blog_grid_col'];

            $post_categories = wp_get_post_categories( $post_id );
            $cats = '';
                
            foreach($post_categories as $c){
                $cat = get_category( $c );
                $cats .= ' <a href='.get_category_link($cat->cat_ID).'>'.$cat->name.'</a>,';
            }
            $cats = substr(trim($cats), 0, -1);

         ?>



                <div class="media">
                   
                    <?php if($post_format == 'audio'){

                        $link = $amos_redata['media_post_link'];
                        echo '<audio controls>
                          <source src="'.$link.'" type="audio/mp3">
                          <source src="'.$link.'" type="audio/ogg">
                        </audio>';
                         //do_shortcode('[soundcloud]'.$link.'[/soundcloud]');

                    

                    }elseif($post_format == 'gallery'){

                            $slider = new amos_slideshow(get_the_ID(), 'flexslider');

                            if($slider && $slider->slide_number > 0){
                                
                                $slider->img_size = 'amos_blog';
                                $sliderHtml = $slider->render_slideshow();
                                echo amos_output($sliderHtml);

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

                            echo amos_output($video);
                        
                    }elseif(get_post_thumbnail_id() && $post_format != 'quote'){ ?>
                        <?php if(!is_single()): ?>
                            <a href="<?php echo esc_url(get_permalink()) ?>"><div class="overlay"><div class="post_type_circle"><i class="lnr lnr-magnifier"></i></div></div></a>
                        <?php endif; ?>

                        <?php if(!is_single() || (is_single() && $amos_redata['use_featured_image_as_photo']) ): ?>
                            <img src="<?php echo esc_url(amos_image_by_id(get_post_thumbnail_id(), $thumb, 'url')) ?>"  >
                        <?php endif; 
                    }
                    ?>                                  
                
                </div>

                <div class="content">
                     <?php if($post_format == 'quote'){ ?>
                        <div class="quote">
                            
                        
                    <?php } ?>
                    
                    
                    
                      <?php if($amos_redata['blog_info_date']): ?>  
                                        <div class="date"><?php echo get_the_date() ?></div>
                                    <?php endif;?>
                    <ul class="info">
                                     <?php if($amos_redata['blog_info_author']): ?>
                                <li><span class="author"><?php _e('By', 'amos') ?> <a href=""><?php echo get_the_author() ?></a> </span> 
                                    
                                </li>
                                <?php endif;?>   

                    </ul>
                    <?php if($post_format != 'quote'){ ?>
                    <h1><a href="<?php echo esc_url(get_permalink()) ?>"><?php echo esc_html(get_the_title()) ?></a></h1>
                    <?php }?>
                    <div class="text">
                    <?php if($post_format == 'quote'){ ?>
                    <i class="moon-quotes-left"></i>
                    <?php }?>
                        <?php   
                            if(is_single()){
                                the_content();
                            }else{
                                if($post_format == 'video' || $post_format == 'audio')
                                    echo amos_text_limit(get_the_content(), 50);
                                else

                                    echo get_the_excerpt();                            }
                                    
                        ?>
                        

                    </div>
                    <?php if($post_format == 'quote'){ ?>
                        <span class="title">- <?php echo esc_html(get_the_title()) ?>
                    
                        </span>
                        <?php }?>
                    <?php wp_link_pages() ?>

                        <?php if(!is_single()): ?>
                    <a class="readmore" href="<?php echo get_permalink() ?>" class="btn-bt <?php echo esc_attr($amos_redata['overall_button_style'][0]) ?>"><span><?php _e('Read More', 'amos') ?></span></a>
                    <?php endif; ?>

                    
                    
                    <?php if(is_single()): ?>
                    <?php if($amos_redata['blog_info_tags']): ?>
                        <?php if(!empty($tag_out) ): ?>
                                <div class="tags"><?php the_tags(  ' ' , ' ', '<br />' ); ?></div>
                        <?php endif; ?>     
                        <?php endif; ?>
                    <?php endif; ?>

                <div class="extra_info">

                    <?php if($amos_redata['post_like'] && function_exists('getPostLikeLink')): ?>  
                    <div class="post-like"><?php echo getPostLikeLink( get_the_ID() ); ?></div>
                    <?php endif; ?>

                    <?php if($amos_redata['blog_info_comments']): ?>                   
                                <div class="comment_count"><?php echo esc_attr($count) ?> <?php

                                if($count == 1){
                                    esc_html_e('Comment', 'amos');
                                }else{    
                                
                                     esc_html_e('Comments', 'amos'); 
                                }

                                 ?> <i class="lnr lnr-bubble"></i>   </div>
                            <?php endif; ?>
                        
                    
                        <?php if($amos_redata['social_shares'] && class_exists('Elle_Shares')):
                           
                                $elle_shares = new Elle_Shares;  ?>
                                
                                <div class="shares_container">
                                <div class="shares_title"><?php _e('Share ', 'amos') ?> </div>
                                    <ul class="shares">                 
                                        <li class="facebook"><?php echo amos_output($elle_shares->facebook_shares); ?><i class="et-icon-facebook"></i></a></li>
                                        <li class="twitter"><?php echo amos_output($elle_shares->$twitter_shares); ?><i class="et-icon-twitter"></i></a></li>
                                        <li class="google"><?php echo amos_output($elle_shares->$google_plus_shares); ?><i class="et-icon-googleplus"></i></a></li>
                                        <li class="tumblr"><?php echo amos_output($elle_shares->$tumblr_shares); ?><i class="et-icon-tumblr"></i></a></li>    
                                    </ul>
                                    <!--<div class="share_link"><a href="#"><i class="moon-share-2"></i></a></div>-->
                                </div>
                                
                        <?php endif; ?>

                        </div>
                         
                       <?php  if($post_format == 'quote'){ ?>
                         </div>
                         <?php }?>

                </div>
            </div>
        </article>

    <?php endwhile; ?>

    </div>
    
    </div>

</div> 
    
    <?php if(!is_single() && (!isset($for_element) || !$for_element)): ?>

        <?php amos_pagination_display(); ?>
    
    <?php endif; ?>

<?php endif;

?>