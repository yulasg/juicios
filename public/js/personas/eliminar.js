
$(document).on('click', '.delete_persona', function () {
    var persona_id;
    const role = $('#role').val();
    if (role == 'gerente') {
        persona_id = $(this).attr('id');
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
                    url: '/persona/eliminar/' + persona_id,
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
