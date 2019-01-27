<?php /*** Portfolio Single Posts template. */

$farvis_portfolio_layout = get_post_meta( get_the_ID(), 'pix_portfolio_layout', true ) == '' ? 'default' : get_post_meta( get_the_ID(), 'pix_portfolio_layout', true );
$farvis_all_works_page = farvis_get_option('portfolio_settings_link_to_all', '0');
$full_portfolio = '';
if ( $farvis_all_works_page != 0 ) {
	$full_portfolio = get_the_permalink($farvis_all_works_page);
}

?>
<?php get_header();?>

<section class="portfolio-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12  col-sm-12">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
					?>
						<?php
						$farvis_portfolio_gallery = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_images', 'type=image&size=full') : '';
						$farvis_portfolio_desc = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_desc') : '';
						$farvis_portfolio_create = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_create') : '';
						$farvis_portfolio_complete = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_complete') : '';
						$farvis_portfolio_skills = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_skills') : '';
						$farvis_portfolio_client = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_client') : '';
						$farvis_portfolio_client_link = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_client_link') : '';
						$farvis_portfolio_button_link = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_button_link') : '';

						$farvis_portfolio_post_type = ( class_exists( 'RW_Meta_Box' ) && rwmb_meta('post_types_select') != '' ) ? rwmb_meta('post_types_select') : 'image';

						$farvis_portfolio_full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
						$farvis_portfolio_link = $farvis_portfolio_full_image[0];

						include_once( get_template_directory() . '/templates/portfolio/'.$farvis_portfolio_layout.'.php');
						?>


					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php
if ( farvis_get_option( 'portfolio_settings_related_show', 'on' ) == 'on' ) :
	$farvis_portfolio_related_title = farvis_get_option( 'portfolio_settings_related_title', esc_html__('Related projects', 'farvis' ) );
	$farvis_portfolio_related_desc = farvis_get_option( 'portfolio_settings_related_desc' );
	?>
	<!-- ========================== -->
	<!-- PORTFOLIO - RELATE WORKS SECTION -->
	<!-- ========================== -->
	<?php

	$portfolio_taxterms = wp_get_object_terms( $post->ID, 'portfolio_category', array('fields' => 'ids') );
	// arguments
	$args = array(
		'post_type' => 'portfolio',
		'post_status' => 'publish',
		'posts_per_page' => 3,
		'orderby' => 'rand',
		'tax_query' => array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $portfolio_taxterms
			)
		),
		'post__not_in' => array ($post->ID),
	);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) :

	?>
	<section class="portfolio-related-projects-section" id="portfolio_related_posts">
	
            
            <h3 class="b-upper-title text-center slabtextdone"><span class="slabtext slabtext-linesize-1 slabtext-linelength-13"><?php echo wp_kses_post($farvis_portfolio_related_title); ?></span></h3>
            
            
            
            
				<div class="container">

				<div class="row">
					<div class="list-works clearfix">
						<?php
						while ( $the_query->have_posts() ) :
							$the_query->the_post();

							$farvis_portfolio_thumbnail = get_the_post_thumbnail(get_the_id(), 'farvis-portfolio-thumb', array('class' => 'img-responsive'));
							$farvis_portfolio_thumbnail_full = get_the_post_thumbnail_url(get_the_ID(), 'full');


						?>
							<div class="col-md-4 col-sm-4 col-xs-6">
								<div class="portfolio-item">
									<div class="portfolio-image">
										<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><?php echo wp_kses_post($farvis_portfolio_thumbnail); ?></a>
										<div class="gallery-item-hover">
                                            <a href="<?php echo esc_url( $farvis_portfolio_thumbnail_full ); ?>" class="fancybox">
                                                <span class="item-hover-icon"><i class="fa fa-search"></i></span>
                                            </a>
                                            <a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>">
                                                <span class="item-hover-icon"><i class="fa fa-link"></i></span>
                                            </a>
                                        </div>
										<div class="portfolio-item-body">
											<div class="name"><?php echo wp_kses_post( get_the_title() ); ?></div>
											<div class="under-name"><?php echo farvis_get_post_terms( array( 'taxonomy' => 'portfolio_category', 'items_wrap' => '%s' ) ); ?></div>
										</div>
									</div>
								</div>
							</div>
						<?php
						endwhile;

						?>
					</div>
				</div></div>
			
		</div>
	</section>
	<?php
	endif;
	wp_reset_postdata();
endif;
?>

<div class="work-footer">
	<div class="container">
		<div class="controls">
			<ul>
				<li><?php previous_post_link( '%link', '<span class="fa fa-angle-left"></span>', false, '', 'portfolio_category'); ?></li>
				<?php if ( $full_portfolio != '' ) : ?>
				<li><a href="<?php echo esc_url($full_portfolio); ?>"><span class="fa fa-th"></span></a></li>
				<?php else : ?>
				<li><a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>"><span class="fa fa-th"></span></a></li>
				<?php endif; ?>
				<li><?php next_post_link( '%link', '<span class="fa fa-angle-right"></span>', false, '', 'portfolio_category' ); ?></li>
			</ul>
		</div>
	</div>
</div>

<?php get_footer();?>