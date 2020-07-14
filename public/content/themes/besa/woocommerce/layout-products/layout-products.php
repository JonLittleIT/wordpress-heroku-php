<?php 

	if( explode('-', $product_style)[0] !== 'vertical' ) {
		$product_style = 'inner-'. $product_style;
	}

	$flash_sales 		= isset($flash_sales) ? $flash_sales : false;
	$end_date 			= isset($end_date) ? $end_date : '';

	$countdown_title 	= isset($countdown_title) ? $countdown_title : '';
	$countdown 			= isset($countdown) ? $countdown : false;

?>
<div <?php echo trim($attr_row); ?>>

    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <div class="item">
          <?php wc_get_template( 'item-product/'. $product_style .'.php', array('flash_sales' => $flash_sales, 'end_date' => $end_date, 'countdown_title' => $countdown_title, 'countdown' => $countdown, 'product_style' => $product_style ) ); ?>
        </div>

    <?php endwhile; ?> 
</div>

<?php wp_reset_postdata(); ?>