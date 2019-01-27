<?php
//Add number field in visual composer
if(!class_exists('sbvcgmap_add_param')) {
	class sbvcgmap_add_param {
		function __construct() {
			
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('sbvcgmap_num' , array(&$this, 'sbvcgmap_settings_field_num'));
				vc_add_shortcode_param('sbvcgmap_autocomplete' , array(&$this, 'sbvcgmap_settings_field_autocomplete'));
				vc_add_shortcode_param('sbvcgmap_hidden' , array(&$this, 'sbvcgmap_settings_field_hidden'));
			} else if(function_exists('add_shortcode_param')) {
				add_shortcode_param('sbvcgmap_num' , array(&$this, 'sbvcgmap_settings_field_num'));
				add_shortcode_param('sbvcgmap_autocomplete' , array(&$this, 'sbvcgmap_settings_field_autocomplete'));
				add_shortcode_param('sbvcgmap_hidden' , array(&$this, 'sbvcgmap_settings_field_hidden'));
			}
		}
		function sbvcgmap_settings_field_num($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$step = isset($settings['step']) ? $settings['step'] : '';
			$output = '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" step="'.$step.'"/>'.$suffix;
			return $output;
		}
		
		function sbvcgmap_settings_field_autocomplete($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$target = isset($settings['target']) ? $settings['target'] : '';
			$output = '<input type="text" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
			$output .= '<script>sbvcgmap.autocomplete("input.sbvcgmap_autocomplete", "'.$target.'");</script>';
			return $output;
		}
		
		function sbvcgmap_settings_field_hidden($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" />';
			return $output;
		}
	}
	//instantiate the class
	$sbvcgmap_add_param = new sbvcgmap_add_param;
}

//Return all map styles
function sbvcgmap_get_map_styles() {
	$styles = array();
	for($i = 1; $i <= 114; $i++) {
		$styles[] = 'style-'.$i;
	}
	return $styles;
}

//Return all zoom levels
function sbvcgmap_get_zoom_levels() {
	$styles = array();
	for($i = 1; $i <= 21; $i++) {
		$styles[] = $i;
	}
	return $styles;
}

//Return toggle values yes | no
function sbvcgmap_toggle_button() {
	return array(
		__( 'Yes', 'js_composer' ) => 'yes',
		__( 'No', 'js_composer' ) => 'no',
	);
}

//Return size type like px | %
function sbvcgmap_get_size_types() {
	return array(
		__( 'Pixels (px)', 'js_composer' ) => 'px',
		__( 'Percentage (%)', 'js_composer' ) => '%'
	);
}

//Return map control positions
function sbvcgmap_get_positions() {
	return array(
		'TOP CENTER' 	=> 'TOP_CENTER',
		'TOP LEFT' 		=> 'TOP_LEFT',
		'TOP RIGHT' 	=> 'TOP_RIGHT',
		'LEFT TOP' 		=> 'LEFT_TOP',
		'RIGHT TOP' 	=> 'RIGHT_TOP',
		'LEFT CENTER' 	=> 'LEFT_CENTER',
		'RIGHT CENTER' 	=> 'RIGHT_CENTER',
		'LEFT BOTTOM' 	=> 'LEFT_BOTTOM',
		'RIGHT BOTTOM' 	=> 'RIGHT_BOTTOM',
		'BOTTOM CENTER' => 'BOTTOM_CENTER',
		'BOTTOM LEFT' 	=> 'BOTTOM_LEFT',
		'BOTTOM RIGHT' 	=> 'BOTTOM_RIGHT'
	);
}

//Return zoom control styles
function sbvcgmap_get_zoom_styles() {
	return array('DEFAULT', 'SMALL', 'LARGE');
}

//Return map types
function sbvcgmap_get_map_types() {
	return array('ROADMAP', 'SATELLITE', 'HYBRID', 'TERRAIN', 'STREETVIEW');
}

//Return map type control styles
function sbvcgmap_get_map_type_styles() {
	return array('DEFAULT', 'HORIZONTAL_BAR', 'DROPDOWN_MENU');
}

//Return search queries for nearest places API
function sbvcgmap_get_search_types() {
	$map_searchtypes = array (
		'accounting',
		'airport',
		'amusement_park',
		'aquarium',
		'art_gallery',
		'atm',
		'bakery',
		'bank',
		'bar',
		'beauty_salon',
		'bicycle_store',
		'book_store',
		'bowling_alley',
		'bus_station',
		'cafe',
		'campground',
		'car_dealer',
		'car_rental',
		'car_repair',
		'car_wash',
		'casino',
		'cemetery',
		'church',
		'city_hall',
		'clothing_store',
		'convenience_store',
		'courthouse',
		'dentist',
		'department_store',
		'doctor',
		'electrician',
		'electronics_store',
		'embassy',
		'establishment',
		'finance',
		'fire_station',
		'florist',
		'food',
		'funeral_home',
		'furniture_store',
		'gas_station',
		'general_contractor',
		'grocery_or_supermarket',
		'gym',
		'hair_care',
		'hardware_store',
		'health',
		'hindu_temple',
		'home_goods_store',
		'hospital',
		'insurance_agency',
		'jewelry_store',
		'laundry',
		'lawyer',
		'library',
		'liquor_store',
		'local_government_office',
		'locksmith',
		'lodging',
		'meal_delivery',
		'meal_takeaway',
		'mosque',
		'movie_rental',
		'movie_theater',
		'moving_company',
		'museum',
		'night_club',
		'painter',
		'park',
		'parking',
		'pet_store',
		'pharmacy',
		'physiotherapist',
		'place_of_worship',
		'plumber',
		'police',
		'post_office',
		'real_estate_agency',
		'restaurant',
		'roofing_contractor',
		'rv_park',
		'school',
		'shoe_store',
		'shopping_mall',
		'spa',
		'stadium',
		'storage',
		'store',
		'subway_station',
		'synagogue',
		'taxi_stand',
		'train_station',
		'travel_agency',
		'university',
		'veterinary_care',
		'zoo'
	);
	asort($map_searchtypes);
	
	$final_map_searchtypes = array();
	$final_map_searchtypes['Disabled'] = 'disabled';
	foreach($map_searchtypes as $map_searchtype) {
		$final_map_searchtypes[ucwords(str_replace('_',' ',trim($map_searchtype)))] = $map_searchtype;
	}
	
	return $final_map_searchtypes;
}

//Return marker animations
function sbvcgmap_get_marker_animations() {
	return array('NONE', 'DROP', 'BOUNCE');
}

//Return all map languages for v3 Google Map API
function sbvcgmap_get_map_languages() {
	$map_languages = array(
		'ar'	=>	'ARABIC',
		'eu'	=>	'BASQUE',
		'bg'	=>	'BULGARIAN',
		'bn'	=>	'BENGALI',
		'ca'	=>	'CATALAN',
		'cs'	=>	'CZECH',
		'da'	=>	'DANISH',
		'de'	=>	'GERMAN',
		'el'	=>	'GREEK',
		'en'	=>	'ENGLISH',
		'en-AU'	=>	'ENGLISH (AUSTRALIAN)',
		'en-GB'	=>	'ENGLISH (GREAT BRITAIN)',
		'es'	=>	'SPANISH',
		'eu'	=>	'BASQUE',
		'fa'	=>	'FARSI',
		'fi'	=>	'FINNISH',
		'fil'	=>	'FILIPINO',
		'fr'	=>	'FRENCH',
		'gl'	=>	'GALICIAN',
		'gu'	=>	'GUJARATI',
		'hi'	=>	'HINDI',
		'hr'	=>	'CROATIAN',
		'hu'	=>	'HUNGARIAN',
		'id'	=>	'INDONESIAN',
		'it'	=>	'ITALIAN',
		'iw'	=>	'HEBREW',
		'ja'	=>	'JAPANESE',
		'kn'	=>	'KANNADA',
		'ko'	=>	'KOREAN',
		'lt'	=>	'LITHUANIAN',
		'lv'	=>	'LATVIAN',
		'ml'	=>	'MALAYALAM',
		'mr'	=>	'MARATHI',
		'nl'	=>	'DUTCH',
		'no'	=>	'NORWEGIAN',
		'pl'	=>	'POLISH',
		'pt'	=>	'PORTUGUESE',
		'pt-BR'	=>	'PORTUGUESE (BRAZIL)',
		'pt-PT'	=>	'PORTUGUESE (PORTUGAL)',
		'ro'	=>	'ROMANIAN',
		'ru'	=>	'RUSSIAN',
		'sk'	=>	'SLOVAK',
		'sl'	=>	'SLOVENIAN',
		'sr'	=>	'SERBIAN',
		'sv'	=>	'SWEDISH',
		'tl'	=>	'TAGALOG',
		'ta'	=>	'TAMIL',
		'te'	=>	'TELUGU',
		'th'	=>	'THAI',
		'tr'	=>	'TURKISH',
		'uk'	=>	'UKRAINIAN',
		'vi'	=>	'VIETNAMESE',
		'zh-CN'	=>	'CHINESE (SIMPLIFIED)',
		'zh-TW'	=>	'CHINESE (TRADITIONAL)'
	);
		
	asort($map_languages);
	
	$final_map_languages = array_flip($map_languages);
	return $final_map_languages;
	
}

//Get border types
function sbvcgmap_get_border_types() {
	 $border_styles = array(
		'None'		=>	'none',
		'Hidden'	=>	'hidden',
		'Dotted'	=>	'dotted',
		'Dashed'	=>	'dashed',
		'Solid'		=>	'solid',
		'Double'	=>	'double',
		'Groove'	=>	'groove',
		'Ridge'		=>	'ridge',
		'Inset'		=>	'inset',
		'Outset'	=>	'outset',
		'Initial'	=>	'initial',
		'Inherit'	=>	'inherit'
	);
	asort($border_styles);
	return $border_styles;
}

//Getting latitude and longitude from address using geocode api
function sbvcgmap_get_lat_lng_from_address($address) {
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode(trim($address))."&sensor=false";
    $response = @wp_remote_get($url);
	return $response['body'];
}

//Convert string to Lowercase with no start/trail space
function sbvcgmap_lower_trim($string) {
	return strtolower(trim($string));
}

//Convert string to Uppercase with no start/trail space
function sbvcgmap_upper_trim($string) {
	return strtoupper(trim($string));
}