<?php

$amos_redata = amos_redata_variable();

do_action('amos_excecute_query_var_action','loop-index');

if (have_posts()) :
    
    while (have_posts()) : the_post();
        
        $post_id    = get_the_ID();
        $title      = get_the_title();
        $font_color = ($amos_redata['page_header_menu_color'] == 'auto')? '':'background--'.$amos_redata['page_header_menu_color'];
        
         $count = 0;

        $comment_entries = get_comments(array( 'type'=> 'comment', 'post_id' => $post->ID ));

        if(count($comment_entries) > 0){

            foreach($comment_entries as $comment){

                if($comment->comment_approved)

                    $count++;

            }

        }

         $post_categories = wp_get_post_categories( $post_id );
        $cats = '';
            
        foreach($post_categories as $c){
            $cat = get_category( $c );
            $cats .= ' <a href='.get_category_link($cat->cat_ID).'>'.$cat->name.'</a>,';
        }
        $cats = substr(trim($cats), 0, -1);

        ?> 
        <article id="post-<?php echo the_ID(); ?>" <?php echo post_class('blog-article fullscreen-single '.$font_color.' intro-effect-push'); ?>>
			<div class="header_fullscreen_single">
				<div class="bg-img" style="background-image:url(<?php echo esc_url(amos_image_by_id(get_post_thumbnail_id(), '', 'url')) ?>)"></div>
				<div class="title">
					<h1><?php echo esc_html($title) ?></h1>
				</div>
			</div>
			<button class="trigger"><span><?php esc_html_e('Trigger', 'amos') ?></span></button>
			<div class="title">
				<h1><a href="<?php echo esc_url(get_permalink()) ?>"><?php echo esc_html(get_the_title()) ?></a></h1>
                    <ul class="info">
                        <?php if($amos_redata['blog_info_author']): ?>
                        <li><?php _e('Posted by', 'amos') ?> <?php echo get_the_author() ?></li> 
                        <?php endif; ?>
                        <?php if($amos_redata['blog_info_date']): ?>
                        <li><?php _e('On', 'amos') ?> <?php echo get_the_date() ?></li>                           
                        <?php endif; ?>

                        <?php if($amos_redata['blog_info_comments']): ?>                   
                                <li><i class="icon-comment-o"></i><?php echo esc_attr($count) ?> <i class="lnr lnr-chat"></i></li>
                            <?php endif; ?>
                        
                        <?php if($amos_redata['post_like'] && function_exists('getPostLikeLink')): ?>  
                    <div class="post-like"><?php echo getPostLikeLink( get_the_ID() ); ?></div>
                    <?php endif; ?>
                        
                    </ul>

			</div>
			<div class="content">
				<div class="text">
					<?php the_content() ?>
                   <div class="extra_info">
                    <?php if(!is_single()): ?>
                    <a href="<?php echo get_permalink() ?>" class="btn-bt <?php echo esc_attr($amos_redata['overall_button_style'][0]) ?>"><span><?php _e('Read More', 'amos') ?></span><i class="lnr lnr-arrow-right"></i></a>
                    <?php endif; ?>
                    <?php if(is_single()): ?>
                    <?php if($amos_redata['blog_info_tags']): ?>
                        <?php if(!empty($tag_out) ): ?>
                                <div class="tags"><?php the_tags(  __('Tags', 'amos').": " , ', ', '<br />' ); ?></div>
                        <?php endif; ?>     
                        <?php endif; ?>
                    <?php endif; ?>
                    
                        <?php if($amos_redata['social_shares'] && class_exists('Elle_Shares')):  

                                $elle_shares = new Elle_Shares; ?>

                                <div class="shares_container">
                                    <div class="shares_title"><?php _e('Share ', 'amos') ?> </div>

                                        <ul class="shares">                 
                                            <li class="facebook"><?php echo amos_output($elle_shares->facebook_shares); ?><i class="icon-facebook"></i></a></li>
                                            <li class="twitter"><?php echo amos_output($elle_shares->twitter_shares); ?><i class="icon-twitter"></i></a></li>
                                            <li class="google"><?php echo amos_output($elle_shares->google_plus_shares); ?><i class="icon-google-plus"></i></a></li>
                                            <li class="linkedin"><?php echo amos_output($elle_shares->tumblr_shares); ?><i class="icon-linkedin"></i></a></li>    
                                        </ul>
                                  
                            </div>
                        <?php endif; ?>
                        </div>
                        

                     </div>
			</div>

        </article>
		<div class="content">
        <?php comments_template( '/includes/view/blog/comments.php');  ?>
        </div>
		<?php

    endwhile;
endif;


?>

