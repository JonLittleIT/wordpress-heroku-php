<?php

add_action('init', 'amos_slider_register', 1);


function amos_slider_register() 

{



	$labels = array(

		'name' => __('Slides post type general name', 'amos'),

		'all_items'	=> __('Slides','amos' ),

		'singular_name' => __('Slide post type singular name', 'amos'),

		'menu_name'	=> __('Amos Slider','amos' ),

		'add_new' => __('Add New Slide slide', 'amos'),

		'add_new_item' => __('Add New Slide', 'amos'),

		'edit_item' => __('Edit Slide', 'amos'),

		'new_item' => __('New Slide', 'amos'),

		'view_item' => __('View Slide', 'amos'),

		'search_items' => __('Search Slides', 'amos'),

		'not_found' =>  __('No Slides found', 'amos'),

		'not_found_in_trash' => __('No Slides found in Trash', 'amos'), 

		'parent_item_colon' => ''

	);



	$args = array(

		'labels' => $labels,

		'public' => true,

		'show_ui' => true,

		'capability_type' => 'post',

		'hierarchical' => false,

		'rewrite' => array('slug'=>'slides','with_front'=>true),

		'query_var' => true,

		'show_in_nav_menus'=> false,

		'supports' => array('title')

	);

	

	

	

	

	

	$labels = array(
			
			'menu_name' => __( 'Sliders','amos' ),

			'name' => __( 'Sliders taxonomy general name', 'amos' ),

			'singular_name' => __( 'Slider taxonomy singular name', 'amos' ),

			'all_items' => __( 'All Sliders','amos' ),

			'search_items' =>  __( 'Search Sliders','amos' ),

			'parent_item' => __( 'Parent Slider','amos' ),

			'parent_item_colon' => __( 'Parent Slider:','amos' ),

			'update_item' => __( 'Update Slider','amos' ),

			'add_new_item' => __( 'Add New Slider','amos' ),

			'edit_item' => __( 'Edit Slider','amos' ), 

			'new_item_name' => __( 'New Slider Name','amos' )

			
	 );     

	 

}



add_filter("manage_edit-slide_columns", "slide_edit_columns");

add_action("manage_posts_custom_column",  "slide_custom_columns");



function slide_edit_columns($columns)

{

	$newcolumns = array(

		"cb" => "<input type=\"checkbox\" />",

		

		"title" => "Title",

		"slides" => "Sliders"

	);

	

	$columns= array_merge($newcolumns, $columns);

	

	return $columns;

}



/**

 * prod_custom_columns()

 * 

 * @param mixed $column

 * @return

 */

function slide_custom_columns($column)

{

	global $post;

	switch ($column)

	{

	

		case "description":

		

		break;

		case "price":

		

		break;

		case "slider":

		echo get_the_term_list($post->ID, 'slider', '', ', ','');

		break;

	}

}

?>