<?php 
	function farvis_get_option($slug,$_default = false){
		
		if ($stgs = farvis_getCustomizeSettings()){
			$slug_option_name = 'farvis_'.$slug;
			if (isset($stgs->$slug_option_name))
				return wp_kses_post($stgs->$slug_option_name);
		}

		$slug = 'farvis_' . $slug;

		//$pix_options = get_option('theme_mods_farvis');
        
        $pix_options = get_theme_mods();

		if (isset($pix_options[$slug])){
			return wp_kses_post($pix_options[$slug]);
		}else{
			if ($_default)
				return wp_kses_post($_default);
			else
				return false;	
		}
		
	}
	
	
	function farvis_getCustomizeSettings(){
		if (isset($_POST['wp_customize']) && $_POST['wp_customize'] == 'on'){
			$settings = json_decode(stripslashes($_POST['customized']));
			return $settings;	
		}else{
			return false;
		}

	}


	function farvis_load_modules($modules = array()){
		if (!is_array($modules))
			return false;
			

		foreach($modules as $_module){
            $_moduleDir = get_template_directory() . '/library/modules/' . $_module . '/';
			if (file_exists($_moduleDir) && is_dir($_moduleDir) && file_exists($_moduleDir . $_module . '.php')){
                get_template_part( 'library/modules/' . $_module . '/' . $_module );
            }
		}

	}

	function farvis_load_files($files,$dir = false){
		if (!is_array($files))
			return false;

		if (!$dir)
			$dir = '';

		foreach($files as $_file){
			$filename = $dir . $_file;
			if (file_exists(get_template_directory() . '/'.$filename.'.php')){
				get_template_part( $filename );
			}
		}
	}

	function farvis_include_files($files,$dir = false){
		if (!is_array($files))
			return false;

		if (!$dir)
			$dir = '';


		foreach($files as $_file){
			$filename = $dir . $_file;
			//include( locate_template($filename.'.php', false, false) );
			if (file_exists(get_template_directory() . '/'.$filename.'.php')){
				include_once( get_template_directory() . '/'. $filename.'.php' );
			}
		}

	}


    function my_myme_types($mime_types){
        $mime_types['svg'] = 'image/svg+xml'; // support SVG
        return $mime_types;
    }
    add_filter('upload_mimes', 'my_myme_types', 1, 1);



    function pz_child_yith_pa_comp_fix() {
        if (function_exists('WC')){
            wp_register_script( 'select2', WC()->plugin_url() . '/assets/js/select2/select2.full.min.js', array( 'jquery' ) );
            wp_enqueue_script( 'select2' );

            wp_register_script( 'selectWoo', WC()->plugin_url() . '/assets/js/selectWoo/selectWoo.full.min.js', array( 'jquery' ) );
            wp_enqueue_script( 'selectWoo' );

            wp_register_script( 'wc-enhanced-select', WC()->plugin_url() . '/assets/js/admin/wc-enhanced-select.min.js', array( 'jquery', 'selectWoo' ) );
            wp_enqueue_script( 'wc-enhanced-select' );
        }
    }

    add_action( 'admin_enqueue_scripts', 'pz_child_yith_pa_comp_fix' );




	
?>