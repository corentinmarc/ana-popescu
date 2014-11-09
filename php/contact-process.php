<?php
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	$mailTo = $_POST['mailTo'];
	
	
	function verif_null($var){ // fonction qui verifie si le champs est vide
		if($var!=""){
			return $var;
		}
	}
	
	function verif_mail($var){ // fonction qui verifie si le mail est correct et si le champs est vide
		$code_syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#'; // chargement de la syntaxe mail valide
		if(preg_match($code_syntaxe,$var)){ // compare la syntaxe mail valide au mail saisie
			return $var;
		}
	}
	
	function envoi_mail($mailTo, $name, $email, $subject, $message){ //fonction qui envoie le mail
		$content = 	"Name : " . $name . "\n" .
					"Email : " . $email . "\n".
					"Subject : " . $subject . "\n".
					"Message : " . $message . "\n";
		$headers = "From: {$name} <{$email}>";
		
		mail ( $mailTo , $subject , $content, $headers);
	}
	
	function verif_form($mailTo, $name, $email, $subject, $message){ //fonction qui verifie si le formulaire est pret a etre envoyer
		if(verif_null($name) && verif_null($subject) && verif_null($message) && verif_mail($email)){ // verifie si toute les fontions sont a true
			envoi_mail($mailTo, $name, $email, $subject, $message);
			$valid=true; //Message envoyé
		}
		else{
			$valid=false; // Une erreur dans le formulaire
			if( !verif_null($name) ){
				$name='unvalid';
			}
			if( !verif_null($subject) ){
				$subject='unvalid';
			}
			if( !verif_null($message) ){
				$message='unvalid';
			}
			if( !verif_mail($email) ){
				$email='unvalid';
			}
		}
		$tableauReponse=array(
				"valid"=>$valid,
				"name"=>$name,
				"email"=>$email,
				"subject"=>$subject,
				"message"=>$message
		);
		$reponse=json_encode($tableauReponse);
		echo $reponse;
	}
	
	verif_form($mailTo, $name, $email, $subject, $message);
?>