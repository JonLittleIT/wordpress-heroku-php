<?php
/**
 * Beehive notification nav
 *
 * Displays in the social navbar
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<ul id="navbar-user" class="navbar-nav navbar-user">
	<?php if ( ! is_user_logged_in() ) : ?>
		<?php do_action( 'beehive_notification_nav' ); ?>
		<li class="nav-item">
			<a href="#" class="nav-link login" data-toggle="modal" data-target="#login-modal"><?php esc_html_e( 'Login', 'beehive' ); ?></a>
		</li>
		<?php if ( get_option( 'users_can_register' ) ) : ?> 
			<li class="nav-item">
				<a href="<?php echo esc_url( wp_registration_url() ); ?>" class="nav-link register"><?php esc_html_e( 'Register', 'beehive' ); ?></a>
			</li>
		<?php endif; ?>
	<?php else : ?>
		<?php if ( function_exists( 'bp_is_active' ) ) : ?>
			<?php if ( 'social' === beehive()->navigation->get() && bp_is_active( 'friends' ) ) : ?>
				<li id="friend-requests-list" class="nav-item dropdown friend-requests-list">
					<a class="nav-link dropdown-toggle" href="#" id="nav_friend_requests" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="uil-user-plus"></i>
						<span class="nav-item-title"><?php esc_html_e( 'Friend Requests', 'beehive' ); ?></span>
						<?php if ( bp_friend_get_total_requests_count( bp_loggedin_user_id() ) > 0 ) : ?>
							<?php if ( bp_friend_get_total_requests_count( bp_loggedin_user_id() ) > 9 ) : ?>
								<span class="count"><?php esc_html_e( '9+', 'beehive' ); ?></span>
							<?php else : ?>
								<span class="count"><?php echo esc_html( bp_friend_get_total_requests_count( bp_loggedin_user_id() ) ); ?></span>
							<?php endif; ?>
						<?php endif; ?>
					</a>
					<div class="dropdown-menu" aria-labelledby="nav_friend_requests">
						<div class="dropdown-title"><?php esc_html_e( 'Friend requests', 'beehive' ); ?></div>
						<?php if ( bp_friend_get_total_requests_count( bp_loggedin_user_id() ) > 0 ) : ?>
							<div class="dropdown-item">
								<p>
									<?php
										printf(
											// translators: number of friend requests.
											esc_html( _nx( 'You have %s friend request pending.', 'You have %s friend requests pending.', bp_friend_get_total_requests_count( bp_loggedin_user_id() ), 'Number of friend requests', 'beehive' ) ),
											number_format_i18n( bp_friend_get_total_requests_count( bp_loggedin_user_id() ) )
										);
									?>
								</p>
							</div>
						<?php else : ?>
						<div class="alert-message">
							<div class="alert alert-warning" role="alert"><?php esc_html_e( 'No friend request.', 'beehive' ); ?></div>
						</div>
						<?php endif; ?>
						<div class="dropdown-footer">
							<a href="<?php echo esc_url( trailingslashit( bp_loggedin_user_domain() . bp_get_friends_slug() . '/requests' ) ); ?>" class="button"><?php esc_html_e( 'All Requests', 'beehive' ); ?></a>
						</div>
					</div>
				</li>
			<?php endif; ?>
			<?php if ( 'social' === beehive()->navigation->get() && bp_is_active( 'notifications' ) ) : ?>
				<li id="notification-list" class="nav-item dropdown notification-list">
					<a class="nav-link dropdown-toggle" href="#" id="nav_notification" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="uil-bell"></i>
						<span class="nav-item-title"><?php esc_html_e( 'Notifications', 'beehive' ); ?></span>
						<?php if ( bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ) > 0 ) : ?>
							<?php if ( bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ) > 9 ) : ?>
								<span class="count"><?php esc_html_e( '9+', 'beehive' ); ?></span>
							<?php else : ?>
								<span class="count"><?php echo esc_html( bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ) ); ?></span>
							<?php endif; ?>
						<?php endif; ?>
					</a>
					<div class="dropdown-menu" aria-labelledby="nav_notification">
						<div class="dropdown-title"><?php esc_html_e( 'Notifications', 'beehive' ); ?></div>
						<?php
						if ( bp_has_notifications(
							array(
								'user_id'  => bp_loggedin_user_id(),
								'per_page' => 5,
								'max'      => 5,
							)
						) ) :
							?>
							<?php
							while ( bp_the_notifications() ) :
								bp_the_notification();
								?>
								<div class="dropdown-item">
									<div class="dropdown-item-title notification ellipsis"><?php bp_the_notification_description(); ?></div>
									<p class="mute"><?php bp_the_notification_time_since(); ?></p>
								</div>
							<?php endwhile; ?>
						<?php else : ?>
							<div class="alert-message">
								<div class="alert alert-warning" role="alert"><?php esc_html_e( 'No notifications found', 'beehive' ); ?></div>
							</div>
						<?php endif; ?>
						<div class="dropdown-footer">
							<a href="<?php echo esc_url( trailingslashit( bp_loggedin_user_domain() . bp_get_notifications_slug() . '/unread' ) ); ?>" class="button"><?php esc_html_e( 'All Notifications', 'beehive' ); ?></a>
						</div>
					</div>
				</li>
			<?php endif; ?>
			<?php if ( 'social' === beehive()->navigation->get() && bp_is_active( 'messages' ) ) : ?>
				<li id="private-message-list" class="nav-item dropdown private-message-list">
					<a class="nav-link dropdown-toggle" href="#" id="nav_private_messages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="uil-envelope-open"></i>
						<span class="nav-item-title"><?php esc_html_e( 'Messages', 'beehive' ); ?></span>
						<?php if ( messages_get_unread_count( bp_loggedin_user_id() ) > 0 ) : ?>
							<?php if ( messages_get_unread_count( bp_loggedin_user_id() ) > 9 ) : ?>
								<span class="count"><?php esc_html_e( '9+', 'beehive' ); ?></span>
							<?php else : ?>
								<span class="count"><?php echo esc_html( messages_get_unread_count() ); ?></span>
							<?php endif; ?>
						<?php endif; ?>
					</a>
					<div class="dropdown-menu" aria-labelledby="nav_private_messages">
						<div class="dropdown-title"><?php esc_html_e( 'Unread messages', 'beehive' ); ?></div>
						<?php
						if ( bp_has_message_threads(
							array(
								'user_id'  => bp_loggedin_user_id(),
								'type'     => 'unread',
								'per_page' => 5,
								'max'      => 5,
							)
						) ) :
							?>
							<?php
							while ( bp_message_threads() ) :
								bp_message_thread();
								?>
								<div class="dropdown-item">
									<div class="item-avatar">
															<?php bp_message_thread_avatar( 'type=thumb&width=30&height=30' ); ?>
									</div>
									<div class="item-info">
										<div class="dropdown-item-title message-subject ellipsis">
											<a href="<?php bp_message_thread_view_link( bp_get_message_thread_id(), bp_loggedin_user_id() ); ?>" class="color-primary"><?php bp_message_thread_subject(); ?></a>
										</div>
										<p class="mute"><?php bp_message_thread_last_post_date(); ?></p>
									</div>
								</div>
							<?php endwhile; ?>
						<?php else : ?>
							<div class="alert-message">
								<div class="alert alert-warning" role="alert"><?php esc_html_e( 'No messages to read.', 'beehive' ); ?></div>
							</div>
						<?php endif; ?>
						<div class="dropdown-footer">
							<a href="<?php echo esc_url( trailingslashit( bp_loggedin_user_domain() . bp_get_messages_slug() . '/inbox' ) ); ?>" class="button"><?php esc_html_e( 'All Messages', 'beehive' ); ?></a>
						</div>
					</div>
				</li>
			<?php endif; ?>
		<?php endif; ?>
		<?php do_action( 'beehive_notification_nav' ); ?>
		<li id="myaccount-url-list" class="nav-item dropdown myaccount-url-list">
			<a class="nav-link dropdown-toggle" href="#" id="nav_my_account" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo get_avatar( get_current_user_id(), 30 ); ?>
				<span class="account-name">@ <?php echo esc_html( bp_core_get_username( get_current_user_id() ) ); ?></span>
			</a>
			<div class="dropdown-menu" aria-labelledby="nav_my_account">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'myaccount_menu',
							'depth'          => 1,
							'container'      => '',
							'menu_class'     => 'member-account-menu',
							'fallback_cb'    => 'Beehive_Navwalker::fallback',
						)
					);
				?>
			</div>
		</li>
	<?php endif; ?>
</ul>
