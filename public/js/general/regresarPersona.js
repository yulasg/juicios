const submitButtonAbogado = document.getElementById('regresar');
const juicio_id = $('#juicio_id').val();
const especialidad_idx = $('#especialidad_id').val();
const representante = $('#representante').val();

submitButtonAbogado.addEventListener('click', function (e) {
    e.preventDefault();
    $('#tabla').DataTable().ajax.reload();
    location.href = '/personas/'+ juicio_id +'/'+ especialidad_idx +'/'+ representante;
});

