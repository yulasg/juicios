


// Define form element
const formularioInterno = document.getElementById('actualizarInterno');


// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formularioInterno,
    {
        fields: {
            'nombre': {
                validators: {
                    notEmpty: {
                        message: 'El campo nombre del abogado interno, es obligatorio'
                    },
                    stringLength: {
                        max: 50,
                        message: 'El campo nombre del abogado interno, debe tener un máximo de 100 caracteres ',
                    }
                }
            },
            'tipo': {
                validators: {
                    notEmpty: {
                        message: 'El campo tipo de cargo, es obligatorio'
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
                const interno_id = $('#interno_id').val();
                const nombre = $('#nombre').val();
                const tipo = $('#tipo').val();
                /*
                if (tipo=="0")
                {
                    var tipo = '0';
                }else
                {
                    var tipo = '1';
                }
                var tipo;
                var miCheckbox = document.getElementById('tipo');
                if (miCheckbox.checked) {
                    tipo = '0';
                } else {
                    tipo = '1';
                }
                */
                const _token = $("input[name=_token]").val();

                $.ajax({
                    url: '/interno/editar/' + interno_id,
                    type: 'POST',
                    data: {
                        nombre: nombre,
                        tipo: tipo,
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
                                    location.href = '/internos';
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
                                    location.href = '/internos/'+interno_id+'/edit';
                                }
                            });
                        }
                    }
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

