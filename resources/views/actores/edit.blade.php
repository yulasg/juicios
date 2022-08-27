@extends('layouts.app')
 
@section('contenido')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <!--begin::Heading-->
                    <h3 class="fw-bolder my-2">Juicio N°  {{ $actorEdit[0]->juicio_id }} 
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Editar Parte Procesal</span>
                    </h3>
                    <!--end::Heading-->             
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}">
                        <!--begin::Form-->
                        <form action="/actor/editar/{{ $actorEdit[0]->id }}" class="form mb-15 " method="POST"
                            id="editarActor" name="editarActor">
                            @csrf
                            <input type="hidden" name="juicio_id" id="juicio_id"
                                value="  {{ $actorEdit[0]->juicio_id }} ">
                            <input type="hidden" name="configuracion_idx" id="configuracion_idx"
                                value=" {{ $actorEdit[0]->configuracion_id }}  ">
                            <input type="hidden" name="especialidad_id" id="especialidad_id"
                                value=" {{ $actorEdit[0]->configuracion->especialidad_id }}  ">
                            <input type="hidden" name="referencia_id" id="referencia_id"
                                value=" {{ $actorEdit[0]->referencia_id }}  ">
                            <input type="hidden" name="actor_id" id="actor_id" value=" {{ $actorEdit[0]->id }}  ">
                            <input type="hidden" name="representante" id="representante" value="{{ $representante }}">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class=" fs-5 fw-bold mb-2">Naturaleza</label>
                                        <select disabled class="form-select  form-select-sm form-select-solid"
                                            data-control="select2" data-allow-clear="true" data-placeholder="Seleccionar..."
                                            name="tipo" id="tipo">
                                            <option></option>
                                            <option {{ $actorEdit[0]->referencia->tipo == 'V' ? 'selected' : '' }}
                                                value="V">V - Venezolano</option>
                                            <option {{ $actorEdit[0]->referencia->tipo == 'E' ? 'selected' : '' }}
                                                value="E">E - Extranjero</option>
                                            <option {{ $actorEdit[0]->referencia->tipo == 'J' ? 'selected' : '' }}
                                                value="J">J - Jurídico</option>
                                            <option {{ $actorEdit[0]->referencia->tipo == 'G' ? 'selected' : '' }}
                                                value="G">G - Gobierno</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class=" fs-5 fw-bold mb-2">N° Identificación</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" disabled
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Identificación" id="numero" name="numero"
                                            value="{{ old('numero', $actorEdit[0]->referencia->numero) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class=" fs-5 fw-bold mb-2">N° Rif</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" disabled
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Rif" id="rif" name="rif"
                                            value="{{ old('rif', $actorEdit[0]->referencia->rif) }}" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col--> 
                            </div>
                            <div class="row  mb-5">
                                <!--begin::Col-->
                                <div class="col-md-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Parte Procesal</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="configuracion_id"
                                                name="configuracion_id" onchange="select()">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                @if ($actorEdit[0]->configuracion_id == 7)
                                    <div class="col-md-4 fv-row" Style="display:block" id="ocultar">
                                @else
                                    <div class="col-md-4 fv-row" Style="display:none" id="ocultar">
                                @endif
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">Estatus</span>
                                            <div class="flex-grow-1">
                                                <select class="form-select form-select-sm rounded-start-0" data-allow-clear="true"
                                                    data-control="select2" data-placeholder="Seleccionar..." id="tipo_idx"
                                                    name="tipo_idx">
                                                    <option></option>
                                                    <option {{ $actorEdit[0]->tipo == 'E' ? 'selected' : '' }} value="E">
                                                        Investigado</option>
                                                    <option {{ $actorEdit[0]->tipo == 'I' ? 'selected' : '' }} value="I">Imputado
                                                    </option>
                                                    <option {{ $actorEdit[0]->tipo == 'A' ? 'selected' : '' }} value="A">Acusado
                                                    </option>
                                                    <option {{ $actorEdit[0]->tipo == 'C' ? 'selected' : '' }} value="C">
                                                        Condenado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <!--end::Col-->
                            <div class="row  mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-12 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Nombre de la Parte Procesal</span>
                                        <div class="flex-grow-1">
                                            <input disabled type="text"
                                                class="form-control  form-control-sm rounded-start-0"
                                                placeholder="Nombre de la parte procesal" id="nombre" name="nombre"
                                                value="{{ old('nombre', $actorEdit[0]->referencia->nombre) }}" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">N° Celular Pricipal</span>
                                        <div class="flex-grow-1">
                                            <input disabled type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="N° Celular Principal" id="celular_uno" name="celular_uno"
                                                value="{{ old('celular_uno', $actorEdit[0]->referencia->celular_uno) }}" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">N° Celular Secundario</span>
                                        <div class="flex-grow-1">
                                            <input disabled type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="N° Celular Secundario" id="celular_dos" name="celular_dos"
                                                value="{{ old('celular_uno', $actorEdit[0]->referencia->celular_dos) }}" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">N° Habitación</span>
                                        <div class="flex-grow-1">
                                            <input disabled type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="N° Habitación" id="habitacion" name="habitacion"
                                                value="{{ old('habitacion', $actorEdit[0]->referencia->casa) }}" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <div class="row  mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-12 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Dirección</span>
                                        <div class="flex-grow-1">
                                            <input disabled type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="Dirección" id="direccion" name="direccion"
                                                value="{{ old('direccion', $actorEdit[0]->referencia->direccion) }}" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Correo Electrónico Principal</span>
                                        <div class="flex-grow-1">
                                            <input disabled type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="Correo Electrónico Principal" id="email1" name="email1"
                                                value="{{ old('email1', $actorEdit[0]->referencia->email_principal) }}" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Correo Electrónico Secundario</span>
                                        <div class="flex-grow-1">
                                            <input disabled type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="Correo Electrónico Secundario" id="email2" name="email2"
                                                value="{{ old('email2', $actorEdit[0]->referencia->email_secundario) }}" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->                       
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <!--begin::Submit-->
                        <button type="submit" class="btn btn-primary" id="regresar" name="regresar">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Regresar</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator-->
                        </button>
                        <!--end::Submit-->
                    </div>
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-2">
                        <!--begin::Submit-->
                        <button type="submit" class="btn btn-primary" id="editar" name="editar">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Actualizar</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator-->
                        </button>
                        <!--end::Submit-->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/actores/cargarSelectsMostrar.js') }}"></script>
    <script src="{{ asset('js/actores/select2.js') }}"></script>
    <script src="{{ asset('js/actores/ocultar.js') }}"></script>
    <script src="{{ asset('js/actores/update.js') }}"></script>
    <script src="{{ asset('js/general/regresarActor.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
