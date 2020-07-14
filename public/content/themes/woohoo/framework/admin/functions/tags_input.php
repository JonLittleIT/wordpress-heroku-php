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

function woohoo_tags_input( $input, $head = true )
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
    $list_tags = get_tags('orderby=count&order=desc&number=50');
    echo '<div class="list_tags"">';
    foreach ( $list_tags as $tag )
    {
        ?><span onclick="add_tag('<?php echo $input['id']; ?>','<?php echo $tag->slug; ?>');"><?php echo $tag->slug ?></span><?php
    }
    echo '</div></div>';
}