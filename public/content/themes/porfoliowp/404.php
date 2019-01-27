<?php
/**
 * The template for displaying 404 pages (not found).
 *
 */

get_header(); ?>

	<!-- Page content -->
	<div id="primary" class="content-area">
	    <main id="main" class="vc_container blog-posts site-main">
	        <div class="vc_col-md-12 main-content">
				<section class="error-404 not-found">
					<header class="page-header-404">
						<div class="high-padding">
							<img class="aligncenter" src="<?php echo esc_url(get_template_directory_uri() . '/images/404.png'); ?>" alt="<?php esc_html_e( 'Not Found', 'porfoliowp' ); ?>">
							<h2 class="page-title text-center"><?php esc_html_e( 'Sorry, this page does not exist', 'porfoliowp' ); ?></h2>
							<h3 class="page-title text-center"><?php esc_html_e( 'The link you clicked might be corrupted, or the page may have been removed.', 'porfoliowp' ); ?></h3>
						</div>
					</header>
				</section>
			</div>
		</main>
	</div>

<?php get_footer(); ?>