<?php

	// Acceso a la BD	
	$servidor = "localhost";
	$usuario = "root";
	$passdb = "";
	$base_datos = "congreso";

	$conexion=mysql_connect($servidor,$usuario, $passdb) or die("<p id=error>Error en la conexión</p>");

	// Si no existe crear una nueva BD
	if(!mysql_query("use $base_datos"))
	{
	   mysql_query ("create database $base_datos");
	}


	mysql_select_db($base_datos,$conexion) or die("<br><br><h3 id=error>Error en la base de datos</h3><p><a href=index.php>Volver</a></p>");

	// Si la tabla "credenciales" no existe, crearla.
	if(!mysql_query("select * from usuarios"))
	{
		mysql_query("create table usuarios
				   (
					id int ( 3 ) primary key auto_increment,
					email varchar ( 50 ) not null,
					user varchar ( 50 ) not null,
					pass varchar( 15 ) not null,
					admin boolean default false not null
					)
					");
	}
	
	// Cierre de conexión.
	mysql_close($conexion);
	
?>
