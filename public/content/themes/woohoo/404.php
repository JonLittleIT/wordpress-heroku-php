<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header(); ?>
	<div class="bdaia-home-container">
		<div class="bd-container">
			<div class="bd-main--">
				<div class="bdaia-template-head">
					<div class="bdaia-th-container">
						<h4 class="block-title">
							<span>
								<?php woohoo_tr( 'Nothing Found' ); ?>
							</span>
						</h4>
						<div class="error-404message"><?php woohoo_tr( 'Sorry, the page you were looking for was not found.' ); ?></div>
						<div class="error-404numb">404</div>
						<div class="search-form">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div><!--/END Head/-->

				<?php
				$woohoo_404p_args = array( 'posts_per_page'=> 3 , 'no_found_rows' => 1 );
				$woohoo_404p_query = new wp_query( $woohoo_404p_args ); ?>

				<div class="cfix"></div>
				<div class="bdaia-block-wrap">

					<h4 class="block-title"><span><?php woohoo_tr( 'Check Also' ); ?></span></h4>
					<div class="bdaia-row">
						<div class="bdaia-blocks bdaia-block3 bdaia-block5">
							<div class="bdaia-blocks-container">
								<ul>
									<?php
									$woohoo_404p_count1 = 1;
									if ( $woohoo_404p_query->have_posts() ) :
										while ( $woohoo_404p_query->have_posts() ) : $woohoo_404p_query->the_post();
											if( $woohoo_404p_count1 % 3 == 1 ) echo '<div class="bd-block-row">';
											get_template_part( 'framework/blocks/loop/loop5' );
											if( $woohoo_404p_count1 % 3 == 0 ) echo "</div>\n"; $woohoo_404p_count1++;
										endwhile;
									endif;
									if ( $woohoo_404p_count1 % 3 != 1 ) echo "</div>";
									wp_reset_query(); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- END Home Container. -->
<?php get_footer(); ?>