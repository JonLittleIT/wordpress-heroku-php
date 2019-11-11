<?php

/**

 * Custom template tags for this theme

 *

 * Eventually, some of the functionality here could be replaced by core features.

 *

 * @package Aqura

 */



if ( ! function_exists( 'aqura_posted_on' ) ) :

	/**

	 * Prints HTML with meta information for the current post-date/time.

	 */

	function aqura_posted_on() { ?>

		<time class="entry-date published updated" datetime="<?php echo esc_attr( get_the_date( 'c' ) ) ?>">
			<?php echo esc_html( get_the_date() ); ?>
		</time>

	<?php }

endif;



if ( ! function_exists( 'aqura_posted_by' ) ) :

	/**

	 * Prints HTML with meta information for the current author.

	 */

	function aqura_posted_by() {



		echo '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html__( 'By ' , 'aqura' ) . esc_html( get_the_author() ) . '</a>'; // WPCS: XSS OK.



	}

endif;



if ( ! function_exists( 'aqura_get_posted_by' ) ) :

	/**

	 * Prints HTML with meta information for the current author.

	 */

	function aqura_get_posted_by() {



		return '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html__( 'By ' , 'aqura' ) . esc_html( get_the_author() ) . '</a>'; // WPCS: XSS OK.



	}

endif;



if ( ! function_exists( 'aqura_get_the_archive_title' ) ) {

	// Archive Title

	function aqura_get_the_archive_title() {

		if ( is_category() ) {

			/* translators: Category archive title. 1: Category name */

			$title = sprintf( esc_html__( 'Category: %s' , 'aqura' ), single_cat_title( '', false ) );

		} elseif ( is_tag() ) {

			/* translators: Tag archive title. 1: Tag name */

			$title = sprintf( esc_html__( 'Tag: %s' , 'aqura' ), single_tag_title( '', false ) );

		} elseif ( is_author() ) {

			/* translators: Author archive title. 1: Author name */

			$title = get_the_author();

		} elseif ( is_year() ) {

			/* translators: Yearly archive title. 1: Year */

			$title = sprintf( esc_html__( 'Year: %s' , 'aqura' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format' , 'aqura' ) ) );

		} elseif ( is_month() ) {

			/* translators: Monthly archive title. 1: Month name and year */

			$title = sprintf( esc_html__( 'Month: %s' , 'aqura' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format' , 'aqura' ) ) );

		} elseif ( is_day() ) {

			/* translators: Daily archive title. 1: Date */

			$title = sprintf( esc_html__( 'Day: %s' , 'aqura' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format' , 'aqura' ) ) );

		} elseif ( is_tax( 'post_format' ) ) {

			if ( is_tax( 'post_format', 'post-format-aside' ) ) {

				$title = esc_html_x( 'Asides', 'post format archive title' , 'aqura' );

			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {

				$title = esc_html_x( 'Galleries', 'post format archive title' , 'aqura' );

			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {

				$title = esc_html_x( 'Images', 'post format archive title' , 'aqura' );

			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {

				$title = esc_html_x( 'Videos', 'post format archive title' , 'aqura' );

			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {

				$title = esc_html_x( 'Quotes', 'post format archive title' , 'aqura' );

			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {

				$title = esc_html_x( 'Links', 'post format archive title' , 'aqura' );

			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {

				$title = esc_html_x( 'Statuses', 'post format archive title' , 'aqura' );

			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {

				$title = esc_html_x( 'Audio', 'post format archive title' , 'aqura' );

			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {

				$title = esc_html_x( 'Chats', 'post format archive title' , 'aqura' );

			}

		} elseif ( is_post_type_archive() ) {

			/* translators: Post type archive title. 1: Post type name */

			$title = sprintf( esc_html__( 'Archives: %s' , 'aqura' ), post_type_archive_title( '', false ) );

		} elseif ( is_tax() ) {

			$tax = get_taxonomy( get_queried_object()->taxonomy );

			/* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */

			$title = sprintf( esc_html__( '%1$s: %2$s' , 'aqura' ), $tax->labels->singular_name, single_term_title( '', false ) );

		} else {

			$title = esc_html__( 'Archives' , 'aqura' );

		}

		/**

		 * Filters the archive title.

		 *

		 * @since 4.1.0

		 *

		 * @param string $title Archive title to be displayed.

		 */

		return apply_filters( 'get_the_archive_title', $title );

	}

}



if ( ! function_exists( 'aqura_header_image' ) ) :

	// Header Image

	function aqura_header_image($title, $text, $view_text, $bg) {



		global $aqura_data;



		$aqura_header_image__on_off = array_key_exists('aqura_header__header_image__on_off', $aqura_data) ? $aqura_data['aqura_header__header_image__on_off'] : '';



		if ( $bg != '' ) {

			$aqura_header_image__image = $bg;

		} else {

			if ( array_key_exists('aqura_header__header_image__image', $aqura_data) && ($aqura_data['aqura_header__header_image__image'] != null) ) {

				$aqura_header_image__image = $aqura_data['aqura_header__header_image__image']['url'];

			}

		}



		if ( $title != '' ) {

			$aqura_header_image__title = $title;

		} else {

			$aqura_header_image__title = $aqura_data['aqura_header__header_image__title'];

		}



		if ( $text != '' ) {

			$aqura_header_image__text = $text;

		} else {

			$aqura_header_image__text = array_key_exists('aqura_header__header_image__text', $aqura_data) ? $aqura_data['aqura_header__header_image__text'] : '';

		}



		if ( $view_text != '' ) {

			$aqura_header_image__view_more_text = $view_text;

		} else {

			$aqura_header_image__view_more_text = array_key_exists('aqura_header__header_image__view_more_text', $aqura_data) ? $aqura_data['aqura_header__header_image__view_more_text'] : '';

		}



		if ( ( $aqura_header_image__on_off != false ) && ( $aqura_header_image__image != '' ) ) { ?>

		<section class="no-mb">

			<div class="before-FullscreenSlider"></div>

			<div class="breadcrumb-fullscreen-parent phone-menu-bg affix-top">

				<div class="breadcrumb breadcrumb-fullscreen alignleft small-description overlay almost-black-overlay" style="background-image: url(<?php echo esc_url($aqura_header_image__image); ?>);" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">

					<div class="hero-content-type-1 fade-element">

						<h1><?php echo esc_html( $aqura_header_image__title ); ?></h1>

						<p><?php echo esc_html( $aqura_header_image__text ); ?></p>

						<a href="#view-more-scroll" data-easing="easeInOutQuint" data-scroll="" data-speed="900" data-url="false" class="view-more-type-1"><?php echo esc_html( $aqura_header_image__view_more_text ); ?><i class="fa fa-angle-down"></i></a>

					</div><!-- end hero-content-type-1 -->	

				</div><!-- end breadcrumb -->

			</div><!-- end breadcrumb-fullscreen-parent -->

		</section>

		<div id="view-more-scroll"></div>

		<?php }

	}

endif;



if ( ! function_exists( 'aqura_clear_header_image' ) ) :

	// Header Image

	function aqura_clear_header_image($title, $bg) {



		global $aqura_data;



		if ( $bg != '' ) {

			$aqura_header_image__image = $bg;

		} else {

			if ( $aqura_data['aqura_header__header_image__image'] != null ) {

				$aqura_header_image__image = $aqura_data['aqura_header__header_image__image']['url'];

			}

		}



		if ( $title != '' ) {

			$aqura_header_image__title = $title;

		} else {

			$aqura_header_image__title = $aqura_data['aqura_header__header_image__title'];

		}



		if ( $aqura_header_image__image != '' ) { ?>

		<!-- ========== START HERO-SECTION-HOME ========== -->

		<section class="no-mb">

			<div class="before-FullscreenSlider"></div>

			<div class="breadcrumb-fullscreen-parent phone-menu-bg affix-top">

				<div class="breadcrumb breadcrumb-fullscreen breadcrumb-fullscreen--full-w alignleft small-description overlay almost-black-overlay" style="background-image: url(<?php echo esc_url($aqura_header_image__image); ?>);" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">

					<div class="hero-title-3 fade-element">

						<h1><?php echo esc_html( $aqura_header_image__title ); ?></h1>

					</div><!-- end hero-title 3 -->

				</div><!-- end breadcrumb -->

			</div><!-- end breadcrumb-fullscreen-parent -->

		</section>

		<!-- ========== END HERO-SECTION ========== -->

		<?php }

	}

endif;



if( !function_exists('aqura_comment') ) :

	// Comments Template

	function aqura_comment($comment, $aqura_args, $depth) {



		$GLOBALS['comment'] = $comment;



		extract($aqura_args, EXTR_SKIP);



		if ( 'div' == $aqura_args['style'] ) {

			$tag = 'div';

			$add_below = 'comment';

		} else {

			$tag = 'li';

			$add_below = 'div-comment';

		}

		?>



		<<?php echo esc_attr($tag) ?> <?php comment_class( empty( $aqura_args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">



		<?php if ( 'div' != $aqura_args['style'] ) : ?>

			<div id="div-comment-<?php comment_ID() ?>" class="comment">

		<?php endif; ?>



		<article>

			<figure>

				<a>

					<?php if ( $aqura_args['avatar_size'] != 0 ) echo get_avatar( $comment, 44 ); ?>

				</a>

			</figure>

			<header>

				<div class="comment-meta">

					<h6>

						<?php printf( esc_html__( '%s' , 'aqura' ), get_comment_author_link() ); ?>

					</h6>

					<time datetime="<?php echo esc_html(get_comment_date(get_option( 'date_format' ) . ' ' . get_option( 'time_format' ))); ?>">

						<?php 

							echo esc_html(get_comment_date(get_option( 'date_format' )));

							echo esc_html__( ' at ' , 'aqura' );

							echo esc_html(get_comment_date(get_option( 'time_format' )));

						?>

					</time>

				</div><!-- end comment-meta -->

				<div class="comment-content">

					<?php comment_text(); ?>

					<div class="reply">

						<?php comment_reply_link( array_merge( $aqura_args, array( 'add_below' => $add_below , 'reply_text' => '<i class="fa fa-reply" aria-hidden="true"></i>' . esc_html__( ' Reply' , 'aqura' ) . '', 'depth' => $depth, 'max_depth' => $aqura_args['max_depth'] ) ) ); ?>

					</div><!-- end reply -->

				</div>

			</header>

			<?php if ( $comment->comment_approved == '0' ) : ?>

				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'aqura' ); ?></em>

				<br />

			<?php endif; ?>

		</article>

		<?php if ( 'div' != $aqura_args['style'] ) : ?>

			</div>

		<?php endif; ?>

	<?php }



endif;



class aqura_controller {



	protected static $instance = null;

	public $args = null;

	public $postTypes = null;

	public $assets = null;



	private function __construct() {}



	/**

	 * Get an array with all queued scripts

	 *

	 * @return array

	 */

	static function get_queued_scripts() {

		global $wp_scripts;



		$loading_scripts = array();

		foreach ( $wp_scripts->queue as $key => $handle ) {



			// ensure a proper script src ( highjacked from wordpress core )

			$src = $wp_scripts->registered[ $handle ]->src;



			if ( !preg_match('|^(https?:)?//|', $src) && ! ( $wp_scripts->content_url && 0 === strpos($src, $wp_scripts->content_url) ) ) {

				$src = $wp_scripts->base_url . $src;

			}



			$loading_scripts[ $handle ] = $src;

		}



		return $loading_scripts;

	}



	/**

	 * Get an array with all queued styles

	 *

	 * @return array

	 */

	static function get_queued_styles() {

		global $wp_styles;



		$loading_styles = array();

		foreach ( $wp_styles->queue as $key => $handle ) {



			// ensure a proper script src ( highjacked from wordpress core )

			$src = $wp_styles->registered[ $handle ]->src;



			if ( !preg_match('|^(https?:)?//|', $src) && ! ( $wp_styles->content_url && 0 === strpos($src, $wp_styles->content_url) ) ) {

				$src = $wp_styles->base_url . $src;

			}



			$loading_styles[ $handle ] = $src;

		}

		return $loading_styles;

	}



	/**

	 * @return aqura_controller|null

	 */

	public static function get_instance() {



		// If the single instance hasn't been set, set it now.

		if ( null == self::$instance ) {

			self::$instance = new self;

		}



		return self::$instance;

	}

}



if( !function_exists('aqura_album_next_prev') ) :



	function aqura_album_next_prev($prev) {



		$post = get_adjacent_post( false, '', $prev, 'category' );



		if ( $prev ) {

			

			$col_class 	= 'left-side';

			$a_class 	= 'prev';



		} else {



			$col_class 	= 'right-side';

			$a_class 	= 'next';



		} ?>



		<div class="col-sm-6 <?php echo esc_attr( $col_class ); ?>" style="background-image: url(<?php if ( $post ) echo esc_url( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ); ?>);">



		<?php if ( $post ) { ?>

		

			<a href="<?php echo get_permalink( $post ); ?>" class="<?php echo esc_attr($a_class); ?>">

				<small>

					<?php if ( $prev ): ?>

						<?php echo esc_html__( 'Prev' , 'aqura' ) ?>

					<?php else: ?>

						<?php echo esc_html__( 'Next' , 'aqura' ) ?>

					<?php endif; ?>

				</small>

				<span>

					<?php echo esc_html( $post->post_title ); ?>

				</span>

			</a>



		<?php } ?>



		</div>



	<?php }



endif;



if( !function_exists('aqura_album_next_prev_02') ) :



	function aqura_album_next_prev_02($prev, $post_type = 'album') {



		$post = get_adjacent_post( false, '', $prev, 'category' );



		if ( $prev ) {

			

			$arrow_class 	= 'left';

			$block_class 	= 'prev';



		} else {



			$arrow_class 	= 'right';

			$block_class 	= 'next';



		} ?>



		<?php if ( $post ) { ?>



			<div class="<?php echo esc_attr($block_class); ?>-album">

				<a href="<?php echo get_permalink( $post ); ?>" class="cover-reveal">

					<div class="inner-img"><img src="<?php if ( $post ) echo esc_url( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ); ?>" alt="<?php echo esc_attr($block_class); ?>-album-img"></div>

					<span href="#" class="line"><span class="arrow-<?php echo esc_attr($arrow_class); ?>"></span></span>

					<span class="name">

					<?php

						if ( $prev ) {

							if ( $post_type == 'album' ) {

								echo esc_html__( 'Previous Album' , 'aqura' );

							} elseif ( $post_type == 'event' ) {

								echo esc_html__( 'Previous Event' , 'aqura' );

							}

						} else {

							if ( $post_type == 'album' ) {

								echo esc_html__( 'Next Album' , 'aqura' );

							} elseif ( $post_type == 'event' ) {

								echo esc_html__( 'Next Event' , 'aqura' );

							}

						}

					?>

					</span>

				</a>

			</div><!-- end prev-album  -->



		<?php } ?>



	<?php }



endif;



if( !function_exists('aqura_get_album_next_prev_02') ) :



	function aqura_get_album_next_prev_02($prev, $post_type = 'album') {



		$output = '';



		$post = get_adjacent_post( false, '', $prev, 'category' );



		if ( $prev ) {

			

			$arrow_class 	= 'left';

			$block_class 	= 'prev';



		} else {



			$arrow_class 	= 'right';

			$block_class 	= 'next';



		} ?>



		<?php if ( $post ) {



			$output .= '<div class="' . esc_attr($block_class) . '-album">

							<a href="' . get_permalink( $post ) . '" class="cover-reveal">

								<div class="inner-img"><img src="';

								if ( $post ) {

								$output .= esc_url( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) );

								}

								$output .= '" alt="' . esc_attr($block_class) . '-album-img"></div>

								<span href="#" class="line"><span class="arrow-' . esc_attr($arrow_class) . '"></span></span>

								<span class="name">';

								if ( $prev ) {

									if ( $post_type == 'album' ) {

										$output .= esc_html__( 'Previous Album' , 'aqura' );

									} elseif ( $post_type == 'event' ) {

										$output .= esc_html__( 'Previous Event' , 'aqura' );

									}

								} else {

									if ( $post_type == 'album' ) {

										$output .= esc_html__( 'Next Album' , 'aqura' );

									} elseif ( $post_type == 'event' ) {

										$output .= esc_html__( 'Next Event' , 'aqura' );

									}

								}

					$output .= '</span>

							</a>

						</div>';



		} ?>



		<?php return $output; ?>



	<?php }



endif;



if( !function_exists('aqura_album_get_video_embed') ) :



	function aqura_album_get_video_embed($embed) {



		if ( strpos($embed, 'youtube.com') !== false ) {



			// Extract video url from embed code

			return preg_replace_callback('/<iframe\s+.*?\s+src=(".*?").*?<\/iframe>/', function ($matches) {

				// Remove quotes

				$youtubeUrl = $matches[1];

				$youtubeUrl = trim($youtubeUrl, '"');

				$youtubeUrl = trim($youtubeUrl, "'");

				// Extract id

				preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $youtubeUrl, $videoId);

				return $youtubeVideoId = isset($videoId[1]) ? $videoId[1] : "";

			}, $embed);



		} else if ( strpos($embed, 'vimeo.com') !== false ) {



			preg_match('/src="([^"]+)"/', $embed, $matches);

		    $url = $matches[1];

		    $parsedUrl = parse_url($url);

		    return substr(parse_url($url, PHP_URL_PATH), 1);;



		}



	}



endif;



if(!class_exists('RWMB_Helper')) {



	if(!function_exists('rwmb_meta')) {



	    function rwmb_meta( $key, $aqura_args = array(), $post_id = null )

	    {

	        $post_id = empty( $post_id ) ? get_the_ID() : $post_id;

	        $aqura_args    = wp_parse_args( $aqura_args, array(

	            'type'     => 'text',

	            'multiple' => false,

	        ) );



	        // Always set 'multiple' true for following field types

	        if ( in_array( $aqura_args['type'], array( 'checkbox_list', 'file', 'file_advanced', 'image', 'image_advanced', 'plupload_image', 'thickbox_image' ) ) )

	        {

	            $aqura_args['multiple'] = true;

	        }



	        $meta = get_post_meta( $post_id, $key, ! $aqura_args['multiple'] );



	        // Get uploaded files info

	        if ( in_array( $aqura_args['type'], array( 'file', 'file_advanced' ) ) )

	        {

	            if ( is_array( $meta ) && ! empty( $meta ) )

	            {

	                $files = array();

	                foreach ( $meta as $id )

	                {

	                    // Get only info of existing attachments

	                    if ( get_attached_file( $id ) )

	                    {

	                        $files[$id] = RWMB_File_Field::file_info( $id );

	                    }

	                }

	                $meta = $files;

	            }

	        }

	        // Get uploaded images info

	        elseif ( in_array( $aqura_args['type'], array( 'image', 'plupload_image', 'thickbox_image', 'image_advanced' ) ) )

	        {

	            if ( is_array( $meta ) && ! empty( $meta ) )

	            {

	                $images = array();

	                foreach ( $meta as $id )

	                {

	                    // Get only info of existing attachments

	                    if ( get_attached_file( $id ) )

	                    {

	                        $images[$id] = RWMB_Image_Field::file_info( $id, $aqura_args );

	                    }

	                }

	                $meta = $images;

	            }

	        }

	        // Get terms

	        elseif ( 'taxonomy_advanced' == $aqura_args['type'] )

	        {

	            if ( ! empty( $aqura_args['taxonomy'] ) )

	            {

	                $term_ids = array_map( 'intval', array_filter( explode( ',', $meta . ',' ) ) );

	                // Allow to pass more arguments to "get_terms"

	                $func_args = wp_parse_args( array(

	                    'include'    => $term_ids,

	                    'hide_empty' => false,

	                ), $aqura_args );

	                unset( $func_args['type'], $func_args['taxonomy'], $func_args['multiple'] );

	                $meta = get_terms( $aqura_args['taxonomy'], $func_args );

	            }

	            else

	            {

	                $meta = array();

	            }

	        }

	        // Get post terms

	        elseif ( 'taxonomy' == $aqura_args['type'] )

	        {

	            $meta = empty( $aqura_args['taxonomy'] ) ? array() : wp_get_post_terms( $post_id, $aqura_args['taxonomy'] );

	        }

	        // Get map

	        elseif ( 'map' == $aqura_args['type'] )

	        {

	            $field = array(

	                'id'       => $key,

	                'multiple' => false,

	                'clone'    => false,

	            );

	            $meta  = RWMB_Map_Field::the_value( $field, $aqura_args, $post_id );

	        }

	        // Display oembed content

	        elseif ( 'oembed' == $aqura_args['type'] )

	        {

	            $field = array(

	                'id'       => $key,

	                'clone'    => isset( $aqura_args['clone'] ) ? $aqura_args['clone'] : false,

	                'multiple' => isset( $aqura_args['multiple'] ) ? $aqura_args['multiple'] : false,

	            );

	            $meta  = RWMB_OEmbed_Field::the_value( $field, $aqura_args, $post_id );

	        }

	        return apply_filters( 'rwmb_meta', $meta, $key, $aqura_args, $post_id );

	    }



	}



}



if ( ! function_exists( 'MailChimp_setup' ) ) :



	class MailChimp_setup {



		protected static $instance = null;



		/**

		 * The Mailchimp API key.

		 *

		 * @since   1.0.0

		 * @var	 string

		 */

		private $mailchimp_apikey;



		/**

		 * The Mailchimp list ID.

		 *

		 * @since   1.0.0

		 * @var	 string

		 */

		private $mailchimp_list_id;



		private function __construct() {



			add_action( 'theme_before_subscribe', array( &$this, 'wait_for_subscribe' ) );



			$this->include_other_classes();



			global $aqura_data;



			if ( isset($aqura_data['mailchimp-list-id']) ) {

				// Init the mailchimp API and list ID.

				if( '' != $aqura_data['mailchimp-list-id'] ) {

					$this->mailchimp_list_id = $aqura_data['mailchimp-list-id'];

				}

			}



			if ( isset($aqura_data['mailchimp-api']) ) {

				if( '' != $aqura_data['mailchimp-api'] ) {

					$this->mailchimp_apikey = $aqura_data['mailchimp-api'];

				}

			}



		}



		/**

		 * Include other classes files, required for the theme

		 *

		 * @since   1.0.0

		 */

		private function include_other_classes() {



			



		}



		public function wait_for_subscribe($ID) {



			if(isset($_REQUEST['_theme-subscribe']) && wp_verify_nonce( $_REQUEST['_theme-subscribe'], 'subscribe-user_'.$ID )) {



				$email = sanitize_email($_REQUEST['mailchimp-email']);



				global $aqura_data;



				if( $email ) {



					if(($this->subscribe_to_mailchimp($email)) && ($aqura_data['subscribe_thankyou_page' ] != '')) {



						header( 'Location: ' . get_permalink( intval($aqura_data['subscribe_thankyou_page' ]) ));



					}



				}



			}



		}



		/**

		 * Subscribe the given email address to our Mailchimp List.

		 *

		 * @since 1.0.0

		 * @param $email_address

		 * @return array

		 */

		private function subscribe_to_mailchimp($email_address, $name = '') {



			$MailChimp = new MailChimp($this->mailchimp_apikey);



			global $aqura_data;



			$result = $MailChimp->call('lists/subscribe', array(

				'id'				=> $this->mailchimp_list_id,

				'email'			 	=> array('email' => $email_address),

				'merge_vars'		=> $name != '' ? array('FNAME'=> $name) : array(),

				'double_optin'		=> $aqura_data['mailchimp-email-verification'],

				'update_existing'   => true,

				'replace_interests' => false,

				'send_welcome'		=> $aqura_data['mailchimp-email-send-welcome'],

			));



			return $result;



		}



		/**

		 * @return MailChimp_setup|null

		 */

		public static function get_instance() {



			// If the single instance hasn't been set, set it now.

			if ( null == self::$instance ) {

				self::$instance = new self;

			}



			return self::$instance;

		}



	}



endif;



MailChimp_setup::get_instance();