<?php
/*** Single Portfolio Centered template. */

?>

<div class="portfolio-centerd">
	<div class="work-image">
		<div class="image">
			<?php
			if ( $farvis_portfolio_post_type == 'image' ) : ?>
					<div class="single-portfolio-carousel owl-carousel enable-owl-carousel owl-theme" data-auto-play="4000" data-single-item="true"  data-items="1" data-responsive-items="1" data-pagination="true">
						<div class="item">
							<a href="<?php echo esc_url($farvis_portfolio_link); ?>" class="fancybox" rel="gallery[pp_gal_001]">
								<?php the_post_thumbnail( $post->ID, 'full', array('class' => 'img-responsive') ); ?>
							</a>
						</div>
						<?php
							if ( $farvis_portfolio_gallery ) {
								foreach ( $farvis_portfolio_gallery as $key => $slide ) {
										if ( $key > 0 ) :
								?>
								<div class="item">
									<a href="<?php echo esc_url($slide['url']); ?>" class="fancybox" rel="gallery[pp_gal_001]">
										<img src="<?php echo esc_url($slide['url']); ?>" width="<?php echo esc_attr($slide['width']); ?>" height="<?php echo esc_attr($slide['height']); ?>" alt="<?php echo esc_attr($slide['alt']); ?>" title="<?php echo esc_attr($slide['title']); ?>"/>
									</a>
								</div>
								<?php 	endif;
								}
							}

						 ?>
				</div>
				<?php
				if ( $farvis_portfolio_gallery ) :
					foreach ( $farvis_portfolio_gallery as $key => $slide ) :
						if ( $key > 0 ) :
						?>
							<div class="portfolio-gallery-none">
								<a href="<?php echo esc_url($slide['url']); ?>" class="fancybox" rel="gallery[pp_gal_001]" ><img src="<?php echo esc_url($slide['url']); ?>" width="<?php echo esc_attr($slide['width']); ?>" height="<?php echo esc_attr($slide['height']); ?>" alt="<?php echo esc_attr($slide['alt']); ?>" title="<?php echo esc_attr($slide['title']); ?>"/></a>
							</div>
						<?php
						endif;
					endforeach;
				endif;
				?>
			<?php
			endif; ?>

			<?php
			if ( $farvis_portfolio_post_type == 'video' ) : ?>
				<div class="item">
					<?php the_post_thumbnail( $post->ID, 'full', array('class' => 'img-responsive') ); ?>
				</div>
				<?php
				$farvis_portfolio_video_href = ( class_exists( 'RW_Meta_Box' ) ) ? get_post_meta( get_the_ID(), 'portfolio_video_href', true ) : '';
				if ( $farvis_portfolio_video_href != '' ) :
					$farvis_portfolio_video_width = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_width') : '';
					$farvis_portfolio_video_height = ( class_exists( 'RW_Meta_Box' ) ) ? rwmb_meta('portfolio_video_height') : '';
					?>
					<div class="controls">
						<div class="big-view"><a href="<?php echo esc_url($farvis_portfolio_video_href.'?width='.esc_attr($farvis_portfolio_video_width).'&amp;height='. esc_attr($farvis_portfolio_video_height)) ?>" class="fancybox" data-rel="gallery[pp_video_<?php echo esc_attr($post->ID); ?>]"  ><span class="theme-fonts-Media"></span></a></div>
					</div>
				<?php
				endif;
				?>

			<?php
			endif;?>
		</div>
	</div>
	<div class="work-body">
		<div class="row">
			<div class="col-md-8 col-sm-7">
				<div class="work-name">
					<?php the_title( '<h3>', '</h3>' ); ?>
				</div>
				<div class="rtd"><?php the_content(); ?></div>
				<?php if ( $farvis_portfolio_button_link != '') : ?>
					<a href="<?php echo esc_url($farvis_portfolio_button_link); ?>" class="btn btn-default" target="_blank"><?php esc_attr_e( 'View project', 'farvis' ); ?></a>
				<?php endif; ?>
			</div>
			<div class="col-md-4 col-sm-5 work-body-info">
				<div class="summary-list">
					<?php if ( $farvis_portfolio_create != '') : ?>
					<div class="col-md-12 clearfix">
						<div class="type-info pull-left">
							<i class="theme-fonts-User"></i>
							<?php esc_attr_e( 'Created by', 'farvis' ); ?>
						</div>
						<div class="pull-right text-right">
							<p class="no-margin"><?php echo wp_kses_post($farvis_portfolio_create); ?></p>
						</div>
					</div>
					<?php endif; ?>
					<?php if ( $farvis_portfolio_complete != '') : ?>
					<div class="col-md-12 clearfix">
						<div class="type-info pull-left">
							<i class="theme-fonts-Agenda"></i>
							<?php esc_attr_e( 'Completed on', 'farvis' ); ?>
						</div>
						<div class="pull-right text-right">
							<p class="no-margin"><?php echo wp_kses_post($farvis_portfolio_complete); ?></p>
						</div>
					</div>
					<?php endif; ?>
					<?php if ( $farvis_portfolio_skills != '') : ?>
					<div class="col-md-12 clearfix">
						<div class="type-info pull-left">
							<i class="theme-fonts-Layers"></i>
							<?php esc_attr_e( 'Skills', 'farvis' ); ?>
						</div>
						<div class="info pull-right text-right">
							<p class="no-margin"><?php echo wp_kses_post($farvis_portfolio_skills); ?></p>
						</div>
					</div>
					<?php endif; ?>
					<?php if ( $farvis_portfolio_client != '') : ?>
					<div class="col-md-12 clearfix">
						<div class="type-info pull-left">
							<i class="theme-fonts-DesktopMonitor"></i>
							<?php esc_attr_e( 'Client', 'farvis' ); ?>
						</div>
						<div class="info pull-right text-right">
							<p class="no-margin">
								<?php if ( $farvis_portfolio_client_link != '') : ?>
									<a href="<?php echo esc_url($farvis_portfolio_client_link); ?>" target="_blank">
									<?php echo wp_kses_post($farvis_portfolio_client); ?>
									</a>
								<?php else : ?>
									<?php echo wp_kses_post($farvis_portfolio_client); ?>
								<?php endif; ?>
							</p>
						</div>
					</div>
					<?php endif; ?>

					<?php if ( shortcode_exists( 'share' ) && farvis_get_option( 'portfolio_settings_share', 'on' ) == 'on' ) : ?>
					<div class="col-md-12 clearfix">
						<div class="type-info pull-left">
							<i class="theme-fonts-Antenna1"></i>
							<?php esc_attr_e( 'Share', 'farvis' ); ?>
						</div>
						<div class=" pull-right text-right">
							<?php echo pix_display_format('[share post_type="portfolio"]'); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
