<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

global $post;
$bd_criteria_header     = get_post_meta( get_the_ID(), 'bdaia_taqyeem_title', true      );
$bd_criteria_display    = get_post_meta( get_the_ID(), 'bdaia_taqyeem_position', true   );
$bd_review_type         = get_post_meta( get_the_ID(), 'bdaia_taqyeem_style', true      );
$bd_rate                = get_post_meta( get_the_ID(), 'bdaia_taqyeem_criteria', true   );
$bd_longer_summary      = get_post_meta( get_the_ID(), 'bdaia_taqyeem_summary', true    );
$bd_brief_summary       = get_post_meta( get_the_ID(), 'bdaia_taqyeem_brief', true      );
$post_reviews           = get_post_meta( get_the_ID(), 'bdaia_taqyeem', true            );
$bdaia_user_taqyeem     = get_post_meta( get_the_ID(), 'bdaia_user_taqyeem', true            );

$bdaia_taqyeem_final_score = get_post_meta( get_the_ID(), 'bdaia_taqyeem_final_score', true );

$to_bd = $score = 0;

if ( $post_reviews == '' ) $post_reviews = woohoo_get_option( 'po_review' ); ?>

<?php if( $post_reviews ) { ?>
	<div class="cfix"></div>

	<div class="post-review-bd <?php echo( $bd_criteria_display ); ?>">

		<span style="display: none;" itemprop="itemReviewed" itemscope="" itemtype="https://schema.org/Thing">
			<meta itemprop="name" content="<?php echo get_the_title(); ?>">
		</span>

		<table class="post-review-table">
			<tbody>
			<tr>
				<td colspan="2" class="post-review-header">
					<?php if ($bd_criteria_header !== '' ) { ?>
						<?php echo $bd_criteria_header; ?>
					<?php } ?>
				</td>
			</tr>

			<?php
			foreach( $bd_rate as $bd )
			{
				if ( $bd['bdaia_taqyeem_criteria_name'] ) {

					if ( $bd['bdaia_taqyeem_criteria_score'] > 100 ) $bd['bdaia_taqyeem_criteria_score'] = 100;
					if ( $bd['bdaia_taqyeem_criteria_score'] < 0 || empty($bd['bdaia_taqyeem_criteria_score']) || !is_numeric( $bd['bdaia_taqyeem_criteria_score']) ) $bd['bdaia_taqyeem_criteria_score'] = 0;
					$score += $bd['bdaia_taqyeem_criteria_score'];
					$to_bd ++; ?>

					<?php if( $bd_review_type == 'percentages_bd' ) { ?>
						<tr class="post-review-points">
							<td colspan="2">
								<span class="bd-criteria-description"><?php echo $bd['bdaia_taqyeem_criteria_name']; ?></span>
								<span class="bd-criteria-points"><?php echo $bd['bdaia_taqyeem_criteria_score']; ?>%</span>
								<div class="bdayh-clearfix"></div>
								<div class="points-rating">
									<div class="points-rating-div" style="width:<?php echo $bd['bdaia_taqyeem_criteria_score']; ?>%"></div>
								</div>
							</td>
						</tr><!-- .post-review-percentages -->
					<?php } elseif( $bd_review_type == 'points_bd' ) { $point =  $bd['bdaia_taqyeem_criteria_score']/10; ?>
						<tr class="post-review-points">
							<td colspan="2">
								<span class="bd-criteria-description"><?php echo $bd['bdaia_taqyeem_criteria_name']; ?></span>
								<span class="bd-criteria-points"><?php echo $point; ?></span>
								<div class="bdayh-clearfix"></div>
								<div class="points-rating">
									<div class="points-rating-div" style="width:<?php echo $bd['bdaia_taqyeem_criteria_score']; ?>%"></div>
								</div>
							</td>
						</tr><!-- .post-review-points -->
					<?php } else { ?>
						<tr class="post-review-stars">
							<td>
								<span class="bd-criteria-description"><?php echo $bd['bdaia_taqyeem_criteria_name']; ?></span>
							</td>
							<th>
								<div class="woohoo-star-rating">
									<span style="width:<?php echo $bd['bdaia_taqyeem_criteria_score']; ?>%"></span>
								</div>
							</th>
						</tr><!-- .post-review-stars -->
					<?php }
				}
			}
			if ( !empty( $score ) && !empty( $to_bd ) ) {
				$ts_bd = $score / $to_bd;
			}
			if ( empty($ts_bd) ) { $ts_bd = 0; }

			/*-----------------------------------------------------------------------------------*/ ?>
			<tr class="post-review-total">
				<td>
					<div>
						<div class="summary-title"><?php woohoo_tr( 'Summary' )?></div>
						<meta itemprop="reviewBody" content="<?php echo $bd_longer_summary;;?>">
						<?php echo $bd_longer_summary;?>
					</div>
				</td>
				<th style="width: 148px">
					<div>
						<div>
							<?php /*-----------------------------------------------------------------------------------*/
							if( $bd_review_type == 'percentages_bd' ) { ?>

								<span style="display: none;" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating">
                                    <meta itemprop="worstRating" content = "1" />
                                    <meta itemprop="bestRating" content = "100" />
                                    <meta itemprop="ratingValue" content = "<?php echo round( $bdaia_taqyeem_final_score ); ?>" />
                                </span>

								<div class="total-score"><span class="num rating-value"><?php echo round( $bdaia_taqyeem_final_score ); ?></span> %</div>
								<div class="woohoo-star-rating"><span style="width:<?php echo round( $ts_bd ); ?>%"></span></div>
								<div class="brief-summary"><?php echo $bd_brief_summary;?></div>

							<?php } elseif ( $bd_review_type == 'points_bd') { $bdaia_taqyeem_final_score = $bdaia_taqyeem_final_score/10 ; ?>

								<span style="display: none;" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating">
									<meta itemprop="worstRating" content="1">
									<meta itemprop="bestRating" content="10">
									<meta itemprop="ratingValue" content="<?php echo round( $bdaia_taqyeem_final_score, 1 ); ?>">
								</span>

								<div class="total-score"><span class="num rating-value"><?php echo round( $bdaia_taqyeem_final_score, 1 ); ?></span></div>
								<div class="brief-summary"><?php echo $bd_brief_summary;?></div>

							<?php } else { ?>

								<span style="display: none;" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating">
                                    <meta itemprop="worstRating" content = "1" />
                                    <meta itemprop="bestRating" content = "100" />
                                    <meta itemprop="ratingValue" content = "<?php echo round( $bdaia_taqyeem_final_score ); ?>" />
                                </span>

								<div class="total-score"><span class="num rating-value"><?php echo round( $bdaia_taqyeem_final_score ); ?></span> %</div>
								<div class="woohoo-star-rating"><span style="width:<?php echo round( $bdaia_taqyeem_final_score ); ?>%"></span></div>
								<div class="brief-summary"><?php echo $bd_brief_summary;?></div>

							<?php } ?>

						</div>
					</div>
				</th>
			</tr>
			<?php
            if ( $bdaia_user_taqyeem ) :
                echo woohoo_get_user_rating();
            endif;
            ?>
			</tbody>
		</table>
	</div><!-- .post-review-bd -->
	<div class="cfix"></div>
<?php } ?>