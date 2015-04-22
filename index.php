<!doctype html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="author" content="Alberto y Miguel" />
		<meta name="keywords" lang="es" content="congreso, granada, sistemas, web, CEIIE" />
		<meta name="description" lang="es" content="Página del primer congreso de Estudiantes de Ingeniería Informática en España" />
		<title>1º Congreso de CEIIE</title>
		<link href="./css/style.css" rel="stylesheet" type="text/css" />
		<link rel="icon" type="image/png" href="./image/fav.png" />
		<script type="text/javascript" src="./jss/scripts.js"></script>
	</head>

	<body>
	<body onload="scripts:Carousel();"> 
	<?php
		
		$presentacion="";		// Varables que se usarán como rutas, por defecto en blanco
		$actividades="";		// para no asignar la clase "current" a ningún botón en particular.
		$granada="";
		$comollegar="";
		$info="";	
							
		if(isset($_GET["contenido"]))		// Si se establecido la variable "contenido" por $_GET. 
			$contenido=$_GET["contenido"];	
		else
			$contenido="";
			
		switch($contenido)	// Según su valor se marcará un botón u otro 
		{					// añadiendo "class=current" a la variable elegida.
			case "index":
			case "programa":
			case "ponentes": $presentacion="class=\"current\"";  break;
			case "sierra_nevada":
			case "alhambra": $actividades="class=\"current\"";  break;
			case "granada":
			case "monumentos":
			case "tapas":
			case "barrios":
			case "etsiit": $granada="class=\"current\"";  break;
			case "bus":
			case "tren":
			case "coche":
			case "avion": $comollegar="class=\"current\"";  break;
			case "contacto":
			case "patrocinio":
			case "inscripcion": $info="class=\"current\"";  break;
				
			default:
				$contenido="index";
				$presentacion="class=\"current\"";
		}
			
//		include("./send-email.php");
		include("./src/header.php");
		include("./src/menubar.php");
		include("./src/content.php");
		include("./src/footer.php");

	?>
	</body>
</html>
