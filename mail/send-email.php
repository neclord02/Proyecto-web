<?php
    require 'PHPMailerAutoload.php';
    $mail = new PHPMailer();;
    $mail->IsSMTP();
    $mail->Mailer = 'smtp';
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    // or try these settings (worked on XAMPP and WAMP):
     //$mail->Port = 587;
    //$mail->SMTPSecure = 'tls';
     
     
    $mail->Username = "";
    $mail->Password = "";
     
    $mail->IsHTML(false); // if you are going to send HTML formatted emails
    $mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.
     
    $mail->From = $email;
    $mail->FromName = $nombre;
     
    $mail->addAddress("");
     
    $mail->Subject = "[Mensaje de Web] ".$asunto;
    $mail->Body = $mensaje;
     
	$mail->Send();
?>