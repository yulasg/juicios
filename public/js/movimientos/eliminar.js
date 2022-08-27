
$(document).on('click', '.delete_movimiento', function () {
    var movimiento_id;
    const role = $('#role').val();
    if (role == 'gerente') {
        movimiento_id = $(this).attr('id');
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
                    url: '/movimientos/eliminar/' + movimiento_id,
                    success: function (response) {
                        toastr.warning('El registro fue eliminado correctamente',
                            'Eliminar Actividad', { timeOut: 3000 });
                        $('#tabla_movimientos').DataTable().ajax.reload();
                    },
                });
            }
        })
    } else {
        Swal.fire('Usuario no autorizado, para eliminar actividades del juicio.')
    }
});

