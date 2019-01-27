<?php
/**
 * The sidebar containing the main widget area
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */
?>
<div class="content-inner">
    <?php if(is_active_sidebar( 'shop')){
        dynamic_sidebar('shop');
    }?>
</div>
