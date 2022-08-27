
$(document).on('click', '.delete_relacion', function () {
    var relacion_id;
    var row_index;
    const role = $('#role').val();
    if (role == 'gerente') {
        row_index = this.parentNode.parentNode.rowIndex;
        //console.log(row_index);
        relacion_id = $(this).attr('id');
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
                    url: '/relaciones/eliminar/' + relacion_id,

                    success: function (response) {
                        toastr.warning('El registro fue eliminado correctamente',
                            'Eliminar Relaciones', document.getElementById('tabla_relaciones').deleteRow(row_index), { timeOut: 3000 });
                    },

                });
            }
        })
    } else {
        Swal.fire('Usuario no autorizado, para eliminar relación de juicios.')
    }
});

