<?php
	
	// Acceso a la BD	
	$servidor = "localhost";
	$usuario = "root";
	$passdb = "";
	$base_datos = "congreso";

	$conexion=mysql_connect($servidor,$usuario, $passdb) or die("<p id=error>Error en la conexión</p>");

	// Si no existe crear una nueva BD
	if(!mysql_query("use $base_datos"))
	{
	   mysql_query ("create database $base_datos");
	}


	mysql_select_db($base_datos,$conexion) or die("<br><br><h3 id=error>Error en la base de datos</h3><p><a href=index.php>Volver</a></p>");

	// Si la tabla "credenciales" no existe, crearla.
	if(!mysql_query("select * from credenciales"))
	{
		mysql_query("create table credenciales
				   (
					user varchar ( 50 ) key,
					email varchar ( 50 ),
					pass varchar( 10 )
					)
					");
	}

	// Indicar al usuario que faltan datos por completar para el login.
	$errorUser="";
	$errorPass="";
	$user="";
	$pass="";

	if(!isset($_POST['user']))
	{}
	else if(!empty($_POST['user']))
	  $user=$_POST['user'];
	else
	  $errorUser='¡Debe introducir el usuario!';

	if(!isset($_POST['pass']))
	{}
	else if(!empty($_POST['pass']))
	  $pass=$_POST['pass'];
	else
	  $errorPass='¡Debe introducir la contraseña!';


	echo "<div class=contenido>  <!-- init contenido -->
			
			<h1>login</h1>
			<p>&nbsp;</p>
	
		    <form id=formulario action='#' method=POST>
			<fieldset>
			<legend>Datos de acceso</legend>
			<br>
			Usuario:<br>
			<input name=user value='$user' size=25 type=text><br>
			<h7 id=error>$errorUser</h7>
			<br>
			<br>
			Contraseña:
			<br>
			<input name=pass value='$pass' size=25 type=password>
			<a href=index.php?contenido=restablecer>Olvidé mi contraseña</a>
			<br>
			<h7 id=error>$errorPass</h7>
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
			$consulta=mysql_query("select pass from credenciales where
									user='".$user."' and pass='".$pass."'");

			if(mysql_num_rows($consulta) != 0 )
			{
				$_SESSION['user']=$user;
				header("location:index.php");
			}
			else
				echo "<p id=error>Usuario o contraseña incorrecto!!</p>";
					
			}
	}
					
	echo "<p>Si no está registrado, puede hacerlo desde <a href=index.php?contenido=registro>aquí</a>.</p>";

	// Cierre de conexión.
	mysql_close($conexion);
	
	echo "</div>	<!-- end contenido -->";

?>
