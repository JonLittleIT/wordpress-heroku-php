<?php 

if( !(defined('BESA_WOOCOMMERCE_ACTIVED') && BESA_WOOCOMMERCE_ACTIVED) || is_user_logged_in() ) return;

do_action( 'besa_woocommerce_before_customer_login_form' ); 
?>

<div id="custom-login-wrapper" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <button type="button" class="btn-close" data-dismiss="modal"><i class="tb-icon tb-icon-cross2"></i></button>
            <div class="modal-body">

                <ul class="nav nav-tabs">
                    <li><a data-toggle="tab" class="active" href="#tab-customlogin"><i class="tb-icon tb-icon-user d-xl-none"></i><?php esc_html_e('Login', 'besa'); ?></a></li>

                    <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
                    <li><a data-toggle="tab" href="#tab-customregister"><i class="tb-icon tb-icon-pencil4 d-xl-none"></i><?php esc_html_e('Register', 'besa'); ?></a></li>
                    <?php endif; ?>

                </ul>

                <div class="tab-content clearfix">
                    <div id="tab-customlogin" class="tab-pane fade show active">
                        <form id="custom-login" class="ajax-auth" action="login" method="post">
                            <?php do_action( 'woocommerce_login_form_start' ); ?>

                            <h3><?php esc_html_e('Enter your username and password to login.', 'besa'); ?></h3>
                            <p class="status"></p>  
                            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>  
                            <input id="cus-username" type="text" placeholder="<?php esc_attr_e('Username/ Email', 'besa'); ?>" class="required form-control" name="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>">
                            <input id="cus-password" type="password" placeholder="<?php esc_attr_e('Password', 'besa'); ?>" class="required form-control" name="password" autocomplete="current-password"> 
                            
                            <div class="rememberme-wrapper">
                                <input name="rememberme" type="checkbox" id="cus-rememberme" value="forever">
                                <label for="cus-rememberme"><?php esc_html_e('Remember me', 'besa'); ?></label>
                            </div>
                            <a id="pop_forgot" class="text-link" href="<?php
                            echo wp_lostpassword_url(); ?>"><?php esc_html_e('Lost password?', 'besa'); ?></a>
                            <input class="submit_button" type="submit" value="<?php esc_html_e('Login', 'besa') ?>">

                            <div class="clear"></div>
                            <?php do_action( 'woocommerce_login_form_end' ); ?>
                        </form>
                    </div>

                    <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
                    <div id="tab-customregister" class="tab-pane fade">
                        <form id="custom-register" class="ajax-auth"  action="register" method="post">
                            <?php do_action( 'woocommerce_register_form_start' ); ?>

                            <h3><?php esc_html_e('Fill to the forms to create your account', 'besa'); ?></h3>
                            <p class="status"></p>
                            <?php wp_nonce_field('ajax-register-nonce', 'signonsecurity'); ?>         
                            <input id="signonname" type="text" placeholder="<?php esc_attr_e('Username', 'besa'); ?>" name="signonname" class="required form-control" value="<?php echo ( ! empty( $_POST['signonname'] ) ) ? esc_attr( wp_unslash( $_POST['signonname'] ) ) : ''; ?>">
                            <input id="signonemail" type="text" placeholder="<?php esc_attr_e('Email', 'besa'); ?>" class="required email form-control" name="email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>">
                            <input id="signonpassword" type="password" placeholder="<?php esc_attr_e('Password', 'besa'); ?>" class="required form-control" name="signonpassword" autocomplete="new-password">
                            <input type="password" id="password2" placeholder="<?php esc_attr_e('Confirm Password', 'besa'); ?>" class="required form-control" name="password2" autocomplete="new-password">
                            <input class="submit_button" type="submit" value="<?php esc_html_e('Register', 'besa'); ?>">

                            <div class="clear"></div>
                            <?php do_action( 'besa_custom_woocommerce_register_form_end' ); ?>
                            <?php do_action( 'woocommerce_register_form_end' ); ?>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>