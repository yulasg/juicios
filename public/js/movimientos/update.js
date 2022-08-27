
// Define form element

const formulario = document.getElementById('actualizar_movimiento');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formulario,
    {
        fields: {
            'movimiento': {
                validators: {
                    notEmpty: {
                        message: 'El campo actividad, es obligatorio',
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
                    const movimiento_id = $('#movimiento_id').val();
                    const fecha = $('#fecha').val();
                    //var movimiento = myEditorMovimiento.getData();
                    var movimiento = $('#movimiento').val();
                    const _token = $("input[name=_token]").val();
                    $.ajax({
                        url: '/movimiento/editar/' + movimiento_id,

                        type: 'POST',
                        data: {
                            fecha: fecha,
                            usuario: usuario,
                            movimiento: movimiento,
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
                                        $('#tabla_movimientos').DataTable().ajax.reload();
                                        location.href = '/movimientos/' + juicio_id;
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

