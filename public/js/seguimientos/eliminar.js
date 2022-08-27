
$(document).on('click', '.delete_seguimiento', function () {
    var seguimiento_id;
    const role = $('#role').val();
    if (role == 'gerente') {
        seguimiento_id = $(this).attr('id');
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
                    url: '/seguimientos/eliminar/' + seguimiento_id,
                    success: function (response) {
                        toastr.warning('El registro fue eliminado correctamente',
                            'Eliminar Seguimiento', { timeOut: 3000 });
                        $('#tabla_seguimientos').DataTable().ajax.reload();
                    },
                });
            }
        })
    } else {
        Swal.fire('Usuario no autorizado, para eliminar actuaciones del juicio.')
    }
});
