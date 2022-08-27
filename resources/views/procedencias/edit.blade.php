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
                    <h3 class="fw-bolder my-2">Editar Procedencia</h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <form action="/procedencia/editar/{{ $procedencia->id }}" method="POST"
                            name="actualizarProcedencia" id="actualizarProcedencia">
                            @csrf
                            <input type="hidden" name="procedencia_id" id="procedencia_id" value="{{ $procedencia->id }} ">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--end::Label-->
                                        <label class="required fs-5 fw-bold mb-2">Código</label>
                                        <!--end::Label-->
                                        <!--end::Input-->
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Código de la procedencia" name="codigo" id="codigo"
                                            value="{{ old('codigo', $procedencia->codigo) }}">
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Descripción</label>
                                        <input type="text" name="descripcion" id="descripcion"
                                            class="form-control form-control-solid"
                                            value="{{ old('descripcion', $procedencia->descripcion) }}"
                                            placeholder="Descripción de la procedencia">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('procedencias.index') }}" class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary" name="editar" id="editar">Actualizar</button>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/procedencias/update.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
