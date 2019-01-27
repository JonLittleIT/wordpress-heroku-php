<?php 
/*** The taxonomy for portfolio category. ***/
get_header(); 

 	$farvis_pix_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
	$services_page = farvis_get_option('services_settings_page', '');
	$all_services = '';
	if ( '' != $services_page ) {
		$all_services = get_the_permalink($services_page);
	}
	
?>
<section class="page-content taxonomy-page" >
	<div class="container">
		<div class="services">
		    <div class="row">
				<div class="col-sm-3">
					<div class="sidebar-services">
						<div>
							<ul>
								<li><a href="<?php echo esc_url($all_services) ?>"><?php esc_attr_e('All services', 'farvis') ?></a></li>
								<?php $args = array( 'taxonomy' => 'services_category', 'hide_empty' => '1', 'title_li'=> '', 'show_count' => '0', 'current_category' => $farvis_pix_term->term_id);
								$categories = wp_list_categories ($args);
								?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="row services">
				
	
	<?php
		$farvis_pix_services = get_objects_in_term( $farvis_pix_term->term_id, 'services_category');
		$args = array(
					'post_type' => 'services', 
					'orderby' => 'menu_order',
					 'post__in' => $farvis_pix_services,			 
					'order' => 'ASC',
					'posts_per_page' => -1
				);
			
		$wp_query = new WP_Query( $args );
										
		if ($wp_query->have_posts()):
			while ($wp_query->have_posts()) :
				$wp_query->the_post();
				$farvis_pix_thumbnail = get_the_post_thumbnail($post->ID, 'farvis-services-thumb', array('class' => "full-width"));
	?>
						
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                             <div class="service-item">
                        <div class="service-item-image">
							<div class="img-hover-effect">
                                <a href="<?php echo esc_url(get_permalink(get_the_ID())) ?>"><?php echo wp_kses_post($farvis_pix_thumbnail) ?></a>
                            </div> </div>
                                   <div class="service-item-footer">
							<h4><?php echo wp_kses_post(get_the_title()) ?></h4>
							<p><?php echo farvis_limit_words(get_the_excerpt(), 20) ?></p>
							<a class="btn btn-style-global  btn-style-0" href="<?php echo esc_url(get_permalink(get_the_ID())) ?>"><?php esc_attr_e('READ MORE', 'farvis') ?></a>
						</div></div></div>
    <?php
			endwhile;
		endif;
	?>
      

					</div>
				</div>
			</div>
	    </div>
	</div>
</section>

<?php get_footer() ?>