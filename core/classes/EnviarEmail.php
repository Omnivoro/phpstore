<?php

namespace core\classes;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EnviarEmail{
	
	// ============================================================
    public function enviar_email_confirmacao_novo_cliente($email_cliente, $purl){
			
		// envia um email para o novo clinte no sentido de confirmar o email
	
		// constroi o purl (link para validação do email)
		$link = BASE_URL . '?a=confirmar_email&purl=' . $purl;
			
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
			$mail->CharSet    = 'UTF-8';
			
			//Recipients
			$mail->setFrom(EMAIL_FROM, APP_NAME);
			$mail->addAddress($email_cliente);     		 

			// Content
			$mail->isHTML(true);                                   
			$mail->Subject = APP_NAME . ' - Confirmação de email';
			
			$html = '<p>Seja bem-vindo a nossa loja ' . APP_NAME . '.</p>';
			$html .= '<p>Para poder entrar na nossa loja, necessita confirmar o seu email</p>';
			$html .= '<p>Para confirmar o email. click no link abaixo:</p>';
			$html .= '<p><a href="'.$link.'">Confirmar Email</a></p>';
			$html .= '<p><i><small>' . APP_NAME . '</small></i></p>';
				
			$mail->Body  = $html;
			
			$mail->send();
			return true;
		} catch (Exception $e) {
			return false;
		}		
	}
}
	
?>