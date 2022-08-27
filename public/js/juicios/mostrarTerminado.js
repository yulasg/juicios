const cod_estatu = document.getElementById("estatu_id").value;
$.get('/buscarestatu/' + cod_estatu, function (data) {
    var html_select1 = '<option></option>';
    const op1="S";
    const op2="N";
    const op11="Si";
    const op22="No";
    if (data[0].terminado == 'Si'){
        html_select1 += '<option value="' + op1 + '" selected>' + op11 + '</option>';
        html_select1 += '<option value="' + op2 + '">' + op22 + '</option>';
    }
    if (data[0].terminado == 'No'){
        html_select1 += '<option value="' + op1 + '">' + op11 + '</option>';
        html_select1 += '<option value="' + op2 + '" selected>' + op22 + '</option>';
    }
    $('#terminado_id').html(html_select1);
});





