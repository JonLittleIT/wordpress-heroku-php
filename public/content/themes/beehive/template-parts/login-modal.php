<?php
/**
 * Login modal
 *
 * @package WordPress
 * @subpackage beehive
 * @since 1.0.0
 */

/** Do not allow directly accessing this file. */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' ); } ?>

<div class="modal fade login-modal" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="inner">
					<img src="<?php echo esc_url( BEEHIVE_URI . '/assets/images/avatar.png' ); ?>" alt="<?php esc_attr_e( 'Guest', 'beehive' ); ?>" class="avatar guest-avatar">
				</div>
			</div>
			<div class="modal-body">
				<h4 class="modal-title"><?php esc_html_e( 'Log into your account', 'beehive' ); ?></h4>
				<form action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post" id="modal-login-form" class="beehive-login-form modal-login-form" name="modal-login-form">
					<div class="form-group">
						<div class="user-name">
							<label class="screen-reader-text"><?php esc_html_e( 'Email/username', 'beehive' ); ?></label>
							<span class="icon"><i class="uil-user"></i></span>
							<input type="text" id="modal-username" class="username-control" required name="log" value="" placeholder="<?php esc_attr_e( 'Email or username', 'beehive' ); ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="pass">
							<label class="screen-reader-text"><?php esc_html_e( 'Password', 'beehive' ); ?></label>
							<span class="icon"><i class="uil-key-skeleton-alt"></i></span>
							<input type="password" id="modal-password" class="password-control" required name="pwd" value="" placeholder="<?php esc_attr_e( 'Password', 'beehive' ); ?>">
						</div>
					</div>
					<?php do_action( 'login_form' ); ?>
					<div class="modal-options">
						<div class="row">
							<div class="col-6">
								<div class="forgetmenot">
									<label for="modal-rememberme">
										<input id="modal-rememberme" name="rememberme" type="checkbox" value="forever" /> <?php esc_html_e( 'Remember Me', 'beehive' ); ?>
									</label>
								</div>
							</div>
							<div class="col-6">
								<div class="forgot-password">
									<a href="<?php echo esc_url( wp_lostpassword_url( get_permalink() ) ); ?>">
										<?php esc_html_e( 'Lost Password?', 'beehive' ); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php if ( beehive()->options->get( 'key=ajax-login' ) ) : ?>
						<div class="beehive-login-result"></div>
					<?php endif; ?>
					<div class="submit">
						<button type="submit" id="modal_login_submit" class="submit-login" name="wp-submit"><?php esc_html_e( 'Log Into Your Account', 'beehive' ); ?></button>
					</div>
					<?php wp_nonce_field( 'beehive-modal-ajax-login-nonce', 'modal-login-security' ); ?>
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
			</div>
		</div>
	</div>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<i class="icon ion-close-round"></i>
	</button>
</div>
