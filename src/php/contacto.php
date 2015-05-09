<?php
	
	// Envío de email.				
	if( isset($_POST["email"]) ){	// Si se establecido la variable "email" por $_POST
									// es porque la validación del email se ha hecho correctamente.
		$nombre=$_POST["nombre"];
		$email=$_POST["email"];
		$asunto="[Mensaje de Web] ".$_POST["asunto"];
		$mensaje=$_POST["mensaje"];
		
		include("./mail/send-email.php");	// Una vez obtenidos los datos del formulario, insertamos el									// código que manda el email con los mismos.
											// script que envia el email.
	}
?>

	<div class="contenido"> <!-- init contenido -->
       
       <h1>Contacto</h1>
       <a id="contacto"/>
       
       <p>Si tiene alguna pregunta o sugerencia, no dude en ponerse en contacto con nosotros.<br>
		Le contestaremos lo antes posible.</p>
		<br>
       	<form id="formulario" action="#" method="POST" enctype="multipart/form-data" >
			<fieldset>
			<legend>Contacto</legend>
			<br>
<!--
			<input name="action" value="enviar" type="hidden">
-->
			Su nombre:<br>
			<input name="nombre" size="30" type="text" autofocus required ><br><br>
			Su correo electrónico:<br>
			<input name="email" size="30" type="text" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required ><br><br>
			Asunto:<br>
			<input name="asunto" size="30" type="text" required ><br><br>
			Mensaje:<br>
			<textarea name="mensaje" rows="7" cols="75" id="mensaje" > </textarea>
			<br>
			<input value="Enviar" type="submit" >
			<br>
			</fieldset><br>
		</form>
       
	</div>		<!-- end contenido -->
