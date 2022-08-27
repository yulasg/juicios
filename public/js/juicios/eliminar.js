$(document).on('click', '.delete_juicio', function () {
    var juicio_id;
    const role = $('#role').val();
    if (role == 'gerente') {
        juicio_id = $(this).attr('id');
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
                    url: '/juicios/eliminar/' + juicio_id,
                    success: function (response) {
                        toastr.warning('El registro fue eliminado correctamente',
                            'Eliminar Juicio', { timeOut: 3000 });
                        $('#tabla_juicios').DataTable().ajax.reload();
                    },
                });
            }
        })
    } else {
        Swal.fire('Usuario no autorizado, para eliminar juicio.')
    }
});
