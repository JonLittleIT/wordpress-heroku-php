<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header(); ?>
	<div class="bdaia-home-container">
		<div class="bd-container">
			<div class="bd-main">
				<?php if ( have_posts() ): the_post(); ?>
					<div class="bdaia-template-head">
						<a class="rss-cat-icon rss-icon tooltip-s" title="<?php woohoo_tr( 'Feed Subscription' ); ?>"  href="<?php echo esc_url( get_author_feed_link( get_the_author_meta('ID') ) ); ?>"><span class="bdaia-io bdaia-io-rss"></span></a>
						<div class="bdaia-th-container">
							<?php woohoo_breadcrumbs(); // END Breadcrumbs. ?>
							<h4 class="block-title"><span><?php the_author() ?></span></h4>
							<div class="bdaia-author-box">
								<div class="authorBlock-avatar">
									<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 150 ); ?></a>
								</div>
								<div class="authorBlock-header">
									<p class="authorBlock-header-bio"><?php the_author_meta( 'description' ); ?></p>
									<div class="authorBlock-meta">
										<div class="authorBlock-meta bdaia-social-io-colored">
											<div class="bdaia-social-io bdaia-social-io-size-32">
												<?php if ( get_the_author_meta( 'url' ) ) : ?>
													<a class="bdaia-io-url-home" href="<?php the_author_meta( 'url' ); ?>"><span class="bdaia-io bdaia-io-home3"></span></a>
												<?php endif ?>

												<?php if ( get_the_author_meta( 'twitter' ) ) : $protocol = is_ssl() ? 'https' : 'http'; ?>
													<a class="bdaia-io-url-twitter" href="<?php echo $protocol; ?>://www.twitter.com/<?php the_author_meta( 'twitter' ); ?>"><span class="bdaia-io bdaia-io-twitter"></span></a>
												<?php endif ?>

												<?php if ( get_the_author_meta( 'facebook' ) ) : ?>
													<a class="bdaia-io-url-facebook" href="<?php the_author_meta( 'facebook' ); ?>"><span class="bdaia-io bdaia-io-facebook"></span></a>
												<?php endif ?>

												<?php if ( get_the_author_meta( 'instagram' ) ) : ?>
													<a class="bdaia-io-url-instagram" href="<?php the_author_meta( 'instagram' ); ?>"><span class="bdaia-io bdaia-io-instagram"></span></a>
												<?php endif ?>

												<?php if ( get_the_author_meta( 'google' ) ) : ?>
													<a class="bdaia-io-url-google-plus" href="https://plus.google.com/<?php the_author_meta( 'google' ); ?>?rel=author"><span class="bdaia-io bdaia-io-google-plus"></span></a>
												<?php endif ?>

												<?php if ( get_the_author_meta( 'youtube' ) ) : ?>
													<a class="bdaia-io-url-youtube" href="<?php the_author_meta( 'youtube' ); ?>"><span class="bdaia-io bdaia-io-youtube"></span></a>
												<?php endif ?>

												<?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
													<a class="bdaia-io-url-linkedin" href="<?php the_author_meta( 'linkedin' ); ?>"><span class="bdaia-io bdaia-io-linkedin2"></span></a>
												<?php endif ?>

												<?php if ( get_the_author_meta( 'pinterest' ) ) : ?>
													<a class="bdaia-io-url-pinterest" href="<?php the_author_meta( 'pinterest' ); ?>"><span class="bdaia-io bdaia-io-social-pinterest"></span></a>
												<?php endif ?>

												<?php if ( get_the_author_meta( 'flickr' ) ) : ?>
													<a class="bdaia-io-url-flickr" href="<?php the_author_meta( 'flickr' ); ?>"><span class="bdaia-io bdaia-io-flickr2"></span></a>
												<?php endif ?>

												<?php if ( get_the_author_meta( 'dribbble' ) ) : ?>
													<a class="bdaia-io-url-dribbble" href="<?php the_author_meta( 'dribbble' ); ?>"><span class="bdaia-io bdaia-io-dribbble"></span></a>
												<?php endif ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- END Author Box. -->
						</div>
					</div><!--/END Head/-->
				<?php endif; ?>
				<?php
				$GLOBALS['template_layout'] = woohoo_get_option( 'author_blog_display' );
				$woohoo_block_title = "";
				if( !empty( $GLOBALS['template_layout'] ) && $GLOBALS['template_layout'] == 'blockStyle2' || !empty( $GLOBALS['template_layout'] ) && $GLOBALS['template_layout'] == 'blockStyle6' ) {
					$woohoo_block_title = ' bdaia-block-nt';
				}
				?>
				<div class="cfix"></div>
				<div class="bdaia-block-wrap<?php echo $woohoo_block_title; ?>">
					<h4 class="block-title"><span><?php woohoo_tr( 'Posts By' ); echo ( ' ' ); the_author(); ?></span></h4>
					<?php
					// Start loop.
					rewind_posts();
					get_template_part( 'loop-template' );
					?>
					<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) woohoo_page_nav(); wp_reset_query(); ?>
				</div><!--/END Wrap/-->
			</div>
			<?php get_sidebar(); // END Sidebar. ?>
		</div>
	</div><!-- END Home Container. -->
<?php get_footer(); ?>