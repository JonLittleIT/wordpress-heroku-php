'use strict';

(function($) {
    
    const body = $('body.beehive');

    if(body.hasClass('activity') || body.hasClass('group-home')) {
        const activityForm = $('#bp-nouveau-activity-form'),
        uploadBtn          = $('#rtmedia-add-media-button-post-update'),
        activity           = $('#activity-stream'),
        observationTarget  = activity[0],
        observationConfig  = {
            childList: true, subtree: true
        }

        // Set maxlength to activity form textarea
        activityForm.on('click', function() {
            const textArea  = $(this).find('#whats-new');
            const maxLength = beehive_data.activity_max;
            textArea.attr('maxlength', maxLength);
            textArea.on('keyup', function() {
                if(!$('#bp-nouveau-activity-form .char-count').length) {
                    $(this).after('<span class="char-count mute"></span>');
                }
                const charCount= $('#bp-nouveau-activity-form .char-count');
                const length    = $(this).val().length;
                const remaining = maxLength-length;
                charCount.text(remaining);
            });
        });

        // Insert attachment text to upload button
        if(uploadBtn.length) {
            uploadBtn.append('<span class="button-text">'+ beehive_data.attachment_text +'</span>');
        }

        // Observer the dom and do tasks
        let mutationObserver = new MutationObserver((mutationsList, observer) => {
            for(let mutation of mutationsList) {
                if(mutation.type == 'childList') {
                    if(mutation.addedNodes.length) {
                        for(let node of mutation.addedNodes) {
                            if(node.nodeType == 1) {
                                if(node.classList.contains('activity-list')) {
                                    for(let childNode of node.children) {
                                        if(childNode.classList.contains('activity-item')) {
                                            truncate_activity_text();
                                            rtm_media_view();
                                        }
                                    }
                                }
                                if(node.classList.contains('activity-item')) {
                                    truncate_activity_text();
                                    rtm_media_view();
                                }
                            }
                        }
                    }
                }
            }
        });
        if(observationTarget) {
            let $activityItems = $('.activity-item', observationTarget);

            if($activityItems.length) {
                truncate_activity_text();
                rtm_media_view();
            }
            mutationObserver.observe(observationTarget, observationConfig);
        }
        // end task

        // truncate activity texts
        function truncate_activity_text() {
            $('li.activity_update, li.rtmedia_update').each(function() {
                if($(this).hasClass('text-rendered')) {
                    return;
                }
                const rtmContainer = $(this).find('.activity-inner .rtmedia-activity-text');
                if(!rtmContainer.length) {
                    $(this).find('.activity-inner').wrapInner('<div class="activity-inner-text"></div>');
                } else {
                    rtmContainer.addClass('activity-inner-text');
                }
                const truncate = $(this).find('.activity-inner-text');
                if(truncate.length) {
                    truncate.shorten({
                        showChars: 230,
                        moreText: beehive_data.read_more.toLowerCase(),
                        lessText: beehive_data.read_close
                    });
                }
                $(this).addClass('text-rendered');
            });
        }

        // Make the medias in the activity nicer
        function rtm_media_view() {
            $('.activity-item .rtm-activity-media-list').each(function() {
                if($(this).hasClass('rtm-activity-list-rendered')) {
                    return;
                }
                if($(this).hasClass('rtm-activity-photo-list')) {
                    const visibleItems = 4;
                    if( $(this).children().length > visibleItems ) {
                        const item = $(this).find('.rtmedia-list-item');
                        item.filter(function(index) {
                            let currentItem = index + 1;
                            return currentItem == visibleItems;
                        }).addClass('more').end().filter(function(index){
                            let currentItem = index + 1;
                            return currentItem > visibleItems;
                        }).hide();
                        $(this).addClass('rtm-activity-list-rendered');
                    }
                } else if($(this).hasClass('rtm-activity-video-list') || $(this).hasClass('rtm-activity-music-list') || $(this).hasClass('rtm-activity-mixed-list')) {
                    if( $(this).children().length > 1 ) {
                        const video = $(this).find('.rtmedia-list-item video');
                        video.each(function() {
                            $(this).attr('preload', true);
                        });
                        $(this).wrap('<div class="rtm-activity-slider-container"></div>');
                        $(this).addClass('swiper-wrapper');
                        $(this).find('.rtmedia-list-item').addClass('swiper-slide');
                        $(this).after('<div class="swiper-pagination"></div>');
                        new Swiper('.rtm-activity-slider-container', {
                            pagination: {
                                el: '.swiper-pagination',
                                clickable: true,
                            },
                        });
                        $(this).addClass('rtm-activity-list-rendered');
                    } else {
                        const video = $(this).find('.rtmedia-list-item video');
                        video.each(function() {
                            $(this).attr('preload', true);
                        });
                        $(this).addClass('rtm-activity-list-rendered');
                    }
                }
            });
        }
    }

    // Trigger load more click
    if( body.hasClass( 'beehive-media' ) ) {
        $(window).scroll( function () {
            const load_more_btn = $( '.rtm-load-more a.show-it' );
            if( load_more_btn.length && 'block' == load_more_btn.css('display') ) {
                const pos           = load_more_btn.offset(),
                      offset        = pos.top - 50;
                if ( $(window).scrollTop() + $(window).height() > offset) {
                    load_more_btn.trigger( 'click' );
                }
            }
        });
    }
})( jQuery );