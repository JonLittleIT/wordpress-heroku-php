<?php
/*** The html form for search input. ***/
?>
<form method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url()) ?>">
	<div>
		<input type="text" placeholder="<?php echo esc_attr__('Search', 'farvis');?>" value="<?php echo esc_attr(the_search_query()); ?>" name="s" id="search">
		<input type="submit" id="searchsubmit" value="<?php echo esc_attr__('Search', 'farvis');?>">
	</div>
</form>