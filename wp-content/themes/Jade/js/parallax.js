/*
 * Viewport - jQuery selectors for finding elements in viewport
 *
 * Copyright (c) 2008-2009 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *  http://www.appelsiini.net/projects/viewport
 *
 */

(function($){$.belowthefold=function(element,settings){var fold=$(window).outerHeight()+$(window).scrollTop();return fold<=$(element).offset().top-settings.threshold;};$.abovethetop=function(element,settings){var top=$(window).scrollTop();return top>=$(element).offset().top+$(element).outerHeight()-settings.threshold;};$.rightofscreen=function(element,settings){var fold=$(window).outerWidth()+$(window).scrollLeft();return fold<=$(element).offset().left-settings.threshold;};$.leftofscreen=function(element,settings){var left=$(window).scrollLeft();return left>=$(element).offset().left+$(element).outerWidth()-settings.threshold;};$.inviewport=function(element,settings){return!$.rightofscreen(element,settings)&&!$.leftofscreen(element,settings)&&!$.belowthefold(element,settings)&&!$.abovethetop(element,settings);};$.extend($.expr[':'],{"below-the-fold":function(a,i,m){return $.belowthefold(a,{threshold:0});},"above-the-top":function(a,i,m){return $.abovethetop(a,{threshold:0});},"left-of-screen":function(a,i,m){return $.leftofscreen(a,{threshold:0});},"right-of-screen":function(a,i,m){return $.rightofscreen(a,{threshold:0});},"in-viewport":function(a,i,m){return $.inviewport(a,{threshold:0});}});})(jQuery);

/**
 * Transform Parallax - Smooth Parallaxing with CSS3 Transforms
 *
 * Copyright (c) 2014 MET Creative
 *
 * Licensed under the MIT license:
 *  http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *  http://metcreative.com
 *
 */
(function( $ ){
    var $_window = $(window);

    $.fn.parallax = function(options) {
    	
    	if( options != undefined ){
	    	var $__parallaxes = $(this);
	    	
	    	$__parallaxes.addClass('parallax_layer').css('width', '100%');
	    	$.each(options, function(k,v){
	    		if( k == 'cssTop' ){ $__parallaxes.css('top', v) }else{$__parallaxes.attr('data-parallax-' + k, v);}
	    	});
    	}else{
	    	var $__parallaxes = $('[data-met-parallax]');
    	}
    
        $__parallaxes.each(function(){
            var $_this 		= $(this),
                $_parent 	= $_this.parent(),
                $_p_el 		= $_this,
                $_transform = {x: 0, y: 0, z: 0, scale: 1},
                params 		= {},
                $_parallax_line_bg,
                $_windowHeight,
                $_windowWidth,
                $_offsetTop,
                $_captionHeight,
                $_stopAt;

            params.xpos         = $_this.data('parallax-xpos');
            params.xpos         = params.xpos == undefined ? '50%' : params.xpos;
            params.speedFactor  = $_this.data('parallax-speedfactor')   || 0.3;
            params.isBg         = $_this.data('parallax-isbg')          || false;
            params.direction    = $_this.data('parallax-direction')     || 'upwards';
            params.stopAt       = $_this.data('parallax-stopat')        || false;
            params.responsive   = $_this.data('parallax-responsive');
            params.responsive   = params.responsive == undefined ? true : false;
            
            $_parent = $_this.data('parallax-parent') != undefined ? $('#'+ $_this.data('parallax-parent')) : $_parent;

            function isEmpty(v){return v == ''}

            function define_sizes(){
                $_windowHeight   = $_window.height();
                $_windowWidth    = $_window.outerWidth();

                $_offsetTop      = params.isBg ? $_this.offset().top : $_parent.offset().top;
                $_captionHeight  = params.isBg ? $_this.outerHeight() : $_parent.outerHeight();
            }

            function positioning(){
                if( params.isBg ){
                    transforms('x', (-( ( $_p_el.outerWidth() - $_windowWidth ) * ( parseFloat(params.xpos) / 100 ) )) + 'px');
                }else{
                    if( params.xpos != false && parseFloat( $_p_el.css('left') ) != parseFloat( params.xpos ) ){
                        $_p_el.css('left', params.xpos);
                        transforms('x', -parseFloat(params.xpos) + '%');
                    }

                    if( params.stopAt ){ $_stopAt = $_windowWidth * params.stopAt / 1905 }
                    if( params.responsive ) transforms('scale', $_windowWidth / 1905);
                }
            }

            function transforms(pos, val){
                if( pos == 'y' && params.stopAt && $_stopAt >= parseFloat( val ) ) return;
                $_transform[pos] = val;
                $_p_el.css('transform', 'translateX(' + $_transform.x + ') translateY(' + $_transform.y + ') translateZ(' + $_transform.z + ') scale(' + $_transform.scale + ')');
            }

            function build(){
                if( !params.isBg ) return scrolling();
                var $image  = $_this.css('background-image').replace(/^url|'|"|[\(\)]/g, ''),
                    $repeat = $_this.css('background-repeat'),
                    $position = $_this.css('background-position');

                if( !isEmpty($image) ){
                    $_this.css('background-image', '');
					
					params.direction = $position == '50% 100%' ? 'downwards' : params.direction;
					var $speed = /parallax-speed-(\d+)/.exec($_this.attr('class'));
					if( $speed != undefined && $speed != null ){
						params.speedFactor = $speed[1].length > 1 ? parseFloat($speed[1][0]+'.'+$speed[1][1]) : parseInt($speed[1][0]);
					}

	                /*var $img;
	                $img = $('<img>').attr('src', $image).on('load', function () {
		                $img.remove();
		                $img = null;*/


		                $_parallax_line_bg = $repeat == 'no-repeat' ?
		                '<img class="met_parallax_line_bg '+ params.direction +'" src="' + $image + '" />' :
		                '<div class="met_parallax_line_bg '+ params.direction +'" style="background-image: url(' + $image + ')">';
		                $_this.append($_parallax_line_bg);

		                $_p_el = $_this.find('.met_parallax_line_bg');
		                sizer();
	                //});
                }
            }

            function sizer(){
                if( params.isBg ){
                   /* var $biggerHeight   = Math.max($_captionHeight, $_windowHeight),
                        $proper_height  = $biggerHeight + ( $biggerHeight * params.speedFactor ),
                        $el_outerWidth  = $_p_el.css({
                            'height': $proper_height,
                            'width': 'auto'
                        }).outerWidth();*/

	                var $el_outerWidth,
		                imgWidth = $_p_el.naturalWidth(), // your original img width
		                imgHeight = $_p_el.naturalHeight(),
		                finalHeight,
		                finalWidth,

		                containerWidth = $(window).width(), // your container  width (here 698px)
		                containerHeight = $_captionHeight,
		                imgRatio = (imgHeight / imgWidth),       // original img ratio
	                containerRatio = (containerHeight / containerWidth);     // container ratio

	                if (containerRatio > imgRatio)
	                {
		                finalHeight = containerHeight
		                finalWidth = (containerHeight / imgRatio)
	                }
	                else
	                {
		                finalWidth = containerWidth
		                finalHeight = (containerWidth * imgRatio)
	                }
	                console.log(imgWidth+' '+imgHeight+' '+containerWidth+' '+containerHeight);
	                $el_outerWidth  = $_p_el.css({
		                'height': finalHeight,
		                'width': 'auto'
	                }).outerWidth();

                    if( $_this.css('background-repeat') == 'no-repeat' ){
                        if( $el_outerWidth <= $_windowWidth){
                            $el_outerWidth = $_p_el.css({
                                'width': '100%',
                                'height': 'auto'
                            }).outerWidth();
                        }
                        positioning();
                    }
                }else{
                    positioning();
                }

                scrolling();
            }

            function scrolling(){
                if( ( params.isBg && $_this.is(':in-viewport') ) || ( !params.isBg && $_parent.is(':in-viewport') ) ){
	                console.log($_window.scrollTop());
                    if( params.direction == 'downwards' ){
                        var $posY = ( ( ( $_offsetTop - ( $_p_el.height() - $_captionHeight ) ) * params.speedFactor ) - ( $_window.scrollTop() * params.speedFactor ) );
                        if( params.isBg ) $posY = -1 * $posY;
                    }else{
                        var $posY = ( ( $_window.scrollTop() * params.speedFactor ) - ( $_offsetTop * params.speedFactor ) );
                    }
					
                    transforms('y', $posY + 'px');
                }
            }

            //$_parent.imagesLoaded(function(){
	        $_window.on('load', function(){
                optimizedResize.add(define_sizes);
                optimizedResize.add(sizer);
                optimizedScroll.add(scrolling);
		        define_sizes();
		        build();
                if( !params.isBg ) sizer();
            //});
            });
        });
    };
})(jQuery);