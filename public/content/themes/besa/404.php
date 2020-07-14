<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Besa
 * @since Besa 1.0
 */
/*

*Template Name: 404 Page
*/
get_header();

?>

<section id="main-container" class=" container inner">
	<div id="main-content" class="main-page page-404">

		<section class="error-404 text-center">
			<h1><?php esc_html_e( 'OOPS!', 'besa' ); ?></h1>
			<h3><?php esc_html_e('Error 404: Page Not Found','besa') ?></h3>
			<div class="page-content">
				<p class="sub-title"><?php esc_html_e( 'We’re very sorry but the page you are looking for doesn’t exist or has been moved.
				 Please back to', 'besa') ?> <a class="backtohome" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('home page', 'besa'); ?></a>
				<?php esc_html_e('if It’s mistake.','besa') ?></span><?php ; ?></p>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	</div>
</section>

<?php get_footer(); ?>