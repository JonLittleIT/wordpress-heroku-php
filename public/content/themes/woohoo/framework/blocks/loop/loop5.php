<?php $size = $GLOBALS['bdaia-widget']; ?>
<?php $post_reviews = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true ); ?>

<div class="block-article bd-col-md-4 bdaiaFadeIn">
	<article <?php woohoo_post_class(); ?>>
		<div class="block-article-img-container">
			<div class="block-info-cat"><?php echo woohoo_custom_primary_category(); ?></div>
			<?php echo woohoo_icon_video_play(); ?>
			<?php if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) ) { ?>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $size ); ?>
				</a>
			<?php } else { ?>
				<img width="320" height="220" src="<?php echo woohoo_get_video_image( '320x220' ); ?>" alt="" />
			<?php } ?>
		</div>
		<header>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
		</header>
        <footer>
			<?php if ( $post_reviews ) { ?>
                <div class="bdaia-post-rating"><?php echo woohoo_final_score(); ?></div>
			<?php } else { ?>
                <div class="bdaia-post-author-name">
					<?php woohoo_tr( 'By' ); ?>&nbsp;<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title=""><?php echo get_the_author() ?> </a>
                </div>
                <div class="bdaia-post-date"><?php woohoo_get_time(); ?></div>
			<?php } ?>
        </footer>
	</article>
</div>
