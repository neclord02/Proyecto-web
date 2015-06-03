// Validador de email.

function check(){

	var email = document.getElementById("email_content").value;
	var valid_text = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	
	if( valid_text.test(email) ){
		
		
		alert( "¡Gracias por contactar con nosotros!" );
		document.getElementById("formulario").submit();
		
	}else{
		
		document.getElementById("error").innerHTML = "ERROR: El email no es correcto, por favor, intentelo de nuevo.";
		
	}
	
}

function patrs(){
	
	alert("Hello");
	
}


// Visor de banners.

var posicion = 0;

function Carousel(){
    posicion += 1;			// Saltos en px de la imagen.
    document.getElementById('cnt-imagenes').style.top = "-" + posicion + "px";
    if(posicion == 315){	// Han pasado 3 imágenes de 105px, reiniciar...
        document.getElementById('cnt-imagenes').style.top = "0";
        posicion = 0;
        setTimeout(Carousel, 2500);		// En este momento se produce el reinicio del script, como
        return;							// La 1º y la 4º imagen es la misma el cambio no se nota.
    }
    
    if(!(posicion%105)){ 		//pausa de cada imagen (105px).
        setTimeout(Carousel, 3000);
        return;
    }
    
    setTimeout(Carousel, 1);	// Tiempo entre px de las imágenes.
}


function Info( cadena ){
    if (cadena == "") {
        document.getElementById( "mostrar" ).innerHTML = "";
        return;
    } 
    else {
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open( "GET","./src/php/info.php?info="+cadena ,true );
		xmlhttp.send();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById( "mostrar" ).innerHTML = xmlhttp.responseText;
            }
        }
    }
}

function InfoCheck( cadena ){
		xmlhttp = new XMLHttpRequest();
		
		if( document.getElementById("docu_con").checked && !document.getElementById("docu_con").disabled )
			var docu_con="docu_con="+document.getElementById("docu_con").value;
		else
			var docu_con="docu_con=0";

		if( document.getElementById("cert_as").checked && !document.getElementById("cert_as").disabled )
			var cert_as="cert_as="+document.getElementById("cert_as").value;
		else
			var cert_as="cert_as=0";
		
		if( document.getElementById("comida_cafe").checked && !document.getElementById("comida_cafe").disabled )
			var comida_cafe="comida_cafe="+document.getElementById("comida_cafe").value;
		else
			var comida_cafe="comida_cafe=0";
			
		if( document.getElementById("cena_gala").checked && !document.getElementById("cena_gala").disabled )
			var cena_gala="cena_gala="+document.getElementById("cena_gala").value;
		else
			var cena_gala="cena_gala=0";
			
		if( document.getElementById("a_extra0").checked )
			var a_extra0="a_extra0="+document.getElementById("a_extra0").value;
		else
			var a_extra0="a_extra0=0";
		
		if( document.getElementById("a_extra1").checked )
			var a_extra1="a_extra1="+document.getElementById("a_extra1").value;
		else
			var a_extra1="a_extra1=0";	
			
		xmlhttp.open( "GET","./src/php/info.php?"+a_extra0+"&"+a_extra1+"&"+docu_con+"&"+cert_as+"&"+comida_cafe+"&"+cena_gala, true );

		xmlhttp.send();
		xmlhttp.onreadystatechange = function() {
			if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
                document.getElementById( "importe" ).innerHTML = xmlhttp.responseText;
			} 
		}
    }

function Buscar( cadena )
{
	if (cadena.length==0) { 
		document.getElementById("busca").innerHTML="";
		return;
	} 
	else {
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("busca").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","./src/php/gethint.php?busca="+cadena,true);
		xmlhttp.send();
	}    
}
