    
    <?php 
	
		
		// ¡¡¡¡ EL ARCHIVO DEBE ESTAR CODIFICADO EN UTF-8 !!!!!!!!!!!!!!!!!    	
		// Abro el archivo del usuario para la actividad
		if( $contenido == "sierra_nevada" ) 
			$archivo = fopen( "./config_usuario/actividad_sierra_nevada.txt", "r" ) or die("El archivo no existe");
		else if( $contenido == "alhambra" )
			$archivo = fopen( "./config_usuario/actividad_alhambra.txt", "r" ) or die("El archivo no existe");
		else
			die( "ERROR.... ACTIVIDAD INEXISTENTE O ALGO RARO HA PASADO" );
	
		// LECTURA DE DATOS:
	
		// El titulo
		fgets($archivo); // Descarto la primera linea (TITULO:)
		$titulo = fgets( $archivo );
		
		// La imagen
		fgets( $archivo ); // Descarto la siguiente linea( RUTA DE LA IMAGEN...:)
		$imagen = fgets( $archivo );
		
		// La descripcion
		fgets( $archivo ); // Descarto la siguiente linea (INFORMACION GENERAL:)
		$info = "";
		
		while( ($aux = fgets( $archivo ) ) != "\r\n" && $aux != "\n" ){
			$info .= "<p>";
			$info .= $aux;
			$info .= "</p>";
		}
		//~ 
		// Los apartados:
		
		$int = 0;
		
		while( !feof( $archivo ) ){
		
			fgets( $archivo ); // Descarto la linea del apartado
			fgets( $archivo ); // Descarto la linea del titulo
			$apartadotitulo[$int] = fgets( $archivo );
			fgets( $archivo ); // Descarto la linea de la informacion
			$apartadoinfo[$int] = fgets( $archivo );
			fgets( $archivo ); // Descarto la linea en blanco que separa apartados
			$int++;
			
		}
		
		// Cierro el archivo
		fclose( $archivo );
    ?>
 
    <div class="contenido"> <!-- init contenido -->
		
        <?php
		
			if( $_SESSION['admin'] ){
				
				echo "<a href='index.php?contenido=edit&file=".$contenido."'><div id='boton_editar'> EDITAR </div></a>";	
				
			}
		
		?>
        
        
        <h3> <?php echo $titulo ?> </h3>

        <img id="sierra" src = <?php echo $imagen ?> />
		
        <p> <?php echo $info ?> </p>
		
		<p> Como características más reseñables de esta actividad se pueden incluir: </p>

		<?php 
        
        	for( $i = 0; $i<$int; $i++ ){
            
            	echo "<h5> $apartadotitulo[$i] </h5>";
                echo "<p> $apartadoinfo[$i] </p>";
            
            }
        
        ?>

	</div> <!-- end contenido -->
    
</div>	<!-- end marco -->

