const formulario = document.getElementById('registrar_representante');
// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formulario,
    {
        fields: {

            'email_principal': {
                validators: {
                    emailAddress: {
                        message: 'No es una direción de correo electróncio, valida',
                    },
                    regexp: {
                        regexp: /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/,
                        message: 'Correo Electróncio no valido',
                    },
                }
           
            },

            email_secundario: {
                validators: {
                    emailAddress: {
                        message: 'No es una direción de correo electróncio, valida',
                    },
                    regexp: {
                        regexp: /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/,
                        message: 'Correo Electróncio no valido',
                    },
                }
            
            },

            'direccion': {
                validators: {
                    stringLength: {
                        max: 100,
                        message: 'Dirección, debe tener un máximo de 100 caracteres ',
                    },
                }
            },
            'nombre': {
                validators: {
                    notEmpty: {
                        message: 'Nombre de la parte actora, es obligatorio'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u,
                        message: 'El nombre solo puede constar de caracteres alfabéticos y espacios',
                    },
                    stringLength: {
                        max: 50,
                        message: 'Nombre de la parte actora, debe tener un máximo de 50 caracteres ',
                    },
                }
            },
            'tipo': {
                validators: {
                    notEmpty: {
                        message: 'Naturaleza, es obligatorio'
                    }

                }
            },
            'rif': {
                validators: {
                    /*
                    notEmpty: {
                        message: 'N° rif, es obligatorio'
                    },
                    */
                    numeric: {
                        message: 'N° rif, debe ser númerico'
                    },
                    stringLength: {
                        max: 1,
                        message: 'N° rif, debe tener un máximo de 1 caracteres ',
                    },
                }
            },
            'numero': {
                validators: {
                    notEmpty: {
                        message: 'N° identificación, es obligatorio'
                    },
                    numeric: {
                        message: 'N° identificación, debe ser númerico'
                    },
                    stringLength: {
                        max: 8,
                        message: 'N° identificación, debe tener un máximo de 8 caracteres ',
                    },
                }
            },
            'celular_1': {
                validators: {
                    numeric: {
                        message: 'N° celular principal, debe ser númerico'
                    },
                    stringLength: {
                        max: 7,
                        message: 'N° celular principal, debe tener un máximo de 7 caracteres ',
                    },
                }
            },
            'celular_2': {
                validators: {
                    numeric: {
                        message: 'N° celular secundario, debe ser númerico'
                    },
                    stringLength: {
                        max: 7,
                        message: 'N° celular secundario, debe tener un máximo de 7 caracteres ',
                    },
                }
            },
            'habitacion': {
                validators: {
                    numeric: {
                        message: 'N° habitación, debe ser númerico'
                    },

                    stringLength: {
                        max: 7,
                        message: 'N° habitación, debe tener un máximo de 7 caracteres ',
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




// Revalidate Select2 input. For more info, plase visit the official plugin site: https://select2.org/
$(formulario.querySelector('[name="tipo"]')).on('change', function () {
    // Revalidate the field when an option is chosen
    validator.revalidateField('tipo');
});

// Submit button handler
const submitButton = document.getElementById('crear');
submitButton.addEventListener('click', function (e) {
    // Prevent default button action
    e.preventDefault();
    // Validate form before submit 
    if (validator) {
        validator.validate().then(function (status) {
            if (status == 'Valid') {
                const tipo = $('#tipo').val();

                const identificador = $('#numero').val();
                const cero = identificador.toString().padStart(8, '0');
                var numeros = cero;

                const rif = $('#rifx').val();

                const nombre = $('#nombre').val();
                const direccion = $('#direccion').val();
                const codigo = $('#codigo').val();
                const hab = $('#habitacion').val();
                const habitacion = codigo + hab;
                const cod_cel_1 = $('#cod_cel_1').val();
                const celular_1 = $('#celular_1').val();
                const celular_P = cod_cel_1 + celular_1;
                const cod_cel_2 = $('#cod_cel_2').val();
                const celular_2 = $('#celular_2').val();
                const celular_S = cod_cel_2 + celular_2;
                const email_principal = $('#email_principal').val();
                const email_secundario = $('#email_secundario').val();
                const _token = $("input[name=_token]").val();


                $.ajax({
                    url: '/representantes',
                    type: 'POST',
                    data: {
                        tipo: tipo,
                        numero: numeros,
                        rif: rif,
                        nombre: nombre,
                        direccion: direccion,
                        habitacion: habitacion,
                        celular_principal: celular_P,
                        celular_secundario: celular_S,
                        email_principal: email_principal,
                        email_secundario: email_secundario,
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
                                    location.href = '/representantes';
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
                    /*
                    success: function (response) {
                        if (response) {
                            formulario.reset();
                            // Show popup confirmation
                            Swal.fire({
                                text: "El registro, se creó con exito!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#tabla').DataTable().ajax.reload();
                                    location.href = '/referencias';
                                }
                            });;
                        }
                    },
                    */
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
