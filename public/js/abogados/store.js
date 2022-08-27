
    const formularioAbogado = document.getElementById('registrar_abogado');
    // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    var validator = FormValidation.formValidation(
        formularioAbogado,
        {
            fields: {
                'interno_id': {
                    validators: {
                        notEmpty: {
                            message: 'Seleccionar abogado interno'
                        }
                    }
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.fv-row',
                    eleInvalidClass: '',
                    eleValidClass: ''
                })
            }
        }
    );

    // Revalidate Select2 input. For more info, plase visit the official plugin site: https://select2.org/
    $(formularioAbogado.querySelector('[name="interno_id"]')).on('change', function () {
        // Revalidate the field when an option is chosen
        validator.revalidateField('interno_id');
    });


    const juicio_idw = $('#juicio_id').val();
    // Submit button handler
    const submitButton = document.getElementById('crearAbogado');
    submitButton.addEventListener('click', function (e) {
        e.preventDefault();


        const role = $('#role').val();
        if (role == 'gerente') {

     
        // Validate form before submit
        if (validator) {
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    const interno_id = $('#interno_id').val();
                    const usuario = $('#usuario').val();
                    usuario
                    //const jefe_id = $('#jefe_id').val();
                    const fecha = new Date().toISOString();
                    const _token = $("input[name=_token]").val();
                    $.ajax({
                        // url: "{{ route('personas.store') }}",
                        url: '/abogados',
                        type: 'POST',
                        data: {
                            juicio_id: juicio_idw,
                            usuario: usuario,
                            interno_id: interno_id,
                            fecha: fecha,
                            _token: _token
                        },
                        success: function (response) {
                            if (response) {
                                // Remove loading indication
                                submitButton.removeAttribute('data-kt-indicator');

                                // Enable button
                                submitButton.disabled = false;
                                formularioAbogado.reset();
                                // Show popup confirmation
                                Swal.fire({
                                    text: "El registro se creó con exito!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok!",
                                    showLoaderOnConfirm: true,
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#tabla_abogados_internos').DataTable().ajax.reload();
                                        location.href = '/abogados/' + juicio_idw;
                                    }
                                });
                            }
                        },

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
    }else{
        Swal.fire('Usuario no autorizado, para crear asignación de abogados.')
    }

    });



