<?php
/**
 * BuddyPress - Groups Cover Image Header.
 *
 * @since 3.0.0
 * @version 3.2.0
 */
?>

<div id="cover-image-container">

	<div id="header-cover-image"></div>

	<div id="item-header-cover-image">
		<div class="row">

			<div class="col-lg-3">
				<?php if ( ! bp_disable_group_avatar_uploads() ) : ?>
					<div id="item-header-avatar">
						<a href="<?php echo esc_url( bp_get_group_permalink() ); ?>" title="<?php echo esc_attr( bp_get_group_name() ); ?>">

							<?php bp_group_avatar(); ?>

						</a>
						<h3 class="profile-name"><?php bp_group_name(); ?></h3>
					</div><!-- #item-header-avatar -->
				<?php endif; ?>
			</div>

			<div class="col-lg-9">
	<?php if ( ! bp_nouveau_groups_front_page_description() ) : ?>
				<div id="item-header-content">

					<p class="highlight group-status"><strong><?php echo esc_html( bp_nouveau_group_meta()->status ); ?></strong></p>
					<p class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_group_last_active( 0, array( 'relative' => false ) ) ); ?>">
						<?php
						/* translators: %s = last activity timestamp (e.g. "active 1 hour ago") */
						echo wp_kses_post( sprintf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ) );
						?>
					</p>

					<?php echo bp_nouveau_group_meta()->group_type_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php bp_nouveau_group_hook( 'before', 'header_meta' ); ?>

					<?php if ( bp_nouveau_group_has_meta_extra() ) : ?>
						<div class="item-meta">

							<?php echo bp_nouveau_group_meta()->extra; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

						</div><!-- .item-meta -->
					<?php endif; ?>

					<?php bp_nouveau_group_header_buttons(); ?>

				</div><!-- #item-header-content -->
	<?php endif; ?>
			</div>

		</div>

		<?php bp_get_template_part( 'groups/single/parts/header-item-actions' ); ?>

	</div><!-- #item-header-cover-image -->


</div><!-- #cover-image-container -->
