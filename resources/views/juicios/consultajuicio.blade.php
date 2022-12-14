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
                    <h3 class="fw-bolder my-2">Consulta de Juicios Especialidad Fogade</h3>
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
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <table id="tabla_juicios"
                                class="table  table-striped  table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <!--<th class="min-w-50px">Acciones</th>-->
                                        <th class="min-w-40px">Id</th>
                                        <th class="min-w-50px">Tipo</th>
                                        <th class="min-w-50px">Origen</th>
                                        <th class="min-w-50px">Demandante(s)</th>
                                        <th class="min-w-50px">Demandado(s)</th>
                                        <th class="min-w-50px">Procedencia</th>
                                        <th class="min-w-50px">Ubicaci??n</th>
                                        <th class="min-w-50px">Expediente</th>
                                        <th class="min-w-50px">Terminado</th>
                                        <th class="min-w-50px">Estatu</th>
                                        <th class="min-w-50px">Juzgado</th>
                                        <th class="min-w-50px">Tribunal</th>
                                        <th class="min-w-50px">Abogado Interno</th>
                                        <th class="min-w-50px">Abogado Externo</th>
                                        <th class="min-w-50px">Obligaci??n</th>
                                        <th class="min-w-50px">Estado Procesal</th>
                                        <th class="min-w-50px">Proceso</th>
                                        <th class="min-w-50px">Pretensi??n</th>
                                        <th class="min-w-50px">Garant??a</th>
                                        <th class="min-w-50px">Llevado</th>
                                        <th class="min-w-50px">Medida</th>
                                        <th class="min-w-50px">Practicada?</th>
                                        <th class="min-w-50px">Moneda</th>
                                        <th class="min-w-50px">Fecha Admisi??n Demanda</th>
                                        <th class="min-w-50px">Fecha Asignaci??n</th>
                                        <th class="min-w-50px">Fecha ??ltima Actuaci??n</th>
                                        <th class="min-w-50px">Fecha Creaci??n</th>
                                        <th class="min-w-50px">Fecha ??ltima Actividad</th>
                                        <th class="min-w-50px">Juez Ponente</th>
                                        <th class="min-w-50px">Observaci??n</th>
                                        <th class="min-w-50px">Monto Capital</th>
                                        <th class="min-w-50px">Monto Demanda</th>
                                        <th class="min-w-50px">Tasa</th>
                                        <th class="min-w-50px">Mora</th>
                                        <th class="min-w-50px">Intereses</th>
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
    <script src="{{ asset('js/juicios/consultajuicio.js') }}"></script>
@endpush
