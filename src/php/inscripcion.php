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


	// Tabla de cuotas.
	// Obtener los importes de las cuotas.
	$consulta=$mysqli->query("SELECT importe FROM cuotas");
	for( $i=0; $i<$consulta->num_rows; $i++ ){
		$n=$consulta->fetch_row();
		$cuota[$i]=$n[0];
	}


	echo "
		<div class=contenido> <!-- init contenido -->
			<h1>Inscripción</h1>
				
			<table class=tabla2>
				<tr>
					<th> Tipos de inscripción  </th>
					<th> Hasta el 31 de Marzo </th>
					<th> Del 1 de Abril al 1 de Mayo </th>
					<th> Durante el congreso </th>
				</tr>
				<tr>
					<td> Estudiante* </td>
					<td> $cuota[0] € </td>
					<td> $cuota[3] € </td>
					<td> $cuota[6] € </td>
				</tr>
				<tr class>
					<td> Profesor </td>
					<td> $cuota[1] € </td>
					<td> $cuota[4] € </td>
					<td> $cuota[7] € </td>
				</tr>
				<tr>
					<td> Invitado </td>
					<td> $cuota[2] € </td>
					<td> $cuota[5] € </td>
					<td> $cuota[8] € </td>
				</tr>
			</table>
				
			<p id=aviso>* Requisito indispensable adjuntar certificado o carnet de estudiante</p>
			<p>&nbsp;</p>";


	// Formulario de inscripción.
	
	if( isset( $_POST['enviar'] ) ){
	
	
		if( isset( $_POST['a_extra'] ) ){
			$a_extra=$_POST['a_extra'];		// Array [0]=alhambra, [1]=sierra.
			echo "alh".$a_extra[0]." sie".$a_extra[1];
		}
	}



		if( isset( $_SESSION['user'] ) ){
			$user=$_SESSION['user'];
			echo "
				<p>Para inscribirse complete el siguiente formulario:</p>
				<form id=formulario action='#' method=POST enctype=multipart/form-data>
					<fieldset>
						<legend>Inscripción</legend>
						Nombre:<br>
							<input name=nombre size=30 type=text><br>
						Apellidos:<br>
							<input name=nombre size=30 type=text><br>
						<br>
						Correo electrónico:<br>";
							
							$consulta=$mysqli->query("SELECT email FROM usuarios WHERE user='$user'");
								$u=$consulta->fetch_row();
								echo "<input name=email size=30 type=text value=$u[0] ><br>";
						
						
				echo "
						Telefono:<br>
							<input name=email size=30 type=tel><br>
						<br>
						Centro de trabajo:<br>
							<input name=email size=30 type=text><br>
						<br>
						Tipo de inscripción:<br>
						<select name=cuota>";
						
							$consulta=$mysqli->query("SELECT denominacion,id,importe FROM cuotas");
							for( $i=0; $i<$consulta->num_rows; $i++ ){
								$c=$consulta->fetch_row();
								echo "<option value=$c[1]>$c[0], Precio: $c[2] €</option>";
							}	

				echo "</select>
						<br><br>Actividades extra:<br>";
							
							$consulta=$mysqli->query("SELECT denominacion,id,importe,descripcion FROM actividades");
							for( $i=0; $i<$consulta->num_rows; $i++ ){
								$a=$consulta->fetch_row();
								echo "<input name=a_extra[$i] type=checkbox value=1> $a[0] ($a[2] €)<br>
								<textarea rows=3 cols=60 id=mensaje readonly>$a[3]</textarea><br>";
							}
							
				echo "
						<br>
							<input name=enviar value=Inscribirse type=submit>
					</fieldset>
				</form>
				<p>Para completar la inscripción, una vez haya recibido el email indicando el precio total, en
				el plazo de una semana deberá realizar un ingreso en la cuenta
				siguiente: <span>ES89 2367 22 0004561234</span>. Recibirá un email confirmando el pago.</p>";
		}
		else
			echo "<p id=error><span>Para inscribirse debe estar identificado, puede hacerlo desde <a href=index.php?contenido=login>aquí</a></span></p>";

	
	// Cierre de conexión.
	$mysqli->close();
	
	?>
	</div>		<!-- end contenido -->
