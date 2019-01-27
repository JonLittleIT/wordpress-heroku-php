<?php


@define(SBVCGMAP_PLUGIN_VERSION, '1.6');													//Plugin Version

@define(SBVCGMAP_PLUGIN_NAME, 'SB Responsive Google Maps');					//Plugin Name

@define(SBVCGMAP_PLUGIN_DIR, trim(plugin_dir_url(__FILE__), '/'));							//Plugin Dir

@define(SBVCGMAP_PLUGIN_PATH, trim(plugin_dir_path(__FILE__), '/'));						//Plugin Path



//Including all common functions

include('inc/functions.php');



//Including admin panel

include('admin/admin-panel.php');



//Including shortcodes

include('shortcodes.php');







