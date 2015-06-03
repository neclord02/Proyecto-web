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
	$consulta=$mysqli->query("SELECT importe,descripcion FROM cuotas");
	for( $i=0; $i<$consulta->num_rows; $i++ ){
		$n=$consulta->fetch_row();
		$cuota[$i]=$n[0];
		//~ $desc[$i]=$n[1];
	}
//~ <p>&nbsp;</p>

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
	
	$info=""; // Mensaje de confirmación o error al inscribirse.
	
	if( isset( $_POST['enviar'] ) ){
		if( !$_POST['cuotas'] )
			
			$info="<br><br><b><span id=error >Debe seleccionar una inscripción.</span></b>";
		
		else{
			
			if( isset( $_POST['id'] ) )
				$id=$_POST['id'];
			else
				$id=0;
			
			if( isset( $_POST['nombre'] ) )
				$nombre=$_POST['nombre'];
			else
				$nombre=0;
			
			if( isset( $_POST['apellidos'] ) )
				$apellidos=$_POST['apellidos'];
			else
				$apellidos=0;
			
			if( isset( $_POST['email'] ) )
				$email=$_POST['email'];
			else
				$email=0;	
				
			if( isset( $_POST['c_trabajo'] ) )
				$c_trabajo=$_POST['c_trabajo'];
			else
				$c_trabajo=0;
			
			if( isset( $_POST['tlf'] ) )
				$tlf=$_POST['tlf'];
			else
				$tlf=0;
			
			if( isset( $_POST['id_cuota'] ) )
				$id_cuota=$_POST['id_cuota'];
			else
				$id_cuota=0;		
			
			if( isset( $_POST['docu_con'] ) )
				$docu_con=$_POST['docu_con'];
			else
				$docu_con=0;
			
			if( isset( $_POST['cert_as'] ) )
				$cert_as=$_POST['cert_as'];
			else
				$cert_as=0;
			
			if( isset( $_POST['comida_cafe'] ) )
				$comida_cafe=$_POST['comida_cafe'];
			else
				$comida_cafe=0;

			if( isset( $_POST['cena_gala'] ) )
				$cena_gala=$_POST['cena_gala'];
			else
				$cena_gala=0;		
			
			if( isset( $_POST['a_extra0'] ) )
				$alhambra=$_POST['a_extra0'];
			else
				$alhambra=0;
			
			if( isset( $_POST['a_extra1'] ) )
				$sierra=$_POST['a_extra1'];
			else
				$sierra=0;
			
			if( isset( $_POST['importe'] ) )
				$importe=$_POST['importe'];
			else
				$importe=0;				
	
	
			// Insertar los datos obtenidos en la tabla congresistas.
			
			if( $mysqli->query("INSERT INTO congresistas (id, nombre, apellidos, c_trabajo, tlf, email, id_cuota,docu_con, cert_as, comida_cafe, cena_gala, alhambra, sierra, importe ) VALUES ( '$id', '$nombre', '$apellidos', '$c_trabajo', '$tlf', '$email', '$id_cuota', '$docu_con', '$cert_as', '$comida_cafe', '$cena_gala', '$alhambra', '$sierra', '$importe' );") ){
				$info="<br><br><b>La inscripción se ha realizado correctamente.</b>";
				$address = 'index.php?contenido=hotelseleccion&importe='.$importe.'';
				header("Location: $address");
				
			}else
				$info="<br><br><b><span id=error >Error al realizar la inscripción. Inténtelo de nuevo más tarde.</span></b>";
		
		}
	}


	// Comprobar que hay un usuario "logueado".
	
		if( isset( $_SESSION['user'] ) ){
			$user=$_SESSION['user'];
			echo "
				<p>Para inscribirse complete el siguiente formulario:</p>
				<form id=formulario action='#' method=POST enctype=multipart/form-data>
					<fieldset>
						<legend>Inscripción</legend>
						Nombre:<br>
							<input name=nombre size=30 type=text autofocus required><br>
						Apellidos:<br>
							<input name=apellidos size=30 type=text required><br>
						<br>
						Correo electrónico:<br>";
							
							$consulta=$mysqli->query("SELECT email, id FROM usuarios WHERE user='$user'");
								$u=$consulta->fetch_row();
								echo "	<input name=id type=hidden value=$u[1] >
										<input name=email size=30 type=text value=$u[0] required ><br>";
						
						
				echo "
						Telefono:<br>
							<input name=tlf size=30 type=tel><br>
						<br>
						Centro de trabajo:<br>
							<input name=c_trabajo size=30 type=text><br>
						<br>";
						
				echo "
						<br>
						Tipo de inscripción:<br>
		
						
						<select name='cuotas' onchange='Info(this.value)'>
							<option value=0 >Seleccione</option>";
							$consulta=$mysqli->query("SELECT denominacion, id, importe FROM cuotas");
							for( $i=0; $i<$consulta->num_rows; $i++ ){
								$c=$consulta->fetch_row();
								echo "<option value=$c[1] >$c[0]</option>";
							}	

				echo "</select>
						<br>
					<!--  Aquí aparece la info de la inscripción y los servicios opcionales -->
						<span id=mostrar><br><textarea rows=3 cols=60 readonly>Para ver la descripción seleccione un tipo de inscripción.</textarea><br></span>
						<div id=importe></div>
					<!-- ------------------------------ -->
						<br>
					<input name=enviar value=Inscribirse type=submit>
					
					$info
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
