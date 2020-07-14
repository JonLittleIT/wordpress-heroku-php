<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly

function woohoo_login_form( $login_only  = 0 )
{
    global $user_ID, $user_identity;

    echo '<div class="post-warpper">'. "\n";
    if ( $user_ID ) : ?>

        <?php if( empty( $login_only ) ): ?>
            <div class="login_user">
            <div class="bio-author-desc">
                <?php woohoo_tr( 'Welcome' ); ?>
                <?php echo esc_attr($user_identity); ?>
            </div>
            <div class="avatar">
                <?php
                // Avatar
                echo get_avatar( $user_ID, $size = '79'); ?>
            </div>
            <div class="post-caption">
                <ul class="login_list">
                    <li class="userWpAdmin">
                        <a href="<?php echo esc_url(home_url()); ?>/wp-admin/"><?php woohoo_tr( 'Dashboard' ) ?></a>
                    </li>
                    <li class="userprofile">
                        <a href="<?php echo esc_url(home_url()); ?>/wp-admin/profile.php"><?php woohoo_tr( 'Your Profile' ) ?></a>
                    </li>
                    <li class="userlogout">
                        <a href="<?php echo esc_url(wp_logout_url()); ?>"><?php woohoo_tr( 'Logout' ) ?></a>
                    </li>
                </ul>
            </div>
            <div class="cfix"></div>

	            <div class="authorBlock-meta bdaia-social-io-colored">
		            <div class="bdaia-social-io bdaia-social-io-size-32">
			            <?php if ( get_the_author_meta( 'url', $user_ID ) ) : ?>
				            <a class="bdaia-io-url-home" href="<?php echo esc_url( get_the_author_meta ( 'url', $user_ID ) ); ?>"><span class="bdaia-io bdaia-io-home3"></span></a>
			            <?php endif ?>

			            <?php if ( get_the_author_meta( 'twitter', $user_ID ) ) : ?>
				            <a class="bdaia-io-url-twitter" href="http://www.twitter.com/<?php echo esc_url( get_the_author_meta ( 'twitter', $user_ID ) ); ?>"><span class="bdaia-io bdaia-io-twitter"></span></a>
			            <?php endif ?>

			            <?php if ( get_the_author_meta( 'facebook', $user_ID ) ) : ?>
				            <a class="bdaia-io-url-facebook" href="<?php echo esc_url( get_the_author_meta ( 'facebook', $user_ID ) ); ?>"><span class="bdaia-io bdaia-io-facebook"></span></a>
			            <?php endif ?>

			            <?php if ( get_the_author_meta( 'instagram', $user_ID ) ) : ?>
				            <a class="bdaia-io-url-instagram" href="<?php echo esc_url( get_the_author_meta ( 'instagram', $user_ID ) ); ?>"><span class="bdaia-io bdaia-io-instagram"></span></a>
			            <?php endif ?>

			            <?php if ( get_the_author_meta( 'google', $user_ID ) ) : ?>
				            <a class="bdaia-io-url-google-plus" href="https://plus.google.com/<?php echo esc_url( get_the_author_meta ( 'google', $user_ID ) ); ?>?rel=author"><span class="bdaia-io bdaia-io-google-plus"></span></a>
			            <?php endif ?>

			            <?php if ( get_the_author_meta( 'youtube', $user_ID ) ) : ?>
				            <a class="bdaia-io-url-youtube" href="<?php echo esc_url( get_the_author_meta ( 'youtube', $user_ID ) ); ?>"><span class="bdaia-io bdaia-io-youtube"></span></a>
			            <?php endif ?>

			            <?php if ( get_the_author_meta( 'linkedin', $user_ID ) ) : ?>
				            <a class="bdaia-io-url-linkedin" href="<?php echo esc_url( get_the_author_meta ( 'linkedin', $user_ID ) ); ?>"><span class="bdaia-io bdaia-io-linkedin2"></span></a>
			            <?php endif ?>

			            <?php if ( get_the_author_meta( 'pinterest', $user_ID ) ) : ?>
				            <a class="bdaia-io-url-pinterest" href="<?php echo esc_url( get_the_author_meta ( 'pinterest', $user_ID ) ); ?>"><span class="bdaia-io bdaia-io-social-pinterest"></span></a>
			            <?php endif ?>

			            <?php if ( get_the_author_meta( 'flickr', $user_ID ) ) : ?>
				            <a class="bdaia-io-url-flickr" href="<?php echo esc_url( get_the_author_meta( 'flickr' , $user_ID ) ); ?>"><span class="bdaia-io bdaia-io-flickr2"></span></a>
			            <?php endif ?>

			            <?php if ( get_the_author_meta( 'dribbble', $user_ID ) ) : ?>
				            <a class="bdaia-io-url-dribbble" href="<?php echo esc_url( get_the_author_meta ( 'dribbble', $user_ID ) ); ?>"><span class="bdaia-io bdaia-io-dribbble"></span></a>
			            <?php endif ?>
		            </div>
	            </div>

        </div>
    <?php endif; ?>
    <?php else: ?>
        <div class="login_form">
            <form action="<?php echo esc_url(home_url()); ?>/wp-login.php" method="post">
                <input type="text" name="log" id="log" size="30" placeholder="User Name"  value="<?php woohoo_tr( 'Username'  ) ?>"  />
                <input type="password" name="pwd" size="30" placeholder="Password" value="<?php woohoo_tr( 'Password' ) ?>" />
                <div class="remember">
                    <input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" />
                    <?php woohoo_tr( 'Remember Me' ) ?>
                    <button value="<?php woohoo_tr( 'Login' ) ?>" name="Submit" type="submit" class="btn"><?php woohoo_tr( 'Login' ) ?></button>
                </div>
                <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
                <ul class="login_list">
                    <li>
                        <a href="<?php echo esc_url(home_url()); ?>/wp-login.php?action=lostpassword">
                            <?php woohoo_tr( 'Forgot your password?' ) ?>
                        </a>
                    </li>
                </ul>

            </form>
        </div>
    <?php
    endif;
    echo "\n" .'</div>'. "\n";
}