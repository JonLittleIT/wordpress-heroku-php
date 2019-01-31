<?php
/**
 * Prohibit direct script loading.
 *
 * @package Convert_Plus.
 */

// Remove All Styles.
require_once CP_BASE_DIR . 'admin/contacts/views/cp-paginator.php';

$remove_styles = ( isset( $_GET['remove-styles'] ) ) ? $_GET['remove-styles'] : 'false';
if ( 'true' === $remove_styles ) {
	delete_option( 'smile_info_bar_styles' );
	delete_option( 'info_bar_variant_tests' );
	delete_option( 'smile_style_analytics' );
	echo '<div style="background: #2F9DD2;color: #FFF;padding: 16px;margin-top: 20px;margin-right: 20px;text-align: center;font-size: 16px;border-radius: 4px;">Removed All Styles..!</div>';
}

$prev_styles    = get_option( 'smile_info_bar_styles' );
$variant_tests  = get_option( 'info_bar_variant_tests' );
$analytics_data = get_option( 'smile_style_analytics' );
$is_empty       = false;

if ( is_array( $prev_styles ) ) {
	foreach ( $prev_styles as $key => $style ) {
		$impressions  = 0;
		$multivariant = false;
		$has_variants = false;
		$style_id     = $style['style_id'];

		if ( isset( $style['multivariant'] ) ) {
			$multivariant = true;
		}

		if ( $variant_tests ) {
			if ( array_key_exists( $style_id, $variant_tests ) && ! empty( $variant_tests[ $style_id ] ) ) {
				$has_variants = true;
			}
		}

		$variants = array();
		$live     = '0';

		if ( $has_variants ) {
			foreach ( $variant_tests[ $style_id ] as $value ) {
				$settings = unserialize( $value['style_settings'] );
				if ( '1' === $settings['live'] ) {
					$live = '1';
				}
				$variants[] = $value['style_id'];
			}

			foreach ( $variants as $value ) {
				if ( isset( $analytics_data[ $value ] ) ) {
					foreach ( $analytics_data[ $value ] as $value1 ) {
						$impressions = $impressions + $value1['impressions'];
					}
				}
			}
		}

		if ( ! $multivariant ) {
			if ( isset( $analytics_data[ $style_id ] ) ) {
				foreach ( $analytics_data[ $style_id ] as $key1 => $value2 ) {
					$impressions = $impressions + $value2['impressions'];
				}
			}
		}

		$style_settings = unserialize( $prev_styles[ $key ]['style_settings'] );
		if ( isset( $style_settings['live'] ) && '1' === $style_settings['live'] ) {
			$live = '1';
		}

		if ( $has_variants ) {
			$info_bar_status = $live;
		} else {
			$info_bar_status = ( isset( $style_settings['live'] ) ) ? $style_settings['live'] : '';
		}

		if ( '2' === $info_bar_status ) {
			$status = '1';
		} elseif ( '1' === $info_bar_status ) {
			$status = '2';
		} else {
			$status = '0';
		}

		$prev_styles[ $key ]['info_barStatus'] = intval( $info_bar_status );
		$prev_styles[ $key ]['status']         = intval( $status );
		$prev_styles[ $key ]['impressions']    = $impressions;
	}
	$prev_styles = array_reverse( $prev_styles, true );
}

$limit         = ( isset( $_GET['limit'] ) ) ? esc_attr( $_GET['limit'] ) : 10;
$page          = ( isset( $_GET['cont-page'] ) ) ? esc_attr( $_GET['cont-page'] ) : 1;
$links         = ( isset( $_GET['links'] ) ) ? esc_attr( $_GET['links'] ) : 1;
$orderby       = ( isset( $_GET['orderby'] ) ) ? esc_attr( $_GET['orderby'] ) : false;
$order         = ( isset( $_GET['order'] ) ) ? esc_attr( $_GET['order'] ) : false;
$total         = ( is_array( $prev_styles ) ) ? count( $prev_styles ) : 0;
$maintain_keys = false;

if ( isset( $_POST['sq'] ) ) {
	$search_key      = esc_attr( $_POST['sq'] );
	$redirect_string = '?page=smile-info_bar-designer&limit=' . $limit . '&sq=' . $search_key . '&cont-page=1';
	echo "<script>
	window.location.href= '$redirect_string';
	</script>";
} else {
	$search_key = '';
}

if ( isset( $_GET['order'] ) && 'asc' === $_GET['order'] ) {
	$orderlink = 'order=desc';
} else {
	$orderlink = 'order=asc';
}

$sorting_style_name_class = 'sorting';
$sorting_list_imp_class   = 'sorting';
$sorting_status_class     = 'sorting';

// define sorting class.
if ( isset( $_GET['orderby'] ) ) {

	$order = isset( $_GET['order'] ) ? esc_attr( $_GET['order'] ) : '';
	switch ( $_GET['orderby'] ) {
		case 'style_name':
			$sorting_style_name_class = 'sorting-' . $order;
			break;
		case 'impressions':
			$sorting_list_imp_class = 'sorting-' . $order;
			break;
		case 'status':
			$sorting_status_class = 'sorting-' . $order;
			break;
	}
}

if ( isset( $_GET['sq'] ) && ! empty( $_GET['sq'] ) ) {
	$sq = esc_attr( $_GET['sq'] );
} else {
	$sq = $search_key;
}

if ( isset( $_POST['sq'] ) && '' === $_POST['sq'] ) {
	$sq = '';
}

$search_in_params = array( 'style_name', 'style_id' );

if ( $prev_styles ) {
	$paginator   = new CP_Paginator( $prev_styles );
	$result      = $paginator->get_data( $limit, $page, $orderby, $order, $sq, $search_in_params, $maintain_keys );
	$prev_styles = $result->data;
}

?>
<div class="wrap about-wrap bend cp-info_bar-main">
	<div class="wrap-container">
		<div class="bend-heading-section">
			<h1><?php echo __( 'Info Bar Designer', 'smile' ); ?>
				<a class="add-new-h2" href="?page=smile-info_bar-designer&style-view=new" title="<?php echo __( 'Create New Info Bar', 'smile' ); ?>"><?php echo __( 'Create New Info Bar', 'smile' ); ?></a>
				<span class="cp-loader spinner" style="float: none;"></span>
			</h1>

			<a href="?page=smile-info_bar-designer&style-view=new" class="bsf-connect-download-csv" style="margin-right: 25px !important;"><i class="connects-icon-square-plus" style="line-height: 30px;font-size: 22px;"></i>
				<?php _e( 'Create New Info Bar', 'smile' ); ?>
			</a>
			<a href="?page=smile-info_bar-designer&style-view=analytics"  style="margin-right: 25px !important;" class="bsf-connect-download-csv"><i class="connects-icon-bar-graph-2" style="line-height: 30px;"></i>
				<?php _e( 'Analytics', 'smile' ); ?>
			</a>
			<a href="#" style="margin-right: 25px !important;" class="bsf-connect-download-csv cp-import-style" data-module="info_bar" data-uploader_title="<?php _e( 'Upload Your Exported file', 'smile' ); ?>" data-uploader_button_text="<?php _e( 'Import Style', 'smile' ); ?>" onclick_="jQuery('.cp-import-overlay, .cp-style-importer').fadeIn('fast');"><i class="connects-icon-upload" style="line-height: 30px;font-size: 22px;"></i>
				<?php _e( 'Import Info Bar', 'smile' ); ?>
			</a>
			<?php $search_active_class = ( '' !== $sq ) ? 'bsf-cntlist-top-search-act' : ''; ?>
			<?php if ( 0 !== $total ) { ?>
			<span class="bsf-contact-list-top-search <?php echo $search_active_class; ?>"><i class="connects-icon-search" style="line-height: 30px;"></i>
				<form method="post" class="bsf-cntlst-top-search">
					<input class="bsf-cntlst-top-search-input" type="search" id="post-search-input" name="sq" placeholder="<?php _e( 'Search', 'smile' ); ?>" value="<?php echo esc_attr( $sq ); ?>">
					<i class="bsf-cntlst-top-search-submit connects-icon-search"></i>
				</form>
			</span>
			<?php } ?>
			<!-- .bsf-contact-list-top-search -->

			<div class="message"></div>
		</div>
		<!-- bend-heading-section -->

		<div class="bend-content-wrap" style="margin-top: 40px;">
			<hr class="bsf-extensions-lists-separator" style="margin: 22px 0px 30px 0px;">
		</hr>
		<div class="container">
			<?php
			$change_status_nonce   = wp_create_nonce( 'cp-change-style-status' );
			$reset_analytics_nonce = wp_create_nonce( 'cp-reset-analytics' );
			$delete_style_nonce    = wp_create_nonce( 'cp-delete-style' );
			?>
			<input type="hidden" id="cp-change-status-nonce" value="<?php echo $change_status_nonce; ?>" />
			<input type="hidden" id="cp-reset-analytics-nonce" value="<?php echo $reset_analytics_nonce; ?>" />
			<input type="hidden" id="cp-delete-style-nonce" value="<?php echo $delete_style_nonce; ?>" />
			<div id="smile-stored-styles">
				<input type="hidden" id="cp-change-status-nonce" value="<?php echo $change_status_nonce; ?>" />
				<div id="smile-stored-styles">
					<table class="wp-list-table widefat fixed cp-list-optins cp-info_bar-list-optins">
						<?php if ( 0 !== $total ) { ?>
						<thead>
							<tr>
								<th scope="col" id="style-name" class="manage-column column-style <?php echo $sorting_style_name_class; ?>">
									<input type="checkbox" name="cp-select-chk" value='' class="cp-select-all"/></th>
									<th scope="col" id="style-name" class="manage-column column-style <?php echo $sorting_style_name_class; ?>">
										<a href="?page=smile-info_bar-designer&orderby=style_name&<?php echo $orderlink; ?>&sq=<?php echo $search_key; ?>&cont-page=<?php echo $page; ?>">
											<span class="connects-icon-ribbon"></span>
											<?php _e( 'Info Bar Name', 'smile' ); ?></a></th>
											<th scope="col" id="impressions" class="manage-column column-impressions <?php echo $sorting_list_imp_class; ?>">
												<a href="?page=smile-info_bar-designer&orderby=impressions&<?php echo $orderlink; ?>&sq=<?php echo $search_key; ?>&cont-page=<?php echo $page; ?>">
													<span class="connects-icon-disc"></span>
													<?php _e( 'Impressions', 'smile' ); ?></a></th>
													<th scope="col" id="status" class="manage-column column-status <?php echo $sorting_status_class; ?>"><a href="?page=smile-info_bar-designer&orderby=status&<?php echo $orderlink; ?>&sq=<?php echo $search_key; ?>&cont-page=<?php echo $page; ?>">
														<span class="connects-icon-toggle"></span>
														<?php _e( 'Status', 'smile' ); ?></a></th>
														<th scope="col" id="actions" class="manage-column column-actions" style="min-width: 300px;"><span class="connects-icon-cog"></span>
															<?php _e( 'Actions', 'smile' ); ?></th>
														</tr>
													</thead>
													<?php } ?>
													<tbody id="the-list" class="smile-style-data">
														<?php
														$list_count = 0;
														if ( is_array( $prev_styles ) && ! empty( $prev_styles ) ) {
															foreach ( $prev_styles as $key => $style ) {
																$style_name   = $style['style_name'];
																$style_id     = $style['style_id'];
																$impressions  = $style['impressions'];
																$variants     = array();
																$has_variants = false;
																if ( $variant_tests ) {
																	if ( array_key_exists( $style_id, $variant_tests ) && ! empty( $variant_tests[ $style_id ] ) ) {
																		$has_variants = true;
																		foreach ( $variant_tests[ $style_id ] as $value ) {
																			$variants[] = $value['style_id'];
																		}
																	}
																}

																$style_settings = unserialize( $style['style_settings'] );
																$exp_settings   = array();
																foreach ( $style_settings as $title => $value ) {
																	if ( ! is_array( $value ) ) {
																		$value = urldecode( $value );
																		if ( is_callable( 'utf8_encode' ) ) {
																			$exp_settings[ $title ] = htmlentities( stripslashes( utf8_encode( $value ) ), ENT_QUOTES );
																		} else {
																			$exp_settings[ $title ] = htmlentities( stripslashes( html_entity_decode( $value ) ), ENT_QUOTES );
																		}
																	} else {
																		foreach ( $value as $ex_title => $ex_val ) {
																			$val[ $ex_title ] = $ex_val;
																		}
																		$exp_settings[ $title ] = str_replace( '"', '&quot;', $val );
																	}
																}
																$export                   = $style;
																$export['style_settings'] = $exp_settings;

																$theme        = $style_settings['style'];
																$multivariant = isset( $style['multivariant'] ) ? true : false;
																$live         = isset( $style['info_barStatus'] ) ? (int) $style['info_barStatus'] : '';
																$is_scheduled = false;
																$status       = '';

																if ( $has_variants ) {
																	$status .= '<a href=?page=smile-info_bar-designer&style-view=variant&variant-style=' . urlencode( $style_id ) . '&style=' . urlencode( stripslashes( $style_name ) ) . '&theme=' . urlencode( $theme ) . '>';
																} else {
																	$status .= '<span class="change-status">';
																}

																if ( 1 === $live ) {
																	$status .= '<span data-live="1" class="cp-status cp-main-variant-status"><i class="connects-icon-play"></i><span>' . __( 'Live', 'smile' ) . '</span></span>';
																} elseif ( 0 === $live ) {
																	$status .= '<span data-live="0" class="cp-status cp-main-variant-status"><i class="connects-icon-pause"></i><span>' . __( 'Pause', 'smile' ) . '</span></span>';
																} else {
																	$schedule_data = unserialize( $style['style_settings'] );
																	if ( isset( $schedule_data['schedule'] ) ) {
																		$scheduled_array = $schedule_data['schedule'];
																		if ( is_array( $scheduled_array ) ) {
																			$startdate = date( 'j M Y ', strtotime( $scheduled_array['start'] ) );
																			$enddate   = date( 'j M Y ', strtotime( $scheduled_array['end'] ) );
																			$first     = date( 'j-M-Y (h:i A) ', strtotime( $scheduled_array['start'] ) );
																			$second    = date( 'j-M-Y (h:i A) ', strtotime( $scheduled_array['end'] ) );
																			$title     = 'Scheduled From ' . $first . ' To ' . $second;
																		}
																	} else {
																		$title = '';
																	}

																	$status .= '<span data-live="2" class="cp-status"><i class="connects-icon-clock"></i><span title="' . $title . '">' . __( 'Scheduled', 'smile' ) . '</span></span>';
																}

																if ( $has_variants ) {
																	$status .= '</a>';
																}

																if ( ! $has_variants ) {
																	$status .= '<ul class="manage-column-menu">';
																	if ( 1 !== $live && '1' !== $live ) {
																		$status .= '<li><a href="#" class="change-status" data-style-id="' . $style_id . '" data-live="1" data-option="smile_info_bar_styles"><i class="connects-icon-play"></i><span>' . __( 'Live', 'smile' ) . '</span></a></li>';
																	}
																	if ( 0 !== $live && '0' !== $live && '' !== $live ) {
																		$status .= '<li><a href="#" class="change-status" data-style-id="' . $style_id . '" data-live="0" data-option="smile_info_bar_styles"><i class="connects-icon-pause"></i><span>' . __( 'Pause', 'smile' ) . '</span></a></li>';
																	}
																	if ( 2 !== $live && '2' !== $live ) {
																		$status .= '<li><a href="#" class="change-status" data-style-id="' . $style_id . '" data-live="2" data-option="smile_info_bar_styles" data-schedule="1"><i class="connects-icon-clock"></i><span>' . __( 'Schedule', 'smile' ) . '</span></a></li>';
																	}
																	$status .= '</ul>';
																}
																$status .= '</span>';
																?>
																<tr id="<?php echo $key; ?>" class="ui-sortable-handle 
																	<?php
																	if ( $has_variants ) {
																		echo 'cp-variant-exist'; }
																	?>
																		"><?php $list_count++; ?>
																		<td class="column-delete"><input type="checkbox" name="delete_modal" value="<?php echo urlencode( $style_id ); ?>" /></td>

																		<?php if ( $multivariant || $has_variants ) { ?>
																		<td class="name column-name"><a href="?page=smile-info_bar-designer&style-view=variant&variant-style=<?php echo urlencode( $style_id ); ?>&style=<?php echo urlencode( $style_name ); ?>&theme=<?php echo urlencode( $theme ); ?>"  ><?php echo 'Variants of ' . urldecode( $style_name ); ?> </a></td>
																		<?php } else { ?>
																		<td class="name column-name"><a href="?page=smile-info_bar-designer&style-view=edit&style=<?php echo urlencode( $style_id ); ?>&theme=<?php echo urlencode( $theme ); ?>" target ="_blank" ><?php echo urldecode( $style_name ); ?> </a></td>
																		<?php } ?>
																		<td class="column-impressions"><?php echo $impressions; ?></td>
																		<td class="column-status"><?php echo $status; ?></td>
																		<td class="actions column-actions">
																			<a class="action-list" data-style="<?php echo urlencode( $style_id ); ?>" data-option="smile_info_bar_styles" href="?page=smile-info_bar-designer&style-view=variant&variant-style=<?php echo urlencode( $style_id ); ?>&style=<?php echo urlencode( stripslashes( $style_name ) ); ?>&theme=<?php echo urlencode( $theme ); ?>" ><i class="connects-icon-share"></i><span class="action-tooltip">
																				<?php if ( $has_variants ) { ?>
																					<?php _e( 'See Variants', 'smile' ); ?>
																				<?php } else { ?>
																				<?php _e( 'Create Variant', 'smile' ); ?>
																				<?php } ?>
																			</span></a>
																			<?php if ( ! $has_variants ) { ?>
																			<a class="action-list copy-style-icon" data-style="<?php echo urlencode( $style_id ); ?>" data-module="info_bar" data-option="smile_info_bar_styles" style="margin-left: 25px;" href="#"><i class="connects-icon-paper-stack" style="font-size: 20px;"></i><span class="action-tooltip">
																				<?php _e( 'Duplicate Info bar', 'smile' ); ?>
																			</span></a>
																			<?php } ?>
																			<?php
																			if ( $has_variants ) {
																				$style_for_analytics = implode( '||', $variants );
																				if ( ! $multivariant ) {
																					$style_for_analytics .= '||' . $style_id;
																				}
																				$style_arr = explode( '||', $style_for_analytics );
																				if ( count( $style_arr ) > 1 ) {
																					$comp_factor = 'imp';
																				} else {
																					$comp_factor = 'impVsconv';
																				}
																			} else {
																				$style_for_analytics = $style_id;
																				$comp_factor         = 'impVsconv';
																			}
																			?>
																			<a class="action-list" data-style="<?php echo urlencode( $style_id ); ?>" data-option="smile_info_bar_styles" style="margin-left: 25px;" href="?page=smile-info_bar-designer&style-view=analytics&compFactor=<?php echo $comp_factor; ?>&style=<?php echo urlencode( $style_for_analytics ); ?>"><i class="connects-icon-bar-graph-2"></i><span class="action-tooltip">
																				<?php _e( 'View Analytics', 'smile' ); ?>
																			</span></a>
																			<?php
																			$export_infobar_nonce = wp_create_nonce( 'export-infobar-' . $style_id );
																			$form_action          = admin_url( 'admin-post.php?action=cp_export_infobar&style_id=' . $style_id . '&style_name=' . urldecode( $style_name ) . '&_wpnonce=' . $export_infobar_nonce );
																			?>

																			<form method="post" class="cp-export-contact" action="<?php echo esc_url( $form_action ); ?>">
																				<input type="hidden" name="style_id" value="<?php echo urlencode( $style_id ); ?>" />
																				<input type="hidden" name="style_name" value="<?php echo urldecode( $style_name ); ?>" />
																				<?php
																				if ( ! $multivariant && ! $has_variants ) {
																					echo apply_filters( 'cp_before_delete_action', $style_settings, 'info_bar' );
																				}
																				?>
																				<a class="action-list cp-download-infobar" href="#" target="_top" style="margin-left: 25px;" ><i  class="connects-icon-download"></i><span class="action-tooltip"><?php _e( 'Export Settings', 'smile' ); ?></span></a>
																			</form>
																			<a class="action-list trash-style-icon" data-delete="hard" data-variantoption="info_bar_variant_tests" data-style="<?php echo urlencode( $style_id ); ?>" data-option="smile_info_bar_styles" style="margin-left: 25px;" href="#"><i class="connects-icon-trash"></i><span class="action-tooltip">

																				<?php _e( 'Delete Info Bar', 'smile' ); ?>
																			</span></a>
																		</td>
																	</tr>
																	<?php

															}
														} else {
															?>
															<tr>
																<?php
																if ( isset( $_GET['sq'] ) && '' !== $_GET['sq'] && 0 !== $total ) {
																	$is_empty = true;
																	?>
																	<th scope="col" colspan="4" class="manage-column cp-list-empty"><?php echo __( 'No results available.', 'smile' ); ?><a class="add-new-h2" href="?page=smile-info_bar-designer" title="<?php _e( 'Back to info_bar list', 'smile' ); ?>">
																		<?php _e( 'Back to Info Bar list', 'smile' ); ?>
																		</a>
																	</th>
																	<?php
																} else {
																	if ( 0 === $total ) {
																		?>
																		<th scope="col" colspan="4" class="manage-column cp-list-empty cp-empty-graphic"><?php echo __( 'First time being here?', 'smile' ); ?><br> <a class="add-new-h2" href="?page=smile-info_bar-designer&style-view=new" title="<?php _e( 'Create New Info Bar', 'smile' ); ?>">
																			<?php _e( "Awesome! Let's start with your first info bar", 'smile' ); ?>
																		</a>
																	</th>
																		<?php
																	}
																}
																?>
														</tr>
															<?php
														}
														?>
												</tbody>
											</table>

											<!-- Pagination & Search -->
											<div class="row">
												<div class="container" style="max-width:100% !important;width:100% !important;">
													<div class="col-md-5 col-sm-10">
														<a class="button-primary cp-add-new-style-bottom" href="?page=smile-info_bar-designer&style-view=new" title="<?php _e( 'Create New Info Bar', 'smile' ); ?>">
															<?php _e( 'Create New Info Bar', 'smile' ); ?>
														</a>
														<a class="button-primary cp-style-analytics-bottom" href="?page=smile-info_bar-designer&style-view=analytics" title="<?php _e( 'Analytics', 'smile' ); ?>">
															<?php _e( 'Analytics', 'smile' ); ?>
														</a>
														<?php if ( 0 !== $total ) { ?>
														<a class="button-primary action-tooltip disabled cp-delete-multiple-modal-style" href="#" title="" data-delete="hard" data-module='Info Bar' data-option="smile_info_bar_styles" data-id = "" data-variantoption = "info_bar_variant_tests" >
															<?php _e( 'Delete Selected Infobar', 'smile' ); ?>
														</a>
														<?php } ?>
													</div><!-- .col-sm-6 -->
													<div class="col-md-5 col-sm-6">
														<?php
														$flag = true;
														if ( isset( $_GET['sq'] ) && '' !== $_GET['sq'] && $list_count < $limit ) {
															$flag = false;
														}
														if ( $total > $limit && ! $is_empty && $flag ) {
															$base_page_link = '?page=smile-info_bar-designer';
															echo $paginator->create_links( $links, 'pagination bsf-cnt-pagi', '', $sq, $base_page_link );
														}
														if ( 0 === $list_count && isset( $_GET['cont-page'] ) && $flag && 0 !== $total ) {
															$page_no = ( isset( $_GET['cont-page'] ) && '' !== $_GET['cont-page'] ) ? $_GET['cont-page'] : '1';
															if ( $page_no > 1 ) {
																$page_no = $page_no - 1;
															}
															$redirect_string = '?page=smile-info_bar-designer&limit=' . $limit . '&sq=' . $search_key . '&cont-page=' . $page_no;
															echo "<script>
															window.location.href= '$redirect_string';
															</script>";
														}
														?>
													</div><!-- .col-sm-6 -->
												</div><!-- .container -->
											</div><!-- .row -->

										</div>
										<!-- #smile-stored-styles -->
									</div>
									<!-- .container -->

									<!-- Pagination & Search -->
									<div class="row">
										<div class="container" style="max-width:100% !important;width:100% !important;">
											<div class="col-sm-6">
												<?php if ( $total > $limit ) { ?>
												<p class="search-box">
													<form method="post" class="bsf-cntlst-search">
														<label class="screen-reader-text" for="post-search-input"><?php _e( 'Search Contacts', 'smile' ); ?>:</label>
														<input type="search" id="post-search-input" name="sq" value="<?php echo esc_attr( $sq ); ?>">
														<input type="submit" id="search-submit" class="button" value="Search">
													</form>
												</p>
												<?php } ?>
											</div><!-- .col-sm-6 -->
											<div class="col-sm-6">

											</div><!-- .col-sm-6 -->
										</div><!-- .container -->
									</div><!-- .row -->

								</div>
								<!-- .bend-content-wrap -->
							</div>
							<!-- .wrap-container -->
							<?php
							$timezone          = '';
							$timezone_settings = get_option( 'convert_plug_settings' );

							$timezone_name = $timezone_settings['cp-timezone'];
							if ( 'WordPress' === $timezone_name ) {
								$timezone = 'WordPress';
							} elseif ( 'system' === $timezone_name ) {
								$timezone = 'system';
							} else {
								$timezone = 'WordPress';
							}

							$date = current_time( 'm/d/Y h:i A' );
							echo' <input type="hidden" id="cp_timezone_name" class="form-control cp_timezone" value="' . esc_attr( $timezone ) . '" />';
							echo' <input type="hidden" id="cp_currenttime" class="form-control cp_currenttime" value="' . esc_attr( $date ) . '" />';

							?>
							<!-- scheduler popup -->
							<div class="cp-schedular-overlay">
								<div class="cp-scheduler-popup">
									<div class="cp-scheduler-close"> <span class="connects-icon-cross"></span> </div>
									<div class="cp-row">
										<div class="schedular-title">
											<h3>
												<?php _e( 'Schedule This Info Bar', 'smile' ); ?>
											</h3>
										</div>
									</div>
									<!-- cp-row -->
									<div class="cp-row">
										<div class="scheduler-container">
											<div class="container cp-start-time">
												<div class="col-md-6">
													<h3>
														<?php _e( 'Enter Starting Time', 'smile' ); ?>
													</h3>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<div class="input-group date">
															<input type="text" id="cp_start_time" class="form-control cp_start" value="" />
															<span class="input-group-addon"><span class="connects-icon-clock"></span></span> </div>
														</div>
													</div>
												</div>
												<div class="container cp-end-time">
													<div class="col-md-6">
														<h3>
															<?php _e( 'Enter Ending Time', 'smile' ); ?>
														</h3>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<div class="input-group date">
																<input type="text" id="cp_end_time" class="form-control cp_end" value=" "/>
																<span class="input-group-addon"><span class="connects-icon-clock"></span></span> </div>
															</div>
															<!-- form-group -->
														</div>
													</div>
													<!-- cp-end-time -->
												</div>
												<!-- scheduler-container -->
											</div>
											<!-- cp-row -->
											<div class="cp-row">
												<div class="cp-actions">
													<div class="cp-action-buttons">
														<button class="button button-primary cp-schedule-btn">
															<?php _e( 'Schedule Info Bar', 'smile' ); ?>
														</button>
														<button class="button button-primary cp-schedule-cancel" onclick="jQuery(document).trigger('dismissPopup')">
															<?php _e( 'Cancel', 'smile' ); ?>
														</button>
													</div>
												</div>
											</div>
											<!-- cp-row -->
										</div>
										<!-- .cp-schedular-popup -->
									</div>
									<!-- .cp-schedular-overlay -->
								</div>
								<!-- .wrap -->


								<style type="text/css">
								.cp-import-overlay {
									background-color: rgba(0, 0, 0, 0.8);
									width: 100%;
									height: 100%;
									position: fixed;
									top: 0;
									left: 0;
									z-index: 99999;
									display:none;
								}
								.cp-style-importer {
									display:none;
									max-width: 400px;
									background-color: #FFF;
									top: 50%;
									position: absolute;
									left: 50%;
									z-index: 999999;
									padding: 15px;
									margin-left: -200px;
									border-radius: 3px;
								}
							</style>
							<!--  cp style import -->
							<div class="cp-import-overlay"></div>
							<div class="cp-style-importer">
								<div class="cp-importer-close"> <span class="connects-icon-cross"></span> </div>
								<div class="cp-import-container">
									<div class="cp-import-info_bar">
										<div class="cp-row">
											<div class="cp-info_bar-heading">
												<h3><?php _e( 'Import Info Bar', 'smile' ); ?></h3>
											</div>
										</div>
										<div class="cp-row">
											<div class="cp-import-input">
												<input type="file" id="cp-import" />
												<button class="button button-primary"><?php _e( 'Import', 'smile' ); ?></button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<script type="text/javascript">

								jQuery(document).ready(function(){

									var colImpressions = jQuery('.column-impressions').outerHeight();

									jQuery("span.change-status").css({
										'height' : colImpressions+"px",
										'line-height' : colImpressions+"px"
									});

									var timestring = '';
									timestring = jQuery(".cp_timezone").val();

									var currenttime = '';
									if( 'system' === timestring ){
										currenttime = new Date();
									}else {
										currenttime = jQuery(".cp_currenttime").val();
									}

	//convert date to jquery date format.
	var date2 = new Date(currenttime);
	date2 = new Date(date2.getTime() + 1*60000);

	jQuery('#cp_start_time').datetimepicker({
		sideBySide: true,
		minDate: currenttime,
		icons: {
			time: 'connects-icon-clock',
			date: 'dashicons dashicons-calendar-alt',
			up: 'dashicons dashicons-arrow-up-alt2',
			down: 'dashicons dashicons-arrow-down-alt2',
			previous: 'dashicons dashicons-arrow-left-alt2',
			next: 'dashicons dashicons-arrow-right-alt2',
			today: 'dashicons dashicons-screenoptions',
			clear: 'dashicons dashicons-trash',
		},
	});

	jQuery("#cp_start_time").on("dp.change", function (e) {
		jQuery('#cp_end_time').data("DateTimePicker").minDate(e.date);
	});

	jQuery('#cp_end_time').datetimepicker({
		sideBySide: true,
		minDate: currenttime,
		icons: {
			time: 'connects-icon-clock',
			date: 'dashicons dashicons-calendar-alt',
			up: 'dashicons dashicons-arrow-up-alt2',
			down: 'dashicons dashicons-arrow-down-alt2',
			previous: 'dashicons dashicons-arrow-left-alt2',
			next: 'dashicons dashicons-arrow-right-alt2',
			today: 'dashicons dashicons-screenoptions',
			clear: 'dashicons dashicons-trash',
		},
	});

	if( jQuery('.bsf-contact-list-top-search').hasClass('bsf-cntlist-top-search-act') )  {
		jQuery('.bsf-cntlst-top-search-input').focus().trigger('click');
	}
});

								jQuery(document).on("focus",'.bsf-cntlst-top-search-input', function(){
									jQuery(".bsf-contact-list-top-search").addClass('bsf-cntlist-top-search-act');
								});

								jQuery(document).on("focusout",'.bsf-cntlst-top-search-input', function(){
									jQuery(".bsf-contact-list-top-search").removeClass('bsf-cntlist-top-search-act');
								});

								jQuery(document).on("click",".bsf-cntlst-top-search-submit", function(){
									jQuery('.bsf-cntlst-top-search').submit();
								});

								jQuery(".cp-download-infobar").click(function(e){
									e.preventDefault();
									var form = jQuery(this).parents('form');
									form.submit();
								});

							</script>
