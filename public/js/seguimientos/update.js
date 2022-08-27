
// Define form element

const formulario = document.getElementById('actualizar_seguimiento');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formulario,
    {
        fields: {
            'seguimiento': {
                validators: {
                    notEmpty: {
                        message: 'El campo seguimiento, es obligatorio',
                    }

                }
            },
            'fecha': {
                validators: {
                    notEmpty: {
                        message: 'La fecha, es obligatoria',
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha, no tiene formato valido dd/mm/yyyy',
                    }
                }
            },
            'actividad_id': {
                validators: {
                    notEmpty: {
                        message: 'La actividad procesal, es obligatoria',
                    }
                }
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                //rowSelector: '.fv-row',
                //eleInvalidClass: '',
                //SSeleValidClass: ''
            })
        }
    }
);
const role = $('#role').val();


// Submit button handler
const submitButton = document.getElementById('editar');

submitButton.addEventListener('click', function (e) {
    // Prevent default button action
    e.preventDefault();

        // Validate form before submit
        if (validator) {
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication

                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;
                    const juicio_id = $('#juicio_id').val();
                    const usuario = $('#usuario').val();
                    const actividad_id = $('#actividad_id').val();
                    const seguimiento_id = $('#seguimiento_id').val();
                    const fecha = $('#fecha').val();
                    //var seguimiento = myEditor.getData();
                    var seguimiento = $('#seguimiento').val();
                    const _token = $("input[name=_token]").val();
                    $.ajax({
                        url: '/seguimiento/editar/' + seguimiento_id,

                        type: 'POST',
                        data: {
                            juicio_id: juicio_id,
                            usuario: usuario,
                            fecha: fecha,
                            actividad_id: actividad_id,
                            seguimiento: seguimiento,
                            _token: _token
                        },
                        success: function (response) {
                            if (response) {
                                // Remove loading indication
                                submitButton.removeAttribute('data-kt-indicator');

                                // Enable button
                                submitButton.disabled = false;
                                formulario.reset();
                                // Show popup confirmation
                                Swal.fire({
                                    text: "El registro se actualizó con exito!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok!",
                                    showLoaderOnConfirm: true,
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#tabla_seguimientos').DataTable().ajax.reload();
                                        location.href = '/seguimientos/' + juicio_id;
                                    }
                                });
                            }
                        },
                    });
                }
                else {
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

