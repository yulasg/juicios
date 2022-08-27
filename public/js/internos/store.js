const formularioInterno= document.getElementById('crearInterno'); 
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
                //eleValidClass: ''
            })
        }
    }
);

// Submit button handler
const submitButton = document.getElementById('crear');
submitButton.addEventListener('click', function (e) {
    e.preventDefault();
    // Validate form before submit
    if (validator) {
        validator.validate().then(function (status) {
            if (status == 'Valid') {
                const nombre = $('#nombre').val();
                const tipo = $('#tipo').val();
                const _token = $("input[name=_token]").val();
                $.ajax({
                    // url: "{{ route('personas.store') }}",
                    url: '/internos',
                    type: 'POST',
                    data: {
                        tipo: tipo,
                        nombre: nombre,
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
                            })
                        }
                    }
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
