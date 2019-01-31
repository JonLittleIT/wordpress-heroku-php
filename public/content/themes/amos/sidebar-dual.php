<?php

$amos_redata = amos_redata_variable();

$amos_current_view =  amos_current_view();

$sidebar_style = "";



if($amos_redata['layout'] != 'fullwidth' || $amos_redata['bloglayout'] != 'fullwidth' || $amos_redata['singlebloglayout'] != 'fullwidth'):  ?>

    

    <aside class="span3 sidebar" id="widgetarea-sidebar">

        <?php if(is_active_sidebar($amos_redata['right_sidebar_dual'])) dynamic_sidebar($amos_redata['right_sidebar_dual']); ?>

    </aside>



<?php endif; ?>