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
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Asignar Abogado Interno</span>
                    </h3>
                    <!--end::Heading-->

                </div>
                @if ($message = Session::get('success'))
                    <!--begin::Alert-->
                    <div
                        class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row p-5 mb-10">
                        <!--begin::Icon-->
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4 mb-5 mb-sm-0"></span>
                        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <!--begin::Title-->
                            <h5 class="mb-1">Esta es una alerta</h5>
                            <!--end::Title-->
                            <!--begin::Content-->
                            <span>{!! session('success') !!}</span>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Close-->
                        <button type="button"
                            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                            data-bs-dismiss="alert">
                            <i class="bi bi-x fs-1 text-danger"></i>
                        </button>
                        <!--end::Close-->
                    </div>
                    <!--end::Alert-->
                @endif
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <!--<div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-3 mb-1">Asignar Abogado Interno al Juicio N°
                                            {{ $dataJuicio }} </span>
                                        <input type="hidden" name="nroJuicio" id="nroJuicio" value="{{ $dataJuicio }}">
                                        <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dataJuicio }}">
                                    </h3>
                                </div>-->
                    <!--begin end::Header-->
                    <!--begin::Body-->
                    <input type="hidden" name="nroJuicio" id="nroJuicio" value="{{ $dataJuicio }}">
                    <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dataJuicio }}">
                    <div class="card-body  pt-5">
                        <!--begin::Form-->
                        <form action="/abogados" method="POST" name="registrar_abogado" id="registrar_abogado">
                            @csrf
                            <div class="row  mb-5">
                                <div class="col-sm-5 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Abogado Interno</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-md rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="interno_id" name="interno_id">
                                                <option></option>
                                                @foreach ($internos as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary mb-3" name="crearAbogado"
                                        id="crearAbogado">Incluir</button>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                        <div class="col-md-12">
                            <input type="hidden" name="role" id="role" value="{{ $role }}">
                            <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table id="tabla_abogados_internos" name="tabla_abogados_internos"
                                    class="table  table-striped table-row-bordered gy-5 gs-7 border rounded ">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bolder text-muted">
                                            <th class="min-w-10px">id</th>
                                            <th class="min-w-50px">Abogado</th>
                                            <th class="min-w-50px">Usuario</th>
                                            <th class="min-w-50px">Fecha</th>
                                            <th class="min-w-50px">Acción</th>
                                        </tr>
                                    </thead>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                    </div>
                    <!--begin end::Body-->
                </div>
                <div class="row">
                    <div class="col-md-10">
                    </div>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/abogados/select2.js') }}"></script>
    <script src="{{ asset('js/abogados/index.js') }}"></script>
    <script src="{{ asset('js/abogados/store.js') }}"></script>
    <script src="{{ asset('js/abogados/eliminar.js') }}"></script>
    <script src="{{ asset('js/general/regresarJuicio.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
