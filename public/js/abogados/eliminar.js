$(document).ready(function () {
    $(document).on('click', '.deleteAbogado', function () {
        var abogado_id;
        var row_index;
        const role = $('#role').val();
        if (role == 'gerente') {
            row_index = this.parentNode.parentNode.rowIndex;
            abogado_id = $(this).attr('id');
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
                        url: '/abogados/eliminar/' + abogado_id,

                        success: function (response) {
                            var respons = response;
                            //console.log(respons);
                            var type = respons.result
                            //console.log(type);
                            if (type === 'success') {
                                Swal.fire({
                                    text: response.msj,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Cerrar",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-primary",
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {

                                        $('#tabla_abogados_internos').DataTable().ajax.reload();
                                    }
                                });
                            }
                            else {
                                Swal.fire({
                                    text: response.msj,
                                    icon: "warning",
                                    buttonsStyling: false,
                                    confirmButtonText: "Cerrar",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-primary",
                                    }
                                })
                            }
                        }


                        /*
                        success: function (response) {
                            toastr.warning('El registro fue eliminado correctamente',
                            'Eliminar Abogado Interno', document.getElementById('tabla_abogados_internos').deleteRow(row_index), {timeOut: 3000});
                        },
                        */

                    });
                }
            })
        } else {
            Swal.fire('Usuario no autorizado, para eliminar asignación de abogados.')
        }
    });
});