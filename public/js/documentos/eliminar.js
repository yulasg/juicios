
$(document).on('click', '.delete_documento', function () {
    var documento_id;
    const role = $('#role').val();
    if (role == 'gerente') {
        documento_id = $(this).attr('id');
        Swal.fire({
            title: 'Estas seguro de eliminar?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/documentos/eliminar/' + documento_id,
                    success: function (response) {
                        toastr.warning('El registro fue eliminado correctamente',
                            'Eliminar Pagare', { timeOut: 3000 });
                        $('#tabla').DataTable().ajax.reload();
                    },
                });
            }
        })
    } else {
        Swal.fire('Usuario no autorizado, para eliminar pagares.')
    }
});
