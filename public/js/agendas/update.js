
// Define form element

const formulario = document.getElementById('actualizar_agenda');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formulario,
    {
        fields: {
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
            'inicio': {
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
              
                const agenda_id = $('#agenda_id').val();
                const usuario = $('#usuario').val();
                const destino = $('#destino').val();
                const asunto = $('#asunto').val();
                const referencia1 = $('#referencia1').val();
                const referencia2 = $('#referencia2').val();
                const inicio = $('#inicio').val()+' '+$('#hora').val();
                const _token = $("input[name=_token]").val();
                $.ajax({
                    url: '/agenda/editar/' + agenda_id,
                   
                    type: 'POST',
                    data: {
                        destino: destino,
                        usuario: usuario,
                        asunto: asunto,
                        referencia1: referencia1,
                        referencia2: referencia2,
                        inicio: inicio,
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
                                    //$('#tabla_agendas').DataTable().ajax.reload();
                                    location.href = '/agendas';
                                    
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

