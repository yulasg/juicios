const formulario = document.getElementById('registrar_demandado');  
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
            'nombre': {
                validators: {
                    notEmpty: {
                        message: 'Nombre de la parte, es obligatorio'
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
            'configuracion_id': {
                validators: {
                    notEmpty: {
                        message: 'Configuración, es obligatorio'
                    }

                }
            },
            /*
            'persona': {
                validators: {
                    notEmpty: {
                        message: 'Naturaleza, es obligatorio'
                    }

                }
            },
            */
            'rif': {
                validators: {
                    /*
                    notEmpty: {
                        message: 'N° Rif, es obligatorio'
                    },
                    */
                    numeric: {
                        message: 'N° Rif, debe ser númerico'
                    },
                    stringLength: {
                        max: 1,
                        message: 'N° Rif, debe tener un máximo de 1 caracteres ',
                    },
                }
            },
            'numero': {

                validators: {
                    /*
                    notEmpty: {
                        message: 'N° Identificación, es obligatorio'
                    },
                    */
                    numeric: {
                        message: 'N° Identificación, debe ser númerico'
                    },
                    stringLength: {
                        max: 8,
                        message: 'N° Identificación, debe tener un máximo de 8 caracteres ',
                    },
                }
            },
            'celular': {
                validators: {
                    /*
                    notEmpty: {
                        message: 'N° Identificación, es obligatorio'
                    },
                    */
                    numeric: {
                        message: 'N° Celular, debe ser númerico'
                    },
                    stringLength: {
                        max: 7,
                        message: 'N° Celular, debe tener un máximo de 7 caracteres ',
                    
                    },
                  
                }
            },
            'habitacion': {
                validators: {
                    /*
                    notEmpty: {
                        message: 'N° Identificación, es obligatorio'
                    },
                    */
                    numeric: {
                        message: 'N° Habitación, debe ser númerico'
                    },
                    stringLength: {
                        max: 7,
                        message: 'N° Habitación, debe tener un máximo de 7 caracteres ',
                      
                    },
                   
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
$(formulario.querySelector('[name="configuracion_id"]')).on('change', function () {
    // Revalidate the field when an option is chosen
    validator.revalidateField('configuracion_id');
});



//const njuicio = $('#juicio_id').val();
//const nespecialidad = $('#especialidad_id').val();



// Submit button handler
const submitButton = document.getElementById('crearDemandado');
submitButton.addEventListener('click', function (e) {
    // Prevent default button action
    e.preventDefault();
    // Validate form before submit 
    if (validator) {
        validator.validate().then(function (status) {
            if (status == 'Valid') {

                const juicio_id = $('#juicio_id').val();
                const usuario = $('#usuario').val();
                const especialidad_id = $('#especialidad_id').val();
                const representante = $('#representante').val();

                const configuracion_id = $('#configuracion_id').val();
                const nombre = $('#nombre').val();
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

                const codigoHab = $('#codigoHab').val();
                const habitacion = $('#habitacion').val();
                const codhabitacion = codigoHab+habitacion;

                const codigo = $('#codigo').val();
                const celular = $('#celular').val();
                const codcelular = codigo+celular;
                const _token = $("input[name=_token]").val();
             
                $.ajax({
                    url: '/personas',
                    type: 'POST',
                    data: {
                        juicio_id: juicio_id,
                        usuario: usuario,
                        nombre: nombre,
                        configuracion_id:configuracion_id,
                        persona: persona,
                        email: email,
                        direccion: direccion,
                        habitacion: codhabitacion,
                        celular: codcelular,
                        numero: numero,
                        rif: rif,
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
                                    location.href = '/personas/' + juicio_id + '/' + especialidad_id+ '/' + representante;

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
                                    location.href = '/personas/'+njuicio+'/'+nespecialidad;
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
