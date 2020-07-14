<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header(); ?>
	<div class="bdaia-home-container">
		<div class="bd-container">
			<div class="bd-main">
				<?php if ( have_posts() ): the_post(); ?>
					<div class="bdaia-template-head">
						<a class="rss-cat-icon rss-icon tooltip-s" title="<?php woohoo_tr( 'Feed Subscription' ); ?>"  href="<?php $tag_id = get_query_var('tag_id'); echo  get_term_feed_link($tag_id , 'post_tag', "rss2") ?>"><span class="bdaia-io bdaia-io-rss"></span></a>
						<div class="bdaia-th-container">
							<?php woohoo_breadcrumbs(); // END Breadcrumbs. ?>
							<h4 class="block-title"><span><?php printf( woohoo__tr( 'Tag Archives:' ) . ' %s', single_tag_title( '', false ) );	?></span></h4>
							<?php
							// Show an optional term description.
							$term_description = term_description();
							if ( ! empty( $term_description ) ) :
								printf( '<div class="taxonomy-description">%s</div>', $term_description );
							endif;
							?>
						</div>
					</div><!--/END Head/-->
				<?php endif; ?>
				<?php
				$GLOBALS['template_layout'] = woohoo_get_option( 'tag_blog_display' );
				$block_title_c = "";
				if( !empty( $GLOBALS['template_layout'] ) && $GLOBALS['template_layout'] == 'blockStyle2' || !empty( $GLOBALS['template_layout'] ) && $GLOBALS['template_layout'] == 'blockStyle6' ) {
					$block_title_c = ' bdaia-block-nt';
				}
				?>
				<div class="cfix"></div>
				<div class="bdaia-block-wrap<?php echo $block_title_c; ?>">
					<?php
					rewind_posts();
					get_template_part( 'loop-template' ); ?>
					<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) woohoo_page_nav(); wp_reset_query(); ?>
				</div><!--/END Wrap/-->
			</div>
			<?php get_sidebar(); // END Sidebar. ?>
		</div>
	</div><!-- END Home Container. -->
<?php get_footer(); ?>