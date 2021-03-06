<?php
	error_reporting(-1);
	ini_set( 'display_errors', 1 );

	// Creación de la BD
	include("./src/php/bd.php");	// Comentar una vez creada


	// Inicio de sesión
	session_start();
	
	// Cuando se pulsa el botón salir la sesión se destruye y se va al index.
	if(isset($_GET['salir'])){
		session_destroy();
		header("location:index.php");
	}
?>

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
			case "login": ;  break;
			case "registro": ;  break;
			case "restablecer": ;  break;
			case "pass": ;  break;
			case "admin": ;  break;
			case "hoteles": ; break;
			case "edit": ; break;
			case "hotelseleccion": break;
			
			default:
				$contenido="index";
				$presentacion="class=\"current\"";
		}
	?>
	<div class="marco"> <!-- init marco -->
		<div class="startup"> <!-- init startup -->
		<?php	
				include("./src/php/header.php");
				include("./src/php/menubar.php");
		?>		
		</div> <!-- end startup -->

		<?php
				include("./src/php/content.php");
		?>
	</div>	<!-- end marco -->
	<?php
				include("./src/php/footer.php");
	?>
	</body>
</html>
