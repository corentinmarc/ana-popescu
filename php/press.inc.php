<section id="press">

	<div id='print-press'>
		<h2>Printed Press</h2>
		<div class='magazine'>
			<a href='/pdf/press/mag/cosmo-sept-2012.pdf' target="_blank">
				<img src="/img/press/mag/cosmo-sept-2012.jpg"/>
				<h3><span class='magazine-title'>Cosmopolitan</span> - Sept. 2012</h3>
			</a>
		</div>
		<div class='magazine'>
			<a href='/pdf/press/mag/as-june-2012.pdf' target="_blank">
				<img src="/img/press/mag/as-june-2012.jpg"/>
				<h3><span class='magazine-title'>As</span> - June 2012</h3>
			</a>
		</div>
		<div class='magazine'>
			<a href='/pdf/press/mag/unica-january-2012.pdf' target="_blank">
				<img src="/img/press/mag/unica-jan-2012.jpg"/>
				<h3><span class='magazine-title'>Unica</span> - Jan. 2012</h3>
			</a>
		</div>
		<div class='magazine'>
			<a href='/pdf/press/mag/cariere-may-2011.pdf' target="_blank">
				<img src="/img/press/mag/cariere-may-2011.jpg"/>
				<h3><span class='magazine-title'>Cariere</span> - May 2011</h3>
			</a>
		</div>
	</div>
	
	<div id='web-press'>
		<h2>Online Press</h2>
		<div class='web'>
			<a href='http://www.cosmopolitan.ro/cosmo-star/star-cv/ana-popescu-actrita-noului-val-romanesc-2128662' target="_blank">
				<img src="/img/press/web/cosmo.jpg"/>
				<h3><span class='web-title'>Cosmopolitan</span> - 24-10-2012</h3>
			</a>
		</div>
		
		<div class='web'>
			<a href='http://www.libertatea.ro/detalii/articol/buna-ce-faci-2-premii-festival-film-monaco-343860-1.html' target="_blank">
				<img src="/img/press/web/libertatea.jpg"/>
				<h3><span class='web-title'>Libertatea</span> - 05-07-2011</h3>
			</a>
		</div>
		
		<div class='web'>
			<a href='http://www.agentiadepresamondena.com/actrita-ana-popescu-aplaudata-la-monaco-charity-film-festival/' target="_blank">
				<img src="/img/press/web/adpm.jpg"/>
				<h3><span class='web-title'>ADPM</span> - 04-07-2011</h3>
			</a>
		</div>
		
		<div class='web'>
			<a href='http://www.elle.ro/fashion/vip-fashion-night-in-j-kristensen-store-15966/attachment/ana-popescu-intr-o-creatie-alberta-ferretti/' target="_blank">
				<img src="/img/press/web/elle.jpg"/>
				<h3><span class='web-title'>Elle</span> - 31-05-2011</h3>
			</a>
		</div>
		
		<div class='web'>
			<a href='http://www.one.ro/lifestyle/people-party/cum-s-au-imbracat-vedetele-la-vip-fashion-night-8299118-foto?p=5' target="_blank">
				<img src="/img/press/web/one.jpg"/>
				<h3><span class='web-title'>One</span> - 31-05-2011</h3>
			</a>
		</div>
		
		<div class='web'>
			<a href='http://adevarul.ro/entertainment/celebritati/video-actrita-romana-ana-popescu-intervievata-televiziunea-americana-cbs-1_50ace9417c42d5a6638bb4aa/index.html' target="_blank">
				<img src="/img/press/web/adevarul.jpg"/>
				<h3><span class='web-title'>Adevarul</span> - 26-05-2011</h3>
			</a>
		</div>
		
		<div class='web'>
			<a href='http://blog.cinefan.ro/2011/buna-ce-faci-interviu-exclusiv-cu-ana-popescu/' target="_blank">
				<img src="/img/press/web/cinefan.jpg"/>
				<h3><span class='web-title'>CineFan</span> - 23-02-2011</h3>
			</a>
		</div>
		
		<div class='web'>
			<a href='http://variety.com/2010/film/reviews/hello-how-are-you-1117942940/' target="_blank">
				<img src="/img/press/web/variety.jpg"/>
				<h3><span class='web-title'>Variety</span> - 08-06-2010</h3>
			</a>
		</div>
	</div>
		
	<div id='event-photo'>
		<h2>Event Photos</h2>
		<div id="carousel-gallery">
			<ul>
			<?php
				$folder = '/img/press/photo/';
		    	$dir = $_SERVER['DOCUMENT_ROOT'] .$folder;
		    	$imgs = array(); 
		    	
		    	// Filtrage des fichiers commencant par '.'
		    	$dirContent = array_values(array_filter(scandir($dir), function($value) { return ('.' !== $value{0}); }));
		    	
		    	// Filtrage pour ne garder que les fichiers images
		    	foreach ( $dirContent as $file ){
		    		$tab = explode('.', $file);
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
	</div>
	
</section>

<script type="text/javascript">

    var speedCarousel = 40;	
    	
	$(document).ready(function() {
		var widthWindow = $(window).width();
		var widthContainer = $('#event-photo').width();
		var widthCarousel = 0;
		var heightCarousel = $('#carousel-gallery').height();
		var moveCarousel = 0;
		var intervalCarousel;
		var panPointer = false;
		

		// A chaque image chargé on dimensionne le li parent et le ul global
		if( widthWindow > 1050 ) {
			$('#carousel-gallery img').load(function(){
				var ratioImg = getRatioImg(this);
				$(this).parent('li').width( heightCarousel*ratioImg );
				widthCarousel += $(this).parent('li').width()+1;
				$('#carousel-gallery ul').width(widthCarousel);
				console.log(widthCarousel);
			});
		}
		else{
			widthCarousel = widthContainer;
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
			var centerX = widthContainer/2;
			moveCarousel = ((event.pageX-(widthWindow-widthContainer)/2)-centerX)/widthContainer;
			//console.log(moveCarousel);
		});

		/*
		 * Mouse Pan Pointer Carousel Bar
		*/
		$('#carousel-bar, #carousel-pointer').mousedown(function(event){
			panPointer = true;
			ratio = (event.pageX-(widthWindow-widthContainer)/2)/widthContainer;
			//console.log(ratio);
			$('#carousel-gallery ul').css('left', -ratio*(widthCarousel-widthContainer));
			majCarouselPointer();
			//console.log('start Panning');
		});

		$(document).mouseup(function(){
			panPointer = false;
			//console.log('end Panning');
		});

		$(document).mousemove(function(event){
			if( panPointer ){
				ratio = (event.pageX-(widthWindow-widthContainer)/2)/widthContainer;
				if( ratio > 1) ratio = 1;
				if( ratio < 0) ratio = 0;
				$('#carousel-gallery ul').css('left', -ratio*(widthCarousel-widthContainer));
				majCarouselPointer();
			}
		});
		
		$(window).resize(function(){
			widthWindow = $(window).width();
			widthContainer = $('#event-photo').width();
			
			if( widthWindow < 1050 ){
				 $('#carousel-gallery ul').width(widthWindow);
				 $('#carousel-gallery img').each(function(){
					 $(this).parent('li').width( widthWindow );
				 });
			}
			else {
				widthCarousel = 0;
				$('#carousel-gallery img').each(function(){
					var ratioImg = getRatioImg(this);
					$(this).parent('li').width( heightCarousel*ratioImg );
					widthCarousel += $(this).parent('li').width()+1;
					$('#carousel-gallery ul').width(widthCarousel);
					console.log(widthCarousel);
				});
			}
			
		});

		function playCarousel(){
			//console.log('carousel play');
			if( !panPointer ){
				val = parseInt($('#carousel-gallery ul').css('left')) - moveCarousel * speedCarousel;
				if( val > 0 ) val = 0;
				if( val < -(widthCarousel-widthContainer) ) val = -(widthCarousel-widthContainer);
				$('#carousel-gallery ul').css('left', val );
				majCarouselPointer();
			}
		}

		function majCarouselPointer(){
			var ratio = - parseInt($('#carousel-gallery ul').css('left')) / (widthCarousel-widthContainer);
			//console.log(ratio);
			$('#carousel-bar #carousel-pointer').css('left', ratio*(widthContainer-$('#carousel-bar #carousel-pointer').width()));
		}

		function getRatioImg(_img){
			var img = $(_img);
			var theImage = new Image();
			theImage.src = img.attr("src");

			return theImage.width / theImage.height;
		}

	});
</script>