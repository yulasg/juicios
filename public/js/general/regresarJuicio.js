const submitButtonAbogado = document.getElementById('regresar');
submitButtonAbogado.addEventListener('click', function (e) {
    e.preventDefault();
    //$('#tabla_juicios').DataTable().ajax.reload();
    location.href = '/juicios';
});