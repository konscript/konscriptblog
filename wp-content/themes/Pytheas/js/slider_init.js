jQuery(function($){
	$(window).load(function() {
		
		//start slideshow
		if(flexsliderLocalize.slider_slideshow == "true") flexsliderLocalize.slider_slideshow = true; else flexsliderLocalize.slider_slideshow = false;
		
    	$('.flexslider').flexslider({
			animation: flexsliderLocalize.slider_animation,
			slideshow: flexsliderLocalize.slider_slideshow,
			slideshowSpeed: 7000,
			animationSpeed: 600,  
			smoothHeight: true,
			prevText: '<span class="wpex-icon-chevron-left"></span>',
			nextText: '<span class="wpex-icon-chevron-right"></span>',
		});
		
	}); // end window load
}); // end function