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
                    <h3 class="fw-bolder my-2">Crear Procedencia</h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <form action="{{ route('procedencias.store') }}" method="POST" id="crearProcedencia"
                            name="crearProcedencia">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="required fs-5 fw-bold mb-2">Código</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Código de la procedencia" name="codigo" id="codigo"
                                            value="{{ old('codigo') }}">
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="required fs-5 fw-bold mb-2">Descripción</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Descripción de la procedencia" name="descripcion" id="descripcion"
                                            value="{{ old('descripcion') }}">
                                        <!--end::Input-->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('procedencias.index') }}" class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary" id="crear" name="crear">Crear</button>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/procedencias/store.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
