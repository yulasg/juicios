const formularioActor = document.getElementById('buscar_actor');
// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formularioActor,
    {
        fields: {
            'tipo': {
                validators: {
                    notEmpty: {
                        message: 'Naturaleza, es obligatorio'
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
$(formularioActor.querySelector('[name="tipo"]')).on('change', function () {
    // Revalidate the field when an option is chosen
    validator.revalidateField('tipo');
});

// Submit button handler
const submitButtony = document.getElementById('buscar');
submitButtony.addEventListener('click', function (e) {
    // Prevent default button action
    e.preventDefault();
    // Validate form before submit 
    if (validator) {
        validator.validate().then(function (status) {
            if (status == 'Valid') {
                const tipo = $('#tipo').val();
                const numero = $('#numero').val();
                const rif = $('#rif').val();
                const _token = $("input[name=_token]").val();
                $.ajax({
                    url: '/actor/buscar',
                    type: 'POST',
                    data: {
                        tipo:tipo,
                        numero:numero,
                        rif:rif,                        
                        _token: _token               
                    },

                    success: function (response) {
                        //console.log(response);
                        var type = response.result
                        if (type === 'success') {
                            //console.log(type);
                            document.getElementById('nombre').value = response[0][0].nombre;
                            document.getElementById('direccion').value= response[0][0].direccion;
                            document.getElementById('celular_uno').value= response[0][0].celular_uno;
                            document.getElementById('celular_dos').value= response[0][0].celular_dos;
                            document.getElementById('habitacion').value= response[0][0].casa;
                            document.getElementById('email1').value= response[0][0].email_principal;
                            document.getElementById('email2').value= response[0][0].email_secundario;
                            document.getElementById('referencia_id').value= response[0][0].id; 
                        } else {
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
                            console.log(response);
                            document.getElementById('nombre').value= response[0].nombre;
                            document.getElementById('direccion').value= response[0].direccion;
                            document.getElementById('celular_uno').value= response[0].celular_uno;
                            document.getElementById('celular_dos').value= response[0].celular_dos;
                            document.getElementById('habitacion').value= response[0].casa;
                            document.getElementById('email1').value= response[0].email_principal;
                            document.getElementById('email2').value= response[0].email_secundario;
                            document.getElementById('referencia_id').value= response[0].id; 
                    }
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

