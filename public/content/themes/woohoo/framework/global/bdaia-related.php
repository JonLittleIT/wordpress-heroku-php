<?php
defined( 'ABSPATH' ) || exit; // Exit if accessed directly

$bdaia_related          = woohoo_get_option( 'bdaia_related' );
$bdaia_related_author   = woohoo_get_option( 'bdaia_related_author' );
$bdaia_related_cat      = woohoo_get_option( 'bdaia_related_cat' );

if( $bdaia_related || $bdaia_related_author || $bdaia_related_cat ){ ?>

<div class="bdayh-clearfix"></div>
<section id="bdaia-ralated-posts" class="bdaia-ralated-posts">

    <div class="bdaia-ralated-posts-head">
        <ul>
            <?php if( $bdaia_related ){ ?>
                <li id="nav-more-ralated">
                    <a href="#content-more-ralated"><?php woohoo_tr( 'Related Articles' ); ?></a>
                </li>
            <?php } ?>

            <?php if( $bdaia_related_author ){ ?>
                <li id="nav-more-author">
	                <a href="#content-more-author">
		                <?php
		                woohoo_tr( 'More By' );

		                $user_id = get_query_var( 'author' );
		                $author_name = get_the_author_meta( 'display_name', $user_id );
		                if( $author_name !== null )
			                echo '&nbsp;' . $author_name;
		                ?>
	                </a>
                </li>
            <?php } ?>

            <?php if( $bdaia_related_cat ){ ?>
                <li id="nav-more-cat">
                    <a href="#content-more-cat">
                        <?php
                        woohoo_tr( 'More In' );

                        global $post;
                        $categories     = get_the_category( $post->ID );
                        $category_ids   = array();
                        foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;

                        echo '&nbsp;' . get_cat_name( $category_ids[0] );
                        ?>
                    </a>
                </li>
            <?php } ?>

        </ul>
    </div>

    <?php if( $bdaia_related ) include get_template_directory() . '/framework/ajax/ralated/related-articles.php';?>
    <?php if( $bdaia_related_author ) include get_template_directory() . '/framework/ajax/ralated/related-author.php';?>
    <?php if( $bdaia_related_cat ) include get_template_directory() . '/framework/ajax/ralated/related-cat.php';?>

    <script>
        jQuery(document).ready(function()
        {
            $ralated_content     = jQuery( "#bdaia-ralated-posts .bdaia-ralated-content" );
            $ralated_li          = jQuery( "#bdaia-ralated-posts .bdaia-ralated-posts-head ul li" );

            $ralated_content.hide();
            jQuery( "#bdaia-ralated-posts .bdaia-ralated-posts-head ul li:first" ).addClass( "active" ).show();
            jQuery( "#bdaia-ralated-posts .bdaia-ralated-content:first" ).show();

            $ralated_li.click(function()
            {
                $ralated_li.removeClass( "active" );
                jQuery(this).addClass("active");
                $ralated_content.hide();

                var activeTab = jQuery(this).find( "a" ).attr( "href" );
                jQuery(activeTab).fadeIn( "fast" );

                return false;
            });
        });
    </script>
</section>
<div class="bdayh-clearfix"></div>
<!--/ .bdaia-ralated-posts /-->
<?php } ?>