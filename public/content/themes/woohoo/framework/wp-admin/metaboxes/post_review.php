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

<div class="my_meta_control">

	<?php $mb->the_field('bdaia_taqyeem'); ?>
    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th>Review Box</th>
                <td>
                    <input class="on-of" type="checkbox" name="<?php $mb->the_name(); ?>" value="bdaia_taqyeem"<?php $mb->the_checkbox_state( true ); ?>/>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!--/Review Box/-->

	<?php $mb->the_field('bdaia_user_taqyeem'); ?>
	<div class="box_meta_inner">
		<table class="meta_box_table">
			<tbody>
			<tr>
				<th>User Rating</th>
				<td>
					<input class="on-of" type="checkbox" name="<?php $mb->the_name(); ?>" value="bdaia_user_taqyeem"<?php $mb->the_checkbox_state( true ); ?>/>
				</td>
			</tr>
			</tbody>
		</table>
	</div><!--/Review Box/-->

	<?php $mb->the_field('bdaia_taqyeem_position'); ?>
    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th>Review Box Position</th>
                <td>
                    <select name="<?php $mb->the_name(); ?>">
                        <option value="">Default</option>
                        <option value="top_bd"<?php $mb->the_select_state('top_bd'); ?>>Top of the post</option>
                        <option value="bottom_bd"<?php $mb->the_select_state('bottom_bd'); ?>>Bottom of the post</option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!--/Review Box Position/-->

	<?php $mb->the_field( 'bdaia_taqyeem_style' ); ?>
    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th>Review Style</th>
                <td>
                    <select name="<?php $mb->the_name(); ?>">
                        <option value="stars_bd"<?php $mb->the_select_state( 'stars_bd' ); ?>>Stars</option>
                        <option value="percentages_bd"<?php $mb->the_select_state( 'percentages_bd' ); ?>>Percentages</option>
                        <option value="points_bd"<?php $mb->the_select_state( 'points_bd' ); ?>>Points</option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!--/Review Style/-->

	<?php $mb->the_field( 'bdaia_taqyeem_title' ); ?>
    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th>Review Box Title</th>
                <td>
                    <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                    <div class="box_meta_info">
                        * optional
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!--/Review Box Title/-->

	<?php $mb->the_field( 'bdaia_taqyeem_brief' ); ?>
    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th>Text appears under the total score</th>
                <td>
                    <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>
                    <div class="box_meta_info">Just one or two words</div>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!--/Text appears under the total score/-->

	<?php $mb->the_field( 'bdaia_taqyeem_summary' ); ?>
    <div class="box_meta_inner">
        <table class="meta_box_table">
            <tbody>
            <tr>
                <th>Review Summary</th>
                <td>
                    <textarea name="<?php $mb->the_name(); ?>" type="textarea" cols="100%" rows="3" tabindex="4"><?php $mb->the_value(); ?></textarea>
                    <div class="box_meta_info">Just a paragraph will do</div>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!--/Review Summary/-->

    <div class="box_meta_innerr">
        <div class="review_criteria_bd bdaia_taqyeem_criteria_ou">
            <?php $total_rating = 0; $i_cont = 0; $score = 0; while( $mb->have_fields_and_multi( 'bdaia_taqyeem_criteria' ) ): ?>
                <?php $mb->the_group_open(); ?>
                <div class="review_criteria_inner_bd bdaia_taqyeem_criteria_in">

                    <div class="bdaia_tc_col">
						<div class="rsc-sort-handle">
							<span class="dashicons dashicons-arrow-up"></span>
							<span class="dashicons dashicons-arrow-down"></span>
						</div>
                    </div>

                    <div class="bdaia_tc_coll">
                        <?php $mb->the_field( 'bdaia_taqyeem_criteria_name' ); ?>
                        <span>Review Criteria</span>
                        <input id="bdaia_taqyeem_criteria_name_<?php $mb->the_index(); ?>" type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
                    </div>

                    <div class="bdaia_tc_colll">
                        <?php $mb->the_field('bdaia_taqyeem_criteria_score'); ?>
                        <span>Criteria Score</span>

                        <div class="bdaia_taqyeem_criteria_slider_wrap" data-id="<?php $mb->the_index(); ?>" data-name="<?php $mb->the_name(); ?>">
	                        <div id="bdaia_taqyeem_criteria_slider_<?php $mb->the_index(); ?>" class="bdaia_taqyeem_criteria_slider"></div>
	                        <input type="text" class="bdaia_taqyeem_criteria_score" id="bdaia_taqyeem_criteria_score_<?php $mb->the_index(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>">
	                        <?php
	                        $total_rating += 100;
	                        $score += $mb->get_the_value();
	                        ?>
                        </div>
                    </div>

                    <div class="bdaia_tc_collll">
                        <span class="dodelete dashicons dashicons-trash"></span>
                    </div>
                </div>
                <?php $mb->the_group_close(); ?>
            <?php $i_cont++; endwhile; ?>

            <a href="#" class="docopy-bdaia_taqyeem_criteria button">Add New Review Criteria</a>
        </div>
    </div><!--/Review Criteria/-->

</div>

<?php $total_rating = $total_rating-100; $the_score = $score/$total_rating*100; $the_score = round( $the_score ); ?>
<?php $mb->the_field( 'bdaia_taqyeem_all_score' ); ?>
<input class="bdaia_taqyeem_all_score" type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" data-all_scores="<?php echo $total_rating; ?>" data-score="<?php echo $score; ?>" />
<?php $mb->the_field( 'bdaia_taqyeem_final_score' ); ?>
<input class="bdaia_taqyeem_final_score" type="hidden" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />

<script>
jQuery(document).ready(function($) {
	$('#wpa_loop-bdaia_taqyeem_criteria').sortable(
		{
		placeholder : "ui-state-highlight",
		handle      : ".rsc-sort-handle, .bdaia_taqyeem_criteria_in",

		start: function(e, ui){
			ui.placeholder.height(ui.item.height());
		}
	});
});
</script>