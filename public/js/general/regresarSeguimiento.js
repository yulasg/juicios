const submitButtonAbogado = document.getElementById('regresar');
const juicio_id = $('#juicio_id').val();
submitButtonAbogado.addEventListener('click', function (e) {
    e.preventDefault();
    $('#tabla_seguimientos').DataTable().ajax.reload();
    location.href = '/seguimientos/'+juicio_id;
});
