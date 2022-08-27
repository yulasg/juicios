const formularioIncluir = document.getElementById('registrarActor');
// Submit button handler 
const submitButtonx = document.getElementById('crearA');
submitButtonx.addEventListener('click', function (e) {
    // Prevent default button action
    e.preventDefault();
    // Validate form before submit 
    if (validator) {
        validator.validate().then(function (status) {
            if (status == 'Valid') {
                const juicio_id = $('#juicio_id').val();
                const configuracion_id = $('#configuracion_id').val();
                const usuario = $('#usuario').val();
                const referencia_id = $('#referencia_id').val();
                const especialidad_id = $('#especialidad_id').val();
                const representante = $('#representante').val();
                const estatu = $('#tipo_idx').val();
                let tipo = 'X';
                if (configuracion_id == 7 && estatu != '' ) {
                    tipo = estatu;
                }
                const _token = $("input[name=_token]").val();
                //console.log(tipo);
                $.ajax({
                    url: '/actores',
                    type: 'POST',
                    data: {
                        juicio_id: juicio_id,
                        configuracion_id: configuracion_id,
                        usuario: usuario,
                        referencia_id: referencia_id,
                        tipo: tipo,
                        _token: _token
                    },
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
                                    location.href = '/actores/' + juicio_id + '/' + especialidad_id+ '/' + representante;
                                }
                            });
                        } else {
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
            } else {
                Swal.fire({
                    text: "Lo sentimos, al parecer la información suministrada es incorrecta o esta incompleta. Revise nuevamente por favor.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, Chequear de nuevo!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light"
                    }
                })
            }
        });
    }
});