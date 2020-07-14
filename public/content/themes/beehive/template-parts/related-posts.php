<?php
/**
 * Related posts
 *
 * Displays related blog posts in single blot
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php
if ( ! is_singular() ) {
	return; }
?>

<?php $related_posts = beehive_get_related_posts( get_the_ID(), 2 ); ?>

<?php if ( isset( $related_posts ) && $related_posts->have_posts() ) : ?>
	<div class="related-posts animate-item slideInUp">
		<div class="block-title center">
			<h3><?php esc_html_e( 'Related Posts', 'beehive' ); ?></h3>
		</div>
		<div class="blog-layout-grid grid-columns-2">
			<?php while ( $related_posts->have_posts() ) : ?>
				<?php $related_posts->the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-wrapper">
						<?php if ( beehive_get_post_slider_images() ) : ?>
							<div class="entry-thumbnail">
								<?php beehive_post_slider(); ?>
							</div>
						<?php endif; ?>
						<div class="entry-content">
							<div class="entry-meta">
								<span class="link date-links">
									<a href="<?php echo esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ); ?>"><?php echo get_the_date(); ?></a>
								</span>
							</div>
							<?php the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
							<div class="entry-excerpt">
								<?php if ( has_excerpt() ) : ?>
									<?php the_excerpt(); ?>
								<?php else : ?>
									<p>
										<?php
										if ( 'social' === beehive()->layout->get() ) {
											echo esc_html( beehive_trim_str( wp_strip_all_tags( get_the_excerpt() ), 100 ) );
										} else {
											echo esc_html( beehive_trim_str( wp_strip_all_tags( get_the_excerpt() ), 120 ) );
										}
										?>
									</p>
								<?php endif; ?>
							</div>
							<div class="read-more">
								<a href="<?php echo esc_url( get_permalink() ); ?>" class="color-primary"><?php echo esc_html__( 'Continue reading', 'beehive' ) . '...'; ?></a>
							</div>
						</div>
					</div>
				</article><!-- #post-<?php the_ID(); ?> -->
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>
<?php
wp_reset_postdata();
