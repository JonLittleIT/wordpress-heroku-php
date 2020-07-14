<?php
/* Template Name: Popular */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

$c = 1;

$hot_q_args['orderby']              = 'comment_count';
$hot_q_args['order']                = 'DESC';
$hot_q_args['post_status']          = 'publish';
$hot_q_args['posts_per_page']       = 10;
$hot_q_args['cache_results']        = false;
$hot_q_args['no_found_rows']        = true;
$hot_q_args['ignore_sticky_posts']  = true;

$hot_query = new WP_Query( $hot_q_args ); ?>

<?php get_header(); ?>
<div class="bdaia-home-container">
	<div class="bd-container">
		<div class="bd-main">
			<div class="cfix"></div>
			<div class="bdaia-block-wrap">
				<?php
				if ( $hot_query->have_posts() )
				{
					?>
					<div class="bdaia-blocks bdaia-block1">
						<div class="bdaia-blocks-container">
							<?php while ( $hot_query->have_posts() ) : $hot_query->the_post(); ?>

								<?php $size = 'bdaia-block11'; ?>
								<?php $post_reviews = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true ); ?>

								<div class="block-article bdaiaFadeIn">
									<article <?php woohoo_post_class(); ?>>
										<header>
											<h3 class="name entry-title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
										</header>
										<div class="block-article-img-container">
											<?php echo woohoo_icon_video_play(); ?>
											<div class="bdaia-post-count"><?php echo $c;?></div>
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( $size ); ?>
											</a>
										</div>
										<div class="block-article-content-wrapper">
											<p class="block-exb"><?php woohoo_exb1(); ?></p>
											<div class="bd-more-btn"><a href="<?php the_permalink(); ?>"><?php woohoo_tr( 'Read More' ); ?><span class="bdaia-io <?php if( is_rtl() ) echo 'bdaia-io-chevron_left'; else echo 'bdaia-io-chevron_right'; ?>"></span></a></div>
										</div>
										<div class="cfix"></div>
									</article>
								</div>

							<?php $c++; endwhile; ?>
						</div>
					</div>
				<?php
				}
				wp_reset_query(); ?>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>