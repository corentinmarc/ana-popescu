<section id="home">

	<div id="img-container">
		<div class="img-wrapper" id="img-wrapper-1">
			<a href="/gallery">
				<p class="etiquette">Gallery</p>
				<img id="img1" src="/img/home/1.jpg" />
			</a>
		</div>
		<div class="img-wrapper" id="img-wrapper-2">
			<a href="/about">
				<p class="etiquette">About</p>
				<img id="img2" src="/img/home/2.jpg" />
			</a>
		</div>
		<div class="img-wrapper" id="img-wrapper-3">
			<a href="/video">
				<p class="etiquette">Video</p>
				<img id="img3" src="/img/home/3.jpg" />
			</a>
		</div>
	</div>
	
</section>

<script>
	$(document).ready(function(){
		imgContainer = $('#img-container');
		img1 = $('#img-wrapper-1'), img2 = $('#img-wrapper-2'), img3 = $('#img-wrapper-3');
		ratioLimit = 1.7;
		border = 30;
		borderInterior = 10;

		resizing();

		function resizing(){
			heightUseful = $('html').height() - $('header').height() - 2*border;
			widthUseful = $('html').width() - 2*border;
			ratioUseful = widthUseful / heightUseful;
			//console.log(ratioUseful);
			
			// Limité par la hauteur
			if( ratioUseful > ratioLimit ){
				$(imgContainer).height(heightUseful);
				$(imgContainer).width(heightUseful*ratioLimit);
				$(imgContainer).css({'marginTop': border, 'marginLeft': ( $('html').width()-$(imgContainer).width() ) / 2 });
			}
			// Limité par la largeur
			else{
				$(imgContainer).width(widthUseful);
				$(imgContainer).height(widthUseful/ratioLimit);
				$(imgContainer).css({'marginTop': ( $('html').height()-$('header').height()-$(imgContainer).height() ) / 2 , 'marginLeft': border });
			}

			// Dimensionnement des images
			$(img1).width(0.6*$(imgContainer).width() - borderInterior/2);
			$(img2).width(0.6*$(imgContainer).width() - borderInterior/2);
			$(img3).width(0.4*$(imgContainer).width() - borderInterior/2);
			
			$(img1).height(0.6*$(imgContainer).height() - borderInterior/2);
			$(img2).height(0.4*$(imgContainer).height() - borderInterior/2);
			$(img3).height($(imgContainer).height());

			// Resize lin-height
			$('.etiquette').each(function(){
				$(this).css({'lineHeight': $(this).parents('.img-wrapper').height()+'px', 'font-size': $(this).parents('.img-wrapper').height()/10});
				//console.log($(this).parents('.img-wrapper').height());
			});
		}

		$(window).resize(function(){
			resizing();
		});
		
	});
</script>