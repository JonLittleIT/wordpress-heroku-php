<?php
/*** The template for displaying search results pages. ***/

$farvis_custom =  get_post_custom(get_the_ID());
$farvis_layout = isset( $farvis_custom['pix_page_layout'] ) ? $farvis_custom['pix_page_layout'][0] : '2';
$farvis_sidebar = isset( $farvis_custom['pix_selected_sidebar'][0] ) ? $farvis_custom['pix_selected_sidebar'][0] : 'sidebar-1';

?>

<?php get_header();?>
    <section class="page-content" id="pageContent">
        <div class="container">
            <div class="row">

                <?php farvis_show_sidebar( 'left', $farvis_layout, $farvis_sidebar ); ?>

				<div class="<?php if ( $farvis_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8 left-column sidebar-type-<?php echo esc_attr($farvis_layout == 2 ? 'right' : ($farvis_layout == 3 ? 'left' : 'hide')); ?><?php endif; ?> col-sm-12 col-xs-12">

                <?php if ( have_posts() ) : ?>

		            <?php get_template_part( 'loop', 'search' );?>

			    <?php else : ?>
			        <div id="post-0" class="post no-results not-found">
			            <h2><?php esc_attr_e( 'Nothing Found', 'farvis' ); ?></h2>
			            <div class="entry-content">
			                <p><?php esc_attr_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'farvis' ); ?></p>
							<?php get_search_form(); ?>
			             </div><!-- .entry-content -->
			        </div><!-- #post-0 -->
			    <?php endif; ?>

                </div>

                <?php farvis_show_sidebar( 'right', $farvis_layout, $farvis_sidebar ); ?>

            </div>
        </div>
    </section>
<?php get_footer(); ?>
			
            
            