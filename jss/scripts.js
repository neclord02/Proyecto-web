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

Carousel();
