<?php
//ONLY FOR TESTING API rest
//Clase hotel 
class Hotel{
    public $idAlojamiento;
    public $nombre;
    public $precio;
    public $resumen;
    public $imagen;

    //se le pasa una decoded JSON
    public function read_hotel($decoded){
        $this->idAlojamiento=$decoded["idAlojamiento"];
        $this->nombre=$decoded["nombre"];
        $this->precio=$decoded["precio"];
        $this->resumen=$decoded["resumenCorto"];
        $this->imagen=$decoded["imagen1"];
    }

    public function mostrar(){
		echo '<div class="hotel">';
			echo '<div id="hotel_titulo">';
				echo "<h2> HOTEL ".$this->nombre." </h2>";
				
				echo "<h4>Precio desde: ".$this->precio." € </h4>";
			echo '</div>';
						
			echo "<img id ='imagen_hotelera' src = \"http://localhost/heisenburg/".$this->imagen."\">";
			
			echo "<div>";
				echo "<p>".$this->resumen."</p>";
			echo "</div>";
			
		echo "</div>";
    }
}
?>