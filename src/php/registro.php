<?php
	
	// Acceso a la BD	
	$servidor = "localhost";
	$usuario = "root";
	$passdb = "";
	$base_datos = "congreso";

	$conexion=mysql_connect($servidor,$usuario, $passdb) or die("<p id=error>Error en la conexión</p>");

	mysql_query("use $base_datos");

	mysql_select_db($base_datos,$conexion) or die("<br><br><h3 id=error>Error en la base de datos</h3><p><a href=index.php>Volver</a></p>");
	
	
	$user_exist=""; 	// Mensaje en caso de existir el usuario.
	$email_exist=""; 	// Mensaje en caso de existir el email.
	$error_insert="";	// Mensaje en caso de no poder insertar el usuario.
	$ok="";				// Mensaje confirmando el registro del nuevo usuario.
	
	if(isset($_POST['enviar']))
	{
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		$email=$_POST['email'];
		
		// Comprobamos que el usuario y el email no estén ya en la BD.
		$consulta_user=mysql_query("select user from usuarios where
									user='$user' ");
									
		$consulta_email=mysql_query("select email from usuarios where
									email='$email' ");
		
		
		// Si la consulta devuelve un número de filas distinto de 0, el usuario existe en la BD.
		if(mysql_num_rows($consulta_user) != 0 )
			
			$user_exist="<p id=error><span>El nombre de usuario introducido ya se encuentra en nuestra base de datos.</span></p>";
		
		if(mysql_num_rows($consulta_email) != 0)
		
			$email_exist="<p id=error><span>El email introducido ya se encuentra en nuestra base de datos.</span></p>";
		
		if(mysql_num_rows($consulta_user) == 0 && mysql_num_rows($consulta_email) == 0){
			
			// Insertamos los datos.
			mysql_query("INSERT INTO congreso.usuarios (email, user, pass) 
							VALUES ('$email', '$user', '$pass'); ");
			
			// Comprobamos que el "insert" se ha realizado correctamente
			$consulta=mysql_query("select user,email from usuarios where
									user='$user' and email='$email' ");
			// Datos de acceso en un array.
			$datos_acceso=mysql_fetch_array($consulta);
			
			if(mysql_num_rows($consulta) != 0 )
			{			
			
				$ok="<p><span>El registro se ha realizado correctamente.</span></p>";
				// Envío de email.				
				$nombre="WEB del congreso de CEIIE";
				$asunto="Registro de usuario";
				$mensaje="<h2>Gracias por registrarse</h2>
						  <p>Su usuario es: <b>$datos_acceso[0]</b> y su contrase&ntilde;a: <b>$datos_acceso[1]</b>
						  <p>Saludos cordiales.</p>";
				include("./mail/send-email.php");	// Una vez añadido el nuevo usuario en la BD, insertamos el									// código que manda el email con los mismos.
													// script que envia el email.
			}
			else
				$error_insert="<p id=error><span>Error al crear el usuario, intentelo de nuevo más tarde.</span></p>";
		}

	}

?>

	<div class="contenido"> <!-- init contenido -->
		<h1>Nuevo usuario</h1>

        <p>Para registrarse complete el siguiente formulario:</p>
       	
       	<form id="formulario" action="#" method="POST" enctype="multipart/form-data" autocomplete="off" >
			<fieldset>
			<legend>Registro</legend>
			<br>
			Nombre de usuario:<br>
			<input name="user" size="20" type="text"  autofocus required ><br>
			<br>
			Contraseña:<br>
			<input name="pass" size="20" type="password" required ><br> <!-- poner un patern...-->
			<br>
			Correo electrónico:<br>
			<input name="email" size="30" type="text" autocomplete="on" required ><br>
			<br>
			<input name="enviar" value="Enviar" type="submit">
			</fieldset>
		</form>
		
		<!-- Muestra un mensaje de error en caso de no poder insertar los datos o de existir el usuario o el email -->
		<?php echo $user_exist; echo $email_exist; echo $error_insert; echo $ok; ?>
		<p>Recibirá un email de confirmación cuando el registro se realice correctamente.</p>
       
	</div>		<!-- end contenido -->

<?php

	// Cierre de conexión.
	mysql_close($conexion);
	
?>
