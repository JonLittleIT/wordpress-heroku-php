<?php $size = 'bdaia-block11'; ?>
<?php $post_reviews = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true ); ?>

<div class="block-article bd-col-md-6 bdaiaFadeIn">
	<article <?php woohoo_post_class(); ?>>
		<div class="block-article-img-container">
			<?php echo woohoo_icon_video_play(); ?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $size ); ?></a>
		</div>
		<header>
			<div class="block-info-cat"><?php echo woohoo_custom_primary_category(); ?></div>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
		</header>
		<footer>
			<?php if ( $post_reviews ) { ?>
				<div class="bdaia-post-rating"><?php echo woohoo_final_score(); ?></div>
			<?php } else { ?>
				<div class="bdaia-post-author-name">
					<?php woohoo_tr( 'By' ); ?>&nbsp;<?php the_author_posts_link(); ?>
					<?php if ( get_the_author_meta( 'twitter' ) ){ ?>
						<a href="https://twitter.com/<?php echo get_the_author_meta( 'twitter' ); ?>" target="_blank"><span class="bdaia-io bdaia-io-twitter"></span></a>
					<?php } ?>
				</div>
				<div class="bdaia-post-date"><?php woohoo_get_time(); ?></div>
				<?php if( woohoo_get_option( 'bdaia_p_comment_count' ) ) { ?><div class="bdaia-post-comment"><span class='bdaia-io bdaia-io-bubble'></span><?php comments_popup_link( '0', '1', '%' ); ?></div><?php } ?>
				<?php if( woohoo_get_option( 'bdaia_p_post_views' ) ) { ?><div class="bdaia-post-view"><span class='bdaia-io bdaia-io-eye'></span><?php echo woohoo_get_views( get_the_ID() ); ?></div><?php } ?>
			<?php } ?>
		</footer>
	</article>
</div>
