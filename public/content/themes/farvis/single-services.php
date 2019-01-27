 <?php /* Template Name: Single Service */ 

$farvis_custom = isset( $wp_query ) ? get_post_custom( $wp_query->get_queried_object_id() ) : '';
$farvis_layout = isset ($farvis_custom['pix_page_layout']) ? $farvis_custom['pix_page_layout'][0] : '2';
$farvis_sidebar = isset ($farvis_custom['pix_selected_sidebar'][0]) ? $farvis_custom['pix_selected_sidebar'][0] : 'services-sidebar-1';

if ( ! is_active_sidebar($farvis_sidebar) ) $farvis_layout = '1';

?>
<?php get_header();?>

<section class="page-content">
    <div class="container">
        <div class="row">
      
		<?php farvis_show_sidebar( 'left', $farvis_layout, $farvis_sidebar ); ?>
        
        <div class="<?php if ( $farvis_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($farvis_layout == 2 ? 'right' : ($farvis_layout == 3 ? 'left' : 'hide')); ?> rtd">

        	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
					
				$farvis_thumbnail = get_the_post_thumbnail($post->ID);
			
			?>

		        <?php the_content(); ?>
                
            <?php endwhile; ?>

		</div>

		<?php farvis_show_sidebar( 'right', $farvis_layout, $farvis_sidebar ); ?>

		</div>
	</div>
</section>
<?php get_footer();?>
