<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

/**
 * New User registration
 */
add_action('wp_ajax_register_user', 'vb_reg_new_user');
add_action('wp_ajax_nopriv_register_user', 'vb_reg_new_user');
function vb_reg_new_user()
{
	if( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vb_new_user' ) ) {
		die( 'Ooops, something went wrong, please try again later.' );
	}

	$username   =   sanitize_user( $_POST['user_login'] );
	$password   =   esc_attr( $_POST['user_pass'] );
	$email      =   sanitize_email( $_POST['user_email'] );
	$first_name =   sanitize_text_field( $_POST['first_name'] );
	$nickname   =   sanitize_text_field( $_POST['nickname'] );

	$userdata = array(
		'user_login' => $username,
		'user_pass'  => $password,
		'user_email' => $email,
		'first_name' => $first_name,
		'nickname'   => $nickname,
	);
	$user_id = wp_insert_user( $userdata );

	if( ! is_wp_error( $user_id ) ) {
		echo '1';
		echo "User created : ". $user_id;
	}
	else {
		echo $user_id->get_error_message();
	}

	die();
}

function vb_registration_form() { ?>

	<div class="vb-registration-form">
		<form class="form-horizontal registraion-form" id="registerform" role="form" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">

			<p class="form-group">
				<label for="vb_name" class="sr-only">Your Name</label>
				<input type="text" name="first_name" id="vb_name" value="" placeholder="Your Name" class="form-control" />
			</p>

			<p class="form-group">
				<label for="vb_email" class="sr-only">Your Email</label>
				<input type="email" name="user_email" id="vb_email" value="" placeholder="Your Email" class="form-control" />
			</p>

			<p class="form-group">
				<label for="vb_nick" class="sr-only">Your Nickname</label>
				<input type="text" name="nickname" id="vb_nick" value="" placeholder="Your Nickname" class="form-control" />
			</p>

			<p class="form-group">
				<label for="vb_username" class="sr-only">Choose Username</label>
				<input type="text" name="user_login" id="vb_username" value="" placeholder="Choose Username" class="form-control" />
			</p>

			<p class="form-group">
				<label for="vb_pass" class="sr-only">Choose Password</label>
				<input type="password" name="user_pass" id="vb_pass" value="" placeholder="Choose Password" class="form-control" />
			</p>

			<?php wp_nonce_field('vb_new_user','vb_new_user_nonce', true, true ); ?>

			<p class="form-submit">
				<input type="submit" class="button-primary btn btn-primary" id="btn-new-user" value="Register" />
			</p>

			<input type="hidden" name="task" value="register" />
		</form>

		<div class="alert result-message"></div>
	</div>
	<?php
}
?>
	<div id="woohoo-login-join">
		<div class="woohoo-login-join-wrapper woohoo-login-join-onlogin">
			<div class="woohoo-login-join-inner">

				<div class="woohoo-login-join-nav">
					<p class="woohoo-login-join-nav-title"><?php woohoo_tr( 'Login/Sign Up' );?></p>
					<p class="woohoo-login-join-nav-icon"><span class="bdaia-io bdaia-io-user"></span></p>
				</div>

				<div class="woohoo-login-join-contnet">
					<div class="woohoo-login-join-container" id="woohoo-login" >
						<div class="woohoo-loginform">
							<?php echo wp_login_form(); ?>
						</div>
					</div>

					<div class="woohoo-login-join-container" id="woohoo-signup">
						<div class="woohoo-registerform">
							<?php echo vb_registration_form(); ?>
						</div>
					</div>
				</div>

				<div class="woohoo-login-join-footer">
					<div class="woohoo-login-join-footer-login">
						<span><?php woohoo_tr( 'Login' ); ?></span>
					</div>

					<div class="woohoo-login-join-footer-signup">
						<span><?php woohoo_tr( 'Sign Up' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php