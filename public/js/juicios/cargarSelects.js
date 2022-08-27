
$(document).ready(function () {


    $(function () {
        $('#internacional').on('change', onSelectInternacionalChange);
    });


    function onSelectInternacionalChange() {
        var internacional = $(this).val();
        if (!internacional) {
            $('#especialidad_id').html('<option></option>');
            return;
        }     
        $.get('/registrosespecialidades/' + internacional, function (data) {
            var html_select = '<option></option>';
            for (var i = 0; i < data.length; ++i)
                //console.log(data[i]);
                html_select += '<option value="' + data[i].id + '">' + data[i].descripcion +
                    '</option>';
            $('#especialidad_id').html(html_select);
        });
        
    };


    $(function () {
        $('#juzgado_id').on('change', onSelectJuzgadoChange);
    });

  

    function onSelectJuzgadoChange() {
        var juzagdo_id = $(this).val();
        if (!juzagdo_id) {
            $('#tribunal_id').html('<option></option>');
            return;
        }
        $.get('/registrostribunales/' + juzagdo_id, function (data) {
            var html_select = '<option></option>';
            for (var i = 0; i < data.length; ++i)
                //console.log(data[i]);
                html_select += '<option value="' + data[i].id + '">' + data[i].descripcion +
                    '</option>';
            $('#tribunal_id').html(html_select);
        });
    };

    $(function () {
        $('#terminado_id').on('change', onSelectTerminadoChange);
    });

    function onSelectTerminadoChange() {
        var terminado_id = $(this).val();
        //console.log(terminado_id);
        if (!terminado_id) {
            $('#estatu_id').html('<option></option>');
            return;
        }
        $.get('/registrosestatus/' + terminado_id, function (data) {
            var html_select = '<option></option>';
            for (var i = 0; i < data.length; ++i)
                //console.log(data[i]);
                html_select += '<option value="' + data[i].id + '">' + data[i].descripcion +
                    '</option>';
            $('#estatu_id').html(html_select);
        });
    };

});
