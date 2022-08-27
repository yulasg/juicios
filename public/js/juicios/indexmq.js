"use strict";

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
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
                {
                    data: 'botones',
                    orderable: false
                },
                {
                    data: 'internacional',
                    name: 'internacional'
                },
                {
                    data: 'e_especialidad',
                    name: 'e_especialidad'
                },
                {
                    data: 'origen',
                    name: 'origen'
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
                    data: 'llevado',
                    name: 'llevado'
                },
                {
                    data: 'medida',
                    name: 'medida'
                },
                {
                    data: 'practicada',
                    name: 'practicada'
                },
                {
                    data: 'moneda',
                    name: 'moneda'
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
                /*
                {
                    targets: [], visible: true, searchable: true, orderable: true,
                    render: function (data, type, row) {
                        let tipoJuicio = '';
                        if (type === 'display' || type === 'filter') {
                            switch (data) {
                                case 'I':
                                    tipoJuicio = 'Internacional';
                                    //return $.fn.DataTable.render.tStext('Internacional').display();
                                    break;
                                case 'N':
                                    tipoJuicio = 'Nacional';
                                    //return $.fn.DataTable.render.text('Nacional').display();
                                    break;
                            }
                            return tipoJuicio;
                        }
                        return data;
                    },
                },
                */
                {
                    targets: [23,24,25,26,27],
                    render: function ( data, type, row ) {
                        return (data)
                            ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY")
                            : null;
                    },
                    /*
                    render: function (data) {
                        if (typeof data === "undefined") {
                            return data = '';
                        } else {
                            return moment(data).format('DD-MM-YYYY');
                        }
    
                    }
                    */
                },
            ],

            order: [[0, 'desc']],
            select: true,
            autowidth: false,
            language: {
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
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No se encontró registro",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                'search': 'Buscar:',
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
                ,
                select: {
                    rows: "%d fila(s) seleccionada(s)"
                }
            },
            "dom":


              
                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "B"+

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",

            buttons: [
                {
                    extend: 'print',
                    text:'<i class="fa fa-print"></i>',
                    title: 'Listado de Juicios de Fogade',
                    titleAttr:'Imprimir',
                    exportOptions: {
                        columns: [ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31 ]
                    }
                    //className:'btn btn-info'
   
                },
                {
                    extend: 'excel',
                    text:'<i class="fas fa-file-excel"></i>',
                    title: 'Listado de Juicios de Fogade',
                    titleAttr:'Exportar a Excel',
                    exportOptions: {
                        columns: [ 0,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31 ]
                    }
                   
                    //className:'btn btn-success'
                },

            ]
        });
        table = dt.$;
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