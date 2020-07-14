<?php
/**
 * Template for displaying single post
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
if ( ! is_singular() ) {
	return;}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php if ( 'post' === get_post_type() && beehive()->options->get( 'key=author-link&default=1' ) ) : ?>
			<div class="post-author">
				<span class="author-link"><?php echo esc_html__( 'By: ', 'beehive' ); ?><?php the_author_posts_link(); ?></span>
			</div>
		<?php endif; ?>
		<div class="entry-title">
			<?php if ( in_array( beehive()->layout->get(), array( 'social', 'social-12' ), true ) ) : ?>
				<?php the_title( '<h2 class="title">', '</h2>' ); ?>
			<?php else : ?>
				<?php the_title( '<h2 class="title h1">', '</h2>' ); ?>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta"><?php beehive_post_meta(); ?></div>
		<?php if ( beehive_get_post_slider_images() ) : ?>
			<div class="entry-thumbnail">
				<?php beehive_post_slider(); ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<div class="entry-content clearfix">
		<?php
		the_content(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'beehive' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		?>
	</div>
	<?php beehive_page_links(); ?>
	<?php do_action( 'beehive_after_post_body' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
