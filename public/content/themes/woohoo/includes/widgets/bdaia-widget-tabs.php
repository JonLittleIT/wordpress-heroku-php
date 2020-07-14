<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class WOOHOO_WIDGET_TABS extends WP_Widget
{
	public $com_meta;
	public $review;
	public $author_meta;
	public $date_meta;
	public $thumbnail;

	function __construct() {
		parent::__construct (
			'bdaia-tabs', '.: Bdaia - Tabs',
			array( 'classname' => 'bdaia-tabs', 'description' => '' )
		);
	}

	public function woohoo_tabs_loop( $thumbnail, $review, $author_meta, $date_meta, $com_meta )
	{
		$the_id         = get_the_ID();
		$size           = $GLOBALS['bdaia-small'];

		if( has_post_thumbnail ( get_the_ID() ) && ! $thumbnail ) $thum_class = "with-thumb";
		else $thum_class = "no-thumb";

		$post_reviews = get_post_meta( $the_id, 'bdaia_taqyeem', true ); ?>
		<div class="bdaia-wb-article bdaia-wba-small bdaiaFadeIn">
			<article class="<?php echo $thum_class; ?>">
				<?php if( ! $thumbnail ) { ?>
					<div class="bwb-article-img-container">
						<?php if ( function_exists( "has_post_thumbnail" ) && has_post_thumbnail( get_the_ID() ) ) { ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( $size ); ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="bwb-article-content-wrapper">
					<header><h3 class="entry-title"><a href="<?php esc_url( the_permalink() ); ?>"><span><?php esc_attr( the_title() ); ?></span></a></h3></header>
					<footer>
						<?php if ( $post_reviews && $review ) { ?>
							<div class="bdaia-post-rating"><?php echo woohoo_final_score(); ?></div>
						<?php } else { ?>

							<?php if( $author_meta ) { ?>
								<div class="bdaia-post-author-name"><?php the_author_posts_link(); ?></div>
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
			</article>
		</div>
		<?php
	}

	public function widget( $args, $instance )
	{
		extract( $args );
		$avatar_size            = "55";
		$num_posts              = $instance['num_posts'];
		$this->review           = $instance['review'];
		$this->com_meta         = $instance['com_meta'];
		$this->author_meta      = $instance['author_meta'];
		$this->date_meta        = $instance['date_meta'];
		$this->thumbnail        = $instance['thumbnail']; ?>

		<script>
			jQuery(document).ready(function()
			{
				var tab_class = '.bdaia-widget-tabs#<?php echo $args['widget_id']; ?>';

				jQuery( tab_class+" .bdaia-tab-container" ).hide();
				jQuery( tab_class+" .bdaia-tabs-nav li:first" ).addClass( "active" ).show();
				jQuery( tab_class+" .bdaia-tab-container:first" ).show();

				jQuery( tab_class+" .bdaia-tabs-nav li" ).click(function(event)
				{
					event.preventDefault();
					jQuery( tab_class+" .bdaia-tabs-nav li").removeClass( "active" );
					jQuery(this).addClass( "active" );
					jQuery( tab_class+" .bdaia-tab-container").hide();

					var act = jQuery(this).find( "a" ).attr( "href" );
					jQuery( act ).slideDown();

					return false;
				});
			});
		</script>
		<div class="widget bdaia-widget">

			<div class="bdaia-widget-tabs" id="<?php echo $args['widget_id']; ?>">
				<div class="bdaia-wt-inner">

					<ul class="bdaia-tabs-nav">
						<li class="active">
							<a href="#tab1-<?php echo $args['widget_id']; ?>">
								<?php woohoo_tr('Popular') ?>
							</a>
						</li>
						<li>
							<a href="#tab2-<?php echo $args['widget_id']; ?>">
								<?php woohoo_tr('Recent') ?>
							</a>
						</li>
						<li>
							<a href="#tab3-<?php echo $args['widget_id']; ?>">
								<?php woohoo_tr('Comments') ?>
							</a>
						</li>
						<li>
							<a href="#tab4-<?php echo $args['widget_id']; ?>">
								<?php woohoo_tr('Tags') ?>
							</a>
						</li>
					</ul>

					<div class="bdaia-tab-content">
						<div class="bdaia-tab-container" id="tab1-<?php echo $args['widget_id']; ?>">
							<div class="widget-inner">
								<div class="bdaia-wb-wrap bdaia-wb1">
									<div class="bdaia-wb-content">
										<div class="bdaia-wb-inner">
											<?php
											global $post;
											$original_post = $post;
											$popularpostsargs = array(
												'orderby'				 => 'comment_count',
												'order'					 => 'DESC',
												'posts_per_page'		 => $num_posts,
												'post_status'			 => 'publish',
												'no_found_rows'          => true,
												'ignore_sticky_posts'	 => true
											);
											$popularposts = new WP_Query( $popularpostsargs );
											if ( $popularposts->have_posts() ):
												while ( $popularposts->have_posts() ) : $popularposts->the_post();
													echo $this->woohoo_tabs_loop( $this->thumbnail, $this->review, $this->author_meta, $this->date_meta, $this->com_meta );
												endwhile;
												wp_reset_query();
											endif;
											$post = $original_post; ?>
										</div>
									</div>
								</div>
							</div>
						</div><!--/TAB1-->

						<div class="bdaia-tab-container" id="tab2-<?php echo $args['widget_id']; ?>">
							<div class="widget-inner">
								<div class="bdaia-wb-wrap bdaia-wb1">
									<div class="bdaia-wb-content">
										<div class="bdaia-wb-inner">
											<?php
											global $post;
											$original_post = $post;
											$posts_queryargs = array(
												'posts_per_page'		 => $num_posts,
												'no_found_rows'          => true,
												'ignore_sticky_posts'	 => true
											);
											$get_posts_query = new WP_Query( $posts_queryargs );
											if ( $get_posts_query->have_posts() ):
												while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post();
													echo $this->woohoo_tabs_loop( $this->thumbnail, $this->review, $this->author_meta, $this->date_meta, $this->com_meta );
												endwhile;
												wp_reset_query();
											endif;
											$post = $original_post; ?>
										</div>
									</div>
								</div>
							</div>
						</div><!--/TAB2-->

						<div class="bdaia-tab-container" id="tab3-<?php echo $args['widget_id']; ?>">
							<div class="widget-inner">
								<?php
								$comments = get_comments( 'status=approve&number='.$num_posts );
								foreach ( $comments as $comment) { ?>
									<div class="bdaia-wb-comments">
										<div class="bdaia-wbc-inner">
											<div class="bdaia-wbc-avatar">
												<?php echo get_avatar( $comment, $avatar_size ); ?>
											</div>
											<div class="bdaia-wbc-comment">
												<h3 class="entry-title">
												<a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) ); ?>#comment-<?php echo $comment->comment_ID; ?>">
													<span><?php echo esc_attr( strip_tags( $comment->comment_author ) ); ?>: <?php echo wp_html_excerpt( $comment->comment_content, 80 ); ?>...</span>
												</a>
												</h3>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div><!--/TAB3-->

						<div class="bdaia-tab-container" id="tab4-<?php echo $args['widget_id']; ?>">
							<div class="tagcloud">
								<?php wp_tag_cloud( $args = array('largest' => 8,'number' => 25,'orderby'=> 'count', 'order' => 'DESC' )); ?>
							</div>
						</div><!--/TAB4-->
					</div>
				</div>
			</div>

		</div>
		<?php
	}

	public function form( $instance )
	{
		$defaults = array(
			'num_posts'         => 4,
			'review'            => true,
			'com_meta'          => false,
			'author_meta'       => true,
			'date_meta'         => true,
			'thumbnail'         => false,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'num_posts' ); ?>">Limit post number</label>
			<input id="<?php echo $this->get_field_id( 'num_posts' ); ?>" name="<?php echo $this->get_field_name( 'num_posts' ); ?>" value="<?php echo $instance['num_posts']; ?>" class="widefat" type="text" />
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
		$instance = $old_instance;
		$instance['num_posts']          = strip_tags( $new_instance['num_posts']    );
		$instance['review']             = strip_tags( $new_instance['review']       );
		$instance['com_meta']           = strip_tags( $new_instance['com_meta']     );
		$instance['author_meta']        = strip_tags( $new_instance['author_meta']  );
		$instance['date_meta']          = strip_tags( $new_instance['date_meta']    );
		$instance['thumbnail']          = strip_tags( $new_instance['thumbnail']    );

		return $instance;
	}
}
function woohoo_widget_tabs(){
	register_widget( 'WOOHOO_WIDGET_TABS' );
}
add_action( 'widgets_init', 'woohoo_widget_tabs' );