<?php

if ( class_exists( 'CMB2', false ) ) {
    return;
}

if ( !function_exists( 'besa_tbay_post_metaboxes' ) ) {
    function besa_tbay_post_metaboxes(array $metaboxes) {

        $prefix = 'tbay_post_';
        $fields = array(
            array(
                'id'   => "{$prefix}gallery_files",
                'name' => esc_html__( 'Images Gallery', 'besa' ),
                'type' => 'file_list',
            ),

            array(
                'id'   => "{$prefix}video_link",
                'name' => esc_html__( 'Video Link', 'besa' ),
                'type' => 'oembed',
            ),
             
            array(
                'id'   => "{$prefix}audio_link",
                'name' => esc_html__( 'Audio Link', 'besa' ),
                'type' => 'oembed',
            ),  
        );
        
        $metaboxes[$prefix . 'format_setting'] = array(
            'id'                        => 'post_format_standard_post_meta',
            'title'                     => esc_html__( 'Format Setting', 'besa' ),
            'object_types'              => array( 'post' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'autosave'                  => true,
            'fields'                    => $fields
        );

        return $metaboxes;
    }
}
add_filter( 'cmb2_meta_boxes', 'besa_tbay_post_metaboxes' );

function besa_tbay_standard_post_meta( $post_id ){
        
    global $post; 
    $prefix = 'tbay_post_';
    $type = get_post_format();

    $old = array(
        'gallery_files',
        'video_link',
        'link_text',
        'link_link',
        'audio_link',
    );
    
    $data = array( 'gallery' => array('gallery_files'), 
                   'video' =>  array('video_link'), 
                   'audio' =>  array('audio_link')); 

    $new = array();

    if( isset($data[$type]) ){
        foreach( $data[$type] as $key => $value ){
            $new[$prefix.$value] = $_POST[$prefix.$value];
        }
    }


    foreach( $old as $key => $value ){
        if( isset($_POST[$prefix.$value]) ){
            unset( $_POST[$prefix.$value] );
        }
    }
    if( $new ){
        $_POST = array_merge( $_POST, $new );
    }

}
add_action( "cmb2_meta_post_format_standard_post_meta_before_save_post", 'besa_tbay_standard_post_meta' , 9  );