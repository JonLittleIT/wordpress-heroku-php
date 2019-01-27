<?php 


function farvis_init_sidebars(){
	if ( function_exists('register_sidebar') ){
	
		register_sidebar(array(
			'name' => esc_html__('WP Default Sidebar', 'farvis'),
			'id'	=> 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="%2$s widget block_content">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title"><span>',
			'after_title' => '</span></h4>',
		));
	
		register_sidebar(array(
			'name' => esc_html__('Blog Sidebar', 'farvis'),
			'id' => 'global-sidebar-1',
			'before_widget' => '<div id="%1$s" class="%2$s widget block_content">',
			'before_title' => '<h4 class="widget-title"><span>',
			'after_title' => '</span></h4>',
			'after_widget' => '</div>',
		));

		register_sidebar(array(
			'name' => esc_html__('Portfolio Sidebar', 'farvis'),
			'id' => 'portfolio-sidebar-1',
			'before_widget' => '<div id="%1$s" class="%2$s widget block_content">',
			'before_title' => '<h4 class="widget-title"><span>',
			'after_title' => '</span></h4>',
			'after_widget' => '</div>',
		));

		register_sidebar(array(
			'name' => esc_html__('Services Sidebar', 'farvis'),
			'id' => 'services-sidebar-1',
			'before_widget' => '<div id="%1$s" class="%2$s widget block_content">',
			'before_title' => '<h4 class="widget-title"><span>',
			'after_title' => '</span></h4>',
			'after_widget' => '</div>',
		));

		register_sidebar(array(
			'name' => esc_html__('Shop sidebar', 'farvis'),
			'id'	=> 'shop-sidebar-1',
			'before_widget' => '<div id="%1$s" class="%2$s widget block_content">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title"><span>',
			'after_title' => '</span></h4>',
		));

		register_sidebar(array(
			'name' => esc_html__('Product sidebar', 'farvis'),
			'id'	=> 'product-sidebar-1',
			'before_widget' => '<div id="%1$s" class="%2$s widget block_content">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title"><span>',
			'after_title' => '</span></h4>',
		));

		register_sidebar(array(
			'name' => esc_html__('Custom Area', 'farvis'),
			'id'	=> 'custom-area-1',
			'before_widget' => '<div id="%1$s" class="%2$s widget block_content">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title"><span>',
			'after_title' => '</span></h4>',
		));
		
		
		
	}
}


add_action('widgets_init','farvis_init_sidebars');

function farvis_in_widget_form($t,$return,$instance){
    $instance = wp_parse_args( (array) $instance, array( 'pix_icon_class' => '' ) );
    if ( !isset($instance['pix_icon_class']) )
        $instance['pix_icon_class'] = null;	
    ?>
    <p>
    	<label for="<?php echo esc_attr($t->get_field_id('pix_icon_class')); ?>"><?php esc_attr_e('Icon class: ', 'farvis'); ?></label>
        <input type="text" name="<?php echo esc_attr($t->get_field_name('pix_icon_class')); ?>" id="<?php echo esc_attr($t->get_field_id('pix_icon_class')); ?>" value="<?php echo esc_attr($instance['pix_icon_class']);?>" />
    </p>
    <?php
    $retrun = null;
    return array($t,$return,$instance);
}
function farvis_in_widget_form_update($instance, $new_instance, $old_instance){
    $instance['pix_icon_class'] = strip_tags($new_instance['pix_icon_class']);
    return $instance;
}
function farvis_dynamic_sidebar_params($params){
    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];
    if (isset($widget_opt[$widget_num]['pix_icon_class'])){
            if(isset($widget_opt[$widget_num]['pix_icon_class']))
                $class = '<span class="'.esc_attr($widget_opt[$widget_num]['pix_icon_class']).'"></span>';
            else
                $class = '';
            $params[0]['before_title'] = preg_replace('/<span>/', '<span>'.$class.'',  $params[0]['before_title'], 1);
    }
    return $params;
}
//Add input fields(priority 5, 3 parameters)
add_action('in_widget_form', 'farvis_in_widget_form',5,3);
//Callback function for options update (priority 5, 3 parameters)
add_filter('widget_update_callback', 'farvis_in_widget_form_update',5,3);
//add class names (default priority, one parameter)
add_filter('dynamic_sidebar_params', 'farvis_dynamic_sidebar_params');