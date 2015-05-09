<?php

	$texto="";
	$cat="";	
	
	// Si existe en $_GET la variable texto es porque se solicita información de un elemento del programa.
	// Se inserta contexmenu.php en lugar de "$contenido". 
	if(isset($_GET["texto"])){
		$texto=$_GET["texto"];
		$cat=$_GET["cat"];
		include("./src/php/contexmenu.php");
	}
	else{
		switch($contenido)	// Según su valor se cargará un contentido u otro 
		{
				case "alhambra":
				case "sierra_nevada": include("./src/php/actividades.php");  break;
				case "contacto":
				case "login":
				case "registro":
				case "restablecer": include("./src/php/".$contenido.".php");  break;
		
				default:
					include("src/html/".$contenido.".html");	// En $contenido está el nombre del archivo html a incluir,
		}														// se le concatena la ruta y la extensión para que sea una ruta válida.
	}

?>										
