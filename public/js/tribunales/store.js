const formularioTribunal = document.getElementById('crearTribunal');
// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formularioTribunal,
    {
        fields: {
            'juzgado_id': {
                validators: {
                    notEmpty: {
                        message: 'El juzgado, es obligatorio'
                    }
                }
            },
            'descripcion': {
                validators: {
                    notEmpty: {
                        message: 'La descripción del tribunal, es obligatorio'
                    },
                    stringLength: {
                        max: 50,
                        message: 'La descripción del tribunal, debe tener un máximo de 50 caracteres ',
                    }
                }
            }
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
$(formularioTribunal.querySelector('[name="juzgado_id"]')).on('change', function () {
    // Revalidate the field when an option is chosen
    validator.revalidateField('juzgado_id');
});


//const juicio_id = $('#nroJuicio').val();
// Submit button handler
const submitButton = document.getElementById('crear');
submitButton.addEventListener('click', function (e) {
    e.preventDefault();
    // Validate form before submit
    if (validator) {
        validator.validate().then(function (status) {
            if (status == 'Valid') {
                const juzgado_id = $('#juzgado_id').val();
                const descripcion = $('#descripcion').val();
                const _token = $("input[name=_token]").val();
                $.ajax({
                    // url: "{{ route('personas.store') }}",
                    url: '/tribunales',
                    type: 'POST',
                    data: {
                        juzgado_id: juzgado_id,
                        descripcion: descripcion,
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
                                    location.href = '/tribunales';
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
