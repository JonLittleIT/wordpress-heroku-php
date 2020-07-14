"use strict";
var AnimatedHeadlineHandler = elementorFrontend.Module.extend( {
    svgPaths: {
        circle: [ 'M325,18C228.7-8.3,118.5,8.3,78,21C22.4,38.4,4.6,54.6,5.6,77.6c1.4,32.4,52.2,54,142.6,63.7 c66.2,7.1,212.2,7.5,273.5-8.3c64.4-16.6,104.3-57.6,33.8-98.2C386.7-4.9,179.4-1.4,126.3,20.7' ],
        underline_zigzag: [ 'M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9' ],
        x: [ 'M497.4,23.9C301.6,40,155.9,80.6,4,144.4', 'M14.1,27.6c204.5,20.3,393.8,74,467.3,111.7' ],
        strikethrough: [ 'M3,75h493.5' ],
        curly: [ 'M3,146.1c17.1-8.8,33.5-17.8,51.4-17.8c15.6,0,17.1,18.1,30.2,18.1c22.9,0,36-18.6,53.9-18.6 c17.1,0,21.3,18.5,37.5,18.5c21.3,0,31.8-18.6,49-18.6c22.1,0,18.8,18.8,36.8,18.8c18.8,0,37.5-18.6,49-18.6c20.4,0,17.1,19,36.8,19 c22.9,0,36.8-20.6,54.7-18.6c17.7,1.4,7.1,19.5,33.5,18.8c17.1,0,47.2-6.5,61.1-15.6' ],
        diagonal: [ 'M13.5,15.5c131,13.7,289.3,55.5,475,125.5' ],
        'double': [ 'M8.4,143.1c14.2-8,97.6-8.8,200.6-9.2c122.3-0.4,287.5,7.2,287.5,7.2', 'M8,19.4c72.3-5.3,162-7.8,216-7.8c54,0,136.2,0,267,7.8' ],
        double_underline: [ 'M5,125.4c30.5-3.8,137.9-7.6,177.3-7.6c117.2,0,252.2,4.7,312.7,7.6', 'M26.9,143.8c55.1-6.1,126-6.3,162.2-6.1c46.5,0.2,203.9,3.2,268.9,6.4' ],
        underline: [ 'M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7' ]
    },

    getDefaultSettings: function() {
        var settings = {
            animationDelay: 2500,
            //letters effect
            lettersDelay: 50,
            //typing effect
            typeLettersDelay: 150,
            selectionDuration: 500,
            //clip effect
            revealDuration: 600,
            revealAnimationDelay: 1500
        };

        settings.typeAnimationDelay = settings.selectionDuration + 800;

        settings.selectors = {
            headline: '.elementor-headline',
            dynamicWrapper: '.elementor-headline-dynamic-wrapper'
        };

        settings.classes = {
            dynamicText: 'elementor-headline-dynamic-text',
            dynamicLetter: 'elementor-headline-dynamic-letter',
            textActive: 'elementor-headline-text-active',
            textInactive: 'elementor-headline-text-inactive',
            letters: 'elementor-headline-letters',
            animationIn: 'elementor-headline-animation-in',
            typeSelected: 'elementor-headline-typing-selected'
        };

        return settings;
    },

    getDefaultElements: function() {
        var selectors = this.getSettings( 'selectors' ),
            classes = this.getSettings( 'classes' );

        return {
            $headline: this.$element.find( selectors.headline ),
            $dynamicWrapper: this.$element.find( selectors.dynamicWrapper )
        };
    },

    getNextWord: function( $word ) {
        return $word.is( ':last-child' ) ? $word.parent().children().eq( 0 ) : $word.next();
    },

    switchWord: function( $oldWord, $newWord ) {
        $oldWord
            .removeClass( 'elementor-headline-text-active' )
            .addClass( 'elementor-headline-text-inactive' );

        $newWord
            .removeClass( 'elementor-headline-text-inactive' )
            .addClass( 'elementor-headline-text-active' );
    },

    singleLetters: function() {
        var classes = this.getSettings( 'classes' );

        this.elements.$dynamicText.each( function() {
            var $word = jQuery( this ),
                letters = $word.text().split( '' ),
                isActive = $word.hasClass( classes.textActive );

            $word.empty();

            letters.forEach( function( letter ) {
                var $letter = jQuery( '<span>', { 'class': classes.dynamicLetter } ).text( letter );

                if ( isActive ) {
                    $letter.addClass( classes.animationIn );
                }

                $word.append( $letter );
            } );

            $word.css( 'opacity', 1 );
        } );
    },

    showLetter: function( $letter, $word, bool, duration ) {
        var self = this,
            classes = this.getSettings( 'classes' ),
            animationType = self.getElementSettings( 'animation_type' );

        $letter.addClass( classes.animationIn );

        if ( ! $letter.is( ':last-child' ) ) {
            setTimeout( function() {
                self.showLetter( $letter.next(), $word, bool, duration );
            }, duration );
        } else {
            if ( ! bool ) {
                setTimeout( function() {
                    self.hideWord( $word );
                }, self.getSettings( 'animationDelay' ) );
            }
        }
    },

    hideLetter: function( $letter, $word, bool, duration ) {
        var self = this,
            settings = this.getSettings();

        $letter.removeClass( settings.classes.animationIn );

        if ( ! $letter.is( ':last-child' ) ) {
            setTimeout( function() {
                self.hideLetter( $letter.next(), $word, bool, duration );
            }, duration );
        } else if ( bool ) {
            setTimeout( function() {
                self.hideWord( self.getNextWord( $word ) );
            }, self.getSettings( 'animationDelay' ) );
        }
    },

    showWord: function( $word, $duration ) {
        var self = this,
            settings = self.getSettings(),
            animationType = self.getElementSettings( 'animation_type' );

        if ( 'typing' === animationType ) {
            self.showLetter( $word.find( '.' + settings.classes.dynamicLetter ).eq( 0 ), $word, false, $duration );

            $word
                .addClass( settings.classes.textActive )
                .removeClass( settings.classes.textInactive );
        } else if ( 'clip' === animationType ) {
            self.elements.$dynamicWrapper.animate( { 'width': $word.width() + 10 }, settings.revealDuration, function() {
                setTimeout( function() {
                    self.hideWord( $word );
                }, settings.revealAnimationDelay );
            } );
        }
    },

    hideWord: function( $word ) {
        var self = this,
            settings = self.getSettings(),
            classes = settings.classes,
            letterSelector = '.' + classes.dynamicLetter,
            animationType = self.getElementSettings( 'animation_type' ),
            nextWord = self.getNextWord( $word );

        if ( 'typing' === animationType ) {
            self.elements.$dynamicWrapper.addClass( classes.typeSelected );

            setTimeout( function() {
                self.elements.$dynamicWrapper.removeClass( classes.typeSelected );

                $word
                    .addClass( settings.classes.textInactive )
                    .removeClass( classes.textActive )
                    .children( letterSelector )
                    .removeClass( classes.animationIn );
            }, settings.selectionDuration );
            setTimeout( function() {
                self.showWord( nextWord, settings.typeLettersDelay );
            }, settings.typeAnimationDelay );

        } else if ( self.elements.$headline.hasClass( classes.letters ) ) {
            var bool = $word.children( letterSelector ).length >= nextWord.children( letterSelector ).length;

            self.hideLetter( $word.find( letterSelector ).eq( 0 ), $word, bool, settings.lettersDelay );

            self.showLetter( nextWord.find( letterSelector ).eq( 0 ), nextWord, bool, settings.lettersDelay );

        } else if ( 'clip' === animationType ) {
            self.elements.$dynamicWrapper.animate( { width: '2px' }, settings.revealDuration, function() {
                self.switchWord( $word, nextWord );
                self.showWord( nextWord );
            } );
        } else {
            self.switchWord( $word, nextWord );

            setTimeout( function() {
                self.hideWord( nextWord );
            }, settings.animationDelay );
        }
    },

    animateHeadline: function() {
        var self = this,
            animationType = self.getElementSettings( 'animation_type' ),
            $dynamicWrapper = self.elements.$dynamicWrapper;

        if ( 'clip' === animationType ) {
            $dynamicWrapper.width( $dynamicWrapper.width() + 10 );
        } else if ( 'typing' !== animationType ) {
            //assign to .elementor-headline-dynamic-wrapper the width of its longest word
            var width = 0;

            self.elements.$dynamicText.each( function() {
                var wordWidth = jQuery( this ).width();

                if ( wordWidth > width ) {
                    width = wordWidth;
                }
            } );

            $dynamicWrapper.css( 'width', width );
        }

        //trigger animation
        setTimeout( function() {
            self.hideWord( self.elements.$dynamicText.eq( 0 ) );
        }, self.getSettings( 'animationDelay' ) );
    },

    getSvgPaths: function( pathName ) {
        var pathsInfo = this.svgPaths[ pathName ],
            $paths = jQuery();

        pathsInfo.forEach( function( pathInfo ) {
            $paths = $paths.add( jQuery( '<path>', { d: pathInfo } ) );
        } );

        return $paths;
    },

    fillWords: function() {
        var elementSettings = this.getElementSettings(),
            classes = this.getSettings( 'classes' ),
            $dynamicWrapper = this.elements.$dynamicWrapper;

        if ( 'rotate' === elementSettings.headline_style ) {
            var rotatingText = ( elementSettings.rotating_text || '' ).split( '\n' );

            rotatingText.forEach( function( word, index ) {
                var $dynamicText = jQuery( '<span>', { 'class': classes.dynamicText } ).html( word.replace( / /g, '&nbsp;' ) );

                if ( ! index ) {
                    $dynamicText.addClass( classes.textActive );
                }

                $dynamicWrapper.append( $dynamicText );
            } );
        } else {
            var $dynamicText = jQuery( '<span>', { 'class': classes.dynamicText + ' ' + classes.textActive } ).text( elementSettings.highlighted_text ),
                $svg = jQuery( '<svg>', {
                    xmlns: 'http://www.w3.org/2000/svg',
                    viewBox: '0 0 500 150',
                    preserveAspectRatio: 'none'
                } ).html( this.getSvgPaths( elementSettings.marker ) );

            $dynamicWrapper.append( $dynamicText, $svg[0].outerHTML );
        }

        this.elements.$dynamicText = $dynamicWrapper.children( '.' + classes.dynamicText );
    },

    rotateHeadline: function() {
        var settings = this.getSettings();

        //insert <span> for each letter of a changing word
        if ( this.elements.$headline.hasClass( settings.classes.letters ) ) {
            this.singleLetters();
        }

        //initialise headline animation
        this.animateHeadline();
    },

    initHeadline: function() {
        if ( 'rotate' === this.getElementSettings( 'headline_style' ) ) {
            this.rotateHeadline();
        }
    },

    onInit: function() {
        elementorFrontend.Module.prototype.onInit.apply( this, arguments );

        this.fillWords();

        this.initHeadline();
    }
} );

jQuery( window ).on( 'elementor/frontend/init', () => {
    const addHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( AnimatedHeadlineHandler, {
            $element,
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/animated-headline.default', addHandler );
} );
