var $doc     = jQuery(document),
    $window  = jQuery(window);

$doc.ready(function()
{

    /**! Fox Push -------- */
    var fox_push_signup_wrapper     = jQuery( "#fox-push-signup-wrapper"    ),
        fox_push_stats_wrapper      = jQuery( "#fox-push-stats-wrapper"     ),
        fox_push_connect_wrapper    = jQuery( "#fox-push-connect-wrapper"   );

    //jQuery( fox_push_stats_wrapper ).hide();

    jQuery( '.bdaia-toggle-option' ).each(function()
    {
        var $thisElement = jQuery(this),
            elementType  = $thisElement.attr( 'type' ),
            toggleItems  = $thisElement.data( 'bdaia-toggle' );

        toggleItems  = jQuery( toggleItems ).hide();

        if ( elementType = 'checkbox' )
        {
            if ( $thisElement.is( ':checked' ) )
            {
                toggleItems.slideDown( 'fast' );
            }

            $thisElement.change(function()
            {
                toggleItems.slideToggle( 100 );
            });
        }
    });

});