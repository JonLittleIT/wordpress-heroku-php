jQuery(document).ready(function() {

    jQuery(document).on( 'mousemove', '.user-rate-active', function(e){
        var $rated = jQuery(this);

        if( $rated.hasClass('rated-done') ){
            return false;
        }

        if( !e.offsetX ){
            e.offsetX = e.clientX - jQuery(e.target).offset().left;
        }

        var offset = e.offsetX,
            width = $rated.width(),
            score = Math.round((offset/width)*120);

        $rated.find('.woohoo-star-rating span').attr( 'data-user-rate', score ).css('width', score + '%');

    });


    jQuery(document).on('click', '.user-rate-active' , function (){
        var rated = jQuery(this);
        if( rated.hasClass('rated-done') ){
            return false;
        }
        var userRatedValue = rated.find('.woohoo-star-rating span').width();
        rated.find('.woohoo-star-rating').css("display", "none !important");
        if (userRatedValue >= 95) {
            userRatedValue = 100;
        }
        userRatedValueCalc = (userRatedValue*5)/100;
        var post_id = rated.attr('data-id');
        var numVotes = rated.parent().parent().find('.user-rating-count').text();
        jQuery.post(userRating.ajaxurl, { action:'woohoo_rate_post' , post:post_id , value:userRatedValueCalc}, function(data) {
            rated.addClass('rated-done').attr('data-rate',userRatedValue);
            rated.find('.woohoo-star-rating span').width(userRatedValue+'%');

            rated.parent().parent().find('.user-rating-score').html( userRatedValueCalc );
            if( (jQuery(rated.parent().parent().find('.user-rating-count'))).length > 0 ){
                numVotes =  parseInt(numVotes)+1;
                rated.parent().parent().find('.user-rating-count').html(numVotes);
            }
            else{
                rated.parent().parent().find('small').hide();
            }
            rated.parent().parent().find('strong').html(userRating.your_rating);
            rated.find('.woohoo-star-rating').fadeIn();

        }, 'html');
        return false;
    });


    jQuery(document).on('mouseleave', '.user-rate-active' , function () {
        var rated = jQuery(this);
        if( rated.hasClass('rated-done') ){
            return false;
        }
        var post_rate = rated.attr('data-rate');
        rated.find(".woohoo-star-rating span").css('width', post_rate + '%');
    });
});