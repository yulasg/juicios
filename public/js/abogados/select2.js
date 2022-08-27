$(document).ready(function () {
  $('#interno_id').select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      }
    }
  });
  /*
  $('#jefe_id').select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      }
    }
  });
  */
});