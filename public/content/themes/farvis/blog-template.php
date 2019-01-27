<?php
/**
 * The home template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Template Name: Blog Template
 *
 */

$farvis_postpage_id = get_option( 'page_for_posts' );
$farvis_frontpage_id = get_option( 'page_on_front' );
$farvis_page_id = isset($wp_query) ? $wp_query->get_queried_object_id() : '';

if ( $farvis_page_id == $farvis_postpage_id && $farvis_postpage_id != $farvis_frontpage_id ) :
	$farvis_custom = isset( $wp_query ) ? get_post_custom( $wp_query->get_queried_object_id() ) : '';
	$farvis_layout = isset( $farvis_custom['pix_page_layout'] ) ? $farvis_custom['pix_page_layout'][0] : '2';
	$farvis_sidebar = isset( $farvis_custom['pix_selected_sidebar'][0] ) ? $farvis_custom['pix_selected_sidebar'][0] : 'sidebar-1';
else :
	$farvis_layout = farvis_get_option('blog_settings_sidebar_type', '2');
	$farvis_sidebar = farvis_get_option('blog_settings_sidebar_content', 'sidebar-1');
endif;

if ( ! is_active_sidebar($farvis_sidebar) ) $farvis_layout = '1';

?>
<?php get_header();?>

<section class="blog-content-section" id="main">
<div class="container">
	<div class="row">

		<?php farvis_show_sidebar( 'left', $farvis_layout, $farvis_sidebar ); ?>
		
		<div class="<?php if ( $farvis_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($farvis_layout == 2 ? 'right' : ($farvis_layout == 3 ? 'left' : 'hide')); ?>">
		
			<main class="main-content">
			
				<?php
                    $wp_query = new WP_Query();
                    $pp = get_option('posts_per_page');
                    $wp_query->query('posts_per_page='.$pp.'&paged='.$paged);
                    get_template_part( 'loop', 'index' );
                ?>
                <?php the_posts_pagination( array(
                    'prev_text'          => esc_html__( '&lt;', 'farvis' ),
                    'next_text'          => esc_html__( '&gt;', 'farvis' ),
                    'screen_reader_text' => esc_html__( '&nbsp;', 'farvis'),
                    'type' => 'list'
                ) ); ?>

			</main><!-- end main-content -->
			
		</div><!-- end col -->

		<?php farvis_show_sidebar( 'right', $farvis_layout, $farvis_sidebar ); ?>

	</div><!-- end row -->
</div>
</section>
<?php get_footer(); ?>
