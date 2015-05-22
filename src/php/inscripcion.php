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

?>

<div class="contenido"> <!-- init contenido -->
	<h1>Inscripción</h1>
		
	<table class="tabla2">
       	<tr>
       		<th> Tipos de inscripción  </th>
			<th> Hasta el 31 de Marzo </th>
			<th> Del 1 de Abril al 1 de Mayo </th>
			<th> Durante el congreso </th>
		</tr>
		<tr>
			<td> Estudiante* </td>
			<td> 279 € </td>
			<td> 299 € </td>
			<td> 419 € </td>
		</tr>
		<tr class = "tdalt">
			<td> Profesor </td>
			<td> 399 € </td>
			<td> 449 € </td>
			<td> 599 € </td>
		</tr>
		<tr>
			<td> Invitado </td>
			<td> 499 € </td>
			<td> 649 € </td>
			<td> 699 € </td>
		</tr>
	</table>
        
	<p id="aviso">* Requisito indispensable adjuntar certificado o carnet de estudiante</p>
	<p>&nbsp;</p>
        
	<?php
	
				//~ $consulta=$mysqli->query("SELECT servicios+0 FROM cuotas WHERE
									//~ id=10 ");
				//~ $consulta=$consulta->fetch_row();
				
				//~ echo $consulta[0];
	
	
	
	
		if( isset( $_SESSION['user'] ) )
			echo "
				<p>Para inscribirse complete el siguiente formulario:</p>
				<form id=formulario action='#' method=POST enctype=multipart/form-data>
					<fieldset>
						<legend>Inscripción</legend>
						Nombre y apellidos:<br>
							<input name=action value=enviar type=hidden>
							<input name=nombre size=30 type=text>
						<br> Correo electrónico:<br>
							<input name=email size=30 type=text><br>
						<br>Tipo de inscripción<br>
						<select name=tipo>
							<option value=estudiante>Estudiante</option>
							<option value=profesor>Profesor</option>
							<option value=invitado>Invitado</option>
						</select>
						<br><br>Actividades extra:<br>
							<input name=a_extra size=30 type=checkbox value=alhambra> Visita a la Alhambra (40€)<br>
							<input name=a_extra size=30 type=checkbox value=sierra> Visita a Sierra Nevada (50€)<br>
						<br>
							<input value=Enviar type=submit>
					</fieldset>
				</form>
				<p>Para completar la inscripción, una vez haya recibido el email indicando el precio total, en
				el plazo de una semana deberá realizar un ingreso en la cuenta
				siguiente: <span>ES89 2367 22 0004561234</span>. Recibirá un email confirmando el pago.</p>";
		else
			echo "<p id=error><span>Para inscribirse debe estar identificado, puede hacerlo desde <a href=index.php?contenido=login>aquí</a></span></p>";
	
	// Cierre de conexión.
	$mysqli->close();
	
	?>
	</div>		<!-- end contenido -->
