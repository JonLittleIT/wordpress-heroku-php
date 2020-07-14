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
?>

<input type="hidden" name="bdaia_hidden_flag" value="true" />
<div class="my_meta_control box_video_bd">

	<div class="box_meta_inner">
		<?php $mb->the_field('soundcloud_embed'); ?>
		<textarea style="width: 100% !important" name="<?php $mb->the_name(); ?>" rows="5" cols="40"><?php $mb->the_value(); ?></textarea>
		<div class="box_meta_info">
			Paste a embed(iframe)
		</div>
	</div>
</div>
