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
                    <h3 class="fw-bolder my-2">Editar Estados </h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <form action="/ubicacion/editar/{{ $ubicacion->id }}" method="POST" name="actualizarUbicacion"
                            id="actualizarUbicacion">
                            @csrf
                            <input type="hidden" name="ubicacion_id" id="ubicacion_id" value="{{ $ubicacion->id }} ">
                            @csrf
                            <div class="row">
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <label class="required fs-5 fw-bold mb-2">Descripción</label>
                                    <input type="text" name="descripcion" id="descripcion"
                                        class="form-control form-control-solid"
                                        value="{{ old('descripcion', $ubicacion->descripcion) }}"
                                        placeholder="Nombre del estado">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('ubicaciones.index') }}" class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary" name="editar" id="editar">Actualizar</button>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/ubicaciones/update.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
