
$(document).on('click', '.delete_actor', function () {
    var actor_id;
    const role = $('#role').val();
    if (role == 'gerente') {
        actor_id = $(this).attr('id');
        //console.log(persona_id);
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
                    url: '/actor/eliminar/' + actor_id,
                    success: function (response) {
                        toastr.warning('El registro fue eliminado correctamente',
                            'Eliminar Parte Actoral', { timeOut: 3000 });
                        $('#tabla').DataTable().ajax.reload();
                    },
                });
            }
        })
    } else {
        Swal.fire('Usuario no autorizado, para eliminar partes procesales.')
    }
});
