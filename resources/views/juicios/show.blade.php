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
                        <div class="row mb-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Ficha del Juicio N°
                                    {{ $juicioDato[0]->id }}</span>
                            </h3>
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body  pt-5">
                        <form action="">
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Tipo de Juicio</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->tipo }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Especialidad</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->especialidad->descripcion }}">
                                    </div>

                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">

                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Origen del Juicio</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->origen }}">
                                    </div>

                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Expediente</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->expediente }}">
                                    </div>

                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Procedencia</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->procedencia->descripcion }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Ubicación</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->ubicacion->descripcion }}">
                                    </div>

                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Representante(s)</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->apoderado }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Terminado</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->estatu->terminado }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Estatu</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->estatu->descripcion }}">
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Separator-->
                            <div class="separator mb-8"></div>
                            <!--end::Separator-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Asignación</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->asignacion ?? '' }} ">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Admisión Demanda</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->admision ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Capital</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->dato->capital ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-3 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Monto</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->dato->monto ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->


                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Primera Actuación</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->creacion ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Última Actuación</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->actuacion ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Última Actividad</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->movimiento ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                            </div>
                            <!--end::Input group-->

                            <!--begin::Separator-->
                            <div class="separator mb-8"></div>
                            <!--end::Separator-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Juzgado</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->tribunal->juzgado->descripcion }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Tribunal</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->tribunal->descripcion }}">
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Abogado Interno</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->interno->nombre }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Abogado Externo</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->externo->nombre }}">
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Tipo de Obligación</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->obligacion->descripcion }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Estado Procesal</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->estado->descripcion }}">
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Tipo de Proceso</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->demanda->descripcion }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Pretensión</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->pretension->descripcion }}">
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Garantía</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->garantia->descripcion }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-6 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Llevado por</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->llevado }}">
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-5 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Medida</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->medida->descripcion }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-2 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Practicada?</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->practicada }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-5 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Actividad Procesal</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->ultimoSeguimiento->actividad->descripcion ?? '' }}">
                                    </div>
                                </div>

                                <!--end::Input group-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Separator-->
                            <div class="separator mb-8"></div>
                            <!--end::Separator-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-5 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">N° Documento</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->documentos[0]->numero ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-2 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Fecha Inicio</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->documentos[0]->inicio ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-5 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Fecha Vencimiento</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->documentos[0]->fin ?? '' }}">
                                    </div>
                                </div>

                                <!--end::Input group-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Separator-->
                            <div class="separator mb-8"></div>
                            <!--end::Separator-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Tasa </label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->dato->tasa ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Interes</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->dato->interes ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-sm-4 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Mora</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->dato->mora ?? '' }}">
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-12 fv-row">
                                    <div class="d-flex flex-column mb-5 fv-row input-group-sm">
                                        <label class=" fs-5 fw-bold mb-2">Juez Ponente</label>
                                        <input disabled type="text" class="form-control "
                                            value="{{ $juicioDato[0]->dato->juez ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <!--end::Input group-->


                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-sm-12 fv-row">
                                    <div class="flex-grow-1">
                                        <label class="fs-6 fw-bold mb-2">Observación</label>
                                        <textarea disabled class="form-control form-control-solid" rows="8" name="observacion" id="observacion">{{ $juicioDato[0]->dato->observacion ?? '' }}</textarea>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Input group-->
                                <div class="row mb-5">
                                    <!--begin::Col-->
                                    <div class="col-sm-12 fv-row">
                                        <div class="flex-grow-1">
                                            <label class="fs-6 fw-bold mb-2">Última Actuación</label>
                                            <textarea class="form-control form-control-solid" rows="8" name="seguimiento" id="seguimiento">{{ $juicioDato[0]->ultimoSeguimiento->seguimiento ?? '' }}</textarea>
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
                                            <label class="fs-6 fw-bold mb-2">Última Actividad</label>
                                            <textarea class="form-control form-control-solid" rows="8" name="seguimiento" id="seguimiento">{{ $juicioDato[0]->ultimoMovimiento->movimiento ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Separator-->
                                <div class="separator mb-8"></div>
                                <!--end::Separator-->


                                @if ($juicioDato[0]->especialidad_id == '1' || $juicioDato[0]->especialidad_id == '2')
                                    <!--begin::Input group-->
                                    <div class="row mb-5">

                                        <!--begin FOGADE DEMANDANTES::Col-->
                                        <div class="col-sm-6 fv-row">
                                            <div class="table-responsive">
                                                <table id="tabla2" name="tabla2"
                                                    class="table   table-row-bordered gy-5 gs-7 ">
                                                    <thead>
                                                        <tr class="fw-bold fs-6 text-gray-800">
                                                            <th class="min-w-25px">Demandante(s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($juicioDato[0]->personas as $persona)
                                                            <tr>
                                                                @if ($persona->configuracion->id == '2' || $persona->configuracion->id == '4')
                                                                    <td>{{ $persona->nombre }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--end::Col-->

                                        <!--begin FOGADE DEMANDADOS::Col-->
                                        <div class="col-sm-6 fv-row">
                                            <div class="table-responsive">
                                                <table id="tabla1" name="tabla1"
                                                    class="table  table-row-bordered gy-5 gs-7 ">
                                                    <thead>
                                                        <tr class="fw-bold fs-6 text-gray-800">
                                                            <th class="min-w-25px">Demandado(s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($juicioDato[0]->personas as $persona)
                                                            <tr>
                                                                @if ($persona->configuracion->id == '1' || $persona->configuracion->id == '3')
                                                                    <td>{{ $persona->nombre }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <!--end::Col-->

                                    </div>
                                    <!--end::Input group-->
                                @endif

                                @if ($juicioDato[0]->especialidad_id == '3')
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin FOGADE Fase I::Col-->
                                        <div class="col-sm-4 fv-row">
                                            <div class="table-responsive">
                                                <table id="tabla1" name="tabla1"
                                                    class="table  table-row-bordered gy-5 gs-7 ">
                                                    <thead>
                                                        <tr class="fw-bold fs-6 text-gray-800">
                                                            <th class="min-w-25px">Ministerio Público</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($juicioDato[0]->actores as $actor)
                                                            <tr>
                                                                @if ($actor->configuracion->id == '5')
                                                                    <td>{{ $actor->referencia->nombre ?? '' }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <!--end::Col-->

                                        <!--begin FOGADE Fase II::Col-->
                                        <div class="col-sm-4 fv-row">
                                            <div class="table-responsive">
                                                <table id="tabla2" name="tabla2"
                                                    class="table   table-row-bordered gy-5 gs-7 ">
                                                    <thead>
                                                        <tr class="fw-bold fs-6 text-gray-800">
                                                            <th class="min-w-25px">Victima(s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($juicioDato[0]->actores as $actor)
                                                            <tr>
                                                                @if ($actor->configuracion->id == '6')
                                                                    <td>{{ $actor->referencia->nombre ?? '' }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--end::Col-->

                                        <!--begin FOGADE Fase III::Col-->
                                        <div class="col-sm-4 fv-row">
                                            <div class="table-responsive">
                                                <table id="tabla2" name="tabla2"
                                                    class="table   table-row-bordered gy-5 gs-7 ">
                                                    <thead>
                                                        <tr class="fw-bold fs-6 text-gray-800">
                                                            <th class="min-w-25px">Victimario(s)</th>
                                                            <th class="min-w-25px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($juicioDato[0]->actores as $actor)
                                                            <tr>
                                                                @if ($actor->configuracion->id == '7')
                                                                    <td>{{ $actor->referencia->nombre ?? '' }}</td>
                                                                    <td>{{ $actor->estatu ?? '' }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                @endif

                                @if ($juicioDato[0]->especialidad_id >= '4')
                                    <!--begin::Input group-->
                                    <div class="row mb-5">
                                        <!--begin FOGADE Fase I::Col-->
                                        <div class="col-sm-4 fv-row">
                                            <div class="table-responsive">
                                                <table id="tabla1" name="tabla1"
                                                    class="table  table-row-bordered gy-5 gs-7 ">
                                                    <thead>
                                                        <tr class="fw-bold fs-6 text-gray-800">
                                                            <th class="min-w-25px">Demandante(s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($juicioDato[0]->actores as $actor)
                                                            <tr>
                                                                @if ($actor->configuracion->id == '9' ||
                                                                    $actor->configuracion->id == '12' ||
                                                                    $actor->configuracion->id == '15' ||
                                                                    $actor->configuracion->id == '18' ||
                                                                    $actor->configuracion->id == '21' ||
                                                                    $actor->configuracion->id == '24' ||
                                                                    $actor->configuracion->id == '27' ||
                                                                    $actor->configuracion->id == '30' ||
                                                                    $actor->configuracion->id == '33' ||
                                                                    $actor->configuracion->id == '36' ||
                                                                    $actor->configuracion->id == '39' ||
                                                                    $actor->configuracion->id == '42' ||
                                                                    $actor->configuracion->id == '45' ||
                                                                    $actor->configuracion->id == '48' ||
                                                                    $actor->configuracion->id == '51')
                                                                    <td>{{ $actor->referencia->nombre ?? '' }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <!--end::Col-->

                                        <!--begin FOGADE Fase II::Col-->
                                        <div class="col-sm-4 fv-row">
                                            <div class="table-responsive">
                                                <table id="tabla2" name="tabla2"
                                                    class="table   table-row-bordered gy-5 gs-7 ">
                                                    <thead>
                                                        <tr class="fw-bold fs-6 text-gray-800">
                                                            <th class="min-w-25px">Demandado(s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($juicioDato[0]->actores as $actor)
                                                            <tr>
                                                                @if ($actor->configuracion->id == '8' ||
                                                                    $actor->configuracion->id == '11' ||
                                                                    $actor->configuracion->id == '14' ||
                                                                    $actor->configuracion->id == '17' ||
                                                                    $actor->configuracion->id == '20' ||
                                                                    $actor->configuracion->id == '23' ||
                                                                    $actor->configuracion->id == '26' ||
                                                                    $actor->configuracion->id == '29' ||
                                                                    $actor->configuracion->id == '32' ||
                                                                    $actor->configuracion->id == '35' ||
                                                                    $actor->configuracion->id == '38' ||
                                                                    $actor->configuracion->id == '41' ||
                                                                    $actor->configuracion->id == '44' ||
                                                                    $actor->configuracion->id == '47' ||
                                                                    $actor->configuracion->id == '50')
                                                                    <td>{{ $actor->referencia->nombre ?? '' }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--end::Col-->

                                        <!--begin FOGADE Fase III::Col-->
                                        <div class="col-sm-4 fv-row">
                                            <div class="table-responsive">
                                                <table id="tabla2" name="tabla2"
                                                    class="table   table-row-bordered gy-5 gs-7 ">
                                                    <thead>
                                                        <tr class="fw-bold fs-6 text-gray-800">
                                                            <th class="min-w-25px">Tercero(s)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($juicioDato[0]->actores as $actor)
                                                            <tr>
                                                                @if ($actor->configuracion->id == '10' ||
                                                                    $actor->configuracion->id == '13' ||
                                                                    $actor->configuracion->id == '16' ||
                                                                    $actor->configuracion->id == '19' ||
                                                                    $actor->configuracion->id == '22' ||
                                                                    $actor->configuracion->id == '25' ||
                                                                    $actor->configuracion->id == '28' ||
                                                                    $actor->configuracion->id == '31' ||
                                                                    $actor->configuracion->id == '34' ||
                                                                    $actor->configuracion->id == '37' ||
                                                                    $actor->configuracion->id == '40' ||
                                                                    $actor->configuracion->id == '43' ||
                                                                    $actor->configuracion->id == '46' ||
                                                                    $actor->configuracion->id == '49' ||
                                                                    $actor->configuracion->id == '52')
                                                                    <td>{{ $actor->referencia->nombre ?? '' }}</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                @endif


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
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            <!--end::Indicator-->
                                        </button>
                                        <!--end::Submit-->
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('pageScripts')
    <script src="{{ asset('js/general/regresarJuicio.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
