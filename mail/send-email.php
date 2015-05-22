<?php

    require 'PHPMailerAutoload.php';
    $mail = new PHPMailer();;
    $mail->IsSMTP();
    $mail->Mailer = 'smtp';
    $mail->SMTPAuth = false;			// Valor original true
    $mail->Host = 'localhost'; 			// Valor original smtp.gmail.com "ssl://smtp.gmail.com" didn't worked
    $mail->Port = 25;					// Valor original 465
    //~ $mail->SMTPSecure = 'ssl';		// Descomentar para usar GMAIL
    // or try these settings (worked on XAMPP and WAMP):
     //$mail->Port = 587;
    //$mail->SMTPSecure = 'tls';
     
     
    $mail->Username = "";	// Datos del correo del admin
    $mail->Password = "";
     
    $mail->IsHTML(true); // if you are going to send HTML formatted emails
    $mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.
     
    $mail->From = $email;
    $mail->FromName = $nombre;
     
    $mail->addAddress( "s@localhost.dev" );		// Direccion del admin
    $mail->addAddress( $email );				// Copia para el remitente
     
    $mail->Subject = $asunto;
    $mail->Body = $mensaje;
     
	$mail->Send();
	
?>

