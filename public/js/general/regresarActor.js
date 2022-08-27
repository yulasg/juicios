const submitButtonAbogado = document.getElementById('regresar');
const juicio_idA= $('#juicio_id').val();
const especialidad_idA = $('#especialidad_id').val();
const representante = $('#representante').val();

submitButtonAbogado.addEventListener('click', function (e) {
    e.preventDefault();
    $('#tabla').DataTable().ajax.reload();
    //location.href = '/actores/'+ juicio_idA +'/'+ especialidad_idA +'/'+ representante;
    location.href = `/actores/${juicio_idA}/${especialidad_idA}/${representante}`;
});

