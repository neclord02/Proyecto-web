<?php
	
	// Acceso a la BD	
	$servidor = "localhost";
	$usuario = "root";
	$passdb = "";
	$base_datos = "congreso";

	$conexion=mysql_connect($servidor,$usuario, $passdb) or die("<p id=error>Error en la conexión</p>");

	mysql_query("use $base_datos");

	mysql_select_db($base_datos,$conexion) or die("<br><br><h3 id=error>Error en la base de datos</h3><p><a href=index.php>Volver</a></p>");
	
?>

	<div class="contenido"> <!-- init contenido -->
       
       <h1>recuperar contraseña</h1>
       
       <p>Introduzca su dirección de email y le enviaremos una nueva contraseña.</p>
       
       	<form id="formulario" action="" method="POST" enctype="multipart/form-data">
			<fieldset>
			<input name="action" value="enviar" type="hidden">
			Correo electrónico:<br>
			<input name="email" size="30" type="text" id="email_content"><p id="error"></p>
			<input value="Enviar" type="button" onClick="check()">
			</fieldset>
		</form>
		<br>
    
	</div>		<!-- end contenido -->

<?php

	// Cierre de conexión.
	mysql_close($conexion);
	
?>
