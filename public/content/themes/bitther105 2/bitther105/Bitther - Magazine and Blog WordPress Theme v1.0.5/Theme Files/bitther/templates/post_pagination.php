<div class="entry_pagination">
	<div class="post-pagination pagination clearfix">
		<?php
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		?>
		<?php if (!empty( $prev_post )) : ?>
			<a class="page-numbers pull-left page-prev" title="<?php esc_attr('Prev post')?>" href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>">
				<span class="btn_pri btn-prev btn_nav_post"><i class="ti-angle-left"></i><?php esc_html_e('Previous Post','bitther')?></span>
				<p class="title-pagination"><?php echo esc_attr($prev_post->post_title); ?></p>
			</a>
		<?php endif; ?>
		<?php if (!empty( $next_post )) : ?>
			<a class="page-numbers pull-right page-next" title="<?php esc_attr('Next post')?>" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>">
				<span class="btn_pri btn-next btn_nav_post"><?php esc_html_e('Next Post','bitther')?><i class="ti-angle-right" aria-hidden="true"></i></span>
				<p class="title-pagination"><?php echo esc_attr($next_post->post_title); ?></p>
			</a>
		<?php endif; ?>

	</div>
</div>