jQuery().ready(function($){

    setTimeout(function(){
        $('.woocommerce .buttons_added .minus, .woocommerce .buttons_added .plus').addClass('met_color_transition');
       
    },1000);
    
    $('.widget_price_filter .button').addClass('btn btn-primary');
    
    var $animEl 				= $('#pif_animation_data'),
	    $animation 				= {};
	    if( $animEl.get(0) ){
	    	$animation.in_ 			= $animEl.data('animation-in'),
	    	$animation.out_ 		= $animEl.data('animation-out'),
	    	$animation.duration_ 	= $animEl.data('animation-duration'),
	    	$animation.delay_ 		= $animEl.data('animation-delay');
	    	
	    	$( 'ul.products li.pif-has-gallery a:first-child img' ).addClass('animated').css({'-webkit-animation-duration': $animation.duration_ +'s','-webkit-animation-delay': $animation.delay_ +'s','animation-duration': $animation.duration_ +'s','animation-delay': $animation.delay_ +'s'});
	    	
	    	$( 'ul.products li.pif-has-gallery a:first-child img.wp-post-image' ).css({'-webkit-animation-name': $animation.in_, 'animation-name': $animation.in_});
	    	$( 'ul.products li.pif-has-gallery a:first-child img.secondary-image' ).css({'-webkit-animation-name': $animation.out_, 'animation-name': $animation.out_});
	    	
	    	$( 'ul.products li.pif-has-gallery' ).hoverIntent({
			    over: function(){
				    var $_this 			= $(this),
				    	$_firstImage 	= $_this.children('.wp-post-image'),
				    	$_secondImage 	= $_this.children('.secondary-image');
				    	
				    	$_firstImage.css({'-webkit-animation-name': $animation.out_, 'animation-name': $animation.out_});
				    	$_secondImage.css({'-webkit-animation-name': $animation.in_, 'animation-name': $animation.in_});
			    },
			    out: function(){
				    var $_this 			= $(this),
				    	$_firstImage 	= $_this.children('.wp-post-image'),
				    	$_secondImage 	= $_this.children('.secondary-image');
				    	
				    	$_secondImage.css({'-webkit-animation-name': $animation.out_, 'animation-name': $animation.out_});
				    	$_firstImage.css({'-webkit-animation-name': $animation.in_, 'animation-name': $animation.in_});
			    },
			    selector: 'a:first-child'
			});
		}
});