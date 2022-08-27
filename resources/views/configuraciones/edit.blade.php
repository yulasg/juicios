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
                    <h3 class="fw-bolder my-2">Editar Configuración de Especialidad</h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <form action="" method="POST" name="editarConfiguracion" id="editarConfiguracion">
                            <input type="hidden" name="internacionalx" id="internacionalx"
                                value="{{ $valorInternacional }}">
                            <input type="hidden" name="configuracion_id" id="configuracion_id"
                                value="{{ $configuracion->id }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Tipo de Juicio</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="internacional" id="internacional" data-placeholder="Seleccionar..."
                                            data-allow-clear="true">
                                            <option></option>
                                            <option {{ $valorInternacional == 'I' ? 'selected' : '' }} value="I">
                                                Internacional</option>
                                            <option {{ $valorInternacional == 'N' ? 'selected' : '' }} value="N">
                                                Nacional</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Especialidad</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            data-allow-clear="true" data-placeholder="Seleccionar..." id="especialidad_id"
                                            name="especialidad_id">
                                            <option></option>
                                            @foreach ($especialidades as $key => $value)
                                                <option value="{{ $key }}"
                                                    @if ($key == $configuracion->especialidad_id) selected @endif>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex flex-column mb-5 fv-row">
                                    <!--end::Label-->
                                    <label class="required fs-5 fw-bold mb-2">Descripción</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Descripción de la especialidad" name="descripcion" id="descripcion"
                                        value="{{ old('descripcion', $configuracion->descripcion) }}">
                                    <!--end::Input-->
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <a href="{{ route('configuraciones.index') }}" class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary" id="editar" name="editar">Actualizar</button>

            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/configuraciones/select2.js') }}"></script>
    <script src="{{ asset('js/configuraciones/cargarSelectsMostrar.js') }}"></script>
    <script src="{{ asset('js/configuraciones/update.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
