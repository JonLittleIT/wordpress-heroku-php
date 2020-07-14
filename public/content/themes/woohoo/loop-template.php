<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

$GLOBALS['bd_bc1'] = 1;
$GLOBALS['bd_bc2'] = 0;

if ( ! have_posts() ) {
	?>
	<div class="bdaia-blocks bdaia-block2">
		<div class="bdaia-blocks-container">
			<ul>
				<li class="block-article bdaiaFadeIn">
					<?php if ( ! is_search() ) { ?>
					<h4 class="block-title"><span><?php woohoo_tr( 'Nothing Found' ); ?></span></h4>
					<?php } ?>
					<div class="block-article-content-wrapper">
						<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
                            <p class="block-exb"><?php printf( htmlspecialchars_decode( stripslashes ( woohoo__tr( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.' ) ) ), admin_url( 'post-new.php' ) ); ?></p>
                        <?php  } elseif ( is_search() ) { ?>
							<p class="block-exb" style="margin-top: 0"><?php woohoo_tr( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.' ); ?></p>
						<?php } else { ?>
							<p class="block-exb"><?php woohoo_tr( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.' ); ?></p>
							<div class="cfix"></div>
							<div class="woohoo-search-inner">
								<div class="search-form">
									<?php get_search_form(); ?>
								</div>
							</div>
						<?php } ?>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<?php
}
else
{
	if( empty( $GLOBALS['template_layout'] ) ) $GLOBALS['template_layout'] = woohoo_get_option( 'bdaia_blog_display' );
	switch ( $GLOBALS['template_layout'] )
	{
		case 'blockStyle1':
			?>
			<div class="bdaia-blocks bdaia-block1">
				<div class="bdaia-blocks-container">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'framework/blocks/loop/loop1' ); ?>
					<?php endwhile;?>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle2':
			?>
			<div class="bdaia-blocks bdaia-block2">
				<div class="bdaia-blocks-container">
					<?php
					$post_sidebars = $sidebar = "";
					$bdaia_get_page_meta = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
					if( is_page() ) { if( isset( $bdaia_get_page_meta['sidebar_position_bd'] ) ) $post_sidebars = $bdaia_get_page_meta['sidebar_position_bd']; }
					if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );
					if( $post_sidebars == 'sideNo' ) $GLOBALS['thumb_loop2_size'] = $GLOBALS['bdaia-full'];
					else $GLOBALS['thumb_loop2_size'] = $GLOBALS['bdaia-large'];
					while ( have_posts() ) : the_post();
						get_template_part( 'framework/blocks/loop/loop2' );
					endwhile;
					?>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle6':
			?>
			<div class="bdaia-blocks bdaia-block6">
				<div class="bdaia-blocks-container">
					<?php
					$post_sidebars = $sidebar = "";
					$bdaia_get_page_meta = get_post_meta( get_the_ID(), 'meta_page_options_bd', true );
					if( is_page() ) { if( isset( $bdaia_get_page_meta['sidebar_position_bd'] ) ) $post_sidebars = $bdaia_get_page_meta['sidebar_position_bd']; }
					if ( $post_sidebars == '' ) $post_sidebars = woohoo_get_option( 'bdaia_s_sidebar_pos' );
					if( $post_sidebars == 'sideNo' ) $GLOBALS['thumb_loop6_size'] = $GLOBALS['bdaia-full'];
					else $GLOBALS['thumb_loop6_size'] = $GLOBALS['bdaia-large'];
					while ( have_posts() ) : the_post();
						get_template_part( 'framework/blocks/loop/loop6' );
					endwhile;
					?>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle4':
			?>
			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block3 bdaia-block4">
					<div class="bdaia-blocks-container">
						<?php
						while ( have_posts() ) : the_post();
							if( $GLOBALS['bd_bc1'] % 2 == 1 ) echo '<div class="bd-block-row">';
							get_template_part( 'framework/blocks/loop/loop4' );
							if( $GLOBALS['bd_bc1'] % 2 == 0 ) echo "</div>\n";
							$GLOBALS['bd_bc1']++;
						endwhile;
						if ( $GLOBALS['bd_bc1'] % 2 != 1 ) echo "</div>\n";
						?>
					</div>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle7':
			?>
			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block6 bdaia-block7">
					<div class="bdaia-blocks-container">
						<?php
						while ( have_posts() ) : the_post();
							if( $GLOBALS['bd_bc1'] % 2 == 1 ) echo '<div class="bd-block-row">';
							get_template_part( 'framework/blocks/loop/loop7' );
							if( $GLOBALS['bd_bc1'] % 2 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
						endwhile;
						if ( $GLOBALS['bd_bc1'] % 2 != 1 ) echo "</div>\n";
						?>
					</div>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle5':
			?>
			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block3 bdaia-block5">
					<div class="bdaia-blocks-container">
						<?php
						while ( have_posts() ) : the_post();
							if( $GLOBALS['bd_bc1'] % 3 == 1 ) echo '<div class="bd-block-row">';
							get_template_part( 'framework/blocks/loop/loop5' );
							if( $GLOBALS['bd_bc1'] % 3 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
						endwhile;
						if ( $GLOBALS['bd_bc1'] % 3 != 1 ) echo "</div>\n";
						?>
					</div>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle3':
			?>
			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block3">
					<div class="bdaia-blocks-container">
						<?php
						while ( have_posts() ) : the_post();
							if( $GLOBALS['bd_bc1'] % 2 == 1 ) echo '<div class="bd-block-row">';
							get_template_part( 'framework/blocks/loop/loop3' );
							if( $GLOBALS['bd_bc1'] % 2 == 0 ) echo "</div>\n"; $GLOBALS['bd_bc1']++;
						endwhile;
						if ( $GLOBALS['bd_bc1'] % 2 != 1 ) echo "</div>\n";
						?>
					</div>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle9':
			?>
			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block9">
					<div class="bdaia-blocks-container">
						<?php
						while ( have_posts() ) : the_post();
						get_template_part( 'framework/blocks/loop/loop9' );
						endwhile;
						if ( $GLOBALS['bd_bc1'] % 999 != 1 ) echo "</div>\n";
						?>
					</div>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle10':
			?>
			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block10">
					<div class="bdaia-blocks-container">
						<?php
						while ( have_posts() ) : the_post();
						get_template_part( 'framework/blocks/loop/loop10' );
						endwhile;
						if ( $GLOBALS['bd_bc1'] % 999 != 1 ) echo "</div>\n";
						?>
					</div>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle11':
			?>
			<div class="bdaia-row">
				<div class="bdaia-blocks bdaia-block11">
					<div class="bdaia-blocks-container">
						<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'framework/blocks/loop/loop11' );
						endwhile;
						if ( $GLOBALS['bd_bc1'] % 999 != 1 ) echo "</div>\n";
						?>
					</div>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle12':
			?>
			<div class="bdaia-blocks bdaia-block22">
				<div class="bdaia-blocks-container">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'framework/blocks/loop/loop13' );
					endwhile;
					?>
				</div>
			</div>
			<?php
			break;

		case 'blockStyle13':
			?>
			<div class="bdaia-blocks bdaia-new-timeline">
				<div class="bdaia-blocks-container">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'framework/blocks/loop/timeline' );
					endwhile;
					?>
				</div>
			</div>
			<?php
			break;
	}
}