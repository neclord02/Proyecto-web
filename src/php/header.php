	<div class ="header"> <!-- init header -->
 
		<div class="logo"> <!-- init logo -->
			<a href="index.php"><img id="imglogo" src="image/ISBWlogo.png" title="Ir a la página principal" alt="Foto isbw"/></a>
		</div> <!-- end logo -->
  
		<div class="titulo"> <!-- init titulo -->
			<h2>PRIMER CONGRESO DE CEIIE</h2>
		</div>	<!-- end titulo -->  
		
		<div class="login">
			<?php
				// Botones de login			
				if( isset( $_SESSION['user'] ) )
				{
					if( $_SESSION['admin'] )
						echo "<p><a id=admin href=index.php?contenido=admin>".$_SESSION['user']."</a><a id=boton href=index.php?salir>Salir</a></p>";
					else
						echo "<p><a href=index.php?contenido=pass>".$_SESSION['user']."</a><a id=boton href=index.php?salir>Salir</a></p>";
				}
				else
					echo "<a id=boton href=index.php?contenido=login>login</a>";
				
			?>
			
        </div>

		
	</div> <!-- end header -->
         
         
      
