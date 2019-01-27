<?php
/* PAGE HEADER BACKGROUND */

if($tab_bg_color != '' && $tab_bg_color_gradient != ''){
	$gradient_direction = $tab_gradient_direction == '' ? 'to right' : $tab_gradient_direction;
	//$gradient_angle = $tab_bg_color_gradient == '' ? '90' : $tab_bg_color_gradient;
	$pix_directions_arr = array(
		'to right' => array('-webkit' => 'left', '-o-linear' => 'right', '-moz-linear' => 'right', 'linear' => 'to right',),
		'to left' => array('-webkit' => 'right', '-o-linear' => 'left', '-moz-linear' => 'left', 'linear' => 'to left',),
		'to bottom' => array('-webkit' => 'top', '-o-linear' => 'bottom', '-moz-linear' => 'bottom', 'linear' => 'to bottom',),
		'to top' => array('-webkit' => 'bottom', '-o-linear' => 'top', '-moz-linear' => 'top', 'linear' => 'to top',),
		'to bottom right' => array('-webkit' => 'left top', '-o-linear' => 'bottom right', '-moz-linear' => 'bottom right', 'linear' => 'to bottom right',),
		'to bottom left' => array('-webkit' => 'right top', '-o-linear' => 'bottom left', '-moz-linear' => 'bottom left', 'linear' => 'to bottom left',),
		'to top right' => array('-webkit' => 'left bottom', '-o-linear' => 'top right', '-moz-linear' => 'top right', 'linear' => 'to top right',),
		'to top left' => array('-webkit' => 'right bottom', '-o-linear' => 'top left', '-moz-linear' => 'top left', 'linear' => 'to top left',),
		//'angle' => array('-webkit' => $gradient_angle.'deg', '-o-linear' => $gradient_angle.'deg', '-moz-linear' => $gradient_angle.'deg', 'linear' => $gradient_angle.'deg',),
	);

	$pix_gradient = ', '.$tab_bg_color.','.$tab_bg_color_gradient;

	?>

	html .header-section span.vc_row-overlay{
		background: <?php echo esc_attr($tab_bg_color)?>; /* For browsers that do not support gradients */
		background: -webkit-linear-gradient(<?php echo esc_attr($pix_directions_arr[$gradient_direction]['-webkit'].$pix_gradient)?>); /*Safari 5.1-6*/
		background: -o-linear-gradient(<?php echo esc_attr($pix_directions_arr[$gradient_direction]['-o-linear'].$pix_gradient)?>); /*Opera 11.1-12*/
		background: -moz-linear-gradient(<?php echo esc_attr($pix_directions_arr[$gradient_direction]['-moz-linear'].$pix_gradient)?>); /*Fx 3.6-15*/
		background: linear-gradient(<?php echo esc_attr($pix_directions_arr[$gradient_direction]['linear'].$pix_gradient)?>); /*Standard*/
		opacity: <?php echo esc_attr($tab_bg_opacity)?>;
	}

	<?php
} else {
?>
html .header-section span.vc_row-overlay{
	background-color: <?php echo esc_attr($tab_bg_color); ?> !important;
	opacity: <?php echo esc_attr($tab_bg_opacity)?>;
}
<?php
}
?>

html .header-section{
	padding: <?php echo esc_attr($tab_padding_top)?>px 0 <?php echo esc_attr($tab_padding_bottom)?>px;
	margin-bottom: <?php echo esc_attr($tab_margin_bottom)?>px;
    border-bottom: <?php if($tab_border) : ?> 6px solid <?php echo esc_attr($farvis_main_color) ?><?php else : ?> none <?php endif; ?>;
    <?php if($tab_bg_image_fixed) : ?>
    background-attachment: fixed;
    <?php endif; ?>
}


html  .page-decor{
	top: -<?php echo esc_attr($tab_margin_bottom)?>px;
}