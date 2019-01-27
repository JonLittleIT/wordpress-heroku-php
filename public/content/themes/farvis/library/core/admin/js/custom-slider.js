/* customizer range-slider */

jQuery(function($){

    "use strict";

    /////////////////////////////////////////////////////////////////
    //   RANGE SLIDER
    /////////////////////////////////////////////////////////////////

    $( '.range-slider-single' ).each(function() {
        //console.log($( this ));
        var $range = $( this );
        var Format = wNumb({
            suffix: 'px'
        });
        var $value = $range.val();
        var $min = $range.data('min');
        var $max = $range.data('max');
        var $value_div = $range.next( '.range-values');
        //console.log($value);
        var $value_input = $value_div.find( '.range-value');
        $value_input.val( Format.to(parseInt($value)) );

        $range.ionRangeSlider({
            type: "single",
            min: $min,
            max: $max,
            from: $value,
            hide_min_max: false,
            hide_from_to: false,
            postfix: "px",
            grid: false
        });

        $range.on("change", function () {
            var $this = $(this),
                from = $this.data("from"),
                $value_div = $(this).next( '.range-values');

            $value_div.find( '.range-value').val( Format.to(from) );
        });

        var slider = $range.data("ionRangeSlider");

        $value_input.on("change", function () {
            var $from = $(this).val();

            slider.update({
                from: Format.from($from)
            });
        });
    });


    $( '.range-slider-double' ).each(function() {
        //console.log($( this ));
        var $range = $( this );
        var Format = wNumb({
            suffix: '%'
        });
        var $values = $range.val().split(";");
        var $min = $range.data('min');
        var $max = $range.data('max');
        var $control = $range.data('control');
        var $value_div = $range.next( '.range-values');
        $value_div.find( '.range-value-1').val( Format.to(parseInt($values[0])) );
        $value_div.find( '.range-value-2' ).val( Format.to($values[1]-$values[0]) );
        $value_div.find( '.range-value-3' ).val( Format.to($max-$values[1]) );

        $range.ionRangeSlider({
            type: "double",
            min: $min,
            max: $max,
            from: $values[0],
            to: $values[1],
            hide_min_max: true,
            hide_from_to: true,
            postfix: "%",
            grid: false
        });

        $range.on("change", function () {
            var $this = $(this),
                from = $this.data("from"),
                to = $this.data("to"),
                $value_div = $(this).next( '.range-values');

            $value_div.find( '.range-value-1').val( Format.to(from) );
            $value_div.find( '.range-value-2' ).val( Format.to(to-from) );
            $value_div.find( '.range-value-3' ).val( Format.to($max-to) );

        });
    });

});
