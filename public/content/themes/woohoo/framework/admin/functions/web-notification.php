<?php
// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) die( 'No direct script access allowed' );

if ( ! function_exists( 'woohoo_get_web_notification' ) )
{
	function woohoo_get_web_notification( $input, $head = true )
	{
		$bd_option                          = unserialize( get_option( 'bdayh_setting' ) );
		$class_name                         = ( isset( $input['class'] ) ) ? $input['class'] : "";
		$current_value_id                   = woohoo_get_option( $input['id'] );

		?>
        <div id="fox-push-signup-wrapper" class="bdaia-box-panel text-center">
            <p>
                <a href="https://goo.gl/fB4uCy" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/foxpush/images/foxpush_logo.png" width="195" height="40" alt="" /></a>
            </p>

            <p>Send instant push notifications to your subscribers whenever they are online, wherever they may be – even on their phones! It’s easy to set up, and no technical skills are required. Try it today.</p>
            <p>
                <a class="bdaia-btn color4" href="https://goo.gl/fB4uCy" target="_blank"><strong>Sign up for FREE</strong></a>
            </p>
        </div>

        <div class="bdaia-box-panel">
            <div class="bd-subtitle-two"><span>Web Notification</span></div>
            <div class="bd_option_item">
                <table class="bd-on-of">
                    <tbody>
                    <tr>
                        <th style="width: 335px; display: block;">Enable</th>
                        <td>
                            <input class="on-of bdaia-toggle-option" data-bdaia-toggle="#fox-push-connect-wrapper, #fox-push-stats-wrapper" type="checkbox" id="input-<?php echo $input['id']; ?>" <?php if( isset( $bd_option['bd_setting'][$input['id']] ) and $bd_option['bd_setting'][$input['id']] == true ) echo ' checked="checked"'; ?> class="<?php echo $class_name; ?>" name="<?php echo $input['id']; ?>"  value="true" />
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="fox-push-connect-wrapper" class="bdaia-box-panel">
            <div class="bd-subtitle-two"><span>FoxPush Setup</span></div>

            <div class="bd_option_item">
                <h3>FoxPush Domain</h3>
                <input name="<?php echo $input["foxpush_domain"]; ?>" id="input-<?php echo $input["foxpush_domain"]; ?>" class="<?php echo ( $class_name ); ?>" type="text" value="<?php if( !empty( $bd_option["bd_setting"][$input["foxpush_domain"]] ) ) echo htmlspecialchars(stripslashes( $bd_option["bd_setting"][$input["foxpush_domain"]] ) ); ?>" />
            </div>

            <div class="bd_option_item">
                <h3>API Key</h3>
                <input name="<?php echo $input["foxpush_api"]; ?>" id="input-<?php echo $input["foxpush_api"]; ?>" class="<?php echo ( $class_name ); ?>" type="text" value="<?php if( !empty( $bd_option["bd_setting"][$input["foxpush_api"]] ) ) echo htmlspecialchars(stripslashes( $bd_option["bd_setting"][$input["foxpush_api"]] ) ); ?>" />
            </div>

            <div class="bd_option_item" style="display: none">
                <a href="#" id="fox-push-connect-btn" class="bdaia-btn color2">Connect</a>
            </div>
        </div>

        <?php do_action( 'woohoo_get_foxpush' ); ?>

        <?php
	}
}