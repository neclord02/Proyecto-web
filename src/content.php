<?php

	$texto="";
	$cat="";	
	
	// Si existe en $_GET la variable texto es porque se solicita información de un elemento del programa.
	// Se inserta contexmenu.php en lugar de "$contenido". 
	if(isset($_GET["texto"])){
		$texto=$_GET["texto"];
		$cat=$_GET["cat"];
		include("./src/contexmenu.php");
	}
	else if( $contenido == "alhambra" or $contenido == "sierra_nevada" ){
		
		include("./src/actividades.php");
		
	}
	else if( $contenido == "login"){
		
		include("./src/login.php");
		
	}
	else if( $contenido == "restablecer"){
		
		include("./src/restablecer.php");
		
	}
	else
	
		include("src/".$contenido.".html");	// En $contenido está el nombre del archivo html a incluir,
											// se le concatena la ruta y la extensión para que sea una ruta válida.
?>										
