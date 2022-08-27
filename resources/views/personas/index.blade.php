@extends('layouts.app')

@section('head')
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet" type="text/css">
@endsection

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
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Partes Procesales</span>
                    </h3>
                    <!--end::Heading-->
                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap my-2">
                        @if ($datarepresentante == 'U')
                            <div class="card-toolbar representa" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-trigger="hover" title="Click para asociar representante" id="representa">
                                <a href="{{ route('personas.create', [$dataJuicio, $dataespecialidad, $datarepresentante]) }}"
                                    class="btn btn-sm btn-light btn-primary me-3">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->Único Representante
                                </a>
                            </div>
                        @endif
                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                            title="Click para incluir parte procesal">
                            <a href="{{ route('personas.create', [$dataJuicio, $dataespecialidad, $datarepresentante]) }}"
                                class="btn btn-sm btn-light btn-primary">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                            rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                            fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Nueva Parte Procesal
                            </a>
                        </div>
                    </div>
                    <!--end::Actions-->
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
                <!--end::Toolbar-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dataJuicio }}">
                    <input type="hidden" name="especialidad_id" id="especialidad_id" value="{{ $dataespecialidad }}">
                    <input type="hidden" name="representante" id="representante" value="{{ $datarepresentante }}">
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <input type="hidden" name="role" id="role" value="{{ $role }}">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <table id="tabla" name="tabla"
                                class="table  table-striped table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th class="min-w-50px">Id</th>
                                        <th class="min-w-120px"></th>
                                        <th class="min-w-60">Tipo</th>
                                        <th class="min-w-20">Especialidad</th>
                                        <th class="min-w-20">Parte Procesal</th>
                                        <th class="min-w-100">N° Identificación</th>
                                        <th class="min-w-100">Nombre</th>
                                        <th class="min-w-100">N° Habitación</th>
                                        <th class="min-w-100">N° Celular</th>
                                        <th class="min-w-100">Correo Electrónico</th>
                                        <th class="min-w-100">Dirección</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
                        <button type="submit" class="btn btn-primary" id="siguiente" name="siguiente">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Siguiente</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator-->
                        </button>
                        <!--end::Submit-->
                    </div>
                </div>
                <!--end::Tables Widget 9-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection

@push('pageScripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/personas/index.js') }}"></script>
    <script src="{{ asset('js/personas/eliminar.js') }}"></script>
    <script src="{{ asset('js/personas/siguiente.js') }}"></script>
    <script src="{{ asset('js/general/regresarJuicio.js') }}"></script>
@endpush
