@extends('layouts.app')

@section('contenido')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="d-flex flex-wrap flex-stack mb-6">
                    <!--begin::Heading-->
                    <h3 class="fw-bolder my-2">Juicio N° {{ $dataJuicio }} 
                        <span class="fs-6 text-gray-400 fw-bold ms-1">Crear Datos</span>
                    </h3>
                    <!--end::Heading-->
                </div>
                <div class="card mb-5 mb-xl-8">
                    <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}">
                    <input type="hidden" name="role" id="role" value="{{ $role }}">
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Form-->
                        <form action="{{ route('datos.store') }}" class="form mb-15 " method="POST" id="registrar_dato"
                            name="registrar_dato">
                            @csrf
                            <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dataJuicio }}">
                            <!--begin::Input group-->
                            <div class="row mb-5 my-8">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Monto Capital</span>
                                        <div class="flex-grow-1">
                                            <input type="text"
                                                class="form-control form-control-sm rounded-start-0 formulario__input"
                                                id="capital" name="capital">
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
                                                id="monto" name="monto">
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
                                            <select class="form-select form-select-sm rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="tasa" name="tasa">
                                                <option></option>
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
                                                id="interes" name="interes">
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
                                                id="mora" name="mora">
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
                                                id="juez" name="juez">
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
                                        <label class="fs-6 fw-bold mb-2">Observación</label>
                                        <textarea class="form-control form-control-solid" rows="8" name="observacion" id="observacion"></textarea>
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
                        <button type="submit" class="btn btn-primary" id="crear" name="crear">
                            <!--begin::Indicator-->
                            <span class="indicator-label">Finalizar</span>
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
    <!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
    <!--<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>-->
    <!--<script src="{{ asset('js/datos/editor.js') }}"></script>-->
    <script src="{{ asset('js/datos/select2.js') }}"></script>
    <script src="{{ asset('js/datos/create.js') }}"></script>
    <script src="{{ asset('js/general/regresarJuicio.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
