<?php
/**
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Woohoo News Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$tags    = wp_get_post_tags( get_the_ID() );
$tag_ids = array();
foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;

$postID = false;
if( empty( $postID ) ){
	$postID = get_the_ID();
}

if( is_category() || is_single() )
{
	$cat_id = '';
	if( is_category() ) $cat_id = get_query_var( 'cat' ) ;
	if( is_single() )
	{
		$categories = get_the_category( get_the_ID() );
		if( !empty( $categories[0]->term_id ) ) $cat_id = $categories[0]->term_id;
	}
	$bdaia_get_cat_meta = get_option( "bd_cat_$cat_id" );
}

$bdaia_get_post_meta          = get_post_meta( get_the_ID(), 'meta_post_options_bd', true );
$post_template_style = "";
if( isset( $bdaia_get_post_meta['post_template_bd'] )           ) $post_template_style = $bdaia_get_post_meta['post_template_bd'];
elseif( isset( $bdaia_get_cat_meta['bdaia_cat_post_template'] ) ) $post_template_style = $bdaia_get_cat_meta['bdaia_cat_post_template'];
if( $post_template_style == '' ) $post_template_style = woohoo_get_option( 'bdaia_post_template' );

if( $post_template_style == 'postStyle3' ) {
	$bd_rel_col_class = "grid-5col";
	$numpost = 5;
}
else {
	$bd_rel_col_class = "grid-3col";
	$numpost    = woohoo_get_option('article_related_numb') ? woohoo_get_option('article_related_numb') : 3;
}

$related_no_load_more = woohoo_get_option( 'bdaia_related_no_load_more' ); ?>

<div class="bdaia-ralated-content bdaia-posts-grid light <?php echo $bd_rel_col_class; ?>" id="content-more-ralated">
    <ul class="bdaia-posts-grid-list">
        <?php echo woohoo_related_articles( 1, isset($tag_ids[0]), $postID, $numpost ); ?>
    </ul>
    <div class="cfix"></div>

	<?php if( ! $related_no_load_more ) { ?>
	    <div class="bdayh-posts-load-wait">
	        <div class="sk-circle"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>
	    </div>
	    <div class="bdayh-load-more-btn">
	        <div class="bdaia-grid-loadmore-btn bd-more-btn">
	            <?php woohoo_tr( 'Load More Related Articles' ); ?><span class="bdaia-io bdaia-io-angle-down"></span>
	        </div>
	    </div>
	<?php } ?>
</div>

<?php if( ! $related_no_load_more ) { ?>
	<script type="text/javascript">
	    jQuery(document).ready(function($) {
	        jQuery('#content-more-ralated .bdayh-load-more-btn .bdaia-grid-loadmore-btn').click(function(){
	            woohoo_more_related();
	        });
	    });
	    var _bdPages = 1;
	    function woohoo_more_related() {
	        _bdPages+=1;

		    var bd_content = jQuery("#content-more-ralated ul.bdaia-posts-grid-list");

	        jQuery("#content-more-ralated .bdayh-posts-load-wait").css("display","block");
	        jQuery("#content-more-ralated .bdayh-load-more-btn").css("display","none");
	        jQuery.ajax({
	            url : "<?php echo admin_url('admin-ajax.php'); ?>",
	            type : "POST",
	            data : "action=woohoo_related_articles_fun&page_no="+_bdPages+"&tag_id=<?php echo isset($tag_ids[0]); ?>&post_id=<?php echo $postID ?>&numpost=<?php echo $numpost ?>",
	            success: function(data) {
	                jQuery("#content-more-ralated .bdayh-posts-load-wait").css("display","none");
	                if (data.trim()!="") {
	                    var content = jQuery(data);
		                bd_content.append(content);
	                    jQuery("#content-more-ralated .bdayh-load-more-btn").css("display","block");
		                var bd_re   = bd_content.find( '.post-image' );
		                bd_re.addClass( 'bdaia-img-show' );
		                i_refresh.refresh();
	                }
	            }
	        }, 'html');
	        return false;
	    }
	</script>
<?php } ?>