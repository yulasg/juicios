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
                    <h3 class="fw-bolder my-2">Agenda</h3>
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
                    <input type="hidden" name="role" id="role" value="{{ $role }}">
                    <div class="row mb-5">
                        <div class="col-sm-4 fv-row card-header border-0 pt-11">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Fecha Agenda</span>
                                <div class="flex-grow-1">
                                    <input type="date" class="form-control form-control-sm rounded-start-0 inicio"
                                        id="inicio" name="inicio" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <!--end::Col-->
                        <div class="col-md-4">
                            <br>
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary btn-sm mt-5" id="buscar" name="buscar">
                                <!--begin::Indicator-->
                                <span class="indicator-label">Buscar</span>
                                <span class="indicator-progress">Por favor espere...
                                    <span class="spinner-border spinner-border-sm align-middle ms-4"></span></span>
                                <!--end::Indicator-->
                            </button>
                            <!--end::Submit-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <table id="tabla_agendas"
                                class="table  table-striped table-row-bordered gy-5 gs-7  border rounded tabla_agendas">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th class="min-w-50px">Id</th>
                                        <th class="min-w-150px">Fecha y Hora</th>
                                        <th class="min-w-90px">Destino</th>
                                        <th class="min-w-90px">Asunto</th>
                                        <th class="min-w-90px">Referencia</th>
                                        <th class="min-w-90px">Otro Referencia</th>
                                        <th class="min-w-50px">Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
    <script src="{{ asset('js/agendas/index.js') }}"></script>
    <script src="{{ asset('js/agendas/eliminar.js') }}"></script>
    <!--e<script src="{{ asset('js/agendas/buscar.js') }}"></script>-->
@endpush
