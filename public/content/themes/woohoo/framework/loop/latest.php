<?php
global $post;
$size = $GLOBALS['bdaia-widget']; ?>
<li <?php post_class('bdaia-posts-grid-post post-item post-id post'); ?>>
	<div class="bdaia-posts-grid-post-inner">
		<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) { ?>
			<div class="post-image">
				<?php echo woohoo_icon_video_play(); ?>

				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $size ); ?>
				</a>
			</div>
		<?php } ?>
		<div class="bdayh-post-header">
			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" >', '</a></h3>' ); ?>
			<div class="bdaia-post-excerpt"><?php echo woohoo_cl( get_the_excerpt() , 90 ) ?></div>
			<div class="bbd-post-cat">
				<div class="bbd-post-cat-content">
					<div class="bdayh-post-meta-date">
						<?php woohoo_get_time(); ?>
					</div>
					<span class="bdayh-post-meta-time-read"><span class='bdaia-io bdaia-io-clock'></span> <?php woohoo_post_read_time(); ?></span>
				</div>
			</div>
		</div>
	</div>
</li>