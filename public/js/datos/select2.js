$(document).ready(function () {
  $('#tasa').select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      }
    }
  });
});