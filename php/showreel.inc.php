<section id="showreel">

	<iframe width="640" height="360" src="//www.youtube.com/embed/mjLqWqXpTR8?autoplay=1&controls=1&modestbranding=1&rel=0&showinfo=0&autohide=1" frameborder="0" allowfullscreen></iframe>
	
	<a href='/video' id='more-video'>More Video ></a>
	
	<div id='credits'>
		<h2>Credits :</h2>
		<p>Music by <a href='http://www.youtube.com/user/MoonlightBreakfast' target='_blank'>Moonlight Breakfast</a></p>
		<p>Reel by <a href='http://neymarcvisuals.com' target='_blank'>Neymarc Visuals</a></p>
	</div>
	
</section>

<script>

$(document).ready(function(){

	resizing();

	function resizing(){
		$('iframe').height(( $('iframe').width()*0.6 ));
	}
	
	$(window).resize(function(){
		resizing();
	});

});

</script>