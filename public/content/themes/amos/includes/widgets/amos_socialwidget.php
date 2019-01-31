<?php 

class AmosSocialWidget extends WP_Widget{


    function __construct(){

        $options = array('classname' => 'social_widget', 'description' => 'Add a social widget' );

        parent::__construct( 'social_widget', THEMENAME.' Social Widget', $options );

    }


    function widget($atts, $instance){

        extract($atts, EXTR_SKIP);

        global $amos_redata;

        echo amos_output($before_widget);

        

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        $text = empty($instance['text']) ? '' : $instance['text'];

        $style = empty($instance['style']) ? '' : $instance['style'];
        

        
        if(!empty($title))
            echo amos_output($before_title . $title . $after_title);
     


        echo '<ul class="footer_social_icons '.esc_attr($style).'">';
            
            if( !empty($amos_redata['facebook']) )
               echo '<li class="facebook"><a href="'.esc_url($amos_redata['facebook']).'"><i class="fa fa-facebook-f"></i></a></li>';
            if( !empty($amos_redata['twitter']) )
                echo '<li class="twitter"><a href="'.esc_url($amos_redata['twitter']).'"><i class="fa fa-twitter"></i></a></li>';
            if( !empty($amos_redata['flickr']) )
                echo '<li class="flickr"><a href="'.esc_url($amos_redata['flickr']).'"><i class="fa fa-flickr"></i></a></li>';
            if( !empty($amos_redata['google']) )
                echo '<li class="google"><a href="'.esc_url($amos_redata['google']).'"><i class="fa fa-google"></i></a></li>';
            if( !empty($amos_redata['dribbble']) )
                echo '<li class="dribbble"><a href="'.esc_url($amos_redata['dribbble']).'"><i class="fa fa-dribbble"></i></a></li>';
            if( !empty($amos_redata['foursquare']) )
                echo '<li class="foursquare"><a href="'.esc_url($amos_redata['foursquare']).'"><i class="fa fa-foursquare"></i></a></li>';
            if( !empty($amos_redata['linkedin']) )
                echo '<li class="foursquare"><a href="'.esc_url($amos_redata['linkedin']).'"><i class="fa fa-linkedin"></i></a></li>';
            if( !empty($amos_redata['youtube']) )
                echo '<li class="youtube"><a href="'.esc_url($amos_redata['youtube']).'"><i class="fa fa-youtube-play"></i></a></li>';
            if( !empty($amos_redata['email']) )
                echo '<li class="email"><a href="'.esc_url($amos_redata['email']).'"><i class="fa fa-envelope-o"></i></a></li>';
            if( !empty($amos_redata['pinterest']) )
                echo '<li class="pinterest"><a href="'.esc_url($amos_redata['instagram']).'"><i class="fa fa-pinterest"></i></a></li>';
            if( !empty($amos_redata['instagram']) )
                echo '<li class="email"><a href="'.esc_url($amos_redata['instagram']).'"><i class="fa fa-instagram"></i></a></li>';

        echo '</ul>';



        echo amos_output($after_widget);

    }



    function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = $new_instance['title'];

        $instance['text'] = $new_instance['text'];

        $instance['style'] = $new_instance['style'];

        return $instance;

    }


    function form($instance){

        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'style' => '') );

        $title = isset($instance['title']) ? $instance['title']: "";

        $text = isset($instance['text']) ? $instance['text']: "";

        $style = isset($instance['style']) ? $instance['style']: "";

        ?>

        <p>

            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title: 

            <input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>

        </p>

        <p>

            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>">Text: 

            <textarea id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" ><?php echo esc_attr($text); ?></textarea>

        </p>

        <p>

            <label for="<?php echo esc_attr($this->get_field_id('style')); ?>">Style: 

            <select id="<?php echo esc_attr($this->get_field_id('style')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" value="<?php echo esc_attr($style); ?>">
                <?php $values = array('Simple', 'Circle'); ?>
                <?php foreach($values as $v): ?>
                    <?php $selected = ''; if(strtolower($v) == esc_attr($style) ) $selected = 'selected="selected"'; ?>
                    <option value="<?php echo strtolower($v) ?>" <?php echo esc_attr($selected) ?> ><?php echo esc_attr($v) ?></option>
                <?php endforeach; ?>
            </select>

        </p>

        <?php

    }

}
?>