"use strict";
var KTDatatablesServerSide = function () {
    var dt;
    var groupColumn = 0;
    var initDatatable = function () {
        dt = $('#tabla').DataTable({
            columnDefs: [{ visible: false, targets: groupColumn }],
            processing: true,
            //scrollX: true,
            serverSide: true,
            orderCellsTop: true,
            //order: [[0, 'desc']],
            fixedHeader: true,
            dataType: 'json',
            type: 'POST',
            ajax: '/persona/consulta',
            columns: [

                {
                    data: 'p_persona',
                    name: 'p_persona'
                },
                {
                    data: 'juicio_id',
                    name: 'juicio_id'
                },
                {
                    data: 'internacional',
                    name: 'internacional'
                },
                {
                    data: 'c_descripcion',
                    name: 'c_descripcion'
                }

            ],

            displayLength: 25,
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({ page: 'current' }).nodes();
                var last = null;

                api
                    .column(groupColumn, { page: 'current' })
                    .data()
                    .each(function (group, i) {
                        if (last !== group) {
                            $(rows)
                                .eq(i)
                                .before('<tr class="group"><td colspan="5">' + group + '</td></tr>');

                            last = group;
                        }
                    });
            },

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
                    title: 'Listado de Relación Especialidad Fogade y Juicios',
                    titleAttr: 'Imprimir',
                    //className:'btn btn-info'

                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    title: 'Listado de Relación Especialidad Fogade y Juicios',
                    titleAttr: 'Exportar a Excel',

                    //className:'btn btn-success'
                },

            ]
        });


        //Creamos una fila en el head de la tabla y lo clonamos para cada columna
        /*
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
        */


        // Order by the grouping
        $('#tabla tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                table.order([groupColumn, 'desc']).draw();
            } else {
                table.order([groupColumn, 'asc']).draw();
            }
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




