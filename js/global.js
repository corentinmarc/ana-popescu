$(document).ready( function(){
	
	majNav();
	
	// Hook into State Changes
	$(window).bind('statechange',function(){
		majNav();
	});
	
	// mobile-nav push state
	$(".mobile-nav").on("change", function(){
		//console.log($(this).val());
		window.location.href = $(this).val();
	});
	
	/*---------------------------------------------------------------------------
							MAJ NAV
	---------------------------------------------------------------------------*/
	
	function majNav(){
		
		var		
			rootUrl = History.getRootUrl(),
			State = History.getState(),
			url = State.url,
			relativeUrl = url.replace(rootUrl,'');
			
		//console.log(relativeUrl);
		
		$('.mobile-nav option').prop('selected', false);
		if( relativeUrl == '' ) {
				$('#main_header nav a').removeClass('selected');
				$('#mobile-nav-home').prop('selected', true);
			}
			else {
				if( relativeUrl.indexOf('showreel') != -1 ){
					$('#main_header nav a').removeClass('selected');
					$('#nav-showreel').addClass('selected');
					$('#mobile-nav-showreel').prop('selected', true);
				}
				if( relativeUrl.indexOf('video') != -1 ){
					$('#main_header nav a').removeClass('selected');
					$('#nav-video').addClass('selected');
					$('#mobile-nav-video').prop('selected', true);
				}
				if( relativeUrl.indexOf('gallery') != -1 ){
					$('#main_header nav a').removeClass('selected');
					$('#nav-gallery').addClass('selected');
					$('#mobile-nav-gallery').prop('selected', true);
				}
				if( relativeUrl.indexOf('about') != -1 ){
					$('#main_header nav a').removeClass('selected');
					$('#nav-about').addClass('selected');
					$('#mobile-nav-about').prop('selected', true);
				}
				if( relativeUrl.indexOf('press') != -1 ){
					$('#main_header nav a').removeClass('selected');
					$('#nav-press').addClass('selected');
					$('#mobile-nav-press').prop('selected', true);
				}
				if( relativeUrl.indexOf('contact') != -1 ){
					$('#main_header nav a').removeClass('selected');
					$('#nav-contact').addClass('selected');
					$('#mobile-nav-contact').prop('selected', true);
				}
			}
	}
	
});
