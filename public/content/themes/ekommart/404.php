<?php
get_header(); ?>

	<div id="primary" class="content">

		<main id="main" class="site-main" role="main">

			<div class="error-404 not-found">

				<div class="page-content text-center">
					<header class="page-header">
                        <div class="error-img404">
                            <img src="<?php echo get_theme_file_uri('assets/images/404/404.png') ?>" alt="<?php echo esc_attr__('404 Page', 'ekommart') ?>">
                        </div>
						<h1 class="page-title"><?php esc_html_e( 'Oop, that link is broken.', 'ekommart' ); ?></h1>
					</header><!-- .page-header -->

                    <div class="error-text">
                        <span><?php esc_html_e("Page doesn’t exist or some other error occured. Go to our", 'ekommart') ?></span>
                        <br/>
                        <a href="javascript: history.go(-1)"
                           class="go-back"><?php esc_html_e('Previous page', 'ekommart'); ?></a>
                        <span><?php esc_html_e("or go back to   ", 'ekommart') ?></span>
                        <a href="<?php echo esc_url(home_url('/')); ?>"
                           class="return-home"><?php esc_html_e('Home page', 'ekommart'); ?></a>
                    </div>

				</div><!-- .page-content -->
			</div><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
