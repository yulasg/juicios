const nJuicio_id = $('#juicio_id').val();
const boton = document.querySelector("#siguiente");
boton.addEventListener("click", function(e){
    e.preventDefault();
	// Aquí todo el código que se ejecuta cuando se da click al botón
	//alert("Le has dado click");
    location.href = '/datos/'+nJuicio_id;
});