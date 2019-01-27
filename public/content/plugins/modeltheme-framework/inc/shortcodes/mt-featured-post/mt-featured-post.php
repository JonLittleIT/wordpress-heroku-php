<?php

/**

||-> Shortcode: Featured Post with Thumbnail

*/
function modeltheme_featured_post_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'      => '',
            'icon'      => '',
            'postid'    => '',
            'title'     => ''
        ), $params ) );
    $featured_post = '';
    #Content
    $content_post = get_post($postid);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    #Author
    $post_author_id = get_post_field( 'post_author', $postid );
    $user_info = get_userdata($post_author_id);
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ),'smartowl_featured_post_pic500x230' );
    $featured_post .= '<div class="latest-videos animateIn" data-animate="'.$animation.'">';
        $featured_post .= '<h3 class=""><i class="'.$icon.'"></i>'.$title.'</h3>';
        $featured_post .= '<a href="'.get_permalink( $postid ).'">';
            if($thumbnail_src) { $featured_post .= '<img class="img-responsive" src="'. $thumbnail_src[0] . '" alt="" />';
            }else{ $featured_post .= '<img class="img-responsive" src="http://placehold.it/500x230" alt="" />'; }
        $featured_post .= '</a>';
        $featured_post .= '<div class="video-title">';
            $featured_post .= '<a href="'.get_permalink( $postid ).'">'.get_the_title( $postid ).'</a>';
            $featured_post .= '<span class="post-date"><i class="fa fa-calendar"></i>'.get_the_date('', $postid ).'</span>';
            $featured_post .= '</div>';
        $featured_post .= '<div class="video-excerpt">'.modeltheme_excerpt_limit($content,20).'</div>';
    $featured_post .= '</div>';
    return $featured_post;
}
add_shortcode('featured_post', 'modeltheme_featured_post_shortcode');








/**

||-> Map Shortcode in Visual Composer with: vc_map();

*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {

    require_once __DIR__ . '/../vc-shortcodes.inc.arrays.php';

  vc_map( array(
     "name" => esc_attr__("MT - Featured post", 'modeltheme'),
     "base" => "featured_post",
     "category" => esc_attr__('MT: ModelTheme', 'modeltheme'),
     "icon" => "smartowl_shortcode",
     "params" => array(
        array(
          "group" => "Options",
          "type" => "dropdown",
          "heading" => esc_attr__("Section heading icon", 'modeltheme'),
          "param_name" => "icon",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $fa_list
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Section title", 'modeltheme'),
           "param_name" => "title",
           "value" => "",
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Please type a post ID", 'modeltheme'),
           "param_name" => "postid",
           "value" => "",
           "description" => ""
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
     )
  ));
}