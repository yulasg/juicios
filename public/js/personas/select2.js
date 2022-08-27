$(document).ready(function () {
  $('#configuracion_id').select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      }
    }
  });

  $('#codigoHab').select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      }
    }
  });

  $('#codigo').select2({
    language: {
      noResults: function () {
        return "No hay resultado";
      },
      searching: function () {
        return "Buscando..";
      }
    }
  });

  $('#persona').select2({
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