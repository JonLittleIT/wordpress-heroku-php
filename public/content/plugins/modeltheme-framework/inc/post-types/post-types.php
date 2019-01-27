<?php


/**

||-> CPT - [testimonial]

*/
function smartowl_testimonial_custom_post() {

    register_post_type('Testimonial', array(
                        'label' => __('Testimonials','modeltheme'),
                        'description' => '',
                        'public' => true,
                        'show_ui' => true,
                        'show_in_menu' => true,
                        'capability_type' => 'post',
                        'map_meta_cap' => true,
                        'hierarchical' => false,
                        'rewrite' => array('slug' => 'testimonial', 'with_front' => true),
                        'query_var' => true,
                        'menu_position' => '1',
                        'menu_icon' => 'dashicons-format-status',
                        'supports' => array('title','editor','thumbnail','author','excerpt'),
                        'labels' => array (
                            'name' => __('Testimonials','modeltheme'),
                            'singular_name' => __('Testimonial','modeltheme'),
                            'menu_name' => __('MT Testimonials','modeltheme'),
                            'add_new' => __('Add Testimonial','modeltheme'),
                            'add_new_item' => __('Add New Testimonial','modeltheme'),
                            'edit' => __('Edit','modeltheme'),
                            'edit_item' => __('Edit Testimonial','modeltheme'),
                            'new_item' => __('New Testimonial','modeltheme'),
                            'view' => __('View Testimonial','modeltheme'),
                            'view_item' => __('View Testimonial','modeltheme'),
                            'search_items' => __('Search Testimonials','modeltheme'),
                            'not_found' => __('No Testimonials Found','modeltheme'),
                            'not_found_in_trash' => __('No Testimonials Found in Trash','modeltheme'),
                            'parent' => __('Parent Testimonial','modeltheme'),
                            )
                        ) 
                    ); 
}
add_action('init', 'smartowl_testimonial_custom_post');





/**

||-> CPT - [client]

*/
function connection_client_custom_post() {

    register_post_type('Clients', array(
                        'label' => __('Clients','modeltheme'),
                        'description' => '',
                        'public' => true,
                        'show_ui' => true,
                        'show_in_menu' => true,
                        'capability_type' => 'post',
                        'map_meta_cap' => true,
                        'hierarchical' => false,
                        'rewrite' => array('slug' => 'client', 'with_front' => true),
                        'query_var' => true,
                        'menu_position' => '1',
                        'menu_icon' => 'dashicons-businessman',
                        'supports' => array('title','editor','thumbnail','author','excerpt'),
                        'labels' => array (
                            'name' => __('Clients','modeltheme'),
                            'singular_name' => __('Client','modeltheme'),
                            'menu_name' => __('MT Clients','modeltheme'),
                            'add_new' => __('Add Client','modeltheme'),
                            'add_new_item' => __('Add New Client','modeltheme'),
                            'edit' => __('Edit','modeltheme'),
                            'edit_item' => __('Edit Client','modeltheme'),
                            'new_item' => __('New Client','modeltheme'),
                            'view' => __('View Client','modeltheme'),
                            'view_item' => __('View Client','modeltheme'),
                            'search_items' => __('Search Clients','modeltheme'),
                            'not_found' => __('No Clients Found','modeltheme'),
                            'not_found_in_trash' => __('No Clients Found in Trash','modeltheme'),
                            'parent' => __('Parent Client','modeltheme'),
                            )
                        ) 
                    ); 
}
add_action('init', 'connection_client_custom_post');


/**

||-> CPT - [member]

*/
function smartowl_members_custom_post() {

    register_post_type('member', array(
                        'label' => __('Members','modeltheme'),
                        'description' => '',
                        'public' => true,
                        'show_ui' => true,
                        'show_in_menu' => true,
                        'capability_type' => 'post',
                        'map_meta_cap' => true,
                        'hierarchical' => false,
                        'rewrite' => array('slug' => 'member', 'with_front' => true),
                        'query_var' => true,
                        'menu_position' => '1',
                        'menu_icon' => 'dashicons-businessman',
                        'supports' => array('title','editor','thumbnail','author','excerpt'),
                        'labels' => array (
                            'name' => __('Members','modeltheme'),
                            'singular_name' => __('Member','modeltheme'),
                            'menu_name' => __('MT Members','modeltheme'),
                            'add_new' => __('Add Member','modeltheme'),
                            'add_new_item' => __('Add New Member','modeltheme'),
                            'edit' => __('Edit','modeltheme'),
                            'edit_item' => __('Edit Member','modeltheme'),
                            'new_item' => __('New Member','modeltheme'),
                            'view' => __('View Member','modeltheme'),
                            'view_item' => __('View Member','modeltheme'),
                            'search_items' => __('Search Members','modeltheme'),
                            'not_found' => __('No Members Found','modeltheme'),
                            'not_found_in_trash' => __('No Members Found in Trash','modeltheme'),
                            'parent' => __('Parent Member','modeltheme'),
                            )
                        ) 
                    ); 
}
add_action('init', 'smartowl_members_custom_post');


/**

||-> CPT - [member] category


*/
function smartowl_members_category_custom_post() {
    
    $labels = array(
        'name'                       => _x( 'Categories', 'Taxonomy General Name', 'modeltheme' ),
        'singular_name'              => _x( 'Members', 'Taxonomy Singular Name', 'modeltheme' ),
        'menu_name'                  => __( 'Members Categories', 'modeltheme' ),
        'all_items'                  => __( 'All Items', 'modeltheme' ),
        'parent_item'                => __( 'Parent Item', 'modeltheme' ),
        'parent_item_colon'          => __( 'Parent Item:', 'modeltheme' ),
        'new_item_name'              => __( 'New Item Name', 'modeltheme' ),
        'add_new_item'               => __( 'Add New Item', 'modeltheme' ),
        'edit_item'                  => __( 'Edit Item', 'modeltheme' ),
        'update_item'                => __( 'Update Item', 'modeltheme' ),
        'view_item'                  => __( 'View Item', 'modeltheme' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'modeltheme' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'modeltheme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'modeltheme' ),
        'popular_items'              => __( 'Popular Items', 'modeltheme' ),
        'search_items'               => __( 'Search Items', 'modeltheme' ),
        'not_found'                  => __( 'Not Found', 'modeltheme' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'mt-member-category', array( 'member' ), $args );
}
add_action( 'init', 'smartowl_members_category_custom_post' );



/**

||-> CPT - [portfolio]

*/
function mt_portfolio_custom_post() {

    register_post_type('Portfolio', array(
                        'label' => __('Portfolios','modeltheme'),
                        'description' => '',
                        'public' => true,
                        'show_ui' => true,
                        'show_in_menu' => true,
                        'capability_type' => 'post',
                        'map_meta_cap' => true,
                        'hierarchical' => false,
                        'rewrite' => array('slug' => 'portfolio', 'with_front' => true),
                        'query_var' => true,
                        'menu_position' => '1',
                        'menu_icon' => 'dashicons-portfolio',
                        'supports' => array('title','editor','thumbnail','author','excerpt'),
                        'labels' => array (
                            'name' => __('Portfolios','modeltheme'),
                            'singular_name' => __('Portfolio','modeltheme'),
                            'menu_name' => __('MT Portfolios','modeltheme'),
                            'add_new' => __('Add Portfolio','modeltheme'),
                            'add_new_item' => __('Add New Portfolio','modeltheme'),
                            'edit' => __('Edit','modeltheme'),
                            'edit_item' => __('Edit Portfolio','modeltheme'),
                            'new_item' => __('New Portfolio','modeltheme'),
                            'view' => __('View Portfolio','modeltheme'),
                            'view_item' => __('View Portfolio','modeltheme'),
                            'search_items' => __('Search Portfolios','modeltheme'),
                            'not_found' => __('No Portfolios Found','modeltheme'),
                            'not_found_in_trash' => __('No Portfolios Found in Trash','modeltheme'),
                            'parent' => __('Parent Portfolio','modeltheme'),
                            )
                        ) 
                    ); 
}
add_action('init', 'mt_portfolio_custom_post');



/**

||-> TAX - [services]
||-> CPT - [service]

*/
function mt_portfolio_taxonomy() {
    
    $labels = array(
        'name'                       => _x( 'Portfolios', 'Taxonomy General Name', 'modeltheme' ),
        'singular_name'              => _x( 'Portfolio', 'Taxonomy Singular Name', 'modeltheme' ),
        'menu_name'                  => __( 'Portfolio Categories', 'modeltheme' ),
        'all_items'                  => __( 'All Items', 'modeltheme' ),
        'parent_item'                => __( 'Parent Item', 'modeltheme' ),
        'parent_item_colon'          => __( 'Parent Item:', 'modeltheme' ),
        'new_item_name'              => __( 'New Item Name', 'modeltheme' ),
        'add_new_item'               => __( 'Add New Item', 'modeltheme' ),
        'edit_item'                  => __( 'Edit Item', 'modeltheme' ),
        'update_item'                => __( 'Update Item', 'modeltheme' ),
        'view_item'                  => __( 'View Item', 'modeltheme' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'modeltheme' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'modeltheme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'modeltheme' ),
        'popular_items'              => __( 'Popular Items', 'modeltheme' ),
        'search_items'               => __( 'Search Items', 'modeltheme' ),
        'not_found'                  => __( 'Not Found', 'modeltheme' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'portfolios', array( 'portfolio' ), $args );
}
add_action( 'init', 'mt_portfolio_taxonomy' );



/**

||-> TAX - [portfolioskill]
||-> CPT - [portfolio]

*/
function mt_portfolio_tags_taxonomy() {
    
    $labels = array(
        'name'                       => _x( 'Skills', 'Taxonomy General Name', 'modeltheme' ),
        'singular_name'              => _x( 'Skill', 'Taxonomy Singular Name', 'modeltheme' ),
        'menu_name'                  => __( 'Portfolio Skills', 'modeltheme' ),
        'all_items'                  => __( 'All Items', 'modeltheme' ),
        'parent_item'                => __( 'Parent Item', 'modeltheme' ),
        'parent_item_colon'          => __( 'Parent Item:', 'modeltheme' ),
        'new_item_name'              => __( 'New Item Name', 'modeltheme' ),
        'add_new_item'               => __( 'Add New Item', 'modeltheme' ),
        'edit_item'                  => __( 'Edit Item', 'modeltheme' ),
        'update_item'                => __( 'Update Item', 'modeltheme' ),
        'view_item'                  => __( 'View Item', 'modeltheme' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'modeltheme' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'modeltheme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'modeltheme' ),
        'popular_items'              => __( 'Popular Items', 'modeltheme' ),
        'search_items'               => __( 'Search Items', 'modeltheme' ),
        'not_found'                  => __( 'Not Found', 'modeltheme' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'portfolioskill', array( 'portfolio' ), $args );
}
add_action( 'init', 'mt_portfolio_tags_taxonomy' );




?>