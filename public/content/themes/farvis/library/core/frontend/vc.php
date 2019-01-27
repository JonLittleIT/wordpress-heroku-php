<?php

function farvis_vc_map($params, $cssAnimation = array(), $icons = false, $order=0) {
    $baseParams = $params['params'];
    $param1 = $param2 = array();
    if($order > 0 && $order <= count($baseParams)){
        $i=0;
        foreach($baseParams as $key => $val){
            $i++;
            if($i<$order)
                $param1[] = $val;
            elseif($i>=$order)
                $param2[] = $val;
        }
    }
    if (!$icons) {
        if (empty($cssAnimation)) {
            $vcParams = $baseParams;
        } else {
            $vcParams = array_merge($baseParams, $cssAnimation);
        }
    } else {
        if($order > 0 && $order <= count($baseParams))
            $vcParams = array_merge($param1, $icons, $param2, $cssAnimation);
        else
            $vcParams = array_merge($baseParams, $icons, $cssAnimation);
    }
    $params['params'] = $vcParams;
    vc_map($params);
}



add_action( 'vc_before_init', 'farvis_integrateWithVC', 200 );

function farvis_integrateWithVC() {


    //////////////////////////////////////////////////////////////////////

	if(isset($_GET['vc_action']) && $_GET['vc_action'] == 'vc_inline'){
		wp_enqueue_style('farvis-theme', get_stylesheet_directory_uri() . '/css/editor_styles.css');
	}

	return true;

}

?>
