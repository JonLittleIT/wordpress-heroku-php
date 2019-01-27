/* customizer preview */

jQuery(function($){

    "use strict";

    /////////////////////////////////////////////////////////////////
    //   RANGE SLIDER
    /////////////////////////////////////////////////////////////////

    wp.customize( 'farvis_header_level1_proportions', function( value ) {
        value.bind( function( to ) {
            if ( to ) {
                var $values = to.split(";");
                console.log($values);
                $( '.header-level1-box-left').css('flex-basis', $values[0]+'%');
                $( '.header-level1-box-center').css('flex-basis', ($values[1]-$values[0])+'%');
                $( '.header-level1-box-right').css('flex-basis', (100-$values[1])+'%');
            }
        } );
    } );

    wp.customize( 'farvis_general_settings_logo_horizontal_pos', function( value ) {
        value.bind( function( to ) {
            if ( to ) {
                $( 'a.navbar-brand').css('left', to+'px');
            }
        } );
    } );

    wp.customize( 'farvis_general_settings_logo_vertical_pos', function( value ) {
        value.bind( function( to ) {
            if ( to ) {
                $( 'a.navbar-brand').css('top', to+'px');
            }
        } );
    } );

});
