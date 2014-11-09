<section id="gallery">

	<div id="carousel-gallery">
		<ul>
		<?php
			$folder = '/img/gallery/';
	    	$dir = $_SERVER['DOCUMENT_ROOT'] .$folder;
	    	$imgs = array(); 
	    	
	    	// Filtrage des fichiers commencant par '.'
	    	$dirContent = array_values(array_filter(scandir($dir), function($value) { return ('.' !== $value{0}); }));
	    	
	    	// Filtrage pour ne garder que les fichiers images
	    	foreach ( $dirContent as $file ){
	    		$tab = split('\.', $file);
	    		// On n'accepte que les fichiers jpg et png
	    		if(end($tab) == 'jpg' || end($tab) == 'jpeg' || end($tab) == 'png'){
	    			array_push($imgs, $folder.$file);
	    		}
	    	}
	    	
	    	shuffle($imgs);
	    	
	    	foreach ( $imgs as $img ){
				echo'<li><img src="'.$img.'"/></li>';
			}
	    	
    	?>
		</ul>
	</div>
	<div id="carousel-bar">
		<div id='carousel-pointer'></div>
	</div>
	
</section>

<script type="text/javascript">

    var speedCarousel = 40;	
    	
	$(document).ready(function() {
		var widthWindow = $(window).width();
		var widthCarousel = 0;
		var heightCarousel = 0;
		var moveCarousel = 0;
		var intervalCarousel;
		var panPointer = false;

		computeHeightCarousel();

		// A chaque image chargé on dimensionne le li parent et le ul global
		if( widthWindow > 1050 ) {
			$('#carousel-gallery img').load(function(){
				var ratioImg = getRatioImg(this);
				$(this).parent('li').width( heightCarousel*ratioImg );
				widthCarousel += $(this).parent('li').width()+1;
				$('#carousel-gallery ul').width(widthCarousel);
				//console.log(widthCarousel);
			});
		}
		else{
			widthCarousel = widthWindow;
			$('#carousel-gallery ul').width(widthCarousel);
		}
		
		/*
		 * Mouse Carousel defilement 
		*/
		$('#carousel-gallery').mouseenter(function(){
			//console.log('mouseenter carousel');
			intervalCarousel = setInterval( playCarousel, 30);
		});

		$('#carousel-gallery').mouseleave(function(){
			//console.log('mouseleave carousel');
			clearInterval(intervalCarousel);
		});

		$('#carousel-gallery').mousemove(function(event){
			var centerX = widthWindow/2;
			moveCarousel = (event.pageX-centerX)/widthWindow;
			//console.log(moveCarousel);
		});

		/*
		 * Mouse Pan Pointer Carousel Bar
		*/
		$('#carousel-bar, #carousel-pointer').mousedown(function(event){
			panPointer = true;
			ratio = event.pageX/widthWindow;
			//console.log(ratio);
			$('#carousel-gallery ul').css('left', -ratio*(widthCarousel-widthWindow));
			majCarouselPointer();
			//console.log('start Panning');
		});

		$(document).mouseup(function(){
			panPointer = false;
			//console.log('end Panning');
		});

		$(document).mousemove(function(event){
			if( panPointer ){
				ratio = event.pageX/widthWindow;
				$('#carousel-gallery ul').css('left', -ratio*(widthCarousel-widthWindow));
				majCarouselPointer();
			}
		});
		
		$(window).resize(function(){
			computeWidthCarousel();
			
			widthWindow = $(window).width();
		});

		function playCarousel(){
			//console.log('carousel play');
			if( !panPointer ){
				val = parseInt($('#carousel-gallery ul').css('left')) - moveCarousel * speedCarousel;
				if( val > 0 ) val = 0;
				if( val < -(widthCarousel-widthWindow) ) val = -(widthCarousel-widthWindow);
				$('#carousel-gallery ul').css('left', val );
				majCarouselPointer();
			}
		}

		function majCarouselPointer(){
			var ratio = - parseInt($('#carousel-gallery ul').css('left')) / (widthCarousel-widthWindow);
			//console.log(ratio);
			$('#carousel-bar #carousel-pointer').css('left', ratio*(widthWindow-$('#carousel-bar #carousel-pointer').width()));
		}
		
		function computeWidthCarousel(){
			computeHeightCarousel();

			if( widthWindow > 1050 ){
				widthCarousel=0;
				$('#carousel-gallery img').each(function(){
					var ratioImg = getRatioImg(this);
					$(this).parent('li').width( heightCarousel*ratioImg );
					widthCarousel += $(this).parent('li').width()+1;
				});
				$('#carousel-gallery ul').width(widthCarousel);
				//console.log(widthCarousel);
			}
			else{
				widthCarousel = widthWindow;
				$('#carousel-gallery ul').width(widthCarousel);
				$('#carousel-gallery img').each(function(){
					$(this).parent('li').width( widthCarousel );
				});
			}
		}

		function computeHeightCarousel(){
			heightCarousel = ( $(window).height()-150 );
			$('#gallery').height( heightCarousel );
		}

		function getRatioImg(_img){
			var img = $(_img);
			var theImage = new Image();
			theImage.src = img.attr("src");

			return theImage.width / theImage.height;
		}

	});
</script>