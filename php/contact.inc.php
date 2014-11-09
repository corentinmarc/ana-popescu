<section id="contact">
	
		<div id="mail-to">
			Mail to :
			<a id="mail-agent" data-email="ana.popescu@neymarcvisuals.com">My agent(US)</a><span>/</span>
			<a id="mail-agent-ro" data-email="dragos@bestromanianactors.ro">My agent(RO)</a><span>/</span>
			<a id="mail-press" data-email="ana_maria_tatu@yahoo.com">My press rep</a>
		</div>
		
    	<form  method="post" >
    	
    		<p class='remark'></p>
		
			<div id="name" class="small">
		
				<label>Name *&nbsp;:</label><br/>
				<input type="text" name="name" title="Your name" value=""/>
		
			</div>	
		
			<div id="email" class="small">
			
				<label>E-mail *&nbsp;:</label><br/>
				<input type="text" name="email" title="Your e-mail" value=""/>
			
			</div>	
			
			<div id="subject" class="large">
				
				<label>Subject *&nbsp;:</label><br/>
				<input type="text" name="subject" title="Subject of your message" value="" />
				
			</div>
		
			<div id="message" class="large">

				<label>Message *&nbsp;:</label><br/>
				<textarea name="message" title="Type your message here" cols="30" rows="10"></textarea>
			
			</div>
		
			<button name="submit" value="submit" type="submit">Submit</button>
			
			<div class="clear"></div>
			
		</form>
		
		<div id="rep">
			<img src="/img/contact/ny-bucharest.jpg" class="img-rep">
			
			<div id="talent-calc">
				<p class="rep-titre">Talent Representation, USA</p>
				<p class="rep-name">Andrew Neymarc</p>
				<p>Neymarc Visuals, LLC</p>
				<a href='http://www.neymarcvisuals.com'>www.neymarcvisuals.com</a>
				<p class="rep-city">New York City / New Jersey, USA</p>
			</div>
	
			<div id="press-calc">
			
				<p class="rep-titre">Talent Management, RO</p>
				<p class="rep-name">Dragos Bucur</p>
				<a href='http://www.bestromanianactors.ro/'>www.bestromanianactors.ro</a>
				<p>+40 743 096 508</p>
				<p>Romania</p>
				<br/>
				<p class="rep-titre">Press & Public Relations, RO</p>
				<p class="rep-name">Ana-Maria Tatu</p>
				<p>PR Representative</p>
				<p class="rep-city">Bucharest, Romania</p>
				
			</div>
			
			<div class="clear"></div>
		</div>

</section>

<script>

	$(document).ready(function(){

		$( "form" ).submit(function( event ) {
		  event.preventDefault();
		  $.ajax({
			  type: "POST",
			  url: "/php/contact-process.php",
			  dataType: 'json',
			  data: { 	name: $('#name input').val(), 
				  		email: $('#email input').val(),
				  		subject: $('#subject input').val(),
				  		message: $('#message textarea').val(),
				  		mailTo: $('#mail-to .active').attr('data-email')
				  	}
			})
			  .done(function( reponse ) {
				  	var remark = $('#contact .remark');
					window.scrollTo(0,0);
					if ( reponse.valid == true ){ // Le message est envoye RAZ des valeurs
						$(remark).html("Message send!").css("color", '#333');
						$('input, textarea').val('').removeClass('unvalid');
					}
					else{ // Un des champs requis est mal rempli, on s'assure que les champs bien rempli reprennent leurs precedentes valeurs et que les mauvais soient rouge
						$(remark).html("Please fill all the fields correctly.").css("color", '#c11b17');
						if( reponse.name == 'unvalid' ){
							$('#name input').addClass('unvalid');
						}
						else{
							$('#name input').val(reponse.name).removeClass('unvalid');
						}
						if( reponse.email == 'unvalid' ){
							$('#email input').addClass('unvalid');
						}
						else{
							$('#email input').val(reponse.email).removeClass('unvalid');
						}
						if( reponse.subject == 'unvalid' ){
							$('#subject input').addClass('unvalid');
						}
						else{
							$('#subject input').val(reponse.subject).removeClass('unvalid');
						}
						if( reponse.message == 'unvalid' ){
							$('#message textarea').addClass('unvalid');
						}
						else{
							$('#message textarea').val(reponse.message).removeClass('unvalid');
						}
					}
			  });
		});
		
		$("#mail-agent").addClass('active');

		$("#mail-to a").click(function(){
			$("#mail-to a").removeClass('active');
			$(this).addClass('active');
		});
	});

</script>