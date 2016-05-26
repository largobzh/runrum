<?php

namespace Outils;
class Outils
{

	static function envoiMail($lien,$from,$sentTo,$Subject,$body)
	{       
		$mail = new \PHPMailer;

		//$mail->SMTPDebug = 3;                                 // Enable verbose debug output

		$mail->isSMTP();   
		$mail->CharSet = "UTF-8";                               // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
		// $mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;                                 // Enable SMTP authentication
		$mail->Username = $from;               					// SMTP username
		$mail->Password = 'Romane02';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465;                                      // TCP port to connect to

		$mail->setFrom($from );
		$mail->addAddress($sentTo);                              // Add a recipient
		// $mail->addAddress('ellen@example.com');               // Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Activer votre compte sur runrum';
		$mail->Body    = 'Bonjour, activer votre compte : ' .  $lien . '  >'; 
		$mail->Subject = $Subject;
		$mail->Body    = $body;

		return($mail->send()) ? true : false;

	}
	
}
