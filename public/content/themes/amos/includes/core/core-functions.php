<?php
if(!function_exists('amos_get_post_id')){
    /**
     * amos_get_post_id()
     * 
     * @return
     */
    function amos_get_post_id() 
    {
        global $amos_config, $amos_current_view, $amos_redata, $for_online;
        $ID = false;
        
        if(!isset($amos_config['real_ID']))
        {
            if(!empty($amos_config['new_query']['page_id'])) 
            { 
                $ID = $amos_config['new_query']['page_id']; 
            }
            else
            {
                $ID = @get_the_ID();
            }
            
            $amos_config['real_ID'] = $ID;
        }
        else
        {
            $ID = $amos_config['real_ID'];
        }

        if(class_exists('woocommerce') && is_shop()){
            $ID = get_option('woocommerce_shop_page_id');
        }

        if(isset($amos_current_view) && $amos_current_view == 'blog' && !isset($for_online) )
            $ID = $amos_redata['blogpage'];

        return $ID; 
    }
    
    add_action('wp_head', 'amos_get_post_id');
}




if(!function_exists('amos_image_by_id'))
{

	/**
	 * amos_image_by_id()
	 * 
	 * @param mixed $thumbnail_id
	 * @param mixed $size
	 * @param string $output
	 * @param string $data
	 * @return
	 */
	function amos_image_by_id($thumbnail_id, $size = array('width'=>800,'height'=>800), $output = 'image', $data = "")
	{	
		
		//if(!is_numeric($thumbnail_id)) return false;
		
		if(is_array($size)) 
		{
			$size[0] = $size['width'];
			$size[1] = $size['height'];
		}

		$image_src = wp_get_attachment_image_src($thumbnail_id, $size);

		if(!$image_src){
			$image_src = array();
			$image_src[0] = amos_default_portfolio_image($size);
			if($output == 'image')
				return "<img src='".$image_src[0]."' ".$data."/>";
		
		}
		if ($output == 'url') return $image_src[0];
		
		
		


		$attachment = get_post($thumbnail_id);
		
		if(is_object($attachment))
		{
			
			$image_description = $attachment->post_excerpt == "" ? $attachment->post_content : $attachment->post_excerpt;
			$image_description = trim(strip_tags($image_description));
			$image_title = trim(strip_tags($attachment->post_title));
			
			return "<img src='".$image_src[0]."' title='".esc_attr($image_title)."' alt='".esc_attr($image_description)."' ".$data."/>";
		}	
	}
}


function amos_backend_is_file($passedNeedle, $haystack){	
	
	$needle = substr($passedNeedle, strrpos($passedNeedle, '.') + 1);

	if(strlen($needle) > 4){

		if(!is_array($haystack)){

			switch($haystack){

				case 'videoService': $haystack = array('youtube.com/','vimeo.com/'); break;

			}

		}

		if(is_array($haystack)){

			foreach ($haystack as $regex){

				if(preg_match("!".$regex."!", $passedNeedle)) return true;

			}

		}	

	}else{
		
		if(!is_array($haystack)){

			switch($haystack){

				case 'image':

					$haystack = array('png','gif','jpeg','jpg','pdf','tif');
					break;

				case 'text':

					$haystack = array('doc','docx','rtf','ttf','txt','odp');

					break;

				case 'html5video':

					$haystack = array('ogv','webm','mp4');
					break;

			}

		}

		if(is_array($haystack)){

			if (in_array($needle,$haystack))

			{

				return true;

			}

		}

	}
		
	return false;

}


/*--------------------- Text Limit ----------------------------------------------- */

function amos_text_limit($text, $limit) {

      $excerpt = explode(' ', $text, $limit);

      if (count($excerpt)>=$limit) {

        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';

      } else {

        $excerpt = implode(" ",$excerpt);
      } 

      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

      if(strlen($excerpt) > 170 && $limit <= 40)
        return substr($excerpt, 0, 170);
    
      return $excerpt;

}

/*--------------------- End Text Limit ----------------------------------*----- */






/*--------------------- HTML 5 VIDEO ---------------------------------------- */

if(!function_exists('amos_html5_video_embed'))
{
	function amos_html5_video_embed($path, $image = "", $types = array('webm' => 'type="video/webm"', 'mp4' => 'type="video/mp4"', 'ogv' => 'type="video/ogg"'))
	{	
		preg_match("!^(.+?)(?:\.([^.]+))?$!", $path, $path_split);
		
		$output = "";
		if(isset($path_split[1]))
		{
			if(!$image && file_get_contents($path_split[1].'.jpg',0,NULL,0,1))
			{
				$image = 'poster="'.$path_split[1].'.jpg"';
			}
			
			$uid = 'player_'.get_the_ID().'_'.mt_rand().'_'.mt_rand();
		
			$output .= '<video class="amos_video" '.$image.' controls id="'.$uid.'">';

			foreach ($types as $key => $type)
			{
				if($path_split[2] == $key || file_get_contents($path_split[1].'.'.$key,0,NULL,0,1)) 
				{  
					$output .= '	<source src="'.$path_split[1].'.'.$key.'" '.$type.' />';
				}
			}

			$output .= '</video>';
		}
		return $output;
	}
}

/*--------------------- END HTML 5 VIDEO --------------------------------- */


/* -------------------- Used for woocommerce ----------------------------- */

function amos_add_param($url, $paramName, $paramValue) {
     $url_data = parse_url($url);
     if(!isset($url_data["query"]))
         $url_data["query"]="";

     $params = array();
     parse_str($url_data['query'], $params);
     $params[$paramName] = $paramValue;   
     $url_data['query'] = http_build_query($params);
     return amos_build_url($url_data);
}


 function amos_build_url($url_data) {
     $url="";
     if(isset($url_data['host']))
     {
         $url .= $url_data['scheme'] . '://';
         if (isset($url_data['user'])) {
             $url .= $url_data['user'];
                 if (isset($url_data['pass'])) {
                     $url .= ':' . $url_data['pass'];
                 }
             $url .= '@';
         }
         $url .= $url_data['host'];
         if (isset($url_data['port'])) {
             $url .= ':' . $url_data['port'];
         }
     }
     if(isset($url_data['path']))
     	$url .= $url_data['path'];
     if (isset($url_data['query'])) { 
         $url .= '?' . $url_data['query'];
     }
     if (isset($url_data['fragment'])) {
         $url .= '#' . $url_data['fragment'];
     }
     return $url;
 }

if (class_exists('WPBakeryVisualComposerAbstract')) {
	add_action('admin_init', 'vc_iconselect_css_register'); 
	function vc_iconselect_css_register() {    
	    wp_register_style('jquery.fonticonpicker.min', get_template_directory_uri() . '/css/jquery.fonticonpicker.min.css');
	    wp_register_style('jquery.fonticonpicker.grey.min', get_template_directory_uri() . '/css/jquery.fonticonpicker.grey.min.css');
		wp_register_style( 'vector-icons',AMOS_BASE_URL.'css/vector-icons.css' );
	    wp_register_style( 'font-awesome1',AMOS_BASE_URL.'css/font-awesome.min.css' );
	    wp_register_style( 'steadysets',AMOS_BASE_URL.'css/steadysets.css' );
	    wp_register_style( 'linearicons',AMOS_BASE_URL.'css/linearicons.css' );
	    wp_register_style( 'lineaicons',AMOS_BASE_URL.'css/lineaicon.css' );
	}

	add_action('admin_print_styles', 'vc_iconselect_css_load');
	function vc_iconselect_css_load() {
		if(basename( AMOS_BASE_URL ) == "post-new.php" 
			|| basename( AMOS_BASE_URL ) == "post.php")
		{	
	    
	    	wp_enqueue_style('jquery.fonticonpicker.min');
	    	wp_enqueue_style('jquery.fonticonpicker.grey.min');
	    	wp_enqueue_style('vector-icons');
	    	wp_enqueue_style('font-awesome1');
	    	wp_enqueue_style('linecon');
	    	wp_enqueue_style('steadysets');
	    	wp_enqueue_style('linearicons');
	    	wp_enqueue_style('lineaicons');

		}	
	}
}

function amos_get_image_sizes( $size = '' ) {

        global $_wp_additional_image_sizes;

        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

                if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                        $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                        $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                        $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
                       

                } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                        $sizes[ $_size ] = array( 
                                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                        );

                }

        }

        // Get only 1 size if found
        if ( $size ) {

                if( isset( $sizes[ $size ] ) ) {
                        return $sizes[ $size ];
                } else {
                        return false;
                }

        }

        return $sizes;
}

?>
