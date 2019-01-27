<?php 

/**
* 
* [Widgets]
* 
**/



/* ========= social_icons ===================================== */
class urbanpointwp_address_social_icons extends WP_Widget {



    function __construct() {
        parent::__construct('urbanpointwp_address_social_icons', esc_attr__('MT - Contact + Social links', 'urbanpointwp'),array( 'description' => esc_attr__( 'MT - Contact information + Social icons', 'urbanpointwp' ), ) );
    }



    public function widget( $args, $instance ) {

        $widget_title = $instance[ 'widget_title' ];
        $widget_contact_details = $instance[ 'widget_contact_details' ];
        $widget_social_icons = $instance[ 'widget_social_icons' ];

        echo  $args['before_widget']; ?>

        <div class="sidebar-social-networks address-social-links">

            <?php if($widget_title) { ?>
               <h1 class="widget-title"><?php echo esc_attr($widget_title); ?></h1>
            <?php } ?>


            <?php if('on' == $instance['widget_contact_details']) { ?>
                <div class="contact-details">
                    <p><i class="fa fa-phone" aria-hidden="true"></i><?php echo esc_attr( urbanpointwp_redux('mt_contact_phone')); ?></p>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i><?php echo esc_attr( urbanpointwp_redux('mt_contact_email')); ?></p>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo esc_attr( urbanpointwp_redux('mt_contact_address')); ?></p>
                </div>
            <?php } ?>


            <?php if('on' == $instance['widget_social_icons']) { ?>
                <ul class="social-links">
                <?php if ( urbanpointwp_redux('mt_social_fb') && urbanpointwp_redux('mt_social_fb') != '' ) { ?>
                    <li><a href="<?php echo esc_attr( urbanpointwp_redux('mt_social_fb') ) ?>"><i class="fa fa-facebook"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_tw') && urbanpointwp_redux('mt_social_tw') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_tw') ) ?>"><i class="fa fa-twitter"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_gplus') && urbanpointwp_redux('mt_social_gplus') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_gplus') ) ?>"><i class="fa fa-google-plus"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_youtube') && urbanpointwp_redux('mt_social_youtube') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_youtube') ) ?>"><i class="fa fa-youtube"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_pinterest') && urbanpointwp_redux('mt_social_pinterest') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_pinterest') ) ?>"><i class="fa fa-pinterest"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_linkedin') && urbanpointwp_redux('mt_social_linkedin') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_linkedin') ) ?>"><i class="fa fa-linkedin"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_skype') && urbanpointwp_redux('mt_social_skype') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_skype') ) ?>"><i class="fa fa-skype"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_instagram') && urbanpointwp_redux('mt_social_instagram') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_instagram') ) ?>"><i class="fa fa-instagram"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_dribbble') && urbanpointwp_redux('mt_social_dribbble') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_dribbble') ) ?>"><i class="fa fa-dribbble"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_deviantart') && urbanpointwp_redux('mt_social_deviantart') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_deviantart') ) ?>"><i class="fa fa-deviantart"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_digg') && urbanpointwp_redux('mt_social_digg') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_digg') ) ?>"><i class="fa fa-digg"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_flickr') && urbanpointwp_redux('mt_social_flickr') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_flickr') ) ?>"><i class="fa fa-flickr"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_stumbleupon') && urbanpointwp_redux('mt_social_stumbleupon') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_stumbleupon') ) ?>"><i class="fa fa-stumbleupon"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_tumblr') && urbanpointwp_redux('mt_social_tumblr') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_tumblr') ) ?>"><i class="fa fa-tumblr"></i></a></li>
                <?php } ?>
                <?php if ( urbanpointwp_redux('mt_social_vimeo') && urbanpointwp_redux('mt_social_vimeo') != '' ) { ?>
                    <li><a href="<?php echo esc_url( urbanpointwp_redux('mt_social_vimeo') ) ?>"><i class="fa fa-vimeo-square"></i></a></li>
                <?php } ?>
                </ul>
            <?php } ?>
            
        </div>
        <?php echo  $args['after_widget'];
    }





    public function form( $instance ) {

        # Widget Title
        if ( isset( $instance[ 'widget_title' ] ) ) {
            $widget_title = $instance[ 'widget_title' ];
        } else {
            $widget_title = esc_attr__( 'Social icons', 'urbanpointwp' );
        }
        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>"><?php esc_attr_e( 'Widget Title:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'widget_title' )); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>">
        </p>
        <p>
            <input type="checkbox" <?php checked($instance['widget_contact_details'], 'on'); ?> id="<?php echo esc_attr($this->get_field_name('widget_contact_details')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_contact_details')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_name('widget_contact_details')); ?>"><?php esc_attr_e( 'Show contact informations box','urbanpointwp' ); ?></label>
        </p>
        <p>
            <input type="checkbox" <?php checked($instance['widget_social_icons'], 'on'); ?> id="<?php echo esc_attr($this->get_field_name('widget_social_icons')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_social_icons')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_name('widget_social_icons')); ?>"><?php esc_attr_e( 'Show social icons','urbanpointwp' ); ?></label>
        </p>

      
      <?php   
  /*      <p>
            <input type="checkbox" name="widget_contact_details" id="widget_contact_details"> <label for="widget_contact_details">Show contact informations box</label><br>
            <input type="checkbox" name="widget_social_icons" id="widget_social_icons"> <label for="widget_social_icons">Show social icons</label><br>
        </p>
*/
        ?>
        <p><?php esc_attr_e( '* Social Network account must be set from MT - Theme Panel.','urbanpointwp' ); ?></p>
        <?php 
    }



    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['widget_title'] = ( ! empty( $new_instance['widget_title'] ) ) ?  $new_instance['widget_title']  : '';
        $instance['widget_contact_details'] = ( ! empty( $new_instance['widget_contact_details'] ) ) ?  $new_instance['widget_contact_details']  : '';
        $instance['widget_social_icons'] = ( ! empty( $new_instance['widget_social_icons'] ) ) ?  $new_instance['widget_social_icons']  : '';

        return $instance;
    }
}

















/* ========= Flickr_Feed_Widget ===================================== */
class urbanpointwp_flickr extends WP_Widget { 
    
    function __construct() {
        $widget_ops = array('description' => esc_attr__('Display latest Flickr Feed','urbanpointwp') );
        $control_ops = array( 'width' => 60, 'height' => 60, 'id_base' => 'flickr' );
        parent::__construct( 'urbanpointwp_flickr', esc_attr__('MT - Flickr Feed','urbanpointwp'), $widget_ops, $control_ops );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $username = $instance['username'];
        $pics = $instance['pics'];
        
        echo  $before_widget;
        echo '<h1 class="widget-title">'.$title.'</h1>';

        echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$pics.'&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$username.'"></script>';
        echo  $after_widget;
    }
    
    // Update
    function update( $new_instance, $old_instance ) {  
        $instance = $old_instance; 
        
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['username'] = strip_tags( $new_instance['username'] );
        $instance['pics'] = strip_tags( $new_instance['pics'] );

        return $instance;
    }
    
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    function form($instance) {
        $defaults = array( 'title' => 'Flickr Widget', 'pics' => '9', 'username' => '49229574@N00' ); // Default Values
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title of the Widget', 'urbanpointwp'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'username' )); ?>"><?php esc_attr_e('Your Flickr ID:', 'urbanpointwp'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'username' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'username' )); ?>" value="<?php echo esc_attr($instance['username']); ?>" /><br /><a href="<?php echo esc_url_raw( 'http://idgettr.com/' ); ?>" target="_blank"><?php esc_attr_e('Flickr idGettr','urbanpointwp'); ?></a>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'pics' )); ?>"><?php esc_attr_e('Number of Photos to show:', 'urbanpointwp'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'pics' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pics' )); ?>" value="<?php echo esc_attr($instance['pics']); ?>" />
        </p>
        
    <?php }
}








/* ========= urbanpointwp_recent_entries_with_thumbnail ===================================== */
class urbanpointwp_recent_entries_with_thumbnail extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct('urbanpointwp_recent_entries_with_thumbnail', esc_attr__('MT - Recent Posts with thumbnails', 'urbanpointwp'),array( 'description' => esc_attr__( 'MT - Recent Posts with thumbnails', 'urbanpointwp' ), ) );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $recent_posts_title = $instance[ 'recent_posts_title' ];
        $recent_posts_number = $instance[ 'recent_posts_number' ];

        echo  $args['before_widget'];

        $args_recenposts = array(
                'posts_per_page'   => $recent_posts_number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'post',
                'post_status'      => 'publish' 
                );

        $recentposts = get_posts($args_recenposts);
        $myContent  = "";
        $myContent .= '<h1 class="widget-title">'.$recent_posts_title.'</h1>';
        $myContent .= '<ul>';

        foreach ($recentposts as $post) {
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'urbanpointwp_post_widget_pic100x100' );

            $myContent .= '<li class="row">';
                $myContent .= '<div class="vc_col-md-3 post-thumbnail relative">';
                    $myContent .= '<a href="'. get_permalink($post->ID) .'">';
                        if($thumbnail_src) { $myContent .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                        }else{ $myContent .= '<img src="http://placehold.it/100x100" alt="'. $post->post_title .'" />'; }
                        $myContent .= '<div class="thumbnail-overlay absolute">';
                            $myContent .= '<i class="fa fa-plus absolute"></i>';
                        $myContent .= '</div>';
                    $myContent .= '</a>';
                $myContent .= '</div>';
                $myContent .= '<div class="vc_col-md-9 post-details">';
                    $myContent .= '<a href="'. get_permalink($post->ID) .'">'. $post->post_title.'</a>';
                    $myContent .= '<span class="post-date">'.get_the_date(get_option( 'date_format') ).'</span>';
                $myContent .= '</div>';
            $myContent .= '</li>';
        }
        $myContent .= '</ul>';

        echo  $myContent;
        echo  $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        # Widget Title
        if ( isset( $instance[ 'recent_posts_title' ] ) ) {
            $recent_posts_title = $instance[ 'recent_posts_title' ];
        } else {
            $recent_posts_title = esc_attr__( 'Recent posts', 'urbanpointwp' );
        }

        # Number of posts
        if ( isset( $instance[ 'recent_posts_number' ] ) ) {
            $recent_posts_number = $instance[ 'recent_posts_number' ];
        } else {
            $recent_posts_number = '5';
        }

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'recent_posts_title' )); ?>"><?php esc_attr_e( 'Widget Title:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_posts_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_posts_title' )); ?>" type="text" value="<?php echo esc_attr( $recent_posts_title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'recent_posts_number' )); ?>"><?php esc_attr_e( 'Number of posts:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_posts_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_posts_number' )); ?>" type="text" value="<?php echo esc_attr( $recent_posts_number ); ?>">
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['recent_posts_title'] = ( ! empty( $new_instance['recent_posts_title'] ) ) ?  $new_instance['recent_posts_title']  : '';
        $instance['recent_posts_number'] = ( ! empty( $new_instance['recent_posts_number'] ) ) ? strip_tags( $new_instance['recent_posts_number'] ) : '';
        return $instance;
    }

} 








/* ========= Tabs Widget ===================================== */
class urbanpointwp_popular_recent_tabs extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct('urbanpointwp_popular_recent_tabs', esc_attr__('MT - TABS: Random, Recent posts', 'urbanpointwp'),array( 'description' => esc_attr__( 'MT - TABS: Random, Recent posts', 'urbanpointwp' ), ) );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $recent_posts_title = $instance[ 'recent_posts_title' ];
        $title_first_tab = $instance[ 'title_first_tab' ];
        $recent_posts_number = $instance[ 'recent_posts_number' ];

        $title_second_tab = $instance[ 'title_second_tab' ];
        $popular_posts_number = $instance[ 'popular_posts_number' ];

        echo  $args['before_widget'];

        $args_popularposts = array(
            'posts_per_page'   => $popular_posts_number,
            'orderby'          => 'rand',
            'post_type'        => 'post',
            'post_status'      => 'publish' 
        );
        $popularposts = get_posts($args_popularposts);

        $args_recenposts = array(
            'posts_per_page'   => $recent_posts_number,
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_type'        => 'post',
            'post_status'      => 'publish' 
        );
        $recentposts = get_posts($args_recenposts);



        $myContent  = "";
        $myContent .= '<h1 class="widget-title">'.$recent_posts_title.'</h1>';
        $myContent .= '<div class="widget_body">';
            $myContent .= '<ul class="nav nav-tabs">';
                $myContent .= '<li class="active"><a data-toggle="tab" href="#popular-posts">'.$title_first_tab.'</a></li>';
                $myContent .= '<li><a data-toggle="tab" href="#recent-posts">'.$title_second_tab.'</a></li>';
            $myContent .= '</ul>';
            $myContent .= '<div class="tab-content">';
                $myContent .= '<div id="popular-posts" class="tab-pane fade in active">';
                foreach ($popularposts as $post) {
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'urbanpointwp_post_pic700x450' );
                    $excerpt = get_post_field('post_content', $post->ID);

                    $myContent .= '<div class="recent-post">';
                        $myContent .= '<a href="'. get_permalink($post->ID) .'">';
                            if($thumbnail_src) { $myContent .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                            }else{ $myContent .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; }
                        $myContent .= '</a>';
                        $myContent .= '<div class="post-title">'. $post->post_title .'</div>';
                        $myContent .= '<div class="post-date">'.get_the_date(get_option( 'date_format' ), $post->ID ).'</div>';
                        $myContent .= '<div class="post-description">'.urbanpointwp_excerpt_limit($excerpt,10).'</div>';
                    $myContent .= '</div>';
                }
                $myContent .= '</div>';

                $myContent .= '<div id="recent-posts" class="tab-pane fade">';
                foreach ($recentposts as $post) {
                    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'urbanpointwp_post_pic700x450' );
                    $excerpt = get_post_field('post_content', $post->ID);
                    
                    $myContent .= '<div class="popular-post">';
                        $myContent .= '<a href="'. get_permalink($post->ID) .'">';
                            if($thumbnail_src) { $myContent .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                            }else{ $myContent .= '<img src="http://placehold.it/500x300" alt="'. $post->post_title .'" />'; }
                        $myContent .= '</a>';
                        $myContent .= '<div class="post-title">'. $post->post_title .'</div>';
                        $myContent .= '<div class="post-date">'.get_the_date(get_option( 'date_format' ), $post->ID ).'</div>';
                        $myContent .= '<div class="post-description">'.urbanpointwp_excerpt_limit($excerpt,10).'</div>';
                    $myContent .= '</div>';
                }
                $myContent .= '</div>';
            $myContent .= '</div>';
        $myContent .= '</div>';

        echo  $myContent;
        echo  $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        # Widget Title
        if ( isset( $instance[ 'recent_posts_title' ] ) ) {
            $recent_posts_title = $instance[ 'recent_posts_title' ];
        } else {
            $recent_posts_title = esc_attr__( 'Tab Widget', 'urbanpointwp' );
        }



        /*Tab 1 title*/
        if ( isset( $instance[ 'title_first_tab' ] ) ) {
            $title_first_tab = $instance[ 'title_first_tab' ];
        } else {
            $title_first_tab = esc_attr__( 'Random posts', 'urbanpointwp' );
        }
        # Number of posts
        if ( isset( $instance[ 'popular_posts_number' ] ) ) {
            $popular_posts_number = $instance[ 'popular_posts_number' ];
        } else {
            $popular_posts_number = '2';
        }


        /*Tab 2 title*/
        if ( isset( $instance[ 'title_second_tab' ] ) ) {
            $title_second_tab = $instance[ 'title_second_tab' ];
        } else {
            $title_second_tab = esc_attr__( 'Recent posts', 'urbanpointwp' );
        }
        # Number of posts
        if ( isset( $instance[ 'recent_posts_number' ] ) ) {
            $recent_posts_number = $instance[ 'recent_posts_number' ];
        } else {
            $recent_posts_number = '2';
        }

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'recent_posts_title' )); ?>"><?php esc_attr_e( 'Widget Title:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_posts_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_posts_title' )); ?>" type="text" value="<?php echo esc_attr( $recent_posts_title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title_first_tab' )); ?>"><?php esc_attr_e( 'Number of recent posts:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title_first_tab' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title_first_tab' )); ?>" type="text" value="<?php echo esc_attr( $title_first_tab ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'recent_posts_number' )); ?>"><?php esc_attr_e( 'Number of recent posts:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_posts_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_posts_number' )); ?>" type="text" value="<?php echo esc_attr( $recent_posts_number ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title_second_tab' )); ?>"><?php esc_attr_e( 'Number of popular posts:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title_second_tab' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title_second_tab' )); ?>" type="text" value="<?php echo esc_attr( $title_second_tab ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'popular_posts_number' )); ?>"><?php esc_attr_e( 'Number of popular posts:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'popular_posts_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'popular_posts_number' )); ?>" type="text" value="<?php echo esc_attr( $popular_posts_number ); ?>">
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['recent_posts_title'] = ( ! empty( $new_instance['recent_posts_title'] ) ) ?  $new_instance['recent_posts_title']  : '';
        $instance['title_first_tab'] = ( ! empty( $new_instance['title_first_tab'] ) ) ? strip_tags( $new_instance['title_first_tab'] ) : '';
        $instance['recent_posts_number'] = ( ! empty( $new_instance['recent_posts_number'] ) ) ? strip_tags( $new_instance['recent_posts_number'] ) : '';
        $instance['title_second_tab'] = ( ! empty( $new_instance['title_second_tab'] ) ) ? strip_tags( $new_instance['title_second_tab'] ) : '';
        $instance['popular_posts_number'] = ( ! empty( $new_instance['popular_posts_number'] ) ) ? strip_tags( $new_instance['popular_posts_number'] ) : '';
        return $instance;
    }

} 








/* ========= urbanpointwp_post_thumbnails_slider ===================================== */
class urbanpointwp_post_thumbnails_slider extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct('urbanpointwp_post_thumbnails_slider', esc_attr__('MT - Post thumbnails slider', 'urbanpointwp'),array( 'description' => esc_attr__( 'MT - Post thumbnails slider', 'urbanpointwp' ), ) );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $recent_posts_title = $instance[ 'recent_posts_title' ];
        $recent_posts_number = $instance[ 'recent_posts_number' ];

        echo  $args['before_widget'];

        $args_recenposts = array(
                'posts_per_page'   => $recent_posts_number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'post',
                'post_status'      => 'publish' 
                );

        $recentposts = get_posts($args_recenposts);
        $myContent  = "";
        $myContent .= '<h1 class="widget-title">'.$recent_posts_title.'</h1>';
        $myContent .= '<div class="slider_holder relative">';
            $myContent .= '<div class="slider_navigation absolute">';
                $myContent .= '<a class="btn prev pull-left"><i class="fa fa-angle-left"></i></a>';
                $myContent .= '<a class="btn next pull-right"><i class="fa fa-angle-right"></i></a>';
            $myContent .= '</div>';
            $myContent .= '<div class="post_thumbnails_slider owl-carousel owl-theme">';

            foreach ($recentposts as $post) {
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'urbanpointwp_post_pic700x450' );
                $myContent .= '<div class="item">';
                    $myContent .= '<a href="'. get_permalink($post->ID) .'">';
                        if($thumbnail_src) { $myContent .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                        }else{ $myContent .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; }
                    $myContent .= '</a>';
                $myContent .= '</div>';
            }
            $myContent .= '</div>';
        $myContent .= '</div>';

        echo  $myContent;
        echo  $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        # Widget Title
        if ( isset( $instance[ 'recent_posts_title' ] ) ) {
            $recent_posts_title = $instance[ 'recent_posts_title' ];
        } else {
            $recent_posts_title = esc_attr__( 'Post thumbnails slider', 'urbanpointwp' );
        }

        # Number of posts
        if ( isset( $instance[ 'recent_posts_number' ] ) ) {
            $recent_posts_number = $instance[ 'recent_posts_number' ];
        } else {
            $recent_posts_number = '5';
        }

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'recent_posts_title' )); ?>"><?php esc_attr_e( 'Widget Title:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_posts_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_posts_title' )); ?>" type="text" value="<?php echo esc_attr( $recent_posts_title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'recent_posts_number' )); ?>"><?php esc_attr_e( 'Number of posts:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'recent_posts_number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'recent_posts_number' )); ?>" type="text" value="<?php echo esc_attr( $recent_posts_number ); ?>">
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['recent_posts_title'] = ( ! empty( $new_instance['recent_posts_title'] ) ) ?  $new_instance['recent_posts_title']  : '';
        $instance['recent_posts_number'] = ( ! empty( $new_instance['recent_posts_number'] ) ) ? strip_tags( $new_instance['recent_posts_number'] ) : '';
        return $instance;
    }

} 


/* ========= urbanpointwp_social_share ===================================== */
class urbanpointwp_social_share extends WP_Widget {



    function __construct() {
        parent::__construct('urbanpointwp_social_share', esc_attr__('MT - Social Share Icons', 'urbanpointwp'),array( 'description' => esc_attr__( 'MT - Social Share Icons', 'urbanpointwp' ), ) );
    }



    public function widget( $args, $instance ) {

        $widget_title = $instance[ 'widget_title' ];
        $facebook = $instance['share-facebook'] ? 'true' : 'false';
        $twitter = $instance['share-twitter'] ? 'true' : 'false';
        $linkedin = $instance['share-linkedin'] ? 'true' : 'false';
        $googleplus = $instance['share-googleplus'] ? 'true' : 'false';
        $digg = $instance['share-digg'] ? 'true' : 'false';
        $pinterest = $instance['share-pinterest'] ? 'true' : 'false';
        $reddit = $instance['share-reddit'] ? 'true' : 'false';
        $stumbleupon = $instance['share-stumbleupon'] ? 'true' : 'false';


        echo  $args['before_widget'];

        $siteurl = get_permalink();
        $sitetitle = get_bloginfo('title');
        $sitedescription = get_bloginfo('description');

         ?>

        <div class="sidebar-share-social-links">
            <h3><?php echo  $instance[ 'widget_title' ];?></h3>
            <ul class="share-social-links">
                <?php if('on' == $instance['share-facebook'] ) { ?>
                <li class="facebook">
                    <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                    <?php /*<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr($siteurl); ?>" target="_blank"><i class="fa fa-facebook"></i></a>*/ ?>
                </li>
                <?php } if('on' == $instance['share-twitter'] ) {?>
                <li class="twitter">
                    <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                    <?php /*<a href="https://twitter.com/intent/tweet?url=<?php echo esc_attr($siteurl); ?>&amp;text=<?php echo esc_attr($sitedescription); ?>" target="_blank"><i class="fa fa-twitter"></i></a>*/ ?>
                </li>
                <?php } if('on' == $instance['share-linkedin'] ) {?>
                <li class="linkedin">
                    <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                    <?php /*<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_attr($siteurl); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>*/ ?>
                </li>
                <?php } if('on' == $instance['share-googleplus'] ) {?>
                <li class="googleplus">
                    <a href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
                    <?php /*<a href="https://plus.google.com/share?url=<?php echo esc_attr($siteurl); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>*/ ?>
                </li>
                <?php } if('on' == $instance['share-digg'] ) {?>
                <li class="digg">
                    <a href="#" target="_blank"><i class="fa fa-digg"></i></a>
                    <?php /*<a href="http://www.digg.com/submit?url=<?php echo esc_attr($siteurl); ?>" target="_blank"><i class="fa fa-digg"></i></a>*/ ?>
                </li>
                <?php } if('on' == $instance['share-pinterest'] ) {?>
                <li class="pinterest">
                    <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                    <?php /*<a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_attr($siteurl); ?>&amp;media=<?php echo esc_attr(urbanpointwp_redux('mt_logo', 'url')); ?>&amp;description=<?php echo esc_attr($sitedescription); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>*/ ?>
                </li>
                <?php } if('on' == $instance['share-reddit'] ) {?>
                <li class="reddit">
                    <a href="#" target="_blank"><i class="fa fa-reddit"></i></a>
                    <?php /*<a href="http://reddit.com/submit?url=<?php echo esc_attr($siteurl); ?>&amp;title=<?php echo esc_attr($sitetitle); ?>" target="_blank"><i class="fa fa-reddit"></i></a>*/ ?>
                </li>
                <?php } if('on' == $instance['share-stumbleupon'] ) {?>
                <li class="stumbleupon">
                    <a href="#" target="_blank"><i class="fa fa-stumbleupon"></i></a>
                    <?php /*<a href="http://www.stumbleupon.com/submit?url=<?php echo esc_attr($siteurl); ?>&amp;title=<?php echo esc_attr($sitetitle); ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a>*/ ?>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php 
        echo  $args['after_widget'];
    }





    public function form( $instance ) {

        # Widget Title
        if ( isset( $instance[ 'widget_title' ] ) ) {
            $widget_title = $instance[ 'widget_title' ];
        } else {
            $widget_title = esc_attr__( 'Social icons', 'urbanpointwp' );
        }

        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>"><?php esc_attr_e( 'Widget Title:','urbanpointwp' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'widget_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'widget_title' )); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>">
        </p>
        <p><?php esc_attr_e( 'Check what Social SHARE Buttons do you want to display','urbanpointwp' ); ?></p>
        <p>
            <input class="checkboxsocial" type="checkbox" <?php checked($instance['share-facebook'], 'on'); ?> id="<?php echo esc_attr($this->get_field_name('share-facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('share-facebook')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_name('share-facebook')); ?>"><?php esc_attr_e( 'Facebook','urbanpointwp' ); ?></label>
        </p>
        <p>
            <input class="checkboxsocial" type="checkbox" <?php checked($instance['share-twitter'], 'on'); ?> id="<?php echo esc_attr($this->get_field_name('share-twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('share-twitter')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_name('share-twitter')); ?>"><?php esc_attr_e( 'Twitter','urbanpointwp' ); ?></label>
        </p>
        <p>
            <input class="checkboxsocial" type="checkbox" <?php checked($instance['share-linkedin'], 'on'); ?> id="<?php echo esc_attr($this->get_field_name('share-linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('share-linkedin')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_name('share-linkedin')); ?>"><?php esc_attr_e( 'Linkedin','urbanpointwp' ); ?></label>
        </p>
        <p>
            <input class="checkboxsocial" type="checkbox" <?php checked($instance['share-googleplus'], 'on'); ?> id="<?php echo esc_attr($this->get_field_name('share-googleplus')); ?>" name="<?php echo esc_attr($this->get_field_name('share-googleplus')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_name('share-googleplus')); ?>"><?php esc_attr_e( 'Google Plus','urbanpointwp' ); ?></label>
        </p>
        <p>
            <input class="checkboxsocial" type="checkbox" <?php checked($instance['share-digg'], 'on'); ?> id="<?php echo esc_attr($this->get_field_name('share-digg')); ?>" name="<?php echo esc_attr($this->get_field_name('share-digg')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_name('share-digg')); ?>"><?php esc_attr_e( 'Digg','urbanpointwp' ); ?></label>
        </p>
        <p>
            <input class="checkboxsocial" type="checkbox" <?php checked($instance['share-pinterest'], 'on'); ?> id="<?php echo esc_attr($this->get_field_name('share-pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('share-pinterest')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_name('share-pinterest')); ?>"><?php esc_attr_e( 'Pinterest','urbanpointwp' ); ?></label>
        </p>
        <p>
            <input class="checkboxsocial" type="checkbox" <?php checked($instance['share-reddit'], 'on'); ?> id="<?php echo esc_attr($this->get_field_name('share-reddit')); ?>" name="<?php echo esc_attr($this->get_field_name('share-reddit')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_name('share-reddit')); ?>"><?php esc_attr_e( 'Reddit','urbanpointwp' ); ?></label>
        </p>
        <p>
            <input class="checkboxsocial" type="checkbox" <?php checked($instance['share-stumbleupon'], 'on'); ?> id="<?php echo esc_attr($this->get_field_name('share-stumbleupon')); ?>" name="<?php echo esc_attr($this->get_field_name('share-stumbleupon')); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_name('share-stumbleupon')); ?>"><?php esc_attr_e( 'Stumbleupon','urbanpointwp' ); ?></label>
        </p>
                

        <?php 
    }




    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['widget_title'] = ( ! empty( $new_instance['widget_title'] ) ) ?  $new_instance['widget_title']  : '';
        
        $instance['share-facebook'] = ( ! empty( $new_instance['share-facebook'] ) ) ?  $new_instance['share-facebook']  : '';
        $instance['share-twitter'] = ( ! empty( $new_instance['share-twitter'] ) ) ?  $new_instance['share-twitter']  : '';
        $instance['share-linkedin'] = ( ! empty( $new_instance['share-linkedin'] ) ) ?  $new_instance['share-linkedin']  : '';
        $instance['share-googleplus'] = ( ! empty( $new_instance['share-googleplus'] ) ) ?  $new_instance['share-googleplus']  : '';
        $instance['share-digg'] = ( ! empty( $new_instance['share-digg'] ) ) ?  $new_instance['share-digg']  : '';
        $instance['share-pinterest'] = ( ! empty( $new_instance['share-pinterest'] ) ) ?  $new_instance['share-pinterest']  : '';
        $instance['share-reddit'] = ( ! empty( $new_instance['share-reddit'] ) ) ?  $new_instance['share-reddit']  : '';
        $instance['share-stumbleupon'] = ( ! empty( $new_instance['share-stumbleupon'] ) ) ?  $new_instance['share-stumbleupon']  : '';

        return $instance;
    }
}




// Register Widgets
function urbanpointwp_register_widgets() {
    register_widget( 'urbanpointwp_address_social_icons' );
    register_widget( 'urbanpointwp_social_share' );
    register_widget( 'urbanpointwp_flickr' );
    register_widget( 'urbanpointwp_recent_entries_with_thumbnail' );
    register_widget( 'urbanpointwp_post_thumbnails_slider' );
    register_widget( 'urbanpointwp_popular_recent_tabs' );

}
add_action( 'widgets_init', 'urbanpointwp_register_widgets' );
?>
