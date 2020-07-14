<?php
/**
 * Template for displaying blog grid listings
 *
 * Used for single blog posts
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php
if ( is_singular() ) {
	return; }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-wrapper">
		<div class="entry-content">
			<?php if ( is_sticky() ) : ?>
				<?php if ( is_home() && ! is_paged() ) : ?>
					<div class="beehive-sticky-post"><?php esc_html_e( 'Sticky', 'beehive' ); ?></div>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( beehive_get_post_slider_images() ) : ?>
				<div class="entry-thumbnail">
					<?php beehive_post_slider(); ?>
				</div>
			<?php endif; ?>
			<div class="entry-content-inner">
				<?php if ( beehive()->options->get( 'key=display-post-format' ) && get_post_format() ) : ?>
					<div class="post-format">
						<a href="<?php echo esc_url( get_post_format_link( get_post_format() ) ); ?>"><?php echo esc_html( get_post_format_string( get_post_format() ) ); ?></a>
					</div>
				<?php endif; ?>
				<div class="entry-meta">
					<span class="link date-links">
						<i class="uil-calender"></i>
						<a href="<?php echo esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ); ?>"><?php echo get_the_date(); ?></a>
					</span>
				</div>
				<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
				<div class="entry-excerpt">
					<?php the_excerpt(); ?>
				</div>
				<div class="read-more">
					<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more-link color-primary"><?php echo esc_html__( 'Continue reading', 'beehive' ) . '...'; ?></a>
				</div>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
