

const formulario = document.getElementById('registrar_relacion');
// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formulario,
    {
        fields: {
            'juicio1_id': {
                validators: {
                    notEmpty: {
                        message: 'El campo N° Juicio, es obligatorio'
                    },
                    numeric: {
                        message: 'El campo N° Juicio, debe ser numérico',
                    },
                    stringLength: {
                        max: 5,
                        message: 'El campo N° Juicio, debe tener un máximo de 5 caracteres ',
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

// Submit button handler
const submitButton = document.getElementById('crear');
submitButton.addEventListener('click', function (e) {
    // Prevent default button action
    e.preventDefault();
    // Validate form before submit
    const role = $('#role').val();
    if (role == 'gerente') {
        if (validator) {
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    const juicio_id = $('#juicio1_id').val();
                    const juicio1_id = $('#juicio_id').val();
                    const usuario = $('#usuario').val();
                    const _token = $("input[name=_token]").val();
                    $.ajax({
                        url: '/relaciones',
                        type: 'POST',
                        data: {
                            juicio_id: juicio_id,
                            juicio1_id: juicio1_id,
                            usuario: usuario,
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
                                        //$('#tabla_relaciones').DataTable().ajax.reload();
                                        location.href = '/relaciones/' + juicio1_id;
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
                    })
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
    } else {
        Swal.fire('Usuario no autorizado, para crear relación de juicios.')
    }
});
