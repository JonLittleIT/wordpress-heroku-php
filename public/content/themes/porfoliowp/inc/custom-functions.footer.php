<?php
	/**
	CUSTOM FOOTER FUNCTIONS
	*/


    // SITE PRELOADER ANIMATION: From theme options panel
    function porfoliowp_loader_animation(){

        global  $porfoliowp_redux;
        
        $html = '';

        if (isset($porfoliowp_redux['mt_preloader_animation'])) {
            if ($porfoliowp_redux['mt_preloader_animation'] == 'v1_ball_triangle') {
                $html .= '<div class="porfoliowp_preloader v1_ball_triangle">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-triangle-path">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v2_ball_pulse'){
                $html .= '<div class="porfoliowp_preloader v2_ball_pulse">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-pulse">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v3_ball_grid_pulse'){
                $html .= '<div class="porfoliowp_preloader v3_ball_grid_pulse">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-grid-pulse">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v4_ball_clip_rotate'){
                $html .= '<div class="porfoliowp_preloader v4_ball_clip_rotate">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-clip-rotate">
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v5_ball_clip_rotate_pulse'){
                $html .= '<div class="porfoliowp_preloader v5_ball_clip_rotate_pulse">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-clip-rotate-pulse">
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v6_square_spin'){
                $html .= '<div class="porfoliowp_preloader v6_square_spin">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner square-spin">
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v7_ball_clip_rotate_multiple'){
                $html .= '<div class="porfoliowp_preloader v7_ball_clip_rotate_multiple">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-clip-rotate-multiple">
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v8_ball_pulse_rise'){
                $html .= '<div class="porfoliowp_preloader v8_ball_pulse_rise">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-pulse-rise">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v9_ball_rotate'){
                $html .= '<div class="porfoliowp_preloader v9_ball_rotate">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-rotate">
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v10_cube_transition'){
                $html .= '<div class="porfoliowp_preloader v10_cube_transition">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner cube-transition">
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v11_ball_zig_zag'){
                $html .= '<div class="porfoliowp_preloader v11_ball_zig_zag">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-zig-zag">
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v12_ball_zig_zag_deflect'){
                $html .= '<div class="porfoliowp_preloader v12_ball_zig_zag_deflect">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-zig-zag-deflect">
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v13_ball_scale'){
                $html .= '<div class="porfoliowp_preloader v13_ball_scale">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-scale">
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v14_line_scale'){
                $html .= '<div class="porfoliowp_preloader v14_line_scale">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner line-scale">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v15_line_scale_party'){
                $html .= '<div class="porfoliowp_preloader v15_line_scale_party">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner line-scale-party">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v16_ball_scale_multiple'){
                $html .= '<div class="porfoliowp_preloader v16_ball_scale_multiple">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-scale-multiple">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v17_ball_pulse_sync'){
                $html .= '<div class="porfoliowp_preloader v17_ball_pulse_sync">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-pulse-sync">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v18_ball_beat'){
                $html .= '<div class="porfoliowp_preloader v18_ball_beat">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-beat">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v19_line_scale_pulse_out'){
                $html .= '<div class="porfoliowp_preloader v19_line_scale_pulse_out">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner line-scale-pulse-out">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }elseif($porfoliowp_redux['mt_preloader_animation'] == 'v20_line_scale_pulse_out_rapid'){
                $html .= '<div class="porfoliowp_preloader v20_line_scale_pulse_out_rapid">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner line-scale-pulse-out-rapid">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }else{
                $html .= '<div class="porfoliowp_preloader v1_ball_triangle">
                            <div class="loaders">
                                <div class="loader">
                                    <div class="loader-inner ball-triangle-path">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>'; 
            }
        }else{
            $html .= '<div class="porfoliowp_preloader v1_ball_triangle">
                        <div class="loaders">
                            <div class="loader">
                                <div class="loader-inner ball-triangle-path">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>'; 
        }

        return $html;
    }


	/**
Function name:              porfoliowp_footer_row1()
Function description:       Footer row 1
*/
function porfoliowp_footer_row1(){

    global  $porfoliowp_redux;

    echo '<div class="row">';
        echo '<div class="col-md-12 footer-row-1">';
            echo '<div class="row">';

            $footer_row_1_layout = $porfoliowp_redux['mt_footer_row_1_layout'];
            $nr = array("1", "2", "3", "4", "6");

            if (in_array($footer_row_1_layout, $nr)) {
                $columns    = 12/$footer_row_1_layout;
                $class = 'col-md-'.esc_attr($columns);
                for ( $i=1; $i <= $footer_row_1_layout ; $i++ ) { 
                    if ( is_active_sidebar( 'footer_row_1_'.esc_attr($i) ) ){
                        echo '<div class="'.esc_attr($class).' sidebar-'.esc_attr($i).'">';
                            dynamic_sidebar( 'footer_row_1_'.esc_attr($i) );
                        echo '</div>';
                    }
                }
            }elseif($footer_row_1_layout == '5'){
                if ( is_active_sidebar( 'footer_row_1_1' ) ){
                    echo '<div class="col-md-2 col-md-offset-1 sidebar-1">';
                        dynamic_sidebar( 'footer_row_1_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_1_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_1_3' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_1_4' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_5' ) ){
                    echo '<div class="col-md-2 sidebar-5">';
                        dynamic_sidebar( 'footer_row_1_5' );
                    echo '</div>';
                }
            }elseif($footer_row_1_layout == 'column_half_sub_half'){
                if ( is_active_sidebar( 'footer_row_1_1' ) ){
                    echo '<div class="col-md-6 sidebar-1">';
                        dynamic_sidebar( 'footer_row_1_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_2' ) ){
                    echo '<div class="col-md-3 sidebar-2">';
                        dynamic_sidebar( 'footer_row_1_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_3' ) ){
                    echo '<div class="col-md-3 sidebar-3">';
                        dynamic_sidebar( 'footer_row_1_3' );
                    echo '</div>';
                }
            }elseif($footer_row_1_layout == 'column_sub_half_half'){
                if ( is_active_sidebar( 'footer_row_1_1' ) ){
                    echo '<div class="col-md-3 sidebar-1">';
                        dynamic_sidebar( 'footer_row_1_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_2' ) ){
                    echo '<div class="col-md-3 sidebar-2">';
                        dynamic_sidebar( 'footer_row_1_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_3' ) ){
                    echo '<div class="col-md-6 sidebar-3">';
                        dynamic_sidebar( 'footer_row_1_3' );
                    echo '</div>';
                }
            }elseif($footer_row_1_layout == 'column_sub_fourth_third'){
                if ( is_active_sidebar( 'footer_row_1_1' ) ){
                    echo '<div class="col-md-2 sidebar-1">';
                        dynamic_sidebar( 'footer_row_1_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_1_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_1_3' );
                    echo '</div>';
                }
                    
                if ( is_active_sidebar( 'footer_row_1_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_1_4' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_5' ) ){
                    echo '<div class="col-md-4 sidebar-5">';
                        dynamic_sidebar( 'footer_row_1_5' );
                    echo '</div>';
                }
            }elseif($footer_row_1_layout == 'column_third_sub_fourth'){
                if ( is_active_sidebar( 'footer_row_1_1' ) ){
                    echo '<div class="col-md-4 sidebar-1">';
                        dynamic_sidebar( 'footer_row_1_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_1_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_1_3' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_1_4' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_5' ) ){
                    echo '<div class="col-md-2 sidebar-5">';
                        dynamic_sidebar( 'footer_row_1_5' );
                    echo '</div>';
                }
            }elseif($footer_row_1_layout == 'column_sub_third_half'){
                if ( is_active_sidebar( 'footer_row_1_1' ) ){
                    echo '<div class="col-md-2 sidebar-1">';
                        dynamic_sidebar( 'footer_row_1_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_1_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_1_3' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_4' ) ){
                    echo '<div class="col-md-6 sidebar-4">';
                        dynamic_sidebar( 'footer_row_1_4' );
                    echo '</div>';
                }
            }elseif($footer_row_1_layout == 'column_half_sub_third'){
                if ( is_active_sidebar( 'footer_row_1_1' ) ){
                    echo '<div class="col-md-6 sidebar-1">';
                        dynamic_sidebar( 'footer_row_1_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_1_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_1_2' );
                    echo '</div>';
                }
                    
                if ( is_active_sidebar( 'footer_row_1_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_1_3' );
                    echo '</div>';
                }
                    
                if ( is_active_sidebar( 'footer_row_1_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_1_4' );
                    echo '</div>';
                }
            }
            echo '</div>';
        echo '</div>';
    echo '</div>';
}


/**
Function name:              porfoliowp_footer_row2()
Function description:       Footer row 2
*/
function porfoliowp_footer_row2(){

    global  $porfoliowp_redux;

    echo '<div class="row">';
        echo '<div class="col-md-12 footer-row-2">';
            echo '<div class="row">';

            $footer_row_2_layout = $porfoliowp_redux['mt_footer_row_2_layout'];
            $nr = array("1", "2", "3", "4", "6");

            if (in_array($footer_row_2_layout, $nr)) {
                $columns    = 12/$footer_row_2_layout;
                $class = 'col-md-'.esc_attr($columns);
                for ( $i=1; $i <= $footer_row_2_layout ; $i++ ) { 
                    if ( is_active_sidebar( 'footer_row_2_'.esc_attr($i) ) ){
                        echo '<div class="'.esc_attr($class).' sidebar-'.esc_attr($i).'">';
                            dynamic_sidebar( 'footer_row_2_'.esc_attr($i) );
                        echo '</div>';
                    }
                }
            }elseif($footer_row_2_layout == '5'){
                if ( is_active_sidebar( 'footer_row_2_1' ) ){
                    echo '<div class="col-md-2 col-md-offset-1 sidebar-1">';
                        dynamic_sidebar( 'footer_row_2_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_2_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_2_3' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_2_4' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_5' ) ){
                    echo '<div class="col-md-2 sidebar-5">';
                        dynamic_sidebar( 'footer_row_2_5' );
                    echo '</div>';
                }
            }elseif($footer_row_2_layout == 'column_half_sub_half'){
                if ( is_active_sidebar( 'footer_row_2_1' ) ){
                    echo '<div class="col-md-6 sidebar-1">';
                        dynamic_sidebar( 'footer_row_2_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_2' ) ){
                    echo '<div class="col-md-3 sidebar-2">';
                        dynamic_sidebar( 'footer_row_2_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_3' ) ){
                    echo '<div class="col-md-3 sidebar-3">';
                        dynamic_sidebar( 'footer_row_2_3' );
                    echo '</div>';
                }
            }elseif($footer_row_2_layout == 'column_sub_half_half'){
                if ( is_active_sidebar( 'footer_row_2_1' ) ){
                    echo '<div class="col-md-3 sidebar-1">';
                        dynamic_sidebar( 'footer_row_2_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_2' ) ){
                    echo '<div class="col-md-3 sidebar-2">';
                        dynamic_sidebar( 'footer_row_2_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_3' ) ){
                    echo '<div class="col-md-6 sidebar-3">';
                        dynamic_sidebar( 'footer_row_2_3' );
                    echo '</div>';
                }
            }elseif($footer_row_2_layout == 'column_sub_fourth_third'){
                if ( is_active_sidebar( 'footer_row_2_1' ) ){
                    echo '<div class="col-md-2 sidebar-1">';
                        dynamic_sidebar( 'footer_row_2_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_2_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_2_3' );
                    echo '</div>';
                }
                    
                if ( is_active_sidebar( 'footer_row_2_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_2_4' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_5' ) ){
                    echo '<div class="col-md-4 sidebar-5">';
                        dynamic_sidebar( 'footer_row_2_5' );
                    echo '</div>';
                }
            }elseif($footer_row_2_layout == 'column_third_sub_fourth'){
                if ( is_active_sidebar( 'footer_row_2_1' ) ){
                    echo '<div class="col-md-4 sidebar-1">';
                        dynamic_sidebar( 'footer_row_2_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_2_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_2_3' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_2_4' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_5' ) ){
                    echo '<div class="col-md-2 sidebar-5">';
                        dynamic_sidebar( 'footer_row_2_5' );
                    echo '</div>';
                }
            }elseif($footer_row_2_layout == 'column_sub_third_half'){
                if ( is_active_sidebar( 'footer_row_2_1' ) ){
                    echo '<div class="col-md-2 sidebar-1">';
                        dynamic_sidebar( 'footer_row_2_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_2_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_2_3' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_4' ) ){
                    echo '<div class="col-md-6 sidebar-4">';
                        dynamic_sidebar( 'footer_row_2_4' );
                    echo '</div>';
                }
            }elseif($footer_row_2_layout == 'column_half_sub_third'){
                if ( is_active_sidebar( 'footer_row_2_1' ) ){
                    echo '<div class="col-md-6 sidebar-1">';
                        dynamic_sidebar( 'footer_row_2_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_2_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_2_2' );
                    echo '</div>';
                }
                    
                if ( is_active_sidebar( 'footer_row_2_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_2_3' );
                    echo '</div>';
                }
                    
                if ( is_active_sidebar( 'footer_row_2_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_2_4' );
                    echo '</div>';
                }
            }
            echo '</div>';
        echo '</div>';
    echo '</div>';
}


/**
Function name:              porfoliowp_footer_row3()
Function description:       Footer row 3
*/
function porfoliowp_footer_row3(){

    global  $porfoliowp_redux;

    echo '<div class="row">';
        echo '<div class="col-md-12 footer-row-3">';
            echo '<div class="row">';

            $footer_row_3_layout = $porfoliowp_redux['mt_footer_row_3_layout'];
            $nr = array("1", "2", "3", "4", "6");

            if (in_array($footer_row_3_layout, $nr)) {
                $columns    = 12/$footer_row_3_layout;
                $class = 'col-md-'.esc_attr($columns);
                for ( $i=1; $i <= $footer_row_3_layout ; $i++ ) { 
                    if ( is_active_sidebar( 'footer_row_3_'.esc_attr($i) ) ){
                        echo '<div class="'.esc_attr($class).' sidebar-'.esc_attr($i).'">';
                            dynamic_sidebar( 'footer_row_3_'.esc_attr($i) );
                        echo '</div>';
                    }
                }
            }elseif($footer_row_3_layout == '5'){
                if ( is_active_sidebar( 'footer_row_3_1' ) ){
                    echo '<div class="col-md-2 col-md-offset-1 sidebar-1">';
                        dynamic_sidebar( 'footer_row_3_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_3_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_3_3' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_3_4' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_5' ) ){
                    echo '<div class="col-md-2 sidebar-5">';
                        dynamic_sidebar( 'footer_row_3_5' );
                    echo '</div>';
                }
            }elseif($footer_row_3_layout == 'column_half_sub_half'){
                if ( is_active_sidebar( 'footer_row_3_1' ) ){
                    echo '<div class="col-md-6 sidebar-1">';
                        dynamic_sidebar( 'footer_row_3_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_2' ) ){
                    echo '<div class="col-md-3 sidebar-2">';
                        dynamic_sidebar( 'footer_row_3_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_3' ) ){
                    echo '<div class="col-md-3 sidebar-3">';
                        dynamic_sidebar( 'footer_row_3_3' );
                    echo '</div>';
                }
            }elseif($footer_row_3_layout == 'column_sub_half_half'){
                if ( is_active_sidebar( 'footer_row_3_1' ) ){
                    echo '<div class="col-md-3 sidebar-1">';
                        dynamic_sidebar( 'footer_row_3_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_2' ) ){
                    echo '<div class="col-md-3 sidebar-2">';
                        dynamic_sidebar( 'footer_row_3_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_3' ) ){
                    echo '<div class="col-md-6 sidebar-3">';
                        dynamic_sidebar( 'footer_row_3_3' );
                    echo '</div>';
                }
            }elseif($footer_row_3_layout == 'column_sub_fourth_third'){
                if ( is_active_sidebar( 'footer_row_3_1' ) ){
                    echo '<div class="col-md-2 sidebar-1">';
                        dynamic_sidebar( 'footer_row_3_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_3_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_3_3' );
                    echo '</div>';
                }
                    
                if ( is_active_sidebar( 'footer_row_3_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_3_4' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_5' ) ){
                    echo '<div class="col-md-4 sidebar-5">';
                        dynamic_sidebar( 'footer_row_3_5' );
                    echo '</div>';
                }
            }elseif($footer_row_3_layout == 'column_third_sub_fourth'){
                if ( is_active_sidebar( 'footer_row_3_1' ) ){
                    echo '<div class="col-md-4 sidebar-1">';
                        dynamic_sidebar( 'footer_row_3_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_3_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_3_3' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_3_4' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_5' ) ){
                    echo '<div class="col-md-2 sidebar-5">';
                        dynamic_sidebar( 'footer_row_3_5' );
                    echo '</div>';
                }
            }elseif($footer_row_3_layout == 'column_sub_third_half'){
                if ( is_active_sidebar( 'footer_row_3_1' ) ){
                    echo '<div class="col-md-2 sidebar-1">';
                        dynamic_sidebar( 'footer_row_3_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_3_2' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_3_3' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_4' ) ){
                    echo '<div class="col-md-6 sidebar-4">';
                        dynamic_sidebar( 'footer_row_3_4' );
                    echo '</div>';
                }
            }elseif($footer_row_3_layout == 'column_half_sub_third'){
                if ( is_active_sidebar( 'footer_row_3_1' ) ){
                    echo '<div class="col-md-6 sidebar-1">';
                        dynamic_sidebar( 'footer_row_3_1' );
                    echo '</div>';
                }

                if ( is_active_sidebar( 'footer_row_3_2' ) ){
                    echo '<div class="col-md-2 sidebar-2">';
                        dynamic_sidebar( 'footer_row_3_2' );
                    echo '</div>';
                }
                    
                if ( is_active_sidebar( 'footer_row_3_3' ) ){
                    echo '<div class="col-md-2 sidebar-3">';
                        dynamic_sidebar( 'footer_row_3_3' );
                    echo '</div>';
                }
                    
                if ( is_active_sidebar( 'footer_row_3_4' ) ){
                    echo '<div class="col-md-2 sidebar-4">';
                        dynamic_sidebar( 'footer_row_3_4' );
                    echo '</div>';
                }
            }
            echo '</div>';
        echo '</div>';
    echo '</div>';
}
?>