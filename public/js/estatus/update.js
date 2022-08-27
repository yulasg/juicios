
// Define form element
const formularioEstatu = document.getElementById('actualizarEstatu');

// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formularioEstatu,
    {
        fields: {
            'descripcion': {
                validators: {
                    notEmpty: {
                        message: 'El campo descripción del estatu, es obligatorio'
                    }
                }
            },
            'terminado': {
                validators: {
                    notEmpty: {
                        message: 'El campo terminado, es obligatorio'
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
                const estatu_id = $('#estatu_id').val();
                const descripcion = $('#descripcion').val();
                const terminado = $('#terminado').val();
                const _token = $("input[name=_token]").val();

                $.ajax({
                    url: '/estatu/editar/' + estatu_id,
                    type: 'POST',
                    data: {
                        descripcion: descripcion,
                        terminado: terminado,
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
                                    location.href = '/estatus';
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
                                    location.href = '/estatus/' + estatu_id + '/edit';
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