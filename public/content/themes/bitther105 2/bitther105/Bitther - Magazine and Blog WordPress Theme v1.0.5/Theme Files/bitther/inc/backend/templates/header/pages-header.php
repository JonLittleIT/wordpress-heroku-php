<?php
/**
 * Header - Install
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */
?>
<div id="tabs-container" role="tabpanel">
    <h2 class="nav-tab-wrapper">
        <a class="nav-tab active" href="#welcome"><?php esc_html_e( 'Install', 'bitther' ); ?></a>
        <a class="nav-tab" href="#plugins"><?php esc_html_e( 'Plugins', 'bitther' ); ?></a>
        <a class="nav-tab" href="#sample"><?php esc_html_e( 'Sample Data', 'bitther' ); ?></a>
        <a class="nav-tab" href="#support"><?php esc_html_e( 'Support', 'bitther' ); ?></a>
    </h2>
    <!-- .tab-header -->
    <div class="tab-content">
        <div id="welcome" class="tab-pane active" role="tabpanel">
            <?php bitther_Admin_Pages::bitther_welcome_page(); ?>
        </div>
        <div id="plugins" class="tab-pane" role="tabpanel">
            <?php bitther_Admin_Pages::bitther_plugins_page(); ?>
        </div>
        <div id="sample" class="tab-pane" role="tabpanel">
            <?php bitther_Admin_Pages::bitther_sample_page(); ?>
        </div>
        <div id="support" class="tab-pane" role="tabpanel">
            <?php bitther_Admin_Pages::bitther_support_page(); ?>
        </div>
    </div>
    <!-- .tab-content -->
</div>