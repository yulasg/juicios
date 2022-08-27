@extends('layouts.app')

@section('contenido')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <!--begin::Heading-->
                    <h3 class="fw-bolder my-2">Juicio N° {{ $movimiento->juicio_id }} 
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Editar Actividad N° {{ $movimiento->id }}</span>
                    </h3>
                    <!--end::Heading-->
                </div>
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Form-->
                        <form action="/movimiento/editar/{{ $movimiento->id }}" class="form mb-15 " method="POST"
                            id="actualizar_movimiento" name="actualizar_movimiento">
                            @csrf
                            <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}">
                            <input type="hidden" name="movimiento_id" id="movimiento_id" value="{{ $movimiento->id }}">
                            <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $movimiento->juicio_id }}">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Fecha</span>
                                        <div class="flex-grow-1">
                                            <input type="date" class="form-control form-control-sm rounded-start-0"
                                                id="fecha" name="fecha"
                                                value="{{ old('fecha', $movimiento->fecha_movimiento) }}">

                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-12 fv-row">
                                    <div class="flex-grow-1">
                                        <label class="fs-6 fw-bold mb-2">Actividad</label>
                                        <textarea class="form-control form-control-solid" rows="9" name="movimiento" id="movimiento">{{ $movimiento->movimiento }}</textarea>
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
                    <div class="col-md-2">
                        <!--begin::Submit-->
                        <button type="submit" class="btn btn-primary" id="regresar" name="regresar">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Regresar</span>
                            <span class="indicator-progress">Por favor espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator-->
                        </button>
                        <!--end::Submit-->
                    </div>
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-2">
                        <!--begin::Submit-->
                        <button type="submit" class="btn btn-primary" id="editar" name="editar">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Actualizar</span>
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
    <!--<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>>-->
    <!--<script src="{{ asset('js/movimientos/editor.js') }}"></script>-->
    <script src="{{ asset('js/movimientos/update.js') }}"></script>
    <script src="{{ asset('js/general/regresarMovimiento.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
