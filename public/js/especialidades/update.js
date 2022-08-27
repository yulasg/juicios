
// Define form element
const formularioEspecialidad = document.getElementById('actualizarEspecialidad');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formularioEspecialidad,
    {
        fields: {
            'internacional': {
                validators: {
                    notEmpty: {
                        message: 'El tipo de juicio, es obligatorio'
                    }
                }
            },
            'descripcion': {
                validators: {
                    notEmpty: {
                        message: 'La descripción de la especialidad, es obligatorio'
                    },
                    stringLength: {
                        max: 50,
                        message: 'La descripción de la especialidad, debe tener un máximo de 50 caracteres ',
                    }
                }
            }
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
                const especialidad_id = $('#especialidad_id').val();
                const descripcion = $('#descripcion').val();
                const internacional = $('#internacional').val();
                const _token = $("input[name=_token]").val();
                
                $.ajax({
                    url: '/especialidad/editar/' + especialidad_id,
                    type: 'POST',
                    data: {
                        descripcion: descripcion,
                        internacional: internacional,
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
                                    location.href = '/especialidades';
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
                                    location.href = '/especialidades/'+ especialidad_id+'/edit';
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