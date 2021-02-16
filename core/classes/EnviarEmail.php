<?php

namespace core\classes;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EnviarEmail{
	
	// ============================================================
    public function enviar_email_confirmacao_novo_cliente(){
			
		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;          // Enable verbose debug output
			$mail->isSMTP();                                // Send using SMTP
			$mail->Host       = 'localhost';   				// Set the SMTP server to send through
			$mail->SMTPSecure = 'tls';
			$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,
									  				  'verify_peer_name' => false,
									  				  'allow_self_signed' => true
													));
			$mail->Port   = 25;                                    // TCP port to connect to
			
			//Recipients
			$mail->setFrom('orlando@phpstore-svvtc.run-eu-central1.goorm.io', 'PHPSTORE');
			$mail->addAddress('refutable@gmail.com');     		// Add a recipient

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'PHPSTORE - Teste';
			$mail->Body    = 'Mensagem de teste <b>in bold!</b>';
			
			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}		
	}
}
	
?>