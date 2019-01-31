 jQuery(document).ready(function($) {
    "use strict";

    $(document).on('change', '.megamenu select', function(){
        var $this = $(this);
        $this.next().val( $this.val() );
    });

    $('.megamenu select').each(function(){
        var $this = $(this);
    	var selected = $this.next().val();
    	var option_length = $this.find('option').length;

    	for (var i = 0; i < option_length; i++) {
    		if ($($this.find('option')[i]).val() == selected) {
    			$($this.find('option')[i]).attr('selected', 'selected');
    		}
    	}

    });

}); 