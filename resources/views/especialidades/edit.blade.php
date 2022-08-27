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
                    <h3 class="fw-bolder my-2">Editar Especialidad</h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <form action="/espacialidad/editar/{{ $especialidad->id }}" method="POST" name="actualizarEstatu"
                            id="actualizarEspecialidad">
                            @csrf
                            <input type="hidden" name="especialidad_id" id="especialidad_id"
                                value="{{ $especialidad->id }} ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Tipo de Juicio</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            data-allow-clear="true" name="internacional" id="internacional"
                                            data-placeholder="Seleccionar...">>
                                            <option></option>

                                            <option {{ $especialidad->internacional == 'Nacional' ? 'selected' : '' }}
                                                value="N">
                                                Nacional</option>
                                            <option {{ $especialidad->internacional == 'Internacional' ? 'selected' : '' }}
                                                value="I">
                                                Internacional</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Especialidad</label>
                                        <input type="text" name="descripcion" id="descripcion"
                                            class="form-control form-control-solid"
                                            value="{{ old('descripcion', $especialidad->descripcion) }}"
                                            placeholder="Descripción de la especialidad">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('especialidades.index') }}" class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary" id="editar" name="editar">Actualizar</button>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/especialidades/update.js') }}"></script>
    <script src="{{ asset('js/especialidades/select2.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
