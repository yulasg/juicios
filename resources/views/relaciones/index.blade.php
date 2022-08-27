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
                    <h3 class="fw-bolder my-2">Relacionar Juicio N°
                        {{ $dataJuicio }} </span>
                    </h3>
                    <!--end::Heading-->
                </div>
                <!--begin::Tables Widget 9-->
                <div class="card mb-5 mb-xl-8">
                    <input type="hidden" name="juicio_id" id="juicio_id" value="{{ $dataJuicio }}">
                    <input type="hidden" id="juicio_id" name="juicio_id" value="{{ $dataJuicio }}">
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <input type="hidden" name="role" id="role" value="{{ $role }}">
                        <input type="hidden" name="usuario" id="usuario" value="{{ $usuario }}">
                        <!--begin::Form-->
                        <form action="{{ route('relaciones.store') }}" method="POST" name="registrar_relacion"
                            id="registrar_relacion" autocomplete="off">
                            @csrf
                            <div class="row  mb-5 my-5">
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
                                class="table  table-striped table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th class="min-w-25px">Id</th>
                                        <th class="min-w-25px">N° Juicio</th>
                                        <th class="min-w-50px">Tipo</th>
                                        <th class="min-w-50px">Especialidad</th>
                                        <th class="min-w-50px">Procedencia</th>
                                        <th class="min-w-50px">Demandante(s) o Ministerio Público</th>
                                        <th class="min-w-50px">Demandado(s) o Victima(s)</th>
                                        <th class="min-w-50px">Victimario(s) o Tercero(s)</th>
                                        <th class="min-w-50px">Fecha Creacion</th>
                                        <th class="min-w-50px">Fecha Admisión Demanda</th>
                                        <th class="min-w-50px">N° Expediente</th>
                                        <th class="min-w-50px">Monto Demanda</th>
                                        <th class="min-w-50px">Abogado Interno</th>
                                        <th class="min-w-75px text-end">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--|---------------------------------------------------------------------------------------------------------| -->
                                    <!--Ciclo relaciones1 Ciclo relaciones1 Ciclo relaciones1 Ciclo relaciones1 Ciclo relaciones1 Ciclo relaciones1 -->
                                    <!--|---------------------------------------------------------------------------------------------------------| -->
                                    @foreach ($relaciones1 as $relacion1)
                                        <tr>
                                            <td>{{ $relacion1->id }}</td>
                                            <td>{{ $relacion1->juicio1_id }}</td>
                                            <td>{{ $relacion1->juicio1->tipo }}</td>
                                            <td>{{ $relacion1->juicio1->especialidad->rama }}</td>
                                            <td>{{ $relacion1->juicio1->procedencia->descripcion }}</td>

                                            <!--Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes -->
                                            <td>
                                                @php
                                                    $varDemandante = '';
                                                    $varDemandanteActor = '';
                                                @endphp
                                                <!--|---------------------------------------------------------------------------------------------------------------------------------| -->
                                                <!--Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas             -->
                                                <!--Fogade Nacional o Internacional Demandantes Fogade Nacional o Internacional Demandantes Fogade Nacional o Internacional Demandantes -->
                                                <!--|---------------------------------------------------------------------------------------------------------------------------------| -->
                                                @foreach ($relacion1->juicio1->personas as $persona)
                                                    @if ($persona->configuracion_id == 2 || $persona->configuracion_id == 4)
                                                        @if (strlen($varDemandante) == 0)
                                                            @php
                                                                $varDemandante = $persona->nombre;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $varDemandante = $varDemandante . ', ' . $persona->nombre;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if (strlen($varDemandante) != 0)
                                                    {{ $varDemandante }}
                                                @endif
                                                <!--|-----------------------------------------------------------------------------------------------------------------------------------------| -->
                                                <!--Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores               -->
                                                <!--Demandantes o Fase II penal Demandantes o Fase II penal Demandantes o Fase II penal Demandantes o Fase II penal Demandantes o Fase II penal -->
                                                <!--|-----------------------------------------------------------------------------------------------------------------------------------------| -->
                                                @foreach ($relacion1->juicio1->actores as $actor)
                                                    @if ($actor->configuracion_id == 5 ||
                                                        $actor->configuracion_id == 9 ||
                                                        $actor->configuracion_id == 12 ||
                                                        $actor->configuracion_id == 15 ||
                                                        $actor->configuracion_id == 18 ||
                                                        $actor->configuracion_id == 21 ||
                                                        $actor->configuracion_id == 24 ||
                                                        $actor->configuracion_id == 27 ||
                                                        $actor->configuracion_id == 30 ||
                                                        $actor->configuracion_id == 33 ||
                                                        $actor->configuracion_id == 36 ||
                                                        $actor->configuracion_id == 39 ||
                                                        $actor->configuracion_id == 42 ||
                                                        $actor->configuracion_id == 45 ||
                                                        $actor->configuracion_id == 48 ||
                                                        $actor->configuracion_id == 51)
                                                        @if (strlen($varDemandanteActor) == 0)
                                                            @php
                                                                $varDemandanteActor = $actor->referencia->nombre;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $varDemandanteActor = $varDemandanteActor . ', ' . $actor->referencia->nombre;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if (strlen($varDemandanteActor) != 0)
                                                    {{ $varDemandanteActor }}
                                                @endif
                                            </td>

                                            <!--Demandados Demandados Demandados Demandados Demandados Demandados Demandados Demandados Demandados Demandados Demandados Demandados -->
                                            <td>
                                                @php
                                                    $varDemandado = '';
                                                    $varDemandadoActor = '';
                                                @endphp
                                                <!--|----------------------------------------------------------------------------------------------------------------------------  | -->
                                                <!--Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas          -->
                                                <!--Fogade Nacional o Internacional Demandados Fogade Nacional o Internacional Demandados Fogade Nacional o Internacional Demandados -->
                                                <!--|------------------------------------------------------------------------------------------------------------------------------| -->
                                                @foreach ($relacion1->juicio1->personas as $persona)
                                                    @if ($persona->configuracion_id == 1 || $persona->configuracion_id == 3)
                                                        @if (strlen($varDemandado) == 0)
                                                            @php
                                                                $varDemandado = $persona->nombre;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $varDemandado = $varDemandado . ', ' . $persona->nombre;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if (strlen($varDemandado) != 0)
                                                    {{ $varDemandado }}
                                                @endif
                                                <!--|-------------------------------------------------------------------------------------------------------------------------------| -->
                                                <!--Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores     -->
                                                <!--Demandados o Fase I penal Demandados o Fase I penal Demandados o Fase I penal Demandados o Fase I penal Demandados o Fase I penal -->
                                                <!--|-------------------------------------------------------------------------------------------------------------------------------| -->
                                                @foreach ($relacion1->juicio1->actores as $actor)
                                                    @if ($actor->configuracion_id == 6 ||
                                                        $actor->configuracion_id == 8 ||
                                                        $actor->configuracion_id == 11 ||
                                                        $actor->configuracion_id == 14 ||
                                                        $actor->configuracion_id == 17 ||
                                                        $actor->configuracion_id == 20 ||
                                                        $actor->configuracion_id == 23 ||
                                                        $actor->configuracion_id == 26 ||
                                                        $actor->configuracion_id == 29 ||
                                                        $actor->configuracion_id == 32 ||
                                                        $actor->configuracion_id == 35 ||
                                                        $actor->configuracion_id == 38 ||
                                                        $actor->configuracion_id == 41 ||
                                                        $actor->configuracion_id == 44 ||
                                                        $actor->configuracion_id == 47 ||
                                                        $actor->configuracion_id == 50)
                                                        @if (strlen($varDemandadoActor) == 0)
                                                            @php
                                                                $varDemandadoActor = $actor->referencia->nombre;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $varDemandadoActor = $varDemandadoActor . ', ' . $actor->referencia->nombre;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if (strlen($varDemandadoActor) != 0)
                                                    {{ $varDemandadoActor }}
                                                @endif
                                            </td>

                                            <!--fase III fase III fase III fase III fase III fase III fase III fase III fase III fase III fase III fase III fase III fase III  -->
                                            <td>
                                                @php
                                                    $varFase3 = '';
                                                @endphp
                                                <!--|----------------------------------------------------------------------------------------------------------------------------------------------| -->
                                                <!--Ciclo actores penal fase III Ciclo actores penal fase III Ciclo actores penal fase III Ciclo actores penal fase III Ciclo actores penal fase III -->
                                                <!--|----------------------------------------------------------------------------------------------------------------------------------------------| -->
                                                @foreach ($relacion1->juicio1->actores as $actor)
                                                    @if ($actor->configuracion_id == 7 ||
                                                        $actor->configuracion_id == 10 ||
                                                        $actor->configuracion_id == 13 ||
                                                        $actor->configuracion_id == 16 ||
                                                        $actor->configuracion_id == 19 ||
                                                        $actor->configuracion_id == 22 ||
                                                        $actor->configuracion_id == 25 ||
                                                        $actor->configuracion_id == 28 ||
                                                        $actor->configuracion_id == 31 ||
                                                        $actor->configuracion_id == 34 ||
                                                        $actor->configuracion_id == 37 ||
                                                        $actor->configuracion_id == 40 ||
                                                        $actor->configuracion_id == 43 ||
                                                        $actor->configuracion_id == 46 ||
                                                        $actor->configuracion_id == 49 ||
                                                        $actor->configuracion_id == 52)
                                                        @if (strlen($varFase3) == 0)
                                                            @php
                                                                $varFase3 = $actor->referencia->nombre;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $varFase3 = $varFase3 . ', ' . $actor->referencia->nombre;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if (strlen($varFase3) != 0)
                                                    {{ $varFase3 }}
                                                @endif
                                            </td>

                                            <td>{{ $relacion1->juicio1->creacion }}</td>
                                            <td>{{ $relacion1->juicio1->admision }}</td>
                                            <td>{{ $relacion1->juicio1->expediente }}</td>
                                            <td style="text-align:right">{{ $relacion1->juicio1->dato->monto ?? '' }}
                                            </td>
                                            <td>{{ $relacion1->juicio1->interno->nombre }}</td>
                                            <td width="10px">
                                                <button type="button" title="Eliminar" name="delete_relacion"
                                                    id="{{ $relacion1->id }}"
                                                    class="delete_relacion btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
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
                                    <!--|---------------------------------------------------------------------------------------------------------| -->
                                    <!--Ciclo relaciones2 Ciclo relaciones2 Ciclo relaciones2 Ciclo relaciones2 Ciclo relaciones2 Ciclo relaciones2 -->
                                    <!--|---------------------------------------------------------------------------------------------------------| -->
                                    @foreach ($relaciones2 as $relacion2)
                                        <tr>
                                            <td>{{ $relacion2->id }}</td>
                                            <td>{{ $relacion2->juicio_id }}</td>
                                            <td>{{ $relacion2->juicio->tipo }}</td>
                                            <td>{{ $relacion2->juicio->especialidad->rama }}</td>
                                            <td>{{ $relacion2->juicio->procedencia->descripcion }}</td>

                                            <!--Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes Demandantes -->
                                            <td>
                                                @php
                                                    $varDemandante = '';
                                                    $varDemandanteActor = '';
                                                @endphp
                                                <!--|---------------------------------------------------------------------------------------------------------------------------------| -->
                                                <!--Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas             -->
                                                <!--Fogade Nacional o Internacional Demandantes Fogade Nacional o Internacional Demandantes Fogade Nacional o Internacional Demandantes -->
                                                <!--|---------------------------------------------------------------------------------------------------------------------------------| -->
                                                @foreach ($relacion2->juicio->personas as $persona)
                                                    @if ($persona->configuracion_id == 2 || $persona->configuracion_id == 4)
                                                        @if (strlen($varDemandante) == 0)
                                                            @php
                                                                $varDemandante = $persona->nombre;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $varDemandante = $varDemandante . ', ' . $persona->nombre;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if (strlen($varDemandante) != 0)
                                                    {{ $varDemandante }}
                                                @endif
                                                <!--|-----------------------------------------------------------------------------------------------------------------------------------------| -->
                                                <!--Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores               -->
                                                <!--Demandantes o Fase II penal Demandantes o Fase II penal Demandantes o Fase II penal Demandantes o Fase II penal Demandantes o Fase II penal -->
                                                <!--|-----------------------------------------------------------------------------------------------------------------------------------------| -->
                                                @foreach ($relacion2->juicio->actores as $actor)
                                                    @if ($actor->configuracion_id == 5 ||
                                                        $actor->configuracion_id == 9 ||
                                                        $actor->configuracion_id == 12 ||
                                                        $actor->configuracion_id == 15 ||
                                                        $actor->configuracion_id == 18 ||
                                                        $actor->configuracion_id == 21 ||
                                                        $actor->configuracion_id == 24 ||
                                                        $actor->configuracion_id == 27 ||
                                                        $actor->configuracion_id == 30 ||
                                                        $actor->configuracion_id == 33 ||
                                                        $actor->configuracion_id == 36 ||
                                                        $actor->configuracion_id == 39 ||
                                                        $actor->configuracion_id == 42 ||
                                                        $actor->configuracion_id == 45 ||
                                                        $actor->configuracion_id == 48 ||
                                                        $actor->configuracion_id == 51)
                                                        @if (strlen($varDemandanteActor) == 0)
                                                            @php
                                                                $varDemandanteActor = $actor->referencia->nombre;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $varDemandanteActor = $varDemandanteActor . ', ' . $actor->referencia->nombre;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if (strlen($varDemandanteActor) != 0)
                                                    {{ $varDemandanteActor }}
                                                @endif
                                            </td>

                                            <!--Demandados Demandados Demandados Demandados Demandados Demandados Demandados Demandados Demandados Demandados Demandados Demandados -->
                                            <td>
                                                @php
                                                    $varDemandado = '';
                                                    $varDemandadoActor = '';
                                                @endphp
                                                <!--|------------------------------------------------------------------------------------------------------------------------------| -->
                                                <!--Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas Ciclo personas          -->
                                                <!--Fogade Nacional o Internacional Demandados Fogade Nacional o Internacional Demandados Fogade Nacional o Internacional Demandados -->
                                                <!--|------------------------------------------------------------------------------------------------------------------------------| -->
                                                @foreach ($relacion2->juicio->personas as $persona)
                                                    @if ($persona->configuracion_id == 1 || $persona->configuracion_id == 3)
                                                        @if (strlen($varDemandado) == 0)
                                                            @php
                                                                $varDemandado = $persona->nombre;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $varDemandado = $varDemandado . ', ' . $persona->nombre;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if (strlen($varDemandado) != 0)
                                                    {{ $varDemandado }}
                                                @endif
                                                <!--|-------------------------------------------------------------------------------------------------------------------------------| -->
                                                <!--Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores Ciclo actores     -->
                                                <!--Demandados o Fase I penal Demandados o Fase I penal Demandados o Fase I penal Demandados o Fase I penal Demandados o Fase I penal -->
                                                <!--|-------------------------------------------------------------------------------------------------------------------------------| -->
                                                @foreach ($relacion2->juicio->actores as $actor)
                                                    @if ($actor->configuracion_id == 6 ||
                                                        $actor->configuracion_id == 8 ||
                                                        $actor->configuracion_id == 11 ||
                                                        $actor->configuracion_id == 14 ||
                                                        $actor->configuracion_id == 17 ||
                                                        $actor->configuracion_id == 20 ||
                                                        $actor->configuracion_id == 23 ||
                                                        $actor->configuracion_id == 26 ||
                                                        $actor->configuracion_id == 29 ||
                                                        $actor->configuracion_id == 32 ||
                                                        $actor->configuracion_id == 35 ||
                                                        $actor->configuracion_id == 38 ||
                                                        $actor->configuracion_id == 41 ||
                                                        $actor->configuracion_id == 44 ||
                                                        $actor->configuracion_id == 47 ||
                                                        $actor->configuracion_id == 50)
                                                        @if (strlen($varDemandadoActor) == 0)
                                                            @php
                                                                $varDemandadoActor = $actor->referencia->nombre;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $varDemandadoActor = $varDemandadoActor . ', ' . $actor->referencia->nombre;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if (strlen($varDemandadoActor) != 0)
                                                    {{ $varDemandadoActor }}
                                                @endif
                                            </td>

                                            <!--fase III fase III fase III fase III fase III fase III fase III fase III fase III fase III fase III fase III fase III fase III  -->
                                            <td>
                                                @php
                                                    $varFase3 = '';
                                                @endphp
                                                <!--|----------------------------------------------------------------------------------------------------------------------------------------------| -->
                                                <!--Ciclo actores penal fase III Ciclo actores penal fase III Ciclo actores penal fase III Ciclo actores penal fase III Ciclo actores penal fase III -->
                                                <!--|----------------------------------------------------------------------------------------------------------------------------------------------| -->
                                                @foreach ($relacion2->juicio->actores as $actor)
                                                    @if ($actor->configuracion_id == 7 ||
                                                        $actor->configuracion_id == 10 ||
                                                        $actor->configuracion_id == 13 ||
                                                        $actor->configuracion_id == 16 ||
                                                        $actor->configuracion_id == 19 ||
                                                        $actor->configuracion_id == 22 ||
                                                        $actor->configuracion_id == 25 ||
                                                        $actor->configuracion_id == 28 ||
                                                        $actor->configuracion_id == 31 ||
                                                        $actor->configuracion_id == 34 ||
                                                        $actor->configuracion_id == 37 ||
                                                        $actor->configuracion_id == 40 ||
                                                        $actor->configuracion_id == 43 ||
                                                        $actor->configuracion_id == 46 ||
                                                        $actor->configuracion_id == 49 ||
                                                        $actor->configuracion_id == 52)
                                                        @if (strlen($varFase3) == 0)
                                                            @php
                                                                $varFase3 = $actor->referencia->nombre;
                                                            @endphp
                                                        @else
                                                            @php
                                                                $varFase3 = $varFase3 . ', ' . $actor->referencia->nombre;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if (strlen($varFase3) != 0)
                                                    {{ $varFase3 }}
                                                @endif
                                            </td>
                                            <td>{{ $relacion2->juicio->creacion }}</td>
                                            <td>{{ $relacion2->juicio->admision }}</td>
                                            <td>{{ $relacion2->juicio->expediente }}</td>
                                            <td style="text-align:right">{{ $relacion2->juicio->dato->monto ?? '' }}
                                            </td>
                                            <td>{{ $relacion2->juicio->interno->nombre }}</td>
                                            <td width="10px">
                                                <button type="button" title="Eliminar" name="delete_relacion"
                                                    id="{{ $relacion2->id }}"
                                                    class="delete_relacion btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
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
                            </table>
                        </div>
                    </div>
                </div>
                <!--end::Tables Widget 9-->
            </div>
            <!--end::Container-->
        </div>
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
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection

@push('pageScripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/relaciones/store.js') }}"></script>
    <script src="{{ asset('js/relaciones/eliminar.js') }}"></script>
    <script src="{{ asset('js/general/regresarJuicio.js') }}"></script>
@endpush
