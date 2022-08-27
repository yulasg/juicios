@extends('layouts.app')

@section('contenido')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-5 mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Juicio N° {{ $dato->id }}</span>
                        </h3>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Form-->
                        <form action="" class="form mb-15 " method="POST">
                            @csrf
                            <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dato->id }}">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Fecha Demanda</span>
                                        <div class="flex-grow-1">
                                            <input type="date" class="form-control form-control-sm rounded-start-0"
                                                id="demanda" name="demanda"
                                                value="{{ old('demanda', $dato->fecha_demanda) }}">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Fecha Asignación</span>
                                        <div class="flex-grow-1">
                                            <input type="date" class="form-control form-control-sm rounded-start-0"
                                                id="asignacion" name="asignacion"
                                                value="{{ old('asignacion', $dato->fecha_asignacion) }}">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Fecha Actuación</span>
                                        <div class="flex-grow-1">
                                            <input type="date" class="form-control form-control-sm rounded-start-0"
                                                id="actuacion" name="actuacion"
                                                value="{{ old('actuacion', $dato->fecha_actuacion) }}">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Fecha Actividad</span>
                                        <div class="flex-grow-1">
                                            <input type="date" class="form-control form-control-sm rounded-start-0"
                                                id="actividad" name="actividad"
                                                value="{{ old('actividad', $dato->fecha_actividad) }}">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Monto Capital</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0t"
                                                id="capital" name="capital" value="{{ old('capital', $dato->capital) }}">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Monto Demanda</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                id="monto" name="monto" value="{{ old('monto', $dato->monto) }}">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Tasa</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-sm rounded-start-0" id="tasa"
                                                name="tasa">
                                                <option value="">Seleccionar...</option>
                                                <option value="F">Fija</option>
                                                <option value="V">Variable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Interes</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                id="interes" name="interes" value="{{ old('interes', $dato->interes) }}">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Mora</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                id="mora" name="mora" value="{{ old('mora', $dato->mora) }}">
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
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Juez Ponente</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                id="juez" name="juez" value="{{ old('juez', $dato->juez) }}">
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
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Observación</span>
                                        <div class="flex-grow-1">
                                            <input type="text" class="form-control form-control-sm rounded-start-0"
                                                id="observacion" name="observacion"
                                                value="{{ old('observacion', $dato->observacion) }}">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Separator-->
                            <div class="separator mb-8"></div>
                            <!--end::Separator-->
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
                                    <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                        <!--begin::Indicator-->
                                        <span class="indicator-label">Siguiente</span>
                                        <span class="indicator-progress">Por favor espere...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        <!--end::Indicator-->
                                    </button>
                                    <!--end::Submit-->
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/general/regresarJuicio.js') }}"></script>
@endpush