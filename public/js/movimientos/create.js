// Define form element
const formulario = document.getElementById('registrar_movimiento');

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
            /*
            'fecha': {
                validators: {
                    notEmpty: {
                        message: 'La fecha actividad, es obligatoria',
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha actividad, no tiene formato valido dd/mm/yyyy',
                    }
                }
            },
            */

            'referencia1': {
                validators: {
                    notEmpty: {
                        message: 'El campo referencia, es obligatorio',
                    },
                    stringLength: {
                        max: 50,
                        message: 'El campo referencia, debe tener un máximo de 50 caracteres ',
                    },

                }
            },
            'referencia2': {
                validators: {
                
                    stringLength: {
                        max: 100,
                        message: 'El campo otra referencia, debe tener un máximo de 50 caracteres ',
                    }

                }
            },
            'destino': {
                validators: {
                
                    stringLength: {
                        max: 50,
                        message: 'El campo destino, debe tener un máximo de 50 caracteres ',
                    }

                }
            },
            'asunto': {
                validators: {
                
                    stringLength: {
                        max: 50,
                        message: 'El campo asunto, debe tener un máximo de 50 caracteres ',
                    }

                }
            },


            'agenda': {
                validators: {
                    notEmpty: {
                        message: 'La fecha agenda, es obligatoria',
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha agenda, no tiene formato valido dd/mm/yyyy',
                    }
                }
            },
            'hora': {
                validators: {
                    notEmpty: {
                        message: 'La hora agenda, es obligatoria',
                    },
                    time: {
                        format: 'H:i',
                        message: 'La hora agenda, no tiene formato valido',
                    }
                }
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                //rowSelector: '.fv-row',
                //eleInvalidClass: '',
                //eleValidClass: ''
            })
        }
    }
);




// Submit button handler
const submitButton = document.getElementById('crear');
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
                const fecha = $('#fecha').val();
                const usuario = $('#usuario').val();
                const destino = $('#destino').val();
                const asunto = $('#asunto').val();
                const referencia1 = $('#referencia1').val();
                const referencia2 = $('#referencia2').val();
                const inicio = $('#agenda').val()+' '+$('#hora').val();
                //const agenda = $('#agenda').val()+''+$('#hora').val();
              
                
                //var movimiento = myEditorMovimiento.getData();
                var movimiento = $('#movimiento').val();
                const _token = $("input[name=_token]").val();
                $.ajax({
                    url: '/movimientos',
                    type: 'POST',
                    data: {
                        juicio_id: juicio_id,
                        usuario: usuario,
                        fecha: fecha,
                        movimiento: movimiento,
                        destino:destino,
                        asunto:asunto,
                        referencia1:referencia1,
                        referencia2:referencia2,
                        inicio:inicio,
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
                                    $('#tabla_movimientos').DataTable().ajax.reload();
                                    location.href = '/movimientos/'+juicio_id;
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

