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
	 
		if( !empty($_POST['user']) && !empty($_POST['pass']) )
		{
			$consulta=$mysqli->query("SELECT admin FROM usuarios WHERE
									user='".$user."' and pass='".$pass."'");

			if( $consulta->num_rows )	// Si el número de filas es distinto de 0 ( true ).
			{
				$admin=$consulta->fetch_row();
				// Cierre de conexión.
				$mysqli->close();
				
				$_SESSION['user']=$user;
				$_SESSION['admin']=$admin[0];
				header("location:index.php");
			}
			else
				echo "<p id=error><span>Usuario o contraseña incorrecto!!</span></p>";
					
			}
	}
					
	echo "<p>Si no está registrado, puede hacerlo desde <a href=index.php?contenido=registro>aquí</a>.</p>";
	
	// Cierre de conexión.
	$mysqli->close();
	
	echo "</div>	<!-- end contenido -->";

?>
