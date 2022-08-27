const formulario = document.getElementById('actualizar_juicio');
// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
      formulario,
      {
            fields: {
                  'internacional': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo tipo de juicio, es obligatorio'
                              }

                        }
                  },
                  'representante': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo representante, es obligatorio'
                              }

                        }
                  },
                  'especialidad_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo especialidad, es obligatorio'
                              }

                        }
                  },
                  'origen': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo origen del juicio, es obligatorio'
                              }

                        }
                  },
                  'procedencia_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo procedencia, es obligatorio'
                              }

                        }
                  },
                  'ubicacion_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo ubicación, es obligatorio'
                              }

                        }
                  },
                  'terminado_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo terminado, es obligatorio'
                              }

                        }
                  },
                  'estatu_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo estatu, es obligatorio'
                              }

                        }
                  },
                  'juzgado_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo juzgado, es obligatorio'
                              }

                        }
                  },
                  'tribunal_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo tribunal, es obligatorio'
                              }

                        }
                  },
                  'interno_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo abogado interno, es obligatorio'
                              }

                        }
                  },
                  'externo_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo abogado externo, es obligatorio'
                              }

                        }
                  },
                  'obligacion_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo tipo de obligación, es obligatorio'
                              }

                        }
                  },
                  'estado_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo tipo de estado procesal, es obligatorio'
                              }

                        }
                  },
                  'demanda_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo tipo de proceso, es obligatorio'
                              }

                        }
                  },
                  'pretension_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo tipo de pretensión, es obligatorio'
                              }

                        }
                  },
                  'garantia_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo tipo de garantía, es obligatorio'
                              }

                        }
                  },
                  'llevado': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo llevado por, es obligatorio'
                              }

                        }
                  },
                  'medida_id': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo tipo de medida, es obligatorio'
                              }

                        }
                  },
                  'practicada': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo practicada, es obligatorio'
                              }

                        }
                  },
                  'moneda': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo tipo de moneda, es obligatorio'
                              }

                        }
                  },
                  'admision': {
                        validators: {
                              notEmpty: {
                                    message: 'La fecha admisión de la demanda, es obligatoria',
                              },
                              date: {
                                    format: 'YYYY-MM-DD',
                                    message: 'La fecha admisión de la demanda, no tiene formato valido dd/mm/yyyy',
                              }
                        }
                  },
                  'asignacion': {
                        validators: {
                              notEmpty: {
                                    message: 'La fecha asignación, es obligatoria',
                              },
                              date: {
                                    format: 'YYYY-MM-DD',
                                    message: 'La fecha asignación, no tiene formato valido dd/mm/yyyy',
                              }
                        }
                  },
                  'expediente': {
                        validators: {
                              notEmpty: {
                                    message: 'El campo expendiente, es obligatorio'
                              },
                              stringLength: {
                                    max: 30,
                                    message: 'El expendientez, debe tener un máximo de 30 caracteres ',
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
$(formulario.querySelector('[name="internacional"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('internacional');
});
$(formulario.querySelector('[name="representante"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('representante');
});
$(formulario.querySelector('[name="especialidad_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('especialidad_id');
});
$(formulario.querySelector('[name="origen"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('origen');
});
$(formulario.querySelector('[name="procedencia_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('procedencia_id');
});
$(formulario.querySelector('[name="ubicacion_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('ubicacion_id');
});
$(formulario.querySelector('[name="terminado_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('terminado_id');
});
$(formulario.querySelector('[name="estatu_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('estatu_id');
});
$(formulario.querySelector('[name="juzgado_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('juzgado_id');
});
$(formulario.querySelector('[name="tribunal_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('tribunal_id');
});
$(formulario.querySelector('[name="interno_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('interno_id');
});
$(formulario.querySelector('[name="externo_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('externo_id');
});
$(formulario.querySelector('[name="obligacion_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('obligacion_id');
});
$(formulario.querySelector('[name="estado_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('estado_id');
});
$(formulario.querySelector('[name="demanda_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('demanda_id');
});
$(formulario.querySelector('[name="pretension_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('pretension_id');
});
$(formulario.querySelector('[name="garantia_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('garantia_id');
});
$(formulario.querySelector('[name="llevado"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('llevado');
});
$(formulario.querySelector('[name="medida_id"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('medida_id');
});
$(formulario.querySelector('[name="practicada"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('practicada');
});
$(formulario.querySelector('[name="moneda"]')).on('change', function () {
      // Revalidate the field when an option is chosen
      validator.revalidateField('moneda');
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

                        const juicio_id = $('#juiciox').val();
                        const usuario = $('#usuario').val();
                        const internacional = $('#internacional').val();
                        const representante = $('#representante').val();
                        const especialidad_id = $('#especialidad_id').val();
                        const origen = $('#origen').val();
                        const procedencia_id = $('#procedencia_id').val();
                        const ubicacion_id = $('#ubicacion_id').val();
                        const expediente = $('#expediente').val();
                        const estatu_id = $('#estatu_id').val();
                        const tribunal_id = $('#tribunal_id').val();
                        const interno_id = $('#interno_id').val();
                        const externo_id = $('#externo_id').val();
                        const obligacion_id = $('#obligacion_id').val();
                        const estado_id = $('#estado_id').val();
                        const demanda_id = $('#demanda_id').val();
                        const pretension_id = $('#pretension_id').val();
                        const garantia_id = $('#garantia_id').val();
                        const llevado = $('#llevado').val();
                        const medida_id = $('#medida_id').val();
                        const practicada = $('#practicada').val();
                        const moneda = $('#moneda').val();
                        const _token = $("input[name=_token]").val();
                        const admision = $('#admision').val();
                        const asignacion = $('#asignacion').val();

               

                        $.ajax({
                              //url: "{{ route('juicios.update') }}",
                              url: '/juicio/editar/' + juicio_id,
                              type: 'POST',
                              data: {
                                    internacional: internacional,
                                    usuario:usuario,
                                    representante:representante,
                                    especialidad_id: especialidad_id,
                                    origen: origen,
                                    procedencia_id: procedencia_id,
                                    ubicacion_id: ubicacion_id,
                                    expediente: expediente,
                                    estatu_id: estatu_id,
                                    tribunal_id: tribunal_id,
                                    interno_id: interno_id,
                                    externo_id: externo_id,
                                    obligacion_id: obligacion_id,
                                    estado_id: estado_id,
                                    demanda_id: demanda_id,
                                    pretension_id: pretension_id,
                                    garantia_id: garantia_id,
                                    llevado: llevado,
                                    medida_id: medida_id,
                                    practicada: practicada,
                                    moneda: moneda,
                                    admision: admision,
                                    asignacion: asignacion,
                                    _token: _token
                              },
                              success: function (response) {
                                    if (response) {
                                          // Remove loading indication
                                          submitButton.removeAttribute('data-kt-indicator');

                                          // Enable button
                                          submitButton.disabled = false;

                                          formulario.reset();
                                          // Show popup confirmation

                                          Swal.fire({
                                                text: "El registro se actualizó con exito!",
                                                icon: "success",
                                                buttonsStyling: false,
                                                confirmButtonText: "Ok!",
                                                showLoaderOnConfirm: true,
                                                customClass: {
                                                      confirmButton: "btn btn-primary",
                                                }
                                          }).then((result) => {
                                                if (result.isConfirmed) {
                                                      $('#tabla_juicios').DataTable().ajax.reload();
                                                      //location.href = '/personas/';
                                                    
                                                      
                                                      if (especialidad_id==1   || especialidad_id==2   ){
                                                            location.href = '/personas/' + juicio_id +'/'+ especialidad_id+'/'+ representante;
                                                      }else{
                                                            location.href = '/actores/' + juicio_id +'/'+ especialidad_id+'/'+ representante;
                                                      }
                                                      
                                                }
                                          });
                                    }
                              },
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
