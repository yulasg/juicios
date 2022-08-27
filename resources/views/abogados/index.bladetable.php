@extends('layouts.app')

@section('contenido')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Asignar Juicio N° {{ $dataJuicio }} Abogado Interno</span>
                            <input type="hidden" name="nroJuicio" id="nroJuicio" value="{{ $dataJuicio }}">
                        </h3>
                    </div>
                    <!--begin end::Header-->
                    <!--begin::Body-->
                    <div class="card-body  pt-5">

                        <!--begin::Form-->
                        <form action="/abogados" method="POST" name="registrar_abogado" id="registrar_abogado">
                            @csrf
                            <div class="row  mb-5">
                                <div class="col-sm-5 fv-row">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">Abogado Interno</span>
                                        <div class="flex-grow-1">
                                            <select class="form-select form-select-md rounded-start-0"
                                                data-allow-clear="true" data-control="select2"
                                                data-placeholder="Seleccionar..." id="interno_id"
                                                name="interno_id">
                                                <option></option>
                                                @foreach ($internos as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                    
                                

                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary mb-3" name="crearAbogado"
                                        id="crearAbogado">Incluir</button>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                        <div class="col-md-12">
                         
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table id="tabla_abogados_internos" name="tabla_abogados_internos"
                                    class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bolder text-muted">
                                            <th class="min-w-10px">id</th>
                                            <th class="min-w-50px">Abogado</th>
                                            <th class="min-w-50px">Usuario</th>
                                            <th class="min-w-50px">Fecha</th>
                                            <th class="min-w-50px">Opción</th>

                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        @foreach ($abogados as $abogado)
                                            <tr>
                                                <td>{{ $abogado->id }}</td>
                                                <td>{{ $abogado->interno->nombre }}</td>
                                                <td>{{ $abogado->usuario ?? '' }}</td>
                                                <td>{{ $abogado->fecha }}</td>
                                                <td>
                                                    <button type="button" title="Eliminar" name="deleteAbogado"
                                                        id="{{ $abogado->id }}"
                                                        class="deleteAbogado btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                        <span class="svg-icon svg-icon-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                    fill="black" />
                                                                <path opacity="0.5"
                                                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                    fill="black" />
                                                                <path opacity="0.5"
                                                                    d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                    fill="black" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--begin::Separator-->
                        <div class="separator mb-8"></div>
                        <!--end::Separator-->
                        <div class="row">
                            <div class="col-md-10">
                            </div>
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
                        </div>
                    </div>
                    <!--begin end::Body-->
                </div>
            </div>
        </div>
    </div>
@endsection
 
@push('pageScripts')
    <script src="{{ asset('js/abogados/select2.js') }}"></script>
    <script src="{{ asset('js/abogados/store.js') }}"></script>
    <script src="{{ asset('js/abogados/eliminar.js') }}"></script>
    <script src="{{ asset('js/abogados/regresar.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
