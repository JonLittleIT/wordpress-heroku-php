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

function woohoo_cats_input( $input, $head = true )
{
	$bd_option  = unserialize( get_option( 'bdayh_setting' ) );
	$class_name = ( isset( $input['class'] ) ) ? $input['class'] : "";
	echo '<div id="item-'. $input['id'] .'" class="bd_option_item '. $class_name .'">';

	if ( !empty( $input['tip'] ) && $input['tip'] != ' ' )
		echo '<a class="bd_help" title="'. $input['tip'] .'"></a>';

	if ( !empty( $input['name'] ) && $input['name'] != ' ' )
		echo '<h3 for="' . $input['id'] . '">'. $input['name'] .'</h3>';

	if ( !empty( $input['exp'] ) && $input['exp'] != ' ' )
		echo '<p class="bd-exp">'. $input['exp'] .'</p>';

	?>
	<input id="<?php echo $input['id'];?>" class="<?php echo $class_name; ?>" type="text" name="<?php echo $input['id']; ?>" value="<?php if( !empty( $bd_option['bd_setting'][$input['id']] ) ) echo $bd_option['bd_setting'][$input['id']]; ?>" />
	<?php
	$bdaia_list_categories = get_categories();
	echo '<div class="list_tags"">';
	foreach ( $bdaia_list_categories as $cat )
	{
		?><span onclick="add_cat('<?php echo $input['id']; ?>','<?php echo $cat->slug; ?>');"><?php echo $cat->slug ?></span><?php
	}
	echo '</div></div>';
}