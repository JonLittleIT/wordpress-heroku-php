<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<?php beehive()->layout->set( 'full' ); ?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/before-template' ); ?>

<div class="error-404 not-found">
	<img src="<?php echo esc_url( beehive()->options->get( 'key=error-img&nested=url&default=' . BEEHIVE_URI . '/assets/images/404.png' ) ); ?>" alt="<?php esc_attr_e( '404 Error', 'beehive' ); ?>" class="img-fluid" />
	<?php if ( beehive()->options->get( 'key=error-title' ) ) : ?>
		<h1 class="error-title"><?php echo esc_html( beehive()->options->get( 'key=error-title' ) ); ?></h1>
	<?php else : ?>
		<h1 class="error-title"><?php esc_html_e( 'Whoops!', 'beehive' ); ?></h1>
	<?php endif; ?>
	<?php if ( beehive()->options->get( 'key=error-desc' ) ) : ?>
		<div class="error-description">
			<p><?php echo esc_html( beehive()->options->get( 'key=error-desc' ) ); ?></p>
		</div>
	<?php else : ?>
		<div class="error-description">
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try another search?', 'beehive' ); ?></p>
		</div>
	<?php endif; ?>
	<?php if ( beehive()->options->get( 'key=error-search&default=1' ) ) : ?>
		<div class="row">
			<div class="col-md-6 ml-auto mr-auto">
				<?php get_search_form(); ?>
			</div>
		</div>
	<?php endif; ?>
</div><!-- .error-404 -->

<?php get_template_part( 'template-parts/after-template' ); ?>

<?php
get_footer();
