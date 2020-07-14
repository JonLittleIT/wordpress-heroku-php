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

<div class="my_meta_control box_video_bd">

    <div class="box_meta_inner">
        <span class="box_meta_label">Type :</span>
        <?php $mb->the_field('video_type'); ?>
        <select id="video_type" name="<?php $mb->the_name(); ?>">
            <option value="">Choose</option>
            <option value="youtube"<?php $mb->the_select_state('youtube'); ?>>Youtube</option>
            <option value="vimeo"<?php $mb->the_select_state('vimeo'); ?>>Vimeo</option>
            <option value="daily"<?php $mb->the_select_state('daily'); ?>>Dailymotion</option>
        </select>
    </div>


    <?php $video_bd = '';?>
    <div class="box_meta_inner">

        <?php $mb->the_field('video'); ?>

        <input style="width: 100%;" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
        <div class="box_meta_info">
            Paste a Just ID from Vimeo or Youtube or Dailymotion.
            <!--The id is the bold text Exampl : http://vimeo.com/<strong>53520224</strong><br><br>https://www.youtube.com/watch?v=<strong>JuyB7NO0EYY</strong><br><br>http://www.dailymotion.com/video/<br><strong>x2bqsvf_2015-nissan-murano-preview_auto</strong>-->
        </div>

        <?php $video_bd = $mb->get_the_value(); ?>
        <?php $mb->the_field( 'video_bd' ); ?>
        <input type="hidden" name="<?php $mb->the_name(); ?>" value="<?php echo $video_bd; ?>">
    </div>

</div>
