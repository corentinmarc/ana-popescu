<section id="video">

	<div id="video-nav">
		<a id="commercials">Commercials</a><span>/</span>
		<a id="films">Films</a>
	</div>
	
	<div id="video-bandeau">
		<div id="video-previous"><</div>
		<h2 id='video-title'></h2>
		<div id="video-next">></div>
	</div>
	
	<div id="player" class="youtube-frame"></div>
	
	<div class="video-wrapper" data-videoId="kqzFqh532c0" data-category="commercials">
		<h3 class='title'>Toyota Commercial</h3>
		<img src='/img/video/toyota-escape.jpg'/>
	</div>

	<div class="video-wrapper" data-videoId="WzlqpvkFkP8" data-category="commercials">
		<h3 class='title'>Linak USA- The wellness Switch commercial</h3>
		<img src='/img/video/linak-welness.jpg'/>
	</div>

	<div class="video-wrapper" data-videoId="iJ6k9oG0xjM" data-category="commercials">
		<h3 class='title'>European Citizens Rights 1</h3>
		<img src='/img/video/euro-citizen-right1.jpg'/>
	</div>
	
	<div class="video-wrapper" data-videoId="Ik-MBqJCScM" data-category="commercials">
		<h3 class='title'>European Citizens Rights 2</h3>
		<img src='/img/video/euro-citizen-right2.jpg'/>
	</div>
	
	<div class="video-wrapper" data-videoId="jpvTts7OamA" data-category="commercials">
		<h3 class='title'>Amigo Coffee</h3>
		<img src='/img/video/amigo.jpg'/>
	</div>

	<div class="video-wrapper" data-videoId="WWXPs99_CB4" data-category="commercials">
		<h3 class='title'>Tabu Magazine</h3>
		<img src='/img/video/tabu.jpg'/>
	</div>

	<div class="video-wrapper" data-videoId="x-091iEnj6I" data-category="commercials">
		<h3 class='title'>Lenor Commercial</h3>
		<img src='/img/video/lenor.jpg'/>
	</div>
	
	
	<div class="video-wrapper" data-videoId="l-2A-GJyC4c" data-category="films">
		<h3 class='title'>Chasing Rainbows (2012)</h3>
		<img src='/img/video/chasing.jpg'/>
	</div>
	
	<div class="video-wrapper" data-videoId="oRDGAMi2ayc" data-category="films">
		<h3 class='title'>Hello!How are you? (2010)</h3>
		<img src='/img/video/hello.jpg'/>
	</div>
	
	<div class="video-wrapper" data-videoId="7mJNYSV-OXc" data-category="films">
		<h3 class='title'>Blood Creek (2009)</h3>
		<img src='/img/video/blood-creek.jpg'/>
	</div>
	
	<div id='video-other'>
		<h2></h2>
	</div>
	
	
</section>

<script>

$(document).ready(function() {

	//Youtube Player iframe
	var playerObj;
	var player = {
	    playVideo: function(container, videoId) {
	      if (typeof(YT) == 'undefined' || typeof(YT.Player) == 'undefined') {
	        window.onYouTubeIframeAPIReady = function() {
	          player.loadPlayer(container, videoId);
	        };
	
	        $.getScript('//www.youtube.com/iframe_api');
	      } else {
	        player.loadPlayer(container, videoId);
	      }
	    },
	
	    loadPlayer: function(container, videoId) {
	      	playerObj = new YT.Player(container, {
	        videoId: videoId,
	        width: 356,
	        height: 200,
	        playerVars: {
	          autoplay: 1,
	          controls: 1,
	          modestbranding: 1,
	          rel: 0,
	          showinfo: 0,
	          suggestedQuality: 'hd720',
	          autohide: 1
	        },
	        events: {
	            'onReady': onPlayerReady,
	            'onStateChange': onPlayerStateChange
	          }
	      });
	    }
	};
	
	function onPlayerReady(event) {
		resizing();
		//console.log('player ready');
	}
	
	function onPlayerStateChange(event) {
		//console.log('player state change : '+event.data);
		// Si la video se termine on enchaine avec la suivante
		if( event.data == 0 ){
			$('#video-next').click();
		}
	}


	init();

	function init() {
		//console.log($('.video-wrapper:first').attr('data-videoId'));
		currentNav = 'commercials';
		$('#video-nav #commercials').addClass('active');
		player.playVideo($('#player').get(0), $('.video-wrapper:first').attr('data-videoId'));
		$('.video-wrapper:first').addClass('active');
		resizing();
		majTitleNav();
	}

	// Nav entre commercials et films
	$('#video-nav a').on('click', function(){
		//console.log($(this).attr('id'));
		currentNav = $(this).attr('id');
		$('#video-nav a').removeClass('active');
		$(this).addClass('active');
		$('.video-wrapper').removeClass('active');
		$('.video-wrapper[data-category='+currentNav+']:first').addClass('active');
		playerObj.loadVideoById($('.video-wrapper.active').attr('data-videoId'));
		majTitleNav();
	});

	// Nav des videos autres
	$('#video-other').on('click', '.container', function(){
		console.log($(this).attr('data-videoId'));
		videoId = $(this).attr('data-videoId');
		$('.video-wrapper').removeClass('active');
		$('.video-wrapper[data-videoId='+videoId+']').addClass('active');
		playerObj.loadVideoById($('.video-wrapper.active').attr('data-videoId'));
		majTitleNav();
		window.scrollTo(0,0);
	});

	// Mise a jour du titre et des next et prev video
	function majTitleNav(){
		//Mise à jour du bandeau (titre, next et previous)
		$('.video-wrapper').removeClass('next');
		$('.video-wrapper').removeClass('prev');
		$('#video-title').html($('.video-wrapper[data-category='+currentNav+'].active h3').html());
		if( $('.video-wrapper.active').next('.video-wrapper[data-category='+currentNav+']').length ){
			$('.video-wrapper.active').next('.video-wrapper[data-category='+currentNav+']').addClass('next');
		}
		else{
			$('.video-wrapper[data-category='+currentNav+']:first').addClass('next');
		}
		if( $('.video-wrapper.active').prev('.video-wrapper[data-category='+currentNav+']').length ){
			$('.video-wrapper.active').prev('.video-wrapper[data-category='+currentNav+']').addClass('prev');
		}
		else{
			$('.video-wrapper[data-category='+currentNav+']:last').addClass('prev');
		}

		//Mise à jour de la section video autres
		$('#video-other').html('<h2>Other '+currentNav+' :</h2>');
		$('.video-wrapper[data-category='+currentNav+']:not(.active)').each(function(){
			container = $('<div class="container" data-videoId='+$(this).attr('data-videoId')+'></div>');
			$('#video-other').append(container);
			$(container).append($(this).find('img').clone());
			$(container).append($(this).find('h3').clone());
		});
		$('#video-other').append('<div class="clear"></div>');
	}

	// Change video on next click
	$('#video-next').on('click', function(){
		//console.log($('.video-wrapper.next').attr('data-videoId'));
		playerObj.stopVideo();
		$('#player').animate( {left: -$('body').width()}, 500, function(){
			$('#player').css({left: 'auto', right: -$('body').width()});
			playerObj.loadVideoById($('.video-wrapper.next').attr('data-videoId'));
			$('.video-wrapper').removeClass('active');
			$('.video-wrapper.next').addClass('active');
			majTitleNav();
			$('#player').animate( {right: 0}, 500, function(){
			});
		});
	});

	// Change video on prev click
	$('#video-previous').on('click', function(){
		//console.log($('.video-wrapper.prev').attr('data-videoId'));
		playerObj.stopVideo();
		$('#player').animate( {left: $('body').width()}, 500, function(){
			$('#player').css({left: -$('body').width()});
			playerObj.loadVideoById($('.video-wrapper.prev').attr('data-videoId'));
			$('.video-wrapper').removeClass('active');
			$('.video-wrapper.prev').addClass('active');
			majTitleNav();
			$('#player').animate( {left: 0}, 500, function(){
			});
		});
	});

	function resizing(){
		$('.youtube-frame').height($('.youtube-frame').width()*0.6);
	}

	$(window).resize(function(){
		resizing();
	});

});

</script>