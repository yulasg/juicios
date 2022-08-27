"use strict";

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    //var table;
    var dt;
    // Private functions
    var initDatatable = function () {
        dt = $("#tabla_juicios").DataTable({
            //searchDelay: 500,
            processing: true,
            serverSide: true,
            responsive: true,
            dataType: 'json',
            type: 'POST',
            ajax: '/juicios',

            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                /*
                {
                    data: 'botones',
                    orderable: false
                },
                */
                { data: null },
                {
                    data: 'j_internacional',
                    name: 'j_internacional'
                },
                {
                    data: 'e_especialidad',
                    name: 'e_especialidad'
                },
                {
                    data: 'j_origen',
                    name: 'j_origen'
                },
                {
                    data: 'procedencia',
                    name: 'procedencia'
                },
                {
                    data: 'ubicacion',
                    name: 'ubicacion'
                },
                {
                    data: 'expediente',
                    name: 'expediente'
                },
                {
                    data: 'j_representante',
                    name: 'j_representante'
                },
                {
                    data: 'e_terminado',
                    name: 'e_terminado'
                },
                {
                    data: 'estatu',
                    name: 'estatu'
                },

                {
                    data: 'juzgado',
                    name: 'juzgado'
                },
                {
                    data: 'tribunal',
                    name: 'tribunal'
                },

                {
                    data: 'interno',
                    name: 'interno'
                },
                {
                    data: 'externo',
                    name: 'externo'
                },
                {
                    data: 'obligacion',
                    name: 'obligacion'
                },
                {
                    data: 'estado_procesal',
                    name: 'estado_procesal'
                },
                {
                    data: 'demanda',
                    name: 'demanda'
                },
                {
                    data: 'pretension',
                    name: 'pretension'
                },
                {
                    data: 'garantia',
                    name: 'garantia'
                },
                {
                    data: 'j_llevado',
                    name: 'j_llevado'
                },
                {
                    data: 'medida',
                    name: 'medida'
                },
                {
                    data: 'j_practicada',
                    name: 'j_practicada'
                },
                {
                    data: 'j_moneda',
                    name: 'j_moneda'
                },
                {
                    data: 'admision',
                    name: 'admision'
                },
                {
                    data: 'asignacion',
                    name: 'asignacion'
                },
                {
                    data: 'actuacion',
                    name: 'actuacion',
                },
                {
                    data: 'movimiento',
                    name: 'movimiento',

                },
                {
                    data: 'creacion',
                    name: 'creacion',

                },
                {
                    data: 'capital',
                    name: 'capital',
                    defaultContent: ''
                },
                {
                    data: 'monto',
                    name: 'monto',
                    defaultContent: ''
                },
                /*
                {
                    data: 'tasa',
                    name: 'tasa',
                    defaultContent: ''
                },
                {
                    data: 'mora',
                    name: 'mora',
                    defaultContent: ''
                },
                {
                    data: 'interes',
                    name: 'interes',
                    defaultContent: ''
                },
                */
                {
                    data: 'juez',
                    name: 'juez',
                    defaultContent: ''
                },
                {
                    data: 'observacion',
                    name: 'observacion',
                    defaultContent: ''
                },

            ],

            columnDefs: [

                {
                    targets: 1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function (data, type, row) {
                        if (row.especialidad_id == 1 || row.especialidad_id == 2){
                            return `
                            <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Acciones
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path
                                                d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)">
                                            </path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="/juicios/${row.id}/edit" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                        Editar
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                <a href="/juicios/${row.id}" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                        Ver Ficha
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="delete_juicio  menu-link px-3" data-kt-docs-table-filter="delete_row"
                                        name="delete_juicio" id="${row.id}"">
                                        Eliminar
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <div class="separator border-gray-300"></div>
                                <div class="menu-item px-3">
                                    <a href="/personas/${row.id}/${row.especialidad_id}/${row.representante}" class="menu-link px-3"
                                        data-kt-docs-table-filter="edit_row">
                                        Parte FOGADE
                                    </a>
                                </div>
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/datos/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Datos
                                    </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/documentos/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Pagares
                                     </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <div class="separator border-gray-300"></div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/seguimientos/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Actuaciones
                                     </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/movimientos/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Actividades
                                     </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/abogados/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Asignar
                                     </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/relaciones/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Relacionar
                                     </a>
                                 </div>
                                 <!--end::Menu item-->
                            </div>
                            `;
                        }else{
                            return `
                            <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                Acciones
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path
                                                d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)">
                                            </path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="/juicios/${row.id}/edit" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                        Editar
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                <a href="/juicios/${row.id}" class="menu-link px-3" data-kt-docs-table-filter="edit_row">
                                        Ver Ficha
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="delete_juicio  menu-link px-3" data-kt-docs-table-filter="delete_row"
                                        name="delete_juicio" id="${row.id}"">
                                        Eliminar
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <div class="separator border-gray-300"></div>
                                <div class="menu-item px-3">
                                    <a href="/actores/${row.id}/${row.especialidad_id}/${row.representante}" class="menu-link px-3"
                                        data-kt-docs-table-filter="edit_row">
                                        Parte Procesal
                                    </a>
                                </div>
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/datos/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Datos
                                    </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/documentos/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Pagares
                                     </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <div class="separator border-gray-300"></div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/seguimientos/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Actuaciones
                                     </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/movimientos/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Actividades
                                     </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/abogados/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Asignar
                                     </a>
                                 </div>
                                 <!--end::Menu item-->
                                 <!--begin::Menu item-->
                                 <div class="menu-item px-3">
                                    <a href="/relaciones/${row.id}" class="menu-link px-3"data-kt-docs-table-filter="edit_row">
                                         Relacionar
                                     </a>
                                 </div>
                                 <!--end::Menu item-->
                            </div>
                            `;
                        }
                    },
                },
            ],
            order: [[0, 'desc']],
            //select: true,
            autowidth: false,
            language: {
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "lengthMenu": "Mostrar " +
                    `<select > 
                    <option value='10'>10</option>
                    <option value='25'>25</option>
                    <option value='50'>50</option>
                    <option value='100'>100</option>
                    <option value='-1'>Todos</option>
                </select>` +
                    " registros por página",
                "zeroRecords": "No se encontró registro",

                "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                //"info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No se encontró registro",
                "thousands": ".",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                'search': 'Buscar:',
                'paginate': {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
                ,
                /*
                select: {
                    rows: "%d fila(s) seleccionada(s)"
                }
                */
                
            },
            "dom":



                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "B" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",

            buttons: [
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    title: 'Listado de Juicios de Fogade',
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,32]
                    }
                    //className:'btn btn-info'

                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    title: 'Listado de Juicios de Fogade',
                    titleAttr: 'Exportar a Excel',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,32]
                    }

                    //className:'btn btn-success'
                },

            ]
        });
        //table = dt.$;


        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            KTMenu.createInstances();
        });
    }
    // Public methods
    return {
        init: function () {
            initDatatable();

        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});