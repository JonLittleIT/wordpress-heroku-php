<?php
/*** The template for displaying portfolio categories. ***/

get_header();

$farvis_layout = farvis_get_option('portfolio_settings_sidebar_type', '2');
$farvis_sidebar = farvis_get_option('portfolio_settings_sidebar_content', 'sidebar-1');

if ( ! is_active_sidebar($farvis_sidebar) ) $farvis_layout = '1';

$farvis_portfolio_perrrow = farvis_get_option('portfolio_settings_perrow', '2');
if ( $farvis_portfolio_perrrow == '3' ) {
	$farvis_add_class_port_col = 'col-md-4 col-sm-4 col-xs-6';
}
elseif ( $farvis_portfolio_perrrow == '4' ) {
	$farvis_add_class_port_col = 'col-md-3 col-sm-4 col-xs-6';
}
else {
	$farvis_add_class_port_col = 'col-md-6 col-sm-6 col-xs-6';
}

$farvis_portfolio_perrow = farvis_get_option('portfolio_settings_perrow', '2');
$farvis_portfolio_css_animation = ( farvis_get_option('css_animation_settings_portfolio', '') != '' ) ? ' wow '.farvis_get_option('css_animation_settings_portfolio', '') : '';
$farvis_portfolio_type = farvis_get_option('portfolio_settings_type', 'type_without_icons');
$farvis_portfolio_loadmore = farvis_get_option('portfolio_settings_loadmore', esc_html__('Load more', 'farvis' ) );

$farvis_portfolio_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

?>

<!-- ========================== -->
<!-- BLOG - CONTENT -->
<!-- ========================== -->
<section class="page-section">
	<div class="container">
		<div class="row">

			<?php farvis_show_sidebar( 'left', $farvis_layout, $farvis_sidebar ); ?>

			<div class="<?php if ( $farvis_layout == 1 ) : ?>col-lg-12 col-md-12<?php else : ?>col-lg-9 col-md-8<?php endif; ?> col-sm-12 col-xs-12 left-column sidebar-type-<?php echo esc_attr($farvis_layout == 2 ? 'right' : ($farvis_layout == 3 ? 'left' : 'hide')); ?>">

				<div id="portfolio-category-section" class="portfolio-list-section portfolio-perrow-<?php echo esc_attr($farvis_portfolio_perrow); ?>">

				<?php $farvis_portfolio_category_description = get_term_field( 'description', $farvis_portfolio_term->term_id, 'portfolio_category' );
				if( !is_wp_error( $farvis_portfolio_category_description ) && $farvis_portfolio_category_description != '' ) :
				?>
					<div class="section-heading text-center">
						<div class="section-subtitle"><?php echo wp_kses_post($farvis_portfolio_category_description);?></div>
						<div class="design-arrow"></div>
					</div>

				<?php
				endif;

					$farvis_portfolio_categories = get_objects_in_term( $farvis_portfolio_term->term_id, 'portfolio_category');

					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$args = array(
								'post_type' => 'portfolio',
								'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
								'post__in' => $farvis_portfolio_categories,
								'paged' => $paged
							);

					$wp_query = new WP_Query( $args );

					if ( $wp_query->have_posts() ) : ?>

						<div class="row portfolio-masonry-holder list-works clearfix">
						<?php
						while ( $wp_query->have_posts() ) :
							$wp_query->the_post();

							$farvis_portfolio_post_type = ( class_exists( 'RW_Meta_Box' ) && rwmb_meta('post_types_select') != '' ) ? rwmb_meta('post_types_select') : 'image';

							$cats = wp_get_object_terms(get_the_id(), 'portfolio_category');
							$farvis_cat_slugs = '';
							if ( ! empty($cats) ) {
								foreach ( $cats as $cat ) {
									$farvis_cat_slugs .= $cat->slug . " ";
								}
							}
							$farvis_portfolio_thumbnail = get_the_post_thumbnail(get_the_id(), 'farvis-portfolio-thumb', array('class' => 'img-responsive'));
							$farvis_portfolio_thumbnail_full = get_the_post_thumbnail_url(get_the_ID(), 'full');

							// potfolio category list linked
							$farvis_portfolio_linked_list_cats = farvis_get_post_terms( array( 'taxonomy' => 'portfolio_category', 'items_wrap' => '%s' ) );

							if ( $farvis_portfolio_type == 'type_without_icons' || $farvis_portfolio_type == 'type_without_space' ) : ?>

									<div class="<?php echo esc_attr($farvis_add_class_port_col); ?> item <?php echo esc_attr($farvis_portfolio_css_animation); ?> <?php echo esc_attr($farvis_cat_slugs); ?>" id="post-<?php echo esc_attr(get_the_ID()); ?>">
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
													<div class="under-name"><?php echo wp_kses_post( $farvis_portfolio_linked_list_cats ); ?></div>
												</div>
											</div>
										</div>
									</div>

							<?php
							else : ?>

									<div class="<?php echo esc_attr($farvis_add_class_port_col); ?> item <?php echo esc_attr($farvis_portfolio_css_animation); ?> <?php echo esc_attr($farvis_cat_slugs); ?>" id="post-<?php echo esc_attr(get_the_ID()); ?>">
										<div class="portfolio-item">
											<div class="portfolio-image">
												<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><?php echo wp_kses_post($farvis_portfolio_thumbnail); ?></a>
												<div class="portfolio-item-body center-body">
													<ul>
														<?php
														if ( $farvis_portfolio_post_type == 'image' ) :
															$farvis_portfolio_gallery = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_images', 'type=image&size=full') : '';
															$farvis_portfolio_full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full', false);
															$farvis_portfolio_full_image_link = $farvis_portfolio_full_image[0];
															?>
															<li><a href="<?php echo esc_url($farvis_portfolio_full_image_link); ?>"  rel="prettyPhoto[pp_gal_<?php echo esc_attr(get_the_id());?>]"><span class="theme-fonts-Search"></span></a></li>
															<?php
															if ( $farvis_portfolio_gallery ) :
																foreach ( $farvis_portfolio_gallery as $key => $slide ) :
																	if ( $key > 0 ) :
																	?>
																		<div class="portfolio-gallery-none">
																			<a href="<?php echo esc_url($slide['url']); ?>" rel="prettyPhoto[pp_gal_<?php echo esc_attr($post->ID); ?>]" ><img src="<?php echo esc_url($slide['url']); ?>" width="<?php echo esc_attr($slide['width']); ?>" height="<?php echo esc_attr($slide['height']); ?>" alt="<?php echo esc_attr($slide['alt']); ?>" title="<?php echo esc_attr($slide['title']); ?>"/></a>
																		</div>
																	<?php
																	endif;
																endforeach;
															endif;
														 ?>
														<?php
														endif; ?>
														<?php
														if ( $farvis_portfolio_post_type == 'video' ) :
															$farvis_portfolio_video_href = ( class_exists( 'RW_Meta_Box' ) ) ? get_post_meta( get_the_ID(), 'portfolio_video_href', true ) : '';
															if ( $farvis_portfolio_video_href != '' ) :
																$farvis_portfolio_video_width = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_width') : '';
																$farvis_portfolio_video_height = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_height') : '';
																?>
																<li><a href="<?php echo esc_url($farvis_portfolio_video_href.'?width='.esc_attr($farvis_portfolio_video_width).'&amp;height='. esc_attr($farvis_portfolio_video_height)) ?>" rel="prettyPhoto[pp_video_<?php echo esc_attr(get_the_id());?>]"><span class="theme-fonts-Media"></span></a></li>
															<?php
															endif;
														endif;
														?>
															<li><a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>"><span class="theme-fonts-Info"></span></a></li>
														<?php



														?>
													</ul>
												</div>
											</div>
											<div class="portfolio-item-footer">
												<div class="name"><?php echo wp_kses_post( get_the_title() ); ?></div>
												<div class="under-name"><?php echo wp_kses_post($farvis_portfolio_linked_list_cats); ?></div>
											</div>
										</div>
									</div>

							<?php
							endif;

						endwhile; ?>
						</div>

						<?php
						if ( get_next_posts_link( '', $wp_query->max_num_pages ) ) {

							echo '
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="portfolio-pagination">
											<span data-current="'.esc_attr($paged).'" data-max-pages="'.esc_attr($wp_query->max_num_pages).'" class="load-more">' . get_next_posts_link( wp_kses_post($farvis_portfolio_loadmore), $wp_query->max_num_pages) . '</span>
										</div>
										<div class="portfolio-pagination-loading">
											<a href="javascript: void(0)" class="btn btn-default">'. esc_html__("Loading...", "farvis") .'</a>
										</div>
									</div>
								</div>
							';
						}
						?>

					<?php
					endif;
				?>
				</div>

			</div>

			<?php farvis_show_sidebar( 'right', $farvis_layout, $farvis_sidebar ); ?>

		</div>
	</div>
</section>

<?php get_footer(); ?>