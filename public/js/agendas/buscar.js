const formulario = document.getElementById('agendaBuscar');

var validator = FormValidation.formValidation(
    formulario,
    {
          fields: {
                'inicio': {
                      validators: {
                            notEmpty: {
                                  message: 'La fecha, es obligatoria',
                            },
                            date: {
                                  format: 'YYYY-MM-DD',
                                  message: 'La fecha asignación, no tiene formato valido dd/mm/yyyy',
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
const submitButtony = document.getElementById('buscar');
submitButtony.addEventListener('click', function (e) {
    // Prevent default button action
    e.preventDefault();
    // Validate form before submit 
    if (validator) {
        validator.validate().then(function (status) {
            if (status == 'Valid') {
                const inicio = $('#inicio').val();
                const _token = $("input[name=_token]").val();
                //alert (_token);
                $.ajax({
                    url: '/agenda/buscar',
                    type: 'POST',
                    data: {
                        inicio:inicio,                       
                        _token: _token               
                    },

                    success: function (response) {
                        
                        var type = response.result
                        var datos = response.data                       
                        if (type === 'success') {
                            

                            $.ajax({
                                url: '/agenda/buscar',
                                type: 'POST',

                                data: function ( d ) {
                                    _token: _token,    
                                    d.extra_search = inicio,
                                    console.log(datos);
                                },
                                

                               
                            });

                         

                        
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

