<?php

	// Acceso a la BD	
	$servidor = "localhost";
	$usuario = "root";
	$passdb = "";
	$base_datos = "congreso";


//__________________________________________________________________________________________________

	// Conexión con el servidor.
	$mysqli = new mysqli( $servidor, $usuario, $passdb );
	if ( $mysqli->connect_errno ) {
		echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
	}


//__________________________________________________________________________________________________

	// Si la BD no existe, crearla.
	if( !$mysqli->query( "USE DATABASE $base_datos" ) )
		$mysqli->query( "CREATE DATABASE $base_datos" );
	
	// Seleccionar la BD.
	$mysqli->select_db( "$base_datos" );


//______________________________________--USUARIOS--________________________________________________

	// Si la tabla "usuarios" no existe, crearla.
	if( !$mysqli->query( "SELECT * FROM usuarios" ) )
	{
		$mysqli->query( "CREATE TABLE usuarios
				   (
					id INT ( 3 ) auto_increment,
					email VARCHAR ( 50 ) NOT NULL,
					user VARCHAR ( 50 ) NOT NULL,
					pass VARCHAR ( 15 ) NOT NULL,
					admin BOOLEAN DEFAULT false,
					PRIMARY KEY(id, email)
					)
					" );
	}

	// Inserta en la tabla "usuarios" los usuarios de prueba "pepe" y "admin" con pass "1234".
	$consulta=$mysqli->query( "SELECT * FROM usuarios WHERE user='pepe'" );
	$filas=$consulta->num_rows;

	// Si la consulta devuelve 0 filas es que los usuarios de prueba no existen, se crean.
	if( !$filas )
	{
		$mysqli->query( "INSERT INTO usuarios ( email, user, pass, admin ) 
							VALUES ( 's@localhost', 'admin', 1234, 1 )" );
		$mysqli->query( "INSERT INTO usuarios ( email, user, pass ) 
							VALUES ( 's@localhost.dev', 'pepe', 1234 )" );
		$mysqli->query( "INSERT INTO usuarios ( email, user, pass ) 
							VALUES ( 'juan@hotmail.com', 'juan', 1234 )" );
		$mysqli->query( "INSERT INTO usuarios ( email, user, pass ) 
							VALUES ( 'laura@yahoo.es', 'laura', 1234 )" );
	}
	
	
//______________________________________--CUOTAS--__________________________________________________

	// Si la tabla "cuotas" no existe, crearla.
	if( !$mysqli->query( "SELECT * FROM cuotas" ) )
	{
		$mysqli->query( "CREATE TABLE cuotas
				   (
					id INT ( 1 ) PRIMARY KEY auto_increment,
					denominacion VARCHAR ( 50 ) NOT NULL,
					descripcion VARCHAR ( 250 ) NOT NULL,
					importe INT ( 2 ) NOT NULL,
					docu_con INT ( 2 ) DEFAULT 9,
					cert_as INT ( 2 ) DEFAULT 29,
					comida_cafe INT ( 2 ) DEFAULT 49,
					cena_gala INT ( 2 ) DEFAULT 99
					)
					" );
	}
	
	//~ servicios SET('docu_con','cert_as','comida-cafe','cena_gala') NOT NULL
	
	// Inserta en la tabla "cuotas" los datos de las inscripciones al congreso.
	$consulta=$mysqli->query( "SELECT * FROM cuotas WHERE id=1" );
	$filas=$consulta->num_rows;

	// Si la consulta devuelve 0 filas es que la cuota no existe, se crea.
	if( !$filas )
	{
		$desc_est="Inscripción básica a precio reducido. Imprescindible aportar carnet de estudiante.";
		$desc_prf="Inscripción para personal investigador. Incluye cena de gala";
		$desc_inv="Inscripción para invitados. Incluye certificado de asistencia.";
		
		// Inscripciones hasta el 31 de Marzo.
		$mysqli->query( "INSERT INTO cuotas ( denominacion, descripcion, importe, docu_con, comida_cafe ) 
							VALUES ( 'Estudiante hasta el 31 de Marzo', '$desc_est', 279, 0, 0 )" );
		$mysqli->query( "INSERT INTO cuotas ( denominacion, descripcion, importe, docu_con, comida_cafe, cena_gala )
							VALUES ( 'Profesor hasta el 31 de Marzo', '$desc_prf', 399, 0, 0, 0 )" );
		$mysqli->query( "INSERT INTO cuotas ( denominacion, descripcion, importe, docu_con, cert_as, comida_cafe ) 
							VALUES ( 'Invitado hasta el 31 de Marzo', '$desc_inv', 499, 0, 0, 0 )" );
		
		// Inscripciones del 1 de Abril al 1 de Mayo.
		$mysqli->query( "INSERT INTO cuotas ( denominacion, descripcion, importe, docu_con, comida_cafe ) 
							VALUES ( 'Estudiante del 1 de Abril al 1 de Mayo', '$desc_est', 299, 0, 0 )" );
		$mysqli->query( "INSERT INTO cuotas ( denominacion, descripcion, importe, docu_con, comida_cafe, cena_gala )
							VALUES ( 'Profesor del 1 de Abril al 1 de Mayo', '$desc_prf', 449, 0, 0, 0 )" );
		$mysqli->query( "INSERT INTO cuotas ( denominacion, descripcion, importe, docu_con, cert_as, comida_cafe ) 
							VALUES ( 'Invitado del 1 de Abril al 1 de Mayo', '$desc_inv', 649, 0, 0, 0 )" );
		
		// Inscripciones durante el congreso.
		$mysqli->query( "INSERT INTO cuotas ( denominacion, descripcion, importe, docu_con, comida_cafe ) 
							VALUES ( 'Estudiante durante el congreso', '$desc_est', 419, 0, 0 )" );
		$mysqli->query( "INSERT INTO cuotas ( denominacion, descripcion, importe, docu_con, comida_cafe, cena_gala )
							VALUES ( 'Profesor durante el congreso', '$desc_prf', 599, 0, 0, 0 )" );
		$mysqli->query( "INSERT INTO cuotas ( denominacion, descripcion, importe, docu_con, cert_as, comida_cafe ) 
							VALUES ( 'Invitado durante el congreso', '$desc_inv', 699, 0, 0, 0 )" );
	}


//______________________________________--ACTIVIDADES--_____________________________________________

	// Si la tabla "actividades" no existe, crearla.
	if( !$mysqli->query( "SELECT * FROM actividades" ) )
	{
		$mysqli->query( "CREATE TABLE actividades
				   (
					id INT ( 1 ) PRIMARY KEY auto_increment,
					denominacion VARCHAR ( 50 ) NOT NULL,
					fecha_hora DATETIME	NOT NULL,
					descripcion VARCHAR ( 250 ) NOT NULL,
					foto VARCHAR ( 200 ) NOT NULL,
					importe INT ( 2 ) NOT NULL
					)
					" );
	}
	
	// Inserta en la tabla "actividades" los datos de las actividades del congreso.
	$consulta=$mysqli->query( "SELECT * FROM actividades WHERE id=1" );
	$filas=$consulta->num_rows;

	// Si la consulta devuelve 0 filas es que la actividad no existe, se crea.
	if( !$filas )
	{
		$desc_alhambra="Visita al monumento más importante de la ciudad, patrimonio de la humanidad, incluida visita al palacio de Carlos V y a los jardines del Generalife";
		$desc_sierra="Excursión a la estación de esquí de Sierra Nevada, con varias actividades incluidas, como recorrido en máquinas pisa-pistas y taller de observación del cielo.";
		$foto_alhambra="./image/alhambra2.jpg";
		$foto_sierra="./image/actividades/sierra.jpg";
		
		
		$mysqli->query( "INSERT INTO actividades ( denominacion, fecha_hora, descripcion, foto, importe ) 
							VALUES ( 'Visita a la Alhambra', '2015-06-07 20:00:00', '$desc_alhambra', '$foto_alhambra', 40 )" );
		$mysqli->query( "INSERT INTO actividades ( denominacion, fecha_hora, descripcion, foto, importe ) 
							VALUES ( 'Excursión a Sierra Nevada', '2015-06-06 06:00:00', '$desc_sierra', '$foto_sierra', 50 )" );
	}
	
	
//______________________________________--HOTELES--_____________________________________________

	// Si la tabla "hoteles" no existe, crearla.
	if( !$mysqli->query( "SELECT * FROM hoteles" ) )
	{
		$mysqli->query( "CREATE TABLE hoteles
				   (
					id INT ( 1 ) PRIMARY KEY auto_increment,
					descripcion VARCHAR ( 250 ) NOT NULL,
					foto VARCHAR ( 200 ) NOT NULL,
					importe INT ( 2 ) NOT NULL
					)
					" );
	}
	
	// Inserta en la tabla "hoteles" los datos de los hoteles asociados al congreso.
	$consulta=$mysqli->query( "SELECT * FROM hoteles WHERE id=1" );
	$filas=$consulta->num_rows;

	// Si la consulta devuelve 0 filas es que el hotel no existe, se crea.
	if( !$filas )
	{
		$desc_hotel_1="Mágnifico hotel de 4 estrellas situado en pleno centro";
		$desc_hotel_2="Hotel con una excelente relación calidad/precio, situado junto al Parque de las Ciencias.";
		$foto_hotel_1="./image/alhambra2.jpg";
		$foto_hotel_2="./image/actividades/sierra.jpg";
		
		
		$mysqli->query( "INSERT INTO hoteles ( descripcion, foto, importe ) 
							VALUES ( '$desc_hotel_1', '$foto_hotel_1', 90 )" );
		$mysqli->query( "INSERT INTO hoteles ( descripcion, foto, importe ) 
							VALUES ( '$desc_hotel_2', '$foto_hotel_2', 40 )" );
	}
	
		
//______________________________________--CONGRESISTAS--________________________________________________

	// Si la tabla "congresistas" no existe, crearla.
	if( !$mysqli->query( "SELECT * FROM congresistas" ) )
	{
		$mysqli->query( "CREATE TABLE congresistas
				   (
					id INT ( 3 ) PRIMARY KEY auto_increment,
					nombre VARCHAR ( 50 ) NOT NULL,
					apellidos VARCHAR ( 50 ) NOT NULL,
					c_trabajo VARCHAR ( 50 ) NOT NULL,
					tlf VARCHAR ( 10 ) NOT NULL,
					email VARCHAR ( 50 ) NOT NULL,
					id_cuota INT ( 2 ) NOT NULL,
					docu_con BOOLEAN DEFAULT false,
					cert_as BOOLEAN DEFAULT false,
					comida_cafe BOOLEAN DEFAULT false,
					cena_gala BOOLEAN DEFAULT false,
					alhambra BOOLEAN DEFAULT false,
					sierra BOOLEAN DEFAULT false,
					importe INT ( 3 ) NOT NULL
					)
					" );
	}

	// Inserta en la tabla "congresistas" el congresista de prueba "pepe" con pass "1234".
	$consulta=$mysqli->query( "SELECT * FROM congresistas WHERE id=1 " );
	$filas=$consulta->num_rows;

	// Si la consulta devuelve 0 filas es que el congresista de prueba no existe, se crea.
	if( !$filas )
	{
	
		$mysqli->query( "INSERT INTO congresistas ( nombre, apellidos, c_trabajo, tlf, email, id_cuota,
						docu_con, cert_as, comida_cafe, cena_gala, alhambra, sierra, importe )
							VALUES ( 'José', 'Sánchez', 'ugr', '745885566', 'josesan@ugr.dev', '1',
									'0', '-1', '0', '-1', '-1', '50', '329' )" );
									
		$mysqli->query( "INSERT INTO congresistas ( nombre, apellidos, c_trabajo, tlf, email, id_cuota,
						docu_con, cert_as, comida_cafe, cena_gala, alhambra, sierra, importe )
							VALUES ( 'Laura', 'Martínez', 'CETIC', '848659874', 'laura@cetic.dev', '3',
									'0', '0', '0', '99', '40', '-1', '638' )" );
									
		$mysqli->query( "INSERT INTO congresistas ( nombre, apellidos, c_trabajo, tlf, email, id_cuota,
						docu_con, cert_as, comida_cafe, cena_gala, alhambra, sierra, importe )
							VALUES ( 'Paco', 'Rodríguez', 'IBM', '147582896', 'pacoro@ibm.dev', '5',
									'0', '-1', '0', '0', '-1', '50', '499' )" );
	}
	
	
//______________________________________--USUARIO_BD--______________________________________________


	// Crea el usuario desde el que se administrará la BD, solo tiene permisos sobre $base_datos.
	$consulta=$mysqli->query( "SELECT * FROM mysql.user WHERE user='admin_congreso'" );
	$filas=$consulta->num_rows;

	// Si la consulta devuelve 0 filas es que el usuario no existe, se crea.
	if( !$filas )
	{
		
		$mysqli->query( "CREATE USER 'admin_congreso'@'localhost' IDENTIFIED BY 'ytT7Vqtz5pDRabjX'" );
		$mysqli->query( "GRANT ALL PRIVILEGES ON $base_datos.* TO 'admin_congreso'@'localhost' WITH GRANT OPTION" ); 
	
	}


//__________________________________________________________________________________________________

	// Cierre de conexión.
	$mysqli->close();
	
?>
