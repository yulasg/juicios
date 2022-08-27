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
                        <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dataJuicio }}">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Relacionar Juicio N°
                                {{ $dataJuicio }} </span>
                        </h3>
                        <input type="hidden" id="juicio_id" name="juicio_id" value="{{ $dataJuicio }}">
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Form-->
                        <form action="{{ route('relaciones.store') }}" method="POST" name="registrar_relacion"
                            id="registrar_relacion" autocomplete="off">
                            @csrf
                            <div class="row  mb-5">
                                <div class="col-3 fv-row">
                                    <div class="input-group input-group-sm ">
                                        <div class="flex-grow-1">
                                            <input type="text"
                                                class="form-control form-control-md form-control-solid rounded-start"
                                                placeholder="Juicio N° a relacionar" id="juicio1_id" name="juicio1_id" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary mb-3" name="crear"
                                        id="crear">Relacionar</button>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <table id="tabla_relaciones" name="tabla_relaciones"
                                class="table  table-striped table-row-bordered gy-5 gs-7 ">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th class="min-w-25px">Id</th>
                                        <th class="min-w-25px">N° Juicio</th>
                                        <th class="min-w-50px">Procedencia</th>
                                        <th class="min-w-50px">Demandado(s)</th>
                                        <th class="min-w-50px">Demandante(s)</th>
                                        <th class="min-w-50px">Fecha Creacion</th>
                                        <th class="min-w-50px">Fecha Admisión Demanda</th>
                                        <th class="min-w-50px">N° Expediente</th>
                                        <th class="min-w-50px">Monto Demanda</th>
                                        <th class="min-w-50px">Abogado Interno</th>
                                        <th class="min-w-75px text-end">Acción</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($relaciones2 as $relacion2)
                                        @if ($loop->first)
                                            @php $varId = $relacion2->relacion_id; @endphp
                                        @endif
                                    @endforeach
                                    @php
                                        $suma = 0;
                                        $varDemandado = '';
                                        $varDemandante = '';
                                    @endphp
                                    @foreach ($relaciones2 as $relacion2)
                                        @if ($varId != $relacion2->relacion_id)
                                            <tr>
                                                <td>{{ $varIdRelacion }}</td>
                                                <td>{{ $varIdJuicio }}</td>
                                                <td>{{ $varProcedencia }}</td>
                                                <td>{{ $varDemandado }}</td>
                                                <td>{{ $varDemandante }}</td>
                                                <td>{{ $varCreacion }}</td>
                                                <td>{{ $varAdmision }}</td>
                                                <td>{{ $varExpediente }}</td>
                                                <td style="text-align:right">{{ $varMonto ?? '' }}</td>
                                                <td>{{ $varInterno }}</td>
                                                <td width="10px">
                                                    <button type="button" title="Eliminar" name="delete_relacion"
                                                        id="{{ $relacion2->relacion_id }}"
                                                        class="delete_relacion btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
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
                                            @php
                                                $varIdRelacion = $relacion2->relacion_id;
                                                $varIdJuicio = $relacion2->juicio_id;
                                                $varProcedencia = $relacion2->procedencia;
                                                $varCreacion = $relacion2->creacion;
                                                $varAdmision = $relacion2->admision;
                                                $varExpediente = $relacion2->expediente;
                                                $varMonto = $relacion2->monto;
                                                $varInterno = $relacion2->interno;
                                                $varId = $relacion2->relacion_id;
                                                $suma = 0;
                                                $suma = $suma + 1;
                                                $varDemandado = '';
                                                $varDemandante = '';
                                            @endphp
                                            @if ($relacion2->tipo == 'DEMANDADOS')
                                                @if (strlen($varDemandado) == 0)
                                                    @php
                                                        $varDemandado = $relacion2->nombre;
                                                    @endphp
                                                @else
                                                    @php
                                                        $varDemandado = $varDemandado . ', ' . $relacion2->nombre;
                                                    @endphp
                                                @endif
                                            @endif
                                            @if ($relacion2->tipo == 'DEMANDANTES')
                                                @if (strlen($varDemandante) == 0)
                                                    @php
                                                        $varDemandante = $relacion2->nombre;
                                                    @endphp
                                                @else
                                                    @php
                                                        $varDemandante = $varDemandante . ', ' . $relacion2->nombre;
                                                    @endphp
                                                @endif
                                            @endif
                                        @else
                                            @php
                                                $suma = $suma + 1;
                                                $varIdRelacion = $relacion2->relacion_id;
                                                $varIdJuicio = $relacion2->juicio_id;
                                                $varProcedencia = $relacion2->procedencia;
                                                $varCreacion = $relacion2->creacion;
                                                $varAdmision = $relacion2->admision;
                                                $varExpediente = $relacion2->expediente;
                                                $varMonto = $relacion2->monto;
                                                $varInterno = $relacion2->interno;
                                                $varId = $relacion2->relacion_id;
                                            @endphp
                                            @if ($relacion2->tipo == 'DEMANDADOS')
                                                @if (strlen($varDemandado) == 0)
                                                    @php
                                                        $varDemandado = $relacion2->nombre;
                                                    @endphp
                                                @else
                                                    @php
                                                        $varDemandado = $varDemandado . ', ' . $relacion2->nombre;
                                                    @endphp
                                                @endif
                                            @endif
                                            @if ($relacion2->tipo == 'DEMANDANTES')
                                                @if (strlen($varDemandante) == 0)
                                                    @php
                                                        $varDemandante = $relacion2->nombre;
                                                    @endphp
                                                @else
                                                    @php
                                                        $varDemandante = $varDemandante . ', ' . $relacion2->nombre;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endif
                                        @if ($loop->last)
                                            <tr>
                                                <td>{{ $varIdRelacion }}</td>
                                                <td>{{ $varIdJuicio }}</td>
                                                <td>{{ $varProcedencia }}</td>
                                                <td>{{ $varDemandado }}</td>
                                                <td>{{ $varDemandante }}</td>
                                                <td>{{ $varCreacion }}</td>
                                                <td>{{ $varAdmision }}</td>
                                                <td>{{ $varExpediente }}</td>
                                                <td style="text-align:right">{{ $varMonto ?? '' }}</td>
                                                <td>{{ $varInterno }}</td>
                                                <td width="10px">
                                                    <button type="button" title="Eliminar" name="delete_relacion"
                                                        id="{{ $relacion2->relacion_id }}"
                                                        class="delete_relacion btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
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
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Tables Widget 9-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

    <!-- Modal  Eliminar Seguimiento-->
    <div class="modal fade" id="confirmarModalRelacion" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Dese eliminar la relación seleccionada?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" name="botonEliminarRelacion"
                        id="botonEliminarRelacion">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/relaciones/store.js') }}"></script>
    <script src="{{ asset('js/relaciones/eliminar.js') }}"></script>
@endpush
