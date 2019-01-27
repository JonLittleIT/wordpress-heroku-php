<?php
$comments = wp_count_comments($post->ID);
$categories = wp_get_post_categories($post->ID,array('fields' => 'all'));
$tags = get_the_tags($post->ID);
$farvis_format  = get_post_format();
$farvis_format = !in_array($farvis_format, array("quote", "gallery", "video")) ? 'standared' : $farvis_format;	
if ($farvis_format == 'video'){
	$video_embed_code = get_post_meta( get_the_ID(), 'post_video', true );
	$post_has_image = ($video_embed_code) ? true : false;
}else{
	$post_has_image = ( has_post_thumbnail() ) ? true : false;
}

?>



		<div class="blog-post">

	

			<?php if ($post_has_image):?>
			<div class="post-image">
				<?php
									
			        get_template_part( 'templates/post-single/blog', $farvis_format);
				?>
            </div>
			<?php endif;?>
            
            
            	<?php
			$get_avatar = get_avatar(get_the_author_meta('ID'), 85);
			preg_match("/src=['\"](.*?)['\"]/i", $get_avatar, $matches);
			$src = !empty($matches[1]) ? $matches[1] : '';
		?>
			<div class="post-header">
				<?php if(farvis_get_option('blog_settings_author_name', 1) && $src != '') : ?>
				<div class="col-md-1">
					<div class="avatar"><img src="<?php echo esc_url($src) ?>"  alt="avatar"/></div>
				</div>
				<?php endif; ?>
				<div class="col-md-11 wrap-post-info">
					<div class="post-info clearfix">
					<?php if(farvis_get_option('blog_settings_author_name', 1)) : ?>
						<h5 class="pull-left">
							<?php the_author_posts_link(); ?>
						</h5>
					<?php endif; ?>
						<ul class="list-inline pull-right">
							<?php if(farvis_get_option('blog_settings_date',1)): ?>
							<li><i class="fa fa-calendar"></i><?php echo get_the_date(null, $post->ID);; ?></li>
							<?php endif?>
							<?php if( 'open' == $post->comment_status && farvis_get_option('blog_settings_comments',1)) : ?>
							<li><i class="fa fa-commenting-o"></i><?php comments_popup_link( '0', '1', '%', "comments-link"); ?></li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
            

			<div class="post-body">
			

                <!-- === BLOG TEXT === -->
				<div class="post-content rtd">
					 <?php the_content()?>
                    
                    <div class="page-links">  <?php wp_link_pages();?></div>
				</div>

            </div>

			<div class="post-footer">
				<!-- === BLOG CATEGORIES === -->
				<?php if(farvis_get_option('blog_settings_categories', 1)) : ?>
					<div class="footer-meta blog-footer-categories">  
                          <div class="blog-footer-title"><?php esc_attr_e('Categories:', 'farvis')?></div>
						<?php $catIndex = 0; foreach($categories as $category):?>
							<a href="<?php echo esc_url(get_category_link($category->term_id))?>">
								<?php echo esc_attr($category->name) ?>
							</a>
							<?php $catIndex++; endforeach ?>
					</div>
				<?php endif ?>
				<?php if ($tags && farvis_get_option('blog_settings_tags', 1)):?>
					<div class="footer-meta blog-footer-tags">
	                   <div class="blog-footer-title"><?php esc_attr_e('Tags:', 'farvis')?></div>
		                    <?php $tagIndex = 0; foreach($tags as $tag):?>
		                    <a href="<?php echo esc_url(get_tag_link( $tag->term_id ))?>" class="entry-meta__link">
		                       <?php echo esc_attr($tag->name)?>
		                    </a>
			                <?php $tagIndex++; endforeach; ?>
	                
					</div>
				<?php endif;?>

                <!-- === BLOG SHARE === -->
				<?php if( shortcode_exists( 'share' ) && farvis_get_option('blog_settings_share', 1) ) : ?>
					<?php echo pix_display_format('[share]'); ?>
				<?php endif ?>

            </div>

        </div>
        <!--blog-post-->

     
		<?php comments_template(); ?>

