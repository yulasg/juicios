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
                    <h3 class="fw-bolder my-2">Editar Abogado Interno</h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <form action="/interno/editar/{{ $interno->id }}" method="POST" id="actualizarInterno"
                            name="actualizarInterno">
                            @csrf
                            <input type="hidden" id="interno_id" name="interno_id" value="{{ $interno->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Abogado Interno</label>
                                        <input type="text" name="nombre" id="nombre"
                                            class="form-control form-control-solid"
                                            value="{{ old('nombre', $interno->nombre) }}"
                                            placeholder="Nombre del abogado interno">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Tipo de cargo</label>
                                        <select class="form-select form-select-solid" data-control="select2" name="tipo"
                                            id="tipo">
                                            <option value="">Seleccionar...</option>

                                            <option {{ $interno->tipo == 'Abogado' ? 'selected' : '' }} value="0">
                                                Abogado</option>
                                            <option {{ $interno->tipo == 'Consultor, Gerente o Jefe' ? 'selected' : '' }}
                                                value="1">
                                                Consultor, Gerente o Jefe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('internos.index') }}" class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary" name="editar" id="editar">Actualizar</button>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/internos/update.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
