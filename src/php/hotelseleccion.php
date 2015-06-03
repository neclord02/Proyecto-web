
<?php

	$importe = $_GET['importe'];

?>

<div class=contenido>

	<h1>Selección de Hotel</h1>
	<p> 
    	Importe actual: <?php echo $importe;?> €
    </p>
    <p> 
    	Si quiere alojarse durante el congreso seleccione una fecha:
    </p>
	<br>
    <form class = "barra_sesion"  method="post">
    		<input type="date" name="fecha_entrada" id="texto" size ="13" placeholder="Fecha entrada" min="2015-01-01" max="2016-01-01" value="<?php echo date("Y-m-d");?>">
            <input type="date" name="fecha_salida" id="texto" size ="13" placeholder="Fecha salida" min="2015-01-01" max="2016-01-01" value="<?php echo date("Y-m-d",strtotime("+1 day"));?>">
            
            Tipo de habitacion:
            <select name="tipohab" id="desplegable">>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
             
            <input type="submit" id="submit" value="Buscar">
     </form>
   
</div>

<?php
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_REQUEST['inscripcion'])){
	
		include( "./src/php/hoteldecode.php" );
		
		$tipohab = $_POST['tipohab'];
		$fecha_entrada = $_POST['fecha_entrada'];
		$fecha_salida = $_POST['fecha_salida'];
		
		$service_url="http://localhost/heisenburg/rest/api.php?rquest=hotel&tipo=".$tipohab."&finicio=".$fecha_entrada."&ffin=".$fecha_salida."";
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //to return the content
		
		$result = curl_exec($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		$decoded=json_decode($result,true);
		//echo "Header:" . $httpcode . "</br>";
			
		if($httpcode==200){
			
			echo '<p> &emsp; &emsp; Hoteles disponibles: </p>';
			
			foreach ($decoded as  $valor) {
				$h = new Hotel;
				$h->read_hotel($valor);
				$h->mostrar();
			}
			
			$k = 0;
			
			echo '<p> &emsp; &emsp; Seleccione un hotel: </p>';
			
			echo "&emsp; &emsp;<select name='hotel_nombre'>";
						
			foreach ($decoded as  $valor) {
				$h = new Hotel;
				$h->read_hotel($valor);
				echo "<option value=$k >$h->nombre</option>";

				$k++;
			}
			echo "</select>
			<br> <br> ";
			
			echo '<form class = "formselect" action="index.php?contenido=hotelseleccion&importe=279&inscripcion=1" method="post">';
				echo '<input type="submit" id="submit" value="Reservar hotel!">';
			echo '</form>';
		}
		else{
			echo "error Header:" . $httpcode . "</br>";
		}
		
			
	}else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['inscripcion'])){
		
		$service_url = "http://localhost/heisenburg/rest/api.php?rquest=reserva&tipo=1&finicio=fecha_entrada&ffin=fecha_salida&username=antonio&hotel=1";

		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //to return the content
		
		$result = curl_exec($curl);
		$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		$decoded=json_decode($result,true);
		if($httpcode==200){
			echo '<script> alert("Alojamiento reservado con exito!");window.location.href="index.php"; </script>';
		}
		else{
			if($httpcode==204){
				echo '<script> alert("no hay habitaciones disponibles"); </script>';
				//echo "no hay habitaciones disponibles</br>";
			}
			else{
				echo "error Header:" . $httpcode . "</br>";
			}
		
		}
			
	}

?>

