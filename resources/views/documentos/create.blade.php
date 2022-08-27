@extends('layouts.app')

@section('contenido')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <!--begin::Heading-->
                    <h3 class="fw-bolder my-2">Juicio N° {{ $dataJuicio }}
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Crear Pagare</span>
                    </h3>
                    <!--end::Heading-->
                </div>
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Form-->
                        <form action="{{ route('documentos.store') }}" class="form mb-15 " method="POST"
                            id="registrarDocumento" name="registrarDocumento">
                            @csrf
                            <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dataJuicio }}">
                            <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">N° Pagare</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                placeholder="N° Pagare" id="numero" name="numero" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Inicio</span>
                                        <div class="flex-grow-1">
                                            <input type="date" class="form-control form-control-sm rounded-start-0"
                                                id="inicio" name="inicio" value="">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Vencimiento</span>
                                        <div class="flex-grow-1">
                                            <input type="date" class="form-control form-control-sm rounded-start-0"
                                                id="fin" name="fin" value="">
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
                    <div class="col-md-10">
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
    <script src="{{ asset('js/documentos/store.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
