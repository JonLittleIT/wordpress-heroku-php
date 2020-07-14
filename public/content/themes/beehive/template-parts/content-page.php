<?php
/**
 * Template part for displaying page content in page.php
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
	<div class="entry-content clearfix">
		<?php if ( '1' === beehive()->options->get_meta_option( 'post-thumb' ) && has_post_thumbnail() ) : ?>
			<div class="featured-image">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
		<?php
			the_content();
		?>
	</div><!-- .entry-contents -->
	<?php beehive_page_links(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
