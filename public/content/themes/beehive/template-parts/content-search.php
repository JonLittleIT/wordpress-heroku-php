<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-wrapper">
		<div class="entry-content">
			<div class="entry-content-inner">
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
