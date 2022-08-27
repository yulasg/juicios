"use strict";

// Class definition
var KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;
 

    // Private functions
    var initDatatable = function () {
        dt = $("#tabla").DataTable({
            //searchDelay: 500,
            processing: true,
            serverSide: true,
            //order: [0, 'desc'],
            order: [[0, 'desc']],
            ajax: '/referencia/consulta',
         
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
           
                {
                    data: 'documento',
                    name: 'documento'
                },
                {
                    data: 'nombre',
                    name: 'nombre'
                },
                {
                    data: 'actores.juicio_id',
                    name: 'actores.juicio_id'
                },  
            ],


            responsive: true,
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
            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
      
           
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