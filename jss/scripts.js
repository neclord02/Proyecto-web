// Validador de email.

function check(){
	
	var email = document.getElementById("email_content").value;
	var valid_text = /\S+@\S+\.\S+/;
	
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

var posicion = -105;

function Carousel(){
    posicion += 1;			// Saltos en px de la imagen.
    document.getElementById('cnt-imagenes').style.top = "-" + posicion + "px";
    if(posicion == 315){	// Han pasado 3 imágenes de 125px, reiniciar...
        document.getElementById('cnt-imagenes').style.top = "0";
        posicion = 0;
        setTimeout(Carousel, 3000);
        return;
    }
    
    if(!(posicion%105)){ 	//pausa de cada imagen (125px).
        setTimeout(Carousel, 3000);
        return;
    }
    
    runCarousel = setTimeout(Carousel, 1);	// Tiempo entre saltos de las imágenes.
}

Carousel();
