<?php
/**
 * @package     NA Core
 * @version     0.1
 * @author      Nanobitther
 * @link        http://nanobitther.co
 * @copyright   Copyright (c) 2015 Nanobitther
 * @license     GPL v2
 */
if (!class_exists('bitther_Customize')) {
    class bitther_Customize
    {
        public $customizers = array();

        public $panels = array();

        public function init()
        {
            $this->customizer();
            add_action('customize_controls_enqueue_scripts', array($this, 'bitther_customizer_script'));
            add_action('customize_register', array($this, 'bitther_register_theme_customizer'));
            add_action('customize_register', array($this, 'remove_default_customize_section'), 20);
        }

        public static function &getInstance()
        {
            static $instance;
            if (!isset($instance)) {
                $instance = new bitther_Customize();
            }
            return $instance;
        }

        protected function customizer()
        {
            $this->panels = array(

                'site_panel' => array(
                    'title'             => esc_html__('Style Setting','bitther'),
                    'description'       => esc_html__('Style Setting >','bitther'),
                    'priority'          =>  101,
                ),
                'single_panel' => array(
                    'title'             => esc_html__('Blog Single','bitther'),
                    'description'       => esc_html__('Blog Single >','bitther'),
                    'priority'          =>  104,
                ),
                'woo_panel' => array(
                    'title'             => esc_html__('WooCommerce','bitther'),
                    'description'       => esc_html__('WooCommerce >','bitther'),
                    'priority'          =>  102,
                ),
                'sidebar_panel' => array(
                    'title'             => esc_html__('Sidebar','bitther'),
                    'description'       => esc_html__('Sidebar Setting','bitther'),
                    'priority'          => 105,
                ),
                'bitther_option_panel' => array(
                    'title'             => esc_html__('Option','bitther'),
                    'description'       => '',
                    'priority'          => 106,
                ),

            );

            $this->customizers = array(
                'title_tagline' => array(
                    'title' => esc_html__('Site Identity', 'bitther'),
                    'priority'  =>  1,
                    'settings' => array(
                        'bitther_logo' => array(
                            'class' => 'image',
                            'label' => esc_html__('Logo', 'bitther'),
                            'description' => esc_html__('Upload Logo Image', 'bitther'),
                            'priority' => 12
                        ),
                    )
                ),
//2.General ============================================================================================================
                'bitther_general' => array(
                    'title' => esc_html__('General', 'bitther'),
                    'description' => '',
                    'priority' => 2,
                    'settings' => array(

                        'bitther_bg_body' => array(
                            'label'         => esc_html__('Background - Body', 'bitther'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 2,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                        'bitther_primary_body' => array(
                            'label'         => esc_html__('Primary - Color', 'bitther'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 1,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                    )
                ),
//3.Header =============================================================================================================
                'bitther_header' => array(
                    'title' => esc_html__('Header', 'bitther'),
                    'description' => '',
                    'priority' => 3,
                    'settings' => array(
                        //header bitther_topbar

                        'bitther_topbar' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Topbar','bitther'),
                            'priority' => 0,
                            'params' => array(
                                'default' => false,
                            ),
                        ),

                        'bitther_topbar_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'bitther'),
                            'description' => esc_html__( 'Please goto Appearance > Widgets > drop drag widget to the sidebar Topbar Left and the sidebar Topbar Right.', 'bitther' ),
                            'priority' => 1,
                        ),

                        'bitther_header_ads' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Space on the top','bitther'),
                            'priority' => 2,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_header_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'bitther'),
                            'description' => esc_html__( 'Please goto Appearance > Widgets > drop drag widget to the sidebar Header ADS.', 'bitther' ),
                            'priority' => 3,
                        ),


                        'bitther_header_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Header', 'bitther'),
                            'priority' => 4,
                        ),

                        'bitther_header' => array(
                            'class'=> 'layout',
                            'label' => esc_html__('Header Layout', 'bitther'),
                            'priority' =>5,
                            'choices' => array(
                                'simple'                   => get_template_directory_uri().'/assets/images/header/default.png',
                                'center'                   => get_template_directory_uri().'/assets/images/header/center.png',
                                'left'                     => get_template_directory_uri().'/assets/images/header/left.png',
                                'left2'                    => get_template_directory_uri().'/assets/images/header/left.png',
                            ),
                            'params' => array(
                                'default' => 'left',
                            ),
                        ),
                        'bitther_header_style' => array(
                            'type' => 'select',
                            'label' => esc_html__('Choose Header Style', 'bitther'),
                            'description' => '',
                            'priority' => 6,
                            'choices' => array(
                                'style_black'     => esc_html__('Header Black', 'bitther'),
                                'style_white'     => esc_html__('Header White', 'bitther')
                            ),
                            'params' => array(
                                'default' => 'style_black',
                            ),
                        ),

                        'bitther_keep_menu' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Keep Menu','bitther'),
                            'priority' => 7,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_bg_header' => array(
                            'label'         => esc_html__('Background - Header', 'bitther'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 8,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),

                        'bitther_color_menu' => array(
                            'label'         => esc_html__('Color - Text', 'bitther'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 9,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                    )
                ),
//4.Footer =============================================================================================================
                'bitther_new_section_footer' => array(
                    'title' => esc_html__('Footer', 'bitther'),
                    'description' => '',
                    'priority' => 4,
                    'settings' => array(
                        'bitther_footer' => array(
                            'type' => 'select',
                            'label' => esc_html__('Choose Footer Style', 'bitther'),
                            'description' => '',
                            'priority' => -1,
                            'choices' => array(
								'footer-1' => __( 'Footer 1', 'bitther' ),
							),
                            'params' => array(
                                'default' => 'none',
                            ),
                        ),
                        'bitther_enable_footer' => array(
                            'type' => 'checkbox',
                            'label' => esc_html__('Enable Footer', 'bitther'),
                            'description' => '',
                            'priority' => 0,
                            'params' => array(
                                'default' => '1',
                            ),
                        ),
                        'bitther_bg_footer' => array(
                            'label'         => esc_html__('Background - Footer', 'bitther'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 5,
                            'params'        => array(
                                'default'   => '',
                            ),

                        ),
                        'bitther_color_footer' => array(
                            'label'         => esc_html__('Color - Text ', 'bitther'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 6,
                            'params'        => array(
                                'default'   => '',
                            ),

                        ),
                        'bitther_copyright_text' => array(
                            'type' => 'textarea',
                            'label' => esc_html__('Footer Copyright Text', 'bitther'),
                            'description' => '',
                            'priority' => 9,
                        ),
                    )
                ),

//5.Categories Blog ====================================================================================================
                'bitther_blog' => array(
                    'title' => esc_html__('Blogs Categories', 'bitther'),
                    'description' => '',
                    'priority' => 103,
                    'settings' => array(

                        'bitther_sidebar_cat' => array(
                            'class'         => 'layout',
                            'label'         => esc_html__('Sidebar Layout', 'bitther'),
                            'priority'      =>3,
                            'choices'       => array(
                                'left'         => get_template_directory_uri().'/assets/images/left.png',
                                'right'        => get_template_directory_uri().'/assets/images/right.png',
                                'full'         => get_template_directory_uri().'/assets/images/full.png',
                            ),
                            'params' => array(
                                'default' => 'right',
                            ),
                        ),
                        'bitther_siderbar_cat_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'bitther'),
                            'description' => esc_html__( 'Please goto Appearance > Widgets > drop drag widget to the sidebar Article.', 'bitther' ),
                            'priority' => 4,
                        ),
                        //post-layout-cat
                        'bitther_title_cat_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Post Title Category', 'bitther'),
                            'priority' =>5,
                        ),
                        'bitther_post_title_heading' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Title Category ','bitther'),
                            'priority' => 6,
                            'params' => array(
                                'default' => true,
                            ),
                        ),

                        'bitther_post_cat_layout' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Category layout', 'bitther'),
                            'priority' =>8,
                        ),
                        'bitther_layout_cat_content' => array(
                            'class'         => 'layout',
                            'priority'      =>9,
                            'choices'       => array(
                                'grid'        => get_template_directory_uri().'/assets/images/box-grid.jpg',
                                'list'        => get_template_directory_uri().'/assets/images/box-list.jpg',
                            ),
                            'params' => array(
                                'default' => 'list',
                            ),
                        ),
                        'bitther_number_post_cat' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Number post on a row', 'bitther'),
                            'description' => '',
                            'priority' =>10,
                            'choices' => array(
                                'max' => 4,
                                'min' => 1,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' =>2
                            ),
                        ),
                        //post article content
                        'bitther_post_cat_article' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Post content', 'bitther'),
                            'priority' =>11,
                        ),
                        'bitther_number_content_post' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Number of words in the description content', 'bitther'),
                            'description' => '',
                            'priority' =>13,
                            'choices' => array(
                                'max' => 50,
                                'min' => 20,
                                'step' => 5
                            ),
                            'params'      => array(
                                'default' =>25
                            ),
                        ),

                        //post meta
                        'bitther_cat_meta' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Post meta', 'bitther'),
                            'priority' =>13,
                        ),
                        'bitther_cat_meta_author' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Author ','bitther'),
                            'priority' => 15,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'bitther_cat_meta_date' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Date ','bitther'),
                            'priority' => 16,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'bitther_cat_meta_comment' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Comment ','bitther'),
                            'priority' => 17,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_cat_meta_view' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('View ','bitther'),
                            'priority' => 18,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                    ),
                ),
//6.Single blog ========================================================================================================
                'bitther_single_sidebar' => array(
                    'title' => esc_html__('Single Layout', 'bitther'),
                    'description' => '',
                    'panel' =>'single_panel',
                    'priority' => 6,
                    'settings' => array(
                        'bitther_sidebar_single' => array(
                            'class'         => 'layout',
                            'label'         => esc_html__('Sidebar Layout', 'bitther'),
                            'priority'      =>1,
                            'choices'       => array(
								'left'         => get_template_directory_uri().'/assets/images/left.png',
                                'right'        => get_template_directory_uri().'/assets/images/right.png',
								'full'         => get_template_directory_uri().'/assets/images/full.png',
                            ),
                            'params' => array(
                                'default' => 'right',
                            ),
                        ),

                        'bitther_siderbar_single_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'bitther'),
                            'description' => esc_html__( 'Please goto Appearance > Widgets > drop drag widget to the sidebar Blog .', 'bitther' ),
                            'priority' => 2,
                        ),

                        'bitther_single_own' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Use Single sidebar','bitther'),
                            'priority' => 3,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_siderbar_single2_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'bitther'),
                            'description' => esc_html__( 'When you active use Single sidebar , Please goto Appearance > Widgets > drop drag widget to the sidebar Single  not sidebar Blog.', 'bitther' ),
                            'priority' => 4,
                        ),
                        'bitther_single_style' => array(
                            'type' => 'select',
                            'label' => esc_html__('Single Style', 'bitther'),
                            'priority' => 5,
                            'choices' => array(
                                '1' => __( 'Single Style 1', 'bitther' ),
                                '2' => __( 'Single Style 2', 'bitther' ),
                                '3' => __( 'Single Style 3', 'bitther' ),
                            ),
                            'params' => array(
                                'default' => '1',
                            ),
                        ),
                    ),
                ),
                //Share
                'bitther_single_layout' => array(
                    'title' => esc_html__('Article Meta', 'bitther'),
                    'description' => '',
                    'panel' =>'single_panel',
                    'priority' => 6,
                    'settings' => array(
                        //avatar-meta
                        'bitther_avatar_meta' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Author', 'bitther'),
                            'priority' =>1,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'bitther_avatar_meta_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'bitther'),
                            'description' => esc_html__( 'Show or Hidden  Author under the Title Post.If you want to disable/enable Author Box under Post , Please put or delete description in the User > Your profile > Biographical Info ', 'bitther' ),
                            'priority' => 2,
                        ),
                        'bitther_post_meta_date' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Date ','bitther'),
                            'priority' => 3,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'bitther_post_meta_comment' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Comment ','bitther'),
                            'priority' => 4,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_post_meta_view' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('View ','bitther'),
                            'priority' => 5,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        //avatar-meta
                        'bitther_feature_image' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Featured Image', 'bitther'),
                            'priority' =>10,
                            'params' => array(
                                'default' => true,
                            ),
                        ),

                        'bitther_share_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Options', 'bitther'),
                            'priority' =>18,
                        ),
                        'bitther_share_facebook' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Facebook  ','bitther'),
                            'priority' => 21,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_share_twitter' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Twitter  ','bitther'),
                            'priority' => 22,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_share_google' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Google  ','bitther'),
                            'priority' => 23,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_share_linkedin' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Linkedin  ','bitther'),
                            'priority' => 24,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_share_pinterest' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Pinterest  ','bitther'),
                            'priority' => 25,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_share_whatsapp' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Whatsapp  ','bitther'),
                            'priority' => 26,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                    ),
                ),
                //Comments
                'bitther_single_comments' => array(
                    'title' => esc_html__('Comments', 'bitther'),
                    'description' => '',
                    'panel' =>'single_panel',
                    'priority' => 6,
                    'settings' => array(
                        //comments
                        'bitther_comments' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Comments Box', 'bitther'),
                            'priority' =>16,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'bitther_comments_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Options', 'bitther'),
                            'priority' =>18,
                        ),
                        'bitther_comments_single_facebook' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Enable Facebook Comments ','bitther'),
                            'priority' => 29,
                            'params' => array(
                                'default' => false,
                            ),
                        ),

                        'bitther_comments_single' => array(
                            'type'          => 'text',
                            'label'         => esc_html__('Your app id :', 'bitther'),
                            'priority'      => 30,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                        'bitther_comments_single_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'bitther'),
                            'description' => esc_html__('If you want show notification on  your facebook , please input app id ...', 'bitther' ),
                            'priority' => 31,
                        ),
                    ),
                ),
                'bitther_single_related' => array(
                    'title' => esc_html__('Related Box', 'bitther'),
                    'description' => '',
                    'panel' =>'single_panel',
                    'priority' => 6,
                    'settings' => array(
                        //related_posts
                        'bitther_related' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Related Posts', 'bitther'),
                            'priority' =>17,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'bitther_related_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Options', 'bitther'),
                            'priority' =>18,
                        ),
                        'bitther_related_number' => array(
                            'type' => 'select',
                            'label' => __('Number Post Show', 'bitther'),
                            'description' => '',
                            'priority' => 25,
                            'choices' => array(
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                                '8' => '8',
                            ),
                            'params' => array(
                                'default' => '3',
                            ),

                        ),
                        'bitther_related_rows' => array(
                            'type' => 'select',
                            'label' => __('Number Rows', 'bitther'),
                            'description' => '',
                            'priority' => 25,
                            'choices' => array(
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '6' => '6',
                            ),
                            'params' => array(
                                'default' => '3',
                            ),

                        ),
                    ),
                ),

                'bitther_single_readmore' => array(
                    'title' => esc_html__('Read More Box', 'bitther'),
                    'description' => '',
                    'panel' =>'single_panel',
                    'priority' => 6,
                    'settings' => array(
                        //Read More
                        'bitther_readmore_box' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Read More Box', 'bitther'),
                            'priority' =>1,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_readmore_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Options', 'bitther'),
                            'priority' =>2,
                        ),
                        'bitther_readmore_cat' => array(
                            'class'          => 'multiple',
                            'label'         => esc_html__('Categories', 'bitther'),
                            'choices'       => bitther_get_categories_select(),
                            'priority'      => 3,
                            'params'        => array(
                                'default'       => esc_html__('', 'bitther'),
                            ),

                        ),
                        'bitther_readmore_layout' => array(
                            'class'         => 'layout',
                            'priority'      =>4,
                            'label'         => esc_html__('Layouts', 'bitther'),
                            'choices'       => array(
                                'full'        => get_template_directory_uri().'/assets/images/box-grid.jpg',
                                'list'        => get_template_directory_uri().'/assets/images/box-list.jpg',
                            ),
                            'params' => array(
                                'default' => 'full',
                            ),
                        ),
                        'bitther_readmore_show' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Number of posts displayed on a page', 'bitther'),
                            'description' => '',
                            'priority' =>5,
                            'choices' => array(
                                'max' => 10,
                                'min' => 2,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' =>6
                            ),
                        ),
                    ),
                ),
//7.Adsense blog ========================================================================================================
                'bitther_ads' => array(
                    'title' => esc_html__('Adsense Setting', 'bitther'),
                    'description' => '',
                    'panel' =>'single_panel',
                    'priority' => 7,
                    'settings' => array(

                        'bitther_ads_rectangle' => array(
                            'type' => 'textarea',
                            'label' => esc_html__(' ADS Size: Large Rectangle', 'bitther'),
                            'description' => '',
                            'priority' => 1,
                        ),
                        'bitther_ads_rectangle_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'bitther'),
                            'description' => esc_html__('Add code ads by google with the size is:300x250', 'bitther' ),
                            'priority' => 2,
                        ),
                        'bitther_ads_leaderboard' => array(
                            'type' => 'textarea',
                            'label' => esc_html__('ADS Size: Leaderboard', 'bitther'),
                            'description' => 'Add code ads by google with the size is: 468x60 ,728x90, 920x180 ...',
                            'priority' => 3,
                        ),
                        'bitther_ads_vertical' => array(
                            'type' => 'textarea',
                            'label' => esc_html__('ADS Size: Rectangle Vertical', 'bitther'),
                            'description' => 'Add code ads by google with the size is: 160x600',
                            'priority' => 4,
                        ),
                        'bitther_ads_bottom' => array(
                            'type' => 'textarea',
                            'label' => esc_html__('ADS Size:Billboard', 'bitther'),
                            'description' => 'You can place any size ad in this responsive area.',
                            'priority' => 5,
                        ),
                        'bitther_heading_ads_single' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Position AD', 'bitther'),
                            'priority' =>20,
                        ),
                        'bitther_ads_single_article' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Ad right of the post','bitther'),
                            'priority' => 21,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_ads_single_comment' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Ad located between the boxes','bitther'),
                            'priority' => 23,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_ads_single_bottom' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Ad Under the bottom of the post','bitther'),
                            'priority' => 24,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'bitther_ads_single_top' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Ad the top of the post','bitther'),
                            'priority' => 25,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                    )
                ),

//8.Woocommerces  Category =============================================================================================
                'bitther_woo_cat' => array(
                    'title' => esc_html__('Categories', 'bitther'),
                    'description' => '',
                    'panel' =>'woo_panel',
                    'priority' => 8,
                    'settings' => array(
                        //siderbar
                        'bitther_sidebar_woo' => array(
                            'class'=> 'layout',
                            'label' => esc_html__('Sidebar', 'bitther'),
                            'priority' =>2,
                            'choices' => array(
                                'left'         => get_template_directory_uri().'/assets/images/left.png',
                                'full'         => get_template_directory_uri().'/assets/images/full.png',
                                'right'         => get_template_directory_uri().'/assets/images/right.png',
                            ),
                            'params' => array(
                                'default' => 'left',
                            ),
                        ),
                        'bitther_siderbar_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'bitther'),
                            'description' => esc_html__( 'Please goto Appearance > Widgets > drop drag widget to the sidebar SHOP.', 'bitther' ),
                            'priority' => 3,
                        ),
                        //category
                        'bitther_header_woocat' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Categories Product', 'bitther'),
                            'priority' =>1,
                        ),
                        'bitther_woo_cat_breadcrumb_image' => array(
                            'class'          => 'image',
                            'label'         => esc_html__('Breadcrumb image Title', 'bitther'),
                            'priority'      => 6,
                            'params'        => array(
                                'default'   => '',
                            ),

                        ),
                        'bitther_woo_number_product' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Number products on a row', 'bitther'),
                            'description' => '',
                            'priority' =>9,
                            'choices' => array(
                                'max' => 6,
                                'min' => 2,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' => 3
                            ),
                        ),
                        'bitther_woo_product_per_page' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Number products per page', 'bitther'),
                            'description' => '',
                            'priority' =>9,
                            'choices' => array(
                                'max' => 36,
                                'min' => 6,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' => 9
                            ),
                        ),

                    ),
                ),

//9.Woocommerces Detail  ===============================================================================================
                'bitther_woo_detail' => array(
                    'title' => esc_html__('Product Detail', 'bitther'),
                    'description' => '',
                    'panel' =>'woo_panel',
                    'priority' => 9,
                    'settings' => array(
                        //siderbar
                        'bitther_sidebar_woo_single' => array(
                            'class'=> 'layout',
                            'label' => esc_html__('Sidebar', 'bitther'),
                            'priority' =>2,
                            'choices' => array(
                                'left'         => get_template_directory_uri().'/assets/images/left.png',
                                'full'         => get_template_directory_uri().'/assets/images/full.png',
                                'right'         => get_template_directory_uri().'/assets/images/right.png',
                            ),
                            'params' => array(
                                'default' => 'full',
                            ),
                        ),
                        'bitther_woo_related_products' => array(
                            'type'          => 'checkbox',
                            'label'         => __('Display Related Products', 'bitther'),
                            'priority'      => 24,
                            'params'        => array(
                                'default'   => true,
                            ),

                        ),
                        'bitther_woo_number_related_products' => array(
                            'type' => 'select',
                            'label' => __('Number Products Show', 'bitther'),
                            'description' => '',
                            'priority' => 25,
                            'choices' => array(
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5'
                            ),
                            'params' => array(
                                'default' => '4',
                            ),

                        ),
                        //Share products
                        'bitther_cat_content_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Share', 'bitther'),
                            'priority' =>25,
                        ),
                        'bitther_woo_share_facebook' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Facebook','bitther'),
                            'priority' => 26,
                            'params' => array(
                                'default' => false,
                            ),

                        ),
                        'bitther_woo_share_twitter' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Twitter','bitther'),
                            'priority' => 27,
                            'params' => array(
                                'default' => false,
                            ),

                        ),
                        'bitther_woo_share_pinterest' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Pinterest','bitther'),
                            'priority' => 28,
                            'params' => array(
                                'default' => false,
                            ),

                        ),
                        'bitther_woo_share_google' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Google +','bitther'),
                            'priority' => 29,
                            'params' => array(
                                'default' => false,
                            ),

                        ),
                        'bitther_woo_share_linkedin' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('linkedin','bitther'),
                            'priority' => 30,
                            'params' => array(
                                'default' => false,
                            ),

                        ),

                    ),
                ),
//Font   ===============================================================================================================
                'bitther_new_section_font_size' => array(
                    'title' => esc_html__('Font', 'bitther'),
                    'priority' => 8,
                    'settings' => array(
                        'bitther_body_font_google' => array(
                            'type'          => 'select',
                            'label'         => esc_html__('Body Font', 'bitther'),
                            'choices'       => bitther_googlefont(),
                            'priority'      => 0,
                            'params'        => array(
                                'default'       => 'Poppins',
                            ),

                        ),
                        'bitther_body_font_size' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Font size Body ', 'bitther'),
                            'description' => '',
                            'priority' =>8,
                            'choices' => array(
                                'max' => 30,
                                'min' => 10,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' => 16,
                            ),
                        ),

                        'bitther_title_font_google' => array(
                            'type'          => 'select',
                            'label'         => esc_html__('Title Font', 'bitther'),
                            'choices'       => bitther_googlefont(),
                            'priority'      => 9,
                            'params'        => array(
                                'default'       => 'Poppins',
                            ),

                        ),
                        'bitther_menu_font_google' => array(
                            'type'          => 'select',
                            'label'         => esc_html__('Menu Font', 'bitther'),
                            'choices'       => bitther_googlefont(),
                            'priority'      => 10,
                            'params'        => array(
                                'default'       => 'Poppins',
                            ),

                        ),
                        'bitther_main_font_family' => array(
                            'type'          => 'select',
                            'label'         => esc_html__('Menu Font', 'bitther'),
                            'choices'       => bitther_googlefont(),
                            'priority'      => 10,
                            'params'        => array(
                                'default'       => 'Poppins',
                            ),

                        ),

                    )
                ),
//Style  ===============================================================================================================


            );
        }

        public function bitther_customizer_script()
        {
            // Register
            wp_enqueue_style('na-customize', get_template_directory_uri() . '/inc/customize/assets/css/customizer.css', array(),null);
            wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/inc/customize/assets/css/jquery-ui.min.css', array(),null);
            wp_enqueue_script('na-customize', get_template_directory_uri() . '/inc/customize/assets/js/customizer.js', array('jquery'), null, true);
        }

        public function add_customize($customizers) {
            $this->customizers = array_merge($this->customizers, $customizers);
        }


        public function bitther_register_theme_customizer()
        {
            global $wp_customize;

            foreach ($this->customizers as $section => $section_params) {

                //add section
                $wp_customize->add_section($section, $section_params);
                if (isset($section_params['settings']) && count($section_params['settings']) > 0) {
                    foreach ($section_params['settings'] as $setting => $params) {

                        //add setting
                        $setting_params = array();
                        if (isset($params['params'])) {
                            $setting_params = $params['params'];
                            unset($params['params']);
                        }
                        $wp_customize->add_setting($setting, array_merge( array( 'sanitize_callback' => null ), $setting_params));
                        //Get class control
                        $class = 'WP_Customize_Control';
                        if (isset($params['class']) && !empty($params['class'])) {
                            $class = 'WP_Customize_' . ucfirst($params['class']) . '_Control';
                            unset($params['class']);
                        }

                        //add params section and settings
                        $params['section'] = $section;
                        $params['settings'] = $setting;

                        //add controll
                        $wp_customize->add_control(
                            new $class($wp_customize, $setting, $params)
                        );
                    }
                }
            }

            foreach($this->panels as $key => $panel){
                $wp_customize->add_panel($key, $panel);
            }

            return;
        }

        public function remove_default_customize_section()
        {
            global $wp_customize;
//            // Remove Sections
//            $wp_customize->remove_section('title_tagline');
            $wp_customize->remove_section('header_image');
            $wp_customize->remove_section('nav');
            $wp_customize->remove_section('static_front_page');
            $wp_customize->remove_section('colors');
            $wp_customize->remove_section('background_image');
        }
    }
}