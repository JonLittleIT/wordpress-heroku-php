<?php
/**
 * BuddyPress - Members Home
 *
 * @since   1.0.0
 * @version 3.0.0
 */
?>

	<?php bp_nouveau_member_hook( 'before', 'home_content' ); ?>

	<div id="item-header" role="complementary" data-bp-item-id="<?php echo esc_attr( bp_displayed_user_id() ); ?>" data-bp-item-component="members" class="users-header single-headers">

		<?php bp_nouveau_member_header_template_part(); ?>

	</div><!-- #item-header -->

	<div class="bp-wrap">
		<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>

			<?php bp_get_template_part( 'members/single/parts/item-nav' ); ?>

		<?php endif; ?>

		<div id="item-body" class="item-body">

		<?php if ( ! beehive_is_bp_profile_vartical_nav() ) : ?>
			<div class="row">
		<?php endif; ?>

			<?php if ( in_array( beehive()->layout->get(), array( 'social-collapsed', 'full' ), true ) && ! beehive_is_bp_profile_vartical_nav() ) : ?>
				<div class="col-lg-3 profile-col-aside left">
					<aside class="widget-area profile-widget-area displayed-profile-info">
						<?php if ( bp_is_active( 'friends' ) || bp_is_active( 'groups' ) ) : ?>
							<div class="widget">
								<ul class="connections">
									<?php if ( bp_is_active( 'friends' ) ) : ?>
										<li><span class="count color-primary"><?php bp_total_friend_count( bp_get_member_user_id() ); ?></span><p><?php esc_html_e( 'Friends', 'beehive' ); ?></p></li>
									<?php endif; ?>
									<?php if ( bp_is_active( 'groups' ) ) : ?>
										<li><span class="count color-primary"><?php bp_total_group_count_for_user( bp_get_member_user_id() ); ?></span><p><?php esc_html_e( 'Groups', 'beehive' ); ?></p></li>
									<?php endif; ?>
								</ul>
							</div>
						<?php endif; ?>
						<?php do_action( 'after_displayed_profile_info' ); ?>
					</aside>
				</div>
			<?php endif; ?>

			<?php if ( ! beehive_is_bp_profile_vartical_nav() ) : ?>
				<?php
				if ( in_array( beehive()->layout->get(), array( 'social-collapsed', 'full' ), true ) ) {
					$beehive_profile_col_width = ( is_active_sidebar( beehive()->sidebars->get_sidebar_id( 'Member Profile Sidebar' ) ) ) ? 6 : 9;
				} else {
					$beehive_profile_col_width = 12;
				}
				?>
				<div class="col-lg-<?php echo esc_attr( $beehive_profile_col_width ); ?> profile-col-main">
			<?php endif; ?>

				<?php bp_nouveau_member_template_part(); ?>

			<?php if ( ! beehive_is_bp_profile_vartical_nav() ) : ?>
				</div>
			<?php endif; ?>

			<?php if ( in_array( beehive()->layout->get(), array( 'social-collapsed', 'full' ), true ) && ! beehive_is_bp_profile_vartical_nav() && is_active_sidebar( beehive()->sidebars->get_sidebar_id( 'Member Profile Sidebar' ) ) ) : ?>
				<div class="col-lg-3 profile-col-aside right">
					<aside id="member_profile_sidebar" class="widget-area profile-widget-area member-profile-sidebar">
						<?php dynamic_sidebar( beehive()->sidebars->get_sidebar_id( 'Member Profile Sidebar' ) ); ?>
					</aside>
				</div>
			<?php endif; ?>

		<?php if ( ! beehive_is_bp_profile_vartical_nav() ) : ?>
			</div>
		<?php endif; ?>

		</div><!-- #item-body -->

	</div><!-- // .bp-wrap -->

	<?php bp_nouveau_member_hook( 'after', 'home_content' ); ?>
