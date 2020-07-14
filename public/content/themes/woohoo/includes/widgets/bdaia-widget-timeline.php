<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_WIDGET_TIMELINE extends WP_Widget
{
	function __construct() {
		parent::__construct (
			'bdaia-widget-timeline', '.: Bdaia - Timeline',
			array( 'classname' => 'bdaia-widget-timeline', 'description' => '' )
		);
	}

	public function widget( $args, $instance )
	{
		extract( $args );
		$title                  = $instance['title'];
		$num_posts              = $instance['num_posts'];
		$cat_uid                = $instance['cat_uid'];
		$cat_uids               = $instance['cat_uids'];
		$tag_slug               = $instance['tag_slug'];
		$posts                  = $instance['posts'];
		$sort_order             = $instance['sort_order'];

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

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo '<h4 class="block-title"><span>' . $title . '</span></h4>'."\n";
		}
		echo'<div class="widget-inner">'."\n" ?>
			<ul>
				<?php
				global $post;
				$original_post = $post;
				if ( !empty( $num_posts ) ) $timeline_qargs[ 'posts_per_page' ] = $num_posts;
				$timeline_qargs[ 'post_status' ] = 'publish';
				$timeline_qargs[ 'ignore_sticky_posts' ] = true;

				if ( !empty( $get_term_id ) and empty( $get_terms_ids ) ) $get_terms_ids = $get_term_id;
				if ( !empty( $get_terms_ids ) ) $timeline_qargs['cat'] = $get_terms_ids;

				if ( !empty( $tag_slug ) ) $timeline_qargs['tag'] = str_replace(' ', '-', $tag_slug);
				if ( !empty( $posts ) ) $timeline_qargs['post__in'] = explode (',' , $posts );

				switch ( $sort_order )
				{
					case 'popular':
						$timeline_qargs['meta_key']      = 'bdaia_views';
						$timeline_qargs['orderby']       = 'meta_value_num';
						$timeline_qargs['order']         = 'DESC';
						break;

					case 'review_high':
						$timeline_qargs['meta_key']      = 'bdaia_taqyeem_final_score';
						$timeline_qargs['orderby']       = 'meta_value';
						$timeline_qargs['order']         = 'DESC';
						$timeline_qargs['meta_value']    = 0;
						$timeline_qargs['meta_compare']  = '!=';
						break;

					case 'random_posts':
						$timeline_qargs['orderby']       = 'rand';
						break;

					case 'alphabetical_order':
						$timeline_qargs['orderby']       = 'title';
						$timeline_qargs['order']         = 'ASC';
						break;

					case 'comment_count':
						$timeline_qargs['orderby']       = 'comment_count';
						$timeline_qargs['order']         = 'DESC';
						break;

					case 'random_today':
						$timeline_qargs['orderby']       = 'rand';
						$timeline_qargs['year']          = date('Y');
						$timeline_qargs['monthnum']      = date('n');
						$timeline_qargs['day']           = date('j');
						break;

					case 'random_7_day':
						$timeline_qargs['orderby']       = 'rand';
						$timeline_qargs['date_query']    = array(
							'column' => 'post_date_gmt',
							'after' => '1 week ago'
						);
						break;
				}
				$timeline_query = new WP_Query( $timeline_qargs );
				if ( $timeline_query->have_posts() ):
					while ( $timeline_query->have_posts() ) : $timeline_query->the_post()?>
						<li>
							<a href="<?php the_permalink(); ?>">
								<?php woohoo_get_time(); ?>
								<h3><?php the_title();?></h3>
							</a>
						</li>
						<?php
					endwhile;
					wp_reset_query();
				endif;
				$post = $original_post;
				?>
			</ul>
		<?php
		echo $args['after_widget'];
	}

	public function form( $instance )
	{
		$defaults = array(
			'title'             => '',
			'num_posts'         => 4,
			'cat_uid'           => '',
			'cat_uids'          => '',
			'tag_slug'          => '',
			'posts'             => '',
			'sort_order'        => ''
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
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

		<?php
	}

	public function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['title']              = strip_tags( $new_instance['title']        );
		$instance['num_posts']          = strip_tags( $new_instance['num_posts']    );
		$instance['cat_uid']            = implode(',' , $new_instance['cat_uid']    );
		$instance['cat_uids']           = strip_tags( $new_instance['cat_uids']     );
		$instance['tag_slug']           = strip_tags( $new_instance['tag_slug']     );
		$instance['posts']              = strip_tags( $new_instance['posts']        );
		$instance['sort_order']         = strip_tags( $new_instance['sort_order']   );

		return $instance;
	}
}
function woohoo_widget_timline(){
	register_widget( 'WOOHOO_WIDGET_TIMELINE' );
}
add_action( 'widgets_init', 'woohoo_widget_timline' );