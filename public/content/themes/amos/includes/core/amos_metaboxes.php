<?php

// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = "amos_redata";
  $amos_redata = get_option( 'amos_redata' );
/*--------------------------------------SINGLE PORTFOLIO METABOXES------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_single_portfolio_metaboxes" ) ):
    function cl_add_single_portfolio_metaboxes($metaboxes) {
        global $amos_redata;
        $custom_fieldss = $amos_redata['single_portfolio_custom_params'];
        $portfolio_options = array();

        $page_style = array(
            'title'         => __('Page Style', 'amos'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'single_custom_link_switch',
                    'type' => 'switch',
                    'title' => __('Overwrite the link with your custom link', 'amos'),
                    'default' => 0// 1 = on | 0 = off
                ),
                array(
                    'id' => 'single_custom_link',
                    'title' => __( 'Add Custom Link', 'amos' ),
                    'type' => 'text',
                    'required' => array('single_custom_link_switch', '=', 1 )
                ), 
                array(
                    'id' => 'single_portfolio_style',
                    'title' => __( 'Select the style of the single portfolio', 'amos' ),
                    'desc' => 'Please select the style for the portfolio',
                    'type' => 'select',
                    'multi' => false,
                    'default' => 'container',
                    'options' => array('gallery' => 'Gallery Grid', 'floating' => 'Floating Sidebar', 'fullwidth' => 'Fullwidth Slider / Image / Video', 'container' => 'In Container Slider / Image / Video'),
                    'required' => array('single_portfolio_layout','=', 'normal')
                ),

                array(
                                'id' => 'single_portfolio_custom_color',
                                'type' => 'color_rgba',
                                'mode' => 'background-color',
                                'output' => array('.portfolio_single.custom_layout .media_container'),
                                'title' => __('Background color for media section', 'amos'),
                                'subtitle' => __('Select the color of the background of media section', 'amos'),
                                'default'   => array(
                                'color'     => '#fff',
                                'alpha'     => 1,
                                    ),
                                'required' => array('single_portfolio_layout', 'equals', 'custom')
                    ),

                array(
                    'id' => 'single_portfolio_content_position_floating',
                    'title' => __( 'Content Position', 'amos' ),
                    'desc' => 'Select the position for the content',
                    'type' => 'select',
                    'options' => array('left' => 'Left', 'right' => 'Right'),
                    'default' => 'right',
                    'required' => array(array('single_portfolio_style','=', 'floating'), array('single_portfolio_layout','=', 'normal'))
                ),
                array(
                    'id' => 'single_portfolio_content_position_container',
                    'title' => __( 'Content Position', 'amos' ),
                    'desc' => 'Select the position for the content',
                    'type' => 'select',
                    'options' => array('left' => 'Left', 'right' => 'Right', 'bottom' => 'Bottom'),
                    'default' => 'right',
                    'required' => array('single_portfolio_style','=', 'container'),
                    'required' => array(array('single_portfolio_style','=', 'floating'), array('single_portfolio_layout','=', 'normal'))
                ),
                array(
                    'id' => 'single_portfolio_media',
                    'title' => __( 'Media Type', 'amos' ),
                    'desc' => 'use feature image, video or slideshow. If you choose slideshow, add images in the gallery below',
                    'type' => 'select',
                    'options' => array('featured' => 'Featured Image', 'video' => 'Video', 'slideshow' => 'Slideshow'),
                    'default' => 'featured'
                ),
                array(
                    'id' => 'single_portfolio_video',
                    'title' => __( 'Video', 'amos' ),
                    'desc' => 'Youtube or vimeo video link or iframe',
                    'type' => 'text',
                    'required' => array('single_portfolio_media', '=', 'video' )
                ), 

                array(
                    'id' => 'single_portfolio_gallery',
                    'type' => 'slides',
                    'title' => __('Add/Edit Slides', 'amos'),
                    'subtitle' => __('Add new or edit existing slider images', 'amos'),
                    
                ),

                array(
                    'id' => 'single_portfolio_active_comments',
                    'type' => 'switch',
                    'title' => __('Switch On if you want comments functionality', 'amos'),
                    'default' => 0// 1 = on | 0 = off
                ),


                 
            ),
        );
        $description_fields = amos_getPortfolioFields();

        $custom_fields = array(
            'title'         => __('Project Details', 'amos'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id'=>'single_portfolio_custom_fields',
                    'type' => 'multi_text',
                    'title' => __('Custom fields Values', 'amos'),
                    'subtitle' => __('Create unlimited custom fields in Theme Options. Leave empty if you dont want to display this custom field', 'amos').'<br /><br />Fields:<br />'.trim($description_fields)
                ),
                 
            ),
        );

        $overview = array(
            'title'         => __('Project Overview', 'amos'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id'=>'single_portfolio_overview',
                    'type' => 'textarea', 
                    'default' => 'Simple Project Description',
                    'title' => __('Short Project Description', 'amos'),
                    'subtitle' => __('Add a short project description here.', 'amos')
                ),
                 
            ),
        );


        $portfolio_options[] = $page_style;
        $portfolio_options[] = $custom_fields;
        $portfolio_options[] = $overview;


        $metaboxes[] = array(
            'id'            => 'portfolio-options',
            'title'         => __( 'Single Portfolio Options', 'amos' ),
            'post_types'    => array( 'portfolio'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $portfolio_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_single_portfolio_metaboxes');
endif;

/*--------------------------------------END SINGLE PORTFOLIO METABOXES--------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/




/*--------------------------------------PORTFOLIO METABOXES-------------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_portfolio_metaboxes" ) ):
    function cl_add_portfolio_metaboxes($metaboxes) {
        
        $portfolio_options = array();

        $portfolio_options[] = array(
            //'title'         => __('General Settings', 'amos'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'portfolio_categories',
                    'title' => __( 'Portfolio Categories', 'amos' ),
                    'desc' => 'Please select the categories of portfolio items to connect with this page',
                    'type' => 'select',
                    'multi' => true,
                    'data' => 'categories',
                    'args' => array('orderby'=>'name', 'hide_empty'=> 0, 'taxonomy' => 'portfolio_entries')
                ),
                array(
                    'id' => 'portfolio_mode',
                    'title' => __( 'Portfolio Mode', 'amos' ),
                    'desc' => 'Select one mode to display items',
                    'type' => 'select',
                    'options' => array('grid' => 'Grid', 'masonry' => 'Masonry', 'pinterest' => 'Pinterest', 'parallax' => 'Parallax', 'split' => 'Splited Slider', 'slider' => 'Fullscreen Slider'),
                    'default' => 'grid'
                ),

                array(
                    'id' => 'portfolio_slider_content_position',
                    'title' => __( 'Portfolio Content position', 'amos' ),
                    'desc' => 'Select the content position in slider',
                    'type' => 'select',
                    'options' => array('center' => 'Centered', 'left' => 'Left', 'right' => 'Right'),
                    'default' => 'center',
                   'required' => array('portfolio_mode', 'equals', 'slider')
                ),

                array(
                    'id' => 'portfolio_slider_content_color',
                    'title' => __( 'Portfolio Content Light/Dark', 'amos' ),
                    'desc' => 'Select light or dark color of the content',
                    'type' => 'select',
                    'options' => array('light' => 'Light', 'dark' => 'Dark'),
                    'default' => 'light',
                   'required' => array('portfolio_mode', 'equals', 'slider')
                ),

                array(
                    'id' => 'portfolio_slider_overlay',
                    'type' => 'switch',
                    'title' => __('Turn on/off image overlay', 'amos'),
                    'subtitle' => __('Do you want image overlay background?', 'amos'),
                    'default' => 0,// 1 = on | 0 = off
                    'required' => array('portfolio_mode', 'equals', 'slider')
                ),
                array(
                                'id' => 'portfolio_slider_overlay_color',
                                'type' => 'color_rgba',
                                'mode' => 'background-color',
                                'output' => array('#portfolio-preview-items.slider .swiper-slide .overlay'),
                                'title' => __('Slider image overlay color', 'amos'),
                                'subtitle' => __('Select the color of the images overlay background', 'amos'),
                                'default'   => array(
                                'color'     => '#222',
                                'alpha'     => 0.8,
                                    ),
                                'required' => array(array('portfolio_mode', 'equals', 'slider'), array('portfolio_slider_overlay' ,'equals', 1))
                            ),

                array(
                    'id' => 'portfolio_columns',
                    'title' => __( 'Portfolio Columns', 'amos' ),
                    'desc' => 'Number of columns for the layout',
                    'type' => 'image_select',
                    'options'  => array(
                            '1'      => array(
                                'alt'   => '1 Column', 
                                'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                            ),
                            '2'      => array(
                                'alt'   => '2 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/2-col-portfolio.png'
                            ),
                            '3'      => array(
                                'alt'   => '3 Columns', 
                                'img'  => ReduxFramework::$_url.'assets/img/3-col-portfolio.png'
                            ),
                            '4'      => array(
                                'alt'   => '4 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/4-col-portfolio.png'
                            ),
                            '5'      => array(
                                'alt'   => '5 Columns', 
                                'img'   => ReduxFramework::$_url.'assets/img/5-col-portfolio.png'
                            )

                        ),
                    'default' => '3',
                    'required' => array(array('portfolio_mode', '!=', 'parallax'),array( 'portfolio_mode', '!=', 'split'), array('portfolio_mode', '!=', 'slider'))
                ),
                array(
                    'id' => 'portfolio_style',
                    'title' => __( 'Portfolio Style', 'amos' ),
                    'desc' => 'Select one style to display items',
                    'type' => 'select',
                    'options' => array('overlayed' => 'Overlayed with base color and zoom effect', 'grayscale' => 'Grayscale (Colored on hover)', 'basic' => 'Basic with Title and Description',  'zoom_lightbox'=>'Overlayed with lightbox', 'basic_effect' => 'Basic with Effect', 'chrome' => 'With Chrome Browser PNG'),
                    'default' => 'overlayed',
                    'required' => array(array('portfolio_mode', '!=', 'parallax'),array( 'portfolio_mode', '!=', 'split'), array('portfolio_mode', '!=', 'slider'))
                    
                ),
                array(
                    'id' => 'portfolio_layout',
                    'title' => __( 'Portfolio Layout', 'amos' ),
                    'desc' => 'The grid layout',
                    'type' => 'select',
                    'options' => array('in_container' => 'Centered grid in container', 'fullwidth' => 'Fullwidth'),
                    'default' => 'in_container',
                   'required' => array(array('portfolio_mode', '!=', 'parallax'),array( 'portfolio_mode', '!=', 'split'), array('portfolio_mode', '!=', 'slider'))
                ),
                array(
                    'id' => 'portfolio_space',
                    'title' => __( 'Portfolio Space', 'amos' ),
                    'desc' => 'Space beetwen portfolio items',
                    'type' => 'select',
                    'options' => array( 'normal' => 'Normal grid space', 'no_space' => 'Without space'),
                    'default' => 'normal',
                    'required' => array(array('portfolio_mode', '!=', 'parallax'),array( 'portfolio_mode', '!=', 'split'), array('portfolio_mode', '!=', 'slider'))
                ),
                array(
                    'id' => 'portfolio_content',
                    'title' => __( 'Portfolio Content Position', 'amos' ),
                    'desc' => 'Add this page content (Visual Composer Content) on top or bottom of grid ?',
                    'type' => 'select',
                    'options' => array('top' => 'Top', 'bottom' => 'Bottom'),
                    'default' => 'top'
                ),
                array(
                    'id' => 'portfolio_pagination',
                    'type' => 'select',
                    'title' => __('Select the pagination method', 'amos'),
                    'options' => array('no_pagination' => 'Without pagination', 'with_pagination' => 'With Pagination',  'infinite_scroll' => 'Infinite Scroll'),
                    'default' => 'with_pagination',
                    'required' => array(array('portfolio_mode', '!=', 'parallax'),array( 'portfolio_mode', '!=', 'split'), array('portfolio_mode', '!=', 'slider'))
                ),
                array(
                    'id' => 'portfolio_filters',
                    'type' => 'select',
                    'title' => __('Select the portfolio filter style', 'amos'),
                    'options' => array('normal' => 'Normal', 'in_grid' => 'In Grid'),
                    'default' => 'normal',
                    'required' => array(array('portfolio_mode', '!=', 'parallax'),array( 'portfolio_mode', '!=', 'split'), array('portfolio_mode', '!=', 'slider'), array('portfolio_pagination', '!=', 'infinite_scroll'))
                )
            ),
        );


        $metaboxes[] = array(
            'id'            => 'portfolio-options',
            'title'         => __( 'Portfolio Options', 'amos' ),
            'post_types'    => array( 'page'),
            'page_template' => array('portfolio.php'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $portfolio_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_portfolio_metaboxes');
endif;

/*--------------------------------------END PORTFOLIO METABOXES---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/


/*------------------------------------------LAYOUT OPTIONS--------------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_layout_metaboxes" ) ):
    function cl_add_layout_metaboxes($metaboxes) {
        
        $layoutOptions = array();
        $layoutOptions[] = array(
            //'title' => __('Home Settings', 'amos'),
            'icon_class' => 'icon-large',
            'icon' => 'el-icon-home',
            'fields' => array(
                array(
                    'id' => 'overwrite_layout',
                    'type' => 'switch',
                    'title' => __('Overwrite the default post layout', 'amos'),
                    'subtitle' => __('Do you want to overwrite the default layout for this post?', 'amos'),
                    'default' => 0// 1 = on | 0 = off
                ),
                array(
                    'title'     => __( 'Layout', 'amos' ),
                    'desc'      => __( 'Select main content and sidebar arrangement.', 'amos' ),
                    'id'        => 'layout',
                    'default'   => 'fullwidth',
                    'type'      => 'image_select',
                    'customizer'=> array(),
                    'options'   => array( 
                        'fullwidth'     => ReduxFramework::$_url . 'assets/img/1c.png',
                        'sidebar_right' => ReduxFramework::$_url . 'assets/img/2cr.png',
                        'sidebar_left'  => ReduxFramework::$_url . 'assets/img/2cl.png',
                        'dual'          => ReduxFramework::$_url . 'assets/img/3cm.png'
                    ),
                    'required' => array('overwrite_layout', 'equals', 1)
                ),

                array(
                    'id' => 'left_sidebar_dual',
                    'type' => 'select',
                    'title' => __('Left Sidebar', 'amos'),
                    'subtitle' => __('', 'amos'),
                    'data' => 'sidebar',
                    'required' => array('layout','=','dual')
                ),

                array(
                    'id' => 'right_sidebar_dual',
                    'type' => 'select',
                    'title' => __('Right Sidebar', 'amos'),
                    'subtitle' => __('', 'amos'),
                    'data' => 'sidebar',
                    'required' => array('layout','=','dual')
                ),


            )
        );
      
        $metaboxes[] = array(
            'id' => 'demo-layout2',
            //'title' => __('Cool Options', 'amos'),
            'post_types' => array('page', 'post', 'product'),
            //'page_template' => array('page-test.php'),
            //'post_format' => array('image'),
            'position' => 'side', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $layoutOptions
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_layout_metaboxes');
endif;

/*------------------------------------------END LAYOUT OPTIONS----------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------GENERAL SETTINGS----------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_general_metaboxes" ) ):
    function cl_add_general_metaboxes($metaboxes) {
        //$amos_redata = amos_redata_variable();
        global $amos_redata;
        $amos_redata = get_option( 'amos_redata' );
        $sections = array();


        /*----------------------------------------------PAGE HEADER-------------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/

        $page_header_section = array(
            'title' => __('Page Header Options', 'amos'),
            'desc' => __('In this section you can create custom page header only for this page. If you want to change or to view the default page header options', 'amos').' <a href="'.admin_url().'admin.php?page=_options&tab=2">click here</a>',
            'icon' => 'el-icon-home',
            'fields' => array(  

                            array(
                                'id' => 'page_header_overwrite',
                                'type' => 'switch',
                                'title' => __('Overwrite the default page options', 'amos'),
                                'subtitle' => __('Do you want to overwrite the default page options in Theme Options ?', 'amos'),
                                'default' => 0// 1 = on | 0 = off
                            ),

                            array(
                                'id' => 'page_header_bool',
                                'type' => 'switch',
                                'title' => __('Active Page Header', 'amos'),
                                'subtitle' => __('Switch On to enable page header for pages, posts (For each post or page you can add custom options)', 'amos'),
                                'default' => $amos_redata['page_header_bool'],// 1 = on | 0 = off
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'page_header_height',
                                'type' => 'dimensions',
                                'output' => array('.header_page'),
                                'units' => array('px'), // You can specify a unit value. Possible: px, em, %
                                //'units_extended' => 'true', // Allow users to select any type of unit
                                'width' => false,
                                'title' => __('Page Header Height', 'amos'),
                                'subtitle' => __('units: px', 'amos'),
                                'desc' => __('', 'amos'),
                                'default' => $amos_redata['page_header_height'],
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'page_header_fullscreen',
                                'type' => 'switch',
                                'title' => __('Active Page Header Fullscreen height', 'amos'),
                                'subtitle' => __('Switch On to enable page header for pages, posts (For each post or page you can add custom options)', 'amos'),
                                'default' => 0,// 1 = on | 0 = off
                                'required' => array('page_header_overwrite','=','1')
                            ),
                            

                            array(
                                'id' => 'page_header_style',
                                'type' => 'select',
                                'title' => __('Page header style', 'amos'),
                                'subtitle' => __('Select the style for the default page header', 'amos'),
                                'options' => array('normal' => 'Basic (Left with breadcrumbs)', 'centered' => 'Centered',  'left' => 'Left'), //Must provide key => value pairs for select options
                                'default' =>  $amos_redata['page_header_style'],
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'subtitle_bool',
                                'type' => 'switch',
                                'title' => __('Subtitle for this page ?', 'amos'),
                                'default' => 0,
                                'required' => array('page_header_overwrite','equals','1')
                            ),

                            array(
                                'id' => 'subtitle',
                                'type' => 'text',
                                'title' => __('Subtitle for this page', 'amos'),
                                'subtitle' => __('Add a subtitle here', 'amos'),
                                'desc' => __('Show after the main title  ', 'amos'),
                                'default' => 'A sample page description',
                                'required' => array(array('page_header_overwrite','=','1'), array('subtitle_bool','=', '1'))
                            ),

                            array(
                                'id' => 'page_header_f_color',
                                'type' => 'color',
                                'output' => array('.header_page'),
                                'title' => __('Page header font color', 'amos'),
                                'subtitle' => __('Select the color for the title or breadcrumbs in page header', 'amos'),
                                'default' => $amos_redata['page_header_f_color'],
                                'validate' => 'color',
                                'required' => array('page_header_overwrite','=','1')
                            ),

                            array(
                                'id' => 'page_header_background',
                                'type' => 'background',
                                'output' => array('.header_page'),
                                'title' => __('Page header background', 'amos'),
                                'subtitle' => __('Page Header background with image, color, etc.', 'amos'),
                                'default' => $amos_redata['page_header_background'],
                                'required' => array('page_header_overwrite','=','1')
                            )

            )
         );


        /*----------------------------------------------END PAGE HEADER---------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/


        /*----------------------------------------------SLIDER OPTIONS----------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/

        $layers = array();
        // Get WPDB Object
        global $wpdb;
     
        // Table name
        $table_name = $wpdb->prefix . "layerslider";
        $sql = $wpdb->prepare('show tables like %s', array($table_name));
        if($wpdb->get_var($sql) == $table_name) {
        // Get sliders
            $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                        WHERE flag_hidden = '0' AND flag_deleted = '0'
                                        ORDER BY date_c ASC LIMIT 100" );
           

        
            foreach($sliders as $key => $item) {
         
                $layers[$item->id-1] = $item->name;
            }
        }



        $revsliders = array();
        // Get WPDB Object
        global $wpdb;
     
        // Table name
        $table_name = $wpdb->prefix . "revslider_sliders";
     
        $sql = $wpdb->prepare('show tables like %s', array($table_name));
        if($wpdb->get_var($sql) == $table_name) {
           
            $sliders = $wpdb->get_results( "SELECT * FROM $table_name
                                            ORDER BY id ASC LIMIT 100" );   
            if(count($sliders) > 0):
                foreach($sliders as $key => $item) {
                    $revsliders[$item->alias] = $item->title;
                }

            endif;
        }


        $slider_section = array(

            'title' => __('Sliders Options', 'amos'),
            'icon' => 'el-icon-home',
            'fields' => array(
                            array(
                                'id' => 'slider_type',
                                'type' => 'select',
                                'title' => __('Select Slider Type', 'amos'),
                                'subtitle' => __('Select one of the listed sliders', 'amos'),
                                'options' => array('none'=>'None', 'amos' => 'Amos Slider', 'flexslider' => 'Flexslider', 'revolution' => 'Revolution Slider', 'layerslider' => 'Layerslider', 'amos_news' => 'News Slider', 'gallery_carousel' => 'Gallery Carousel'), //Must provide key => value pairs for select options
                                'default' =>  'none'
                            ),

                            array(
                                'id' => 'gallery',
                                'type' => 'slides',
                                'title' => __('Add/Edit Slides', 'amos'),
                                'subtitle' => __('Add new or edit existing slider images', 'amos'),
                                'required' => array('slider_type', '=', array('flexslider', 'gallery_carousel'))
                            ),

                            array(
                                'id' => 'gallery_effect',
                                'type' => 'select',
                                'title' => __('Gallery Carousel Effect', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'default' => 'amos',
                                'options' => array('amos' => 'amos', 'grayscale' => 'Grayscale', 'opacity' => 'With Opacity'),
                                'required' => array('slider_type', '=', 'gallery_carousel')
                            ),

                            array( 
                                'id' => 'revslider',
                                'type' => 'select',
                                'title' => __('Select one of the created revolution sliders.', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'options' => $revsliders, //Must provide key => value pairs for select options
                                'default' =>  'none',
                                'required' => array('slider_type', '=', 'revolution')
                            ),

                            array(
                                'id' => 'layerslider',
                                'type' => 'select',
                                'title' => __('Select one of the created layer sliders.', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'options' => $layers, //Must provide key => value pairs for select options
                                'default' =>  'none',
                                'required' => array('slider_type', '=', 'layerslider')
                            ),

                            array(
                                'id' => 'amos_slider',
                                'type' => 'select',
                                'title' => __('Select one of the created simpleliders.', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'data' => 'categories',
                                'args' => array('orderby'=>'date', 'hide_empty'=> 0, 'taxonomy' => 'slider'),
                                'required' => array('slider_type', '=', 'amos')
                            ),

                             array(
                                'id' => 'amos_slider_speed',
                                'type' => 'text',
                                'title' => __('Amos Slider Speed', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'default' => '10000',
                                'required' => array('slider_type', '=', 'amos' )
                            ),

                            array(
                                'id' => 'amos_slider_height',
                                'type' => 'text',
                                'title' => __('Slider height', 'amos'),
                                'subtitle' => __('Write 100% for fullscreen or for example 600 (without px) for custom', 'amos'),
                                'required' => array('slider_type', '=', array('amos', 'gallery_carousel') )
                            ),

                            array(
                                'id' => 'amos_news_featured_1',
                                'type' => 'select',
                                'title' => __('Select the first featured post', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'data' => 'post',
                                'args' => array('orderby'=>'date', 'posts_per_page' => -1),
                                'required' => array('slider_type', '=', 'amos_news')
                            ),

                            array(
                                'id' => 'amos_news_featured_2',
                                'type' => 'select',
                                'title' => __('Select the second featured post', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'data' => 'post',
                                'args' => array('orderby'=>'date', 'posts_per_page' => -1),
                                'required' => array('slider_type', '=', 'amos_news')
                            ),

                            array(
                                'id' => 'slider_layout',
                                'type' => 'select',
                                'title' => __('Select Slider layout', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'options' => array('boxed'=>'Boxed', 'fullwidth' => 'Fullwidth'), //Must provide key => value pairs for select options
                                'default' =>  'boxed',
                                'required' => array('slider_type', '!=', 'none')
                            ),
                            array(
                                'id' => 'slider_fixed',
                                'type' => 'switch',
                                'title' => __('Active Fixed Slider', 'amos'),
                                'subtitle' => __('', 'amos'),
                                'default' =>  0,
                                'required' => array('slider_type', '!=', 'none')
                            ),  

                            array(
                                'id'=>'slider_parallax',
                                'type' => 'switch', 
                                'title' => __('Active Parallax', 'amos'),
                                'subtitle'=> __('Look, it\'s on!', 'amos'),
                                "default"       => 0,
                            ),      

                            array(

                                'id' => 'slider_shapes',
                                'type' => 'select',
                                'title' => __('Slider Shapes', 'amos'),
                                'subtitle' => __('You can set different designs for your slider', 'amos'),
                                'options' => array('normal'=>'Normal', 'angled' => 'Angled', 'polygon' => 'Polygon', 'polygon_upper'=> 'Polygon Upper'),
                                'default' => 'normal',
                                'required' => array('slider_type', '!=', 'none')


                            ),

                            array(
                                'id'=>'slider_onmobile_remove',
                                'type' => 'switch', 
                                'title' => __('Remove Sliders from Mobile Phone View', 'amos'),
                                'subtitle'=> __('Check this option if you want to remove sliders from mobile view for this page.', 'amos'),
                                "default"       => 0,
                            ), 
            )

        );

        /*----------------------------------------------END SLIDER OPTIONS------------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/


        /*----------------------------------------------PAGE OPTIONS & STYLE----------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/

        $page_opt_style = array(

            'title' => __('Page Options & Style', 'amos'),
            'icon' => 'el-icon-home',
            'fields' => array(
                            array(
                                'id' => 'page_content_background',
                                'type' => 'color',
                                'output' => array('#content', '.fullscreen-single', '.fullscreen-single .content'),
                                'title' => __('Page Content Background', 'amos'),
                                'subtitle' => __('Background color of content in this page ' , 'amos'), 
                                'mode' => 'background-color',
                                'default' => $amos_redata['page_content_background_overall'],
                                'validate' => 'color',
                            ),
                            array(
                                'id' => 'fixed_header_page', 
                                'type' => 'switch',
                                'title' => __('Fixed header', 'amos'),
                                'subtitle' => __('Check this to activate fixed header', 'amos'),
                                'desc' => __('After activate this, the header will be fixed position, transparent above the content.', 'amos'),
                                'default' => '0'// 1 = on | 0 = off
                            ),
                            array(
                                'id' => 'page_header_menu_color',
                                'type' => 'select',
                                'title' => __('Header Color Style for Header 1', 'amos'),
                                'subtitle' => __('Select Light for light colors in header and white logo', 'amos'),
                                'options' => array('light' => 'Dark version header', 'dark' => 'Light version header', 'auto' => 'Auto check (Works only with background images)' ), //Must provide key => value pairs for select options
                                'default' =>  'light'
                            ),

                            array(
                                'id' => 'one_page_active', 
                                'type' => 'switch',
                                'title' => __('Use menu as one page menu', 'amos'),
                                'subtitle' => __('Check this to activate one page menu', 'amos'),
                                'desc' => __('After activate this, to the sections of visual composer add a class attribute for ex: "services" and set the link of the menu item: #services', 'amos'),
                                'default' => '0'// 1 = on | 0 = off
                            ),

                            array(
                                'id' => 'fullscreen_sections_active', 
                                'type' => 'switch',
                                'title' => __('Fullscreen Sections Sliding', 'amos'),
                                'subtitle' => __('Check to use visual sections as fullscreen sections', 'amos'),
                                'desc' => __('', 'amos'),
                                'default' => '0'// 1 = on | 0 = off
                            ),

                            array(
                                'id'=>'use_featured_image_as_photo',
                                'type' => 'switch', 
                                'title' => __('Use Featured Image as Photo', 'amos'),
                                'subtitle'=> __('', 'amos'),
                                "default"       => 1,
                            )



            )

        );


        /*----------------------------------------------END PAGE OPTIONS & STYLE------------------------------------*/
        /*----------------------------------------------------------------------------------------------------------*/


        $sections[] = $page_header_section;   // PAge Header Added
        $sections[] = $slider_section;   // Slider Added
        $sections[] = $page_opt_style; // Page Options and Style Added

        $sec_posts= array(); 
        $sec_posts[] = $page_header_section;   // PAge Header Added
        $sec_posts[] = $slider_section;   // Slider Added
        $sec_posts[] = $page_opt_style; // Page Options and Style Added

        $single_portfolio = array();
        $single_portfolio[] = $page_header_section;
        $single_portfolio[] = $page_opt_style;

        $metaboxes[] = array(
            'id' => 'general_settings',
            'title' => __('General Settings', 'amos'),
            'post_types' => array('post'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $sec_posts
        );

        $metaboxes[] = array(
            'id' => 'general_settings',
            'title' => __('General Settings', 'amos'),
            'post_types' => array('page'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $sections
        );
        $metaboxes[] = array(
            'id' => 'general_settings',
            'title' => __('General Settings', 'amos'),
            'post_types' => array('portfolio'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            'sections' => $single_portfolio 
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_general_metaboxes');
endif;

/*----------------------------------------------END GENERAL SETTINGS-----------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/


/*---------------------------------------------------- STAFF -----------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_staff_metaboxes" ) ):
    function cl_add_staff_metaboxes($metaboxes) {

        $staff_options = array();

        $staff_options[] = array(
            //'title'         => __('General Settings', 'amos'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'staff_position',
                    'title' => __( 'Staff Position', 'amos' ),
                    'desc' => 'Write here the position for this staff member into your business',
                    'type' => 'text'
                ),
                array(
                    'id' => 'facebook_link',
                    'title' => __( 'Facebook Link', 'amos' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '#'
                ),
                array(
                    'id' => 'twitter_link',
                    'title' => __( 'Twitter Link', 'amos' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '#'
                ),
                array(
                    'id' => 'google_link',
                    'title' => __( 'Google Link', 'amos' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => '#'
                ),
                array(
                    'id' => 'pinterest_link',
                    'title' => __( 'Pinterest Link', 'amos' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
                array(
                    'id' => 'linkedin_link',
                    'title' => __( 'Linkedin Link', 'amos' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
                array(
                    'id' => 'instagram_link',
                    'title' => __( 'Instagram Link', 'amos' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
                array(
                    'id' => 'mail_link',
                    'title' => __( 'Mail Link', 'amos' ),
                    'desc' => '',
                    'type' => 'text',
                    'default' => ''
                ),
            ),
        );


        $metaboxes[] = array(
            'id'            => 'staff-options',
            'title'         => __( 'Portfolio Options', 'amos' ),
            'post_types'    => array( 'staff'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $staff_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_staff_metaboxes');
endif;

/*-------------------------------------------------- END STAFF ---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/


/*------------------------------------------------- TESTIMONIAL --------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

if ( !function_exists( "cl_add_testimonial_metaboxes" ) ):
    function cl_add_testimonial_metaboxes($metaboxes) {

        $testimonial_options = array();

        $testimonial_options[] = array(
            //'title'         => __('General Settings', 'amos'),
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'staff_position',
                    'title' => __( 'Staff Position', 'amos' ),
                    'desc' => 'Write here the position for this testimonial post',
                    'type' => 'text'
                )
            ),
        );


        $metaboxes[] = array(
            'id'            => 'testimonial-options',
            'title'         => __( 'Testimonial Options', 'amos' ),
            'post_types'    => array( 'testimonial'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $testimonial_options,
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_testimonial_metaboxes');
endif;

/*-------------------------------------------------- END Testimonial ---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------------*/


/*--------------------------------------BLOG POST METABOXES--------------------------------------------------*/
/*-----------------------------------------------------------------------------------------------------------*/
if ( !function_exists( "cl_add_blog_post_metaboxes" ) ):
    function cl_add_blog_post_metaboxes($metaboxes) {
        $blog_options = array();
        
        $blog_options[] = array(
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'fullscreen_post_style',
                    'title' => __( 'Active Fullscreen Innovative Single Post', 'amos' ),
                    'desc' => 'Use this option if you active the fullscreen blog',
                    'type' => 'switch', 
                    'default' => 0 
                ),
                array(
                    'id' => 'fullscreen_post_effect',
                    'title' => __( 'Fullscreen Post Effect', 'amos' ),
                    'desc' => 'Use this option if you active the fullscreen blog',
                    'type' => 'select',
                    'options' => amos_animations(), 
                    'default' => 'fadeInLeft' 
                ),
                array(
                    'id' => 'fullscreen_post_delay',
                    'type' => 'text',
                    'title' => __('Fullscreen Post Effect Delay', 'amos'),
                    'default' => '200'
                ),
                array(
                    'id' => 'fullscreen_post_position',
                    'title' => __( 'Fullscreen Post Position', 'amos' ),
                    'desc' => 'Position of the content in the fullscreen section',
                    'type' => 'select',
                    'default' => 'left',
                    'options' => array('left' => 'Left', 'right' => 'Right')
                ),
                array(
                    'id' => 'future_date_events',
                    'title' => __( 'Future date for upcoming events', 'amos' ),
                    'desc' => '',
                    'type' => 'text',
                    'placeholder' => 'Click to enter a date'
                )      
            ) 
        );



        $metaboxes[] = array(
            'id'            => 'blog-options',
            'title'         => __( 'Blog Options', 'amos' ),
            'post_types'    => array( 'post'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'low', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $blog_options
        );
        

        $post_format = array();
        
        $post_format[] = array(
            'icon_class'    => 'icon-large',
            'icon'          => 'el-icon-home',
            'fields'        => array(
                array(
                    'id' => 'media_post_link',
                    'title' => __( 'Video / Audio Link or Iframe', 'amos' ),
                    'desc' => 'Insert here link / Iframe for video or audio',
                    'type' => 'textarea', 
                    'default' => '' 
                )          
            ) 
        );

        $metaboxes[] = array(
            'id'            => 'blog-post-format',
            'title'         => __( 'Blog Post Format', 'amos' ),
            'post_types'    => array( 'post'),
            'post_format'   => array('video', 'audio'),
            'position'      => 'normal', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low
            'sidebar'       => false, // enable/disable the sidebar in the normal/advanced positions
            'sections'      => $post_format
        );
        return $metaboxes;
    }
    add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'cl_add_blog_post_metaboxes');
endif;

/*--------------------------------------END BLOG POST METABOXES---------------------------------------------*/
/*----------------------------------------------------------------------------------------------------------*/

// The loader will load all of the extensions automatically based on your $redux_opt_name
//require_once(get_template_directory(). '/admin/loader/loader.php');