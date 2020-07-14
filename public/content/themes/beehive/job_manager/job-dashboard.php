<?php
/**
 * Job dashboard shortcode content.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-dashboard.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.34.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div id="job-manager-job-dashboard">
	<table class="job-manager-jobs">
		<thead>
			<tr>
				<?php foreach ( $job_dashboard_columns as $key => $column ) : ?>
					<th class="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $column ); ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php if ( ! $jobs ) : ?>
				<tr>
					<td colspan="<?php echo intval( count( $job_dashboard_columns ) ); ?>"><?php esc_html_e( 'You do not have any active listings.', 'wp-job-manager' ); ?></td>
				</tr>
			<?php else : ?>
				<?php foreach ( $jobs as $job ) : ?>
					<tr>
						<?php foreach ( $job_dashboard_columns as $key => $column ) : ?>
							<td class="<?php echo esc_attr( $key ); ?>">
								<?php if ( 'job_title' === $key ) : ?>
									<?php if ( $job->post_status == 'publish' ) : ?>
										<a href="<?php echo esc_url( get_permalink( $job->ID ) ); ?>" class="job-title<?php echo ( is_position_featured( $job ) ) ? esc_attr( ' color-primary' ) : ''; ?>">
											<?php wpjm_the_job_title( $job ); ?>
										</a>
									<?php else : ?>
										<strong><?php wpjm_the_job_title( $job ); ?></strong> <small>(<?php the_job_status( $job ); ?>)</small>
									<?php endif; ?>
									<a href="#" class="dropdown-actions action-icon" id="actions_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="uil-ellipsis-v"></i>
									</a>
									<div class="dropdown-menu" aria-labelledby="actions_dropdown">
										<ul class="job-dashboard-actions">
										<?php
											$actions = array();

										switch ( $job->post_status ) {
											case 'publish':
												if ( WP_Job_Manager_Post_Types::job_is_editable( $job->ID ) ) {
													$actions['edit'] = array(
														'label' => esc_html__( 'Edit', 'wp-job-manager' ),
														'nonce' => false,
													);
												}
												if ( is_position_filled( $job ) ) {
													$actions['mark_not_filled'] = array(
														'label' => esc_html__( 'Mark not filled', 'wp-job-manager' ),
														'nonce' => true,
													);
												} else {
													$actions['mark_filled'] = array(
														'label' => esc_html__( 'Mark filled', 'wp-job-manager' ),
														'nonce' => true,
													);
												}

												$actions['duplicate'] = array(
													'label' => esc_html__( 'Duplicate', 'wp-job-manager' ),
													'nonce' => true,
												);
												break;
											case 'expired':
												if ( job_manager_get_permalink( 'submit_job_form' ) ) {
													$actions['relist'] = array(
														'label' => esc_html__( 'Relist', 'wp-job-manager' ),
														'nonce' => true,
													);
												}
												break;
											case 'pending_payment':
											case 'pending':
												if ( WP_Job_Manager_Post_Types::job_is_editable( $job->ID ) ) {
													$actions['edit'] = array(
														'label' => esc_html__( 'Edit', 'wp-job-manager' ),
														'nonce' => false,
													);
												}
												break;
											case 'draft':
											case 'preview':
												$actions['continue'] = array(
													'label' => esc_html__( 'Continue Submission', 'wp-job-manager' ),
													'nonce' => true,
												);
												break;
										}

											$actions['delete'] = array(
												'label' => esc_html__( 'Delete', 'wp-job-manager' ),
												'nonce' => true,
											);
											$actions           = apply_filters( 'job_manager_my_job_actions', $actions, $job );

											foreach ( $actions as $action => $value ) { // @codingStandardsIgnoreLine
												$action_url = add_query_arg(
													array(
														'action' => $action,
														'job_id' => $job->ID,
													)
												);
												if ( $value['nonce'] ) {
													$action_url = wp_nonce_url( $action_url, 'job_manager_my_job_actions' );
												}
												echo '<li><a href="' . esc_url( $action_url ) . '" class="job-dashboard-action-' . esc_attr( $action ) . '">' . esc_html( $value['label'] ) . '</a></li>';
											}
											?>
										</ul>
									</div>
								<?php elseif ( 'date' === $key ) : ?>
									<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $job->post_date ) ) ); ?>
								<?php elseif ( 'expires' === $key ) : ?>
									<?php echo esc_html( $job->_job_expires ? date_i18n( get_option( 'date_format' ), strtotime( $job->_job_expires ) ) : '&ndash;' ); ?>
								<?php elseif ( 'filled' === $key ) : ?>
									<?php echo is_position_filled( $job ) ? '<i class="uil-check-circle"></i>' : '&ndash;'; ?>
								<?php else : ?>
									<?php do_action( 'job_manager_job_dashboard_column_' . $key, $job ); ?>
								<?php endif; ?>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<?php get_job_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
</div>
