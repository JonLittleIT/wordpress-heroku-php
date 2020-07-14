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

function woohoo_tybo( $input, $head = true )
{
	global $options_fonts;
    $bd_option      = unserialize( get_option( 'bdayh_setting' ) );
    $current_value  = woohoo_get_option($input['id']);
    $class_name     = (isset($input['class'])) ? $input['class'] : "";

	echo '<div id="item-'. $input['id'] .'" class="bd_option_item '. $class_name .'">';

	if ( !empty( $input['tip'] ) && $input['tip'] != ' ' )
		echo '<a class="bd_help" title="'. $input['tip'] .'"></a>';

	if ( !empty( $input['name'] ) && $input['name'] != ' ' )
		echo '<h3>'. $input['name'] .'</h3>';

	if ( !empty( $input['exp'] ) && $input['exp'] != ' ' )
		echo '<p class="bd-exp">'. $input['exp'] .'</p>';
	?>
	<div class="tybo-field">
		<label>Font Face</label>
		<select name="<?php echo $input['id']; ?>[font]" class="select_font" id="bdaia_fonts_<?php echo $input['id']; ?>" data-selected="<?php if( !empty( $current_value['font'] ) ) echo $current_value['font'];?>">
			<?php
            if( isset( $current_value['font'] ) && $current_value['font'] != '' )
            {
                ?>
	            <option value="" selected="selected">Default Font</option>
                <option value="<?php echo $current_value['font'] ?>" selected="selected" ><?php echo $options_fonts[$current_value['font']] ?></option>
                <?php
            }
            else
            {
               ?>
                <option value="" selected="selected">Default Font</option>
                <?php
            }
            ?>
		</select>
	</div>
    <div class="tybo-field">
        <label>Font Size</label>
	    <input id="<?php echo $input['id']; ?>_size" class="input_numb color_input tybo-size" type="text" name="<?php echo $input['id']; ?>[size]" value="<?php if( !empty( $current_value['size'] ) ) echo $current_value['size']; ?>" />
    </div>
    <div class="tybo-field">
        <label>Lineheight</label>
	    <input id="<?php echo $input['id']; ?>_lineheight" class="input_numb color_input tybo-size" type="text" name="<?php echo $input['id']; ?>[lineheight]" value="<?php if( !empty( $current_value['lineheight'] ) ) echo $current_value['lineheight']; ?>" />
    </div>
    <div class="tybo-field">
        <label>Font weight</label>
        <select class="tybo-style" name="<?php echo $input['id']; ?>[weight]" id="<?php echo $input['id']; ?>[weight]">
            <option value="" <?php if ( isset( $current_value['weight'] ) && !$current_value['weight'] ) { echo ' selected="selected"' ; } ?>></option>
            <option value="normal" <?php if ( isset( $current_value['weight'] ) && $current_value['weight']  == 'normal' ) { echo ' selected="selected"' ; } ?>>Normal</option>
            <option value="bold" <?php if ( isset( $current_value['weight'] ) && $current_value['weight']  == 'bold') { echo ' selected="selected"' ; } ?>>Bold</option>
            <option value="lighter" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == 'lighter') { echo ' selected="selected"' ; } ?>>Lighter</option>
            <option value="bolder" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == 'bolder') { echo ' selected="selected"' ; } ?>>Bolder</option>
            <option value="100" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == '100') { echo ' selected="selected"' ; } ?>>100</option>
            <option value="200" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == '200') { echo ' selected="selected"' ; } ?>>200</option>
            <option value="300" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == '300') { echo ' selected="selected"' ; } ?>>300</option>
            <option value="400" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == '400') { echo ' selected="selected"' ; } ?>>400</option>
            <option value="500" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == '500') { echo ' selected="selected"' ; } ?>>500</option>
            <option value="600" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == '600') { echo ' selected="selected"' ; } ?>>600</option>
            <option value="700" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == '700') { echo ' selected="selected"' ; } ?>>700</option>
            <option value="800" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == '800') { echo ' selected="selected"' ; } ?>>800</option>
            <option value="900" <?php if ( isset( $current_value['weight'] ) && $current_value['weight'] == '900') { echo ' selected="selected"' ; } ?>>900</option>
        </select>
    </div>
    <div class="tybo-field">
        <label>Font style</label>
        <select class="tybo-style" name="<?php echo $input['id']; ?>[style]" id="<?php echo $input['id']; ?>[style]" >
            <option value="" <?php if ( isset( $current_value['style'] ) && !$current_value['style'] ) { echo ' selected="selected"' ; } ?>></option>
            <option value="normal" <?php if ( isset( $current_value['style'] ) && $current_value['style']  == 'normal' ) { echo ' selected="selected"' ; } ?>>Normal</option>
            <option value="italic" <?php if ( isset( $current_value['style'] ) && $current_value['style'] == 'italic') { echo ' selected="selected"' ; } ?>>Italic</option>
            <option value="oblique" <?php if ( isset( $current_value['style'] ) && $current_value['style']  == 'oblique') { echo ' selected="selected"' ; } ?>>oblique</option>
        </select>
    </div>
    <div class="tybo-field">
        <label>Text Transform</label>
        <select class="tybo-style" name="<?php echo $input['id']; ?>[texttransform]" id="<?php echo $input['id']; ?>[texttransform]" >
            <option value="" <?php if ( isset( $current_value['texttransform'] ) && !$current_value['texttransform'] ) { echo ' selected="selected"' ; } ?>></option>
            <option value="none" <?php if ( isset( $current_value['texttransform'] ) && $current_value['texttransform']  == 'none' ) { echo ' selected="selected"' ; } ?>>None</option>
            <option value="inherit" <?php if ( isset( $current_value['texttransform'] ) && $current_value['texttransform'] == 'inherit') { echo ' selected="selected"' ; } ?>>Inherit</option>
            <option value="uppercase" <?php if ( isset( $current_value['texttransform'] ) && $current_value['texttransform']  == 'uppercase') { echo ' selected="selected"' ; } ?>>Uppercase</option>
            <option value="lowercase" <?php if ( isset( $current_value['texttransform'] ) && $current_value['texttransform']  == 'lowercase' ) { echo ' selected="selected"' ; } ?>>Lowercase</option>
            <option value="capitalize" <?php if ( isset( $current_value['texttransform'] ) && $current_value['texttransform']  == 'capitalize' ) { echo ' selected="selected"' ; } ?>>Capitalize</option>
            <option value="full-size-kana" <?php if ( isset( $current_value['texttransform'] ) && $current_value['texttransform']  == 'full-size-kana' ) { echo ' selected="selected"' ; } ?>>Full-size-kana</option>
            <option value="full-width" <?php if ( isset( $current_value['texttransform'] ) && $current_value['texttransform']  == 'full-width' ) { echo ' selected="selected"' ; } ?>>Full-width</option>
        </select>
    </div>
    <?php
    echo '</div>'."\n";
}