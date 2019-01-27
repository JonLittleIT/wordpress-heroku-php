<?php 



function farvis_layout_side_content( $post ) {

	echo '<p><strong>'.esc_html__('Main Color', 'farvis').'</strong></p>';
	$sel_v = get_post_meta($post->ID, 'page_main_color', 1);
	echo '<input type="text" name="page_main_color" value="'.esc_attr($sel_v).'" class="admin-color-field" data-default-color="" />';

	echo '<p><strong>'.esc_html__('Gradient Color', 'farvis').'</strong></p>';
	$sel_g = get_post_meta($post->ID, 'page_gradient_color', 1);
	echo '<input type="text" name="page_gradient_color" value="'.esc_attr($sel_g).'" class="admin-color-field" data-default-color="" />';

	echo '<p><strong>'.esc_html__('Additional Color', 'farvis').'</strong></p>';
	$sel_a = get_post_meta($post->ID, 'page_additional_color', 1);
	echo '<input type="text" name="page_additional_color" value="'.esc_attr($sel_a).'" class="admin-color-field" data-default-color="" />';

	echo '<p><label for="header_logo" class="row-title">'.esc_html__('Header Logo Light', 'farvis').'</label>';
	$sel_logo = get_post_meta($post->ID, 'header_logo', true);
    echo '	<input type="text" name="header_logo" id="header_logo" value="'.esc_url($sel_logo).'" />
            <button data-input="header_logo" class="btn pix-image-upload pix-btn-icon"><i class="fa fa-picture-o"></i></button>
            <button type="button" class="btn pix-reset pix-btn-icon"><i class="fa fa-trash-o"></i></button>
    </p>';
    if($sel_logo){
        echo '<p class="pix-bg-png"> <img src="'.esc_url($sel_logo).'" alt="'.esc_attr__('Logo Light', 'farvis').'"> </p>';
    }

    echo '<p><label for="header_logo_inverse" class="row-title">'.esc_html__('Header Logo Dark', 'farvis').'</label>';
	$sel_logo_inverse = get_post_meta($post->ID, 'header_logo_inverse', true);
    echo '	<input type="text" name="header_logo_inverse" id="header_logo_inverse" value="'.esc_url($sel_logo_inverse).'" />
            <button data-input="header_logo_inverse" class="btn pix-image-upload pix-btn-icon"><i class="fa fa-picture-o"></i></button>
            <button type="button" class="btn pix-reset pix-btn-icon"><i class="fa fa-trash-o"></i></button>
    </p>';
    if($sel_logo_inverse){
        echo '<p class="pix-bg-png"> <img src="'.esc_url($sel_logo_inverse).'" alt="'.esc_attr__('Logo Dark', 'farvis').'"> </p>';
    }

	echo '<p><strong>'.esc_html__('Background Color', 'farvis').'</strong></p>';
	$sel_a = get_post_meta($post->ID, 'page_bg_color', 1);
	echo '<input type="text" name="page_bg_color" value="'.esc_attr($sel_a).'" class="admin-color-field" data-default-color="" />';

    echo '<p><label for="boxed_bg_image" class="row-title">'.esc_html__('Boxed Background Image', 'farvis').'</label>';
	$sel_bg = get_post_meta($post->ID, 'boxed_bg_image', true);
    echo '	<input type="text" name="boxed_bg_image" id="boxed_bg_image" value="'.esc_url($sel_bg).'" />
            <button data-input="boxed_bg_image" class="btn pix-image-upload pix-btn-icon"><i class="fa fa-picture-o"></i></button>
            <button type="button" class="btn pix-reset pix-btn-icon"><i class="fa fa-trash-o"></i></button>
    </p>';
    if($sel_bg){
        echo '<p class="pix-bg"> <img src="'.esc_url($sel_bg).'" alt="'.esc_attr__('Page Background', 'farvis').'"> </p>';
    }

}


add_action( 'save_post', 'farvis_layout_side_save' );
function farvis_layout_side_save( $post_id ) {
	if ( !empty($_POST['extra_fields_nonce']) && !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
	if ( !current_user_can('edit_post', $post_id) ) return false; 

	if( !isset($_POST['page_main_color'])
		&& !isset($_POST['page_gradient_color'])
		&& !isset($_POST['page_additional_color'])
		&& !isset($_POST['header_logo'])
		&& !isset($_POST['header_logo_inverse'])
		&& !isset($_POST['boxed_bg_image'])
		&& !isset($_POST['page_bg_color'])
	) return false;	
	
	$_POST['header_logo_inverse'] = trim($_POST['header_logo_inverse']);
	$_POST['header_logo'] = trim($_POST['header_logo']);
	$_POST['boxed_bg_image'] = trim($_POST['boxed_bg_image']);
	$_POST['page_main_color'] = trim($_POST['page_main_color']);
	$_POST['page_gradient_color'] = trim($_POST['page_gradient_color']);
	$_POST['page_additional_color'] = trim($_POST['page_additional_color']);
	$_POST['page_bg_color'] = trim($_POST['page_bg_color']);
	

	if( !isset($_POST['page_main_color']) ){
		delete_post_meta($post_id, 'page_main_color');
	}else{
		update_post_meta($post_id, 'page_main_color', $_POST['page_main_color']);
	}

	if( !isset($_POST['page_gradient_color']) ){
		delete_post_meta($post_id, 'page_gradient_color');
	}else{
		update_post_meta($post_id, 'page_gradient_color', $_POST['page_gradient_color']);
	}
	
	if( !isset($_POST['page_additional_color']) ){
		delete_post_meta($post_id, 'page_additional_color');
	}else{
		update_post_meta($post_id, 'page_additional_color', $_POST['page_additional_color']);
	}

	if( !isset($_POST['header_logo']) ){
		delete_post_meta($post_id, 'header_logo');
	}else{
		update_post_meta($post_id, 'header_logo', $_POST['header_logo']);
	}

	if( !isset($_POST['header_logo_inverse']) ){
		delete_post_meta($post_id, 'header_logo_inverse');
	}else{
		update_post_meta($post_id, 'header_logo_inverse', $_POST['header_logo_inverse']);
	}
	
	if( !isset($_POST['boxed_bg_image']) ){
		delete_post_meta($post_id, 'boxed_bg_image'); 
	}else{
		update_post_meta($post_id, 'boxed_bg_image', $_POST['boxed_bg_image']); 
	}

	if( !isset($_POST['page_bg_color']) ){
		delete_post_meta($post_id, 'page_bg_color');
	}else{
		update_post_meta($post_id, 'page_bg_color', $_POST['page_bg_color']);
	}

	return $post_id;
}


function farvis_header_set_content( $post ) {

	echo '<p><strong>'.esc_html__('Header Type', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_type" />';
	$sel_ht = get_post_meta($post->ID, 'header_type', 1);
	echo '	<option value="" '.esc_attr(selected( $sel_ht, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="header1" '.esc_attr(selected( $sel_ht, 'header1', false )).' >'.esc_html__('Classic', 'farvis').'</option>
            <option value="header2" '.esc_attr(selected( $sel_ht, 'header2', false )).' >'.esc_html__('Shop', 'farvis').'</option>
            <option value="header3" '.esc_attr(selected( $sel_ht, 'header3', false )).' >'.esc_html__('Sidebar', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Sidebar View', 'farvis').'</strong><br>'.esc_html__('(only for header type Sidebar)', 'farvis').'</p><p><select class="rwmb-select" name="header_sidebar_view" />';
	$sel_side = get_post_meta($post->ID, 'header_sidebar_view', 1);
	echo '	<option value="" '.esc_attr(selected( $sel_side, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="fixed" '.esc_attr(selected( $sel_side, 'fixed', false )).' >'.esc_html__('Fixed', 'farvis').'</option>
            <option value="horizontal" '.esc_attr(selected( $sel_side, 'horizontal', false )).' >'.esc_html__('Horizontal Button', 'farvis').'</option>
            <option value="vertical" '.esc_attr(selected( $sel_side, 'vertical', false )).' >'.esc_html__('Vertical Button', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Header Behavior', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_sticky" />';
	$sel_sticky = get_post_meta($post->ID, 'header_sticky', true);
    echo '	<option value="" '.esc_attr(selected( $sel_sticky, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="0" '.esc_attr(selected( $sel_sticky, '0', false )).' >'.esc_html__('Default', 'farvis').'</option>
            <option value="sticky" '.esc_attr(selected( $sel_sticky, 'sticky', false )).' >'.esc_html__('Sticky Top', 'farvis').'</option>
            <option value="fixed" '.esc_attr(selected( $sel_sticky, 'fixed', false )).' >'.esc_html__('Sticky and Scroll', 'farvis').'</option>
            <option value="scroll" '.esc_attr(selected( $sel_sticky, 'scroll', false )).' >'.esc_html__('Sticky Scroll', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Show Main Menu', 'farvis').'</strong><p><select class="rwmb-select" name="header_menu" />';
	$sel_menu = get_post_meta($post->ID, 'header_menu', true);
	echo '	<option value="" '.esc_attr(selected( $sel_menu, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
			<option value="1" '.esc_attr(selected( $sel_menu, '1', false )).' >'.esc_html__('Yes', 'farvis').'</option>
            <option value="0" '.esc_attr(selected( $sel_menu, '0', false )).' >'.esc_html__('No', 'farvis').'</option>
        </select>
        </p>';

	echo '<p><strong>'.esc_html__('Additional Menu', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_menu_add_position" />';
	$sel_add_position = get_post_meta($post->ID, 'header_menu_add_position', true);
    echo '	<option value="" '.esc_attr(selected( $sel_add_position, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="left" '.esc_attr(selected( $sel_add_position, 'left', false )).' >'.esc_html__('Left Sidebar', 'farvis').'</option>
            <option value="right" '.esc_attr(selected( $sel_add_position, 'right', false )).' >'.esc_html__('Right Sidebar', 'farvis').'</option>
            <option value="top" '.esc_attr(selected( $sel_add_position, 'top', false )).' >'.esc_html__('Top Sidebar', 'farvis').'</option>
            <option value="bottom" '.esc_attr(selected( $sel_add_position, 'bottom', false )).' >'.esc_html__('Bottom Sidebar', 'farvis').'</option>
            <option value="screen" '.esc_attr(selected( $sel_add_position, 'screen', false )).' >'.esc_html__('Full Screen', 'farvis').'</option>
            <option value="disable" '.esc_attr(selected( $sel_add_position, 'disable', false )).' >'.esc_html__('Disable', 'farvis').'</option>
        </select></p>';

	echo '<input type="hidden" name="extra_fields_nonce" value="'.esc_attr(wp_create_nonce(__FILE__)).'" />';
}


add_action( 'save_post', 'farvis_header_set_save' );
function farvis_header_set_save( $post_id ) {
	if ( !empty($_POST['extra_fields_nonce']) && !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
	if ( !current_user_can('edit_post', $post_id) ) return false;

	if( !isset($_POST['header_type'])
		&& !isset($_POST['header_sidebar_view'])
		&& !isset($_POST['header_sticky'])
		&& !isset($_POST['header_menu'])
		&& !isset($_POST['header_menu_add_position'])
	) return false;


	if( !isset($_POST['header_type']) ){
        delete_post_meta($post_id, 'header_type');
    }else{
        update_post_meta($post_id, 'header_type', $_POST['header_type']);
    }

	if( !isset($_POST['header_sidebar_view']) ){
        delete_post_meta($post_id, 'header_sidebar_view');
    }else{
        update_post_meta($post_id, 'header_sidebar_view', $_POST['header_sidebar_view']);
    }

	if( !isset($_POST['header_sticky']) ){
		delete_post_meta($post_id, 'header_sticky');
	}else{
		update_post_meta($post_id, 'header_sticky', $_POST['header_sticky']);
	}

    if( !isset($_POST['header_menu']) ){
        delete_post_meta($post_id, 'header_menu');
    }else{
        update_post_meta($post_id, 'header_menu', $_POST['header_menu']);
    }

    if( !isset($_POST['header_menu_add_position']) ){
        delete_post_meta($post_id, 'header_menu_add_position');
    }else{
        update_post_meta($post_id, 'header_menu_add_position', $_POST['header_menu_add_position']);
    }

	return $post_id;
}





function farvis_header_style_content( $post ) {

	echo '<p><strong>'.esc_html__('Header Background', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_background" />';
	$sel_background = get_post_meta($post->ID, 'header_background', true);
    echo '	<option value="" '.esc_attr(selected( $sel_background, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="white" '.esc_attr(selected( $sel_background, 'white', false )).' >'.esc_html__('White', 'farvis').'</option>
            <option value="black" '.esc_attr(selected( $sel_background, 'black', false )).' >'.esc_html__('Black', 'farvis').'</option>
            <option value="trans-white" '.esc_attr(selected( $sel_background, 'trans-white', false )).' >'.esc_html__('Transparent White', 'farvis').'</option>
            <option value="trans-black" '.esc_attr(selected( $sel_background, 'trans-black', false )).' >'.esc_html__('Transparent Black', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Header Transparent', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_transparent" />';
	$sel_trans = get_post_meta($post->ID, 'header_transparent', true);
    echo '	<option value="" '.esc_attr(selected( $sel_trans, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="0" '.esc_attr(selected( $sel_trans, '0', false )).' >0.0</option>
            <option value="1" '.esc_attr(selected( $sel_trans, '1', false )).' >0.1</option>
            <option value="2" '.esc_attr(selected( $sel_trans, '2', false )).' >0.2</option>
            <option value="3" '.esc_attr(selected( $sel_trans, '3', false )).' >0.3</option>
            <option value="4" '.esc_attr(selected( $sel_trans, '4', false )).' >0.4</option>
            <option value="5" '.esc_attr(selected( $sel_trans, '5', false )).' >0.5</option>
            <option value="6" '.esc_attr(selected( $sel_trans, '6', false )).' >0.6</option>
            <option value="7" '.esc_attr(selected( $sel_trans, '7', false )).' >0.7</option>
            <option value="8" '.esc_attr(selected( $sel_trans, '8', false )).' >0.8</option>
            <option value="9" '.esc_attr(selected( $sel_trans, '9', false )).' >0.9</option>
        </select></p>';
        
	echo '<p><strong>'.esc_html__('Menu Hover Effect', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_hover_effect" />';
	$sel_hover = get_post_meta($post->ID, 'header_hover_effect', true);
    echo '	<option value="" '.esc_attr(selected( $sel_hover, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="0" '.esc_attr(selected( $sel_hover, '0', false )).' >'.esc_html__('Without effect', 'farvis').'</option>
            <option value="1" '.esc_attr(selected( $sel_hover, '1', false )).' >a</option>
            <option value="3" '.esc_attr(selected( $sel_hover, '3', false )).' >b</option>
            <option value="4" '.esc_attr(selected( $sel_hover, '4', false )).' >c</option>
            <option value="8" '.esc_attr(selected( $sel_hover, '8', false )).' >f</option>
            <option value="9" '.esc_attr(selected( $sel_hover, '9', false )).' >g</option>
            <option value="12" '.esc_attr(selected( $sel_hover, '12', false )).' >i</option>
            <option value="14" '.esc_attr(selected( $sel_hover, '14', false )).' >k</option>
            <option value="17" '.esc_attr(selected( $sel_hover, '17', false )).' >l</option>
            <option value="18" '.esc_attr(selected( $sel_hover, '18', false )).' >m</option>

  
        </select></p>';

	echo '<p><strong>'.esc_html__('Menu Markers', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_marker" />';
	$sel_marker = get_post_meta($post->ID, 'header_marker', true);
    echo '	<option value="" '.esc_attr(selected( $sel_marker, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="menu-marker-arrow" '.esc_attr(selected( $sel_marker, 'menu-marker-arrow', false )).' >'.esc_html__('Arrows', 'farvis').'</option>
            <option value="menu-marker-dot" '.esc_attr(selected( $sel_marker, 'menu-marker-dot', false )).' >'.esc_html__('Dots', 'farvis').'</option>
            <option value="no-marker" '.esc_attr(selected( $sel_marker, 'no-marker', false )).' >'.esc_html__('Without markers', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Header Layout', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_layout" />';
	$sel_layout = get_post_meta($post->ID, 'header_layout', true);
    echo '	<option value="" '.esc_attr(selected( $sel_layout, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="normal" '.esc_attr(selected( $sel_layout, 'normal', false )).' >'.esc_html__('Normal', 'farvis').'</option>
            <option value="boxed" '.esc_attr(selected( $sel_layout, 'boxed', false )).' >'.esc_html__('Boxed', 'farvis').'</option>
            <option value="full" '.esc_attr(selected( $sel_layout, 'full', false )).' >'.esc_html__('Full Width', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Sidebar Menu Animation', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_menu_animation" />';
	$sel_animation = get_post_meta($post->ID, 'header_menu_animation', true);
    echo '	<option value="" '.esc_attr(selected( $sel_animation, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="overlay" '.esc_attr(selected( $sel_animation, 'overlay', false )).' >'.esc_html__('Overlay', 'farvis').'</option>
            <option value="reveal" '.esc_attr(selected( $sel_animation, 'reveal', false )).' >'.esc_html__('Reveal', 'farvis').'</option>
        </select></p>';

	echo '<input type="hidden" name="extra_fields_nonce" value="'.esc_attr(wp_create_nonce(__FILE__)).'" />';
}

add_action( 'save_post', 'farvis_header_style_save' );
function farvis_header_style_save( $post_id ) {
	if ( !empty($_POST['extra_fields_nonce']) && !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
	if ( !current_user_can('edit_post', $post_id) ) return false;

	if( !isset($_POST['header_background'])
		&& !isset($_POST['header_transparent'])
		&& !isset($_POST['header_hover_effect'])
		&& !isset($_POST['header_marker'])
		&& !isset($_POST['header_layout'])
		&& !isset($_POST['header_menu_animation'])
	) return false;


	if( !isset($_POST['header_background']) ){
		delete_post_meta($post_id, 'header_background');
	}else{
		update_post_meta($post_id, 'header_background', $_POST['header_background']);
	}

	if( !isset($_POST['header_transparent']) ){
		delete_post_meta($post_id, 'header_transparent');
	}else{
		update_post_meta($post_id, 'header_transparent', $_POST['header_transparent']);
	}

	if( !isset($_POST['header_hover_effect']) ){
		delete_post_meta($post_id, 'header_hover_effect');
	}else{
		update_post_meta($post_id, 'header_hover_effect', $_POST['header_hover_effect']);
	}

	if( !isset($_POST['header_marker']) ){
		delete_post_meta($post_id, 'header_marker');
	}else{
		update_post_meta($post_id, 'header_marker', $_POST['header_marker']);
	}

	if( !isset($_POST['header_layout']) ){
		delete_post_meta($post_id, 'header_layout');
	}else{
		update_post_meta($post_id, 'header_layout', $_POST['header_layout']);
	}

    if( !isset($_POST['header_menu_animation']) ){
        delete_post_meta($post_id, 'header_menu_animation');
    }else{
        update_post_meta($post_id, 'header_menu_animation', $_POST['header_menu_animation']);
    }


	return $post_id;
}



function farvis_header_elements_content( $post ) {

	echo '<p><strong>'.esc_html__('Show Top Bar', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_bar" />';
	$sel_bar = get_post_meta($post->ID, 'header_bar', true);
	echo '	<option value="" '.esc_attr(selected( $sel_bar, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
			<option value="1" '.esc_attr(selected( $sel_bar, '1', false )).' >'.esc_html__('Yes', 'farvis').'</option>
            <option value="0" '.esc_attr(selected( $sel_bar, '0', false )).' >'.esc_html__('No', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Show Minicart', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_minicart" />';
	$sel_minicart = get_post_meta($post->ID, 'header_minicart', true);
    echo '	<option value="" '.esc_attr(selected( $sel_minicart, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="1" '.esc_attr(selected( $sel_minicart, '1', false )).' >'.esc_html__('Yes', 'farvis').'</option>
            <option value="0" '.esc_attr(selected( $sel_minicart, '0', false )).' >'.esc_html__('No', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Show Search', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_search" />';
	$sel_search = get_post_meta($post->ID, 'header_search', true);
    echo '	<option value="" '.esc_attr(selected( $sel_search, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="1" '.esc_attr(selected( $sel_search, '1', false )).' >'.esc_html__('Yes', 'farvis').'</option>
            <option value="0" '.esc_attr(selected( $sel_search, '0', false )).' >'.esc_html__('No', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Show Socials', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_socials" />';
	$sel_socials = get_post_meta($post->ID, 'header_socials', true);
    echo '	<option value="" '.esc_attr(selected( $sel_socials, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="1" '.esc_attr(selected( $sel_socials, '1', false )).' >'.esc_html__('Yes', 'farvis').'</option>
            <option value="0" '.esc_attr(selected( $sel_socials, '0', false )).' >'.esc_html__('No', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Show Phone', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_phone" />';
	$sel_phone = get_post_meta($post->ID, 'header_phone', true);
    echo '	<option value="" '.esc_attr(selected( $sel_phone, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="1" '.esc_attr(selected( $sel_phone, '1', false )).' >'.esc_html__('Yes', 'farvis').'</option>
            <option value="0" '.esc_attr(selected( $sel_phone, '0', false )).' >'.esc_html__('No', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Show E-mail', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_email" />';
	$sel_email = get_post_meta($post->ID, 'header_email', true);
    echo '	<option value="" '.esc_attr(selected( $sel_email, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="1" '.esc_attr(selected( $sel_email, '1', false )).' >'.esc_html__('Yes', 'farvis').'</option>
            <option value="0" '.esc_attr(selected( $sel_email, '0', false )).' >'.esc_html__('No', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Top Bar Email Position', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_topbarbox_1_position" />';
	$sel_top1 = get_post_meta($post->ID, 'header_topbarbox_1_position', true);
	echo '	<option value="" '.esc_attr(selected( $sel_top1, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
			<option value="left" '.esc_attr(selected( $sel_top1, 'left', false )).' >'.esc_html__('Left', 'farvis').'</option>
            <option value="right" '.esc_attr(selected( $sel_top1, 'right', false )).' >'.esc_html__('Right', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Top Bar Menu Position', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_topbarbox_2_position" />';
	$sel_top2 = get_post_meta($post->ID, 'header_topbarbox_2_position', true);
	echo '	<option value="" '.esc_attr(selected( $sel_top2, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
			<option value="left" '.esc_attr(selected( $sel_top2, 'left', false )).' >'.esc_html__('Left', 'farvis').'</option>
            <option value="right" '.esc_attr(selected( $sel_top2, 'right', false )).' >'.esc_html__('Right', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Logo Position', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_navibox_1_position" />';
	$sel_nav1 = get_post_meta($post->ID, 'header_navibox_1_position', true);
	echo '	<option value="" '.esc_attr(selected( $sel_nav1, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
			<option value="left" '.esc_attr(selected( $sel_nav1, 'left', false )).' >'.esc_html__('Left', 'farvis').'</option>
            <option value="right" '.esc_attr(selected( $sel_nav1, 'right', false )).' >'.esc_html__('Right', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Main Menu Position', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_navibox_2_position" />';
	$sel_nav2 = get_post_meta($post->ID, 'header_navibox_2_position', true);
	echo '	<option value="" '.esc_attr(selected( $sel_nav2, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
			<option value="left" '.esc_attr(selected( $sel_nav2, 'left', false )).' >'.esc_html__('Left', 'farvis').'</option>
            <option value="right" '.esc_attr(selected( $sel_nav2, 'right', false )).' >'.esc_html__('Right', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Socials And Phone Position', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_navibox_3_position" />';
	$sel_nav3 = get_post_meta($post->ID, 'header_navibox_3_position', true);
	echo '	<option value="" '.esc_attr(selected( $sel_nav3, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
			<option value="left" '.esc_attr(selected( $sel_nav3, 'left', false )).' >'.esc_html__('Left', 'farvis').'</option>
            <option value="right" '.esc_attr(selected( $sel_nav3, 'right', false )).' >'.esc_html__('Right', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Minicart Position', 'farvis').'</strong></p><p><select class="rwmb-select" name="header_navibox_4_position" />';
	$sel_nav4 = get_post_meta($post->ID, 'header_navibox_4_position', true);
	echo '	<option value="" '.esc_attr(selected( $sel_nav4, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
			<option value="left" '.esc_attr(selected( $sel_nav4, 'left', false )).' >'.esc_html__('Left', 'farvis').'</option>
            <option value="right" '.esc_attr(selected( $sel_nav4, 'right', false )).' >'.esc_html__('Right', 'farvis').'</option>
        </select></p>';

	echo '<input type="hidden" name="extra_fields_nonce" value="'.esc_attr(wp_create_nonce(__FILE__)).'" />';
}


add_action( 'save_post', 'farvis_header_elements_save' );
function farvis_header_elements_save( $post_id ) {
	if ( !empty($_POST['extra_fields_nonce']) && !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
	if ( !current_user_can('edit_post', $post_id) ) return false;

	if( !isset($_POST['header_minicart'])
		&& !isset($_POST['header_bar'])
		&& !isset($_POST['header_search'])
		&& !isset($_POST['header_socials'])
		&& !isset($_POST['header_phone'])
		&& !isset($_POST['header_email'])
		&& !isset($_POST['header_topbarbox_1_position'])
		&& !isset($_POST['header_topbarbox_2_position'])
		&& !isset($_POST['header_navibox_1_position'])
		&& !isset($_POST['header_navibox_2_position'])
		&& !isset($_POST['header_navibox_3_position'])
		&& !isset($_POST['header_navibox_4_position'])
	) return false;


    if( !isset($_POST['header_bar']) ){
        delete_post_meta($post_id, 'header_bar');
    }else{
        update_post_meta($post_id, 'header_bar', $_POST['header_bar']);
    }

    if( !isset($_POST['header_minicart']) ){
        delete_post_meta($post_id, 'header_minicart');
    }else{
        update_post_meta($post_id, 'header_minicart', $_POST['header_minicart']);
    }

    if( !isset($_POST['header_search']) ){
        delete_post_meta($post_id, 'header_search');
    }else{
        update_post_meta($post_id, 'header_search', $_POST['header_search']);
    }

    if( !isset($_POST['header_socials']) ){
        delete_post_meta($post_id, 'header_socials');
    }else{
        update_post_meta($post_id, 'header_socials', $_POST['header_socials']);
    }

	if( !isset($_POST['header_phone']) ){
		delete_post_meta($post_id, 'header_phone');
	}else{
		update_post_meta($post_id, 'header_phone', $_POST['header_phone']);
	}

	if( !isset($_POST['header_email']) ){
		delete_post_meta($post_id, 'header_email');
	}else{
		update_post_meta($post_id, 'header_email', $_POST['header_email']);
	}

	if( !isset($_POST['header_topbarbox_1_position']) ){
		delete_post_meta($post_id, 'header_topbarbox_1_position');
	}else{
		update_post_meta($post_id, 'header_topbarbox_1_position', $_POST['header_topbarbox_1_position']);
	}

	if( !isset($_POST['header_topbarbox_2_position']) ){
		delete_post_meta($post_id, 'header_topbarbox_2_position');
	}else{
		update_post_meta($post_id, 'header_topbarbox_2_position', $_POST['header_topbarbox_2_position']);
	}

	if( !isset($_POST['header_navibox_1_position']) ){
		delete_post_meta($post_id, 'header_navibox_1_position');
	}else{
		update_post_meta($post_id, 'header_navibox_1_position', $_POST['header_navibox_1_position']);
	}

	if( !isset($_POST['header_navibox_2_position']) ){
		delete_post_meta($post_id, 'header_navibox_2_position');
	}else{
		update_post_meta($post_id, 'header_navibox_2_position', $_POST['header_navibox_2_position']);
	}

	if( !isset($_POST['header_navibox_3_position']) ){
		delete_post_meta($post_id, 'header_navibox_3_position');
	}else{
		update_post_meta($post_id, 'header_navibox_3_position', $_POST['header_navibox_3_position']);
	}

	if( !isset($_POST['header_navibox_4_position']) ){
		delete_post_meta($post_id, 'header_navibox_4_position');
	}else{
		update_post_meta($post_id, 'header_navibox_4_position', $_POST['header_navibox_4_position']);
	}

	return $post_id;
}



function farvis_header_responsive_content( $post ) {

	echo '<p><strong>'.esc_html__('Header Mobile Behavior', 'farvis').'</strong></p><p><select class="rwmb-select" name="mobile_sticky" />';
	$sel_mobs = get_post_meta($post->ID, 'mobile_sticky', true);
	echo '	<option value="" '.esc_attr(selected( $sel_mobs, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
			<option value="mobile-no-sticky" '.esc_attr(selected( $sel_mobs, 'mobile-no-stickyv', false )).' >'.esc_html__('No Sticky', 'farvis').'</option>
            <option value="mobile-no-fixed" '.esc_attr(selected( $sel_mobs, 'mobile-no-fixedv', false )).' >'.esc_html__('No Fixed', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Mobile Top Bar', 'farvis').'</strong></p><p><select class="rwmb-select" name="mobile_topbar" />';
	$sel_mobt = get_post_meta($post->ID, 'mobile_topbar', true);
    echo '	<option value="" '.esc_attr(selected( $sel_mobt, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="no-mobile-topbar" '.esc_attr(selected( $sel_mobt, 'no-mobile-topbar', false )).' >'.esc_html__('Off', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Tablet Minicart', 'farvis').'</strong></p><p><select class="rwmb-select" name="tablet_minicart" />';
	$sel_search = get_post_meta($post->ID, 'tablet_minicart', true);
    echo '	<option value="" '.esc_attr(selected( $sel_search, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="no-tablet-minicart" '.esc_attr(selected( $sel_search, 'no-tablet-minicart', false )).' >'.esc_html__('Off', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Tablet Search', 'farvis').'</strong></p><p><select class="rwmb-select" name="tablet_search" />';
	$sel_socials = get_post_meta($post->ID, 'tablet_searcht', true);
    echo '	<option value="" '.esc_attr(selected( $sel_socials, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="no-tablet-search" '.esc_attr(selected( $sel_socials, 'no-tablet-search', false )).' >'.esc_html__('Off', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Tablet Header Phone', 'farvis').'</strong></p><p><select class="rwmb-select" name="tablet_phone" />';
	$sel_phone = get_post_meta($post->ID, 'tablet_phone', true);
    echo '	<option value="" '.esc_attr(selected( $sel_phone, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="no-tablet-phone" '.esc_attr(selected( $sel_phone, 'no-tablet-phone', false )).' >'.esc_html__('Off', 'farvis').'</option>
        </select></p>';

	echo '<p><strong>'.esc_html__('Tablet Socials', 'farvis').'</strong></p><p><select class="rwmb-select" name="tablet_socials" />';
	$sel_email = get_post_meta($post->ID, 'tablet_socials', true);
    echo '	<option value="" '.esc_attr(selected( $sel_email, '', false )).' >'.esc_html__('Global', 'farvis').'</option>
            <option value="no-tablet-socials" '.esc_attr(selected( $sel_email, 'no-tablet-socials', false )).' >'.esc_html__('Off', 'farvis').'</option>
        </select></p>';

	echo '<input type="hidden" name="extra_fields_nonce" value="'.esc_attr(wp_create_nonce(__FILE__)).'" />';
}


add_action( 'save_post', 'farvis_header_responsive_save' );
function farvis_header_responsive_save( $post_id ) {
	if ( !empty($_POST['extra_fields_nonce']) && !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
	if ( !current_user_can('edit_post', $post_id) ) return false;

	if( !isset($_POST['mobile_sticky'])
		&& !isset($_POST['mobile_topbar'])
		&& !isset($_POST['tablet_minicart'])
		&& !isset($_POST['tablet_search'])
		&& !isset($_POST['tablet_phone'])
		&& !isset($_POST['tablet_socials'])
	) return false;


    if( !isset($_POST['mobile_sticky']) ){
        delete_post_meta($post_id, 'mobile_sticky');
    }else{
        update_post_meta($post_id, 'mobile_sticky', $_POST['mobile_sticky']);
    }

    if( !isset($_POST['mobile_topbar']) ){
        delete_post_meta($post_id, 'mobile_topbar');
    }else{
        update_post_meta($post_id, 'mobile_topbar', $_POST['mobile_topbar']);
    }

    if( !isset($_POST['tablet_minicart']) ){
        delete_post_meta($post_id, 'tablet_minicart');
    }else{
        update_post_meta($post_id, 'tablet_minicart', $_POST['tablet_minicart']);
    }

    if( !isset($_POST['tablet_search']) ){
        delete_post_meta($post_id, 'tablet_search');
    }else{
        update_post_meta($post_id, 'tablet_search', $_POST['tablet_search']);
    }

	if( !isset($_POST['tablet_phone']) ){
		delete_post_meta($post_id, 'tablet_phone');
	}else{
		update_post_meta($post_id, 'tablet_phone', $_POST['tablet_phone']);
	}

	if( !isset($_POST['tablet_socials']) ){
		delete_post_meta($post_id, 'tablet_socials');
	}else{
		update_post_meta($post_id, 'tablet_socials', $_POST['tablet_socials']);
	}

	return $post_id;
}

/********* ==> END HEADER SETTINGS ***********/



/** START SIDEBAR OPTIONS */

function farvis_sidebar_options(){
	global $post;
	$post_id = $post;
	if (is_object($post_id)) {
		$post_id = $post_id->ID;
	}
	

	$selected_page_layout = (get_post_meta($post_id, 'page_layout', true) == "") ? '' : get_post_meta($post_id, 'page_layout', true);
	$selected_sidebar_layout = (get_post_meta($post_id, 'pix_page_layout', true) == "") ? 2 : get_post_meta($post_id, 'pix_page_layout', true);
	$fixed_footer = (get_post_meta($post_id, 'pix_fixed_footer', true) == "") ? '' : get_post_meta($post_id, 'pix_fixed_footer', true);

	// BOTTOM FOOTER BLOCK
	$selected_footer_block = (get_post_meta($post_id, 'pix_page_footer_staticblock', true) == "") ? 'global' : get_post_meta($post_id, 'pix_page_footer_staticblock', true);

	// TOP FOOTER BLOCK
	$selected_top_footer_block = (get_post_meta($post_id, 'pix_page_top_footer_staticblock', true) == "") ? 'global' : get_post_meta($post_id, 'pix_page_top_footer_staticblock', true);

	$args = array(
		'post_type'        => 'staticblocks',
		'post_status'      => 'publish',
	);
	$staticBlocks = array();
	$staticBlocks['global'] = esc_html__('Use global settings','farvis');
	$staticBlocksData = get_posts( $args );
	foreach($staticBlocksData as $_block){
		$staticBlocks[$_block->ID] =  $_block->post_title;
	}
	$staticBlocks['nofooter'] = esc_html__('No Footer','farvis');

	
	$selected_sidebar = get_post_meta($post_id, 'pix_selected_sidebar', true);

	if(!is_array($selected_sidebar)){
		$tmp = $selected_sidebar; 
		$selected_sidebar = array(); 
		$selected_sidebar[0] = $tmp;
	}
	
	?>

	<p><strong><?php echo esc_html__('Layout', 'farvis')?></strong></p>

	<select class="rwmb-select" name="page_layout" id="page_layout" size="0">
		<option value="" <?php if ($selected_page_layout == ''):?>selected="selected"<?php endif?>><?php echo esc_html__('Global', 'farvis')?></option>
		<option value="normal" <?php if ($selected_page_layout == 'normal'):?>selected="selected"<?php endif?>><?php echo esc_html__('Normal', 'farvis')?></option>
		<option value="full-width" <?php if ($selected_page_layout == 'full-width'):?>selected="selected"<?php endif?>><?php echo esc_html__('Full width', 'farvis')?></option>
		<option value="boxed" <?php if ($selected_page_layout == 'boxed'):?>selected="selected"<?php endif?>><?php echo esc_html__('Boxed', 'farvis')?></option>
	</select>
	<?php ?>

	<p><strong><?php echo esc_html__('Sidebar', 'farvis')?></strong></p>
	
	<select class="rwmb-select" name="pix_page_layout" id="pix_page_layout" size="0">
		<option value="" <?php if ($selected_sidebar_layout == ''):?>selected="selected"<?php endif?>><?php echo esc_html__('Global', 'farvis')?></option>
		<option value="1" <?php if ($selected_sidebar_layout == 1):?>selected="selected"<?php endif?>><?php echo esc_html__('Without Sidebar', 'farvis')?></option>
		<option value="2" <?php if ($selected_sidebar_layout == 2):?>selected="selected"<?php endif?>><?php echo esc_html__('Right Sidebar', 'farvis')?></option>
		<option value="3" <?php if ($selected_sidebar_layout == 3):?>selected="selected"<?php endif?>><?php echo esc_html__('Left Sidebar', 'farvis')?></option>
	</select>
	<?php ?>
	
	<p><strong><?php echo esc_html__('Sidebar content', 'farvis')?></strong></p>
	<ul>
	<?php 
	global $wp_registered_sidebars;
	//var_dump($wp_registered_sidebars);		
		for($i=0;$i<1;$i++){ ?>
			<li>
			<select name="sidebar_content[<?php echo esc_attr($i)?>]">
				<!--<option value=""<?php if($selected_sidebar[$i] == ''){ echo " selected";} ?>><?php echo esc_html__('WP Default Sidebar', 'farvis')?></option>-->
			<?php
			$sidebars = $wp_registered_sidebars;
			if(is_array($sidebars) && !empty($sidebars)){
				foreach($sidebars as $sidebar){
					if($selected_sidebar[$i] == $sidebar['id']){
						echo "<option value='".esc_attr($sidebar['id'])."' selected>{$sidebar['name']}</option>\n";
					}else{
						echo "<option value='".esc_attr($sidebar['id'])."'>{$sidebar['name']}</option>\n";
					}
				}
			}
			?>
			</select>
			</li>
		<?php } ?>
	</ul>


	<?php // top footer ?>
	<p><strong><?php echo esc_html__('Top Footer Static Block', 'farvis')?></strong></p>
	<ul>

			<li>
			<select name="pix_page_top_footer_staticblock">
			<?php foreach($staticBlocks as $id => $_staticBlock){
					if($id == $selected_top_footer_block){
						echo "<option value='".esc_attr($id)."' selected>".esc_attr($_staticBlock)."</option>\n";
					}else{
						echo "<option value='".esc_attr($id)."'>".esc_attr($_staticBlock)."</option>\n";
					}
				}
			?>
			</select>
			</li>
	</ul>

	<?php // bottom footer ?>
	<p><strong><?php echo esc_html__('Bottom Footer Static Block', 'farvis')?></strong></p>
	<ul>

			<li>
			<select name="pix_page_footer_staticblock">
			<?php foreach($staticBlocks as $id => $_staticBlock){
					if ( $id == $selected_footer_block ){
						echo "<option value='".esc_attr($id)."' selected>".esc_attr($_staticBlock)."</option>\n";
					}else{
						echo "<option value='".esc_attr($id)."'>".esc_attr($_staticBlock)."</option>\n";
					}
				}
			?>
			</select>
			</li>
	</ul>

	<p><strong><?php echo esc_html__('Fixed', 'farvis')?></strong></p>

	<select class="rwmb-select" name="pix_fixed_footer" id="pix_fixed_footer" size="0">
		<option value="" <?php if ($fixed_footer == ''):?>selected="selected"<?php endif?>><?php echo esc_html__('Global', 'farvis')?></option>
		<option value="0" <?php if ($fixed_footer == '0'):?>selected="selected"<?php endif?>><?php echo esc_html__('No', 'farvis')?></option>
		<option value="1" <?php if ($fixed_footer == '1'):?>selected="selected"<?php endif?>><?php echo esc_html__('Yes', 'farvis')?></option>
	</select>

<?php }

/** END SIDEBAR OPTIONS */


/** START WOO LAYOUT OPTIONS */

function farvis_woo_layout(){
	global $post;
	$post_id = $post;
	if (is_object($post_id)) {
		$post_id = $post_id->ID;
	}

	$selected_woo_layout = (get_post_meta($post_id, 'pix_woo_layout', true) == "") ? '' : get_post_meta($post_id, 'pix_woo_layout', true);

	?>

	<p><strong><?php echo esc_html__('Woocommerce Layout', 'farvis')?></strong></p>

	<select class="rwmb-select" name="pix_woo_layout" id="pix_woo_layout" size="0">
		<option value="" <?php if ($selected_woo_layout == ''):?>selected="selected"<?php endif?>><?php echo esc_html__('Global', 'farvis')?></option>
		<option value="default" <?php if ($selected_woo_layout == 'default'):?>selected="selected"<?php endif?>><?php echo esc_html__('Default', 'farvis')?></option>
		<option value="hover" <?php if ($selected_woo_layout == 'hover'):?>selected="selected"<?php endif?>><?php echo esc_html__('Hover Info', 'farvis')?></option>
	</select>

<?php }

/** END WOO LAYOUT OPTIONS */


/** START PORTFOLIO LAYOUT OPTIONS */

function farvis_portfolio_layout_options(){
	global $post;
	$post_id = $post;
	if (is_object($post_id)) {
		$post_id = $post_id->ID;
	}

	$selected_portfolio_type_layout = (get_post_meta($post_id, 'pix_portfolio_layout', true) == "") ? '' : get_post_meta($post_id, 'pix_portfolio_layout', true);
	$selected_puzzle = get_post_meta($post_id, 'pix_puzzle_size', 1);
	?>
	
	<p><strong><?php esc_attr_e('Puzzle Size', 'farvis')?></strong></p>
	<select class="rwmb-select" name="pix_puzzle_size" />
		<option value="" <?php echo esc_attr(selected( $selected_puzzle, '' ))?> ><?php esc_attr_e('Default', 'farvis')?></option>
		<option value="pix-puzzle-thumb-x" <?php echo esc_attr(selected( $selected_puzzle, 'pix-puzzle-thumb-x' ))?> ><?php esc_attr_e('Horizontal', 'farvis')?></option>
		<option value="pix-puzzle-thumb-y" <?php echo esc_attr(selected( $selected_puzzle, 'pix-puzzle-thumb-y' ))?> ><?php esc_attr_e('Vertical', 'farvis')?></option>
		<option value="pix-puzzle-thumb-xy" <?php echo esc_attr(selected( $selected_puzzle, 'pix-puzzle-thumb-xy' ))?> ><?php esc_attr_e('Minimal', 'farvis')?></option>
	</select>
	
	<p><strong><?php esc_attr_e('Portfolio Layout', 'farvis')?></strong></p>

	<select class="rwmb-select" name="pix_portfolio_layout" id="pix_portfolio_layout" size="0">
		<option value="" <?php if ($selected_portfolio_type_layout == ''):?>selected="selected"<?php endif?>><?php echo esc_html__('Global', 'farvis')?></option>
		<option value="default" <?php if ($selected_portfolio_type_layout == 'default'):?>selected="selected"<?php endif?>><?php echo esc_html__('Default', 'farvis')?></option>
		<option value="centered" <?php if ($selected_portfolio_type_layout == 'centered'):?>selected="selected"<?php endif?>><?php echo esc_html__('Centered Gallery', 'farvis')?></option>
		<option value="isotope" <?php if ($selected_portfolio_type_layout == 'isotope'):?>selected="selected"<?php endif?>><?php echo esc_html__('Isotope Gallery', 'farvis')?></option>
		<option value="stack" <?php if ($selected_portfolio_type_layout == 'stack'):?>selected="selected"<?php endif?>><?php echo esc_html__('Stack Gallery with Sidebar', 'farvis')?></option>
		<option value="custom-sidebar" <?php if ($selected_portfolio_type_layout == 'custom-sidebar'):?>selected="selected"<?php endif?>><?php echo esc_html__('Custom Layout with Sidebar', 'farvis')?></option>
		<option value="custom" <?php if ($selected_portfolio_type_layout == 'custom'):?>selected="selected"<?php endif?>><?php echo esc_html__('Custom Layout', 'farvis')?></option>
	</select>

<?php }

/** END PORTFOLIO LAYOUT OPTIONS */

function farvis_save_postdata( $post_id ) {
	
	if ( wp_is_post_revision( $post_id ) )
		return;
		
		
	global $post, $new_meta_boxes;

	
	if(isset($new_meta_boxes))
	foreach($new_meta_boxes as $meta_box) {
		
		if ( $meta_box['type'] != 'title)' ) {
		
			if ( 'page' == $_POST['post_type'] ) {
				if ( !current_user_can( 'edit_page', $post_id ))
					return $post_id;
			} else {
				if ( !current_user_can( 'edit_post', $post_id ))
					return $post_id;
			}
			
			if (isset($_POST[$meta_box['name']]) && is_array($_POST[$meta_box['name']]) ) {
				$cats = '';
				foreach($_POST[$meta_box['name']] as $cat){
					$cats .= $cat . ",";
				}
				$data = substr($cats, 0, -1);
			}
			
			else { $data = ''; if(isset($_POST[$meta_box['name']])) $data = $_POST[$meta_box['name']]; }			
			
			if(get_post_meta($post_id, $meta_box['name']) == "")
				add_post_meta($post_id, $meta_box['name'], $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'], true))
				update_post_meta($post_id, $meta_box['name'], $data);
			elseif($data == "")
				delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
				
		}
	}

	farvis_save_sidebar_data( $post_id );
	
}

function farvis_save_sidebar_data( $post_id ){

	if (isset($_POST['page_layout'])){
		if(get_post_meta($post_id, 'page_layout') == "")
			add_post_meta($post_id, 'page_layout', $_POST['page_layout'], true);
		else
			update_post_meta($post_id, 'page_layout', $_POST['page_layout']);
	}

	if (isset($_POST['pix_page_layout'])){
		if(get_post_meta($post_id, 'pix_page_layout') == "")
			add_post_meta($post_id, 'pix_page_layout', $_POST['pix_page_layout'], true);
		else
			update_post_meta($post_id, 'pix_page_layout', $_POST['pix_page_layout']);
	}
	
	if (isset($_POST['sidebar_content'][0])){
		if(get_post_meta($post_id, 'pix_page_layout') == "")
			add_post_meta($post_id, 'pix_selected_sidebar', $_POST['sidebar_content'][0], true);
		else
			update_post_meta($post_id, 'pix_selected_sidebar', $_POST['sidebar_content'][0]);
	}
	if (isset($_POST['pix_page_top_footer_staticblock'])){
		if(get_post_meta($post_id, 'pix_page_top_footer_staticblock') == "")
			add_post_meta($post_id, 'pix_page_top_footer_staticblock', $_POST['pix_page_top_footer_staticblock'], true);
		else
			update_post_meta($post_id, 'pix_page_top_footer_staticblock', $_POST['pix_page_top_footer_staticblock']);
	}

	if (isset($_POST['pix_page_footer_staticblock'])){
		if(get_post_meta($post_id, 'pix_page_footer_staticblock') == "")
			add_post_meta($post_id, 'pix_page_footer_staticblock', $_POST['pix_page_footer_staticblock'], true);
		else
			update_post_meta($post_id, 'pix_page_footer_staticblock', $_POST['pix_page_footer_staticblock']);
	}

	if (isset($_POST['pix_fixed_footer'])){
		if(get_post_meta($post_id, 'pix_fixed_footer') == "")
			add_post_meta($post_id, 'pix_fixed_footer', $_POST['pix_fixed_footer'], true);
		else
			update_post_meta($post_id, 'pix_fixed_footer', $_POST['pix_fixed_footer']);
	}

	if (isset($_POST['pix_woo_layout'])){
		if(get_post_meta($post_id, 'pix_woo_layout') == "")
			add_post_meta($post_id, 'pix_woo_layout', $_POST['pix_woo_layout'], true);
		else
			update_post_meta($post_id, 'pix_woo_layout', $_POST['pix_woo_layout']);
	}

	if (isset($_POST['pix_portfolio_layout'])){
		if(get_post_meta($post_id, 'pix_portfolio_layout') == "")
			add_post_meta($post_id, 'pix_portfolio_layout', $_POST['pix_portfolio_layout'], true);
		else
			update_post_meta($post_id, 'pix_portfolio_layout', $_POST['pix_portfolio_layout']);
	}

	if (isset($_POST['pix_puzzle_size'])){
		if(get_post_meta($post_id, 'pix_puzzle_size') == "")
			add_post_meta($post_id, 'pix_puzzle_size', $_POST['pix_puzzle_size'], true);
		else
			update_post_meta($post_id, 'pix_puzzle_size', $_POST['pix_puzzle_size']);
	}
}

add_action('save_post', 'farvis_save_postdata');


/********* PAGE FONTS ==> ***********/


function farvis_layout_fonts_content( $post ) {

	echo '<p><strong>'.esc_html__('Font', 'farvis').'</strong></p>';
	$sel_f = preg_split('/\:/', get_post_meta($post->ID, 'page_google_font', 1));
	$fv = isset($sel_f[1]) ? $sel_f[1] : '';
	echo '<p><select class="rwmb-select" name="pix-google-font" id="pix-google-font" />
			<option value="">'.esc_html__('Select Google Font', 'farvis').'</option>
		  </select>
		  <input type="hidden" id="pix-google-family" name="page_google_font" value="'.esc_attr(str_replace('+', ' ', $sel_f[0])).'">
		  <input type="hidden" id="pix-font-variants" value="'.esc_attr($fv).'">
		  </p>
		  <div id="pix-font-content"></div>';


	echo '<p><strong>'.esc_html__('Title Font', 'farvis').'</strong></p>';
	$sel_ft = preg_split('/\:/', get_post_meta($post->ID, 'page_google_font_title', 1));
	$fv = isset($sel_ft[1]) ? $sel_ft[1] : '';
	echo '<p><select class="rwmb-select" name="pix-google-font-title" id="pix-google-font-title" />
			<option value="">'.esc_html__('Select Google Font', 'farvis').'</option>
		  </select>
		  <input type="hidden" id="pix-google-family-title" name="page_google_font_title" value="'.esc_attr(str_replace('+', ' ', $sel_ft[0])).'">
		  <input type="hidden" id="pix-font-variants-title" value="'.esc_attr($fv).'">
		  </p>
		  <div id="pix-font-content-title"></div>';

	echo '<input type="hidden" name="extra_fields_nonce" value="'.esc_attr(wp_create_nonce(__FILE__)).'" />';
}


add_action( 'save_post', 'farvis_layout_fonts_save' );
function farvis_layout_fonts_save( $post_id ) {
	if ( !empty($_POST['extra_fields_nonce']) && !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;
	if ( !current_user_can('edit_post', $post_id) ) return false;

	if( !isset($_POST['page_google_font'])
		&& !isset($_POST['page_google_font_title'])
	) return false;	// ������� ���� ������ ���

	// ��� ��! ������, ����� ���������/������� ������
	$_POST['page_google_font'] = str_replace(' ', '+', trim($_POST['page_google_font']));
	$_POST['page_google_font_title'] = str_replace(' ', '+', trim($_POST['page_google_font_title']));

	if( empty($_POST['page_google_font']) ){
		delete_post_meta($post_id, 'page_google_font');
	}else{
		update_post_meta($post_id, 'page_google_font', $_POST['font_variants'] == '' ? $_POST['page_google_font'] : $_POST['page_google_font'].':'.implode(',',$_POST['font_variants']));
	}

	if( empty($_POST['page_google_font_title']) ){
		delete_post_meta($post_id, 'page_google_font_title');
	}else{
		update_post_meta($post_id, 'page_google_font_title', $_POST['font_variants_title'] == '' ? $_POST['page_google_font_title'] : $_POST['page_google_font_title'].':'.implode(',',$_POST['font_variants_title']));
	}

	return $post_id;
}

?>
