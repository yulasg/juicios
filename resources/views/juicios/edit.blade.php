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
                    <h3 class="fw-bolder my-2">Juicio N° {{ $juicio->id }} 
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Editar</span>
                    </h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <!--begin::Form-->
                        <!--<form action="" class="form mb-15" method="post" id="kt_careers_form">-->
                        <form action="/juicio/editar/{{ $juicio->id }}" method="POST" name="actualizar_juicio"
                            id="actualizar_juicio">
                            <input type="hidden" name="juiciox" id="juiciox" value="{{ $juicio->id }}">
                            <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}">
                            @csrf
                            <!--begin::Input group-->
                            <div class="row mb-5 my-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Tipo de Juicio</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="internacional" name="internacional">
                                                <option></option>
                                                <option {{ $juicio->tipo == 'Internacional' ? 'selected' : '' }}
                                                    value="I">
                                                    Internacional</option>
                                                <option {{ $juicio->tipo == 'Nacional' ? 'selected' : '' }} value="N">
                                                    Nacional</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Especialidad</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="especialidad_id"
                                                name="especialidad_id">
                                                <option></option>
                                                @foreach ($especialidades as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->especialidad_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->

                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">


                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Origen del Juicio</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="origen" name="origen">
                                                <option></option>
                                                <option {{ $juicio->origen == 'Fogade' ? 'selected' : '' }} value="F">
                                                    Fogade
                                                </option>
                                                <option {{ $juicio->origen == 'Banca en Liquidación' ? 'selected' : '' }}
                                                    value="B">Banca
                                                    en Liquidación</option>
                                                <option
                                                    {{ $juicio->origen == 'Fogade / Banca en Liquidación' ? 'selected' : '' }}
                                                    value="A">Fogade
                                                    / Banca en Liquidación</option>
                                                <option
                                                    {{ $juicio->origen == 'Crédito Cedido a Fogade' ? 'selected' : '' }}
                                                    value="C">Crédito
                                                    Cedido a Fogade</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Expediente</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                data-allow-clear="true" placeholder="N° Expediente" id="expediente"
                                                name="expediente" value="{{ old('expediente', $juicio->expediente) }}" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->


                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Procedencia</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="procedencia_id" name="procedencia_id">
                                                <option></option>
                                                @foreach ($procedencias as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->procedencia_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Ubicación</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="ubicacion_id" name="ubicacion_id">
                                                <option></option>
                                                @foreach ($ubicaciones as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->ubicacion_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Representante(s)</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="representante"
                                                name="representante">
                                                <option></option>
                                                <option {{ $juicio->representante == 'U' ? 'selected' : '' }}
                                                    value="U">
                                                    Único</option>
                                                <option {{ $juicio->representante == 'V' ? 'selected' : '' }}
                                                    value="V">
                                                    Varios</option>
                                                <option {{ $juicio->representante == 'N' ? 'selected' : '' }}
                                                    value="N">
                                                    Ninguno</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Terminado</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="terminado_id" name="terminado_id">
                                                <option></option>
                                                <option value="S">Si</option>
                                                <option value="N">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Estatu</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="estatu_id" name="estatu_id">
                                                <option></option>
                                                @foreach ($estatus as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->estatu_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-12 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Juzgado</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="juzgado_id" name="juzgado_id">
                                                <option></option>
                                                @foreach ($juzgados as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!--end::Col-->

                            </div>
                            <!--end::Input group-->


                            <!--begin::Input group-->
                            <div class="row mb-5">

                                <!--begin::Col-->
                                <div class="col-sm-12 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Tribunal</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="tribunal_id" name="tribunal_id">
                                                <option></option>
                                                @foreach ($tribunales as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->tribunal_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Abogado Interno</span>
                                        <div class="flex-grow-1">
                                            <select disabled class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="interno_id" name="interno_id">
                                                <option></option>
                                                @foreach ($internos as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->interno_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Abogado Externo</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="externo_id" name="externo_id">
                                                <option></option>
                                                @foreach ($externos as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->externo_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Tipo de Obligación</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="obligacion_id"
                                                name="obligacion_id">
                                                <option></option>
                                                @foreach ($obligaciones as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->obligacion_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Estado Procesal</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="estado_id" name="estado_id">
                                                <option></option>
                                                @foreach ($estados as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->estado_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Tipo de Proceso</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="demanda_id" name="demanda_id">
                                                <option></option>
                                                @foreach ($demandas as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->demanda_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Pretensión</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="pretension_id"
                                                name="pretension_id">
                                                <option></option>
                                                @foreach ($pretensiones as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->pretension_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Garantía</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="garantia_id" name="garantia_id">
                                                <option></option>
                                                @foreach ($garantias as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->garantia_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Llevado por</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="llevado" name="llevado">
                                                <option></option>
                                                <option {{ $juicio->llevado == 'Consultoría Jurídica' ? 'selected' : '' }}
                                                    value="CJ">
                                                    Consultoría Jurídica</option>
                                                <option {{ $juicio->llevado == 'Abogado Externo' ? 'selected' : '' }}
                                                    value="AE">
                                                    Abogado Externo</option>
                                                <option
                                                    {{ $juicio->llevado == 'Sin Valor Sistema Anterior' ? 'selected' : '' }}
                                                    value="AE">
                                                    Sin Valor Sistema Anterior</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-5 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Medida</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="medida_id" name="medida_id">
                                                <option></option>
                                                @foreach ($medidas as $key => $value)
                                                    <option value="{{ $key }}"
                                                        @if ($key == $juicio->medida_id) selected @endif>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Practicada?</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="practicada" name="practicada">
                                                <option></option>
                                                <option {{ $juicio->practicada == 'Si' ? 'selected' : '' }}
                                                    value="S">Si
                                                </option>
                                                <option {{ $juicio->practicada == 'No' ? 'selected' : '' }}
                                                    value="N">No
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Moneda</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="moneda" name="moneda">
                                                <option></option>
                                                <option {{ $juicio->moneda == 'Dólares $' ? 'selected' : '' }}
                                                    value="US">
                                                    Dólares $</option>
                                                <option {{ $juicio->moneda == 'Bolívares Bs.F.' ? 'selected' : '' }}
                                                    value="BS">
                                                    Bolívares Bs.F.</option>
                                                <option {{ $juicio->moneda == 'Sin Valor' ? 'selected' : '' }}
                                                    value="NA">
                                                    Sin Valor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Admisión Demanda</span>
                                        <div class="flex-grow-1">
                                            <input type="date" class="form-control form-control-sm rounded-start-0"
                                                id="admision" name="admision"
                                                value="{{ old('admision', $juicio->fecha_admision) }}">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Asignación</span>
                                        <div class="flex-grow-1">
                                            <input type="date" class="form-control form-control-sm rounded-start-0"
                                                id="asignacion" name="asignacion"
                                                value="{{ old('asignacion', $juicio->fecha_asignacion) }}">
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
                            <span class="indicator-label">Siguiente</span>
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
    <script src="{{ asset('js/juicios/select2.js') }}"></script>
    <script src="{{ asset('js/juicios/cargarSelects.js') }}"></script>
    <script src="{{ asset('js/juicios/mostrarJuzgado.js') }}"></script>
    <script src="{{ asset('js/juicios/mostrarTerminado.js') }}"></script>
    <script src="{{ asset('js/juicios/update.js') }}"></script>
    <script src="{{ asset('js/general/regresarJuicio.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
