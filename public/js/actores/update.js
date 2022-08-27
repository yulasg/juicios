const formulario = document.getElementById('editarActor');
// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    formulario,
    {
        fields: {
            'configuracion_id': {
                validators: {
                    notEmpty: {
                        message: 'La parte actora, es obligatorio'
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
 
$(formulario.querySelector('[name="configuracion_id"]')).on('change', function () {
    // Revalidate the field when an option is chosen
    validator.revalidateField('configuracion_id');
});

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
                const especialidad_id = $('#especialidad_id').val();
                const usuario = $('#usuario').val();
                const representante = $('#representante').val();
                const actor_id = $('#actor_id').val();
                const configuracion_id = $('#configuracion_id').val();    
                const estatu = $('#tipo_idx').val();
                let tipo = 'X';
                if (configuracion_id == 7 && estatu != '' ) {
                    tipo = estatu;
                }
                console.log(tipo);
                const _token = $("input[name=_token]").val();
                $.ajax({                 
                    url: '/actor/editar/'+actor_id,
                    type: 'POST',
                    data: {
                        juicio_id:juicio_id,
                        usuario: usuario,
                        configuracion_id: configuracion_id,
                        tipo: tipo,
                        _token: _token
                    },
                    success: function (response) {
                        var respons = response;
                        console.log(respons);
                        var type = respons.result
                        console.log(type);
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
                                    //location.href = '/actores/'+ juicio_id +'/'+ especialidad_id +'/'+ representante;
                                    location.href = `/actores/${juicio_id}/${especialidad_id}/${representante}`;
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
                                    location.href = '/actor/'+actor_id+'/edit';
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

