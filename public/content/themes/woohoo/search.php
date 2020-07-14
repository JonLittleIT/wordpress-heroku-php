<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header(); ?>
	<div class="bdaia-home-container">
		<div class="bd-container">
			<div class="bd-main">

				<div class="bdaia-template-head">
					<div class="bdaia-th-container">
						<?php woohoo_breadcrumbs(); // END Breadcrumbs. ?>
						<h4 class="block-title">
							<span>
								<?php if ( have_posts() ) : ?>
									<?php printf( woohoo__tr( 'Search Results for: %s' ), get_search_query() ); ?>
								<?php else : ?>
									<?php woohoo_tr( 'Nothing Found' ); ?>
								<?php endif; ?>
							</span>
						</h4>

						<div class="search-form">
							<?php get_search_form(); ?>
						</div>

					</div>
				</div><!--/END Head/-->
				<?php
				$GLOBALS['template_layout'] = woohoo_get_option( 'search_blog_display' );
				$block_title_c = "";
				if( $GLOBALS['template_layout'] == 'blockStyle2' || $GLOBALS['template_layout'] == 'blockStyle6' ) {
					$block_title_c = ' bdaia-block-nt';
				}
				?>
				<div class="cfix"></div>
				<div class="bdaia-block-wrap<?php echo $block_title_c; ?>">
					<?php
					// Start loop.
					get_template_part( 'loop-template' );
					?>
					<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) woohoo_page_nav(); wp_reset_query(); ?>
				</div><!--/END Wrap/-->
			</div>
			<?php get_sidebar(); // END Sidebar. ?>
		</div>
	</div><!-- END Home Container. -->
<?php get_footer(); ?>