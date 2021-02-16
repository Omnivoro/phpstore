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
			
		// envia um email para o novo clinte no sentido de confirmar o email
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_OFF;           
			$mail->isSMTP();                                
			$mail->Host       = EMAIL_HOST;   				 
			$mail->SMTPSecure = 'tls';
			$mail->SMTPOptions = array('ssl' => array('verify_peer' => false,
									  				  'verify_peer_name' => false,
									  				  'allow_self_signed' => true
													));
			$mail->Port   = EMAIL_PORT;                                    
			
			//Recipients
			$mail->setFrom(EMAIL_FROM, APP_NAME);
			$mail->addAddress('refutable@gmail.com');     		 

			// Content
			$mail->isHTML(true);                                   
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