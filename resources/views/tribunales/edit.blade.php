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
                    <h3 class="fw-bolder my-2">Editar Tribunal</h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <form action="/tribunal/editar/{{ $tribunal->id }}" method="POST" id="actualizarTribunal"
                            name="actualizarTribunal">
                            @csrf
                            <input type="hidden" id="tribunal_id" name="tribunal_id" value="{{ $tribunal->id }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Juzgado</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="juzgado_id" id="juzgado_id">
                                            <option value="">Seleccione juzgado...</option>
                                            @foreach ($juzgados as $key => $value)
                                                <option value="{{ $key }}"
                                                    @if ($key == $tribunal->juzgado_id) selected @endif>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <label class="required fs-5 fw-bold mb-2">Tribunal</label>
                                        <input type="text" name="descripcion" id="descripcion"
                                            class="form-control form-control-solid"
                                            value="{{ old('descripcion', $tribunal->descripcion) }}"
                                            placeholder="Nombre del tribunal">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <a href="{{ route('tribunales.index') }}" class="btn btn-light">Cancelar</a>
                <button type="submit" class="btn btn-primary" id="editar" name="editar">Actualizar</button>

            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/tribunales/update.js') }}"></script>
    <script src="{{ asset('js/tribunales/select2.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
