<?php

/**

 * @author Aqura

 * @since 1.0.0

 */



// File Security Check

if ( ! defined( 'ABSPATH' ) ) { exit; }



add_filter( 'rwmb_meta_boxes', 'aqura_meta_box' );



function aqura_meta_box( $meta_boxes ) {



	$meta_boxes[] = array(

		'id'		=> 'aqura_white_header_options',

		'title'  	=> esc_html__('Header Options', 'aqura'),

		'pages'  	=> array('page', 'post', 'albums' , 'gallery', 'events'),

		'context'	=> 'side',

		'priority'  => 'high',

		'fields'	=> array(

			array(

				'name'            => esc_html__( 'Header Content Color' , 'aqura' ),

				'id'              => 'aqura_white_header_options__color_checkbox',

				'type'            => 'select',

				'options'         => array(

					'light' => esc_html__( 'Light' , 'aqura' ),

					'dark'  => esc_html__( 'Dark' , 'aqura' ),

				),

				'std'			  => 'light',

			),

		),

	);



	$meta_boxes[] = array(

		'id'		=> 'aqura_blog_layout',

		'title'  	=> esc_html__('Blog Layout', 'aqura'),

		'pages'  	=> array('post'),

		'context'	=> 'side',

		'priority'  => 'high',

		'fields'	=> array(

			array(

				'name'            => esc_html__( 'Blog Layout' , 'aqura' ),

				'id'              => 'aqura_blog_layout__layout',

				'type'            => 'select',

				'options'         => array(

					'1'  	=> esc_html__( '01' , 'aqura' ),

					'2' 	=> esc_html__( '02' , 'aqura' ),

				),

				'std'			  => '1'

			),

		),

	);



	$meta_boxes[] = array(

		'id'		=> 'aqura_album_layout',

		'title'  	=> esc_html__('Album Layout', 'aqura'),

		'pages'  	=> array('albums'),

		'context'	=> 'side',

		'priority'  => 'high',

		'fields'	=> array(

			array(

				'name'            => esc_html__( 'Album Layout' , 'aqura' ),

				'id'              => 'aqura_album_layout__layout',

				'type'            => 'select',

				'options'         => array(

					'1'  	=> esc_html__( '01' , 'aqura' ),

					'2' 	=> esc_html__( '02' , 'aqura' ),

				),

				'std'			  => '1'

			),

			array(

				'name'			=> esc_html__( 'Hide Player', 'aqura' ),

				'id'			=> 'aqura_album_layout__layout__player_show_hide',

				'type'		 	=> 'checkbox',

			)

		),

	);



	$meta_boxes[] = array(

		'id'		=> 'aqura_post__options',

		'title'  	=> esc_html__('Article Options', 'aqura'),

		'pages'  	=> array('post'),

		'priority'  => 'high',

		'tabs'	  	=> array(

			'aqura_post__options__header_image__tab' => esc_html__( 'Header Image', 'aqura' ),

			'aqura_post__options__article_type__tab' => esc_html__( 'Article Type', 'aqura' ),

		),

		'tab_style' => 'left',

		'fields'	=> array(

			array(

				'name'		=> esc_html__( 'Title', 'aqura' ),

				'id'		=> 'aqura_post__options__header_image__title',

				'type'		=> 'text',

				'desc'		=> esc_html__( 'If this field is empty the title will be the article\'s title.', 'aqura' ),

				'tab'  		=> 'aqura_post__options__header_image__tab',

			),

			array(

				'name'	=> esc_html__( 'Description', 'aqura' ),

				'id'	=> 'aqura_post__options__header_image__description',

				'type'	=> 'textarea',

				'tab'  	=> 'aqura_post__options__header_image__tab',

			),

			array(

				'name'		=> esc_html__( 'View More Text', 'aqura' ),

				'id'		=> 'aqura_post__options__header_image__view_more',

				'type'		=> 'text',

				'desc'		=> esc_html__( 'If this field is empty the view more text will be "View More".', 'aqura' ),

				'tab'  		=> 'aqura_post__options__header_image__tab',

			),

			array(

				'name' 				=> esc_html__( 'Header Image Background', 'aqura' ),

				'id'   				=> 'aqura_post__options__header_image__bg',

				'type' 				=> 'image_advanced',

				'max_file_uploads' 	=> 1,

				'tab'  				=> 'aqura_post__options__header_image__tab',

			),

			array(

				'name'		=> esc_html__( 'Choose the type of this article', 'aqura' ),

				'id'		=> 'aqura_post__options__article_type__the_type',

				'type'		=> 'radio',

				'tab'  		=> 'aqura_post__options__article_type__tab',

				'options'	=> array(

					'standard'		=> esc_html__('Standard', 'aqura'),

					'vimeo'		 	=> esc_html__('Vimeo', 'aqura'),

					'youtube'		=> esc_html__('YouTube', 'aqura'),

					'gallery'		=> esc_html__('Gallery', 'aqura'),

					'soundcloud'	=> esc_html__('Soundcloud', 'aqura'),

					'quote'			=> esc_html__('Quote', 'aqura')

				),

				'std'		=> 'standard',

			),

			array(

				'name'	=> esc_html__( 'Video ID', 'aqura' ),

				'id'	=> 'aqura_post__options__article_type__video_id',

				'type'	=> 'text',

				'tab'  	=> 'aqura_post__options__article_type__tab',

			),

			array(

				'name'	=> esc_html__( 'Soundcloud Track ID', 'aqura' ),

				'id'	=> 'aqura_post__options__article_type__soundcloud_track_id',

				'type'	=> 'text',

				'tab'  	=> 'aqura_post__options__article_type__tab',

			),

			array(

				'name'	=> esc_html__( 'Quote Text', 'aqura' ),

				'id'	=> 'aqura_post__options__article_type__quote_text',

				'type'	=> 'textarea',

				'tab'  	=> 'aqura_post__options__article_type__tab',

			),

			array(

				'name'	=> esc_html__( 'Quote Icon', 'aqura' ),

				'id'	=> 'aqura_post__options__article_type__quote_icon',

				'type'	=> 'text',

				'tab'  	=> 'aqura_post__options__article_type__tab',

				'desc'	=> esc_html__( 'A FontAwesome class like "fa-lightbulb-o" for instance.' , 'aqura' ),

				'std'	=> 'fa-lightbulb-o',

			),

			array(

				'name'	=> esc_html__( 'Quote Author', 'aqura' ),

				'id'	=> 'aqura_post__options__article_type__quote_author',

				'type'	=> 'text',

				'tab'  	=> 'aqura_post__options__article_type__tab',

			),

			array(

				'name' 	=> esc_html__( 'Gallery Images', 'aqura' ),

				'id'   	=> 'aqura_post__options__article_type__gallery_images',

				'type' 	=> 'image_advanced',

				'tab'  	=> 'aqura_post__options__article_type__tab',

			),

		),

	);



	$meta_boxes[] = array(

		'id'		=> 'aqura_album_options',

		'title'  	=> esc_html__('Album Options', 'aqura'),

		'pages'  	=> array('albums'),

		'priority'  => 'high',

		'tabs'	  	=> array(

			'aqura_album_options__page_options__tab' 	=> esc_html__( 'Album Page Options', 'aqura' ),

			'aqura_album_options__details__tab' 		=> esc_html__( 'Album Details', 'aqura' ),

			'aqura_album_options__download_links__tab' 	=> esc_html__( 'Album Download Links', 'aqura' ),

			'aqura_album_options__tracks__tab' 			=> esc_html__( 'Album Tracks', 'aqura' ),

		),

		'tab_style' => 'left',

		'fields'	=> array(

			array(

				'name'		  		=> esc_html__( 'Page Background', 'aqura' ),

				'id'				=> 'aqura_album_options__page_background',

				'type'		  		=> 'image_advanced',

				'max_file_uploads' 	=> 1,

				'tab'  				=> 'aqura_album_options__page_options__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Cover Album Image', 'aqura' ),

				'id'				=> 'aqura_album_options__album_cover',

				'type'		  		=> 'image_advanced',

				'max_file_uploads' 	=> 1,

				'tab'  				=> 'aqura_album_options__page_options__tab',

			),

			array(

				'name'				=> esc_html__( 'Background Color For Square Listing', 'aqura' ),

				'id'				=> 'aqura_album_options__bg_color_square_listing',

				'type'				=> 'color',

				'tab'  				=> 'aqura_album_options__page_options__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Header Image Title', 'aqura' ),

				'id'				=> 'aqura_album_options__header_image__title',

				'type'		  		=> 'text',

				'desc'				=> esc_html__( 'If this field is empty the title will be the album\'s title.', 'aqura' ),

				'tab'  				=> 'aqura_album_options__page_options__tab',

			),

			array(

				'name'				=> esc_html__( 'Header Image Description', 'aqura' ),

				'id'				=> 'aqura_album_options__header_image__description',

				'type'				=> 'textarea',

				'tab'  				=> 'aqura_album_options__page_options__tab',

			),

			array(

				'name'				=> esc_html__( 'Header Image View More Text', 'aqura' ),

				'id'				=> 'aqura_album_options__header_image__view_more',

				'type'				=> 'text',

				'desc'				=> esc_html__( 'If this field is empty the view more text will be "View More".', 'aqura' ),

				'tab'  				=> 'aqura_album_options__page_options__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Release date', 'aqura' ),

				'id'				=> 'aqura_album_options__release_date',

				'type'		  		=> 'date',

				'tab'  				=> 'aqura_album_options__details__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Catalog', 'aqura' ),

				'id'				=> 'aqura_album_options__album_catalog',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options__details__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Label', 'aqura' ),

				'id'				=> 'aqura_album_options__album_label',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options__details__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Format', 'aqura' ),

				'id'				=> 'aqura_album_options__album_format',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options__details__tab',

			),

			array(

				'name'				=> esc_html__( 'Last.fm', 'aqura' ),

				'id'				=> 'aqura_album_options__last_fm',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options__download_links__tab',

			),

			array(

				'name'				=> esc_html__( 'SoundCloud', 'aqura' ),

				'id'				=> 'aqura_album_options__soundcloud',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options__download_links__tab',

			),

			array(

				'name'				=> esc_html__( 'iTunes', 'aqura' ),

				'id'				=> 'aqura_album_options__itunes',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options__download_links__tab',

			),

			array(

				'name'				=> esc_html__( 'Spotify', 'aqura' ),

				'id'				=> 'aqura_album_options__spotify',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options__download_links__tab',

			),

			array(

				'name'				=> esc_html__( 'Amazon', 'aqura' ),

				'id'				=> 'aqura_album_options__amazon',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options__download_links__tab',

			),

			array(

				'name'				=> esc_html__( 'Beatport', 'aqura' ),

				'id'				=> 'aqura_album_options__beatport',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options__download_links__tab',

			),

			array(

				'id'	 			=> 'aqura_album_options__album_tracks',

				'type'   			=> 'group',

				'clone'  			=> true,

				'sort_clone' 		=> true,

				'tab'  				=> 'aqura_album_options__tracks__tab',

				'fields' => array(

					array(

						'name' => esc_html__( 'Track name', 'aqura' ),

						'id'   => 'aqura_album_options__track-name',

						'type' => 'text',

					),

					array(

						'name' => esc_html__( 'Track author', 'aqura' ),

						'id'   => 'aqura_album_options__track-author',

						'type' => 'text',

					),

					array(

						'name' 				=> esc_html__( 'Song Thumbnail', 'aqura' ),

						'id'   				=> 'aqura_album_options__track-thumbnail',

						'type' 				=> 'file_advanced',

						'desc' 				=> esc_html__('30px X 30px.', 'aqura' ),

						'max_file_uploads' 	=> 1,

					),

					array(

						'name' 				=> esc_html__( 'Song Upload', 'aqura' ),

						'id'   				=> 'aqura_album_options__track-url',

						'type' 				=> 'file_advanced',

						'mime_type' 		=> 'application,audio,video', // Leave blank for all file types

						'desc' 				=> esc_html__('The file you wish to upload (.mp3 format preferably).', 'aqura' ),

						'max_file_uploads' 	=> 1,

					),

					array(

						'name'  => esc_html__( 'Song External URL / Radio Stream URL', 'aqura' ),

						'id'	=> 'aqura_album_options__track-external-url',

						'desc'  => __( 'If you write some URL into this box, it will <strong>override</strong> the above upload form. So if you have an uploaded song and an url here, the URL will be used. Also here you can add the soundcloud url to play tracks from SoundCloud.', 'aqura' ),

						'type'  => 'text',

					),

					array(

						'name' 		=> esc_html__( 'Track Duration', 'aqura' ),

						'id'   		=> 'aqura_album_options__track-duration',

						'type' 		=> 'text',

						'desc'  	=> esc_html__( 'If you use an External URL for this track, the duration won\'t show in players if you don\'t add it here.', 'aqura' ),

						'hidden'	=> array( 'track-external-url', '=', '' )

					),

				),

			),

		),

	);



	$meta_boxes[] = array(

		'id'		=> 'aqura_album_options_02_02',

		'title'  	=> esc_html__('Options For Style 02', 'aqura'),

		'pages'  	=> array('albums'),

		'priority'  => 'high',

		'tabs'	  	=> array(

			'aqura_album_options_02__title__tab' 	=> esc_html__( 'Page Title', 'aqura' ),

			'aqura_album_options_02__about__tab' 	=> esc_html__( 'About The Album', 'aqura' ),

			'aqura_album_options_02__lyrics__tab' 	=> esc_html__( 'Lyrics', 'aqura' ),

		),

		'tab_style' => 'left',

		'fields'	=> array(

			array(

				'name'		  		=> esc_html__( 'Page Title', 'aqura' ),

				'id'				=> 'aqura_album_options_02__title',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options_02__title__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Page Subtitle', 'aqura' ),

				'id'				=> 'aqura_album_options_02__subtitle',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options_02__title__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Page Title Background Text', 'aqura' ),

				'id'				=> 'aqura_album_options_02__title_bg',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options_02__title__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Youtube Embed', 'aqura' ),

				'id'				=> 'aqura_album_options_02__video_link_youtube',

				'type'		  		=> 'textarea',

				'tab'  				=> 'aqura_album_options_02__about__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Vimeo Embed', 'aqura' ),

				'id'				=> 'aqura_album_options_02__video_link_vimeo',

				'type'		  		=> 'textarea',

				'tab'  				=> 'aqura_album_options_02__about__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Description', 'aqura' ),

				'id'				=> 'aqura_album_options_02__description',

				'type'		  		=> 'textarea',

				'tab'  				=> 'aqura_album_options_02__about__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Album Downlod Link', 'aqura' ),

				'id'				=> 'aqura_album_options_02__song_download',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_album_options_02__about__tab',

			),

			array(

				'id'	 			=> 'aqura_album_options_02__lyrics',

				'type'   			=> 'group',

				'clone'  			=> true,

				'sort_clone' 		=> true,

				'tab'  				=> 'aqura_album_options_02__lyrics__tab',

				'fields' => array(

					array(

						'name' => esc_html__( 'Song Name', 'aqura' ),

						'id'   => 'aqura_album_options_02__lyrics__name',

						'type' => 'text',

					),

					array(

						'name' => esc_html__( 'Lyrics', 'aqura' ),

						'id'   => 'aqura_album_options_02__lyrics__text',

						'type' => 'wysiwyg',

					),

				),

			),

		),

	);



	$meta_boxes[] = array(

		'id'			=> 'aqura_gallery_options',

		'title' 		=> esc_html__('Gallery Options', 'aqura'),

		'pages'  		=> array('gallery'),

		'priority'  	=> 'high',

		'fields'	 	=> array(

			array(

				'name'		  		=> esc_html__( 'Gallery Title', 'aqura' ),

				'id'				=> 'aqura_gallery_options__title',

				'type'		  		=> 'text',

				'desc'		  		=> esc_html__( 'Use this field just if you want to overwrite the main title.' , 'aqura' ),

			),

			array(

				'name'		  		=> esc_html__( 'Gallery Date', 'aqura' ),

				'id'				=> 'aqura_gallery_options__date',

				'type'		  		=> 'text',

				'desc'		  		=> esc_html__( 'Use this field just if you want to overwrite the publishing date of this gallery.' , 'aqura' ),

			),

			array(

				'name'		  		=> esc_html__( 'Gallery View More Text', 'aqura' ),

				'id'				=> 'aqura_gallery_options__view_more_text',

				'type'		  		=> 'text',

				'desc'		  		=> esc_html__( 'If this field is empty the view more text will be "View More".' , 'aqura' ),

			),

			array(

				'name'		  		=> esc_html__( 'Gallery Photos', 'aqura' ),

				'id'				=> 'aqura_gallery_options__photos',

				'type'		  		=> 'image_advanced',

			),

			array(

				'name'		  		=> esc_html__( 'Gallery Thumbnail', 'aqura' ),

				'id'				=> 'aqura_gallery_options__thumbnail',

				'type'		  		=> 'image_advanced',

				'max_file_uploads' 	=> 1,

				'desc'		  		=> esc_html__( 'This thumbnail will be displayed only on gallery listing.' , 'aqura' ),

			),

		),

	);



	$meta_boxes[] = array(

		'id'		=> 'aqura_events_options',

		'title'  	=> esc_html__('Event Options', 'aqura'),

		'pages'  	=> array('events'),

		'priority'  => 'high',

		'tabs'	  	=> array(

			'aqura_events_options__header_image__tab' 	=> esc_html__( 'Header Image', 'aqura' ),

			'aqura_events_options__title__tab' 			=> esc_html__( 'Page Title', 'aqura' ),

			'aqura_events_options__event_details__tab' 	=> esc_html__( 'Event Details', 'aqura' ),

		),

		'tab_style' => 'left',

		'fields'	=> array(

			array(

				'name'		  		=> esc_html__( 'Header Image Title', 'aqura' ),

				'id'				=> 'aqura_events_options__header_image__title',

				'type'		  		=> 'text',

				'desc'				=> esc_html__( 'If this field is empty the title will be the album\'s title.', 'aqura' ),

				'tab'  				=> 'aqura_events_options__header_image__tab',

			),

			array(

				'name'				=> esc_html__( 'Header Image Description', 'aqura' ),

				'id'				=> 'aqura_events_options__header_image__description',

				'type'				=> 'textarea',

				'tab'  				=> 'aqura_events_options__header_image__tab',

			),

			array(

				'name'				=> esc_html__( 'Header Image View More Text', 'aqura' ),

				'id'				=> 'aqura_events_options__header_image__view_more',

				'type'				=> 'text',

				'desc'				=> esc_html__( 'If this field is empty the view more text will be "View More".', 'aqura' ),

				'tab'  				=> 'aqura_events_options__header_image__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Page Title', 'aqura' ),

				'id'				=> 'aqura_events_options__page_title__title',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_events_options__title__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Page Subtitle', 'aqura' ),

				'id'				=> 'aqura_events_options__page_title__subtitle',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_events_options__title__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Page Title Background Text', 'aqura' ),

				'id'				=> 'aqura_events_options__page_title__title_bg',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_events_options__title__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Event Cover', 'aqura' ),

				'id'				=> 'aqura_events_options__event_cover',

				'type'		  		=> 'image_advanced',

				'max_file_uploads' 	=> 1,

				'tab'  				=> 'aqura_events_options__event_details__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Event Title', 'aqura' ),

				'id'				=> 'aqura_events_options__title',

				'type'		  		=> 'text',

				'desc'				=> esc_html__( 'If this field is empty the event\'s title will be the main title.', 'aqura' ),

				'tab'  				=> 'aqura_events_options__event_details__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Event Date', 'aqura' ),

				'id'				=> 'aqura_events_options__date',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_events_options__event_details__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Event Location', 'aqura' ),

				'id'				=> 'aqura_events_options__location',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_events_options__event_details__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Event Type', 'aqura' ),

				'id'				=> 'aqura_events_options__type',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_events_options__event_details__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Event Organizator', 'aqura' ),

				'id'				=> 'aqura_events_options__organizator',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_events_options__event_details__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Tickets URL', 'aqura' ),

				'id'				=> 'aqura_events_options__tickets_url',

				'type'		  		=> 'text',

				'tab'  				=> 'aqura_events_options__event_details__tab',

			),

			array(

				'name'		  		=> esc_html__( 'Event Description', 'aqura' ),

				'id'				=> 'aqura_events_options__description',

				'type'		  		=> 'textarea',

				'tab'  				=> 'aqura_events_options__event_details__tab',

			),

		),

	);



	return $meta_boxes;



}