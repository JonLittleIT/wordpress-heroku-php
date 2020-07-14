<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly
get_header(); ?>
    <div class="bdaia-home-container">
        <div class="bd-container">
            <div class="bd-c-row">
                <div class="bd-main">
					<?php
					if( empty( $GLOBALS['template_layout'] ) ) $GLOBALS['template_layout'] = woohoo_get_option( 'bdaia_blog_display' );

					$block_title_c = "";
					if( !empty( $GLOBALS['template_layout'] ) && $GLOBALS['template_layout'] == 'blockStyle2' || !empty( $GLOBALS['template_layout'] ) && $GLOBALS['template_layout'] == 'blockStyle6' ) {
						$block_title_c = ' bdaia-block-nt';
					}
					?>
                    <div class="cfix"></div>
                    <div class="bdaia-block-wrap<?php echo $block_title_c; ?>">
						<?php get_template_part( 'loop-template', get_post_format() ); ?>
						<?php global $wp_query; if ( $wp_query->max_num_pages > 1 ) woohoo_page_nav(); wp_reset_query(); ?>
                    </div><!--/END Wrap/-->
                </div>
				<?php get_sidebar(); // END Sidebar. ?>
            </div>
        </div>
    </div><!-- END Home Container. -->
<?php get_footer(); ?>