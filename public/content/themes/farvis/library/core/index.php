<?php 
	/**  Core_Index  **/


	
	/* Load global CORE main file */
	
	require_once(get_template_directory() . '/library/core/global/index.php');

	/* Load admin CORE main file */
	
	require_once(get_template_directory() . '/library/core/admin/index.php');
	
	/* Load frontend CORE main file */
	
	require_once(get_template_directory() . '/library/core/frontend/index.php');

	/* Load theme plugins */

	require_once(get_template_directory() . '/library/modules/index.php');
	
	
			
?>