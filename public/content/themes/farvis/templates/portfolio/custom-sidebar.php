<?php
/*** Single Portfolio Custom-sidebar template. */

?>


<div class="portfolio-custom-sidebar">
		<div class="row" data-sticky_parent>
			<div class="col-md-8" data-sticky_column>
			<div class="portfolio-custom-content">
				<?php the_content(); ?>
			</div>
		</div>
		<div class="col-md-4 sticky-bar" data-sticky_column>
			<div class="work-body">
				<div class="row">
					<div class="col-md-12 col-sm-12 work-body-info" >
						<div class="work-name">
							<?php the_title( '<h3>', '</h3>' ); ?>
						</div>
						<div class="rtd"><?php echo wp_kses_post($farvis_portfolio_desc); ?></div>
						<?php if ( $farvis_portfolio_button_link != '') : ?>
							<a href="<?php echo esc_url($farvis_portfolio_button_link); ?>" class="btn btn-default" target="_blank"><?php esc_attr_e( 'View project', 'farvis' ); ?></a>
						<?php endif; ?>
						<div class="summary-list">
							<?php if ( $farvis_portfolio_create != '') : ?>
							<div class="col-md-12 clearfix">
								<div class="type-info pull-left">
									<i class="theme-fonts-User"></i>
									<?php esc_attr_e( 'Created by', 'farvis' ); ?>
								</div>
								<div class="info pull-right text-right">
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
								<div class=" pull-right text-right">
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
								<div class=" pull-right text-right">
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
								<div class=" pull-right text-right">
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
	</div>
</div>