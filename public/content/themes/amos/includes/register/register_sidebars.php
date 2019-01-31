<?php
if(function_exists('register_sidebar')){
    
    function amos_register_sidebars_init(){
        $amos_redata = amos_redata_variable();
        global $amos_redata;
        
        register_sidebar(array(
            'name' => esc_html__('Sidebar Blog', 'amos'),
            'id' => 'sidebar-blog',
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
            'after_widget' => '</div>', 
            'before_title' => '<h6 class="widget-title">', 
            'after_title' => '</h6>'
        ));
      
        register_sidebar(array(
                'name' => esc_html__('Sidebar Pages', 'amos'),
                'id' => 'sidebar-pages',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h6 class="widget-title">', 
                'after_title' => '</h6>'
        ));
        register_sidebar(array(
                'name' => esc_html__('Sidebar Portfolio', 'amos'),
                'id' => 'sidebar-portfolio',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h6 class="widget-title">', 
                'after_title' => '</h6>'
        ));

        register_sidebar(array( 
                'name' => esc_html__('Top Header Left', 'amos'),
                'id' => 'top-header-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '', 
                'after_title' => ''
        ));

        register_sidebar(array(
                'name' => esc_html__('Top Header Right', 'amos'),
                'id' => 'top-header-right',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '', 
                'after_title' => ''
        ));

        if(isset($amos_redata['footer_columns'])):
            $footer_columns = $amos_redata['footer_columns'];
            
            for ($i = 1; $i <= $footer_columns; $i++)
            {
                register_sidebar(array(
                    'name' => 'Footer - column'.$i,
                    'id' => 'footer-column-'.$i,
                    'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                    'after_widget' => '</div>', 
                    'before_title' => '<h6 class="widget-title">', 
                    'after_title' => '</h6>', 
                ));
            }
        endif;

        register_sidebar(array(
                'name' => esc_html__('Copyright Footer Sidebar', 'amos'),
                'id' => 'copyright',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '', 
                'after_title' => ''
        ));
        
            

        if(isset($amos_redata['pages_sidebar'])):    
            $id_array = $amos_redata['pages_sidebar'];
                if(isset($id_array[0]))
                {
                    foreach ($id_array as $page_id)
                    {   
                        
                        if($page_id != "")
                        register_sidebar(array(
                            'name' => esc_html__('Page','amos').': '.get_the_title($page_id).'',
                            'id' => 'page-'.get_the_title($page_id),
                            'before_widget' => '<div id="%1$s" class="widget %2$s ">', 
                            'after_widget' => '</div>', 
                            'before_title' => '<h6 class="widget-title">', 
                    'after_title' => '</h6>'
                        ));
                    
                    
                    }
                }
        endif;
                
            
            
        if(isset($amos_redata['categories_sidebar'])):       
            $id_array = $amos_redata['categories_sidebar'];
        
            if(isset($id_array[0]))
            {
                foreach ($id_array as $cat_id)
                {   
                    
                    if($cat_id != "")
                    register_sidebar(array(
                        'name' => esc_html__('Category','amos').': '.get_the_category_by_ID($cat_id).'',
                        'id' => 'category-'.get_the_category_by_ID($cat_id),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                        'after_widget' => '</div>', 
                        'before_title' => '<h6 class="widget-title">', 
                        'after_title' => '</h6>'        )); 
                
                
              }
           }
        endif;




        if(isset($amos_redata['extra_navigation']) && $amos_redata['extra_navigation']){
            register_sidebar(array(
                'name' => esc_html__('Extra Side Navigation', 'amos'),
                'id' => 'sidenav',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h6 class="widget-title">', 
                'after_title' => '</h6>'
            ));
        }

        if(class_exists('Woocommerce')){
            register_sidebar(array(
                'name' => esc_html__('Sidebar Woocommerce', 'amos'),
                'id' => 'woocommerce',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h6 class="widget-title">',   
                'after_title' => '</h6>'
            ));
        }

        if(!empty($amos_redata['menu_presets']) && $amos_redata['menu_presets'] == 'h8' || !empty($amos_redata['menu_presets']) && $amos_redata['menu_presets'] == 'h9'){
            register_sidebar(array(
                'name' => esc_html__('Header Widgetized Area', 'amos'),
                'id' => 'header-widgetized-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h6 class="widget-title">',   
                'after_title' => '</h6>'
            ));
        }

        if(!empty($amos_redata['menu_presets']) && ($amos_redata['menu_presets'] == 'h6' || $amos_redata['menu_presets'] == 'h7') ){
            register_sidebar(array(
                'name' => esc_html__('After Navigation Area', 'amos'),
                'id' => 'after-navigation-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h6 class="widget-title">',   
                'after_title' => '</h6>'
            ));
        }

         if(isset($amos_redata['search_widgets']) && $amos_redata['search_widgets'] == 1 ){
            register_sidebar(array(
                'name' => esc_html__('Search Widget Left', 'amos'),
                'id' => 'search-widget-left-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h6 class="widget-title">',   
                'after_title' => '</h6>'
            ));
            register_sidebar(array(
                'name' => esc_html__('Search Widget Right', 'amos'),
                'id' => 'search-widget-right-area',
                'before_widget' => '<div id="%1$s" class="widget %2$s">', 
                'after_widget' => '</div>', 
                'before_title' => '<h6 class="widget-title">',   
                'after_title' => '</h6>'
            ));
        }


    }
    add_action( 'widgets_init', 'amos_register_sidebars_init' );
        
}

?>