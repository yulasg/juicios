const selection = document.getElementById("configuracion_id");
const ocultar = document.getElementById("ocultar");
function select() {
   var valor = selection.options[selection.selectedIndex].value;
   if (valor == 7) {
      ocultar.style.display = "block";
   } else {
      ocultar.style.display = "none";
   }
}

