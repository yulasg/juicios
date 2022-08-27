"use strict";
var KTDatatablesServerSide = function () {
    var dt;
    var initDatatable = function () {
        dt = $('#tabla').DataTable({
            processing: true,
            //scrollX: true,
            serverSide: true,
            orderCellsTop: true,
            order: [[0, 'desc']],
            fixedHeader: true,
            dataType: 'json',
            type: 'POST',
            ajax: '/juicio/consultaseguimiento',

            columns: [
                {
                    data: 'juicio_id',
                    name: 'juicio_id'
                },
                {
                    data: 'seguimiento_id',
                    name: 'seguimiento_id'
                },
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
                    data: 'creacion',
                    name: 'creacion',
                    //defaultContent: ''
                },
                {
                    data: 'actuacion',
                    name: 'actuacion',
                },

                {
                    data: 'actividad_procesal',
                    name: 'actividad_procesal',
                    defaultContent: ''
                },
                
                {
                    data: 'seguimiento',
                    name: 'seguimiento',
                    defaultContent: ''
                },
                
            ],
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
                    title: 'Listado de Juicios de Fogade con Última Actuación',
                    titleAttr: 'Imprimir',
                    //className:'btn btn-info'

                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    title: 'Listado de Juicios de Fogade con Última Actuación',
                    titleAttr: 'Exportar a Excel',

                    //className:'btn btn-success'
                },

            ]
        });

        //Creamos una fila en el head de la tabla y lo clonamos para cada columna
        $('#tabla thead tr').clone(true).appendTo('#tabla thead');
        $('#tabla thead tr:eq(1) th').each(function (i) {
            var title = $(this).text(); //es el nombre de la columna
            $(this).html('<input type="text" placeholder="Buscar...' + title + '" />');
            $('input', this).on('keyup change', function () {
                if (dt.column(i).search() !== this.value) {
                    dt
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });


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




