<?php
	
	if( $_SESSION['admin']!=1 )
		header("location:index.php");
		
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
       
       <h1>administración</h1>
       
		<div class="menu"> <!-- Botón de volver -->
			<ul class="nav">
				<li><a href="index.php?contenido=admin&opcion=cuotas">Cuotas</a></li>
				<li><a href="index.php?contenido=admin&opcion=congresistas">Ver congresistas</a></li>
				<li><a href="index.php?contenido=pass">Cambio de contraseña</a></li>
			</ul>
		</div>

<?php



  //~ echo "<tr>";
  //~ for($i=0;$i<mysql_num_fields($consulta);$i++)
    //~ {
     //~ echo "<th>",mysql_field_name($consulta,$i),"</th>";
    //~ }
  //~ echo "</tr>";
  //~ for($i=0;$i < mysql_num_rows($consulta);$i++)
            //~ {
             //~ echo "<tr>";
             //~ $fila=mysql_fetch_array($consulta);
             //~ for($c=0;$c < mysql_num_fields ($consulta);$c++)
                        //~ {
                         //~ echo "<td>",$fila[$c],"</td>";
                         //~ }
             //~ echo "</tr>";
            //~ }

	if( isset( $_GET['opcion'] ) )
	{
		if( $_GET['opcion']=='congresistas' ){
			echo "<p>&nbsp;</p>
				
				<table class=tabla3>
					<tr>
						<th> Nombre </th>
					</tr>
					";
					
					$consulta=$mysqli->query("SELECT nombre FROM congresistas");
					for( $i=0; $i<$consulta->num_rows; $i++ ){
						$n=$consulta->fetch_row();
						echo "<tr><td><a href=index.php?contenido=admin&opcion=congresistas&nombre=$n[0]>".$n[0]."</a></td></tr>";
					}


			echo "
		
				</table>";
				
			echo	
				"<table class=tabla3>
					<tr>
						<th> Información </th>
					</tr><td>
					";
					if( isset( $_GET['nombre'] ) )
					{
						$nombre=$_GET['nombre'];
						$consulta=$mysqli->query("SELECT id 'ID', nombre 'Nombre', email FROM congresistas WHERE nombre='$nombre' ");
						$i=0;
						$n=$consulta->fetch_row();
						$campos=$consulta->fetch_fields();
						foreach( $campos as $j ){
							echo "<p><span>".$j->name."</span>: ".$n[$i]."</p>";
							$i++;
						}
					}


			echo "
					</td></tr>
				</table>";
		}
		
		else if( $_GET['opcion']=='cuotas' )
			echo "
			
			<form id=formulario action=# method=POST enctype=multipart/form-data autocomplete=off >
			<fieldset>
			<legend>Estudiantes</legend>
			<br>
			Hasta el 31 de Mayo:<br><br>
			<input type=number name=est_31 min=0 max=1000 step=1 value=30 autofocus required ><br>
			<br>
			Contraseña:<br>
			<input name=pass size=20 type=password required ><br>
			<br>
			Correo electrónico:<br>
			<input name=email size=30 type=text autocomplete=on required ><br>
			<br>
			<input name=enviar value=Enviar type=submit>
			</fieldset>
		</form>";
	}
?>

<?php

	// Cierre de conexión.
	$mysqli->close();
	
?>
