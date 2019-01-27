jQuery(document).ready(function(){

  // PAGE TEMPLATES
	var value_selected = jQuery("#page_template").val();
    
  if (value_selected == "templates/template-blog.php" ){
  	jQuery('.blog_header_show').show();
  } else {
  	jQuery('.blog_header_show').hide();
  }

  jQuery('#page_template').on('change', function() {
    if (  jQuery('#page_template').val() == "templates/template-blog.php") { 
          jQuery('.blog_header_show').show();
    } else {
    		jQuery('.blog_header_show').hide();
    }
  });

  jQuery("#mt-house-typechecklist input, .mt-house-type-checklist input").each(function(){this.type="radio"});

});
