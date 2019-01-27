<?php /*** The template for displaying 404 pages (not found) ***/ ?>

<?php get_header(); ?>
<!-- PAGE CONTENTS STARTS
	========================================================================= -->
<section class="blog-content-section page-404">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12">
                
                 <img src="<?php echo esc_url(get_template_directory_uri() . '/images/404-page.png' ) ?>" />
                
                
                <div class="page-404-info">
				<h2 class="notfound_title">
					<?php esc_attr_e('Page not found', 'farvis'); ?>
				</h2>
				<p class="notfound_description large">
					<?php esc_attr_e('The page you are looking for seems to be missing.', 'farvis'); ?>
				</p>
				<a class="notfound_button" href="<?php echo esc_url(home_url('/'))?>">
				<?php esc_attr_e('Return to home page', 'farvis'); ?>
				</a>
                </div>
			</div>
		</div>
	</div>
</section>
<!-- /. PAGE CONTENTS ENDS
	========================================================================= -->
<?php get_footer(); ?>