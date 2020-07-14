<?php $post_reviews = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true ); ?>

<div class="block-article bdaiaFadeIn">
	<article <?php woohoo_post_class(); ?>>
		<div class="block-article-img-container">
			<?php echo woohoo_icon_video_play(); ?>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
				<a class="bdaia-text-gradient--" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $GLOBALS['thumb_loop2_size'] ); ?></a>
			<?php endif; ?>
		</div>
		<header>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
		</header>
		<footer>
			<?php if ( $post_reviews ) { ?>
				<div class="bdaia-post-rating">
					<?php woohoo_final_score(); ?>
				</div>
			<?php } ?>
			<div class="bdaia-post-author-name">
				<?php woohoo_tr( 'By' ); ?>&nbsp;<?php the_author_posts_link(); ?>
				<?php if ( get_the_author_meta( 'twitter' ) ){ ?>
					<a href="https://twitter.com/<?php echo get_the_author_meta( 'twitter' ); ?>" target="_blank"><span class="bdaia-io bdaia-io-twitter"></span></a>
				<?php } ?>
			</div>
			<div class="bdaia-post-date"><?php woohoo_get_time(); ?></div>
			<div class="bdaia-post-cat-list"><?php woohoo_tr( 'in' ); echo '&nbsp;: &nbsp;'; printf( '%1$s', get_the_category_list( ', ' ) ); ?></div>
			<?php if( woohoo_get_option( 'bdaia_p_comment_count' ) ) { ?><div class="bdaia-post-comment"><span class='bdaia-io bdaia-io-bubble'></span><?php comments_popup_link( '0', '1', '%' ); ?></div><?php } ?>
			<?php if( woohoo_get_option( 'bdaia_p_post_views' ) ) { ?><div class="bdaia-post-view"><span class='bdaia-io bdaia-io-eye'></span><?php echo woohoo_get_views( get_the_ID() ); ?></div><?php } ?>
		</footer>
		<div class="block-article-content-wrapper">
			<p class="block-exb"><?php woohoo_exb1(); ?></p>
			<div class="bd-more-btn"><a href="<?php the_permalink(); ?>"><?php woohoo_tr( 'Read More' ); ?><span class="bdaia-io <?php if( is_rtl() ) echo 'bdaia-io-chevron_left'; else echo 'bdaia-io-chevron_right'; ?>"></span></a></div>
		</div>
	</article>
</div>