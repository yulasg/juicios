// Define form element
const formulario = document.getElementById('registrarDocumento');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formulario,
    {
        fields: {
            'inicio': {
                validators: {
                    notEmpty: {
                        message: 'La fecha inicio, es obligatoria',
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha inicio, no tiene formato valido dd/mm/yyyy',
                    }
                }
            },
            'fin': {
                validators: {
                    notEmpty: {
                        message: 'La fecha vencimiento, es obligatoria',
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha vencimiento, no tiene formato valido dd/mm/yyyy',
                    }
                }
            },
            'numero': {
                validators: {
                    notEmpty: {
                        message: 'El N° de pagare, es obligatoria',
                    },
                    stringLength: {
                        max: 20,
                        message: 'El N° de pagare, debe tener un máximo de 20 caracteres ',
                    },
                
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
                const usuario = $('#usuario').val();
                const inicio = $('#inicio').val();
                const fin = $('#fin').val();
                const numero = $('#numero').val();
                const _token = $("input[name=_token]").val();
                $.ajax({
                    url: '/documentos',
                    type: 'POST',
                    data: {
                        juicio_id: juicio_id,
                        usuario: usuario,
                        inicio: inicio,
                        fin: fin,
                        numero: numero,
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
                                    $('#tabla').DataTable().ajax.reload();
                                    location.href = '/documentos/'+juicio_id;
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

