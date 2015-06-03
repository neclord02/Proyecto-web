<?php
	
	include( "./src/php/hoteldecode.php" );
	
	$service_url="http://localhost/heisenburg/rest/api.php?rquest=hotel&tipo=1&finicio=2015-05-17&ffin=2015-05-23";
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //to return the content
	
	$result = curl_exec($curl);
	$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	$decoded=json_decode($result,true);
	//echo "Header:" . $httpcode . "</br>";
	if($httpcode==200){
	
		foreach ($decoded as  $valor) {
			$h = new Hotel;
			$h->read_hotel($valor);
			$h->mostrar();
		}
	}
	else{
		echo "error Header:" . $httpcode . "</br>";
	}
?>