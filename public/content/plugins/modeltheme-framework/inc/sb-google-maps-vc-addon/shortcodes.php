<?php
	//Enable Shortcode For Widget
	add_filter('widget_text', 'do_shortcode');
	
	
	function sbvcgmap_generate_google_map_markers($atts, $marker_content = NULL) {
		extract(shortcode_atts( array(
			'address' 						=>	'',
			'lat_lng_address'				=>	'',
			'textfordirectionslink'			=>	'',
			'icon'							=>	'',
			'animation'						=>	'NONE',
			'infowindow'					=>	'no',
			
			'customstyles'					=>	'no',
			
			'csbgcolor'						=>	'',
			'csbgimage'						=>	'',
			'csbgrepeat'					=>	'no',
			
			'cswidth'						=>	300,
			'cspadding'						=>	20,
			'csborderradius'				=>	0,
			'csboxshadow'					=>	'',
			
			'csborderwidth'					=>	'0',
			'csborderstyle'					=>	'solid',
			'csbordercolor'					=>	'',
			
			'cscloseimage'					=>	'',
			
			'csxposition'					=>	'',
			'csyposition'					=>	-50
		), $atts ));
		
		$infowindow 			=	sbvcgmap_lower_trim($infowindow);
		
		if(empty($customstyles)) {
			$customstyles = 'no';
		}
		$latitude = $longitude = '';
		if($lat_lng_address != '') {
			list($latitude, $longitude) = sscanf("$lat_lng_address", "%f,%f");
		}
		if($latitude == '' || $longitude == '') {
			if($address != '') {
				list($latitude, $longitude) = sscanf("$address", "%f,%f");
				if($latitude == '' || $longitude == '') {
					$location = json_decode(sbvcgmap_get_lat_lng_from_address($address));		//Get latitude, longitude from geocode api
					if(strtoupper($location->status) == 'OK') {
						$latitude = $location->results[0]->geometry->location->lat;
						$longitude = $location->results[0]->geometry->location->lng;
					}
				}
			}
		}
		
		$output = '';
		if($latitude != '' && $longitude != '') {
			$output .= '<div class="sbvcgmap-marker"';
			$output .= ' data-lat="'.$latitude.'" data-lng="'.$longitude.'" infowindow="'.$infowindow.'"';
			if(trim($icon) != '') {
				$icon = wp_get_attachment_url($icon);
				$output .= ' icon="'.$icon.'"';
			}
			$output .= ' animation="'.sbvcgmap_upper_trim($animation).'"';
			
			$output .= ' customstyles="'.$customstyles.'"';
			
			if($customstyles == 'yes') {
				$csbg = '';
				if(trim($csbgimage) != '') {
					$csbgimage = wp_get_attachment_url($csbgimage);
					$csbgrepeat = sbvcgmap_lower_trim($csbgrepeat);
					if($csbgrepeat == 'no') {
						$csbgrepeat = 'no-repeat';
					} else {
						$csbgrepeat = 'repeat';
					}
					$csbg .= 'url('.$csbgimage.') '.$csbgrepeat.' ';
				}
				if(trim($csbgcolor) == '') {
					$csbgcolor = 'transparent';
				}
				$csbg .= $csbgcolor;
				
				$output .= ' csbg="'.$csbg.'"';
				
				$output .= ' cswidth="'.$cswidth.'px"';
				$output .= ' cspadding="'.$cspadding.'px"';
				$output .= ' csborderradius="'.$csborderradius.'px"';
				$output .= ' csboxshadow="'.$csboxshadow.'"';
				
				$csborder = $csborderwidth.'px '.$csborderstyle.' '.$csbordercolor;
				$output .= ' csborder="'.$csborder.'"';
				
				
				$csclosemargin = -(int)$cspadding + 10;
				$csclosemargin = $csclosemargin.'px '.$csclosemargin.'px 0 0';
				
				$output .= ' csclosemargin="'.$csclosemargin.'"';
				
				if(trim($cscloseimage) != '') {
					$cscloseimage = wp_get_attachment_url($cscloseimage);
				} else {
					$cscloseimage = SBVCGMAP_PLUGIN_DIR.'/assets/img/close.gif';
				}
				
				$output .= ' cscloseimage="'.$cscloseimage.'"';
				
				if($cswidth != '') {
					$autocsxposition = -abs(intval($cswidth)) / 2;
				} else {
					$autocsxposition = 0;
				}
				
				if(trim($csxposition) == '') {
					$csxposition = $autocsxposition;
				}
				$output .= ' csxposition="'.intval($csxposition).'"';
				$output .= ' csyposition="'.intval($csyposition).'"';
			}
			
			$output .= ' >';
			
			$output .= do_shortcode($marker_content);
			if(trim($textfordirectionslink) != '') {
				$output .= '<br /><a target="_blank" href="https://maps.google.com/?daddr='.$latitude.','.$longitude.'">'.$textfordirectionslink.'</a>';
			}
			$output .= '</div>';
		}
		return $output;
	}
	add_shortcode('SBVCGMAP_MARKERS', 'sbvcgmap_generate_google_map_markers');
	add_shortcode('sbvcgmap_marker', 'sbvcgmap_generate_google_map_markers');
	
	
	function sbvcgmap_generate_google_map($atts, $marker_content = NULL) {
		extract(shortcode_atts( array(
			'sbvcgmap_apikey'					=>	'',
			'map_width' 						=>	100,
			'width_type' 						=>	'%',
			'map_height' 						=>	400,
			'height_type' 						=>	'px',
			'mapstyles' 						=>	'style-1',
			
			'centerpoint' 						=>	'',
			'zoom' 								=>	14,
			'zoomcontrol' 						=>	'yes',
			'zoomcontrol_position' 				=>	'TOP_LEFT',
			'zoomcontrolstyle' 					=>	'DEFAULT',
			'draggable' 						=>	'yes',
			'scrollwheel' 						=>	'yes',
			
			'pancontrol' 						=>	'yes',
			'pancontrol_position'				=>	'TOP_LEFT',
			'scalecontrol' 						=>	'yes',
			'streetviewcontrol'					=>	'yes',
			'streetviewcontrol_position'		=>	'TOP_LEFT',
			'maptypecontrol'					=>	'yes',
			'maptypecontrol_position'			=>	'TOP_RIGHT',
			'maptype' 							=>	'ROADMAP',
			'panoramatogglebutton'				=>	'no',
			'maptypecontrolstyle'				=>	'DEFAULT',
			'overviewmapcontrolvisible'			=>	'no',
			'overviewmapcontrol' 				=>	'yes',
			
			'searchtype' 						=>	'disabled',
			'searchradius' 						=>	500,
			'searchiconanimation'				=>	'NONE',
			'searchdirectiontext'				=>	'',
			
			'weather' 							=>	'no',
			'traffic' 							=>	'no',
			'transit' 							=>	'no',
			'bicycle' 							=>	'no',
			'panoramio' 						=>	'no',
			
			'reloadonresize'					=>	'no',
			'language' 							=>	'en',
			'clustering' 						=>	'no',
			'fullscreenbutton'					=>	'no',
			'expandmaptext'						=>	'Expand Map',
			'collapsemaptext'					=>	'Collapse Map'
			
		), $atts ));
		
		$sbvcgmap_apikey = trim($sbvcgmap_apikey);
		$width = $map_width.$width_type;
		$widthpx = strpos($width,'px');
		$widthper = strpos($width,'%');
		if(!$widthpx && !$widthper) {
			$width = intval($width).'px';
		}
		
		$height = $map_height.$height_type;
		$heightpx = strpos($height,'px');
		$heightper = strpos($height,'%');
		if(!$heightpx && !$heightper) {
			$height = intval($height).'px';
		}
		
		$mapstyle = sbvcgmap_lower_trim($mapstyles);
		
		$zoom = intval(abs(trim($zoom)));
		if($zoom == '' || $zoom == 0) {
			$zoom = 14;
		}
		
		
		$zoomcontrol 					= sbvcgmap_lower_trim($zoomcontrol);
		$zoomcontrol_position			= sbvcgmap_upper_trim($zoomcontrol_position);
		$zoomcontrolstyle				= sbvcgmap_upper_trim($zoomcontrolstyle);
		$draggable 						= sbvcgmap_lower_trim($draggable);
		$scrollwheel 					= sbvcgmap_lower_trim($scrollwheel);
		$cplatitude 					= 0;
		$cplongitude 					= 0;
		
		if($centerpoint != '') {
			list($cplatitude,$cplongitude) = sscanf("$centerpoint", "%f,%f");
			if($cplatitude == '' || $cplongitude == '') {
				$centerpoint_location = json_decode(sbvcgmap_get_lat_lng_from_address($centerpoint));		//Get latitude, longitude from geocode api
				if(strtoupper($centerpoint_location->status) == 'OK') {
					$cplatitude = $centerpoint_location->results[0]->geometry->location->lat;
					$cplongitude = $centerpoint_location->results[0]->geometry->location->lng;
				}
			}
		}

		
		$pancontrol 					= sbvcgmap_lower_trim($pancontrol);
		$pancontrol_position			= sbvcgmap_upper_trim($pancontrol_position);
		$scalecontrol 					= sbvcgmap_lower_trim($scalecontrol);
		$streetviewcontrol 				= sbvcgmap_lower_trim($streetviewcontrol);
		$streetviewcontrol_position		= sbvcgmap_upper_trim($streetviewcontrol_position);
		$maptypecontrol 				= sbvcgmap_lower_trim($maptypecontrol);
		$maptypecontrol_position		= sbvcgmap_upper_trim($maptypecontrol_position);
		$maptype 						= sbvcgmap_upper_trim($maptype);
		$panoramatogglebutton			= sbvcgmap_lower_trim($panoramatogglebutton);
		$maptypecontrolstyle	 		= sbvcgmap_upper_trim($maptypecontrolstyle);
		$overviewmapcontrolvisible 		= sbvcgmap_lower_trim($overviewmapcontrolvisible);
		$overviewmapcontrol 			= sbvcgmap_lower_trim($overviewmapcontrol);
		
			
		$searchtype						= sbvcgmap_lower_trim($searchtype);
		$searchradius					= intval(abs(trim($searchradius)));
		$searchiconanimation			= sbvcgmap_upper_trim($searchiconanimation);
		$searchdirectiontext			= trim($searchdirectiontext);
		
		$weather 						= sbvcgmap_lower_trim($weather);
		$traffic 						= sbvcgmap_lower_trim($traffic);
		$transit 						= sbvcgmap_lower_trim($transit);
		$bicycle 						= sbvcgmap_lower_trim($bicycle);
		$panoramio 						= sbvcgmap_lower_trim($panoramio);
		
		$reloadonresize 				= sbvcgmap_lower_trim($reloadonresize);
		$language 						= trim($language);
		$clustering 					= sbvcgmap_lower_trim($clustering);
		
		if(empty($fullscreenbutton)) {
			$fullscreenbutton = 'no';
		}
		
		
		wp_enqueue_style('sbvcgmap-style', SBVCGMAP_PLUGIN_DIR.'/assets/css/style.css');
		wp_enqueue_script('jquery');
		
		wp_register_script( 'sbvcgmap-googlemapapi', (is_ssl() ? 'https://' :'http://').'maps.googleapis.com/maps/api/js?key='.$sbvcgmap_apikey.'&libraries=places,weather,panoramio&language='.$language, array(), '', true );
		wp_enqueue_script('sbvcgmap-googlemapapi');
		
		wp_register_script('sbvcgmap-markerclusterer', SBVCGMAP_PLUGIN_DIR.'/assets/js/markerclusterer.js', array(), SBVCGMAP_PLUGIN_VERSION, true);		//Registering admin setting screen script
		wp_enqueue_script('sbvcgmap-markerclusterer');
		
		wp_register_script('sbvcgmap-infobox', SBVCGMAP_PLUGIN_DIR.'/assets/js/infobox.min.js', array(), SBVCGMAP_PLUGIN_VERSION, true);		//Registering admin setting screen script
		wp_enqueue_script('sbvcgmap-infobox');
		
		wp_register_script('sbvcgmap-script', SBVCGMAP_PLUGIN_DIR.'/assets/js/script.js', array(), SBVCGMAP_PLUGIN_VERSION, true);		//Registering admin setting screen script
		wp_enqueue_script('sbvcgmap-script');
		
		
		$output = '<div class="sbvcgmap-map-wrapper" style="width:'.$width.';height:'.$height.'">';
		if($fullscreenbutton == 'yes') {
			$output .= '<a href="javascript:;" class="sbvcgmap-toggle-screen" data-do-screen-mode="expand"><span class="sbvcgmap-collapse-text">'.$expandmaptext.'</span><span class="sbvcgmap-expand-text">'.$collapsemaptext.'</span></a>';
		}
		
		$output .= '<div class="sbvcgmap-map" zoom="'.$zoom.'" maptype="'.$maptype.'" panoramatogglebutton="'.$panoramatogglebutton.'" pancontrol="'.$pancontrol.'" pancontrol_position="'.$pancontrol_position.'" zoomcontrol="'.$zoomcontrol.'" zoomcontrol_position="'.$zoomcontrol_position.'" zoomcontrolstyle="'.$zoomcontrolstyle.'" maptypecontrol="'.$maptypecontrol.'" maptypecontrol_position="'.$maptypecontrol_position.'" streetviewcontrol="'.$streetviewcontrol.'" streetviewcontrol_position="'.$streetviewcontrol_position.'" overviewmapcontrol="'.$overviewmapcontrol.'" overviewmapcontrolvisible="'.$overviewmapcontrolvisible.'" maptypecontrolstyle="'.$maptypecontrolstyle.'" mapstyle="'.$mapstyle.'" weather="'.$weather.'" traffic="'.$traffic.'" transit="'.$transit.'" bicycle="'.$bicycle.'" panoramio="'.$panoramio.'" draggable="'.$draggable.'" scrollwheel="'.$scrollwheel.'" cplatitude="'.$cplatitude.'" cplongitude="'.$cplongitude.'" scalecontrol="'.$scalecontrol.'" searchtype="'.$searchtype.'" searchradius="'.$searchradius.'" searchiconanimation="'.$searchiconanimation.'" searchdirectiontext="'.$searchdirectiontext.'" reloadonresize="'.$reloadonresize.'" clustering="'.$clustering.'" style="width:'.$width.';height:'.$height.'">';
		$output .= do_shortcode($marker_content);
		$output .= '</div>';
		
		if($panoramatogglebutton == 'yes') {
			$output .= '<a href="javascript:;" class="sbvcgmap-toggle-panorama"></a>';
		}
		
		$output .= '</div>';
		return $output;
	}
	
	
	add_shortcode('SBVCGMAP', 'sbvcgmap_generate_google_map');
	add_shortcode('sbvcgmap', 'sbvcgmap_generate_google_map');