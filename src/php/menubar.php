		<!-- Mediante $_GET seleccionamos el contenido a mostrar. -->
	
		<div class="menu"> <!-- init menu -->
			<ul class="nav">
				<li <?php echo $presentacion; ?> ><a href="index.php?contenido=index">PRESENTACIÓN</a>
					<ul>
						<li><a href="index.php?contenido=programa">PROGRAMA</a></li>
						<li><a href="index.php?contenido=ponentes">PONENTES</a></li>			
					</ul>
				</li>
				<li <?php echo $actividades; ?> ><a>ACTIVIDADES</a>
					<ul>
						<li><a href="index.php?contenido=sierra_nevada">S.NEVADA</a></li>
						<li><a href="index.php?contenido=alhambra">ALHAMBRA</a></li>
					</ul>
				</li>
				<li <?php echo $granada; ?> ><a href="index.php?contenido=granada">GRANADA</a>
					<ul>
						<li><a href="index.php?contenido=monumentos">MONUMENTOS</a></li>
						<li><a href="index.php?contenido=tapas">TAPAS</a></li>
						<li><a href="index.php?contenido=barrios">BARRIOS</a></li>
						<li><a href="index.php?contenido=etsiit">ETSIIT</a></li>
					</ul>
				</li>				
				<li <?php echo $comollegar; ?> ><a>COMO LLEGAR</a>
					<ul>
						<li><a href="index.php?contenido=bus">BUS</a></li>
						<li><a href="index.php?contenido=tren">TREN</a></li>
						<li><a href="index.php?contenido=coche">COCHE</a></li>
						<li><a href="index.php?contenido=avion">AVION</a></li>
					</ul>
				</li>
				<li <?php echo $info; ?> ><a>+ INFO</a>
					<ul>
						<li><a href="index.php?contenido=contacto">CONTACTO</a></li>
						<li><a href="index.php?contenido=patrocinio">PATROCINIO</a></li>
						<li><a href="index.php?contenido=inscripcion">INSCRIPCION</a></li>
                        <li><a href="index.php?contenido=hoteles">HOTELES</a></li>
					</ul>
				</li>
					</ul>
		</div> <!-- end menu -->
    
