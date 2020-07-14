<?php
/**
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Woohoo News Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

function woohoo_ui_slider($input,$head = true)
{
	$bd_option  = unserialize( get_option( 'bdayh_setting' ) );
	$class_name = ( isset( $input['class'] ) ) ? $input['class'] : "";
	echo '<div id="item-'. $input['id'] .'" class="bd_option_item '. $class_name .'">';

	if ( !empty( $input['tip'] ) && $input['tip'] != ' ' )
		echo '<a class="bd_help" title="'. $input['tip'] .'"></a>';

	if ( !empty( $input['name'] ) && $input['name'] != ' ' )
		echo '<h3 for="' . $input['id'] . '">'. $input['name'] .'</h3>';

	if ( !empty( $input['exp'] ) && $input['exp'] != ' ' )
		echo '<p class="bd-exp">'. $input['exp'] .'</p>'; ?>

		<div class="bd-uislider">
			<div class="slider_num slide_num_f" id="<?php echo $input['id'];?>" ></div>
			<input id="<?php echo $input['id']; ?>_input" class="input_num_f" type="text" name="<?php echo $input['id']; ?>" value="<?php if( !empty( $bd_option['bd_setting'][$input['id']] ) ) echo (int)$bd_option['bd_setting'][$input['id']]; ?>">
			<span class="unitf"><?php if( !empty( $input['unit'] ) ) echo $input['unit']; ?><span>
		</div>
	</div>

    <script>
        jQuery(document).ready(function() {
            jQuery("#<?php echo $input['id']; ?>").slider({
                range   : "min",
                min     : <?php echo $input['min']; ?>,
                max     : <?php echo $input['max']; ?>,
                value   : <?php if( !empty( $bd_option['bd_setting'][$input['id']] ) && $bd_option['bd_setting'][$input['id']] != '')  { echo $bd_option['bd_setting'][$input['id']]; } else { echo "0"; } ?>,

	            slide: function( event, ui ) {
                    jQuery( '#'+jQuery(this).attr( 'id' )+'_input' ).val( ui.value );
                }
            });
        });
    </script>
    <?php
	if( isset( $input['js'] ) ) echo $input['js'];
}