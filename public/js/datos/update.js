
// Define form element
const formulario = document.getElementById('actualizar_dato');


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
                        thousandsSeparator: '.',
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
                        thousandsSeparator: '.',
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
                        thousandsSeparator: '.',
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
                        thousandsSeparator: '.',
                        decimalSeparator: ','
                    }
                }
            },
            'juez': {
                validators: {
                    notEmpty: {
                        message: 'El campo juez ponente, es obligatorio'
                    },
                    stringLength: {
                        max: 50,
                        message: 'El nombre del  juez, debe tener un máximo de 50 caracteres ',
                    }
                }
            },
            'myEditor': {
                validators: {
                    notEmpty: {
                        message: 'El campo observación, es obligatorio'
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
                //SSeleValidClass: ''
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
const submitButton = document.getElementById('editar');

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
                    const dato_id = $('#dato_id').val();
                    const usuario = $('#usuario').val();
                    /*
                    const demanda = $('#demanda').val();
                    const asignacion = $('#asignacion').val();
                    
                    const actuacion = $('#actuacion').val();
                    const actividad = $('#actividad').val();
                    */
                    //const capital = $('#capital').val();
                    //const monto = $('#monto').val();
                    const tasa = $('#tasa').val();
                    //const interes = $('#interes').val();
                    //const mora = $('#mora').val();
                    const juez = $('#juez').val();


                    var capitales = $('#capital').val();
                    for (i = 0; i < capitales.length; i++)
                        if (capitales.charAt(i) == '.') {
                            capitales = capitales.replace('.', '');
                        }
                    for (i = 0; i < capitales.length; i++)
                        if (capitales.charAt(i) == ',') {
                            capitales = capitales.replace(',', '.');
                        }


                    var montos = $('#monto').val();
                    for (i = 0; i < montos.length; i++)
                        if (montos.charAt(i) == '.') {
                            montos = montos.replace('.', '');
                        }
                    for (i = 0; i < montos.length; i++)
                        if (montos.charAt(i) == ',') {
                            montos = montos.replace(',', '.');
                        }


                    var intereses = $('#interes').val();
                    for (i = 0; i < intereses.length; i++)
                        if (intereses.charAt(i) == '.') {
                            intereses = intereses.replace('.', '');
                        }
                    for (i = 0; i < intereses.length; i++)
                        if (intereses.charAt(i) == ',') {
                            intereses = intereses.replace(',', '.');
                        }


                    var moras = $('#mora').val();
                    for (i = 0; i < moras.length; i++)
                        if (moras.charAt(i) == '.') {
                            moras = moras.replace('.', '');
                        }
                    for (i = 0; i < moras.length; i++)
                        if (moras.charAt(i) == ',') {
                            moras = moras.replace(',', '.');
                        }

                    var observacion = $('#observacion').val();
                    //var observacion = myEditor.getData();
                    const _token = $("input[name=_token]").val();


                    $.ajax({
                        url: '/dato/editar/' + dato_id,
                        type: 'POST',
                        data: {
                            /*
                            demanda: demanda,
                            asignacion: asignacion,
                            
                            actuacion: actuacion,
                            actividad: actividad,
                            */
                            usuario: usuario,
                            capital: capitales,
                            monto: montos,
                            tasa: tasa,
                            interes: intereses,
                            mora: moras,
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
        Swal.fire('Usuario no autorizado, para editar datos del juicio.')
    }

});

