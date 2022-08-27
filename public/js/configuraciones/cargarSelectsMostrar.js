const internacionalx = $('#internacionalx').val();
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
            if (data[i].id == internacional) {
                html_select += '<option value="' + '" ' + 'selected' + '>' + data[i].descripcion +
                    '</option>';
            } else {
                html_select += '<option value="' + data[i].id + '">' + data[i].descripcion +
                    '</option>';
            }
        $('#especialidad_id').html(html_select);
    });
};

