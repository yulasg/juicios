const submitButtonAbogado = document.getElementById('regresar');
submitButtonAbogado.addEventListener('click', function (e) {
    e.preventDefault();
    $('#tabla').DataTable().ajax.reload();
    location.href = '/representantes';
});
