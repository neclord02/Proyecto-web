<?php
//____________________________________Práctica 5_________________________________-
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

	//______________________________________________________________________________________________
	
	if( isset( $_GET['info'] ) )
	{
		
	// Obtener el código de cuota de la página inscripción a traves del script "Info" 
	$cuota = $_GET['info'];
	
	$consulta=$mysqli->query("SELECT importe, descripcion, docu_con, cert_as, comida_cafe, cena_gala 
								FROM cuotas WHERE id='$cuota'");
	$n=$consulta->fetch_row();
	$importe=$n[0];
	$descripcion=$n[1];
	$docu_con=$n[2];
	$cert_as=$n[3];
	$comida_cafe=$n[4];
	$cena_gala=$n[5];
	
	echo "	<br>Descripción: 
			<br><textarea rows=3 cols=60 readonly>$descripcion</textarea><br>
			<br><b>Servicios incluidos</b>:<br>
			
			<input type=hidden name=id_cuota value=$cuota >
			<input type=hidden name=importe value=$importe >";
			
			
	if( !$docu_con )
		echo "<input type=checkbox id=docu_con checked disabled>Documentacón para el congreso.<br>";
	else
		echo "<input name=docu_con id=docu_con type=checkbox value=$docu_con onchange=InfoCheck(this.checked)>Documentacón para el congreso ($docu_con €)<br>";
		
	if( !$cert_as )
		echo "<input type=checkbox id=cert_as checked disabled>Certificado de asistencia.<br>";
	else
		echo "<input name=cert_as id=cert_as type=checkbox value=$cert_as onchange=InfoCheck(this.checked)>Certificado de asistencia ($cert_as €)<br>";
	
	if( !$comida_cafe )
		echo "<input type=checkbox id=comida_cafe checked disabled>Almuerzos y meriendas.<br>";
	else
		echo "<input name=comida_cafe id=comida_cafe type=checkbox value=$comida_cafe onchange=InfoCheck(this.checked)>Almuerzos y meriendas ($comida_cafe €)<br>";
	
	if( !$cena_gala )
		echo "<input type=checkbox id=cena_gala checked disabled>Cena de gala.<br>";
	else
		echo "<input name=cena_gala id=cena_gala type=checkbox value=$cena_gala onchange=InfoCheck(this.checked)>Cena de gala ($cena_gala €)<br>";
	
	// ***** //
		
	echo	"<br><br><b>Actividades extra</b>:<br>";		
			$consulta=$mysqli->query("SELECT denominacion,id,importe,descripcion,foto FROM actividades");
			for( $i=0; $i<$consulta->num_rows; $i++ ){
				$a=$consulta->fetch_row();
				echo "<input name=a_extra$i id=a_extra$i type=checkbox value=$a[2] onchange=InfoCheck(this.checked)> $a[0] ($a[2] €)<br>
				<textarea rows=4 cols=50 id=mensaje readonly>$a[3]</textarea>
				<img id=act$i title=$a[0] alt=foto_act$i src=$a[4] /><br><br>";
			}
		
	echo "<p>&nbsp;</p>";
		
			
	}

	//______________En pruebas____________________
			
	if( isset( $_GET['docu_con'] ) )
		$docu=$_GET['docu_con'];
	else
		$docu=0;
	
	if( isset( $_GET['cert_as'] ) )
		$cert=$_GET['cert_as'];
	else
		$cert=0;
		
	if( isset( $_GET['comida_cafe'] ) )
		$comida=$_GET['comida_cafe'];
	else
		$comida=0;

	if( isset( $_GET['cena_gala'] ) )
		$cena=$_GET['cena_gala'];
	else
		$cena=0;
	
	if( isset( $_GET['a_extra0'] ) )
		$alh=$_GET['a_extra0'];
	else
		$alh=0;
		
	if( isset( $_GET['a_extra1'] ) )
		$sn=$_GET['a_extra1'];
	else
		$sn=0;
	
	
	//~ if( isset( $_GET['docu_con'] ) && isset( $_GET['cert_as'] ) && isset( $_GET['comida_cafe'] ) && isset( $_GET['cena_gala'] )  && isset( $_GET['a_extra0'] )  && isset( $_GET['a_extra1'] ) )
		//~ echo "Precio total a pagar: ".$importe+$docu+$cert+$comida+$cena+$alh+$sn."<br>";
	//~ else
	
	// El importe no se muestra correctamente :<
	//$importe = $_REQUEST['importe'];

	$importe=$docu+$cert+$comida+$cena+$alh+$sn;

	if( isset( $_GET['a_extra1'] ) )
		echo "Precio total a pagar: ".$importe."<br>"; 
		

			
	// Cierre de conexión.
	$mysqli->close();
?>
