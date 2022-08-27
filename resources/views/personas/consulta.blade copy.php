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
                            <span class="card-label fw-bolder fs-3 mb-1">Relación Especialidad Fogade y Juicios
                        </h3>

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <table id="tabla" name="tabla" class="table  table-striped table-row-bordered gy-5 gs-7 ">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <!--<th class="min-w-50px">Acciones</th>-->

                                        <th class="min-w-50px">Parte</th>

                                        <th class="min-w-50px">N Juicio</th>
                                        <th class="min-w-50px">Tipo</th>
                                        <th class="min-w-50px">Especialidad</th>
                                        <th class="min-w-50px">Tipo de Parte</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($personas as $persona)
                                        @php
                                            $contador = 0;
                                            $valor = '';
                                            $valor = $persona->nombre;
                                        @endphp
                                        @foreach ($mdoleoPersonas as $mdoleoPersona)
                                            @if ($mdoleoPersona->nombre === $valor)
                                                @if ($contador == 0)
                                                    <tr>
                                                        <td>{{ $mdoleoPersona->nombre }}</td>
                                                        <td>{{ $mdoleoPersona->juicio_id }}</td>
                                                        <td>{{ $mdoleoPersona->configuracion->especialidad->internacional }}
                                                        </td>
                                                        <td>{{ $mdoleoPersona->configuracion->especialidad->descripcion }}
                                                        </td>
                                                        <td>{{ $mdoleoPersona->configuracion->descripcion }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $mdoleoPersona->juicio_id }}</td>
                                                        <td>{{ $mdoleoPersona->configuracion->especialidad->internacional }}
                                                        </td>
                                                        <td>{{ $mdoleoPersona->configuracion->especialidad->descripcion }}
                                                        </td>
                                                        <td>{{ $mdoleoPersona->configuracion->descripcion }}</td>
                                                    </tr>
                                                @endif
                                                @php
                                                    $contador = $contador + 1;
                                                @endphp
                                            @endif
                                        @endforeach
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
@endsection
