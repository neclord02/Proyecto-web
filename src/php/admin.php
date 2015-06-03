<?php
	
	if( $_SESSION['admin']!=1 )
		header("location:index.php");
		
	// Acceso a la BD.
	$servidor = "localhost";
	$usuario = "admin_congreso";
	$passdb = "ytT7Vqtz5pDRabjX";
	$base_datos = "congreso";

	// Conexión con el servidor.
	$mysqli = new mysqli( $servidor, $usuario, $passdb );
	if ( $mysqli->connect_errno ) {
		echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
	}
	
	// Selección de la BD.
	if ( !$mysqli->select_db( "$base_datos" ) ) {
		echo "<br><br><h3 id=error>Error en la base de datos</h3><p><a href=index.php>Volver</a></p>";
	}

	
	// Botón seleccionado.
	$c_cuo="";
	$c_con="";
	if( isset( $_GET['opcion'] ) )
	{
		if( $_GET['opcion']=='cuotas' )
			$c_cuo="current";
		if( $_GET['opcion']=='congresistas' )
			$c_con="current";
	}


	// Menú del admin.
	echo "
		<div class=contenido> <!-- init contenido -->
		   
		   <h1>administración</h1>
		   
			<div class=menu> <!-- Botón de volver -->
				<ul class=nav>
					<li class='$c_cuo' ><a href=index.php?contenido=admin&opcion=cuotas>Cuotas</a></li>
					<li class='$c_con' ><a href=index.php?contenido=admin&opcion=congresistas>Ver congresistas</a></li>
					<li><a href=index.php?contenido=pass>Cambio de contraseña</a></li>
				</ul>
			</div>";


	if( isset( $_GET['opcion'] ) )
	{
		// Ver congresistas.
		if( $_GET['opcion']=='congresistas' ){
			echo "
					<p><b>Escriba las primeras letras del nombre del congresista:</b></p>
					<form action=> 
					<p><input type=text onkeyup=Buscar(this.value)></p>
					</form>
					<p>Resultados: <span id=busca></span></p>
				
				<p>&nbsp;</p>
				<table class=tabla3 id=cong>
					<tr >
						<th> Nombre </th>
					</tr>
					";

					$consulta=$mysqli->query("SELECT nombre, id FROM congresistas");
					for( $i=0; $i<$consulta->num_rows; $i++ ){
						$n=$consulta->fetch_row();
						$tdalt="";
						if( isset( $_GET['nombre'] ) )
							if( $_GET['nombre']==$n[0] )
								$tdalt="tdalt";
						echo "<tr><td class=$tdalt><a href=index.php?contenido=admin&opcion=congresistas&nombre=$n[1]>".$n[0]."</a></td></tr>";
					}
			echo "
				</table>";
				
			echo	
				"<table class=tabla3 id=info>
					<tr>
						<th > Información </th>
					</tr>
					<tr>
					<td id=info>
					";
					if( isset( $_GET['nombre'] ) )
					{
						$nombre=$_GET['nombre'];
						$consulta=$mysqli->query("SELECT id 'ID', nombre 'Nombre', email 'Email' FROM congresistas WHERE id='$nombre' ");
						$i=0;
						$n=$consulta->fetch_row();
						$campos=$consulta->fetch_fields();
						foreach( $campos as $j ){
							echo "<p><span>".$j->name."</span>: ".$n[$i]."</p>";
							$i++;
						}
					}
					else
						echo "<p>Seleccione un nombre de la lista</p>";



			echo "
					</td></tr>
				</table>
				<p>&nbsp;</p>";
		}
		
		// Modificar precios de cuotas y actividades.
		else if( $_GET['opcion']=='cuotas' )
		{
			$ok="";
			if( isset( $_POST['enviar'] ) )
			{
				// Actualizar los importes de las actividades.
				for( $i=0; $i<2; $i++ ){
					$act[$i]=$_POST['act'.$i];
					$mysqli->query("UPDATE actividades SET importe='$act[$i]'
									WHERE id='$i'+1 ");
				}
				// Actualizar los importes de las cuotas.
				for( $i=0; $i<9; $i++ ){
					$cuota[$i]=$_POST['cuota'.$i];
					$mysqli->query("UPDATE cuotas SET importe='$cuota[$i]'
									WHERE id='$i'+1 ");
				}
				$ok="<p><span>Precios actualizados correctmente.</span></p>";
			}
			
			// Obtener los importes de las cuotas.
			$consulta=$mysqli->query("SELECT importe FROM cuotas");
			for( $i=0; $i<$consulta->num_rows; $i++ ){
				$n=$consulta->fetch_row();
				$cuota[$i]=$n[0];
			}
			
			// Obtener los importes de las actividades.
			$consulta=$mysqli->query("SELECT importe FROM actividades");
			for( $i=0; $i<$consulta->num_rows; $i++ ){
				$n=$consulta->fetch_row();
				$act[$i]=$n[0];
			}
				
			echo "<p>&nbsp;</p>
				<form id=formulario action=# method=POST enctype=multipart/form-data autocomplete=off >
					<fieldset>
					<legend>Estudiantes __________ Profesores __________ Invitados</legend>
					<br>
					Hasta el 31 de Marzo:<br>
					<input type=number name=cuota0 min=0 max=1000 step=1 value='$cuota[0]' autofocus required >
					<input type=number name=cuota1 min=0 max=1000 step=1 value='$cuota[1]' autofocus required >
					<input type=number name=cuota2 min=0 max=1000 step=1 value='$cuota[2]' autofocus required >
					<br><br>
					Del 1 de Abril al 1 de Mayo:<br>
					<input type=number name=cuota3 min=0 max=1000 step=1 value='$cuota[3]' autofocus required >
					<input type=number name=cuota4 min=0 max=1000 step=1 value='$cuota[4]' autofocus required >
					<input type=number name=cuota5 min=0 max=1000 step=1 value='$cuota[5]' autofocus required >
					<br><br>
					Durante el congreso :<br>
					<input type=number name=cuota6 min=0 max=1000 step=1 value='$cuota[6]' autofocus required >
					<input type=number name=cuota7 min=0 max=1000 step=1 value='$cuota[7]' autofocus required >
					<input type=number name=cuota8 min=0 max=1000 step=1 value='$cuota[8]' autofocus required >
					<br><br><br>
					Visita a la Alhambra:<br>
					<input type=number name=act0 min=0 max=1000 step=1 value='$act[0]' autofocus required >
					<br><br>
					Excursión a Sierra Nevada:<br>
					<input type=number name=act1 min=0 max=1000 step=1 value='$act[1]' autofocus required >
					<br><br>
					<br>
					<input name=enviar value='Actualizar precios' type=submit>
					</fieldset>
				</form>
				<p>&nbsp;</p>$ok";
		}
	}
?>

<?php

	// Cierre de conexión
