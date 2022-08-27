// Define form element
const formulario = document.getElementById('registrar_dato');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formulario,
    {
        fields: {
            'capital': {
                validators: {
                    notEmpty: {
                        message: 'El campo capital, es obligatorio'
                    },
                    numeric: {
                        message: 'El campo capital, debe ser numérico',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: ','
                    }

                }
            },
            'monto': {
                validators: {
                    notEmpty: {
                        message: 'El campo monto demanda, es obligatorio'
                    },
                    numeric: {
                        message: 'El campo monto demanda, debe ser numérico',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: ','

                    }
                }
            },
            'tasa': {
                validators: {
                    notEmpty: {
                        message: 'El campo tasa, es obligatorio'
                    }

                }
            },
            'interes': {
                validators: {
                    notEmpty: {
                        message: 'El campo interes, es obligatorio'
                    },
                    numeric: {
                        message: 'El campo interes, debe ser numérico',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: ','

                    }
                }
            },
            'mora': {
                validators: {
                    notEmpty: {
                        message: 'El campo mora, es obligatorio'
                    },
                    numeric: {
                        message: 'El campo mora, debe ser numérico',
                        // The default separators
                        thousandsSeparator: '',
                        decimalSeparator: ','
                    }
                }
            },
            'juez': {
                validators: {
                    notEmpty: {
                        message: 'El nombre del juez ponente, es obligatorio'
                    },
                    stringLength: {
                        max: 50,
                        message: 'El nombre del  juez, debe tener un máximo de 50 caracteres ',
                    }
                }
            },
            'observacion': {
                validators: {
                    notEmpty: {
                        message: 'El campo observación, es obligatorio',
                    }

                }
            },
            /*
            'demanda': {
                validators: {
                    notEmpty: {
                        message: 'La fecha demanda, es obligatoria',
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha demanda, no tiene formato valido dd/mm/yyyy',
                    }
                }
            },
            'asignacion': {
                validators: {
                    notEmpty: {
                        message: 'La fecha asignación, es obligatoria',
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha asignación, no tiene formato valido dd/mm/yyyy',
                    }
                }
            },
            
            'actuacion': {
                validators: {
                    notEmpty: {
                        message: 'La fecha actuación, es obligatoria',
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha actuación, no tiene formato valido dd/mm/yyyy',
                    }
                }
            },
            'actividad': {
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

// Revalidate Select2 input. For more info, plase visit the official plugin site: https://select2.org/
$(formulario.querySelector('[name="tasa"]')).on('change', function () {
    // Revalidate the field when an option is chosen
    validator.revalidateField('tasa');
});


// Submit button handler
const submitButton = document.getElementById('crear');
submitButton.addEventListener('click', function (e) {
    // Prevent default button action
    e.preventDefault();
    const role = $('#role').val();
    if (role == 'abogado') {
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
                    /*
                    const demanda = $('#demanda').val();
                    const asignacion = $('#asignacion').val();
                    
                    const actuacion = $('#actuacion').val();
                    const actividad = $('#actividad').val();
                    */
                    const capital = $('#capital').val();
                    const monto = $('#monto').val();
                    const tasa = $('#tasa').val();
                    const interes = $('#interes').val();
                    const mora = $('#mora').val();
                    const juez = $('#juez').val();
                    //var observacion = myEditor.getData();
                    var observacion = $('#observacion').val();
                    const _token = $("input[name=_token]").val();
                    $.ajax({
                        //url: "{{ route('juicios.store') }}",
                        url: '/datos',
                        type: 'POST',
                        data: {
                            juicio_id: juicio_id,
                            usuario: usuario,
                            /*
                           demanda: demanda,
                           asignacion: asignacion,
                          
                           actuacion: actuacion,
                           actividad: actividad,
                           */
                            capital: capital,
                            monto: monto,
                            tasa: tasa,
                            interes: interes,
                            mora: mora,
                            juez: juez,
                            observacion: observacion,
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
                                        $('#tabla_juicios').DataTable().ajax.reload();
                                        location.href = '/juicios';
                                        //location.href = '/datos';
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
    } else {
        Swal.fire('Usuario no autorizado, para crear datos del juicio.')
    }

});

