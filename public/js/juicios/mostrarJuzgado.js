const cod = document.getElementById("tribunal_id").value;
$.get('/registrosjuzgados/' + cod, function (data) {
    $.get('/todosjuzgados', function (dataJ) {
        var html_select = '<option></option>';
        for (var i = 0; i < dataJ.length; ++i)
            if (dataJ[i].id == data.id) {
                html_select += '<option value="' + dataJ[i].id + '" selected>' + dataJ[i].descripcion + '</option>';
            } else {
                html_select += '<option value="' + dataJ[i].id + '">' + dataJ[i].descripcion + '</option>';
            }
        $('#juzgado_id').html(html_select);

    });

    //alert(cod);
    const codJuzgado = data.id;
    //alert(codJuzgado);
    /*
    $.get('/registrostribunales/' + codJuzgado, function (dataTribu) {
        //alert(dataTribu.length);
        var html_select = '<option></option>';
        for (var i = 0; i < dataTribu.length; ++i)
            //console.log(dataTribu[i]);
            if (dataTribu[i].id == cod) {
                html_select += '<option value="' + dataTribu[i].id + '" selected>' + dataTribu[i].descripcion + '</option>';
            } else {
                html_select += '<option value="' + dataTribu[i].id + '">' + dataTribu[i].descripcion + '</option>';
            }
        $('#tribunal_id').html(html_select);
    });
    */
});

