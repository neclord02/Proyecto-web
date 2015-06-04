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
	
	// Obtener todos los nombres con sus ID`s desde la tabla congresistas.
	$consulta=$mysqli->query("SELECT nombre, id FROM congresistas");
	for( $i=0; $i<$consulta->num_rows; $i++ ){
		$n=$consulta->fetch_row();
		$a[$i]=$n[0]." (".$n[1].")";
	}


	// Obtener desde el script las letras a buscar.
	$busca = $_REQUEST["busca"];

	$res = "";

	// Encontrar todas las coincidencias desde el array $a[] si busca es diferente de "".
	if ($busca !== "") {
		$busca = strtolower($busca);
		$len=strlen($busca);
		foreach($a as $name) {
			if (stristr($busca, substr($name, 0, $len))) {
				if ($res === "") {
					$res = "<a id=no_marcar href=index.php?contenido=admin&opcion=congresistas&id=".substr($name, -2, 1).">$name</a>";
				} else {
					$res .= ", <a id=no_marcar href=index.php?contenido=admin&opcion=congresistas&id=".substr($name, -2, 1).">$name</a>";
				}
			}
		}
	}

	// Imprime un mensaje si no hay coincidencias con los datos intoducidos.
	echo $res === "" ? "<span id=error>No hay resultados</span>" : $res;
?> 
