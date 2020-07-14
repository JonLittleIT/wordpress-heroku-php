<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_WIDGET_BOX6 extends WP_Widget {
	public $com_meta;
	public $review;
	public $author_meta;
	public $date_meta;
	public $thumbnail;

	function __construct() {
		add_action( 'load-widgets.php', array( &$this, 'custom_load' ) );
		parent::__construct (
			'bdaia-widget-box6', '.: Bdaia - Box6',
			array( 'classname' => 'bdaia-box6', 'description' => '' )
		);
	}

	public function custom_load() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}

	public function widget_query( $sort_order, $num_posts, $tag_slug, $cat_uid, $cat_uids, $paged, $posts )
	{
		if ( !empty( $num_posts ) ) $bdaia_qa[ 'posts_per_page' ] = $num_posts;
		$bdaia_qa[ 'post_status' ]              = 'publish';
		$bdaia_qa[ 'ignore_sticky_posts' ]      = true;

		if ( !empty( $paged ) ) {
			$bdaia_qa['paged'] = $paged;
		}
		else {
			$bdaia_qa['paged'] = 1;
		}

		if ( !empty( $cat_uid ) and empty( $cat_uids ) ) $cat_uids = $cat_uid;
		if ( !empty( $cat_uids ) ) $bdaia_qa['cat'] = $cat_uids;
		if ( !empty( $tag_slug ) ) $bdaia_qa['tag'] = str_replace(' ', '-', $tag_slug);
		if ( !empty( $posts ) ) $bdaia_qa['post__in'] = explode (',' , $posts );

		switch ( $sort_order )
		{
			case 'popular':
				$bdaia_qa['meta_key']      = 'bdaia_views';
				$bdaia_qa['orderby']       = 'meta_value_num';
				$bdaia_qa['order']         = 'DESC';
				break;

			case 'review_high':
				$bdaia_qa['meta_key']      = 'bdaia_taqyeem_final_score';
				$bdaia_qa['orderby']       = 'meta_value';
				$bdaia_qa['order']         = 'DESC';
				$bdaia_qa['meta_value']    = 0;
				$bdaia_qa['meta_compare']  = '!=';
				break;

			case 'random_posts':
				$bdaia_qa['orderby']       = 'rand';
				break;

			case 'alphabetical_order':
				$bdaia_qa['orderby']       = 'title';
				$bdaia_qa['order']         = 'ASC';
				break;

			case 'comment_count':
				$bdaia_qa['orderby']       = 'comment_count';
				$bdaia_qa['order']         = 'DESC';
				break;

			case 'random_today':
				$bdaia_qa['orderby']       = 'rand';
				$bdaia_qa['year']          = date('Y');
				$bdaia_qa['monthnum']      = date('n');
				$bdaia_qa['day']           = date('j');
				break;

			case 'random_7_day':
				$bdaia_qa['orderby']       = 'rand';
				$bdaia_qa['date_query']    = array(
					'column' => 'post_date_gmt',
					'after' => '1 week ago'
				);
				break;
		}

		$GLOBALS['bdaia_wbc_1'] = 1;
		$GLOBALS['bdaia_wbc_2'] = 0;

		$bdaia_widget_query = new WP_Query( $bdaia_qa );
		return( $bdaia_widget_query );
	}

	public function widget( $args, $instance )
	{
		extract( $args );
		$bdaia_att  = $review = $author_meta = $date_meta = $ajax_pagination_class = "";
		$paged      = 1;
		$bdaia_rand = woohoo_rand(5);

		$title                  = $instance['title'];
		$box_color              = $instance['box_color'];
		$num_posts              = $instance['num_posts'];
		$cat_uid                = $instance['cat_uid'];
		$cat_uids               = $instance['cat_uids'];
		$tag_slug               = $instance['tag_slug'];
		$posts                  = $instance['posts'];
		$sort_order             = $instance['sort_order'];
		$this->review           = $instance['review'];
		$this->com_meta         = $instance['com_meta'];
		$this->author_meta      = $instance['author_meta'];
		$this->date_meta        = $instance['date_meta'];
		$this->thumbnail        = $instance['thumbnail'];
		$ajax_pagination        = $instance['ajax_pagination'];

		$g_category         = get_category_by_slug( $cat_uid );
		$get_term_id = $get_terms_ids = '';
		if( !empty( $g_category ) ) {
			$get_term_id    = $g_category->term_id;
		}
		if( !empty( $cat_uids ) ) {
			$catslugs       = explode( ',', $cat_uids );
			$get_term_ids   = woohoo_get_cats_by_slug( $catslugs );
			$get_terms_ids  = implode( ',', $get_term_ids );
		}

		if( $ajax_pagination == 'load_more' ) $ajax_pagination_class = 'load_more';
		elseif( $ajax_pagination == 'next_prev' ) $ajax_pagination_class = 'next_prev';

		$bdaia_wcq      = $this->widget_query( $sort_order, $num_posts, $tag_slug, $get_term_id, $get_terms_ids, $paged, $posts );
		$max_num_pages  = $bdaia_wcq->max_num_pages;
		$found_posts    = $bdaia_wcq->found_posts;

		$data_attr = array(
			'box_nu'            => 'wb6',
			'box_id'            => 'bdaia-wb-id'.$bdaia_rand,
			'paged'             => $paged,
			'sort_order'        => $sort_order ,
			'ajax_pagination'   => $ajax_pagination,
			'num_posts'         => $num_posts ,
			'tag_slug'          => $tag_slug,
			'cat_uid'           => $get_term_id,
			'cat_uids'          => $get_terms_ids,
			'max_nu'            => $max_num_pages,
			'total_posts_num'   => $found_posts,
			'posts'             => $posts,
			'com_meta'          => $this->com_meta,
			'thumbnail'         => $this->thumbnail,
			'author_meta'       => $this->author_meta,
			'date_meta'         => $this->date_meta,
			'review'            => $this->review
		);

		foreach( $data_attr as $k => $v ) {
			if( $v != '' ) $bdaia_att .= 'data-'.$k.'="'.$v.'" ';
			else $bdaia_att .= 'data-'.$k.'="" ';
		}

		echo '<div id="'.$args['widget_id'].'" class="widget bdaia-widget bdaia-box6">';
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span>'. $title .'</span></h4>';
		}
		echo'<div class="widget-inner">'; ?>

		<div class="bdaia-wb-wrap bdaia-wb6 bdaia-wb-id<?php echo $bdaia_rand; ?> bdaia-ajax-pagination-<?php echo $ajax_pagination_class; ?>" <?php echo $bdaia_att;?>>

			<div class="bdaia-wb-content">
				<div class="bdaia-wb-inner">
					<?php
					if ( $bdaia_wcq->have_posts() ) :
						while ( $bdaia_wcq->have_posts() ) : $bdaia_wcq->the_post();
							echo $this->widget_loop( $this->thumbnail, $this->review, $this->author_meta, $this->date_meta, $this->com_meta );
						endwhile;
						wp_reset_query();
					endif;
					?>
				</div>
				<div class="bdayh-posts-load-wait">
					<div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>
				</div>
			</div>

			<?php if( $ajax_pagination == 'load_more' || $ajax_pagination == 'next_prev' ) { ?>
				<div class="cfix"></div>
				<script type="text/javascript">
					jQuery(document).ready(function() {
						<?php if( $ajax_pagination == 'load_more' ){ ?>
						<?php if($max_num_pages == 1){ ?>
						jQuery('.bdaia-wb-id<?php echo $bdaia_rand;?> #bdaia-more-<?php echo $bdaia_rand ?>').hide();
						<?php } ?>
						jQuery('#bdaia-more-<?php echo $bdaia_rand ?> .bdaia-wb-mb-inner').click(function(event){ event.preventDefault();
							woohoo_wb_ajax_js( '<?php echo $bdaia_rand; ?>', '' );
						});
						<?php } ?>
						<?php if( $ajax_pagination == 'next_prev' ){ ?>
						jQuery('.bdaia-wb-id<?php echo $bdaia_rand;?> .carousel-nav .mo-next').click(function(event){ event.preventDefault();
							woohoo_wb_ajax_js( '<?php echo $bdaia_rand; ?>', 'next' );
						});
						jQuery('.bdaia-wb-id<?php echo $bdaia_rand;?> .carousel-nav .mo-prev').click(function(event){ event.preventDefault();
							woohoo_wb_ajax_js( '<?php echo $bdaia_rand; ?>', 'prev' );
						});
						<?php } ?>
					});
				</script>
			<?php if( $ajax_pagination == 'load_more' ){ ?>
				<div class="bdaia-wb-more-btn" id="bdaia-more-<?php echo $bdaia_rand ?>">
					<div class="bdaia-wb-mb-inner">
						<?php woohoo_tr( 'Load more' ); ?><span class="bdaia-io bdaia-io-angle-down"></span>
					</div>
				</div>
			<?php } ?>
			<?php if( $ajax_pagination == 'next_prev' ){ ?>
				<div class="carousel-nav">
					<a href="#" class="mo-prev ajax-page-disabled"><span class="bdaia-io bdaia-io-angle-left"></span></a>
					<a href="#" class="mo-next"><span class="bdaia-io bdaia-io-angle-right"></span></a>
				</div>
			<?php } ?>
			<?php } ?>
		</div>

		<?php
		if( ! empty( $box_color ) ) echo '<style type="text/css">#'.$args['widget_id'].' .entry-title a:hover{color:'. $box_color .' !important;}#'.$args['widget_id'].' .sk-circle .sk-child:before{background:'. $box_color .' !important;}#'.$args['widget_id'].' .bdaia-wb-mb-inner{background:'. $box_color .' !important;}#'.$args['widget_id'].' h4.block-title:before{background:'. $box_color .' !important;}#'.$args['widget_id'].' h4.block-title span, #'.$args['widget_id'].' h4.block-title a{color:'. $box_color .' !important;}</style>';
		echo '</div></div>';
	}

	public function widget_loop( $thumbnail, $review, $author_meta, $date_meta, $com_meta )
	{
		$the_id = get_the_ID();
		$size   = $GLOBALS['bdaia-widget'];

		if( has_post_thumbnail ( get_the_ID() ) && ! $thumbnail ) $thum_class = "with-thumb";
		else $thum_class = "no-thumb";

		$post_reviews = get_post_meta( $the_id, 'bdaia_taqyeem', true ); ?>

		<?php if ( $GLOBALS['bdaia_wbc_2'] == 0 ) { $size   = $GLOBALS['bdaia-widget']; ?>

			<div class="bdaia-wb-article bdaia-wba-bigsh bdaiaFadeIn">
				<article class="<?php echo $thum_class; ?>">
					<div class="bwb-article-img-container">
						<?php if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail() ) { ?>
							<?php
							## Icon video play ---------------------------------(^.^)
							echo woohoo_icon_video_play(); ?>

							<a href="<?php the_permalink(); ?>" class="bdaia-text-gradient">
								<?php the_post_thumbnail( $size ); ?>
							</a>
						<?php } ?>

						<div class="bwb-article-content-wrapper">
							<header>
								<h3 class="entry-title"><a href="<?php esc_url( the_permalink() ); ?>"><span><?php esc_attr( the_title() ); ?></span></a></h3>
							</header>

							<footer>
								<?php if ( $post_reviews && $review ) { ?>
									<div class="bdaia-post-rating">
										<?php echo woohoo_final_score(); ?>
									</div>
								<?php } else { ?>

									<?php if( $author_meta ) { ?>
										<div class="bdaia-post-author-name">
											<?php the_author_posts_link(); ?>
										</div>
									<?php } ?>

									<?php if( $date_meta ) { ?>
										<div class="bdaia-post-date"><?php woohoo_get_time(); ?></div>
									<?php } ?>

									<?php if( $com_meta ){ ?>
										<div class="bdaia-post-comment"><span class='bdaia-io bdaia-io-bubble'></span><?php comments_popup_link( '0', '1', '%' ); ?></div>
									<?php } ?>

								<?php } ?>
							</footer>
						</div>

					</div>

				</article>
			</div>

		<?php } else { $size   = $GLOBALS['bdaia-small']; ?>

			<div class="bdaia-wb-article bdaia-wba-small bdaiaFadeIn">
				<article class="<?php echo $thum_class; ?>">

					<?php if( ! $thumbnail ) { ?>
						<div class="bwb-article-img-container">
							<?php if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( $size ); ?>
								</a>
							<?php } ?>
						</div>
					<?php } ?>

					<div class="bwb-article-content-wrapper">
						<header>
							<h3 class="entry-title"><a href="<?php esc_url( the_permalink() ); ?>"><span><?php esc_attr( the_title() ); ?></span></a></h3>
						</header>

						<footer>
							<?php if ( $post_reviews && $review ) { ?>
								<div class="bdaia-post-rating">
									<?php echo woohoo_final_score(); ?>
								</div>
							<?php } else { ?>

								<?php if( $author_meta ) { ?>
									<div class="bdaia-post-author-name">
										<?php the_author_posts_link(); ?>
									</div>
								<?php } ?>

								<?php if( $date_meta ) { ?>
									<div class="bdaia-post-date"><?php woohoo_get_time(); ?></div>
								<?php } ?>

							<?php } ?>

						</footer>
					</div>
				</article>
			</div>

		<?php } ?>

		<?php
		$GLOBALS['bdaia_wbc_2']++;
	}

	public function form( $instance )
	{
		$defaults = array(
			'title'             => '',
			'box_color'         => '',
			'num_posts'         => '',
			'cat_uid'           => '',
			'cat_uids'          => '',
			'tag_slug'          => '',
			'posts'             => '',
			'sort_order'        => '',
			'review'            => true,
			'com_meta'          => false,
			'author_meta'       => true,
			'date_meta'         => true,
			'thumbnail'         => false,
			'ajax_pagination'   => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<script type="text/javascript">
			(function($){
				var parent = $('body');
				if ( $('body' ).hasClass( 'widgets-php' ) ){ parent = $('.widget-liquid-right'); }
				jQuery(document).ready(function($) {
					parent.find('.bdaia-input-color').wpColorPicker();
				});
				jQuery(document).on('widget-added', function(e, widget){
					widget.find('.bdaia-input-color').wpColorPicker();
				});
				jQuery(document).on('widget-updated', function(e, widget){
					widget.find('.bdaia-input-color').wpColorPicker();
				});
			})(jQuery);
		</script>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'box_color' ); ?>">Box Color</label>
			<br class="cfix">
			<input id="<?php echo $this->get_field_id( 'box_color' ); ?>" name="<?php echo $this->get_field_name( 'box_color' ); ?>" value="<?php echo $instance['box_color']; ?>" class="widefat bdaia-input-color" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'num_posts' ); ?>">Limit post number</label>
			<input id="<?php echo $this->get_field_id( 'num_posts' ); ?>" name="<?php echo $this->get_field_name( 'num_posts' ); ?>" value="<?php echo $instance['num_posts']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat_uid' ); ?>">Category Filter</label>
			<br class="cfix">

			<?php $cats = get_categories(); ?>
			<select id="<?php echo $this->get_field_id( 'cat_uid' ); ?>[]" name="<?php echo $this->get_field_name( 'cat_uid' ); ?>[]">
				<option value="" selected='selected'>- All categories -</option>
				<?php foreach( $cats as $cat ){ ?>
					<option value="<?php echo esc_attr( $cat->slug );?>" <?php if ( $cat->slug == $instance['cat_uid'] ) echo 'selected="selected"'; ?>><?php echo esc_attr( $cat->name ); ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat_uids' ); ?>">Multiple categories filter</label>
			<br class="cfix">

			<input id="<?php echo $this->get_field_id( 'cat_uids' ); ?>" name="<?php echo $this->get_field_name( 'cat_uids' ); ?>" value="<?php echo $instance['cat_uids']; ?>" class="widefat" type="text" />
			<div class="list_tags">
				<?php
				$bdaia_block_categories = get_categories();
				foreach ( $bdaia_block_categories as $cat ) {
					?><span onclick="add_cat( '<?php echo $this->get_field_id( 'cat_uids' ); ?>', '<?php echo $cat->slug; ?>' )"><?php echo esc_attr( $cat->name ); ?></span><?php
				}
				?>
			</div>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tag_slug' ); ?>">Filter by tag slug</label>
			<br class="cfix">

			<input id="<?php echo $this->get_field_id( 'tag_slug' ); ?>" name="<?php echo $this->get_field_name( 'tag_slug' ); ?>" value="<?php echo $instance['tag_slug']; ?>" class="widefat" type="text" />
			<div class="list_tags">
				<?php
				$bdaia_block_tags = get_tags('orderby=count&order=desc&number=50');
				foreach ( $bdaia_block_tags as $cat ) {
					?><span onclick="add_cat( '<?php echo $this->get_field_id( 'tag_slug' ); ?>', '<?php echo $cat->slug; ?>' )"><?php echo esc_attr( $cat->name ); ?></span><?php
				}
				?>
			</div>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'posts' ); ?>">Multiple Posts filter</label>
			<input id="<?php echo $this->get_field_id( 'posts' ); ?>" name="<?php echo $this->get_field_name( 'posts' ); ?>" value="<?php echo $instance['posts']; ?>" class="widefat" type="text" />
			<br />
			<small>Filter multiple posts by ID( ex: 41, 352 ).</small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'sort_order' ); ?>">Sor Order</label>
			<select id="<?php echo $this->get_field_id( 'sort_order' ); ?>" name="<?php echo $this->get_field_name( 'sort_order' ); ?>" class="widefat">
				<option <?php if ( '' == $instance['sort_order'] ) echo 'selected="selected"'; ?> value="">- Latest </option>
				<option <?php if ( 'popular' == $instance['sort_order'] ) echo 'selected="selected"'; ?> value="popular">Popular (all time)</option>
				<option <?php if ( 'alphabetical_order' == $instance['sort_order'] ) echo 'selected="selected"'; ?> value="alphabetical_order">Alphabetical A -&gt; Z</option>
				<option <?php if ( 'review_high' == $instance['sort_order'] ) echo 'selected="selected"'; ?> value="review_high">Highest rated (reviews)</option>
				<option <?php if ( 'comment_count' == $instance['sort_order'] ) echo 'selected="selected"'; ?> value="comment_count">Most Commented</option>
				<option <?php if ( 'random_posts' == $instance['sort_order'] ) echo 'selected="selected"'; ?> value="random_posts">Random Posts</option>
				<option <?php if ( 'random_today' == $instance['sort_order'] ) echo 'selected="selected"'; ?> value="random_today">Random posts Today</option>
				<option <?php if ( 'random_7_day' == $instance['sort_order'] ) echo 'selected="selected"'; ?> value="random_7_day">Random posts from last 7 Day</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ajax_pagination' ); ?>">Pagination</label>
			<select id="<?php echo $this->get_field_id( 'ajax_pagination' ); ?>" name="<?php echo $this->get_field_name( 'ajax_pagination' ); ?>" class="widefat">
				<option <?php if ( '' == $instance['ajax_pagination'] ) echo 'selected="selected"'; ?> value="">- No pagination -</option>
				<option <?php if ( 'load_more' == $instance['ajax_pagination'] ) echo 'selected="selected"'; ?> value="load_more">Load More button</option>
				<option <?php if ( 'next_prev' == $instance['ajax_pagination'] ) echo 'selected="selected"'; ?> value="next_prev">Next/Prev</option>
			</select>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail' ); ?>" value="true" <?php if( !empty( $instance['thumbnail'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'thumbnail' ); ?>">Hide thumbnail</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'review' ); ?>" name="<?php echo $this->get_field_name( 'review' ); ?>" value="true" <?php if( !empty( $instance['review'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'review' ); ?>">Review Star</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'com_meta' ); ?>" name="<?php echo $this->get_field_name( 'com_meta' ); ?>" value="true" <?php if( !empty( $instance['com_meta'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'com_meta' ); ?>">Comments Count</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'author_meta' ); ?>" name="<?php echo $this->get_field_name( 'author_meta' ); ?>" value="true" <?php if( !empty( $instance['author_meta'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'author_meta' ); ?>">Author Meta</label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'date_meta' ); ?>" name="<?php echo $this->get_field_name( 'date_meta' ); ?>" value="true" <?php if( !empty( $instance['date_meta'] ) ) echo 'checked="checked"'; ?> type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'date_meta' ); ?>">Date Meta</label>
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance )
	{
		$instance                       = $old_instance;
		$instance['title']              = strip_tags( $new_instance['title']        );
		$instance['num_posts']          = strip_tags( $new_instance['num_posts']    );
		$instance['box_color']          = strip_tags( $new_instance['box_color']    );
		$instance['cat_uid']            = implode(',' , $new_instance['cat_uid']    );
		$instance['cat_uids']           = strip_tags( $new_instance['cat_uids']     );
		$instance['tag_slug']           = strip_tags( $new_instance['tag_slug']     );
		$instance['posts']              = strip_tags( $new_instance['posts']        );
		$instance['sort_order']         = strip_tags( $new_instance['sort_order']   );
		$instance['review']             = strip_tags( $new_instance['review']       );
		$instance['com_meta']           = strip_tags( $new_instance['com_meta']     );
		$instance['author_meta']        = strip_tags( $new_instance['author_meta']  );
		$instance['date_meta']          = strip_tags( $new_instance['date_meta']    );
		$instance['thumbnail']          = strip_tags( $new_instance['thumbnail']    );
		$instance['ajax_pagination']    = strip_tags( $new_instance['ajax_pagination'] );

		return $instance;
	}
}
function woohoo_widget_box6() {
	register_widget( 'WOOHOO_WIDGET_BOX6' );
}
add_action( 'widgets_init', 'woohoo_widget_box6' );