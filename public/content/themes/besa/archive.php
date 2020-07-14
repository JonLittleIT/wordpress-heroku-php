<?php
get_header();

$sidebar_configs = besa_tbay_get_blog_layout_configs();
$blog_archive_layout =  ( isset($_GET['blog_archive_layout']) )  ? $_GET['blog_archive_layout'] : besa_tbay_get_config('blog_archive_layout', 'main-right');
if(isset($sidebar_configs['sidebar'])) {
	$sidebar_id = $sidebar_configs['sidebar']['id'];
	if ( !is_active_sidebar( $sidebar_id ) ) {
		$class_main = 'container';
	}
}
$class_row = ( $blog_archive_layout === 'main-right' ) ? 'flex-row-reverse' : '';

besa_tbay_render_breadcrumbs();

$class_main = apply_filters('besa_tbay_post_content_class', 'container');


$blog_columns = apply_filters( 'loop_blog_columns', 1 );

$columns	= $blog_columns;
if(isset($blog_columns) && $blog_columns >= 3) {
	$screen_desktop 		= 3;
	$screen_desktopsmall 	= 2;
	$screen_tablet 			= 2;
} else {
	$screen_desktop 		= $blog_columns;
	$screen_desktopsmall 	= $blog_columns;
	$screen_tablet 			= $blog_columns;
}

$screen_mobile 				= 1;

$data_responsive = ' data-xlgdesktop='. $columns .'';

$data_responsive .= ' data-desktop='. $screen_desktop .'';

$data_responsive .= ' data-desktopsmall='. $screen_desktopsmall .'';

$data_responsive .= ' data-tablet='. $screen_tablet .'';

$data_responsive .= ' data-mobile='. $screen_mobile .'';

?>
<header class="page-header">
	<div class="content <?php echo esc_attr($class_main); ?>">
	<?php
	the_archive_description( '<div class="taxonomy-description">', '</div>' );
	?>
	</div>
</header><!-- .page-header -->
<section id="main-container" class="main-content <?php echo esc_attr($class_main); ?>">

	<?php do_action( 'besa_post_template_main_container_before' ); ?>

	<div class="row no-gutters <?php echo esc_attr($class_row); ?>">
		
		<?php if ( isset($sidebar_configs['sidebar'])  && is_active_sidebar( $sidebar_id ) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['sidebar']['class']) ;?>">
			  	<aside class="sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php dynamic_sidebar( $sidebar_id ); ?>
			  	</aside>
			</div>
		<?php endif; ?>

		<div id="main-content" class="<?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<div id="main" class="site-main layout-blog">

				<?php do_action( 'besa_post_template_main_content_before' ); ?>

				<div class="row grid" <?php echo trim($data_responsive); ?>>
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
					// If no content, include the "No posts found" template.
					else :
						get_template_part( 'post-formats/content', 'none' );

					endif;
					?>
				</div>
				<?php
					// Previous/next page navigation.
					besa_tbay_paging_nav();
				?>
				<?php do_action( 'besa_post_template_main_content_after' ); ?>

			</div><!-- .site-main -->
		</div><!-- .content-area -->
		
	</div>

	<?php do_action( 'besa_post_template_main_container_after' ); ?>
</section>
<?php get_footer(); ?>
