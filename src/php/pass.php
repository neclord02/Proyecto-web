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
	
	
	$pass_inc=""; 	// Mensaje en caso de introducir incorrectamente la contraseña actual.
	$pass_dif=""; 	// Mensaje en caso de no ser iguales las nuevas contraseñas.
	$ok="";			// Mensaje confirmando el cambio de la contraseña.
	
	if(isset($_POST['enviar']))
	{
		$user=$_SESSION['user'];
		$pass=$_POST['pass'];
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];
	
		// Obtenemos en usuario y la contraseña del email introducido.
		$consulta=$mysqli->query("SELECT pass FROM usuarios WHERE
									user='$user' and pass='$pass' ");
			
		// Comprobar que son iguales el par de contraseñas.
		if( $pass1 != $pass2 )
			$pass_dif="<p id=error><span>Las nuevas contraseñas no son iguales.</span></p>";
		
		// Si la consulta devuelve un número de filas distinto de 0, la contraseña actual no es correcta.	
		else if( $consulta->num_rows )
		{
			
			if ( $mysqli->query( "UPDATE usuarios SET pass='$pass1'
									WHERE user='$user' " ) )
			{
				$ok="<p><span>Se ha enviado un email con su nueva contraseña.</span></p>";
				// Envío de email.				
				$nombre="WEB del congreso de CEIIE";
				$asunto="Cambio de contraseña";
				$mensaje="<p>Su nueva contrase&ntilde;a es: <b>$pass1</b>
						  <p>Saludos cordiales.</p>";
				include("./mail/send-email.php");	// Una vez comprobado el email del formulario, insertamos el									// código que manda el email con los mismos.
			}										// script que envia el email.
			else
				$pass_inc="<p id=error><span>Error al cambiar la contraseña, intentelo de nuevo más tarde.</span></p>";
		}
		else
			$pass_inc="<p id=error><span>Su contraseña actual no es correcta.</span></p>";

	}

?>

	<div class="contenido"> <!-- init contenido -->
       
       <h1>cambio de contraseña</h1>
       
       <p>Cuando el cambio se realice correctamente le enviaremos un email de confirmación.</p>
       
       	<form id="formulario" action="#" method="POST" enctype="multipart/form-data" >
			<fieldset>
			<br>
			Contraseña actual:<br>
			<input name="pass" size="25" type="text"  autofocus required >
			<br><br>
			Nueva contraseña:<br>
			<input name="pass1" size="25" type="text"  autofocus required >
			<br>
			Repita la nueva contraseña:<br>
			<input name="pass2" size="25" type="text"  autofocus required >
			<br><br>
			<input name='enviar' value="Enviar" type="submit" >
			</fieldset>
		</form>
		
		<br>
		<!-- Muestra un mensaje de error en caso de no existir el email -->
		<?php echo $pass_inc; echo $pass_dif; echo $ok; ?>
	</div>		<!-- end contenido -->

<?php

	// Cierre de conexión.
	$mysqli->close();
	
?>
