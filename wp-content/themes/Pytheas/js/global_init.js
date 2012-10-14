jQuery(function($){
	$(document).ready(function(){
		
		//scroll to top
		$('a[href=#top]').on('click', function(){
			$('html, body').animate({scrollTop:0}, 'normal');
			return false;
		});
		
		//animate comments scroll
		$(".comment-scroll a").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top}, 'normal');
		});
		
		// superFish
		$("ul.sf-menu").superfish({ 
			autoArrows: true,
			animation:  {opacity:'show', height:'show'}
		});
	
	}); // end doc ready
}); // end function