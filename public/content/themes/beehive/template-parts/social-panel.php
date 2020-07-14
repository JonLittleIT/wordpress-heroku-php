<?php
/**
 * Social Layout Left Menu Panel
 *
 * It's displayed in social layout template
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div id="beehive-social-panel" class="beehive-social-panel">
	<div class="inner-panel ass-scrollbar">
		<div class="panel-block dark">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="panel-logo item">
				<img src="<?php echo esc_url( beehive_get_logo_url() ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
			</a>
			<div class="my-card item">
				<?php if ( ! is_user_logged_in() ) : ?>
					<h4 class="form-title"><?php esc_html_e( 'Login Now', 'beehive' ); ?></h4>
					<form action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post" id="panel-login-form" class="beehive-login-form panel-login" name="panel-login">
						<div class="form-group">
							<div class="user-name">
								<label class="screen-reader-text"><?php esc_html_e( 'Email/username', 'beehive' ); ?></label>
								<span class="icon"><i class="uil-user"></i></span>
								<input type="text" id="username" class="username-control" required name="log" value="" placeholder="<?php esc_attr_e( 'Email or username', 'beehive' ); ?>">
							</div>
						</div>
						<div class="form-group">
							<div class="pass">
								<label class="screen-reader-text"><?php esc_html_e( 'Password', 'beehive' ); ?></label>
								<span class="icon"><i class="uil-key-skeleton-alt"></i></span>
								<input type="password" id="password" class="password-control" required name="pwd" value="" placeholder="<?php esc_attr_e( 'Password', 'beehive' ); ?>">
							</div>
						</div>
						<?php do_action( 'login_form' ); ?>
						<?php if ( beehive()->options->get( 'key=ajax-login' ) ) : ?>
							<div class="beehive-login-result"></div>
						<?php endif; ?>
						<div class="submit">
							<button type="submit" id="login_submit" class="submit-login" name="wp-submit"><?php esc_html_e( 'Log In', 'beehive' ); ?></button>
						</div>
						<?php wp_nonce_field( 'beehive-panel-ajax-login-nonce', 'panel-login-security' ); ?>
						<?php if ( get_option( 'users_can_register' ) ) : ?> 
							<div class="register-link">
								<a href="<?php echo esc_url( wp_registration_url() ); ?>" class="register color-primary" target="_blank" ><?php esc_html_e( 'Create an account', 'beehive' ); ?></a>
							</div>
						<?php else : ?>
							<div class="register-link">
								<p class="color-primary"><?php esc_html_e( 'Signup is disabled', 'beehive' ); ?></p>
							</div>
						<?php endif; ?>
					</form>
					<?php do_action( 'beehive_after_login_form' ); ?>
				<?php else : ?>
					<div class="info">
						<?php if ( function_exists( 'bp_is_active' ) ) : ?>
							<a href="<?php echo esc_url( bp_loggedin_user_domain() ); ?>" class="profile-avatar">
								<img src="<?php echo esc_url( get_avatar_url( get_current_user_id() ) ); ?>" alt="<?php echo esc_attr( beehive_get_current_user_display_name() ); ?>" class="avatar" />
							</a>
						<?php else : ?>
							<div class="profile-avatar">
								<img src="<?php echo esc_url( get_avatar_url( get_current_user_id() ) ); ?>" alt="<?php echo esc_attr( beehive_get_current_user_display_name() ); ?>" class="avatar" />
							</div>
						<?php endif; ?>
						<div class="profile-name">
							<?php if ( function_exists( 'bp_is_active' ) ) : ?>
								<a href="<?php echo esc_url( bp_loggedin_user_domain() ); ?>" class="name ellipsis"><?php echo esc_html( beehive_get_current_user_display_name() ); ?></a>
							<?php else : ?>
								<div class="name ellipsis h5"><strong><?php echo esc_html( beehive_get_current_user_display_name() ); ?></strong></div>
							<?php endif; ?>
							<?php if ( current_user_can( 'manage_options' ) ) : ?>
								<small><?php esc_html_e( 'Administrator', 'beehive' ); ?></small>
							<?php else : ?>
								<small><?php esc_html_e( 'Member', 'beehive' ); ?></small>
							<?php endif; ?>							
						</div>
					</div>
					<?php if ( function_exists( 'bp_is_active' ) ) : ?>
						<?php if ( bp_is_active( 'friends' ) || bp_is_active( 'groups' ) ) : ?>
							<ul class="connections">
								<?php if ( bp_is_active( 'friends' ) ) : ?>
									<li><span class="count"><?php bp_total_friend_count( bp_loggedin_user_id() ); ?></span><p class="mute"><?php esc_html_e( 'Friends', 'beehive' ); ?></p></li>
								<?php endif; ?>
								<?php if ( bp_is_active( 'groups' ) ) : ?>
									<li><span class="count"><?php bp_total_group_count_for_user( bp_loggedin_user_id() ); ?></span><p class="mute"><?php esc_html_e( 'Groups', 'beehive' ); ?></p></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="panel-block light">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'panel-menu',
					'depth'           => 1,
					'container_class' => 'panel-menu item',
					'menu_class'      => 'navbar-panel',
					'fallback_cb'     => 'Beehive_Navwalker::fallback',
				)
			);
			?>
		</div>
	</div>
</div>
