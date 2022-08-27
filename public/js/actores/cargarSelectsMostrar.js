const especialidad_id = $('#especialidad_id').val();
const configuracion_idx = $('#configuracion_idx').val(); 
$(document).ready(function () {
    $.get('/registrosconfiguraciones/' + especialidad_id, function (data) {
        var html_select = '<option></option>';
        for (var i = 0; i < data.length; ++i)
            //console.log(data[i]);
            if (data[i].id==configuracion_idx){
                html_select += '<option value="' + data[i].id + '" '+ 'selected'+   '>' + data[i].descripcion +
                '</option>';
            }else{
                html_select += '<option value="' + data[i].id +  '"   >' + data[i].descripcion +
                '</option>';
            }
        $('#configuracion_id').html(html_select);
    });

});
