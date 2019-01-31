<?php

if(!defined('AMOS_BASE_URL' ) ) define( 'AMOS_BASE_URL', get_template_directory_uri().'/'); 

if(function_exists('wp_get_theme'))
{
	$wp_theme_obj = wp_get_theme();
	$amos_base_data['prefix'] = $amos_base_data['Title'] = $wp_theme_obj->get('Name');
    if(!defined('THEMENAME')) define('THEMENAME', $amos_base_data['Title']);
}

if(!defined('THEMETITLE')) define('THEMETITLE', $amos_base_data['Title']);


if(is_admin()){
	add_action('admin_print_scripts','amos_global_js');

	function amos_global_js(){
	    echo "\n <script type='text/javascript'>\n /* <![CDATA[ */  \n";
	    echo "var amos_global = {\n \tframeworkUrl: '".plugins_url()."/elle-shortcodes/', \n \tinstalledAt: '".plugins_url()."/elle-shortcodes/', \n \tajaxurl: '".admin_url( 'admin-ajax.php' )."'\n \t}; \n /* ]]> */ \n ";
	    echo "</script>\n \n ";
	}
}

	
add_action( 'themecheck_checks_loaded',  'disable_checks' );


function disable_checks() {
                global $themechecks;

                $checks_to_disable = array(
               	    'IncludeCheck',
                	'I18NCheck',
              	    'AdminMenu',
              	    'Bad_Checks',
                	'MalwareCheck',
                	'Theme_Support',
                	'CustomCheck',
                	'EditorStyleCheck',
               	    'IframeCheck',
                    'NonPrintableCheck'
                );
                
               foreach ( $themechecks as $keyindex => $check ) {
               	if ( $check instanceof themecheck ) {
               		$check_class = get_class( $check );
               		if ( in_array( $check_class, $checks_to_disable ) ) {
              			unset( $themechecks[$keyindex] );
               		}
                	}
               }
            }


?>