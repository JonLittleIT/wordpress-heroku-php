<?php
	add_action('admin_init','sbvcgmap_check_compatibility');
	function sbvcgmap_check_compatibility() {
		$required_vc 	= '3.9.9';
		if (defined('WPB_VC_VERSION')) {
			if (version_compare($required_vc, WPB_VC_VERSION, '>')) {
				add_action('admin_notices', 'sbvcgmap_version_notice');
			}
		} else {
			add_action('admin_notices', 'sbvcgmap_activation_notice');
		}
	}
	function sbvcgmap_version_notice() {
		echo '<div class="updated"><p>The <strong>'.SBVCGMAP_PLUGIN_NAME.'</strong> add-on requires <strong>Visual Composer</strong> version 4.0.0 or greater.</p></div>';	
	}
	function sbvcgmap_activation_notice() {
		echo '<div class="updated"><p>The <strong>'.SBVCGMAP_PLUGIN_NAME.'</strong> add-on requires the <strong>Visual Composer</strong> Plugin installed and activated.</p></div>';
	}
	
	//Including admin scripts
	add_action( 'admin_enqueue_scripts', 'sbvcgmap_admin_enqueue_scripts');
	function sbvcgmap_admin_enqueue_scripts() {
		
		wp_enqueue_style('sbvcgmap-admin-style', SBVCGMAP_PLUGIN_DIR.'/assets/css/admin.css');
		
		wp_enqueue_script('jquery');
		
		wp_register_script('sbvcgmap-googlemapapi', (is_ssl() ? 'https://' :'http://').'maps.googleapis.com/maps/api/js?v=3.exp&libraries=places,weather,panoramio', array(), '', true);
		wp_enqueue_script('sbvcgmap-googlemapapi');
		
		wp_register_script('sbvcgmap-admin', SBVCGMAP_PLUGIN_DIR.'/assets/js/admin.js', array(), SBVCGMAP_PLUGIN_VERSION, true);
		wp_enqueue_script('sbvcgmap-admin');
	}
	
	
	if(!class_exists('sbvcgmap_google_map')) {
		class sbvcgmap_google_map {
			function __construct() {
				add_action('admin_init',array($this,'sbvcgmap_init'));
				//add_shortcode('sbvcgmap','sbvcgmap_shortcode');
			}
			
			function sbvcgmap_init(){
		
				if(function_exists('vc_map')){
	
					vc_map( array(		
						"name" 						=> __(SBVCGMAP_PLUGIN_NAME,'js_composer'),		
						"base" 						=> 'sbvcgmap',		
						"icon" 						=> SBVCGMAP_PLUGIN_DIR.'/assets/img/vc-icon.png',
						"category" 					=> __('Google Map','js_composer'),
						"content_element"			=> true,
						"show_settings_on_create" 	=> true,
						"as_parent" 				=> array ('only' => 'sbvcgmap_marker'),
						"description" 				=> __( 'Add Google Map','js_composer' ),
						"js_view" 					=> 'VcColumnView',
						"params" 					=> array (
							array (
								'type'			=> 'textfield',
								'heading' 		=> __( 'Title', 'js_composer' ),
								'param_name' 	=> 'sbvcgmap_title',
								'holder'		=> 'div',
								'description' 	=> __( 'Enter map title. This is optional field.', 'js_composer' )
							),
							array (
								'type'			=> 'textfield',
								'heading' 		=> __( 'API Key', 'js_composer' ),
								'param_name' 	=> 'sbvcgmap_apikey',
								'description' 	=> __( '<a target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true">Click here</a> to generate API key. For more details <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">click here</a>.', 'js_composer' )
							),
							array(
								'type' 			=> 'sbvcgmap_num',
								'heading' 		=> __( 'Width', 'js_composer' ),
								'param_name' 	=> 'map_width',
								'value' 		=> 100,
								'min' 			=> 0,
								'max' 			=> '',
								'suffix' 		=> '',
								'step' 			=> 1,
								'description' 	=> __( 'Set map width.', 'js_composer' )
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Width Type', 'js_composer' ),
								'param_name' 	=> 'width_type',
								'description' 	=> __( 'Select map width type.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_size_types(),
								'std' 			=> '%'
							),
							array(
								'type' 			=> 'sbvcgmap_num',
								'heading' 		=> __( 'Height', 'js_composer' ),
								'param_name' 	=> 'map_height',
								'value' 		=> 400,
								'min' 			=> 0,
								'max' 			=> '',
								'suffix' 		=> '',
								'step' 			=> 1,
								'description' 	=> __( 'Set map height.', 'js_composer' )
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Height Type', 'js_composer' ),
								'param_name' 	=> 'height_type',
								'description' 	=> __( 'Select map height type.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_size_types()
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Map Styles', 'js_composer' ),
								'param_name' 	=> 'mapstyles',
								'description' 	=> __( 'Select map style. <a href="http://plugins.sbthemes.com/responsive-google-maps-vc-addon/map-styles/all-styles/" target="_blank">Click Here</a> to view all styles.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_map_styles()
							),
							array (
								'type' 			=> 'sbvcgmap_autocomplete',
								'heading' 		=> __( 'Center of Map', 'js_composer' ),
								'param_name' 	=> 'centerpoint',
								'description' 	=> __( 'Optional! Address or (latitude, longitude). Leave blank to auto center.', 'js_composer' ),
								'group' 		=> __('Zoom', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Zoom Level', 'js_composer' ),
								'param_name' 	=> 'zoom',
								'description' 	=> __( 'Set zoom level. You can set any numerical value from <strong>1 to 21</strong>.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_zoom_levels(),
								'std'			=>	14,
								'group' 		=> __('Zoom', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Enable Zoom Control', 'js_composer' ),
								'param_name' 	=> 'zoomcontrol',
								'description' 	=> __( 'Displays a slider (for large maps) or small "+/-" buttons', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'group' 		=> __('Zoom', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Zoom Control Position', 'js_composer' ),
								'param_name' 	=> 'zoomcontrol_position',
								'description' 	=> __( 'Select zoom control position.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_positions(),
								'std'			=>	'TOP_LEFT',
								'group' 		=> __('Zoom', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Zoom Style', 'js_composer' ),
								'param_name' 	=> 'zoomcontrolstyle',
								'description' 	=> __( 'Select zoom control style.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_zoom_styles(),
								'std'			=>	'DEFAULT',
								'group' 		=> __('Zoom', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Draggable', 'js_composer' ),
								'param_name' 	=> 'draggable',
								'description' 	=> __( 'If yes, map will be draggable by mouse.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'yes',
								'group' 		=> __('Zoom', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Scroll Wheel', 'js_composer' ),
								'param_name' 	=> 'scrollwheel',
								'description' 	=> __( 'If yes, zoom level will be changed by mouse scroll wheel.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'yes',
								'group' 		=> __('Zoom', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Pan Control', 'js_composer' ),
								'param_name' 	=> 'pancontrol',
								'description' 	=> __( 'Displays buttons for panning the map.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'yes',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Pan Control Position', 'js_composer' ),
								'param_name' 	=> 'pancontrol_position',
								'description' 	=> __( 'Pan control buttons position.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_positions(),
								'std'			=>	'TOP_LEFT',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Scale Control', 'js_composer' ),
								'param_name' 	=> 'scalecontrol',
								'description' 	=> __( 'Displays a map scale element.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'yes',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Street View Control', 'js_composer' ),
								'param_name' 	=> 'streetviewcontrol',
								'description' 	=> __( 'Displays a Pegman icon to enable street view.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'yes',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Street View Control Position', 'js_composer' ),
								'param_name' 	=> 'streetviewcontrol_position',
								'description' 	=> __( 'Pegman icon (street view control) position.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_positions(),
								'std'			=>	'TOP_LEFT',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Map Type Control', 'js_composer' ),
								'param_name' 	=> 'maptypecontrol',
								'description' 	=> __( 'Displays a map type control.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'yes',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Map Type Control Position', 'js_composer' ),
								'param_name' 	=> 'maptypecontrol_position',
								'description' 	=> __( 'Map type control position.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_positions(),
								'std'			=>	'TOP_RIGHT',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Map Type', 'js_composer' ),
								'param_name' 	=> 'maptype',
								'description' 	=> __( 'Toggle between map types. For <strong>STREETVIEW</strong>, you must have to set <strong>Center of Map</strong> field in Zoom Settings Tab.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_map_types(),
								'std'			=>	'ROADMAP',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Enable Street View Toggle Button', 'js_composer' ),
								'param_name' 	=> 'panoramatogglebutton',
								'description' 	=> __( 'Select yes to enable street view toggle button. To enable this feature, you must have to set <strong>Center of Map</strong> field in Zoom Settings Tab.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Map Type Control Style', 'js_composer' ),
								'param_name' 	=> 'maptypecontrolstyle',
								'description' 	=> __( 'Choose map type control style.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_map_type_styles(),
								'std'			=>	'DEFAULT',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Overview Map Control Visible', 'js_composer' ),
								'param_name' 	=> 'overviewmapcontrolvisible',
								'description' 	=> __( 'Displays a thumbnail overview map reflecting the current map viewport.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Overview Map Control', 'js_composer' ),
								'param_name' 	=> 'overviewmapcontrol',
								'description' 	=> __( 'Displays a toggle button to show / hide overview map control (bottom right).', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'yes',
								'group' 		=> __('Controls', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Search Type', 'js_composer' ),
								'param_name' 	=> 'searchtype',
								'description' 	=> __( 'Nearest search query. Select Disabled to turn off this feature. <a target="_blank" href="https://developers.google.com/places/supported_types">Click Here</a> to see supported search query.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_search_types(),
								'std'			=>	'disabled',
								'group' 		=> __('Nearest Places', 'js_composer')
							),
							array(
								'type' 			=> 'sbvcgmap_num',
								'heading' 		=> __( 'Search Radius', 'js_composer' ),
								'param_name' 	=> 'searchradius',
								'value' 		=> 500,
								'min' 			=> 0,
								'max' 			=> 50000,
								'suffix' 		=> '',
								'step' 			=> 1,
								'description' 	=> __( 'Search area radius in meters. Radius calculates from center of map. Maximum allowed radius is 50000.', 'js_composer' ),
								'group' 		=> __('Nearest Places', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Icon Animation', 'js_composer' ),
								'param_name' 	=> 'searchiconanimation',
								'description' 	=> __( 'Seach result icon animation.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_marker_animations(),
								'std'			=>	'NONE',
								'group' 		=> __('Nearest Places', 'js_composer')
							),
							array (
								'type'			=> 'textfield',
								'heading' 		=> __( 'Text for Direction Link', 'js_composer' ),
								'param_name' 	=> 'searchdirectiontext',
								'description' 	=> __( 'Direction link text for search result marker. Leave blank to hide link.', 'js_composer' ),
								'value' 		=> '',
								'group' 		=> __('Nearest Places', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Weather', 'js_composer' ),
								'param_name' 	=> 'weather',
								'description' 	=> __( 'Weather layer add weather forecasts to map.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no',
								'group' 		=> __('Map Layers', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Traffic', 'js_composer' ),
								'param_name' 	=> 'traffic',
								'description' 	=> __( 'Traffic layer add real-time traffic information to map.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no',
								'group' 		=> __('Map Layers', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Transit', 'js_composer' ),
								'param_name' 	=> 'transit',
								'description' 	=> __( 'Transit layer add public transit network of a city to map.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no',
								'group' 		=> __('Map Layers', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Bicycle', 'js_composer' ),
								'param_name' 	=> 'bicycle',
								'description' 	=> __( 'Bicycle layer add bicycle information (bike routes) to map.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no',
								'group' 		=> __('Map Layers', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Panoramio', 'js_composer' ),
								'param_name' 	=> 'panoramio',
								'description' 	=> __( 'Panoramio layer add community contributed photos to map.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no',
								'group' 		=> __('Map Layers', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Reload on resize', 'js_composer' ),
								'param_name' 	=> 'reloadonresize',
								'description' 	=> __( 'If yes, map will be reload on screen resize.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no',
								'group' 		=> __('Miscellaneous', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Language', 'js_composer' ),
								'param_name' 	=> 'language',
								'description' 	=> __( 'Localize your map.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_map_languages(),
								'std'			=>	'en',
								'group' 		=> __('Miscellaneous', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Clustering', 'js_composer' ),
								'param_name' 	=> 'clustering',
								'description' 	=> __( 'Enable this if you have 100ths of markers. It will improve speed for too many markers.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no',
								'group' 		=> __('Miscellaneous', 'js_composer')
							),
							array(
								'type' 			=> 'checkbox',
								'value'			=> array(__( 'Enable Full Screen Button', 'js_composer' ) => 'yes'),
								'heading' 		=> __( '', 'js_composer' ),
								'param_name' 	=> 'fullscreenbutton',
								'description' 	=> __( 'Check this box to enable full screen toggle button in your map.', 'js_composer' ),
								'group' 		=> __('Miscellaneous', 'js_composer')
							),
							array(
								'type' 			=> 'textfield',
								'heading' 		=> __( 'Expand Button Text', 'js_composer' ),
								'param_name' 	=> 'expandmaptext',
								'value'			=> 'Expand Map',
								'description' 	=> __( 'Add text for expand button.', 'js_composer' ),
								'dependency'	=> array('element' => 'fullscreenbutton', 'value' => 'yes'),
								'group' 		=> __('Miscellaneous', 'js_composer')
							),
							array(
								'type' 			=> 'textfield',
								'heading' 		=> __( 'Collapse Button Text', 'js_composer' ),
								'param_name' 	=> 'collapsemaptext',
								'value'			=> 'Collapse Map',
								'description' 	=> __( 'Add text for collapse button.', 'js_composer' ),
								'dependency'	=> array('element' => 'fullscreenbutton', 'value' => 'yes'),
								'group' 		=> __('Miscellaneous', 'js_composer')
							)
							
						)
					) );
					
					vc_map( array(		
						"name" 			=> __('Map Marker','js_composer'),		
						"base" 			=> 'sbvcgmap_marker',		
						"icon" 			=> SBVCGMAP_PLUGIN_DIR.'/assets/img/marker-icon.png',
						"category" 		=> __('Google Map','js_composer'),
						"as_child" 		=> array('only' => 'sbvcgmap'),
						"description" 	=> __( 'Add New Marker','js_composer' ),
						"params" 		=> array(
							array(
								'type' 			=> 'sbvcgmap_autocomplete',
								'heading' 		=> __( 'Address or (Latitude, Longitude)', 'js_composer' ),
								'param_name' 	=> 'address',
								'holder'		=> 'div',
								'target'		=> '.lat_lng_address',
								'description' 	=> __( 'Add location address or (Latitude, Longitude). For Latitude and Longitude use comma for separator.', 'js_composer' )
							),
							array(
								'type' 			=> 'sbvcgmap_hidden',
								'param_name' 	=> 'lat_lng_address',
								'class'			=> 'lat_lng_address'
							),
							array(
								'type' 			=> 'textfield',
								'heading' 		=> __( 'Text for Directions Link', 'js_composer' ),
								'param_name' 	=> 'textfordirectionslink',
								'value'			=> '',
								'description' 	=> __( 'Text for Directions Link. Leave blank to remove direction link from info window.', 'js_composer' )
							),
							array(
								'type' 			=> 'attach_image',
								'heading' 		=> __( 'Marker Icon', 'js_composer' ),
								'param_name' 	=> 'icon',
								'description' 	=> __( 'Upload marker pin icon. You can find stunning icons here: <a target="_blank" href="http://medialoot.com/item/free-vector-map-location-pins">Download Icons</a>', 'js_composer' )
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Icon Animation', 'js_composer' ),
								'param_name' 	=> 'animation',
								'description' 	=> __( 'Select marker animation.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_marker_animations(),
								'std'			=>	'NONE'
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Default Open Info Window', 'js_composer' ),
								'param_name' 	=> 'infowindow',
								'description' 	=> __( 'If yes, marker info window will be opened by default..', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no'
							),
							array(
								'type' 			=> 'textarea_html',
								'heading' 		=> __( 'Marker Content', 'js_composer' ),
								'param_name' 	=> 'content',
								'description' 	=> __( 'Use any Text or HTML for marker content. You can also use shortcodes. Some JS based shortcodes should not work.', 'js_composer' )
							),
							array(
								'type' 			=> 'checkbox',
								'value'			=> array(__( 'Enable custom styles', 'js_composer' ) => 'yes'),
								'heading' 		=> __( '', 'js_composer' ),
								'param_name' 	=> 'customstyles',
								'description' 	=> __( 'Check this box to enable custom styles.', 'js_composer' ),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array(
								'type' 			=> 'colorpicker',
								'heading' 		=> __( 'Select Background Color', 'js_composer' ),
								'param_name' 	=> 'csbgcolor',
								'description' 	=> __( 'Background color for info window.', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array(
								'type' 			=> 'attach_image',
								'heading' 		=> __( 'Select Background Image', 'js_composer' ),
								'param_name' 	=> 'csbgimage',
								'description' 	=> __( 'Background image for info window.', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Background Image Repeat', 'js_composer' ),
								'param_name' 	=> 'csbgrepeat',
								'description' 	=> __( 'Set yes to repeat info window background image.', 'js_composer' ),
								'value' 		=> sbvcgmap_toggle_button(),
								'std'			=>	'no',
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array (
								'type' 			=> 'sbvcgmap_num',
								'heading' 		=> __( 'Width', 'js_composer' ),
								'param_name' 	=> 'cswidth',
								'value' 		=> 300,
								'min' 			=> 0,
								'max' 			=> '',
								'suffix' 		=> '',
								'step' 			=> 1,
								'description' 	=> __( 'Info window width in pixels.', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array (
								'type' 			=> 'sbvcgmap_num',
								'heading' 		=> __( 'Padding', 'js_composer' ),
								'param_name' 	=> 'cspadding',
								'value' 		=> 20,
								'min' 			=> 0,
								'max' 			=> '',
								'suffix' 		=> '',
								'step' 			=> 1,
								'description' 	=> __( 'Info window padding in pixels.', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array (
								'type' 			=> 'sbvcgmap_num',
								'heading' 		=> __( 'Border Radius', 'js_composer' ),
								'param_name' 	=> 'csborderradius',
								'value' 		=> 0,
								'min' 			=> 0,
								'max' 			=> '',
								'suffix' 		=> '',
								'step' 			=> 1,
								'description' 	=> __( 'Info window border radius in pixels.', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array (
								'type' 			=> 'sbvcgmap_num',
								'heading' 		=> __( 'Border Width', 'js_composer' ),
								'param_name' 	=> 'csborderwidth',
								'value' 		=> 0,
								'min' 			=> 0,
								'max' 			=> '',
								'suffix' 		=> '',
								'step' 			=> 1,
								'description' 	=> __( 'Info window border width in pixels.', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array (
								'type' 			=> 'dropdown',
								'heading' 		=> __( 'Border Style', 'js_composer' ),
								'param_name' 	=> 'csborderstyle',
								'description' 	=> __( 'Select border style.', 'js_composer' ),
								'value' 		=> sbvcgmap_get_border_types(),
								'std' 			=> 'solid',
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array(
								'type' 			=> 'colorpicker',
								'heading' 		=> __( 'Select Border Color', 'js_composer' ),
								'param_name' 	=> 'csbordercolor',
								'description' 	=> __( 'Info window border color.', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array(
								'type' 			=> 'textfield',
								'heading' 		=> __( 'Box Shadow', 'js_composer' ),
								'param_name' 	=> 'csboxshadow',
								'value'			=> '',
								'description' 	=> __( 'Use valid css box shadow property value here. <strong>Eg. 0 0 1px #000</strong>', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array(
								'type' 			=> 'attach_image',
								'heading' 		=> __( 'Select Close Image Icon', 'js_composer' ),
								'param_name' 	=> 'cscloseimage',
								'description' 	=> __( 'Custom close image icon for info window.', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array(
								'type' 			=> 'sbvcgmap_num',
								'heading' 		=> __( 'Info Window Horizontal(X) Position (Advance Option)', 'js_composer' ),
								'param_name' 	=> 'csxposition',
								'value' 		=> '',
								'min' 			=> '',
								'max' 			=> '',
								'suffix' 		=> '',
								'step' 			=> 1,
								'description' 	=> __( 'Leave empty for default. Info window horizontal(X) position in pixels. Use any positive or negative integer value.', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							),
							array(
								'type' 			=> 'sbvcgmap_num',
								'heading' 		=> __( 'Info Window Vertical(Y) Position (Advance Option)', 'js_composer' ),
								'param_name' 	=> 'csyposition',
								'value' 		=> '',
								'min' 			=> '',
								'max' 			=> '',
								'suffix' 		=> '',
								'step' 			=> 1,
								'description' 	=> __( 'Leave empty for default. Info window vertical(Y) position in pixels. Use any positive or negative integer value.', 'js_composer' ),
								'dependency'	=> array('element' => 'customstyles', 'value' => 'yes'),
								'group' 		=> __('Custom Styles', 'js_composer')
							)
						)
					));
				}
			}
			
		}
		
		
		//instantiate the class
		$sbvcgmap_google_map = new sbvcgmap_google_map;
	}
	
	add_action('admin_init','sbvcgmap_extends');
	function sbvcgmap_extends(){
		if (class_exists('WPBakeryShortCodesContainer')) {
			class WPBakeryShortCode_Sbvcgmap extends WPBakeryShortCodesContainer {
			}
		}
	}