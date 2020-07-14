<?php

if(!class_exists('WooCommerce')) return;

define( 'BESA_WOOCOMMERCE_ACTIVED', true );

// First Register the Tab by hooking into the 'woocommerce_product_data_tabs' filter
if ( ! function_exists( 'besa_add_custom_product_data_tab' ) ) {
  add_filter( 'woocommerce_product_data_tabs', 'besa_add_custom_product_data_tab', 80 );
  function besa_add_custom_product_data_tab( $product_data_tabs ) {
      $product_data_tabs['besa-options-tab'] = array(
          'label' => esc_html__( 'Besa Options', 'besa' ),
          'target' => 'besa_product_data',
          'class'     => array(),
          'priority' => 100,
      );
      return $product_data_tabs;
  }
}


// functions you can call to output text boxes, select boxes, etc.
add_action('woocommerce_product_data_panels', 'besa_options_woocom_product_data_fields');

function besa_options_woocom_product_data_fields() {
  global $post;

  // Note the 'id' attribute needs to match the 'target' parameter set above
  ?> <div id = 'besa_product_data'
  class = 'panel woocommerce_options_panel' > <?php
      ?> <div class = 'options_group' > <?php
                  // Text Field
      woocommerce_wp_text_input(
        array(
          'id' => '_besa_video_url', 
          'label' => esc_html__('Featured Video URL', 'besa'),
          'placeholder' => esc_html__('Video URL', 'besa'),
          'desc_tip' => true,
          'description' => esc_html__('Enter the video url at https://vimeo.com/ or https://www.youtube.com/', 'besa')
        )
      );


      ?> 
    </div>

  </div><?php
}

if( ! function_exists( 'besa_options_woocom_save_proddata_custom_fields' ) ) {
  /** Hook callback function to save custom fields information */
  function besa_options_woocom_save_proddata_custom_fields($product) {
			$video_url = isset( $_POST['_besa_video_url'] ) ? $_POST['_besa_video_url'] : '';
			$old_value_url = $product->get_meta( '_besa_video_url' );

			if( $video_url !== $old_value_url ) {
				$product->update_meta_data( '_besa_video_url', $video_url );
				$img_id = '';
				if ( ! empty( $video_url ) ) {
					$video_info = explode( ':', besa_video_type_by_url( $video_url ) );
					$img_id     = besa_save_video_thumbnail( array(
						'host' => $video_info[0],
						'id'   => $video_info[1] 
					) );
				}
				$product->update_meta_data( '_besa_video_image_url', $img_id );
			}

  }

  add_action( 'woocommerce_admin_process_product_object', 'besa_options_woocom_save_proddata_custom_fields', 20  );
}


function besa_save_video_thumbnail( $video_info ){

  $name = isset( $video_info['name'] ) ? $video_info['name'] : $video_info['id'];
  switch ( $video_info['host'] ) {

    case 'vimeo' :
      if ( function_exists( 'simplexml_load_file' ) ) {
        $img_url = 'http://vimeo.com/api/v2/video/' . $video_info['id'] . '.xml';
        $xml     = simplexml_load_file( $img_url );

        $img_url = isset( $xml->video->thumbnail_large ) ? (string) $xml->video->thumbnail_large : '';

        if ( ! empty( $img_url ) ) {
          $tmp = getimagesize( $img_url );

          if ( ! is_wp_error( $tmp ) ) {
            $result = 'ok';
          }
        }
      }
      break;
    case 'youtube':
      $youtube_image_sizes = array(
        'maxresdefault',
        'hqdefault',
        'mqdefault',
        'sqdefault'
      );

      $youtube_url = 'https://img.youtube.com/vi/' . $video_info['id'] . '/';
      foreach ( $youtube_image_sizes as $image_size ) {

        $img_url      = $youtube_url . $image_size . '.jpg';
        $get_response = wp_remote_get( $img_url );
        $result = $get_response['response']['code'] == '200' ? 'ok' : 'no';
        if ( $result == 'ok' ) {
          break;
        }
      }

      break;
  }

  $img_id = '';

  if ( 'ok' === $result ) {

    $img_id = besa_save_remote_image( $img_url, $name );
  }

  return $img_id;
}

if ( ! function_exists( 'besa_save_remote_image' ) ) {

	function besa_save_remote_image( $url, $newfile_name = '' ) {

		$url = str_replace( 'https', 'http', $url );
		$tmp = download_url( (string) $url );

		$file_array = array();
		preg_match( '/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', (string) $url, $matches );
		$file_name = basename( $matches[0] );
		if ( '' !== $newfile_name ) {
			$file_name_info = explode( '.', $file_name );
			$file_name      = $newfile_name . '.' . $file_name_info[1];
		}


		if ( ! function_exists( 'remove_accents' ) ) {
			require_once( ABSPATH . 'wp-includes/formatting.php' );
		}
		$file_name = sanitize_file_name( remove_accents( $file_name ) );
		$file_name = str_replace( '-', '_', $file_name );

		$file_array['name']     = $file_name;
		$file_array['tmp_name'] = $tmp;

		// If error storing temporarily, unlink
		if ( is_wp_error( $tmp ) ) {
			@unlink( $file_array['tmp_name'] );
			$file_array['tmp_name'] = '';

		}

		// do the validation and storage stuff
		return media_handle_sideload( $file_array, 0 );
	}

}

if( ! function_exists( 'tbay_size_guide_metabox_output' ) ) {
  function tbay_size_guide_metabox_output( $post ) {


    ?>
    <div id="product_size_guide_images_container">
      <ul class="product_size_guide_images">
        <?php
          $product_image = array();

          if ( metadata_exists( 'post', $post->ID, '_product_size_guide_image' ) ) {
            $product_image = get_post_meta( $post->ID, '_product_size_guide_image', true );
          } else {
            // Backwards compat
            $attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_key=_woocommerce_size_guide_image&meta_value=1' );
            $attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
            $product_image = implode( ',', $attachment_ids );
          }

          $attachments         = array_reverse(array_filter( explode( ',', $product_image ) ));
          $update_meta         = false;
          $updated_gallery_ids = array();

          if ( ! empty( $attachments ) ) {
            foreach ( $attachments as $key => $attachment_id ) {

              if( $key != 0) {
                unset($attachment_id);
              } else {
                 $attachment = wp_get_attachment_image( $attachment_id, 'thumbnail' );

                // if attachment is empty skip
                if ( empty( $attachment ) ) {
                  $update_meta = true;
                  continue;
                }

                echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
                  ' . $attachment . '
                  <ul class="actions">               
                    <li><a href="#" class="delete tips" data-tip="' . esc_attr__( 'Remove product image', 'besa' ) . '">' . esc_html__( 'Remove product image', 'besa' ) . '</a></li>
                  </ul>
                </li>';

                // rebuild ids to be saved
                $updated_gallery_ids[] = $attachment_id;

              }
             
            }

            // need to update product meta to set new gallery ids
            if ( $update_meta ) {
              update_post_meta( $post->ID, '_product_size_guide_image', implode( ',', $updated_gallery_ids ) );
            }
          }
        ?>
      </ul>

      <input type="hidden" id="product_size_guide_image" name="product_size_guide_image" value="<?php echo esc_attr( $product_image ); ?>" />

    </div>
    <p class="add_product_size_guide_images hide-if-no-js">
      <a href="#" data-choose="<?php esc_attr_e( 'Add Images to Product Size Guide', 'besa' ); ?>" data-update="<?php esc_attr_e( 'Add to image', 'besa' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'besa' ); ?>" data-text="<?php esc_attr_e( 'Remove product image', 'besa' ); ?>"><?php esc_html_e( 'Add product Size Guide view images', 'besa' ); ?></a>
    </p>
    <?php

  }
}


/**
 * ------------------------------------------------------------------------------------------------
 * Save metaboxes
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'besa_proccess_size_guide_view_metabox' ) ) {
  add_action( 'woocommerce_process_product_meta', 'besa_proccess_size_guide_view_metabox', 50, 2 );
  function besa_proccess_size_guide_view_metabox( $post_id, $post ) {
    $attachment_ids = isset( $_POST['product_size_guide_image'] ) ? array_filter( explode( ',', wc_clean( $_POST['product_size_guide_image'] ) ) ) : array();

    update_post_meta( $post_id, '_product_size_guide_image', implode( ',', $attachment_ids ) );
  }
}


/**
 * ------------------------------------------------------------------------------------------------
 * Returns the size guide image attachment ids.
 * ------------------------------------------------------------------------------------------------
 */
if( ! function_exists( 'besa_get_size_guide_attachment_ids' ) ) {
  function besa_get_size_guide_attachment_ids() {
    global $post;

    if( ! $post ) return;

    $product_image = get_post_meta( $post->ID, '_product_size_guide_image', true);

    return apply_filters( 'woocommerce_product_size_guide_attachment_ids', array_filter( array_filter( (array) explode( ',', $product_image ) ), 'wp_attachment_is_image' ) );
  }
}


/**
 * ------------------------------------------------------------------------------------------------
 * Dropdown
 * ------------------------------------------------------------------------------------------------
 */
//Dropdown template
if( ! function_exists( 'tbay_swatch_attribute_template' ) ) {
    function tbay_swatch_attribute_template( $post ){

        global $post;


        $attribute_post_id = get_post_meta( $post->ID, '_besa_attribute_select' );
        $attribute_post_id = isset( $attribute_post_id[0] ) ? $attribute_post_id[0] : '';

        ?>

          <select name="besa_attribute_select" class="besa_attribute_taxonomy">
            <option value="" selected="selected"><?php esc_html_e( 'Global Setting', 'besa' ); ?></option>

              <?php 

                global $wc_product_attributes;

                // Array of defined attribute taxonomies.
                $attribute_taxonomies = wc_get_attribute_taxonomies();

                if ( ! empty( $attribute_taxonomies ) ) {
                  foreach ( $attribute_taxonomies as $tax ) {
                    $attribute_taxonomy_name = wc_attribute_taxonomy_name( $tax->attribute_name );
                    $label                   = $tax->attribute_label ? $tax->attribute_label : $tax->attribute_name;

                    echo '<option value="' . esc_attr( $attribute_taxonomy_name ) . '" '. selected( $attribute_post_id, $attribute_taxonomy_name ) .' >' . esc_html( $label ) . '</option>';
                  }
                }

              ?>

          </select>

        <?php
    }
}


//Dropdown Save
if( ! function_exists( 'besa_attribute_dropdown_save' ) ) {
    add_action( 'woocommerce_process_product_meta', 'besa_attribute_dropdown_save', 30, 2 );

    function besa_attribute_dropdown_save( $post_id ){
        if ( isset( $_POST['besa_attribute_select'] ) ) {    

          update_post_meta( $post_id, '_besa_attribute_select', $_POST['besa_attribute_select'] );     

        }
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Dropdown
 * ------------------------------------------------------------------------------------------------
 */
//Dropdown Single layout template
if( ! function_exists( 'tbay_single_select_single_layout_template' ) ) {
    function tbay_single_select_single_layout_template( $post ){

        global $post;


        $layout_post_id = get_post_meta( $post->ID, '_besa_single_layout_select' );
        $layout_post_id = isset( $layout_post_id[0] ) ? $layout_post_id[0] : '';

        ?>

          <select name="besa_layout_select" class="besa_single_layout_taxonomy">
            <option value="" selected="selected"><?php esc_html_e( 'Global Setting', 'besa' ); ?></option>

              <?php 

                global $wc_product_attributes;



                // Array of defined attribute taxonomies.
                $attribute_taxonomies = wc_get_attribute_taxonomies();



                  $layout_selects = apply_filters( 'besa_layout_select_filters', array(
                    'vertical'              => esc_html__('Image Vertical', 'besa'), 
                    'horizontal'            => esc_html__('Image Horizontal', 'besa'),
                    'left-main'             => esc_html__('Left - Main Sidebar', 'besa'),
                    'main-right'            => esc_html__('Main - Right Sidebar', 'besa')
                  ));

                  foreach ( $layout_selects as $key => $select ) {

                    echo '<option value="' . esc_attr( $key ) . '" '. selected( $layout_post_id, $key ) .' >' . esc_html( $select ) . '</option>';
                  }

              ?>

          </select>

        <?php
    }
}


//Dropdown Save
if( ! function_exists( 'besa_single_select_dropdown_save' ) ) {
    add_action( 'woocommerce_process_product_meta', 'besa_single_select_dropdown_save', 30, 2 );

    function besa_single_select_dropdown_save( $post_id ){
        if ( isset( $_POST['besa_layout_select'] ) ) {    

          update_post_meta( $post_id, '_besa_single_layout_select', $_POST['besa_layout_select'] );     

        }
    }
}
