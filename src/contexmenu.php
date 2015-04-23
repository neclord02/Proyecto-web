<?php 

	switch($cat)	// Se usa para poner la categoría a la que pertenece la ponencia seleccionada.
	{				// Los links del menú contextual varíarán en función de la categoría de la ponencia.
		case "is":	$link1="<p id=\"tipo\"><a href=\"index.php?texto=metodologias&cat=is\"><b>Metodologías Ágiles</b></a>, por M. Noguera</p>";
					$link2="<p id=\"tipo\"><a href=\"index.php?texto=ifml&cat=is\"><b>IFML</b></a>, por M. Cabrera</p>";
					$link3="<p id=\"tipo\"><a href=\"index.php?texto=prince2&cat=is\"><b>Prince2</b></a>, por M.J. Rodríguez</p>";
					$cat="ING. SOFTWARE";  break;
					
		case "so":	$link1="<p id=\"tipo\"><a href=\"index.php?texto=windows&cat=so\"><b>Sistemas Windows</b></a>, por A. León</p>";
					$link2="<p id=\"tipo\"><a href=\"index.php?texto=linux&cat=so\"><b>Sistemas Unix/Linux</b></a>, por P. Paderewski</p>";
					$link3="<p id=\"tipo\"><a href=\"index.php?texto=ios&cat=so\"><b>Sistemas iOS/Mac</b></a>, por R. Montes</p>";
					$cat="SISTEMAS OPERATIVOS";  break;
					
		case "ig":	$link1="<p id=\"tipo\"><a href=\"index.php?texto=visualizacion&cat=ig\"><b>Visualización y Realismo</b></a>, por C. Ureña</p>";
					$link2="<p id=\"tipo\"><a href=\"index.php?texto=digitalizacion&cat=ig\"><b>Digitalización 3D</b></a>, por F.J. Melero</p>";
					$link3="<p id=\"tipo\"><a href=\"index.php?texto=realidad&cat=ig\"><b>Realidad Aumentada</b></a>, por J. Revelles</p>";
					$cat="INFORMÁTICA GRÁFICA";  break;
					
		case "sc":	$link1="<p id=\"tipo\"><a href=\"index.php?texto=programacion&cat=sc\"><b>Programación Paralela</b></a>, por J.M. Mantas</p>";
					$link2="<p id=\"tipo\"><a href=\"index.php?texto=distribuidos&cat=sc\"><b>Sistemas Distribuidos</b></a>, por J.L. Garrido</p>";
					$link3="<p id=\"tipo\"><a href=\"index.php?texto=tiemporeal&cat=sc\"><b>Sistemas en Tiempo Real</b></a>, por J.A. Holgado</p>";
					$cat="SISTEMAS COMPLEJOS";  break;
					
		case "bd":	$link1="<p id=\"tipo\"><a href=\"index.php?texto=multi&cat=bd\"><b>Bases de Datos Multidimensionales</b></a>, por E. Garví</p>";
					$link2="<p id=\"tipo\"><a href=\"index.php?texto=objetos&cat=bd\"><b>Bases de Datos Orientadas a Objetos</b></a>, por J. Samos</p>";
					$link3="<p id=\"tipo\"><a href=\"index.php?texto=bd_distribuidas&cat=bd\"><b>Bases de Datos Distribuidas</b></a>, por C. Delgado</p>";
					$cat="BASES DE DATOS";  break;
					
		case "iu":	$link1="<p id=\"tipo\"><a href=\"index.php?texto=haptica&cat=iu\"><b>Interacción Háptica</b></a>, por F.Soler</p>";
					$link2="<p id=\"tipo\"><a href=\"index.php?texto=wearables&cat=iu\"><b>Wearables</b></a>, por M. Cabrera</p>";
					$link3="<p id=\"tipo\"><a href=\"index.php?texto=rv&cat=iu\"><b>Realidad Virtual</b></a>, por J. Flores</p>";
					$cat="INTERFACES DE USUARIO";  break;
					
		case "c":	$link1="<p id=\"tipo\"><a href=\"index.php?texto=procesadores&cat=c\"><b>Procesadores de Lenguajes</b></a>, por J. Revelles</p>";
					$link2="<p id=\"tipo\"><a href=\"index.php?texto=traductores&cat=c\"><b>Traductores</b></a>, por R. López-Cózar</p>";
					$link3="<p id=\"tipo\"><a href=\"index.php?texto=habla&cat=c\"><b>Procesamiento de Habla</b></a>, por Z. Callejas</p>";
					$cat="COMPILADORES";  break;
	}

?>
    <div class = "contenido">  <!-- init programa --> 

        <h2> <?php echo $cat; ?> </h2>	<!-- Encabezado con la categoría de la ponencia seleccionada. -->
        
      	<table class="tabla">
        	<tr>
        		<th> Descripción </th>
                <th> Misma sesión </th>
        	</tr>
            <tr>
                <td> 
					<?php include("./src/textos/".$texto.".html"); ?>	<!-- La ponencia seleccionada-->
                </td>
                <td> 
					<?php
						// Se insertan los links a las ponencias de la sesión seleccionada, se marca en
						// negrita el que se muestra en ese momento.
						if($texto=="metodologias" || $texto=="windows" || $texto=="visualizacion" || $texto=="programacion" || $texto=="multi" || $texto=="haptica" || $texto=="procesadores") 
							echo "<b>".$link1."</b>" ;
						else
							echo $link1 ;
						
						if($texto=="ifml" || $texto=="linux" || $texto=="digitalizacion" || $texto=="distribuidos" || $texto=="objetos" || $texto=="wearables" || $texto=="traductores") 
							echo "<b>".$link2."</b>" ;
						else
							echo $link2 ;	
						
						if($texto=="prince2" || $texto=="ios" || $texto=="realidad" || $texto=="tiemporeal" || $texto=="bd_distribuidas" || $texto=="rv" || $texto=="habla") 
							echo "<b>".$link3."</b>" ;
						else
							echo $link3 ; 
					?>
                </td>
            </tr>
        </table>
        
        <div class="menu"> <!-- Botón de volver -->
			<ul class="nav">
				<li><a href="index.php?contenido=programa">Volver</a></li>
			</ul>
		</div>

    </div> <!-- end programa -->
