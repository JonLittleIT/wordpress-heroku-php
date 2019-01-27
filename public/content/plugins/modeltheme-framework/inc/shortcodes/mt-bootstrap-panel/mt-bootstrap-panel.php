<?php 

/**

||-> Shortcode: Custom Content

*/
function modeltheme_panel_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'panel_style'    => '', // success/info/warning/danger
            'panel_title'    => '', 
            'panel_content'  => '',
            'animation'  => ''
        ), $params ) ); ?>
    <div class="panel animateIn panel-<?php echo esc_attr($panel_style); ?>" data-animate="<?php echo esc_attr($animation); ?>">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo esc_attr($panel_title); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo esc_attr($panel_content); ?>
        </div>
    </div>
    
<?php }
add_shortcode('panel', 'modeltheme_panel_shortcode');





/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

	vc_map( 
		array(
		"name" => esc_attr__("MT - Panel", 'modeltheme'),
		"base" => "panel",
		"category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
		"icon" => "smartowl_shortcode",
		"params" => array(
			array(
				"group" => "Options",
				"type"         => "dropdown",
				"holder"       => "div",
				"class"        => "",
				"param_name"   => "panel_style",
				"std"          => '',
				"heading"      => esc_attr__("Panel style", 'modeltheme'),
				"description"  => "",
				"value"        => array(
					esc_attr__('Success', 'modeltheme') => 'success',
					esc_attr__('Info', 'modeltheme')    => 'info',
					esc_attr__('Warning', 'modeltheme') => 'warning',
					esc_attr__('Danger', 'modeltheme')  => 'danger'
				)
			),
			array(
				"group" => "Options",
				"type"         => "textfield",
				"holder"       => "div",
				"class"        => "",
				"param_name"   => "panel_title",
				"heading"      => esc_attr__("Panel title", 'modeltheme'),
				"value"        => esc_attr__("Panel title", 'modeltheme'),
				"description"  => ""
			),
			array(
				"group" => "Options",
				"type"         => "textarea",
				"holder"       => "div",
				"class"        => "",
				"param_name"   => "panel_content",
				"heading"      => esc_attr__("Panel content", 'modeltheme'),
				"value"        => esc_attr__("Panel content", 'modeltheme'),
				"description"  => ""
			),
			array(
				"group" => "Animation",
				"type" => "dropdown",
				"heading" => esc_attr__("Animation", 'modeltheme'),
				"param_name" => "animation",
				"std" => '',
				"holder" => "div",
				"class" => "",
				"description" => "",
				"value" => $animations_list
			)
		)
	));
}