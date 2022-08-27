
$(document).on('click', '.delete_ubicacion', function () {
    var ubicacion_id;
    const role = $('#role').val();
    if (role == 'gerente') { 
        ubicacion_id = $(this).attr('id');
        Swal.fire({
            title: 'Estas seguro eliminar?',
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
                    url: '/ubicacion/eliminar/' + ubicacion_id,
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

                                    $('#tabla').DataTable().ajax.reload();
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
                });
            }
        })
    } else {
        Swal.fire('Usuario no autorizado, para eliminar estados.')
    }
});