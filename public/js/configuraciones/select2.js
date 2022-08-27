$(document).ready(function () {
  $('#internacional').select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      }
    }
  });
  $('#especialidad_id').select2({
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