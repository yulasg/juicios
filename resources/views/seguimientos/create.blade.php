@extends('layouts.app')

@section('contenido')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <!--begin::Heading-->
                    <h3 class="fw-bolder my-2">Juicio N° {{ $dataJuicio }} 
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Crear Actuación</span>
                    </h3>
                    <!--end::Heading-->
                </div>
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Form-->
                        <form action="{{ route('seguimientos.store') }}" class="form mb-15 " method="POST"
                            id="registrar_seguimiento" name="registrar_seguimiento">
                            @csrf
                            <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dataJuicio }}">
                            <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Fecha</span>
                                        <div class="flex-grow-1">
                                            <input type="date" class="form-control form-control-sm rounded-start-0"
                                                id="fecha" name="fecha" value="">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Actividad Procesal</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar la Actividad Procesal..." id="actividad_id"
                                                name="actividad_id">
                                                <option></option>
                                                @foreach ($actividades as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
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
                                    <div class="flex-grow-1">
                                        <label class="fs-6 fw-bold mb-2">Actuación</label>
                                        <textarea class="form-control form-control-solid" rows="9" name="seguimiento" id="seguimiento"></textarea>
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
                        <button type="submit" class="btn btn-primary" id="crear" name="crear">
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
    <!--<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>-->
    <!--<script src="{{ asset('js/seguimientos/editor.js') }}"></script>>-->
    <script src="{{ asset('js/seguimientos/select2.js') }}"></script>
    <script src="{{ asset('js/seguimientos/create.js') }}"></script>
    <script src="{{ asset('js/general/regresarSeguimiento.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
