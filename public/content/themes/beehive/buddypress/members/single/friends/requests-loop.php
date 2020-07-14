<?php
/**
 * BuddyPress - Members Friends Requests Loop
 *
 * @since 5.0.0
 * @version 5.0.0
 */
?>

<?php if ( bp_has_members( bp_ajax_querystring( 'friendship_requests' ) . '&include=' . bp_get_friendship_requests() ) ) : ?>

	<ul id="friend-list" class="<?php bp_nouveau_loop_classes(); ?>">
		<?php
		while ( bp_members() ) :
			bp_the_member();
			?>

			<li id="friendship-<?php bp_friend_friendship_id(); ?>" <?php bp_member_class( array( 'item-entry', 'animate-item', 'slideInUp' ) ); ?> data-bp-item-id="<?php bp_friend_friendship_id(); ?>" data-bp-item-component="members">
				<div class="item-avatar">
					<a href="<?php bp_member_link(); ?>"><?php bp_member_avatar( array( 'type' => 'full' ) ); ?></a>
				</div>

				<div class="item">
					<h5 class="list-title"><a href="<?php bp_member_link(); ?>"><?php bp_member_name(); ?></a></h5>
					<div class="meta item-meta mute"><span class="activity"><?php bp_member_last_active(); ?></span></div>

					<?php bp_nouveau_friend_hook( 'requests_item' ); ?>
				</div>

				<?php bp_nouveau_members_loop_buttons(); ?>
			</li>

		<?php endwhile; ?>
	</ul>

	<?php bp_nouveau_friend_hook( 'requests_content' ); ?>

	<?php bp_nouveau_pagination( 'bottom' ); ?>

<?php else : ?>

	<?php bp_nouveau_user_feedback( 'member-requests-none' ); ?>

<?php endif; ?>
