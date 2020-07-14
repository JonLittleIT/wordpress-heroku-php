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

function woohoo_pb_text( $k, $arr, $block_id ) { ?>
<div class="bdaia_box_item bdaia_box_item_<?php echo $block_id;?>" id="home_box_<?php echo $k; ?>">
	<input type="hidden" name="bdaia_home_cats[<?php echo $k; ?>][type]" value="<?php echo $block_id;?>">

	<div class="bdaia_boxes_title">
		<a href="#" class="bdaia_handle"><i class="handle"></i></a>
		<a href="#" class="bdaia_del" id="remove_<?php echo $k; ?>"><i class="del"></i></a>
		<a href="#" class="bdaia_toggle"><i class="toggle"></i></a>
	</div>

	<div class="bdaia_boxes_content">

		<div class="bdaia_boxes_title_cu">Text Or HTML Code</div>

		<div class="bdaia_boxes_wrapper of">

			<div class="box_meta_inner">
				<table class="meta_box_table">
					<tbody>
					<tr>
						<th>Margin top:</th>
						<td>
							<input name="bdaia_home_cats[<?php echo $k; ?>][margin_t]" type="text" id="bdaia_block<?php echo $k; ?>-margin_t" value="<?php echo $arr['margin_t']; ?>" />
						</td>
					</tr>
					</tbody>
				</table>
			</div><!-- box_meta_inner -->

			<div class="box_meta_inner">
				<table class="meta_box_table">
					<tbody>
					<tr>
						<th>Margin Bottom:</th>
						<td>
							<input name="bdaia_home_cats[<?php echo $k; ?>][margin_b]" type="text" id="bdaia_block<?php echo $k; ?>-margin_b" value="<?php echo $arr['margin_b']; ?>" />
						</td>
					</tr>
					</tbody>
				</table>
			</div><!-- box_meta_inner -->

			<br class="cfix">
			<textarea style="width: 100%; max-width: 100%;" class="textarea_full" name="bdaia_home_cats[<?php echo $k; ?>][text_code]" rows="7"><?php echo stripslashes ( $arr['text_code'] ); ?></textarea>
			<div class="box_meta_info">Text, HTML and Shortcodes</div>
		</div><!-- .Wrapper -->
	</div>
</div>

<?php } ?>