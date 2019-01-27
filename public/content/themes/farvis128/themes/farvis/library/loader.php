<?php

    /* Define library path */

    /* Load CORE main file */
    require_once(get_template_directory() . '/library/core/index.php');

    /* Load THEME main file */
    require_once(get_template_directory() . '/library/theme/index.php');

	global $vc_manager;
	if ($vc_manager && class_exists('TmplCustom')){
		require_once($vc_manager->getShortcodesTemplateDir('vc_maps/index.php'));	
	}
		
    

    /* Load Plugins */
    require_once(get_template_directory() . '/library/plugins.php');
    require_once(get_template_directory() . '/library/theme/activation.php');

?>
