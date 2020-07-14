<?php
get_header();


if( !(defined('TBAY_ELEMENTOR_ACTIVED') && TBAY_ELEMENTOR_ACTIVED) ) {

	$colContent = (is_active_sidebar('sidebar-default')) ? 9 : 12;
	?>
		<div id="primary" class="content-area content-index">
			<div id="main" class="site-main">
				<div class="container">
				<div class="container-inner main-content">
					<div class="row"> 
		                <!-- MAIN CONTENT -->
		                <div class="col-lg-<?php echo esc_attr($colContent); ?> col-md-<?php echo esc_attr($colContent); ?>">
		                        <?php  if ( have_posts() ) : 
		                        	while ( have_posts() ) : the_post();
										?>
											<div class="layout-blog">
												<?php get_template_part( 'post-formats/content', get_post_format() ); ?>
											</div>
										<?php
									// End the loop.
									endwhile;
									besa_tbay_paging_nav();
									?>
		                        <?php else : ?>
		                            <?php get_template_part( 'post-formats/content', 'none' ); ?>
		                        <?php endif; ?>
		                </div>
						<?php if(is_active_sidebar('sidebar-default')) : ?>
							<div class="col-lg-3 col-md-3 col-sm-12 sidebar">
							   <?php dynamic_sidebar('sidebar-default'); ?>
							</div>
						<?php endif;?>
		            </div>
	            </div>
	            </div>
			</div><!-- .site-main -->
		</div><!-- .content-area -->
<?php
} else {

	$sidebar_configs = besa_tbay_get_blog_layout_configs();
	$blog_archive_layout =  ( isset($_GET['blog_archive_layout']) )  ? $_GET['blog_archive_layout'] : besa_tbay_get_config('blog_archive_layout', 'main-right');
	$blog_single_layout =	( isset($_GET['blog_single_layout']) ) ? $_GET['blog_single_layout']  :  besa_tbay_get_config('blog_single_layout', 'left-main');
	$class_row = ( ( $blog_archive_layout === 'main-right') || ( $blog_single_layout === 'main-right' ) ) ? 'flex-row-reverse' : '';

	besa_tbay_render_breadcrumbs();

	$class_main = apply_filters('besa_tbay_post_content_class', 'container');
	
	$blog_columns = apply_filters( 'loop_blog_columns', 1 );

	$columns	= $blog_columns;
	if(isset($blog_columns) && $blog_columns >= 4) {
		$screen_desktop 		= 3;
		$screen_desktopsmall 	= 3;
	} else {
		$screen_desktop 		= $blog_columns;
		$screen_desktopsmall 	= $blog_columns;
	}


	$screen_tablet 				= 2;
	$screen_mobile 				= 2;

	$data_responsive = ' data-xlgdesktop='. $columns .'';

	$data_responsive .= ' data-desktop='. $screen_desktop .'';

	$data_responsive .= ' data-desktopsmall='. $screen_desktopsmall .'';

	$data_responsive .= ' data-tablet='. $screen_tablet .'';

	$data_responsive .= ' data-mobile='. $screen_mobile .'';

	?>

	<section id="main-container" class="main-content  <?php echo esc_attr($class_main); ?>">

		<?php do_action( 'besa_post_template_main_container_before' ); ?>

		<div class="row <?php echo esc_attr($class_row); ?>">

			<?php if ( ( ( $blog_archive_layout !== 'main' ) || ( $blog_single_layout !== 'main' ) ) && is_active_sidebar( $sidebar_configs['sidebar']['id'] ) ) : ?>
				<div class="<?php echo esc_attr($sidebar_configs['sidebar']['class']) ;?>">
				  	<aside class="sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
				   		<?php dynamic_sidebar( $sidebar_configs['sidebar']['id'] ); ?>
				  	</aside>
				</div>
			<?php endif; ?>

			<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
				<main id="main" class="site-main layout-blog">

					<?php do_action( 'besa_post_template_main_content_before' ); ?>

					<div class="row" <?php echo esc_attr($data_responsive); ?>>
						<?php if ( have_posts() ) : ?>

							<?php
							// Start the Loop.
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								?>

								<div>
							
									<?php get_template_part( 'post-formats/content', get_post_format() ); ?>

								</div>

								<?php
							// End the loop.
							endwhile;

							// Previous/next page navigation.
							besa_tbay_paging_nav();

						// If no content, include the "No posts found" template.
						else :
							get_template_part( 'post-formats/content', 'none' );

						endif;
						?>
					</div>

					<?php do_action( 'besa_post_template_main_content_after' ); ?>

				</main><!-- .site-main -->
			</div><!-- .content-area -->
			
		</div>

		<?php do_action( 'besa_post_template_main_container_after' ); ?>
	</section> 
	<?php

}

get_footer(); ?>
