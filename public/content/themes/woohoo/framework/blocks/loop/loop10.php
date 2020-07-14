<?php $size = 'bdaia-block11'; ?>
<?php $post_reviews = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true ); ?>
<?php if ( $GLOBALS['bd_bc2'] == 0 || $GLOBALS['bd_bc2'] == 1 ) { ?>
	<div class="bd-col-md-6 bdaiaFadeIn">
		<div class="block-article block-first-article">
			<article <?php woohoo_post_class(); ?>>
				<div class="block-article-img-container">
					<?php echo woohoo_icon_video_play(); ?>
					<div class="block-info-cat"><?php echo woohoo_custom_primary_category(); ?></div>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $size ); ?></a>
				</div>
				<div class="block-article-content-wrapper">
					<header>
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
					<p class="block-exb"><?php echo woohoo_cl( get_the_excerpt() , '124' ) ?></p>
					<div class="bd-more-btn"><a href="<?php the_permalink(); ?>"><?php woohoo_tr( 'Read More' ); ?><span class="bdaia-io <?php if( is_rtl() ) echo 'bdaia-io-chevron_left'; else echo 'bdaia-io-chevron_right'; ?>"></span></a></div>
				</div>
			</article>
		</div>
	</div>
<?php } else { ?>
	<?php if( $GLOBALS['bd_bc1'] % 999 == 1 ) echo '<div class="bd-block-row bdaiaFadeIn">'; ?>
	<div class="block-article block-other-article bd-col-md-6">
		<article <?php woohoo_post_class(); ?>>
			<div class="block-article-img-container">
				<?php echo woohoo_icon_video_play(); ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $GLOBALS['bdaia-small'] ); ?></a>
			</div>
			<div class="block-article-content-wrapper">
				<header>
					<h3 class="name entry-title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
				</header>
				<footer>
					<?php if( $post_reviews ){ ?>
						<div class="bdaia-post-rating">
							<?php echo woohoo_final_score(); ?>
						</div>
					<?php } else { ?>
						<div class="bdaia-post-date"><?php woohoo_get_time(); ?></div>
						<?php if( woohoo_get_option( 'bdaia_p_comment_count' ) ) { ?><div class="bdaia-post-comment"><span class='bdaia-io bdaia-io-bubble'></span><?php comments_popup_link( '0', '1', '%' ); ?></div><?php } ?>
						<?php if( woohoo_get_option( 'bdaia_p_post_views' ) ) { ?><div class="bdaia-post-view"><span class='bdaia-io bdaia-io-eye'></span><?php echo woohoo_get_views( get_the_ID() ); ?></div><?php } ?>
					<?php } ?>
				</footer>
			</div>
		</article>
	</div>
	<?php if( $GLOBALS['bd_bc1'] % 999 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++; ?>
<?php } ?>
<?php $GLOBALS['bd_bc2']++; ?>