<?php
/**
 * BuddyPress - Groups Home
 *
 * @since 3.0.0
 * @version 3.0.0
 */

if ( bp_has_groups() ) :
	while ( bp_groups() ) :
		bp_the_group();
		?>

		<?php bp_nouveau_group_hook( 'before', 'home_content' ); ?>

		<div id="item-header" role="complementary" data-bp-item-id="<?php bp_group_id(); ?>" data-bp-item-component="groups" class="groups-header single-headers">

			<?php bp_nouveau_group_header_template_part(); ?>

		</div><!-- #item-header -->

		<div class="bp-wrap">

			<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

				<?php bp_get_template_part( 'groups/single/parts/item-nav' ); ?>

			<?php endif; ?>

			<div id="item-body" class="item-body">

			<?php if ( ! beehive_is_bp_profile_vartical_nav() ) : ?>
				<div class="row">
			<?php endif; ?>

				<?php if ( in_array( beehive()->layout->get(), array( 'social-collapsed', 'full' ), true ) && ! beehive_is_bp_profile_vartical_nav() ) : ?>
					<div class="col-lg-3 profile-col-aside left">
						<aside class="widget-area profile-widget-area displayed-profile-info">
							<div class="widget">
								<?php if ( ! bp_nouveau_groups_front_page_description() && bp_nouveau_group_has_meta( 'description' ) ) : ?>
									<div class="widget-block about">
										<h5 class="widget-title"><?php esc_attr_e( 'About Group', 'beehive' ); ?></h5>
										<div class="about-group"><?php bp_group_description(); ?></div>
									</div>
								<?php endif; ?>
								<div class="widget-block group-members">
									<h5 class="widget-title"><?php esc_attr_e( 'Newest Members', 'beehive' ); ?></h5>
									<?php
									if ( bp_group_has_members(
										array(
											'group_id' => bp_get_group_id(),
											'max'      => 7,
											'exclude_admins_mods' => false,
										)
									) ) :
										?>
										<div class="newest-group-members">
											<ul>
												<?php
												while ( bp_group_members() ) :
													bp_group_the_member();
													?>
													<li><a href="<?php bp_group_member_domain(); ?>" title="<?php bp_group_member_name(); ?>" target="_blank"><?php bp_group_member_avatar( 'type=thumb&width=30&height=30' ); ?></a></li>
												<?php endwhile; ?>
											</ul>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</aside>
					</div>
				<?php endif; ?>

				<?php if ( ! beehive_is_bp_profile_vartical_nav() ) : ?>
					<?php
					if ( in_array( beehive()->layout->get(), array( 'social-collapsed', 'full' ), true ) ) {
						$beehive_profile_col_width = ( is_active_sidebar( beehive()->sidebars->get_sidebar_id( 'Group Profile Sidebar' ) ) ) ? 6 : 9;
					} else {
						$beehive_profile_col_width = 12;
					}
					?>
					<div class="col-lg-<?php echo esc_attr( $beehive_profile_col_width ); ?> profile-col-main">
				<?php endif; ?>

					<?php if ( beehive_is_bp_profile_vartical_nav() && ( ! bp_nouveau_groups_front_page_description() && bp_nouveau_group_has_meta( 'description' ) ) ) : ?>
						<div class="desc-wrap group-desc">
							<div class="group-description">
								<?php bp_group_description(); ?>
							</div>
						</div>
					<?php endif; ?>

					<?php bp_nouveau_group_template_part(); ?>

				<?php if ( ! beehive_is_bp_profile_vartical_nav() ) : ?>
					</div>
				<?php endif; ?>

				<?php if ( in_array( beehive()->layout->get(), array( 'social-collapsed', 'full' ), true ) && ! beehive_is_bp_profile_vartical_nav() && is_active_sidebar( beehive()->sidebars->get_sidebar_id( 'Group Profile Sidebar' ) ) ) : ?>
					<div class="col-lg-3 profile-col-aside right">
						<aside id="member_profile_sidebar" class="widget-area profile-widget-area member-profile-sidebar">
							<?php dynamic_sidebar( beehive()->sidebars->get_sidebar_id( 'Group Profile Sidebar' ) ); ?>
						</aside>
					</div>
				<?php endif; ?>

			<?php if ( ! beehive_is_bp_profile_vartical_nav() ) : ?>
				</div>
			<?php endif; ?>

			</div><!-- #item-body -->

		</div><!-- // .bp-wrap -->

		<?php bp_nouveau_group_hook( 'after', 'home_content' ); ?>

	<?php endwhile; ?>

	<?php
endif;
