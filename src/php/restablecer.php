<?php
	
	// Acceso a la BD	
	$servidor = "localhost";
	$usuario = "admin_congreso";
	$passdb = "ytT7Vqtz5pDRabjX";
	$base_datos = "congreso";

	// Conexión con el servidor.
	$mysqli = new mysqli( $servidor, $usuario, $passdb );
	if ( $mysqli->connect_errno ) {
		echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
	}
	
	// Selección de la BD
	if ( !$mysqli->select_db( "$base_datos" ) ) {
		echo "<br><br><h3 id=error>Error en la base de datos</h3><p><a href=index.php>Volver</a></p>";
	}
	
	
	$no_usuario=""; // Mensaje en caso de no existir el email.
	$ok="";			// Mensaje confirmando el envio de la contraseña.
	
	if(isset($_POST['enviar']))
	{
		$email=$_POST['email'];
	 

		// Obtenemos en usuario y la contraseña del email introducido.
		$consulta=$mysqli->query("SELECT user,pass FROM usuarios WHERE
									email='$email' ");
	

		// Datos de acceso en un array.
		$datos_acceso=$consulta->fetch_row();
			
		// Si la consulta devuelve un número de filas distinto de 0, el usuario existe en la BD.
		if( $consulta->num_rows )
		{

			$ok="<p><span>Se ha enviado un email con sus datos de acceso.</span></p>";
			// Envío de email.				
			$nombre="WEB del congreso de CEIIE";
			$asunto="Recuperar datos de acceso";
			$mensaje="<p>Su usuario es: <b>$datos_acceso[0]</b> y su contrase&ntilde;a: <b>$datos_acceso[1]</b>
					  <p>Saludos cordiales.</p>";
			include("./mail/send-email.php");	// Una vez comprobado el email del formulario, insertamos el									// código que manda el email con los mismos.
												// script que envia el email.
		}
		else
			$no_usuario="<p id=error><span>El email introducido no se encuentra en nuestra base de datos.</span></p>";

	}

?>

	<div class="contenido"> <!-- init contenido -->
       
       <h1>recuperar contraseña</h1>
       
       <p>Introduzca su dirección de email y le enviaremos una nueva contraseña.</p>
       
       	<form id="formulario" action="#" method="POST" enctype="multipart/form-data" >
			<fieldset>
			<br>
			Correo electrónico:<br>
			<input name="email" size="30" type="text" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$"  autofocus required >
			<br><br>
			<input name='enviar' value="Enviar" type="submit" >
			</fieldset>
		</form>
		
		<br>
		<!-- Muestra un mensaje de error en caso de no existir el email -->
		<?php echo $no_usuario; echo $ok; ?>
	</div>		<!-- end contenido -->

<?php

	// Cierre de conexión.
	$mysqli->close();
	
?>
