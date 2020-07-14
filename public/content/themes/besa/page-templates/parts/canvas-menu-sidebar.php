<?php 

$sidebar_id = 'canvas-menu';
	
if( !is_active_sidebar($sidebar_id) ) return;

?>

<div class="canvas-menu-sidebar">
	<a href="javascript:void(0);" class="btn-canvas-menu"><?php echo apply_filters( 'besa_get_icon_canvas_menu', '<i class="tb-icon tb-icon-text-align-right"></i>'); ?></a>
</div>

