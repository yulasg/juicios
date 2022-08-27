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
                    <h3 class="fw-bolder my-2">Juicio N° {{ $dataJuicio }} 
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Crear Parte Procesal</span>
                    </h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}">
                        <form action="" class="form mb-15 " method="POST" id="buscar_actor" name="buscar_actor">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Naturaleza</label>
                                        <select class="form-select  form-select-sm form-select-solid" data-control="select2"
                                            data-allow-clear="true" data-placeholder="Seleccionar..." name="tipo" id="tipo">
                                            <option></option>
                                            <option value="V">V - Venezolano</option>
                                            <option value="E">E - Extranjero</option>
                                            <option value="J">J - Jurídico</option>
                                            <option value="G">G - Gobierno</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="required fs-5 fw-bold mb-2">N° Identificación</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Identificación" id="numero" name="numero" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="required fs-5 fw-bold mb-2">N° Rif</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text"
                                            class="form-control form-control-sm form-control-solid rounded-start"
                                            placeholder="N° Rif" id="rif" name="rif" />
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <div class="col-md-2">
                                    <br>
                                    <!--begin::Submit-->
                                    <button type="submit" class="btn btn-primary btn-sm mt-3" id="buscar" name="buscar">
                                        <!--begin::Indicator-->
                                        <span class="indicator-label">Buscar</span>
                                        <span class="indicator-progress">Por favor espere...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator-->
                                    </button>
                                    <!--end::Submit-->
                                </div>
                            </div>
                        </form>
                        <!--begin::Form-->
                        <form action="{{ route('actores.store') }}" class="form mb-15 " method="POST"
                            id="registrarActor" name="registrarActor">
                            @csrf
                            <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dataJuicio }}">
                            <input type="hidden" name="especialidad_id" id="especialidad_id"
                                value="{{ $dataespecialidad }}">
                            <input type="hidden" name="referencia_id" id="referencia_id" value="">
                            <input type="hidden" name="representante" id="representante"
                            value="{{ $datarepresentante}}">
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
                                <div class="col-md-4 fv-row" Style="display:none" id="ocultar">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Estatus</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="tipo_idx" name="tipo_idx">
                                                <option></option>
                                                <option value="E">Investigado</option>
                                                <option value="I">Imputado</option>
                                                <option value="A">Acusado</option>
                                                <option value="C">Condenado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row  mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-12 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Nombre de la Parte Procesal</span>
                                        <div class="flex-grow-1">
                                            <input disabled type="text"
                                                class="form-control  form-control-sm rounded-start-0"
                                                placeholder="Nombre de la parte procesal" id="nombre" name="nombre" />
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
                                                placeholder="N° Celular Principal" id="celular_uno" name="celular_uno" />
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
                                                placeholder="N° Celular Secundario" id="celular_dos" name="celular_dos" />
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
                                                placeholder="N° Habitación" id="habitacion" name="habitacion" />
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
                                                placeholder="Dirección" id="direccion" name="direccion" />
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
                                                placeholder="Correo Electrónico Principal" id="email1" name="email1" />
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
                                                placeholder="Correo Electrónico Secundario" id="email2" name="email2" />
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
                        <button type="submit" class="btn btn-primary" id="crearA" name="crearA">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Guardar</span>
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
    <script src="{{ asset('js/actores/cargarSelects.js') }}"></script>
    <script src="{{ asset('js/actores/select2.js') }}"></script>
    <script src="{{ asset('js/actores/buscar.js') }}"></script>
    <script src="{{ asset('js/actores/ocultar.js') }}"></script>
    <script src="{{ asset('js/actores/store.js') }}"></script>
    <script src="{{ asset('js/general/regresarActor.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
