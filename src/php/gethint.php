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
	
	// Obtener el código de cuota de la página inscripción a traves del script "Info" 
	$consulta=$mysqli->query("SELECT nombre, id FROM congresistas");
	for( $i=0; $i<$consulta->num_rows; $i++ ){
		$n=$consulta->fetch_row();
		$a[$i]=$n[0]." (".$n[1].")";
	}


	// get the q parameter from URL
	$busca = $_REQUEST["busca"];

	$hint = "";

	// lookup all hints from array if $q is different from ""
	if ($busca !== "") {
		$busca = strtolower($busca);
		$len=strlen($busca);
		foreach($a as $name) {
			if (stristr($busca, substr($name, 0, $len))) {
				if ($hint === "") {
					$hint = "<a href=index.php?contenido=admin&opcion=congresistas&nombre=$name>".$name."</a>";
				} else {
					$hint .= ", <a href=index.php?contenido=admin&opcion=congresistas&nombre=$name>".$name."</a>";
				}
			}
		}
	}

	// Output "no suggestion" if no hint was found or output correct values
	echo $hint === "" ? "no suggestion" : $hint;
?> 
