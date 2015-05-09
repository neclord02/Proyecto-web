<?php
	
	// Acceso a la BD	
	$servidor = "localhost";
	$usuario = "root";
	$passdb = "";
	$base_datos = "congreso";

	$conexion=mysql_connect($servidor,$usuario, $passdb) or die("<p id=error>Error en la conexión</p>");

	// Selección de la BD
	mysql_select_db($base_datos,$conexion) or die("<br><br><h3 id=error>Error en la base de datos</h3><p><a href=index.php>Volver</a></p>");


	echo "<div class=contenido>  <!-- init contenido -->
			
			<h1>login</h1>
			<p>&nbsp;</p>
	
		    <form id=formulario action='#' method=POST enctype=multipart/form-data >
			<fieldset>
			<legend>Datos de acceso</legend>
			<br>
			Usuario:<br>
			<input name=user size=25 type=text autofocus required ><br>
			<br>
			Contraseña:
			<br>
			<input name=pass size=25 type=password required >
			<a href=index.php?contenido=restablecer>Olvidé mi contraseña</a>
			<br>
			<br>
			<input name='enviar' value='Enviar' type='submit'>
			</fieldset>
			</form>
			<br>";
		
	// Si la consulta devuelve un número de filas diferente de 0, existe una tupla user-pass.
	// Guardamos en la sesión el nombre de usuario y se lleva al index.	
	if(isset($_POST['enviar']))
	{
		$user=$_POST['user'];
		$pass=$_POST['pass'];
	 
		if(!empty($_POST['user']) && !empty($_POST['pass']))
		{
			$consulta=mysql_query("select pass from usuarios where
									user='".$user."' and pass='".$pass."'");

			if(mysql_num_rows($consulta) != 0 )
			{
				$_SESSION['user']=$user;
				header("location:index.php");
			}
			else
				echo "<p id=error><span>Usuario o contraseña incorrecto!!</span></p>";
					
			}
	}
					
	echo "<p>Si no está registrado, puede hacerlo desde <a href=index.php?contenido=registro>aquí</a>.</p>";

	// Cierre de conexión.
	mysql_close($conexion);
	
	echo "</div>	<!-- end contenido -->";

?>
