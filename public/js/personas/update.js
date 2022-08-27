
// Define form element
const formulario = document.getElementById('actualizarPesona');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formulario,
    {
        fields: {
            'email': {
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
                        message: 'Nombre, es obligatorio'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u,
                        message: 'El nombre solo puede constar de caracteres alfabéticos y espacios',
                    },
                    stringLength: {
                        max: 50,
                        message: 'Nombre, debe tener un máximo de 50 caracteres ',
                    },
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
                    numeric: {
                        message: 'N° identificación, debe ser númerico'
                    },
                    stringLength: {
                        max: 8,
                        message: 'N° identificación, debe tener un máximo de 8 caracteres ',
                    },
                }
            },
            'celular': {
                validators: {
                    numeric: {
                        message: 'N° celular, debe ser númerico'
                    },
                    stringLength: {
                        max: 7,
                        message: 'N° celular, debe tener un máximo de 7 caracteres ',
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
                const especialidad_id = $('#especialidad_id').val();
                const representante = $('#representante').val();
                const persona_id = $('#persona_id').val();
                const persona = $('#persona').val();
                const identificador = $('#numero').val();
                var numero;
                numero= identificador;
                if (identificador  != '') {
                    const cero = identificador.toString().padStart(8, '0');
                    numero = cero;
                }
                const rif = $('#rif').val();
                const email = $('#email').val();
                const direccion = $('#direccion').val();
                const cod_cel_1 = $('#codigo').val();
                const celular_1 = $('#celular').val();
                const celular = cod_cel_1+celular_1;


                const codigoHab = $('#codigoHab').val();
                const habitacion = $('#habitacion').val();
                const codhabitacion = codigoHab+habitacion;


             
                const nombre = $('#nombre').val();
                const configuracion_id = $('#configuracion_id').val();
                const _token = $("input[name=_token]").val();
                $.ajax({
                    url: '/persona/editar/'+persona_id,
                    type: 'POST',
                    data: {
                        persona: persona,
                        usuario: usuario,
                        numero: numero,
                        rif: rif,
                        email: email,
                        direccion: direccion,
                        celular: celular,
                        habitacion: codhabitacion,
                        nombre: nombre,
                        configuracion_id: configuracion_id,
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
                                    location.href = '/personas/'+juicio_id+'/'+especialidad_id+'/'+representante;
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
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.href = '/persona/'+persona_id+'/edit';
                                }
                            });
                        }
                    }
                    /*
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
                                    $('#tabla').DataTable().ajax.reload();
                                    location.href = '/referencias';
                                }
                            });
                        }
                    },
                    */
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

