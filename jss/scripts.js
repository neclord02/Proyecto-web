
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