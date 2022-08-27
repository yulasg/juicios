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
                    <h3 class="fw-bolder my-2">Consulta de Juicios Especialidades</h3>
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
                                        <th class="min-w-50px">Especialidad</th>
                                        <th class="min-w-50px">Ministerio Público o Demandante(s)</th>
                                        <th class="min-w-50px">Victima(s) o Demandado(s)</th>
                                        <th class="min-w-50px">Victimario(s) o Tercero(s)</th>
                                        <th class="min-w-50px">Procedencia</th>
                                        <th class="min-w-50px">Ubicación</th>
                                        <th class="min-w-50px">Expediente</th>
                                        <th class="min-w-50px">Terminado</th>
                                        <th class="min-w-50px">Estatu</th>
                                        <th class="min-w-50px">Juzgado</th>
                                        <th class="min-w-50px">Tribunal</th>
                                        <th class="min-w-50px">Abogado Interno</th>
                                        <th class="min-w-50px">Abogado Externo</th>
                                        <th class="min-w-50px">Obligación</th>
                                        <th class="min-w-50px">Estado Procesal</th>
                                        <th class="min-w-50px">Proceso</th>
                                        <th class="min-w-50px">Pretensión</th>
                                        <th class="min-w-50px">Garantía</th>
                                        <th class="min-w-50px">Llevado</th>
                                        <th class="min-w-50px">Medida</th>
                                        <th class="min-w-50px">Practicada?</th>
                                        <th class="min-w-50px">Moneda</th>
                                        <th class="min-w-50px">Fecha Admisión Demanda</th>
                                        <th class="min-w-50px">Fecha Asignación</th>
                                        <th class="min-w-50px">Fecha Última Actuación</th>
                                        <th class="min-w-50px">Fecha Creación</th>
                                        <th class="min-w-50px">Fecha Última Actividad</th>
                                        <th class="min-w-50px">Juez Ponente</th>
                                        <th class="min-w-50px">Observación</th>
                                        <th class="min-w-50px">Monto Capital</th>
                                        <th class="min-w-50px">Monto Demanda</th>
                                        <th class="min-w-50px">Tasa</th>
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
    <script src="{{ asset('js/juicios/consultajuicioespecialidad.js') }}"></script>
@endpush
