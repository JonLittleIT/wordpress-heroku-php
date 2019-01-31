<?php


if(!function_exists('amos_routing_frontpage')){
    
    add_action('init', 'amos_routing_frontpage');

    function amos_routing_frontpage(){
        
        global $amos_redata;

        if(!empty($amos_redata['frontpage'])){
        	add_filter('pre_option_show_on_front', 'amos_show_on_front_filter');
			add_filter('pre_option_page_on_front', 'amos_page_on_front_filter');

			if(!empty($amos_redata['blogpage'])){
				add_filter('pre_option_page_for_posts', 'amos_page_for_posts_filter');
			}
        }

	}

	function amos_show_on_front_filter($attr) { return 'page'; }
	function amos_page_on_front_filter($attr) { 
		global $amos_redata; 
		return $amos_redata['frontpage']; 
	}
	function amos_page_for_posts_filter($attr){ 
		global $amos_redata; 
		return $amos_redata['blogpage']; 
	}
    
}


if(!function_exists('amos_routing_template'))
{

	add_action('amos_routing_template', 'amos_routing_template');

	function amos_routing_template( $current_template = false )
	{
		global $amos_config, $for_online, $amos_redata, $post;
		$dynamic_id = "";
		

		if(isset($post)) $dynamic_id = $post->ID;
		$frontpage = $amos_redata['frontpage'];
        $blogpage = $amos_redata['blogpage'];
     
        
        /* FRONTPAGE QUERY */
        if($frontpage && isset($amos_config['new_query']) && $amos_config['new_query']['page_id'] == $frontpage)
		{
			$dynamic_id = $frontpage;

		}


		/* BLOG QUERY */
        if(isset($post) && $blogpage == $post->ID && !isset($amos_config['new_query']))
		{ 	
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
											
			get_template_part( 'template', 'blog' ); exit();
		}
		/* For Online */
		if(isset($post) && $post->ID == 7780){
			$amos_redata['bloglayout'] = 'sidebar_left';
			$amos_redata['blog_style'] = 'normal';
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}	
		if(isset($post) && $post->ID == 7861){
			$amos_redata['bloglayout'] = 'sidebar_right';
			$amos_redata['blog_style'] = 'normal';
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}
		if(isset($post) && $post->ID == 7866){
			$amos_redata['bloglayout'] = 'fullwidth';
			$amos_redata['blog_style'] = 'normal';
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}	
		if(isset($post) && $post->ID == 8004){
			$amos_redata['bloglayout'] = 'dual';
			$amos_redata['blog_style'] = 'normal';
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}	
		if(isset($post) && $post->ID == 7977){
			$amos_redata['bloglayout'] = 'sidebar_right';
			$amos_redata['blog_style'] = 'alternate';
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}
		if(isset($post) && $post->ID == 7979){
			$amos_redata['bloglayout'] = 'sidebar_left';
			$amos_redata['blog_style'] = 'alternate';
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}
		if(isset($post) && $post->ID == 7981){
			$amos_redata['bloglayout'] = 'fullwidth';
			$amos_redata['blog_style'] = 'alternate';
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));	
			$for_online = true;									
			get_template_part( 'template', 'blog' ); exit();
		}
		if(isset($post) && $post->ID == 7989){
			$amos_redata['bloglayout'] = 'fullwidth';
			$amos_redata['blog_style'] = 'grid';
			$amos_redata['blog_grid_col'] = 3;
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));
			$for_online = true;										
			get_template_part( 'template', 'blog' ); exit();
		}	
		if(isset($post) && $post->ID == 7991){
			$amos_redata['bloglayout'] = 'sidebar_left';
			$amos_redata['blog_style'] = 'grid';
			$amos_redata['blog_grid_col'] = 2;
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));
			$for_online = true;										
			get_template_part( 'template', 'blog' ); exit();
		}

		if(isset($post) && $post->ID == 7992){
			$amos_redata['bloglayout'] = 'sidebar_right';
			$amos_redata['blog_style'] = 'grid';
			$amos_redata['blog_grid_col'] = 2;
			$amos_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												    'posts_per_page' => get_option('posts_per_page'));
			$for_online = true;										
			get_template_part( 'template', 'blog' ); exit();
		}
		if(isset($post) && $post->ID == 6617){
			$amos_redata['singlebloglayout'] = 'sidebar_right';
			$amos_redata['blog_post_style'] = 'normal';
			$for_online = true;										
			get_template_part( 'includes/view/blog/loop', 'index' ); exit();
		}
		
					
		/* End For Online */
		
		
		
		
	}
}

if(!function_exists('amos_set_portfolio_query')){
    function amos_set_portfolio_query()
	{
		global $amos_redata;
		
		$terms = $amos_redata['portfolio_categories'];

		$p_per_page = 6;
		switch($amos_redata['portfolio_columns']){
			case '1':
				$p_per_page = 3;
			    break;
			case '2':
				$p_per_page = 6;
				break;
			case '3':
				$p_per_page = 9;
				break;
			case '4':
				$p_per_page = 12;
				break;
			case '5':
				$p_per_page = 10;
				break;
		}
		if(isset($terms[0]) && !empty($terms[0]) && !is_null($terms[0]) && $terms[0] != "null")
		{	
			$new_query = array(						
													'orderby' 	=> 'ID', 
												    'order' 	=> 'DESC', 
												    'paged' 	=> get_query_var( 'page' ), 
												    'posts_per_page' => $p_per_page,  
												    'tax_query' => array( 	array( 	'taxonomy' 	=> 'portfolio_entries', 
																				    'field' 	=> 'id', 
																				    'terms' 	=> $terms, 	
																				    'operator' 	=> 'IN')));
		}
		else
		{
			$new_query = array(						'paged' 		 => get_query_var( 'page' ),  
												    'posts_per_page' => -1,  
												    'post_type' 	 => 'portfolio'); 
		}

		query_posts($new_query);
	}
}

if(!function_exists('amos_execute_query')){
    add_action('amos_excecute_query_var_action', 'amos_execute_query');

    function amos_execute_query($temp = false){
        global $amos_config;
        if(isset($amos_config['new_query'])){
            query_posts($amos_config['new_query']);
        }
    }
}

function is_vc(){
	preg_match_all('/\[vc_row(.*?)\]/', get_the_content((int) amos_get_post_id()), $matches );
	if ( isset($matches[0]) && !empty($matches[0]) )
		return true;
	return false;
}
?>