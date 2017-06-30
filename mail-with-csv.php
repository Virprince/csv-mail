<?php
	require_once "./vendor/autoload.php";
	// require __DIR__."/validate.php";

	use Respect\Validation\Validator;
	use Respect\Validation\Exceptions\NestedValidationException;

	if ($_SERVER['REQUEST_METHOD']=== 'POST') {
		// data
	  $nom      = trim($_POST['nom']);
	  $prenom   = trim($_POST['prenom']);
	  $email    = trim($_POST['email']);
	  $choix    = trim($_POST['choix']);
	  $infos    = trim($_POST['infos']);

		// VALIDATIONS
		$emailValidator = Validator::email()->notEmpty();

		try {
			$emailValidator->assert($email);

			// TEST DONNEES
			// echo "<p>".$nom."</p>";
			// echo "<p>".$prenom."</p>";
			// echo "<p>".$email."</p>";
			// echo "<p>".$choix."</p>";

			// GENERATION DU CSV
				$list = array (
					array('nom', 'prenom', 'choix', 'email', 'infos'),
					array($nom, $prenom, $choix, $email, $infos)
				);

				// Nom du fichier et écriture

			  $fileName = "tmp/formulaire-".$nom."-".date("d-m-y-h:i:s").".csv";
				$fp = fopen( $fileName, 'w');
					foreach ($list as $fields) {
						// csv séparateur de champs ';' et séparateur de donnée ""
						fputcsv($fp, $fields , $delimiter = ';', $enclosure = '"');
				}
				fclose($fp);

			// ENVOI DU MAIL
				//PHPMailer Object
				$mail = new PHPMailer;
				$mail->CharSet = 'UTF-8';

				//From email address and name
				$mail->From = $email;
				$mail->FromName = $prenom." ".$nom;

				//To address and name
				$mail->addAddress("virginie@bernezac-communication.fr", "Reception");
				// $mail->addAddress("stephane@bernezac-communication.fr"); //Recipient name is optional

				//Address to which recipient will reply
				$mail->addReplyTo( $email, $prenom." ".$nom);

				//CC and BCC
				// $mail->addCC("cc@example.com");
				// $mail->addBCC("bcc@example.com");

				//Provide file path and name of the attachments
				$mail->addAttachment($fileName);

				//Send HTML or Plain Text email
				$mail->isHTML(true);

				$mail->Subject = "Résultats formulaire de contact: ".$nom;
				$mail->Body = "<h1>Formulaire de test</h1>
							<p>Nom: ".$nom."</p>
							<p>Prenom: ".$prenom."</p>
							<p>Email: ".$email."</p>
							<p>Choix: ".$choix."</p>
							<p>Infos: ".$infos."</p>
							<p>
								En pièce jointe le fichier .csv contenant les données du formulaire
							</p>
				";
				$mail->AltBody = "En pièce jointe le fichier .csv contenant les données du formulaire";

				if(!$mail->send())
				{
				    echo "Mailer Error: " . $mail->ErrorInfo;
				}
				else
				{
				    echo "<h2>Le message a été envoyé avec succès</h2>";
						// on supprime le fichier csv une fois l'envoi fait
						unlink($fileName);
				}

		} catch (NestedValidationException $e) {
			// affichage des erreurs sur le formulaire
			echo'<ul>';
			foreach ($e->getMessages() as $message) {
			 echo"<li>$message</li>";
			}
			echo'</ul>';
		}


	}
