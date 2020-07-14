<?php
/**
 * BuddyPress Single Groups item Navigation
 *
 * @since 3.0.0
 * @version 3.0.0
 */
?>

<nav class="<?php bp_nouveau_single_item_nav_classes(); ?>" id="object-nav" role="navigation" aria-label="<?php esc_attr_e( 'Group menu', 'buddypress' ); ?>">

<?php if ( ! beehive_is_bp_profile_vartical_nav() ) : ?>
	<div class="row">
		<div class="col-lg-6 ml-auto mr-auto">
			<div class="nav-container">
<?php endif; ?>

			<?php if ( bp_nouveau_has_nav( array( 'object' => 'groups' ) ) ) : ?>

				<ul class="profile-nav">

					<?php
					while ( bp_nouveau_nav_items() ) :
						bp_nouveau_nav_item();
						?>

						<li id="<?php bp_nouveau_nav_id(); ?>" class="<?php bp_nouveau_nav_classes(); ?>">
							<a href="<?php bp_nouveau_nav_link(); ?>" id="<?php bp_nouveau_nav_link_id(); ?>" title="<?php bp_nouveau_nav_link_text(); ?>">
								<span class="nav-link-text"><?php bp_nouveau_nav_link_text(); ?></span>

								<?php if ( bp_nouveau_nav_has_count() ) : ?>
									<span class="count color-primary"><?php bp_nouveau_nav_count(); ?></span>
								<?php endif; ?>
							</a>
						</li>

					<?php endwhile; ?>

					<?php bp_nouveau_group_hook( '', 'options_nav' ); ?>

				</ul>

			<?php endif; ?>

<?php if ( ! beehive_is_bp_profile_vartical_nav() ) : ?>		
			</div>
		</div>
	</div>
<?php endif; ?>

</nav>
