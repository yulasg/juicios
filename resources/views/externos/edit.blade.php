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
                    <h3 class="fw-bolder my-2">Editar Abogado Externo</h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <form action="/externo/editar/{{ $externo->id }}" method="POST" name="actualizarExterno"
                            id="actualizarExterno">
                            @csrf
                            <input type="hidden" name="externo_id" id="externo_id" value="{{ $externo->id }} ">
                            <div class="row">
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">Abogado Externo</label>
                                    <input type="text" name="nombre" id="nombre"
                                        class="form-control form-control-solid"
                                        value="{{ old('nombre', $externo->nombre) }}"
                                        placeholder="Nombre del abogado externo">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('externos.index') }}" class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary" name="editar" id="editar">Actualizar</button>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/externos/update.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
